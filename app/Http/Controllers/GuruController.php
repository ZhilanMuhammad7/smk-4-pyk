<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengajuan::all();
        return view('Guru.dataPKL', compact('data'));
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $data = Pengajuan::find($id);
        if ($data) {
            if ($request->status == 'Diterima') {
                $data->status = 'Diterima';
                $data->save();
                return redirect()->route('data-pengajuan.index')->with('success', 'Pengajuan berhasil dikonfirmasi.');
            } elseif ($request->status == 'Ditolak') {
                $data->status = 'Ditolak';
                $data->save();
                return redirect()->route('data-pengajuan.index')->with('error', 'Pengajuan berhasil ditolak.');
            }
        } else {
            return redirect()->route('data-pengajuan.index')->with('error', 'Pengajuan tidak ditemukan.');
        }
    }

    public function konfirmasi()
    {
        $data = Pengajuan::leftjoin('users as u', 'u.id', '=', 'user.id')
            ->select('pengajuan.*', 'u.*')
            ->get();
        return view('Guru.dataPKL', compact('data'));
    }

    public function approval(Request $request)
    {

        $id = $request->user_id;
        $data = Pengajuan::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Pengajuan tidak ditemukan',
            ]);
        }
        $data->update([
            'status' => $request->status
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Mengubah Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Mengubah data',
            ]);
        }
    }
}
