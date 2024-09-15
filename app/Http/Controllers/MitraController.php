<?php

namespace App\Http\Controllers;

use App\Models\ajukan_mitra;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Ulasan;
use App\Models\User;

class MitraController extends Controller
{
    public function mitra()
    {
        $tabel = mitra::all();
        return view('Guru.mitraPKL', compact('tabel'));
    }

    public function mitraSiswa()
    {
        $tabel = mitra::all();

        return view('Siswa.mitra', compact('tabel'));
    }

    public function ulasan(Request $request)
    {
        $request->validate([
            'ulasan' => 'required',
        ]);

        $mitra = mitra::find($request->id);
        $mitra->ulasan = $request->ulasan;
        $mitra->save();

        return response()->json(['status' => true, 'message' => 'Ulasan berhasil ditambahkan.']);

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mitra' => 'required',
            'jml_kuota' => 'required|numeric',
            'kriteria' => 'required',
            'jurusan' => 'required',
            'lokasi' => 'required',
            'fasilitas' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        mitra::create($request->all());


        return redirect()->route('Guru.mitraPKL')
            ->with('success', 'Mitra berhasil ditambahkan.');
    }
    public function formMitra()
    {
        return view('Guru.formMitra');
    }

    public function edit($id)
    {
        $mitra = mitra::findOrFail($id);
        return view('Guru.formMitra', compact('mitra'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mitra' => 'required',
            'jml_kuota' => 'required|numeric',
            'kriteria' => 'required',
            'jurusan' => 'required',
            'lokasi' => 'required',
            'fasilitas' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
        ]);

        $mitra = Mitra::findOrFail($id);
        $mitra->nama_mitra = $request->nama_mitra;
        $mitra->jml_kuota = $request->jml_kuota;
        $mitra->kriteria = $request->kriteria;
        $mitra->jurusan = $request->jurusan;
        $mitra->lokasi = $request->lokasi;
        $mitra->fasilitas = $request->fasilitas;
        $mitra->tgl_mulai = $request->tgl_mulai;
        $mitra->tgl_selesai = $request->tgl_selesai;
        $mitra->save();

        return redirect()->route('Guru.mitraPKL')
            ->with('success', 'Mitra berhasil diperbarui.');
    }

    public function delete($id)
    {
        mitra::destroy($id);
        return redirect()->route('Guru.mitraPKL')
            ->with('success', 'Mitra berhasil dihapus.');
    }

    public function lihatPengajuan($id)
    {
        $mitra = ajukan_mitra::where(['mitra_id' => $id])->get();
        $user = User::where('id', $id)->get();
        return view('Guru.dataMitra', compact('mitra', 'user'));
    }

    public function konfirmasi($id)
    {
        $mitra = ajukan_mitra::find($id);
        if ($mitra) {
            $mitra->update(['status' => 'diterima']);
            $mitraData = Mitra::find($mitra->mitra_id);
            $mitraData->decrement('jml_kuota', 1);
            return redirect()->route('Guru.lihatPengajuan', ['id' => $mitra->mitra_id])->with('success', 'Mitra berhasil dikonfirmasi.');
        } else {
            return redirect()->route('Guru.lihatPengajuan', ['id' => $mitra->mitra_id])->with('error', 'Mitra tidak ditemukan.');
        }
    }

    public function tolak($id)
    {
        $mitra = ajukan_mitra::find($id);
        $mitra->update(['status' => 'ditolak']);
        return redirect()->route('Guru.lihatPengajuan', ['id' => $mitra->mitra_id])->with('error', 'Mitra berhasil ditolak.');
    }
}
