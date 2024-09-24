@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Invoice</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>Customer Information</h4>
                <p>{{ $order->customer->company_name }}</p>
                <p>{{ $order->customer->address }}</p>
            </div>
            <div class="col-md-6">
                <h4>Order Details</h4>
                <p>Menu: {{ $order->menu->name }}</p>
                <p>Quantity: {{ $order->quantity }}</p>
                <p>Total Price: {{ $order->total_price }}</p>
            </div>
        </div>

        <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-primary">Download Invoice</a>
    </div>
@endsection
