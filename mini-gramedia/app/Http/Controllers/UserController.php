<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            // 'nama_input' => ['jenis_validasi']
            'name' => ['required', 'min:3'],
            // unique:table, field : data email tidak boleh duplikat
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            // confirmed : di form ada inputan "konfirmasi password"
            // uncompromised : mengecek pw yang dibuat apakah sudah pernah dibobol
            'password' => ['required', 'min:8', 'max:10', 'confirmed', Password::min(8)->max(10)->uncompromised()]
        ],[
            // teks err yang bakal numcul kalau validasi gaggal
            // 'nama_input.jenis_validasi' => 'pesan'
            'name.required' => 'Nama Lengkap harus diisi',
            'name.min' => 'Nama Lengkap harus diisi minimal 3 karakter',
            'email.required' => 'Email harus di isi',
            'email.unique' => 'Email harus di isi dengan data yang belulm terdaftar',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password harus diisi minimal 8 karakter',
            'password.max' => 'Password harus diisi hanya sampai 10 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password yang diberikan',
        ]);

        // simpan data ke database melalui moder
        $createAccount = User::create([
            // nama field => isi data
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // hash::make -> mengubah pw plain text mejadi karakter acak yang tidak bisa dibaca/dikembalikan ke text aslinya
            'password' => Hash::make($validatedData['password'])
        ]);
        // menentukan jika berhasil disimpan akan di arahkan ke halaman mana : return redirect()->route()
        // mengirimkan session untuk notifikasi/info berhasil : with('nama', 'pesan')
        return redirect()->route('login')->with('success', 'Berhasil membuat akun! silahkan login.');
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
        // dd($request->all())
        // untuk proess auth ambil data selain _token (email & password aja)
        $auth = $request->except(['_token']);
        // // auth::atempt :
        // // 1. cek pasangan email-pw beneratau salah
        // // 2. kalau bener, simpan data di session
        // // 3. kalau salah, tentukan aksi yang akan dilakukan
        // $checkAuth = Auth::attempt($auth);
        // if ($checkAuth) {
        //     // bikin ulang ID session
        //     $request->session()->regenerate();
        //     return redirect()->route('home')->with('success', 'Berhasil Login!');
        // } else {
        //     // withInput()-> mengirim old (data inputan sebeluknyya) ke halaman login
        //     return redirect()->route('login')->with('error', 'Email dan Password salah. Coba lagi')->withInput();
        // }

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            if (Auth::user()->role == "admin") {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil Login!');
            } else {
                return redirect()->route('home')->with('success', 'Berhasil Login!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email dan Password salah, Coba lagi!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        // memastikan semau session yang ada dibuat invalid / expired
        $request->session()->invalidate();
        // bikin ulang token session baru contoh tokennya csrf
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil logout!');
    }
}
