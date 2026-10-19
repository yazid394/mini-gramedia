@extends('layout.app')

@section('content')
    <div class="container-fluid p-4">
        <div class="card p-4 shadow-sm">
            <h5 class="mb-4">Edit Buku</h5>

            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    {{-- kategri --}}
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="book_category_id" class="form-select @error('book_category_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('book_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- judul --}}
                    <div class="col-md-6">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $book->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- penulis --}}
                    <div class="col-md-6">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="writer" class="form-control @error('writer') is-invalid @enderror"
                            value="{{ old('writer', $book->writer) }}">
                        @error('writer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- penerbit --}}
                    <div class="col-md-6">
                        <label class="form-label">Penerbit</label>
                        <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror"
                            value="{{ old('publisher', $book->publisher) }}">
                        @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- harga --}}
                    <div class="col-md-6">
                        <label class="form-label">Harga</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $book->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- bahasa --}}
                    <div class="col-md-6">
                        <label class="form-label">Bahasa</label>
                        <select name="language" class="form-select @error('language') is-invalid @enderror">
                            <option value="">Pilih Bahasa</option>
                            <option value="Indonesia"
                                {{ old('language', $book->language) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Inggris" {{ old('language', $book->language) == 'Inggris' ? 'selected' : '' }}>
                                Inggris</option>
                        </select>
                        @error('language')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- tangal rilis --}}
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Rilis</label>
                        <input type="date" name="release_date"
                            class="form-control @error('release_date') is-invalid @enderror"
                            value="{{ old('release_date', $book->release_date) }}">
                        @error('release_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- jumlha halaman --}}
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Halaman</label>
                        <input type="number" name="page_of_book"
                            class="form-control @error('page_of_book') is-invalid @enderror"
                            value="{{ old('page_of_book', $book->page_of_book) }}">
                        @error('page_of_book')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- sampul --}}
                <div class="mb-3">
                    <label class="form-label">Sampul Buku</label>

                    <!-- Memunculkan gambar sampul yang lama -->
                    @if ($book->cover)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Sampul Lama"
                                style="height: 120px; border-radius: 5px; object-fit: cover;">
                        </div>
                    @endif

                    <input type="file" name="cover" id="cover"
                        class="form-control @error('cover') is-invalid @enderror">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti sampul.</small>

                    @error('cover')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary float-end">Update Buku</button>
            </form>
        </div>
    </div>
@endsection
