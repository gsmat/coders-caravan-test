<?php

namespace App\Http\Controllers\Api;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        $products = Product::where('has_stock', true)
            ->when($request->price != null,function ($query) use ($request) {
                    return $query->where('price', (int)$request->price);
                })
            ->when($request->order, function ($query) use ($request) {
                return $query->orderBy('price', $request->order);
            })
            ->get();
        return Response::success($products, 'Products listed');
    }

    public function product($id){
        $product = Product::find($id);
        if(!$product){
            return Response::error([],'Product not found',404);
        }
        return Response::success($product,'Product info',200);

    }
}
