<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = admin::GetData('products');
        return view('admin.index', $data);
    }
    public function dataproduct()
    {
        $data['products'] = admin::GetData('products');
        return view('admin.dataproduct', $data);
    }
    public function datacategory()
    {
        $data['category'] = admin::GetData('category');
        return view('admin.datacategory', $data);
    }
    public function linktambahdatacategory()
    {
        return view('admin.tambahdatakategori');
    }
    public function profil()
    {
        $data['users'] = admin::GetData('users');
        return view('admin.profil', $data);
    }
    public function tambah()
    {
        $data['category'] = admin::GetData('category');
        return view('admin.tambahdata', $data);
    }
    public function update(Request $request)
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
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'status' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
            // Add other validation rules for your product details
        ]);

        $uploadPath = public_path('upload');
        if(!File::isDirectory($uploadPath)){
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        $image = $request->file('foto');
        $imageName = $image->hashName();
        $image->move($uploadPath, $imageName);
        // Save product details to the database
        DB::table('products')->insert([
            'category_id' => $request->kategori,
            'nama' => $request->nama,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'image' => $imageName, // Save the image path to the database
            'stok' => $request->stok,
            'status' => $request->status,
        ]);
        
        // Redirect or perform any other action after saving
        return redirect()->route('dataproduct'); // Replace 'your.route.name' with the actual route name you want to redirect to
    }
    public function edit(string $id)
    {
        $barang = DB::table('products')->where('id', $id)->first();
        $data['category'] = admin::GetData('category');
        return view('admin.edit-product', ['data' => $barang], $data);
    }

    public function updateproduct(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
            'stok' => 'required|numeric',
            'status' => 'required',
        ]);

        // Retrieve the product by ID
        $product = DB::table('products')->where('id', $id)->first();

        // Check if a file has been uploaded
        if ($request->hasFile('foto')) {
            // Handle image upload
            $uploadPath = public_path('upload');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Delete the old image if it exists
            if ($product->image) {
                $oldImagePath = $uploadPath . '/' . $product->image;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('foto');
            $imageName = $image->hashName();
            $image->move($uploadPath, $imageName);

            // Update product details with the new image path
            DB::table('products')->where('id', $id)->update([
                'category_id' => $request->kategori,
                'nama' => $request->nama,
                'price' => $request->harga,
                'description' => $request->deskripsi,
                'image' => $imageName, // Save the image path to the database
                'stok' => $request->stok,
                'status' => $request->status,
            ]);
        } else {
            // Update product details without changing the image
            DB::table('products')->where('id', $id)->update([
                'category_id' => $request->kategori,
                'nama' => $request->nama,
                'price' => $request->harga,
                'description' => $request->deskripsi,
                'stok' => $request->stok,
                'status' => $request->status,
            ]);
        }

        // Redirect or perform any other action after saving
        return redirect()->route('dataproduct');
    }
    public function destroy(string $id)
    {
        // Retrieve the product data, including the image filename
        $product = DB::table('products')->find($id);

        if (!$product) {
            // Product not found
            return redirect()->back()->withErrors(['error' => 'Product not found']);
        }

        // Delete the record from the database
        $delete = DB::table('products')->where('id', $id)->delete();

        if ($delete) {
            // If the product has an associated image, delete the image file
            if ($product->image) {
                $imagePath = public_path('upload/' . $product->image);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to delete product']);
        }
    }

    public function tambahkategori(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        DB::table('category')->insert([
            'nama' => $request->nama
        ]);

        return redirect('admin/datacategory');
    }
    public function linkupdatecategory(string $id)
    {
        $barang = DB::table('category')->where('category_id', $id)->first();
        return view('admin.editcategory', ['data' => $barang]);
    }
    public function updatecategory(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);
        DB::table('category')->where('category_id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('admin/datacategory');
    }
    public function hapuscategory(string $id)
    {
        $category = DB::table('category')->where('category_id', $id)->first();

        if (!$category) {
            // Category not found
            return redirect()->back()->withErrors(['error' => 'Category not found']);
        }

        // Delete the record from the database
        $delete = DB::table('category')->where('category_id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to delete category']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('index');
    }
}
