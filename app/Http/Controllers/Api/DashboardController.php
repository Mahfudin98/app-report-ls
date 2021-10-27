<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CsReport;
use App\Models\DetailOrder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $orders = DetailOrder::with(['user', 'order'])->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(subtotal) as sum')->get(['user_id', 'qty', 'price', 'date']);
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
            $order = DetailOrder::where('user_id', $row->user_id)->whereBetween('date', [$start, $end])->sum('qty');
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

        $orders = DetailOrder::where('created_at', 'LIKE', '%' . $filter . '%')->groupBy('date')->selectRaw('*, sum(subtotal) as total')->get();

        $data = [];
        foreach ($array_date as $row) {
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            $date = $filter . '-' . $f_date;
            $total = $orders->firstWhere('date', $date);
            $data[] = [
                'date' => $date,
                'total' => $total ? $total->total:0
            ];
        }

        return $data;
    }
}
