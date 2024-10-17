@extends('dashboard.layouts.master')

@section('content')

    <div class="container">
        <h1 class="my-4">{{ $product->title }}</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->title }}">
            </div>
            <div class="col-md-6">
                <h2>Details</h2>
                <p>{{ $product->content }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <p><strong>Stock:</strong> {{ $product->stock_count }}</p>
                <p><strong>Available:</strong> {{ $product->has_stock ? 'Yes' : 'No' }}</p>
                @if($hasBasket)
                    <form method="post" action="{{ route('user.basket.delete') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-danger" type="submit">Remove From Cart</button>
                    </form>

                    <div>
                        <p>Avaliable in basket: {{ $basket->stock_count }}</p>
                    </div>

                    <form method="post" action="{{ route('user.basket.decrease') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button
                                @if($basket->stock_count == 1) disabled @endif
                        class="btn btn-danger" type="submit">Decrease</button>
                    </form>
                @endif
                <form method="post" action="{{ route('user.basket.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-success" type="submit">
                       @if($hasBasket)
                            @if($basket->stock_count > 0)
                                Increase
                            @else
                                Add to Cart
                            @endif
                        @else
                            Add to Cart
                       @endif
                    </button>
                </form>
                <a href="" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>

@endsection
