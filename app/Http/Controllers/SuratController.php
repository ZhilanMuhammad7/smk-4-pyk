<?php

namespace App\Http\Controllers;

use App\Models\ajukan_mitra;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Surat::all();
        $ajukan = ajukan_mitra::where('user_id', auth()->user()->id)->where('status', 'diterima')->get();
        $pengajuanSelesai = \App\Models\Pengajuan::where('user_id', auth()->user()->id)->where('status', 'Selesai')->exists();
        return view('Siswa.layananAkademik', compact('data', 'ajukan', 'pengajuanSelesai'));
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

        $data = Surat::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'tgl_mulai_pkl' => $request->tgl_mulai_pkl,
            'tgl_selesai_pkl' => $request->tgl_selesai_pkl,
            'no_handphone' => $request->no_handphone,
            'alamat' => $request->alamat,
            'tempat_pkl' => $request->tempat_pkl,
            'bidang_kerja' => $request->bidang_kerja,
            'jurusan' => $request->jurusan,
            'status' => 'Diproses'
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses Memasukkan Data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data',
            ]);
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

    public function konfirmSurat()
    {
        $data = Surat::all();
        return view('Guru.konfirmSurat', compact('data'));
    }

    public function aprovalSurat(Request $request, $id)
    {
        $id = $request->id;
        $data = Surat::find($id);
        if ($data) {
            if ($request->status == 'Diterima') {
                $data->status = 'Diterima';
                $data->save();
                return redirect()->route('layanan-akademik.konfirmSurat')->with('success', 'Surat berhasil dikonfirmasi.');
            } elseif ($request->status == 'Ditolak') {
                $data->status = 'Ditolak';
                $data->save();
                return redirect()->route('layanan-akademik.konfirmSurat')->with('error', 'Surat berhasil ditolak.');
            }
        } else {
            return redirect()->route('layanan-akademik.konfirmSurat')->with('error', 'Pengajuan tidak ditemukan.');
        }
    }

    public function downloadSurat($id)
    {
        $data = Surat::findOrFail($id);
        $dataUser = User::findOrFail($data->user_id);
        $dataUser->nisn = User::findOrFail($data->user_id)->nisn;
        $dataUser->name = User::findOrFail($data->user_id)->name;

        $pdf = PDF::loadView('Guru.surat', compact('data', 'dataUser'));

        return $pdf->download('surat-' . $data->id . '.pdf');
    }
}
