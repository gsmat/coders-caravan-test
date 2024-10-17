@php use Illuminate\Support\Facades\Storage; @endphp
@extends('dashboard.layouts.master')
@section('content')

    <div class="container">
        <div class="row p-5">
            <div class="col-md-12">
                <table class="table table-hover" border="1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Basket Count</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($products)
                        @if(count($products)> 0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->product->title }}</td>
                                    <td>{{ $product->product->price }}</td>
                                    <td>
                                        <img width="100" height="100" src="{{ Storage::url($product->product->image) }}"
                                             alt="">
                                    </td>
                                    <td>
                                        {{$product->stock_count}}
                                    </td>
                                    <td style="display: flex">
                                        <form method="post" action="{{ route('user.basket.delete') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <button class="btn btn-danger" type="submit">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        <form style="margin-left: 10px" method="post" action="{{ route('user.basket.decrease') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <button
                                                    @if($product->stock_count == 1) disabled @endif
                                            class="btn btn-danger" type="submit">-</button>
                                        </form>
                                        <form style="margin-left: 10px" method="post" action="{{ route('user.basket.store') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                            <button class="btn btn-success" type="submit">
                                                +
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5">No product found</td>
                            </tr>
                        @endif
                    @endisset
                    </tbody>
                </table>
            </div>

            @if(count($products)> 0)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Cart Summary</h3>
                        </div>
                        <div class="card-body">
                            <p>Total Price: $ {{ $totalPrice }}</p>
                            <a href="{{ route('user.basket.checkout') }}" class="btn btn-success">Checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

@endsection