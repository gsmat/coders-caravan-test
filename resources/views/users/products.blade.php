@extends('dashboard.layouts.master')
@section('content')

<div class="container">
    <h1 class="my-4">Products</h1>
    <div class="row">
        @isset($products)
        @if (count($products))
        @foreach ($products as $product)
        @if ($product->stock_count >= 1) <!-- Stok sayı 1 və ya daha çox olan məhsulları göstər -->
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <p class="card-text">{{ $product->content }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock_count }}</p>
                    
                    <a href="" class="btn btn-success">Add to Cart</a>
                    <a href="{{ route('user.show', $product->id) }}" class="btn btn-info">Detail</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @else
            <p>No products available.</p>
        @endif
        @endisset
    </div>
</div>
@endsection
