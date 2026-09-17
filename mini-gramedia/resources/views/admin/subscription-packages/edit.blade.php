@extends('layout.app')

@section('content')
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-header">
            <h1>Edit</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.subscription-packages.update', $subscriptionPackage->id) }}" method="POST">
                @csrf
                {{-- overide method : mengganti method="POST" menjadi PUT sesuai dengan HTTP method yang ada di routenya --}}
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Paket Langganan</label>
                    {{-- old('name', $bookCategory->name) : jika terjadi error validasi, tampilkan nilai sebelumnya pada inputan ini,
                    jika tidak ada, tampilkan nilai dari $bookCategory->name --}}
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid
                        @enderror"
                        value="{{ old('name', $subscriptionPackage->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" name="description" id="description"
                        class="form-control @error('description') is-invalid
                        @enderror"
                        value="{{ old('description', $subscriptionPackage->description) }}" required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="color" class="form-label">Warna</label>
                    <input type="text" name="color" id="color"
                        class="form-control @error('color') is-invalid
                        @enderror"
                        value="{{ old('color', $subscriptionPackage->color) }}" required>
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" name="price" id="price"
                        class="form-control @error('price') is-invalid
                        @enderror"
                        value="{{ old('price', $subscriptionPackage->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
