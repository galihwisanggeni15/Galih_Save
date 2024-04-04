<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function adminindex()
    {
        // $data = AdminModel::GetData('barang');
        $count['totalbarang'] = AdminModel::GetDataTotal('barang');
        return view('admin.index', compact('count'));
    }
    public function adminbarang()
    {
        $data = AdminModel::GetData('barang');
        return view('admin.barang', compact('data'));
    }
    public function admindata()
    {
        // Memanggil fungsi joinData() dari model
        $data = AdminModel::joinData();
        return view('admin.data', compact('data')); // Mengirimkan data ke view
    }

    public function adminuser()
    {
        $data = AdminModel::GetDataIdUser('user');
        return view('admin.user', compact('data'));
    }
    public function dataadminuser()
    {
        $data = AdminModel::JoinDataUser();
        return view('admin.datauser', compact('data'));
    }
    public function dataadminuseraktif($id)
    {
        $data = [
            'id_status' => '1'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data); // Perbaikan sintaks
        return redirect()->back();
    }
    public function dataadminusernonaktif($id)
    {
        $data = [
            'id_status' => '4'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data); // Perbaikan sintaks
        return redirect()->back();
    }
    public function dataadminusertolak($id)
    {
        $data = [
            'id_status' => '3'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data); // Perbaikan sintaks
        return redirect()->back();
    }
    public function dataadminuserhapus($id)
    {
        AdminModel::HapusDataById('user', $id, 'id_user'); // Perbaikan sintaks
        return redirect()->back();
    }


    public function tambahbarang()
    {
        return view('admin/tambah');
    }
    public function tambahbarangsubmit(Request $request)
    {
        $request->validate([
            'barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required',
        ]);

        $uploadPath = public_path('upload');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        $image = $request->file('foto');
        $imageName = $image->hashName();
        $image->move($uploadPath, $imageName);
        // Save barang details to the database
        DB::table('barang')->insert([
            'barang' => $request->barang,
            'deskripsi' => $request->deskripsi,
            'foto' => $imageName,
            'stok' => $request->stok,
        ]);

        // Redirect or perform any other action after saving
        return redirect('admin/barang');
    }
    public function hapusbarangsubmit(string $id)
    {
        // Retrieve the product data, including the image filename
        $barang = AdminModel::GetDataIdBarang('barang', $id);

        if (!$barang) {
            // barang not found
            return redirect()->back()->withErrors(['error' => 'barang not found']);
        }

        // Delete the record from the database
        // Delete the record from the database
        $delete = DB::table('barang')->where('id_barang', $id)->delete();

        if ($delete) {
            // If the barang has an associated image, delete the image file
            if ($barang->foto) {
                $imagePath = public_path('upload/' . $barang->foto);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to delete barang']);
        }
    }
    public function editbarang(string $id)
    {
        $barang = AdminModel::GetDataIdBarang('barang', $id);
        return view('admin.editbarang', compact('barang'));
    }
    public function editbarangsubmit(Request $request, $id)
    {
        $request->validate([
            'barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stok' => 'required',
        ]);
        $barang = AdminModel::GetDataIdBarang('barang', $id);
        // Check if a file has been uploaded
        if ($request->hasFile('foto')) {
            // Handle image upload
            $uploadPath = public_path('upload');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Delete the old image if it exists
            if ($barang->foto) {
                $oldImagePath = $uploadPath . '/' . $barang->foto;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('foto');
            $imageName = $image->hashName();
            $image->move($uploadPath, $imageName);

            // Update product details with the new image path
            DB::table('barang')->where('id_barang', $id)->update([
                'barang' => $request->barang,
                'deskripsi' => $request->deskripsi,
                'foto' => $imageName, // Save the image path to the database
                'stok' => $request->stok
            ]);
        } else {
            // Update product details without changing the image
            DB::table('barang')->where('id_barang', $id)->update([
                'barang' => $request->barang,
                'deskripsi' => $request->deskripsi,
                'stok' => $request->stok,
            ]);
        }
        return redirect()->route('adminbarang');
    }
    public function edituseradminsubmit(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'telephone' => 'required',
        ]);

        // Mengambil data pengguna dari database
        $user = AdminModel::GetDataIdUser('user');

        if (
            $request->nama != $user->nama ||
            $request->username != $user->username ||
            $request->email != $user->email ||
            $request->telephone != $user->telephone
        ) {
            // Mengupdate data pengguna jika ada perubahan
            AdminModel::UpdateDataIdUser('user', [
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'telephone' => $request->telephone,
            ]);

            // Redirect atau lakukan tindakan lain setelah berhasil memperbarui
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            // Jika data tetap sama, Anda bisa melakukan redirect tanpa melakukan pembaruan
            return redirect()->back()->with('info', 'No changes were made');
        }
    }
    public function konfirmasiditerima($id)
    {
        $getpinjaman = AdminModel::GetDataIdPinjaman('pinjaman', $id);
        $id_barang = $getpinjaman->id_barang;
        $getbarang = AdminModel::GetDataIdBarang('barang', $id_barang);
        $id_barangg = $getbarang->id_barang;
        $totalbarang = $getbarang->stok - $getpinjaman->jumlahpinjaman;
        AdminModel::UpdateDataIdBarang('barang', ['stok' => $totalbarang], $id_barangg);
        AdminModel::UpdateDataIdPinjaman('pinjaman', ['id_status' => '2'], $id);
        return redirect()->back();
    }
    public function konfirmasiditolak($id)
    {
        AdminModel::UpdateDataIdPinjaman('pinjaman', ['id_status' => '4'], $id);
        return redirect()->back();
    }
    public function konfirmasikembaliuser($id)
    {
        AdminModel::UpdateDataIdPinjaman('pinjaman', ['id_status' => '5'], $id);
        return redirect()->back();
    }
    public function konfirmasipengembalianadmin($id)
    {
        $getpinjaman = AdminModel::GetDataIdPinjaman('pinjaman', $id);
        $id_barang = $getpinjaman->id_barang;
        $tanggal_pengembalian = $getpinjaman->tanggalkembali;
        $getbarang = AdminModel::GetDataIdBarang('barang', $id_barang);
        $id_barangg = $getbarang->id_barang;
        $today = date('Y-m-d');
        $totalbarang = $getbarang->stok + $getpinjaman->jumlahpinjaman;
        AdminModel::UpdateDataIdBarang('barang', ['stok' => $totalbarang], $id_barangg);
        AdminModel::UpdateDataIdPinjaman('pinjaman', ['id_status' => '3'], $id);
        return redirect()->back();
    }
    public function konfirmasihapus($id)
    {
        AdminModel::HapusDataIdPinjaman('pinjaman', $id);
        return redirect()->back();
    }
}
