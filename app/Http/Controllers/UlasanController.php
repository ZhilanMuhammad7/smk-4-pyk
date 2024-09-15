<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Pengajuan;
use App\Models\ajukan_mitra;
use Illuminate\Http\Request;
use App\Models\mitra;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
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
        $data = Ulasan::create([
            'id' => Auth::user()->id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'tempat_magang' => $request->tempat_magang,
            'bidang_kerja' => $request->bidang_kerja,
            'jurusan' => $request->jurusan,
            'ulasan' => $request->ulasan,
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


    public function showAllUlasan()
    {
        // Ambil semua data pengajuan dari tabel Pengajuan yang ulasannya tidak null
        $pengajuans = Pengajuan::whereNotNull('ulasan')->get();
    
        // Ambil semua data dari tabel ajukan_mitra yang ulasannya tidak null
        $ajukanMitras = ajukan_mitra::with('mitra')->whereNotNull('ulasan')->get();
    
        // Gabungkan kedua koleksi data menjadi satu array
        $allData = $pengajuans->concat($ajukanMitras);
    
        // Kirim data gabungan ke view
        return view('Siswa.ulasan', ['allData' => $allData]);
    }
    
    
    



    public function getUlasanData(Request $request)
    {
        $user_id = auth()->user()->id;

        // Cek di tabel Pengajuan dengan status 'Selesai'
        $pengajuan = Pengajuan::where('user_id', $user_id)
            ->where('status', 'Selesai')
            ->first();

        // Cek di tabel ajukan_mitra dengan status 'Diterima' jika data tidak ditemukan di Pengajuan
        $ajukanMitra = !$pengajuan ? ajukan_mitra::with('mitra') // Memuat relasi mitra
            ->where('user_id', $user_id)
            ->where('status', 'Diterima')
            ->first() : null;

        if ($pengajuan || $ajukanMitra) {
            return response()->json([
                'status' => true,
                'data' => [
                    'pengajuan' => $pengajuan,
                    'ajukan_mitra' => $ajukanMitra
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }




    public function submitUlasan(Request $request)
    {
        // Validasi input ulasan
        $request->validate([
            'id' => 'required|integer',
            'ulasan' => 'required|string',
            'source' => 'required|string' // Menandakan sumber data: 'pengajuan' atau 'ajukan_mitra'
        ]);

        // Cek sumber data
        if ($request->source === 'pengajuan') {
            // Jika sumber data adalah Pengajuan
            $pengajuan = Pengajuan::find($request->id);
            if ($pengajuan) {
                $pengajuan->ulasan = $request->ulasan;
                $pengajuan->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Ulasan berhasil disimpan di Pengajuan'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Pengajuan tidak ditemukan'
                ]);
            }
        } elseif ($request->source === 'ajukan_mitra') {
            // Jika sumber data adalah ajukan_mitra
            $ajukanMitra = ajukan_mitra::find($request->id);
            if ($ajukanMitra) {
                $ajukanMitra->ulasan = $request->ulasan;
                $ajukanMitra->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Ulasan berhasil disimpan di ajukan_mitra'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data ajukan_mitra tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sumber data tidak valid'
            ]);
        }
    }
}
