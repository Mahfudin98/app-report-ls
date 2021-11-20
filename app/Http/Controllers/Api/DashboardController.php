<?php

namespace App\Http\Controllers\Api;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Models\CsReport;
use App\Models\DetailOrder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\OmsetExport;
use App\Http\Resources\CustomersCollection;
use App\Models\Target;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function chart()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        $orders = DetailOrder::with(['user', 'order'])->where('status', 1)->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(subtotal) as sum')->get(['user_id', 'qty', 'price', 'date']);
        $data = [];
        foreach ($orders as $row) {
            $data[] = [
                'image' => $row->user->image,
                'labels' => $row->user->name,
                'date' => $row->date,
                'total' => $row->sum
            ];
        }
        return $data;
    }

    public function persentaseCS()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }

        $reports = CsReport::with(['user','order.orderDetail.product'])->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(chat) as sum')->get();

        $data = [];
        foreach ($reports as $row) {
            $order = DetailOrder::where('user_id', $row->user_id)->where('status', 1)->whereBetween('date', [$start, $end])->sum('qty');
            $total_order = ($order / $row->sum) * 100;
            $data[] = [
                'name' => $row->user->name,
                'lead' => $row->sum,
                'order' => $order,
                'total_order' => floor($total_order)
            ];
        }

        return $data;
    }

    public function allOmsets()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;

        $parse = Carbon::parse($filter);
        $array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));

        $orders = DetailOrder::where('date', 'LIKE', '%' . $filter . '%')->where('status', 1)->groupBy('date')->selectRaw('*, sum(subtotal) as total')->get();
        $ordersRetur = DetailOrder::where('date', 'LIKE', '%' . $filter . '%')->where('status', 0)->groupBy('date')->selectRaw('*, sum(subtotal) as totalRetur')->get();
        $data = [];
        foreach ($array_date as $row) {
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            $date = $filter . '-' . $f_date;
            $total = $orders->firstWhere('date', $date);
            $totalRetur = $ordersRetur->firstWhere('date', $date);
            $data[] = [
                'date' => $date,
                'total' => $total ? $total->total:0,
                'totalRetur' => $totalRetur ? $totalRetur->totalRetur:0
            ];
        }
        return $data;
    }

    public function exportData(Request $request)
    {
        $omset = $this->allOmsets();
        return Excel::download(new OmsetExport($omset, request()->month, request()->year), 'omset'.request()->month.'-'.request()->year.'.xlsx');
    }

    public function listCustomer()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }

        $customer = Order::orderBy('created_at', 'ASC')->whereBetween('date', [$start, $end])->groupBy('customer_phone');

        return new CustomersCollection($customer->paginate(1000));
    }

    public function exportDataCustomers(Request $request)
    {
        $customer = $this->listCustomer();
        return Excel::download(new CustomerExport($customer, request()->date), 'customer'.request()->date.'.xlsx');
    }

    public function targetIndex()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;

        $data = Target::with(['user'])->where('start_date', 'LIKE', '%' . $filter . '%')->get();

        return response()->json(['data' => $data], 200);
    }

    public function addTarget(Request $request)
    {
        $this->validate($request, [
            'target' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $bulan = Carbon::createFromFormat('Y-m-d', $request->start_date)->month;
        $adv = User::where('parent_id', $request->user_id)->pluck('id')->toArray();

        $orders = $orders = DetailOrder::whereMonth('date', $bulan)->where('status', 1)->whereIn('user_id', $adv)->sum('subtotal');

        Target::create([
            'user_id' => $request->user_id,
            'adv_name' => $request->adv_name,
            'target' => $request->target,
            'omset' => $orders,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return response()->json(['status' => 'success'], 200);
    }
}
