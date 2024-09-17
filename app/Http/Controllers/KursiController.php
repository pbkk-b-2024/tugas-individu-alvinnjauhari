<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use Illuminate\Http\Request;

class KursiController extends Controller
{
    public function index()
    {
        $data['kursi'] = Kursi::all();
        return view('kursi.index', compact('data'));
    }

    public function create()
    {
        return view('kursi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_kursi' => 'required|max:10',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Kursi::create($validatedData);
        return redirect()->route('kursi.index')->with('success', 'Kursi berhasil ditambahkan.');
    }

    public function show(Kursi $kursi)
    {
        return view('kursi.show', compact('kursi'));
    }

    public function edit(Kursi $kursi)
    {
        return view('kursi.edit', compact('kursi'));
    }

    public function update(Request $request, Kursi $kursi)
    {
        $validatedData = $request->validate([
            'nomor_kursi' => 'required|max:10',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $kursi->update($validatedData);
        return redirect()->route('kursi.index')->with('success', 'Kursi berhasil diperbarui.');
    }

    public function destroy(Kursi $kursi)
    {
        $kursi->delete();
        return redirect()->route('kursi.index')->with('success', 'Kursi berhasil dihapus.');
    }
}

