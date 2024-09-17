<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;

class StasiunController extends Controller
{
    public function index()
    {
        $data['stasiun'] = Stasiun::all();
        return view('stasiun.index', compact('data'));
    }

    public function create()
    {
        return view('stasiun.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_stasiun' => 'required|max:255',
            'alamat' => 'nullable|max:255',
        ]);

        Stasiun::create($validatedData);
        return redirect()->route('stasiun.index')->with('success', 'Stasiun berhasil ditambahkan.');
    }

    public function show(Stasiun $stasiun)
    {
        return view('stasiun.show', compact('stasiun'));
    }

    public function edit(Stasiun $stasiun)
    {
        return view('stasiun.edit', compact('stasiun'));
    }

    public function update(Request $request, Stasiun $stasiun)
    {
        $validatedData = $request->validate([
            'nama_stasiun' => 'required|max:255',
            'alamat' => 'nullable|max:255',
        ]);

        $stasiun->update($validatedData);
        return redirect()->route('stasiun.index')->with('success', 'Stasiun berhasil diperbarui.');
    }

    public function destroy(Stasiun $stasiun)
    {
        $stasiun->delete();
        return redirect()->route('stasiun.index')->with('success', 'Stasiun berhasil dihapus.');
    }
}

