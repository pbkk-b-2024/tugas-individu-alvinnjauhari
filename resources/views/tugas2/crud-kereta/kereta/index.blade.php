@extends('layout.base')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="judul-pages">List Kereta</h1>
        @if (Auth::check())
        <a href="{{ route('kereta.create') }}" class="btn btn-primary">Tambah Kereta</a>
        @endif
    </div>

    @if ($data['keretas']->isEmpty())
        <div class="alert alert-warning" role="alert">
            List Kereta masih kosong.
        </div>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th>Jenis</th>
                <th>Jadwal</th>
                <th>Kelas</th>
                <th>Stasiun</th>
                <th>Foto</th> <!-- Kolom Foto -->
                @if (Auth::check())
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data['keretas'] as $index => $kereta)
                <tr>
                    <td>{{ $index + 1 + ($data['keretas']->currentPage() - 1) * $data['keretas']->perPage() }}</td>
                    <td>{{ $kereta->nama }}</td>
                    <td>{{ $kereta->nomor }}</td>
                    <td>{{ $kereta->jenis }}</td>
                    <td>{{ $kereta->jadwal ? $kereta->jadwal->tanggal . ' - ' . $kereta->jadwal->jam_berangkat : 'Belum ada jadwal' }}</td>
                    <td>
                        @foreach ($kereta->kelas as $kelas)
                            <span class="badge badge-info text-dark">{{ $kelas->nama }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($kereta->stasiuns as $stasiun)
                            <span class="badge badge-secondary text-dark">{{ $stasiun->nama_stasiun }}</span>
                        @endforeach
                    </td>
                    <td>
                        @if ($kereta->foto)
                            <img src="{{ asset($kereta->foto) }}" alt="{{ $kereta->nama }}" style="width: 100px; height: auto;">
                        @else
                            <span>Tidak ada foto</span>
                        @endif
                    </td>
                    @if (Auth::check())
                    <td>
                        <a href="{{ route('kereta.index', $kereta->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('kereta.edit', $kereta) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kereta ini?')">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $data['keretas']->links() }}
        </div>
    @endif
</div>
@endsection
