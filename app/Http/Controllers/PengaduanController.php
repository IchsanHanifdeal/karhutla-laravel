<?php

namespace App\Http\Controllers;

use App\Models\lokasi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengaduan');
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
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'radius' => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $lokasi = lokasi::create([
                'lat' => $request->lat,
                'long' => $request->lng,
                'radius' => $request->radius,
                'level' => $request->level,
            ]);

            toastr()->success('Pengajuan Berhasil!');
            return redirect()->route('beranda');
        } catch (\Exception $e) {
            toastr()->error('Pengajuan gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function Pengajuan()
    {
        $pengajuan = Lokasi::all();
        $total_pengajuan = Lokasi::count();
        $total_valid = Lokasi::where('validasi', 'diterima')->count();
        $total_diterima = Lokasi::where('validasi', 'diajukan')->count();

        return view('pengajuan', [
            'total_pengajuan' => $total_pengajuan,
            'total_diterima' => $total_diterima,
            'pengajuan' => $pengajuan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function terima(Request $request, $id_lokasi)
    {
        $pengajuan = Lokasi::findorfail($id_lokasi);

        $pengajuan->update([
            'validasi' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'Pengajuan diterima');
    }

    /**
     * Update the specified resource in storage.
     */
    public function tolak(Request $request, $id_lokasi)
    {
        $pengajuan = Lokasi::findOrFail($id_lokasi);

        $pengajuan->delete();

        return redirect()->back()->with('success', 'Pengajuan berhasil ditolak dan data dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
