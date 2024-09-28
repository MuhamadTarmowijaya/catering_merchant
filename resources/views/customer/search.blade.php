@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Pencarian Katering</h1>
        <form method="GET" action="{{ route('search.catering') }}">
            <input type="text" name="location" placeholder="Lokasi" class="form-control mb-2">
            <input type="text" name="food_type" placeholder="Jenis Makanan" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <div class="mt-4">
            @foreach ($merchants as $merchant)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $merchant->company_name }}</h5>
                        <p class="card-text">{{ $merchant->address }}</p>
                        <a href="{{ route('merchant.menus', $merchant->id) }}" class="btn btn-primary">Lihat Menu</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
