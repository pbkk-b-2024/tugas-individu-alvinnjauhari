<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data['kelas'] = Kelas::all();
        return view('kelas.index', compact('data'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|max:255',
            'harga' => 'required|numeric',
        ]);

        Kelas::create($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validatedData = $request->validate([
            'nama_kelas' => 'required|max:255',
            'harga' => 'required|numeric',
        ]);

        $kelas->update($validatedData);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
