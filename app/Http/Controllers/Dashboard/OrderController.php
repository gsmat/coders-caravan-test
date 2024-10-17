<?php

namespace App\Http\Controllers\Dashboard;

use App\Helper\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        //DB::enableQueryLog();
        $orders = Order::with('user:id,name', 'order_detail')->orderBy('status', 'asc')->get();
        //$query = DB::getQueryLog();
        //Log::info($query);
        return response()->json([
            'status' => 200,
            'data' => $orders
        ]);
        return view('dashboard.orders.list', compact('orders'));
    }

    public function confirmed($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::PENDING) {
            $order->status = OrderStatus::CONFIRMED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }

    public function shipped($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::CONFIRMED) {
            $order->status = OrderStatus::SHIPPED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::SHIPPED) {
            $order->status = OrderStatus::DELIVERED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }

    public function returned($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::DELIVERED) {
            $order->status = OrderStatus::RETURNED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }

    public function canceled($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::PENDING) {
            $order->status = OrderStatus::CANCELLED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }

    public function failed($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == OrderStatus::SHIPPED) {
            $order->status = OrderStatus::FAILED;
            $order->save();
            return redirect()->route('dashboard.order.list');
        }
    }
}
