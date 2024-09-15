<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
        //
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

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        $user = Auth::user();

        return view('register');
    }

    public function postRegister(Request $request)
    {
        $user = Auth::user();

        $data = new User;

        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->input('password'));
        $data->email = $request->email;
        $data->nisn = $request->nisn;
        $data->jurusan = $request->jurusan;
        $data->role = 'siswa';

        $post = $data->save();
        if ($post) {
            return redirect()->route('auth.login')->with('success', 'Berhasil Melakukan Pendaftaran');
        } else {
            return redirect()->route('auth.login')->with('error', 'Gagal Melakukan Pendaftaran');
        }
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'siswa' || Auth::user()->role == 'guru') {
                return redirect('/dashboard');
            } else {
                return redirect()->route('auth.login')->with('error', 'NISN atau password salah!');
            }
        }
        return redirect()->route('auth.login')->with('error', 'NISN atau password salah.');
    }
}
