@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Menus</h1>
        <a href="{{ route('merchant.menus.create') }}" class="btn btn-primary mb-3">Add Menu</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>
                            @if ($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" width="100">
                            @endif
                        </td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>
                            <a href="{{ route('merchant.menus.edit', $menu->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('merchant.menus.destroy', $menu->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
