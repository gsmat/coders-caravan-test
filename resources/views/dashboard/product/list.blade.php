@php use Illuminate\Support\Facades\Storage; @endphp
@extends('dashboard.layouts.master')
@section('content')

    <div class="container">
        <h1 class="my-4">Products</h1>
        @isset($products)
            @if (count($products))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                                     style="width: 50px; height: 50px;"></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->content }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ $product->stock_count }}</td>
                            <td>
                                <a href="{{ route('dashboard.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('dashboard.delete', $product->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No products available.</p>
            @endif
        @endisset
    </div>

@endsection
