<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function loginsubmit(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = AdminModel::GetDataByIdF('user', 'username', $request->username);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Username atau password salah.');
        } else {
            session(['user' => $user]);
            if ($user->id_role == '1') {
                return redirect()->route('adminindex');
            } else {
                if ($user->id_status == '2') {
                    return redirect()->back()->with('menunggu', true);
                } elseif ($user->id_status == '3') {
                    return redirect()->back()->with('diblokir', true);
                } elseif ($user->id_status == '4') {
                    return redirect()->back()->with('ditolak', true);
                } else {
                    return redirect()->route('home');
                }
            }
        }
    }
    public function register(Request $request)
    {
        $validate = $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required',
            'nip' => 'required',
            'telephone' => 'required',
            'password' => 'required',
        ]);
        $existingUser = DB::table('user')
            ->where('username', $validate['username'])
            ->orWhere('nip', $validate['nip'])
            ->orWhere('telephone', $validate['telephone'])
            ->exists();

        if ($existingUser) {
            // Return response indicating that username, email, or telephone already exists
            return redirect()->back()->with('sudahada', true);
        }
        $hashedPassword = Hash::make($validate['password']);
        $data = [
            'id_role' => '2',
            'id_status' => '2',
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'username' => $request->username,
            'telephone' => $request->telephone,
            'password' => $hashedPassword,
            'created_at' => Carbon::now('Asia/Jakarta')
        ];
        AdminModel::InsertData('user', $data);
        return redirect()->back()->with('berhasil', true);
    }




    public function adminindex()
    {
        return view('admin.index');
    }
    public function admindatabarang()
    {
        $data = AdminModel::joinDataPengaduan();
        return view('admin.data_barang', compact('data'));
    }
    public function admindatabarangdetail($id)
    {
        $data['join'] = AdminModel::joinDataPengaduan3($id);
        $data['status'] = AdminModel::GetData('status_pengaduan');
        // dd($data['join']);
        return view('admin.barang.detail', compact('data'));
    }
    public function admindatabarangdetailsubmit(Request $request, $id)
    {
        $data = [
            'id_status' => $request->status,
            'catatan' => $request->catatan
        ];
        AdminModel::UpdateDataById('pengaduan', 'id_pengaduan', $id, $data);
        return redirect()->route('admindatabarang')->with('submit', true);
    }
    public function admindatabaranghapus($id)
    {
        AdminModel::DeleteDataById('pengaduan', 'id_pengaduan', $id);
        return redirect()->route('admindatabarang');
    }

    public function adminubahpassword()
    {
        $data = AdminModel::GetDataByIdF('user', 'id_user', session('user')->id_user);
        return view('admin.ubah_password', compact('data'));
    }
    public function adminubahpasswordsubmit(Request $request, $id)
    {
        $data = [
            'password' => Hash::make($request->password)
        ];
        // dd($data);
        AdminModel::UpdateDataById('user', 'id_user', $id, $data);
        return redirect()->route('adminubahpassword');
    }
    public function adminprofil()
    {
        $data = AdminModel::GetDataByIdF('user', 'id_user', session('user')->id_user);
        return view('admin.profil', compact('data'));
    }






    public function admindatauser()
    {
        $data = AdminModel::JoinDataUser();
        return view('admin.data_user', compact('data'));
    }
    public function admindatauserterima($id)
    {
        $data = [
            'id_status' => '1'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data);
        return redirect()->back();
    }
    public function admindatausertolak($id)
    {
        $data = [
            'id_status' => '4'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data);
        return redirect()->back();
    }
    public function admindatauserblokir($id)
    {
        $data = [
            'id_status' => '3'
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data);
        return redirect()->back();
    }
    public function admindatauserhapus($id)
    {
        AdminModel::DeleteDataById('user', 'id_user', $id);
        return redirect()->back();
    }





    public function home()
    {
        return view('user.index');
    }
    public function pengajuan()
    {
        $user = AdminModel::GetDataByIdf('user', 'id_user', session('user')->id_user);
        return view('user.pengajuan', compact('user'));
    }
    public function pengajuansubmit(Request $request)
    {
        $uploadPath = public_path('upload');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        $image = $request->file('gambar');
        $imageName = $image->hashName();
        $image->move($uploadPath, $imageName);

        $get = AdminModel::GetDataByIdf('pengaduan', 'kode_pengaduan', $request->kode);
        if ($get) {
            return redirect()->back()->with('kodesudahada', true);
        }
        $data = [
            'kode_pengaduan' => $request->kode,
            'id_status' => '1',
            'id_user' => session('user')->id_user,
            'nama_barang' => $request->barang,
            'keterangan' => $request->keterangan,
            'gambar' => $imageName,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ];
        AdminModel::InsertData('pengaduan', $data);
        return redirect()->route('home')->with('tunggu', true);
    }
    public function cekbarang(Request $request)
    {
        $get = AdminModel::joinDataPengaduan2($request->kode);
        if ($get) {
            // Redirect to hasilpengajuan route with $get parameter
            return view('user.hasil_pengajuan', compact('get'));
        } else {
            // Handle the case where the complaint is not found
            // For example, you can redirect the user back with an error message
            return redirect()->back()->with('error', 'Complaint not found.');
        }
    }

    public function userprofil()
    {
        $data = AdminModel::GetDataByIdF('user', 'id_user', session('user')->id_user);
        return view('user.profil', compact('data'));
    }
    public function userprofilsubmit(Request $request, $id)
    {
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'username' => $request->username,
            'telephone' => $request->telephone,
        ];
        AdminModel::UpdateDataById('user', 'id_user', $id, $data);
        return redirect()->back();
    }
    public function userubahpassword()
    {
        $data = AdminModel::GetDataByIdF('user', 'id_user', session('user')->id_user);
        return view('user.ubah_password', compact('data'));
    }
}
