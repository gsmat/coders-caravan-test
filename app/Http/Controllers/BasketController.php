<?php

namespace App\Http\Controllers;

use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $basketId = auth()->user()->basket->id;

        $products = BasketProduct::with('product:id,title,price,image,has_stock,stock_count')
            ->where('basket_id', $basketId)->get();
        $totalPrice = 0;

        //

        foreach ($products as $product) {
            $totalPrice += $product->stock_count * $product->product->price;
        }
        return view('cart.index',compact('products','totalPrice'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $basketId = $user->basket->id;
        $product = Product::find($request->product_id);
        //Productun ozunu yoxlamaq
        if ($product) {
            //Productun stokda olub olmadigini yoxlamaq
            if ($product->has_stock) {
                //Productun stok sayini istifadecinin sebetinde yoxlamaq
                $basket = BasketProduct::where('basket_id', $basketId)
                    ->where('product_id', $product->id)->first();

                if ($basket == null) {
                    $basketItems = new BasketProduct();
                    $basketItems->basket_id = $basketId;
                    $basketItems->product_id = $product->id;
                    $basketItems->stock_count = 1;
                    $basketItems->save();
                    return redirect()->back()->with('success', 'Product added to cart');
                } else {
                    //Productun stock sayini sebetle muqayise etmek
                    //4+1 5
                    if ($basket->stock_count + 1 > $product->stock_count) {
                        return redirect()->back()->withErrors('Stok sayindan artiq elave etmek olmaz');
                    } else {
                        $basket->stock_count += 1;
                        $basket->save();
                        return redirect()->back()->with('success', 'Product added to cart');
                    }
                }

            } else {
                return redirect()->back()->withErrors('Product out of stock');
            }

        } else {
            return redirect()->back()->withErrors('Product not found');
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $basketId = auth()->user()->basket->id;
        $basket = BasketProduct::where('basket_id', $basketId)
            ->where('product_id', $request->product_id)->first();

        if ($basket) {
            $basket->delete();
            return redirect()->back()->with('success', 'Product deleted from cart');
        }
        return redirect()->back()->withErrors('Product not found in cart');
    }

    public function decrease(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $basketId = auth()->user()->basket->id;
        $basket = BasketProduct::where('basket_id', $basketId)
            ->where('product_id', $request->product_id)->first();
        if ($basket->stock_count - 1 > 0) {
            $basket->stock_count -= 1;
            $basket->save();
            return redirect()->back()->with('success', 'Product deleted from cart');
        }
    }

    public function checkout()
    {
        return view('cart.checkout');
    }
}
