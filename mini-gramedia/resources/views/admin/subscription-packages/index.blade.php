@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Tambah Paket Langganan</h2>
            <a href="{{ route('admin.subscription-packages.create') }}" class="btn btn-primary mb-3">Tambah kategori Paket Langganan</a>
        </div>
        @if (@session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="container card">
        <div class="card-body">
            <table class="table table-bordered table-responsive bg-white" id="subscription-packages-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#subscription-packages-table").DataTable({
                // menampilkan icon looading
                processing: true,
                // menggunakan server side (data diproses di controller)
                serverSide: true,
                // routing yang memproses datatables
                ajax: "{{ route('admin.subscription-packages.index') }}",
                // isi td dari tablenya
                columns: [
                    // data dan name : nama kolom, searchable: bisa di search ga datanya, orderable: bisa di urutin ga datanya
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'color',
                        name: 'color',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            })
        });
    </script>
@endpush
