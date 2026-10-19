<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::with('bookCategory')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = BookCategory::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_category_id' => 'required|exists:book_categories,id',
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'language' => 'required|string',
            'release_date' => 'required|date',
            'page_of_book' => 'required|integer|min:1',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'book_category_id' => $request->book_category_id,
            'title' => $request->title,
            'writer' => $request->writer,
            'publisher' => $request->publisher,
            'price' => $request->price,
            'language' => $request->language,
            'release_date' => $request->release_date,
            'page_of_book' => $request->page_of_book,
            'cover' => $coverPath,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.books.index')->with('success', 'Buku Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // 1. Cari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // 2. Validasi inputan dari form
        $validatedData = $request->validate([
            'book_category_id' => 'required',
            'title'        => 'required|string|max:255',
            'writer'       => 'required|string|max:255',
            'publisher'    => 'required|string|max:255',
            'price'        => 'required|numeric',
            'language'     => 'required|string',
            'release_date' => 'required|date',
            'page_of_book' => 'required|integer',
            'description'  => 'required',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Cover boleh kosong saat edit
        ]);

        // 3. Cek apakah ada file cover baru yang diunggah
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            // Simpan cover baru ke folder storage/app/public/books (bisa disesuaikan foldernya)
            $validatedData['cover'] = $request->file('cover')->store('books', 'public');
        }

        // 4. Update data ke database
        $book->update($validatedData);

        // 5. Kembalikan halaman ke daftar buku dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('succes', 'Buku Berhasil Dihapus!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = BookCategory::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }
}
