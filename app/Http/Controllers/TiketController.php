<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Kereta;
use App\Models\Stasiun;
use App\Models\Penumpang;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $data['tiket'] = Tiket::with(['penumpang', 'kereta', 'jadwal', 'kursi', 'stasiun_awal', 'stasiun_akhir'])->get();
        return view('tiket.index', compact('data'));
    }

    public function create()
    {
        $data['penumpang'] = Penumpang::all();
        $data['kereta'] = Kereta::all();
        $data['jadwal'] = Jadwal::all();
        $data['kursi'] = Kursi::all();
        $data['stasiun'] = Stasiun::all();
        return view('tiket.create', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_tiket' => 'required|unique:tiket|max:20',
            'penumpang_id' => 'required|exists:penumpang,id',
            'kereta_id' => 'required|exists:keretas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'kursi_id' => 'required|exists:kursis,id',
            'stasiun_awal_id' => 'required|exists:stasiuns,id',
            'stasiun_akhir_id' => 'required|exists:stasiuns,id',
            'harga' => 'required|numeric'
        ]);

        Tiket::create($validatedData);
        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function show(Tiket $tiket)
    {
        return view('tiket.show', compact('tiket'));
    }

    public function edit(Tiket $tiket)
    {
        $data['tiket'] = $tiket;
        $data['penumpang'] = Penumpang::all();
        $data['kereta'] = Kereta::all();
        $data['jadwal'] = Jadwal::all();
        $data['kursi'] = Kursi::all();
        $data['stasiun'] = Stasiun::all();
        return view('tiket.edit', compact('data'));
    }

    public function update(Request $request, Tiket $tiket)
    {
        $validatedData = $request->validate([
            'penumpang_id' => 'required|exists:penumpang,id',
            'kereta_id' => 'required|exists:keretas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'kursi_id' => 'required|exists:kursis,id',
            'stasiun_awal_id' => 'required|exists:stasiuns,id',
            'stasiun_akhir_id' => 'required|exists:stasiuns,id',
            'harga' => 'required|numeric'
        ]);

        $tiket->update($validatedData);
        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
        return redirect()->route('tiket.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
