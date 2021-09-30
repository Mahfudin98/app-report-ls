<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionCollection;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with(['user'])->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $positions = $positions->where('name', 'LIKE', '%' . request()->q . '%');
        }

        return new PositionCollection($positions->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100'
        ]);

        Position::create([
            'name' => $request->name,
            'slug' => $request->name,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
    }
}
