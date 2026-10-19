@extends('layout.app')

@section('content')
    <div class="container py-5">

        <!-- Tampilkan Judul Kategori yang Sedang Diakses -->
        <div class="d-flex">
            <h2 class="mb-4 fw-bold">
                @if ($category)
                    Kategori: {{ $category->name }}
                @else
                    Semua Kategori Buku
                @endif
            </h2>

            <div class="justify-content-end ms-auto d-flex">
                <form action="{{ route('books.category', $category ? $category->id : null) }}" method="GET"
                    class="input-icon justify-content-end ms-auto py-2">
                    <!-- Search Bar -->
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari judul buku atau penulis..." value="{{ request('search') }}">
                    </div>

                    <!-- Dropdown Sorting -->
                    <div class="d-flex justify-content-end mt-3">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="">Urutkan Berdasarkan...</option>
                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah
                            </option>
                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Termahal
                            </option>
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Buku Terbaru
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <!-- Konten Utama: Daftar Buku -->
        <div class="row g-3">
            @forelse($books as $book)
                <div class="col-md-2 col-sm-4 col-6 mb-3"> <!-- Kolom kecil agar memanjang menyamping seperti referensi -->
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
                        <!-- Sampul Buku -->
                        <div class="p-2 text-center" style="background-color: #f8f9fa;">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="img-fluid"
                                style="max-height: 180px; object-fit: contain; width: auto;" alt="Cover">
                        </div>

                        <div class="card-body p-2 d-flex flex-column">
                            <!-- Badge PDF -->
                            <div class="mb-1">
                                <span class="badge bg-light text-dark border"><i
                                        class="fa-solid fa-file-pdf text-danger me-1"></i>PDF</span>
                            </div>

                            <!-- Penulis (Kecil) -->
                            <small class="text-muted d-block text-truncate"
                                style="font-size: 0.7rem;">{{ $book->writer ?? 'Penulis' }}</small>

                            <!-- Judul Buku (Dua baris max) -->
                            <h6 class="fw-bold mt-1 text-dark text-truncate"
                                style="font-size: 0.85rem; max-height: 2.5rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; white-space: normal;">
                                {{ $book->title }}
                            </h6>

                            <!-- Harga -->
                            <h6 class="fw-bold mt-auto pt-2 mb-0" style="font-size: 0.9rem;">
                                Rp{{ number_format($book->price, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada buku yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $books->links() }}
        </div>

    </div>
@endsection
