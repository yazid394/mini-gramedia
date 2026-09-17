@extends('layout.app')
@section('content')
    {{-- arahkan submit form ke route yg namanya register.store --}}
    <form action="{{ route('register.store') }}" method="POST" class="form-fieldset w-50 bg-white mx-auto mt-5">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Full name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" value="{{ old('name') }}" />
            @error('name')
            {{-- memanggil err validasi @error('nama_input') --}}
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off" value="{{ old('email') }}" />
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" value="{{ old('password') }}" />
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Kofirmasi Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" value="{{ old('password_confirmation') }}" />
        </div>
        <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
    </form>
@endsection
