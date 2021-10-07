<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CsReport;
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

        $reports = CsReport::with(['user','order.product'])->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(omset) as sum')->get();

        $data = [];
        foreach ($reports as $row) {
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

        $reports = CsReport::with(['user','order.product'])->orderBy('omset', 'ASC')->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(chat) as sum')->get();
        // $order = Order::groupBy('cs_report_id')->selectRaw('*, sum(total_order) as order')->get();
        $data = [];
        foreach ($reports as $row) {
            $order = Order::where('cs_report_id', $row->id)->whereBetween('date', [$start, $end])->sum('total_order');
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
}
