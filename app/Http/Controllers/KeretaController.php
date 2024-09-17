<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Stasiun;

class KeretaController extends Controller
{
    public function index(Request $request)
    {
        // Relasi yang ingin dimuat bersamaan
        $relations = ['jadwal', 'kelas', 'stasiuns'];

        // Eager Loading dengan memuat ketiga relasi sekaligus
        $data['keretas'] = Kereta::with($relations)->paginate(10); // Misalnya paginasi 10 item per halaman

        return view('kereta.index', compact('data'));
    }

    public function create()
    {
        // Ambil semua kelas dan stasiun
        $data['kelas'] = Kelas::all();
        $data['stasiun'] = Stasiun::all();
        return view('kereta.create', compact('data'));
    }

    public function store(NewKeretaRequest $request)
    {
        // Validasi input
        $validatedData = $request->validated();

        // Buat kereta baru, simpan data ke tabel kereta
        $kereta = Kereta::create($validatedData);

        // Hubungkan kereta dengan kelas (Many-to-Many)
        $kereta->kelas()->attach($request->input('kelas'));

        // Hubungkan kereta dengan stasiun (Many-to-Many)
        $kereta->stasiuns()->attach($request->input('stasiuns'), ['urutan_pemberhentian' => 1]); // Anda bisa mengganti urutan sesuai logika

        return redirect()->route('kereta.index')->with('success', 'Kereta "' . $kereta->nama_kereta . '" sukses ditambahkan.');
    }

    public function show(Kereta $kereta)
    {
        $data['kereta'] = $kereta;
        return view('kereta.show', compact('data'));
    }

    public function edit(Kereta $kereta)
    {
        $data['kereta'] = $kereta;
        $data['kelas-kereta'] = $kereta->kelas->pluck('id')->toArray(); // Relasi many-to-many
        $data['stasiun-kereta'] = $kereta->stasiuns->pluck('id')->toArray(); // Relasi many-to-many
        $data['kelas'] = Kelas::all();
        $data['stasiuns'] = Stasiun::all();
        return view('kereta.edit', compact('data'));
    }

    // Method update: Untuk mengupdate data kereta
    public function update(UpdateKeretaRequest $request, Kereta $kereta)
    {
        // Validasi input
        $validatedData = $request->validated();

        // Update data kereta
        $kereta->update($validatedData);

        // Sinkronkan kelas
        $kereta->kelas()->sync($request->input('kelas'));

        // Sinkronkan stasiun dengan urutan pemberhentian
        $stasiunData = [];
        foreach ($request->input('stasiuns') as $index => $stasiunId) {
            $stasiunData[$stasiunId] = ['urutan_pemberhentian' => $index + 1];
        }
        $kereta->stasiuns()->sync($stasiunData);

        return redirect()->route('kereta.index')->with('success', 'Kereta "' . $kereta->nama_kereta . '" sukses diubah.');
    }

    // Method destroy: Untuk menghapus data kereta
    public function destroy(Kereta $kereta)
    {
        // Hapus relasi many-to-many
        $kereta->kelas()->detach();
        $kereta->stasiuns()->detach();

        // Hapus data kereta
        $kereta->delete();

        return redirect()->route('kereta.index')->with('success', 'Kereta "' . $kereta->nama_kereta . '" sukses dihapus.');
    }
}
