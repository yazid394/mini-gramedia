<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // all : mengambil semua data dari model BookCategori dan menyimpannya kedalam variabel $book-categories
        $bookCategorys = BookCategory::all();
        // compact : membuat array asosiatid dengan key 'bookCategorys' dan value $bookCategorys,
        // kemudian menhgirimkannya ke view 'admin.book-categories.index'
        return view('admin.book-categories.index', compact('bookCategorys'));
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
