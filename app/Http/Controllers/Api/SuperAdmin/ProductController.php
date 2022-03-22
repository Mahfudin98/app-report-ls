<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\CsReport;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade As PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC');

        if (request()->q != '') {
            $products = $products->where(
                'name',
                'LIKE',
                '%' . request()->q . '%'
            );
        }

        return new ProductCollection($products->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'type_pembelian' => 'required',
            'type_product' => 'required',
            'origin_order' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => 0,
            'type_pembelian' => $request->type_pembelian,
            'type_product' => $request->type_product,
            'origin_order' => $request->origin_order,
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json(
            ['status' => 'success', 'data' => $product],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'type_pembelian' => 'required',
            'type_product' => 'required',
            'origin_order' => 'required',
        ]);
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'slug' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'type_pembelian' => $request->type_pembelian,
            'type_product' => $request->type_product,
            'origin_order' => $request->origin_order,
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['status' => 'success'], 200);
    }

    public function allProduct()
    {
        $products = Product::where('origin_order', '!=', null)->orderBy(
            'created_at',
            'DESC'
        );

        return new ProductCollection($products->get());
    }

    public function chartProduct()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;

        $data = [];
        $order = DetailOrder::with(['product'])
            ->where('date', 'LIKE', '%' . $filter . '%')
            ->groupBy('product_id')
            ->selectRaw('*, sum(qty) as sum')
            ->orderBy('sum', 'DESC')
            ->get();
        foreach ($order as $rows) {
            $data[] = [
                'labels' => substr($rows->product->name, 0, 10) . '...',
                'total' => $rows->sum,
            ];
        }

        return $data;
    }

    public function listChartProduct()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;
        $order = DetailOrder::with(['product'])
            ->where('date', 'LIKE', '%' . $filter . '%')
            ->groupBy('product_id')
            ->selectRaw('*, sum(qty) as sum')
            ->orderBy('sum', 'DESC')
            ->get();

        return response()->json(['data' => $order], 200);
    }

    public function persentaseProduct()
    {
        $year = request()->year;
        $mounth = request()->month;
        $filter = $year . '-' . $mounth;

        $product = DB::table('products')
            ->join(
                'detail_orders',
                'products.id',
                '=',
                'detail_orders.product_id'
            )
            ->select(
                'products.origin_order',
                'detail_orders.qty',
                DB::raw(
                    'YEAR(detail_orders.date) year, MONTH(detail_orders.date) month'
                )
            )
            ->groupBy('products.origin_order')
            ->groupBy('month', 'year')
            ->where('detail_orders.date', 'LIKE', '%' . $filter . '%')
            ->selectRaw('detail_orders.qty, sum(qty) as sum')
            ->get();

        $data = [];
        foreach ($product as $row) {
            $data[] = [
                'labels' => $row->origin_order,
                'total' => $row->sum,
            ];
        }

        return $data;
    }

    public function exportProduk(Request $request)
    {
        $order = $this->listChartProduct();
        return Excel::download(new ProductExport($order, request()->month, request()->year), 'omset'.request()->month.'-'.request()->year.'.xlsx');
    }
}