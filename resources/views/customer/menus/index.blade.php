@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Menu</h1>

        <!-- Form Pencarian -->
        <form action="{{ route('customer.menus.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari menu atau nama katering...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <!-- Daftar Menu -->
        <div class="row">
            @if ($menus->count())
                @foreach ($menus as $menu)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            @if ($menu->photo)
                                <img src="{{ Storage::url($menu->photo) }}" class="card-img-top" alt="{{ $menu->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <p class="card-text">Rp{{ number_format($menu->price, 2) }}</p>
                                <a href="{{ route('customer.cart.add', $menu->id) }}" class="btn btn-primary">Tambah ke
                                    Keranjang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Menu tidak ditemukan.</p>
            @endif
        </div>
    </div>
@endsection
