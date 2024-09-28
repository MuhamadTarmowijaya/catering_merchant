@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profile Merchant</h1>
        <form action="{{ route('merchant.profile.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company_name">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    value="{{ $merchant->company_name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control">{{ $merchant->description ?? '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" id="address" class="form-control"
                    value="{{ $merchant->address ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="contact">Kontak</label>
                <input type="text" name="contact" id="contact" class="form-control"
                    value="{{ $merchant->contact ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
