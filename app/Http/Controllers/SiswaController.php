<?php

namespace App\Http\Controllers;

use App\Models\ajukan_mitra;
use App\Models\Mitra;
use App\Models\Pengajuan;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Cek apakah user sudah diterima di ajukan_mitra
        $mitraDiterima = DB::table('ajukan_mitras')
                            ->where('user_id', $user->id)
                            ->where('status', 'Diterima')
                            ->exists();
                            // dd($mitraDiterima);
    
        $data = Pengajuan::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    
        return view('Siswa.pengajuanPKL', compact('data', 'mitraDiterima'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'user_id' => 'required|numeric',
            'mitra_id' => 'required',
            'jurusan' => 'required',
            'gambar' => 'required',
        ]);

        ajukan_mitra::create([
            'nama' => $request->nama,
            'user_id' => $request->user_id,
            'mitra_id' => $request->mitra_id,
            'jurusan' => $request->jurusan,
            'gambar' => $request->gambar,
            'status' => 'Diproses',
        ]);

        if ($request) {
            return redirect()->route('formPengajuanMitra', ['id' => $request->mitra_id])->with('success', 'Sukses Memasukkan Data');
        } else {
            return redirect()->route('Siswa.formPengajuanMitra')->with('error', 'Gagal menyimpan data');
        }
    }

    public function formPengajuanMitra($id)
    {
        $mitra = Mitra::where('id', $id)->first();
        if ($mitra) {
            return view('Siswa.formPengajuanMitra', compact('mitra'));
        } else {

            return redirect()->back()->with('error', 'Mitra tidak ditemukan');
        }
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('', 'public');
            $gambar = $gambarPath;
        } else {
            $gambar = null;
        }

        $data = Pengajuan::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'jurusan' => $request->jurusan,
            'tempat_magang' => $request->tempat_magang,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'gambar' => $gambar,
            'status' => 'Diproses',
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

    public function statusSurat()
    {
        $data = Surat::where('user_id', auth()->id())
                    ->whereIn('status', ['Diterima', 'Ditolak', 'Diproses'])
                    ->get();
        return view('Siswa.statusSurat', compact('data'));
    }

    public function statusPengajuanMitra()
    {
        $data = ajukan_mitra::where('user_id', auth()->id())
        ->where('status', 'Diterima')
        ->with('mitra')
        ->get();
        return view('Siswa.statusPengajuanMitra', compact('data'));
    }

    public function bankpkl()
    {
        $data = Pengajuan::where('status', 'Diterima')->get();
        return view('Siswa.bankpkl', compact('data'));
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

    public function surat()
    {
        return view('Siswa.formSurat');
    }

    public function formSurat()
    {
        return view('Siswa.formSurat');
    }


    public function formPengajuanPKL()
    {
        return view('Siswa.formPengajuanPKL');
    }



    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pengajuans,id', // Ganti dengan nama tabel yang sesuai
        ]);

        $pengajuan = Pengajuan::find($request->id);
        if ($pengajuan) {
            $pengajuan->status = 'Selesai';
            $pengajuan->save();
            return response()->json(['status' => true, 'message' => 'Status berhasil diubah']);
        }

        return response()->json(['status' => false, 'message' => 'Gagal mengubah status']);
    }
}
