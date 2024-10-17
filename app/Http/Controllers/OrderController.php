<?php

namespace App\Http\Controllers;

use App\Helper\OrderStatus;
use App\Models\BasketProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'payment_type' => 'required',
        ]);
        #user
        #basketId
        #sebeti productla check etmek

        $user = auth()->user();
        $basketId = $user->basket->id;
        $basketProducts = BasketProduct::where('basket_id', $basketId)->get();

        $total = 0;
        $order = [
            'user_id' => $user->id,
            'basket_id' => $basketId,
            'address' => $request->address,
            'payment_type' => $request->payment_type,
            'note' => $request->note ?? '',
            'total' => 0,
            'status' => OrderStatus::PENDING,
            'uid' => uniqid()
        ];
//        dd($order);
        $newOrder = new Order();
        $newOrder->user_id = $order['user_id'];
        $newOrder->basket_id = $order['basket_id'];
        $newOrder->address = $order['address'];
        $newOrder->payment_type = $order['payment_type'];
        $newOrder->note = $order['note'];
        $newOrder->total = $order['total'];
        $newOrder->status = $order['status'];
        $newOrder->uid = $order['uid'];
        $newOrder->save();

        foreach ($basketProducts as $basketProduct) {

            $product = Product::find($basketProduct->product_id);

            if ($product->has_stock === false) {
                return redirect()->back()->withErrors('Product out of stock');
            }

            if ($basketProduct->stock_count > $product->stock_count) {
                return redirect()->back()->withErrors('Decrease the stock count');
            }
            $total += $basketProduct->stock_count * $product->price;
            $orderBodies = [
                'order_id' => $newOrder->id,
                'product_id' => $basketProduct->product_id,
                'quantity' => $basketProduct->stock_count,
                'price' => $product->price,
                'total' => $basketProduct->stock_count * $product->price
            ];

            $orderBody = new OrderDetail();
            $orderBody->order_id = $orderBodies['order_id'];
            $orderBody->product_id = $orderBodies['product_id'];
            $orderBody->quantity = $orderBodies['quantity'];
            $orderBody->price = $orderBodies['price'];
            $orderBody->total = $orderBodies['total'];
            $orderBody->save();
        }

        $newOrder->total = $total;
        $newOrder->save();

        BasketProduct::where('basket_id',$basketId)->delete();

        if ($request->payment_type === 'card') {
            return view('payment', compact('total', 'newOrder'));
        }
        return redirect()->route('user.order.index')->with('success', 'Order created successfully.');
    }

    public function my_orders()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function show_order_detail($id)
    {
        $orderUid = Order::select('uid')->find($id);
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        return view('orders.detail', compact('orderDetails','orderUid'));
    }

    public function cancel_order($id)
    {
        $order = Order::findOrFail($id);
        if($order->status === OrderStatus::PENDING){
            $order->status = OrderStatus::CANCELLED;
            $order->save();
            return redirect()->route('user.order.index');
        }
    }
}
