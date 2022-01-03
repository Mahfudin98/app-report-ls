<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvReportCollection;
use App\Http\Resources\CsReportCollection;
use App\Http\Resources\OrderCollection;
use App\Models\AdvReport;
use App\Models\CsReport;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Target;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    //report CS
    public function indexCS()
    {
        $user = request()->user();
        $reports = DB::table('cs_reports')
        ->join('orders', 'cs_reports.id', '=', 'orders.cs_report_id')
        ->join('detail_orders', 'cs_reports.id', '=', 'detail_orders.cs_report_id')
        ->select('cs_reports.*', 'orders.total', 'orders.ongkir', 'detail_orders.subtotal', 'detail_orders.cs_report_id')
        ->where('cs_reports.user_id', $user->id)
        ->groupBy('detail_orders.cs_report_id')
        ->selectRaw('detail_orders.subtotal, sum(subtotal) as subtotals')
        ->orderBy('date', 'DESC')
        ->get();
        return response()->json(['data' => $reports]);
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
            'description' => 'nullable'
        ]);

        $user = request()->user();

        $csreport = CsReport::create([
            'user_id'   => $user->id,
            'chat'      => $request->chat,
            'transaksi' => $request->transaksi,
            'date'      => $request->date,
            'description' => $request->description
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    public function updateReportCS(Request $request, $id)
    {
        $csReport = CsReport::find($id);
        $this->validate($request, [
            'chat'      => 'required|integer',
            'transaksi' => 'required|integer',
            'date'      => 'required|date',
            'description' => 'nullable'
        ]);

        $user = request()->user();

        $csReport->update([
            'user_id'   => $user->id,
            'chat'      => $request->chat,
            'transaksi' => $request->transaksi,
            'date'      => $request->date,
            'description' => $request->description
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    public function addCustomerCS(Request $request)
    {
        $this->validate($request, [
            'customer_name'     => 'required|string',
            'customer_phone'    => 'required|string',
            'customer_address'  => 'required|string',
            'waybill'           => 'required|string',
            'image'             => 'nullable|image',
            'ongkir'            => 'required',
            'metode'            => 'required',
            'biaya'             => 'nullable',
            'total'             => 'required',
            'courier'           => 'required',
            'weight'            => 'required',
            'district_id'       => 'required',
            'ongkir_discount'   => 'nullable'
        ]);

        try {
            $user = request()->user();
            $data = $request->all();
            $name = NULL;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = Str::slug($request->customer_name . '-' . $request->waybill) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/orders', $name);
            }
            $order = Order::create([
                'user_id'           => $user->id,
                'cs_report_id'      => $request->cs_report_id,
                'customer_name'     => $request->customer_name,
                'customer_phone'    => $request->customer_phone,
                'customer_address'  => $request->customer_address,
                'waybill'           => $request->waybill,
                'date'              => $request->date,
                'image'             => $name,
                'ongkir'            => $request->ongkir,
                'ongkir_discount'   => $request->ongkir_discount,
                'metode'            => $request->metode,
                'biaya'             => $request->biaya,
                'total'             => $request->total,
                'courier'           => $request->courier,
                'weight'            => $request->weight,
                'prov_id'           => $request->province,
                'city_id'           => $request->city,
                'district_id'       => $request->district_id
            ]);
            $orders = Order::find($order['id']);
            foreach ($data['qty'] as $item => $value) {
                $product = array(
                    'user_id'   => $user->id,
                    'order_id' => $orders->id,
                    'cs_report_id' => $request->cs_report_id,
                    'product_id' => $data['product_id'][$item],
                    'price' => $data['price'][$item],
                    'qty' => $data['qty'][$item],
                    'date' => $request->date,
                    'subtotal' => $data['qty'][$item] * $data['price'][$item]
                );
                $detail = DetailOrder::create($product);
            }

            $csReport = CsReport::where('date', $request->date)->where('user_id', $user->id)->first();
            $orderget = Order::where('cs_report_id', $csReport->id)->get();
            $csReport->update([
                'transaksi' => $orderget->count()
            ]);
            // update target
            $bulan = Carbon::createFromFormat('Y-m-d', $request->date)->month;
            $details = DetailOrder::where('date', $request->date)->where('user_id', $user->id)->sum('subtotal');
            $target = Target::whereMonth('start_date', $bulan)->where('user_id', $user->parent_id)->first();
            $target->update([
                'omset' => $target->omset + $details
            ]);

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function addProductForm($id)
    {
        $order = Order::find($id);
        $detail = DetailOrder::where('order_id', $id)->sum('subtotal');
        return response()->json(['order' => $order, 'detail' => $detail]);
    }

    public function submitProductOrder(Request $request)
    {
        try {
            $user = request()->user();
            $data = $request->all();
            foreach ($data['qty'] as $item => $value) {
                $product = array(
                    'user_id'   => $user->id,
                    'order_id' => $request->order_id,
                    'cs_report_id' => $request->cs_report_id,
                    'product_id' => $data['product_id'][$item],
                    'price' => $data['price'][$item],
                    'qty' => $data['qty'][$item],
                    'date' => $request->date,
                    'subtotal' => $data['qty'][$item] * $data['price'][$item],
                    'status' => $request->status
                );
                $detail = DetailOrder::create($product);
            }
            // target update
            $bulan = Carbon::createFromFormat('Y-m-d', $request->date)->month;
            $details = DetailOrder::where('date', $request->date)->where('user_id', $user->id)->sum('subtotal');
            $target = Target::whereMonth('start_date', $bulan)->where('user_id', $user->parent_id)->first();
            $target->update([
                'omset' => $target->omset + $details
            ]);
            $order = Order::find($request->order_id);
            $order->update([
                'ongkir'            => $request->ongkir,
                'biaya'             => $request->biaya,
                'total'             => $request->total,
                'weight'            => $request->weight,
            ]);
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function editProductForm($id)
    {
        $order = DetailOrder::find($id);
        return $order;
    }

    public function updateProductOrder(Request $request, $id)
    {
        // $this->validate($request, [
        //     'customer_name'     => 'required|string',
        //     'customer_phone'    => 'required|string',
        //     'customer_address'  => 'required|string',
        //     'waybill'           => 'required|string',
        //     'image'             => 'nullable|image',
        //     'ongkir'            => 'required',
        //     'metode'            => 'required',
        //     'biaya'             => 'nullable',
        //     'total'             => 'required',
        //     'courier'           => 'required',
        //     'weight'            => 'required',
        //     'district_id'       => 'required',
        // ]);

        try {
            $user = request()->user(); //add user id
            //batas
            $detail = DetailOrder::find($id);
            $bulan = Carbon::createFromFormat('Y-m-d', $detail->date)->month;
            $target = Target::whereMonth('start_date', $bulan)->where('user_id', $user->parent_id)->first();
            $target->update([
                'omset' => $target->omset - $detail->subtotal
            ]);
            $detail->update([
                'product_id' => $request->product_id,
                'price' => $request->price,
                'qty' => $request->qty,
                'subtotal' => $request->qty * $request->price,
            ]);
            //edit this
            $target->update([
                'omset' => $target->omset + ($request->qty * $request->price)
            ]);
            //to this
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteOrderProduct($id)
    {
        $detail = DetailOrder::find($id);
        $user = request()->user();
        $details = DetailOrder::where('id', $id)->sum('subtotal');
        $bulan = Carbon::createFromFormat('Y-m-d', $detail->date)->month;
        $target = Target::whereMonth('start_date', $bulan)->where('user_id', $user->parent_id)->first();
        $target->update([
            'omset' => $target->omset - $details
        ]);
        $detail->delete();
        return response()->json(['status' => 'success']);
    }

    public function editOrder($id)
    {
        $order = Order::find($id);
        $detail = DetailOrder::where('order_id', $id)->sum('subtotal');
        return response()->json(['order' => $order, 'detail' => $detail]);
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);

        $filename = $order->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            File::delete(storage_path('app/public/orders/' . $filename));
            $filename = Str::slug($request->customer_name . '-' . $request->waybill) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/orders', $filename);
        }

        $order->update([
            'customer_name'     => $request->customer_name,
            'customer_phone'    => $request->customer_phone,
            'customer_address'  => $request->customer_address,
            'waybill'           => $request->waybill,
            'image'             => $filename,
            'ongkir'            => $request->ongkir,
            'metode'            => $request->metode,
            'biaya'             => $request->biaya,
            'total'             => $request->total,
            'courier'           => $request->courier,
            'weight'            => $request->weight,
            'prov_id'           => $request->province,
            'city_id'           => $request->city,
            'district_id'       => $request->district_id
        ]);

        return response()->json(['status' => 'success']);
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $user = request()->user();
        $details = DetailOrder::where('order_id', $id)->sum('subtotal');
        $bulan = Carbon::createFromFormat('Y-m-d', $order->date)->month;
        $target = Target::whereMonth('start_date', $bulan)->where('user_id', $user->parent_id)->first();
        $target->update([
            'omset' => $target->omset - $details
        ]);
        File::delete(storage_path('app/public/orders/' . $order->image));
        $order->delete();
        $detail = DetailOrder::where('order_id', $id)->delete();
        $csReport = CsReport::where('date', $order->date)->where('user_id', $user->id)->first();
        $csReport->update([
            'transaksi' => $csReport->transaksi - 1
        ]);
        return response()->json(['status' => 'success']);
    }

    public function listUserCS()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;
        $auth = request()->user();
        $user = User::where('parent_id', $auth->id)->pluck('id')->toArray();
        $report = CsReport::whereIn('user_id', $user)->where('date', 'LIKE', '%' . $filter . '%')->with(['user']);
        if (request()->q != '') {
            $report = $report->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return response()->json(['data' => $report->get()]);
    }

    public function viewOrderReport()
    {
        $report = request()->id;
        $order = Order::where('user_id', $report)->with(['orderDetail.product'])->orderBy('date', 'DESC');
        return new OrderCollection($order->paginate(15));
    }

    public function listAllUserCS()
    {
        $user = DB::table('users')
            ->Join('cs_reports', 'users.id', '=', 'cs_reports.user_id')
            ->select('users.*', 'cs_reports.chat', 'cs_reports.transaksi')
            ->groupBy('user_id')
            ->selectRaw('sum(chat) as chats, sum(transaksi) as transaction')
            ->get();
        return response()->json(['data' => $user]);
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
            $csReport[] = CsReport::where('user_id', $row->id)->with(['detailOrder'])->whereBetween('date', [$start, $end])->sum('chat');;
        }

        return array_sum($csReport);
    }

    public function getOmsetADV()
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
            $detailOrder[] = DetailOrder::where('user_id', $row->id)->where('status', 1)->whereBetween('date', [$start, $end])->sum('subtotal');
        }

        return array_sum($detailOrder);
    }

    public function storeADV(Request $request)
    {
        $this->validate($request, [
            'biaya_iklan' => 'required|integer',
            'cp_wa' => 'required|integer',
            'date' => 'required|date',
            'lead' => 'required|integer',
            'dashboard' => 'nullable|integer',
            'omset' => 'nullable|integer',
            'date_start' => 'required',
            'date_end' => 'required',
            'keterangan' => 'nullable'
        ]);
        $user = Auth::user()->id;
        AdvReport::create([
            'user_id' => $user,
            'biaya_iklan' => $request->biaya_iklan,
            'lead' => $request->lead,
            'dashboard' => $request->dashboard,
            'omset' => $request->omset,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'cp_wa' => $request->cp_wa,
            'date' => $request->date,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    public function editADVReport($id)
    {
        $report = AdvReport::find($id);

        return response()->json(['status' => 'success', 'data' => $report], 200);
    }

    public function updateADVReport(Request $request, $id)
    {
        $this->validate($request, [
            'biaya_iklan' => 'required|integer',
            'cp_wa' => 'required|integer',
            'date' => 'required|date',
            'lead' => 'required|integer',
            'dashboard' => 'nullable|integer',
            'omset' => 'nullable|integer',
            'date_start' => 'required',
            'date_end' => 'required',
            'keterangan' => 'nullable'
        ]);
        $report = AdvReport::find($id);
        $report->update([
            'biaya_iklan' => $request->biaya_iklan,
            'lead' => $request->lead,
            'dashboard' => $request->dashboard,
            'omset' => $request->omset,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'cp_wa' => $request->cp_wa,
            'date' => $request->date,
            'keterangan' => $request->keterangan
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    public function destroyReportADV($id)
    {
        $report = AdvReport::find($id);
        $report->delete();
        return response()->json(['status' => 'success'], 200);
    }

    public function viewOmsetADV($start, $end)
    {
        $adv = Auth::user()->id;
        $cs = User::where('parent_id', $adv)->get();

        $filter = [$start, $end];
        $date = str_replace(' ', ' - ', $filter);
        $mulai = Carbon::parse($date[0])->format('Y-m-d');
        $akhir = Carbon::parse($date[1])->format('Y-m-d');
        foreach ($cs as $row) {
            $csReport = CsReport::where('user_id', $row->id)->with(['user', 'order.orderDetail.product'])->whereBetween('date', [$mulai, $akhir])->get();
        }

        return $csReport;
    }

    public function viewOmsetADVManager($id, $start, $end)
    {
        $adv = User::find($id);
        $cs = User::where('parent_id', $adv->id)->get();

        $filter = [$start, $end];
        $date = str_replace(' ', ' - ', $filter);
        $mulai = Carbon::parse($date[0])->format('Y-m-d');
        $akhir = Carbon::parse($date[1])->format('Y-m-d');
        foreach ($cs as $row) {
            $csReport = CsReport::where('user_id', $row->id)->with(['user', 'order.orderDetail.product'])->whereBetween('date', [$mulai, $akhir])->get();
        }

        return $csReport;
    }

    public function showADV($id)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        $reports = AdvReport::where('user_id', $id)->orderBy('date', 'DESC')->whereBetween('date', [$start, $end]);
        if (request()->q != '') {
            $reports = $reports->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new AdvReportCollection($reports->paginate(10));
    }
}
