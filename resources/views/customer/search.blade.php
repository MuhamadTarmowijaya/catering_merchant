@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Catering Services</h1>
        <form action="{{ route('customer.search') }}" method="GET">
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" class="form-control">
            </div>

            <div class="form-group">
                <label for="menu">Menu</label>
                <input type="text" name="menu" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="mt-5">
            <h3>Search Results:</h3>
            @if ($results)
                <ul>
                    @foreach ($results as $result)
                        <li>{{ $result->company_name }} - {{ $result->menu_name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No catering services found.</p>
            @endif
        </div>
    </div>
@endsection
