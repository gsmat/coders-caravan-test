<?php

namespace App\Http\Controllers;

use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('dashboard.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'price' => 'required|numeric',
            'stock_count' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $has_stock = $request->has('has_stock') ? 1 : 0;

        $product = new Product();
        $product->title = $request->title;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->stock_count = $request->stock_count;
        $product->has_stock = $has_stock;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('dashboard.list')->with('success', 'Product updated successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('dashboard.product.edit', compact('product'));
    }

    public function list()
    {
        $products = Product::all();
        return view('dashboard.product.list', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->title = $request->input('title');
        $product->content = $request->input('content');
        if ($request->has('image')) {
            $product->image = $request->input('image');
        }
        $product->price = $request->input('price');
        $product->stock_count = $request->input('stock_count');
        $product->has_stock = $request->input('has_stock', true);

        $product->save();

        return redirect()->route('dashboard.list')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('dashboard.list')->with('success', 'Product deleted successfully');
    }

    public function products()
    {
        $products = Product::all();
        return view('users.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        $basketId = $user->basket->id;
        $hasBasket = false;
        $basket = BasketProduct::where('basket_id', $basketId)
            ->where('product_id', $product->id)->first();

        if($basket){
            $hasBasket = true;
            return view('users.detail', compact('product','hasBasket','basket'));
        }
        else{
            return view('users.detail', compact('product','hasBasket'));
        }
    }
}
