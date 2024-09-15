<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        $data_pkl = Pengajuan::where('user_id', $id)->get();
        $data_surat = Surat::where(function ($query) {
            $query->where('status', 'Diterima')
                ->orWhere('status', 'Ditolak')
                ->orWhere('status', 'Diproses');
        })
            ->get();
        $data_pengajuan = Pengajuan::where(function ($query) {
            $query->where('status', 'Diterima')
                ->orWhere('status', 'Ditolak')
                ->orWhere('status', 'Diproses');
        })
        ->get();
        if ($data) {
            return view('dashboard.dashboard', compact('data', 'data_pkl', 'data_surat', 'data_pengajuan'));
        } else {
            return redirect()->route('home.index')->with('error', 'Data tidak ditemukan');
        }
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
}
