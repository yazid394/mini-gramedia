@extends('layout.app')
@section('content')
    <div class="card mt-5 w-50 d-block mx-auto">
        <div class="card-header">
            <h3>Tambah Paket Langganan</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.subscription-packages.store') }}" method="POST">
                {{-- setiap form harus memiliki method post/get selain itu gunakan fungsi @method() --}}
                @csrf
                {{-- csrf digunakan untuk mencegah request yang tidak sah --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Paket Langganan</label>
                    <input type="text" class="form-control @error('name')
                        is-invalid
                    @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('description')
                        is-invalid
                    @enderror" id="description" name="description" value="{{ old('description') }}" required>
                    <label for="color" class="form-label">Warna</label>
                    <input type="color" class="form-control @error('color')
                        is-invalid
                    @enderror" style="width: 60px; height: 40px; padding: 0;" id="color" name="color" value="{{ old('color') }}" required>
                    <label for="nprice" class="form-label">Harga</label>
                    <input type="number" class="form-control @error('price')
                        is-invalid
                    @enderror" id="price" name="price" value="{{ old('price') }}" required>
                    {{-- setiap inputan wajib mempunyai atribut name yang digunakan unutk memberikan value
                    yang nntinya akan dikirim ke controller --}}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
