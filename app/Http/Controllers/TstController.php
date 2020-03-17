<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class TstController extends Controller
{
    public function index()
    {
        $order = Order::where('id', 2)->with(['products'])->first()->toArray();

        var_dump($order); die();
        $backOrders = Order::Status(Order::STATUS_CONFIRMED) // просроченные
            ->where('delivery_dt','<',now())
            ->take(50)
            ->orderByDesc('delivery_dt')
            ->get()->toArray();  
        $currentOrders = Order::Status(Order::STATUS_CONFIRMED) // текущие
            ->whereBetween('delivery_dt',[now(), now()->addHours(24)])
            ->orderBy('delivery_dt')
            ->get()->toArray();  
        $newOrders = Order::Status(Order::STATUS_NEW) // новые
            ->where('delivery_dt','>',now())
            ->take(50)
            ->orderBy('delivery_dt')
            ->get()->toArray(); 
        $closedOrders = Order::Status(Order::STATUS_CLOSED) // текущие
            ->whereBetween('delivery_dt',[now()->today(), now()->tomorrow()])
            ->take(50)
            ->orderBy('delivery_dt')
            ->get()->toArray(); 
        var_dump(count($backOrders), $backOrders[24]);
    }
}
