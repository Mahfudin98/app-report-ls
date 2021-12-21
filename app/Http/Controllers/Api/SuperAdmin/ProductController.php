<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\CsReport;
use App\Models\DetailOrder;

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
            $products = $products->where('name', 'LIKE', '%' . request()->q . '%');
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
            'type_product' => 'required'
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => 0,
            'type_pembelian' => $request->type_pembelian,
            'type_product' => $request->type_product
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
        return response()->json(['status' => 'success', 'data' => $product], 200);
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
            'type_product' => 'required'
        ]);
        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'slug' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'type_pembelian' => $request->type_pembelian,
            'type_product' => $request->type_product
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
        $products = Product::orderBy('created_at', 'DESC');

        return new ProductCollection($products->get());
    }

    public function chartProduct()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        $data = [];
        $order = DetailOrder::with(['product'])->whereBetween('date', [$start, $end])->groupBy('product_id')->selectRaw('*, sum(qty) as sum')->orderBy('sum', 'DESC')->get();
        foreach ($order as $rows) {
            $data[] = [
                'labels' => substr($rows->product->name, 0, 10). '...',
                'date' => $rows->date,
                'total' => $rows->sum
            ];
        }

        return $data;
    }

    public function listChartProduct()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
        }
        $order = DetailOrder::with(['product'])->whereBetween('date', [$start, $end])->groupBy('product_id')->selectRaw('*, sum(qty) as sum')->orderBy('sum', 'DESC')->get();

        return response()->json(['data' => $order], 200);
    }
}
