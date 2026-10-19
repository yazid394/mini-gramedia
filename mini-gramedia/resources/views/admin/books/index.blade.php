@extends('layout.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Buku</h4>
        <a href="{{ route('admin.books.create') }}" class="btn btn-success">Tambah Buku</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-3 shadow-sm">
        <div class="table-responsive">
            <table id="table-buku" class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">SAMPUL BUKU</th>
                        <th>JUDUL</th>
                        <th>KATEGORI</th>
                        <th>HARGA</th>
                        <th width="20%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $key => $book)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Sampul" style="max-height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->bookCategory->name ?? '-' }}</td>
                            <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                            <td>

                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $book->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $book->id }}">Detail buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="row mb-3">

                                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                                @if($book->cover)
                                                    <img src="{{ asset('storage/' . $book->cover) }}" class="img-fluid rounded shadow-sm" alt="Sampul" style="max-height: 250px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                                                        <span class="text-muted">No Image</span>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-md-8">
                                                <h5 class="fw-bold text-primary mb-2">{{ $book->title }}</h5>
                                                <span class="badge bg-primary mb-3">{{ $book->bookCategory->name ?? 'Tanpa Kategori' }}</span>

                                                <div class="row">
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Harga</small>
                                                        <span class="text-success fw-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Penulis</small>
                                                        <strong>{{ $book->writer }}</strong>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Penerbit</small>
                                                        <strong>{{ $book->publisher }}</strong>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Bahasa</small>
                                                        <strong>{{ $book->language }}</strong>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Tanggal Rilis</small>
                                                        <strong>{{ \Carbon\Carbon::parse($book->release_date)->format('d M Y') }}</strong>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">Jumlah Halaman</small>
                                                        <strong>{{ $book->page_of_book }} Halaman</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>


                                        <div>
                                            <small class="text-muted fw-bold d-block mb-1">DESKRIPSI BUKU</small>
                                            <div class="p-3 bg-light rounded border text-secondary" style="min-height: 100px;">
                                                {{ $book->description }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-start">
                                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3 text-muted">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table-buku').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>
@endpush
