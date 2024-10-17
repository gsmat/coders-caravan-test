@extends('dashboard.layouts.master')
@section('content')

    <div class="container px-4">
        <div class="row p-5">
            <div class="col-md-12">
                <h1>My Orders</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Address</th>
                        <th>Payment Type</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                        @if(count($orders)>0)
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->uid}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->payment_type}}</td>
                                    <td>{{$order->note}}</td>
                                    <td>{!! \App\Helper\OrderStatus::order_status_converter($order->status) !!}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                        @if($order->status == \App\Helper\OrderStatus::PENDING)
                                            <form action="{{ route('user.order.cancel',['id' => $order->id]) }}"
                                                  method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Canceled</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('user.order.detail',['id' => $order->id]) }}">
                                            <button class="btn btn-outline-primary">View</button>
                                        </a>
                                    </td>
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