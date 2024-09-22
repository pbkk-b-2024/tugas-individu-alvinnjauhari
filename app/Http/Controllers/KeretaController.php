<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kereta;
use App\Models\Stasiun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreKeretaRequest;
use App\Http\Requests\UpdateKeretaRequest;

class KeretaController extends Controller
{
    public function index(Request $request)
    {
        // Relasi yang ingin dimuat bersamaan
        $relations = ['kelas', 'stasiuns'];

        // Eager Loading dengan memuat ketiga relasi sekaligus
        $data['keretas'] = Kereta::with($relations)->paginate(10); // Misalnya paginasi 10 item per halaman

        return view('tugas2.crud-kereta.kereta.index', compact('data'));
    }

    public function create()
    {
        // Ambil semua kelas dan stasiun
        $data['kelas'] = Kelas::all();
        $data['stasiun'] = Stasiun::all();
        return view('tugas2.crud-kereta.kereta.store', compact('data'));
    }

    public function store(StoreKeretaRequest $request)
{
    $validatedData = $request->validated();

    // Handle upload foto
    if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('foto_kereta', 'public'); // Menyimpan ke storage public
    }

    $kereta = Kereta::create($validatedData);

    // Hubungkan kereta dengan kelas dan stasiun
    if ($request->has('kelas')) {
        $kereta->kelas()->attach($request->input('kelas'));
    }

    $stasiunCount = count($request->input('stasiuns'));
    $jamKedatangan = $request->input('jam_kedatangan', []);
    $jamKeberangkatan = $request->input('jam_keberangkatan', []);

    if (count($jamKedatangan) !== $stasiunCount || count($jamKeberangkatan) !== $stasiunCount) {
        // Tangani kesalahan, misalnya:
        return redirect()->back()->withErrors(['msg' => 'Jumlah stasiun dan waktu tidak sesuai.']);
    }

    // Hubungkan kereta dengan stasiun (Many-to-Many)
    if ($request->has('stasiuns')) {
        $stasiunData = [];
        foreach ($request->input('stasiuns') as $index => $stasiunId) {
            $stasiunData[$stasiunId] = [
                'urutan_pemberhentian' => $index + 1,
                'jam_kedatangan' => $jamKedatangan[$index] ?? null,
                'jam_keberangkatan' => $jamKeberangkatan[$index] ?? null
            ];
        }
    $kereta->stasiuns()->attach($stasiunData);

    }

    return redirect()->route('kereta.index')->with('success', 'Kereta berhasil ditambahkan.');
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
        return view('tugas2.crud-kereta.kereta.edit', compact('data','kereta'));
    }

    // Method update: Untuk mengupdate data kereta
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nomor' => 'required',
        'nama' => 'required',
        'jenis' => 'required',
        'kelas' => 'required|array',
        'stasiuns' => 'required|array',
        'jam_kedatangan' => 'required|array',
        'jam_keberangkatan' => 'required|array',
    ]);

    $kereta = Kereta::findOrFail($id);
    $kereta->nomor = $request->input('nomor');
    $kereta->nama = $request->input('nama');
    $kereta->jenis = $request->input('jenis');

    // Update foto jika ada
    if ($request->hasFile('foto')) {
        // Logika untuk menyimpan foto dan mengupdate pathnya
    }

    $kereta->save();

    // Mengupdate hubungan banyak ke banyak dengan stasiun
    $kereta->stasiuns()->sync([]);
    foreach ($request->input('stasiuns') as $index => $stasiunId) {
        $kereta->stasiuns()->attach($stasiunId, [
            'urutan_pemberhentian' => $index + 1,
            'jam_kedatangan' => $request->input('jam_kedatangan')[$index],
            'jam_keberangkatan' => $request->input('jam_keberangkatan')[$index],
        ]);
    }

    return redirect()->route('kereta.index')->with('success', 'Data kereta berhasil diupdate.');
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
