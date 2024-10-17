@extends('dashboard.layouts.master')
@section('content')
    <div class="container">
        <div class="row p-5">
            <form action="{{route('user.order.add')}}" method="post">
                @csrf
                <div class="col-md-8 m-2 p-3">
                    <h3>Address</h3>
                    <input class="form-control" type="text" name="address">
                </div>
                <div class="col-md-8 m-2 p-3">
                    <h3>Payment Types</h3>
                    <select class="form-control" name="payment_type">
                        <option value="card">Credit Card</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
                <div class="col-md-8 m-2 p-3">
                    <h3>Note</h3>
                    <input class="form-control" type="text" name="note">
                </div>

                <div class="col-md-3 m-2 p-3">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection