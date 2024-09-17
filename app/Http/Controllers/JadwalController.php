<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data['jadwals'] = Jadwal::all();
        return view('jadwal.index', compact('data'));
    }

    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_kereta' => 'required|exists:keretas,nomor',
            'tanggal' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
            'jam_tiba' => 'required|date_format:H:i',
        ]);

        Jadwal::create($validatedData);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validatedData = $request->validate([
            'nomor_kereta' => 'required|exists:keretas,nomor',
            'tanggal' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
            'jam_tiba' => 'required|date_format:H:i',
        ]);

        $jadwal->update($validatedData);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}


