<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // request->ajax() jika ada permintaan dari ajac javascript. permintaan proses datatables dipanggi melalui ajax javasciript di bladenya
        if ($request->ajax()) {
            $model = BookCategory::query();

            return DataTables::eloquent($model)
            // menambahkan nomor urut data 1-2-dst
            ->addIndexColumn()
            // menambhakna data sealin yang ada di database : mengubah data atau untuk btn aksi
            ->addColumn('action', function($data){
                $editUrl = route('admin.book-categories.edit', $data->id);
                $deleteUrl = route('admin.book-categories.destroy', $data->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                $btnEdit = '<a href="'. $editUrl . '"class="btn btn-sm btn-warning">Edit</a>';
                $btnDelete = '<form action="'. $deleteUrl .'"method="POST"
                    class="d-inline">'. $csrf . $method .'<button tupe="submit"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin ingin menghapus
                    kategori ini?\')">Hapus</button>
                    </form>';

                return $btnEdit . $btnDelete;
            })
            // menyimpan nama dari add column yang ada html di dalemnya
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('admin.book-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.book-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:225'],
        ]);

        BookCategory::create($validateData);
        return redirect()->route('admin.book-categories.index')->with('succes', 'Kategori buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // finOrfail : mencari data berdasarkan id, jika tidak ditemukan akan menampilkan error 404
        // atau bisa digunakan find() untuk mencari data berdasarkan id, jika tidak ditemukan akan mengembalikan null
        $bookCategory = BookCategory::findOrFail($id);
        return view('admin.book-categories.edit', compact('bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookCategory = BookCategory::findorFail($id);

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:225'],
        ]);

        $bookCategory->update($validateData);
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku te;ah berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        $bookCategory->delete();
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku tela berhasil di hapus');
    }
}
