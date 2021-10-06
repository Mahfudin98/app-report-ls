<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CsReport;
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

        $reports = CsReport::with(['user','order.product'])->orderBy('date', 'DESC')->whereBetween('date', [$start, $end])->groupBy('user_id')->selectRaw('*, sum(omset) as sum')->get();

        $data = [];
        foreach ($reports as $row) {
            $data[] = [
                'labels' => $row->user->name,
                'date' => $row->date,
                'total' => $row->sum
            ];
        }
        return $data;
    }
}
