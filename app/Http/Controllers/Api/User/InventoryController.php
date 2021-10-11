<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryCollection;
use App\Models\InventoriUsed;
use App\Models\Inventory;
use App\Models\Position;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with(['used'])->orderBy('name', 'ASC');
        if (request()->q != '') {
            $inventory = $inventory->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new InventoryCollection($inventory->paginate(10));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100'
        ]);

        Inventory::create([
            'name' => $request->name,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    //
    public function indexDetail()
    {
        $usage = Position::with(['used'])->orderBy('name', 'ASC');
        if (request()->q != '') {
            $usage = $usage->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return response()->json(['status' => 'success', 'data' => $usage->get()], 200);
    }

    public function showDetail($slug)
    {
        $posisi = Position::where('slug', $slug)->first();
        $usage = InventoriUsed::where('position_id', $posisi->id)->with(['inventory'])->orderBy('jumlah', 'ASC')->get();
        return response()->json(['status' => 'success', 'data' => $usage], 200);
    }

    public function storeDetail(Request $request)
    {
        $this->validate($request, [
            'position_id' => 'required',
            'inventory_id' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'keterngan' => 'nullable'
        ]);

        InventoriUsed::create([
            'position_id' => $request->position_id,
            'inventory_id' => $request->inventory_id,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'keterngan' => $request->keterngan
        ]);
        return response()->json(['status' => 'success'], 200);
    }
}
