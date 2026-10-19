@extends('layout.app')

@section('content')
    <div class="container py-4">
        <h4> Hasil Pencarian : {{ $query }}</h4>

        @if ($books->isEmpty())
            <p>Tidak ada hasil yang ditemukan</p>
        @else
            <div class="row mt-3">
                @forelse ($books as $book)
                    <div class="col-md-3 px-2">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="Book Cover">
                                <div class="d-flex gap-2 mb-2">
                                    <span class="badge bg-blue-lt"><i class="fa-solid fa-mobile me-1"></i>PDF</span>
                                    <span class="badge bg-secondary-lt">3+</span>
                                </div>
                                <div>
                                    <h5><span style="font-size: 0.8rem" class="text-secondary">{{ $book->author }}</span>
                                        <br><span style="font-size: 1rem">{{ $book->title }}</span>
                                    </h5>
                                    <h4 style="font-size: 1.2rem; font-weight:bold">Rp
                                        {{ number_format($book->price, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada buku terbaru yang tersedia.</p>
                @endforelse
            </div>
        @endif
    </div>
@endsection

