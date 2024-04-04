<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data['products'] = admin::GetData('products');
        return view('user.index', $data);
    }
    public function profil()
    {
        $data['users'] = admin::GetData('users');
        return view('user.profil', $data);
    }
    public function updateprofil(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'nomor' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        // Get the current user data
        $currentUserData = DB::table('users')->find(auth()->user()->id);

        // Check if the new data is different from the current data
        if (
            $request->nama != $currentUserData->nama ||
            $request->username != $currentUserData->username ||
            $request->email != $currentUserData->email ||
            $request->nomor != $currentUserData->telephone ||
            $request->alamat != $currentUserData->alamat
        ) {

            // Update user data
            DB::table('users')
            ->where('id', auth()->user()->id)
                ->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'telephone' => $request->nomor,
                    'alamat' => $request->alamat,
                ]);

            // Redirect or perform any other action after updating
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // If data is the same, you can redirect without updating
            return redirect()->back()->with('info', 'No changes were made');
        }
    }
    public function deskripsiproduk(string $id)
    {
        $barang = DB::table('products')->where('id', $id)->first();
        return view('user.deskripsi', ['data' => $barang]);
    }
    public function linkbeliproduk(string $id)
    {
        $barang = DB::table('products')->where('id', $id)->first();
        return view('user.beliproduk', ['data' => $barang]);
    }
    public function beliProduk(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'namabarang' => 'required',
            'nomor' => 'required',
            'alamat' => 'required',
            'pengiriman' => 'required',
            'pembayaran' => 'required',
            'rekening' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        // Mendapatkan data produk berdasarkan ID menggunakan Query Builder
        $barang = DB::table('products')->where('id', $id)->first();

        // Memeriksa apakah stok cukup
        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Menyimpan data pembeli
        DB::table('pembeli')->insert([
            'nama' => $request->nama,
            'namabarang' => $request->namabarang,
            'telephone' => $request->nomor,
            'alamat' => $request->alamat,
            'pengiriman' => $request->pengiriman,
            'pembayaran' => $request->pembayaran,
            'rekening' => $request->rekening,
            'jumlahbarang' => $request->jumlah,
            'harga' => $request->harga,
        ]);

        // Mengurangkan stok produk
        DB::table('products')->where('id', $id)->decrement('stok', $request->jumlah);

        // Menambahkan pesan sukses ke dalam sesi
        $request->session()->flash('success', 'Pembelian berhasil.');

        return redirect('user/index');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('index');
    }
}
