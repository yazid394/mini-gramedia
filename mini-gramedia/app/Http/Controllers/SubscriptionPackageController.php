<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class SubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // all : mengambil semua data dari model BookCategori dan menyimpannya kedalam variabel $book-categories
        $subscriptionPackages = SubscriptionPackage::all();
        // compact : membuat array asosiatid dengan key 'bookCategorys' dan value $bookCategorys,
        // kemudian menhgirimkannya ke view 'admin.book-categories.index'
        return view('admin.subscription-packages.index', compact('subscriptionPackages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscription-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string', 'max:225'],
            'color' => ['required', 'string', 'max:225'],
            'price' => ['required', 'numeric'],
        ]);

        SubscriptionPackage::create($validateData);
        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket langganan berhasil ditambahkan');
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
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);
        return view('admin.subscription-packages.edit', compact('subscriptionPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subscriptionPackage = SubscriptionPackage::findorFail($id);

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string', 'max:225'],
            'color' => ['required', 'string', 'max:225'],
            'price' => ['required', 'numeric',],
        ]);

        $subscriptionPackage->update($validateData);
        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket langganan berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        $subscriptionPackage->delete();
        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket langganan telah berhasil dihapus');
    }
}
