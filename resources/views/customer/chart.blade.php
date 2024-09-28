@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Keranjang Belanja</h1>
        @if (session('cart'))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart') as $id => $details)
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>Rp{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                            <td>
                                <a href="{{ route('customer.cart.remove', $id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <a href="{{ route('customer.checkout') }}" class="btn btn-success">Checkout</a>
            </div>
        @else
            <p>Keranjang kosong.</p>
        @endif
    </div>
@endsection
