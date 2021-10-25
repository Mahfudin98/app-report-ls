<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvReportCollection;
use App\Http\Resources\CsReportCollection;
use App\Models\AdvReport;
use App\Models\CsReport;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ReportController extends Controller
{
    //report CS
    public function indexCS()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }

        $reports = CsReport::where('user_id', Auth::user()->id)->with(['order.orderDetail.product'])->orderBy('date', 'DESC')->whereBetween('date', [$start, $end]);
        if (request()->q != '') {
            $reports = $reports->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new CsReportCollection($reports->paginate(10));
    }
    public function indexDateCS($date)
    {
        $csReport = CsReport::where('user_id', Auth::user()->id)->with(['order.orderDetail.product'])->where('date', $date)->first();
        return $csReport;
    }

    public function addReportCS(Request $request)
    {
        $this->validate($request, [
            'chat'      => 'required|integer',
            'transaksi' => 'required|integer',
            'date'      => 'required|date',
            // 'keterangan' => 'nullable'
        ]);

        $user = request()->user();

        $csreport = CsReport::create([
            'user_id'   => $user->id,
            'chat'      => $request->chat,
            'transaksi' => $request->transaksi,
            'date'      => $request->date
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    public function addCustomerCS(Request $request)
    {
        $this->validate($request, [
            'customer_name'     => 'required|string',
            'customer_phone'    => 'required|string',
            'customer_address'  => 'required|string',
            'waybill'  => 'required|string',
        ]);

        try {
            $data = $request->all();
            $order = Order::create([
                'cs_report_id'      => $request->cs_report_id,
                'customer_name'     => $request->customer_name,
                'customer_phone'    => $request->customer_phone,
                'customer_address'  => $request->customer_address,
                'waybill'           => $request->waybill,
                'date'              => $request->date
            ]);
            $orders = Order::find($order['id']);
            foreach ($data['qty'] as $item => $value) {
                $product = array(
                    'order_id' => $orders->id,
                    'product_id' => $data['product_id'][$item],
                    'price' => $data['price'][$item],
                    'qty' => $data['qty'][$item]
                );
                $detail = DetailOrder::create($product);
            }
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    //report adv
    public function indexADV()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        $reports = AdvReport::where('user_id', Auth::user()->id)->orderBy('date', 'DESC')->whereBetween('date', [$start, $end]);
        if (request()->q != '') {
            $reports = $reports->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new AdvReportCollection($reports->paginate(10));
    }

    public function getOrder()
    {
        $adv = Auth::user()->id;
        $cs = User::where('parent_id', $adv)->get();
        foreach ($cs as $row) {
            $csReport[] = CsReport::where('user_id', $row->id)->pluck('id')->toArray();
        }
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        foreach ($csReport as $rows) {
            $order[] = Order::whereIn('cs_report_id', $rows)->whereBetween('date', [$start, $end])->sum('total_order');
        }
        // $order = Order::sum('total_order');
        return array_sum($order);
    }

    public function leadCS()
    {
        $adv = Auth::user()->id;
        $cs = User::where('parent_id', $adv)->get();
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        foreach ($cs as $row) {
            $csReport[] = CsReport::where('user_id', $row->id)->whereBetween('date', [$start, $end])->sum('chat');;
        }

        return array_sum($csReport);
    }

    public function storeADV(Request $request)
    {
        $this->validate($request, [
            'biaya_iklan' => 'required|integer',
            'cp_wa' => 'required|integer',
            'date' => 'required|date'
        ]);
        $user = Auth::user()->id;
        AdvReport::create([
            'user_id' => $user,
            'biaya_iklan' => $request->biaya_iklan,
            'cp_wa' => $request->cp_wa,
            'date' => $request->date
        ]);

        return response()->json(['status' => 'success'], 200);
    }
}
