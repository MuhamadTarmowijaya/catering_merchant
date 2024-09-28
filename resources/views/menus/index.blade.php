@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Menu</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>
        <div class="row">
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
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
