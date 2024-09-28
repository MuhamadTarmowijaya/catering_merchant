@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard Merchant</h1>
        <a href="{{ route('menus.index') }}" class="btn btn-primary">Manage Menus</a>
    </div>
@endsection
