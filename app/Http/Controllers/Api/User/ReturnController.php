<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\ReturnOrderCollection;
use App\Models\CsReport;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\ReturnOrder;
use App\Models\User;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $orders = Order::with(['csReport.user'])->orderBy('date', 'ASC');
        if (request()->q != '') {
            $orders = $orders->where('waybill', 'LIKE', '%' . request()->q . '%');
        }
        return new OrderCollection($orders->paginate(10));
    }

    public function orderReturn()
    {
        $orderReturn = ReturnOrder::with(['order'])->orderBy('date_return', 'ASC');
        if (request()->q != '') {
            $orderReturn = $orderReturn->where('waybill', 'LIKE', '%' . request()->q . '%');
        }

        return new ReturnOrderCollection($orderReturn->paginate(10));
    }

    public function OrderDetail($waybill)
    {
        $order = Order::with(['orderDetail.product', 'csReport.user'])->where('waybill', $waybill)->first();
        $csReport = CsReport::with(['user'])->where('id', $order->cs_report_id)->first();
        $user = User::where('id', $csReport->user_id)->first();
        return response()->json(['order' => $order, 'user' => $user], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'alasan' => 'nullable',
        ]);

        try {
            $order = Order::where('waybill', $request->waybill)->with(['csReport'])->first();
            $csReport = CsReport::with(['user'])->where('id', $order->cs_report_id)->first();
            $user = User::where('id', $csReport->user_id)->first();
            $return = ReturnOrder::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'cs_name' => $user->name,
                'customer_name' => $order->customer_name,
                'customer_address' => $order->customer_address,
                'waybill' => $request->waybill,
                'date_order' => $order->date,
                'date_return' => $request->date,
                'alasan' => $request->alasan
            ]);
            $order->update([
                'status' => 0,
            ]);

            $orderDetail = DetailOrder::where('order_id', $order->id);
            $orderDetail->update([
                'status' => 0
            ]);

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
