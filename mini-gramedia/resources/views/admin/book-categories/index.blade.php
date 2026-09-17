@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Tambah Kategori Buku</h2>
            <a href="{{ route('admin.book-categories.create') }}" class="btn btn-primary mb-3">Tambah kategori Buku</a>
        </div>
        @if (@session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="container card">
        <div class="card-body">
            <table class="table table-bordered table-responsive bg-white">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookCategorys as $bookCategory)
                        {{-- penggunaan foreach karena bookCategories merupakan array multidimensi maka bookCategry akan berupa array asosiatif.
                        mengaksesnya dengan menggunakan -> atau --}}
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- loop iteration-> fungsinyay untuk menampilkan no urut --}}
                            <td>{{ $bookCategory->name }}</td>
                            <td>
                                <a href="{{ route('admin.book-categories.edit', $bookCategory->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.book-categories.destroy', $bookCategory->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button tupe="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
