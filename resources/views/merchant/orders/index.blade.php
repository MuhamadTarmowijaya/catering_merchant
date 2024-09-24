@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Delivery Date</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->menu->name }}</td>
                        <td>{{ $order->customer->company_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>{{ $order->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
