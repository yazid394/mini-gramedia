<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // request->ajax() jika ada permintaan dari ajac javascript. permintaan proses datatables dipanggi melalui ajax javasciript di bladenya
        if ($request->ajax()) {
            $model = SubscriptionPackage::query();
    
            return DataTables::eloquent($model)
            // menambahkan nomor urut data 1-2-dst
            ->addIndexColumn()
            // menambhakna data sealin yang ada di database : mengubah data atau untuk btn aksi
            ->addColumn('action', function($data){
                $editUrl = route('admin.subscription-packages.edit', $data->id);
                $deleteUrl = route('admin.subscription-packages.destroy', $data->id);
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
        return view('admin.subscription-packages.index');
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
