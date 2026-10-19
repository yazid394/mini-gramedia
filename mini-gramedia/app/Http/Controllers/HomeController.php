<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subscriptionPackages = SubscriptionPackage::latest()->take(3)->get();
        $latestBooks = Book::orderBy('created_at', 'desc')->limit(10)->get();
        $freeBooks = Book::where('price', 0)->orderBy('created_at', 'desc')->limit(6)->get();

        return view('home', compact('subscriptionPackages', 'latestBooks', 'freeBooks'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('writer', 'like', '%' . $query . '%')
            ->get();

        return view('search_result', compact('books', 'query'));
    }

    public function byCategory(Request $request, $id = null)
    {
        // Ngambil semua data kategori dari database buat ditampilin di menu dropdown/sidebar
        $categories = BookCategory::latest()->get();

        // Siapin query bawaan buat narik semua buku sekalian bawa data relasi kategorinya
        $query = Book::with('bookCategory');
        $category = null;

        // Cek nih, user lagi nge-klik kategori tertentu gak (ada ID-nya gak di URL)?
        if ($id) {
            // Kalo ada, kita cari tau detail kategorinya buat ditampilin judulnya di halaman nanti
            $category = BookCategory::find($id);

            if ($category) {
                // Nah ini yang paling penting: saring bukunya biar yang keluar cuma yang ID kategorinya cocok sama yang diklik
                $query->where('book_category_id', $id);
            }
        }

        // Lanjut ngecek fitur search. Kalau user ngetik sesuatu di kolom pencarian...
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            // Cari buku yang judul ATAU nama penulisnya ngandung kata kunci yang diketik tadi
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('writer', 'like', '%' . $searchTerm . '%');
            });
        }

        // Cek lagi, user milih urutan dari dropdown gak?
        if ($request->has('sort') && $request->sort != '') {
            if ($request->sort == 'termurah') {
                // Kalo milih termurah, urutin harga dari bawah ke atas
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'termahal') {
                // Kalo termahal, urutin harga dari atas ke bawah
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'terbaru') {
                // Kalo terbaru, urutin berdasarkan tanggal rilisnya (dari yang paling fresh)
                $query->orderBy('release_date', 'desc');
            }
        } else {
            // Kalo user diem aja alias gak milih urutan, by default kita tampilin yang paling baru aja
            $query->latest();
        }

        // Udah selesai nih nyusun filternya, sekarang tinggal eksekusi narik datanya dan batesin 12 buku per halaman
        // Pake withQueryString() biar kalo kita ngeklik pindah ke page 2, 3, dst, filter search/sort-nya gak kereset atau ilang
        $books = $query->paginate(12)->withQueryString();

        // Terakhir, lempar semua datanya (daftar kategori, info kategori yg lagi dibuka, sama hasil bukunya) ke file blade
        return view('category_select', compact('category', 'books'));
    }
}
