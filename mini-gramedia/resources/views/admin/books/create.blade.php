@extends('layout.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card p-4 shadow-sm">
        <h5 class="mb-4">Tambah Buku</h5>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                {{--kategri--}}
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="book_category_id" class="form-select @error('book_category_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('book_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{--judul--}}
                <div class="col-md-6">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                {{--penulis--}}
                <div class="col-md-6">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="writer" class="form-control @error('writer') is-invalid @enderror" value="{{ old('writer') }}">
                    @error('writer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{--penerbit--}}
                <div class="col-md-6">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}">
                    @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                {{--harga--}}
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{--bahasa--}}
                <div class="col-md-6">
                    <label class="form-label">Bahasa</label>
                    <select name="language" class="form-select @error('language') is-invalid @enderror">
                        <option value="">Pilih Bahasa</option>
                        <option value="Indonesia" {{ old('language') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Inggris" {{ old('language') == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                    </select>
                    @error('language') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                {{--tangal rilis--}}
                <div class="col-md-6">
                    <label class="form-label">Tanggal Rilis</label>
                    <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date') }}">
                    @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{--jumlha halaman--}}
                <div class="col-md-6">
                    <label class="form-label">Jumlah Halaman</label>
                    <input type="number" name="page_of_book" class="form-control @error('page_of_book') is-invalid @enderror" value="{{ old('page_of_book') }}">
                    @error('page_of_book') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{--sampul--}}
            <div class="mb-3">
                <label class="form-label">Sampul Buku</label>
                <input type="file" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror">
                @error('cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{--deskripsi--}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary float-end">Simpan Buku</button>
        </form>
    </div>
</div>
@endsection
