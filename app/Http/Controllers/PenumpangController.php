<?php

namespace App\Http\Controllers;

use App\Models\Penumpang;
use Illuminate\Http\Request;

class PenumpangController extends Controller
{
    public function index()
    {
        $data['penumpang'] = Penumpang::all();
        return view('penumpang.index', compact('data'));
    }

    public function create()
    {
        return view('penumpang.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|max:15',
            'alamat' => 'nullable|max:255',
        ]);

        Penumpang::create($validatedData);
        return redirect()->route('penumpang.index')->with('success', 'Penumpang berhasil ditambahkan.');
    }

    public function show(Penumpang $penumpang)
    {
        return view('penumpang.show', compact('penumpang'));
    }

    public function edit(Penumpang $penumpang)
    {
        return view('penumpang.edit', compact('penumpang'));
    }

    public function update(Request $request, Penumpang $penumpang)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|max:15',
            'alamat' => 'nullable|max:255',
        ]);

        $penumpang->update($validatedData);
        return redirect()->route('penumpang.index')->with('success', 'Penumpang berhasil diperbarui.');
    }

    public function destroy(Penumpang $penumpang)
    {
        $penumpang->delete();
        return redirect()->route('penumpang.index')->with('success', 'Penumpang berhasil dihapus.');
    }
}

