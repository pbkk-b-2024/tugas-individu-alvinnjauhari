@extends('layout.base')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Edit Data Kereta</h2>

    <form action="{{ route('kereta.update', $data['kereta']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nomor">Nomor Kereta:</label>
            <input type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor', $kereta->nomor) }}" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Kereta:</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $kereta->nama) }}" required>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis Kereta:</label>
            <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis', $kereta->jenis) }}" required>
        </div>

        <div class="form-group">
            <label for="foto">Foto Kereta:</label>
            <input type="file" name="foto" id="foto" class="form-control">
            @if ($kereta->foto)
                <img src="{{ asset($kereta->foto) }}" alt="Foto Kereta" class="img-thumbnail mt-2" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="kelas">Kelas Kereta:</label>
            <select name="kelas[]" id="kelas" class="form-control" multiple required>
                @foreach($data['kelas'] as $kelas)
                    <option value="{{ $kelas->id }}" {{ in_array($kelas->id, $kereta->kelas->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $kelas->nama }}</option>
                @endforeach
            </select>
        </div>

        <h4 class="mt-4">Pemberhentian Stasiun</h4>
        <div id="pemberhentian-container">
            @foreach ($kereta->stasiuns as $index => $stasiun)
                <div class="pemberhentian-row mb-3 p-3 border rounded bg-light">
                    <h5>Pemberhentian {{ $index + 1 }}</h5>
                    <label for="stasiuns[]">Pilih Stasiun Pemberhentian:</label>
                    <select name="stasiuns[]" class="form-control mb-2">
                        @foreach($data['stasiuns'] as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $stasiun->id ? 'selected' : '' }}>{{ $s->nama_stasiun }}</option>
                        @endforeach
                    </select>

                    <label for="jam_kedatangan[]">Jam Kedatangan:</label>
                    <input type="time" name="jam_kedatangan[]" class="form-control mb-2" value="{{ old('jam_kedatangan.' . $index, $stasiun->pivot->jam_kedatangan) }}" required>

                    <label for="jam_keberangkatan[]">Jam Keberangkatan:</label>
                    <input type="time" name="jam_keberangkatan[]" class="form-control" value="{{ old('jam_keberangkatan.' . $index, $stasiun->pivot->jam_keberangkatan) }}" required>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

@endsection
