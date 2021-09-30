<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvReportCollection;
use App\Http\Resources\CsReportCollection;
use App\Models\AdvReport;
use App\Models\CsReport;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class ReportController extends Controller
{
    //report CS
    public function indexCS()
    {
        $reports = CsReport::where('user_id', Auth::user()->id)->with(['order.product'])->orderBy('date', 'DESC');
        if (request()->q != '') {
            $reports = $reports->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new CsReportCollection($reports->paginate(10));

    }

    public function storeCS(Request $request)
    {
        $this->validate($request, [
            'chat' => 'required|integer',
            'transaksi' => 'required|integer',
            'omset' => 'required|integer',
            'date' => 'required|date'
            // 'keterangan' => 'nullable'
        ]);

        try {
            $data = $request->all();
            $user = request()->user();

            $csreport = CsReport::create([
                'user_id' => $user->id,
                'chat' => $request->chat,
                'transaksi' => $request->transaksi,
                'omset' => $request->omset,
                'date' => $request->date
            ]);

            $reports = CsReport::find($csreport['id']);

            foreach ($data['total_order'] as $item => $value) {
                $data2 = array(
                    'date' => $request->date,
                    'cs_report_id' => $reports->id,
                    'product_id' => $data['product_id'][$item],
                    'total_order' => $data['total_order'][$item]
                );

                $order = Order::create($data2);
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    //report adv
    public function indexADV()
    {
        $reports = AdvReport::where('user_id', Auth::user()->id)->with(['order.product'])->orderBy('date', 'DESC');
        if (request()->q != '') {
            $reports = $reports->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new AdvReportCollection($reports->paginate(10));
    }
}
