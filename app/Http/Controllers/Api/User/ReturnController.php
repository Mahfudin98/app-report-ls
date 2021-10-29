<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        $orders = Order::with(['csReport.user'])->orderBy('date', 'ASC');
        if (request()->q != '') {
            $orders = $orders->where('waybill', 'LIKE', '%' . request()->q . '%');
        }
        return new OrderCollection($orders->paginate(10));
    }
}
