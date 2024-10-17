@extends('dashboard.layouts.master')
@section('content')
    <div class="container px-4">
        <div class="row p-5">
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    @isset($orders)
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $order->uid }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $order->uid }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                            {{ $order->uid }} - {{ $order->user->name }}
                                            - {!! \App\Helper\OrderStatus::order_status_converter($order->status) !!}
                                            - {{ $order->created_at }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $order->uid }}" class="accordion-collapse collapse show"
                                         aria-labelledby="heading-{{ $order->uid }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Product Name</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order->order_detail as $orderDetail)
                                                            <tr>
                                                                <td>{{ $orderDetail->product->title }}</td>
                                                                <td>{{ $orderDetail->quantity }}</td>
                                                                <td>{{ $orderDetail->price }}</td>
                                                                <td>{{ $orderDetail->total }}</td>
                                                            </tr>
                                                        @endforeach

                                                        <tr>
                                                            @if($order->status == \App\Helper\OrderStatus::PENDING)
                                                                <td colspan="1" class="text-end">Actions</td>
                                                                <td>
                                                                    <form action="{{ route('dashboard.order.confirmed',['id'=>$order->id]) }}"
                                                                          method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-outline-success">Confirm
                                                                        </button>
                                                                    </form>

                                                                </td>

                                                            @elseif($order->status == \App\Helper\OrderStatus::CONFIRMED)
                                                                <td colspan="2" class="text-end">Actions</td>
                                                                <td>
                                                                    <form action="{{ route('dashboard.order.shipped',['id'=>$order->id]) }}"
                                                                          method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-outline-success">SHIPPED
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            @elseif($order->status == \App\Helper\OrderStatus::SHIPPED)
                                                                <td colspan="2" class="text-end">Actions</td>
                                                                <td>
                                                                    <form action="{{ route('dashboard.order.delivered',['id'=>$order->id]) }}"
                                                                          method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                                class="btn btn-outline-success">
                                                                            DELIVERED
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            @endif

                                                            <td colspan="1" class="text-end">Total</td>
                                                            <td>{{ $order->total }}</td>
                                                        </tr>
                                                        <tr>

                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection