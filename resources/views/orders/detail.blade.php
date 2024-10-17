@extends('dashboard.layouts.master')
@section('content')
    <div class="container px-4">
        <div class="row p-5">
            <div class="col-md-12">
                <h1>Order: {{ $orderUid->uid }}</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                        @isset($orderDetails)
                            @if(count($orderDetails)>0)
                                @foreach($orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{$orderDetail->product->title}}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$orderDetail->product->image) }}" alt="" style="width: 100px;">
                                        </td>
                                        <td>{{$orderDetail->price}}</td>
                                        <td>{{$orderDetail->quantity}}</td>
                                        <td>{{$orderDetail->total}}</td>
                                        <td>{{$orderDetail->created_at}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection