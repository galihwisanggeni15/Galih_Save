<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namalengkap' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'nomor' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string',
        ]);
        // Check if the combination of username, email, and telephone is unique
        $existingUser = register::where('username', $validatedData['username'])
            ->orWhere('telephone', $validatedData['nomor'])
            ->orWhere('email', $validatedData['email'])
            ->first();

        if ($existingUser) {
            // Display a JavaScript alert and stay on the same page
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('showAlert', true);
        }

        if (strlen($validatedData['password']) < 6) {
            // Display a JavaScript alert for a minimum 6 characters password and stay on the same page
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('showp', true);
        }

        // Create a new user or store the data in your database
        // For example, you can use the User model assuming you have one
        $user = new register;
        $user->nama = $validatedData['namalengkap'];
        $user->username = $validatedData['username'];
        $user->password = bcrypt($validatedData['password']); // Hash the password
        $user->telephone = $validatedData['nomor'];
        $user->email = $validatedData['email'];
        $user->alamat = $validatedData['alamat'];
        $user->role = "user";
        $user->save();

        // You can also use the create method if your model supports it
        // \App\Models\User::create($validatedData);

        // Redirect to a success page or perform any other necessary actions
        return redirect('index')->with('loginAlert', true);
    }

    public function login(Request $request)
    {
        Session::put('nama', $request->nama);
        Session::put('username', $request->username);
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect('admin/index');
            } else {
                // Handle other roles if needed
                return redirect('user/index');
            }
        } else {
            return redirect()->back()->withErrors(['error' => ''])
                ->withInput()
                ->with('loginsalah', true);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
