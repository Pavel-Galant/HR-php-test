<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function index()
    {
        //var_dump(now());
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
        $closedOrders = Order::Status(Order::STATUS_CLOSED) // завершенные
            ->whereBetween('delivery_dt',[now()->today(), now()->tomorrow()])
            ->take(50)
            ->orderBy('delivery_dt')
            ->get()->toArray(); 
        //var_dump(count($currentOrders), $currentOrders);
        return view('pages.orders', ['data' => ['backOrders' => $backOrders, 'currentOrders' => $currentOrders, 'newOrders' => $newOrders, 'closedOrders' => $closedOrders]]);
    }

    public function edit(Request $request, $id)
    {
        $order = Order::where('id', (int)$id)->with(['products'])->first();
       
        if ($request->isMethod('post')) 
        {
            $request->validate([
                'client_email'  => 'required|email|max:255',
                'partner_id'   => 'required',
                'status' => 'required',
            ]);
            
            $order->fill($request->only(['client_email', 'partner_id', 'status']));
            if ($order->save()) return redirect('/orders');
        }
        return view('pages.order-edit', ['order' => $order->toArray(), 'partners' => Partner::all()->toArray(), 'statuses' => Order::getStatuses()]);
    }
}
