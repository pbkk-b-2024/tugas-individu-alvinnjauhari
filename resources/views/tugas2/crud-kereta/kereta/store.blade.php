@extends('layout.base')

@section('content')
<div class="container">
    <h1>Tambah Kereta</h1>
    
    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk menambah kereta -->
    <form action="{{ route('kereta.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Input untuk Nomor Kereta -->
        <div class="form-group">
            <label for="nomor">Nomor Kereta:</label>
            <input type="text" name="nomor" id="nomor" class="form-control" value="{{ old('nomor') }}" required>
        </div>

        <!-- Input untuk Nama Kereta -->
        <div class="form-group">
            <label for="nama">Nama Kereta:</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <!-- Input untuk Jenis Kereta -->
        <div class="form-group">
            <label for="jenis">Jenis Kereta:</label>
            <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis') }}" required>
        </div>

        <!-- Dropdown untuk Kelas Kereta (Multiple Select) -->
        <div class="form-group">
            <label for="kelas">Kelas Kereta:</label>
            <select name="kelas[]" id="kelas" class="form-control" multiple required>
                @foreach($data['kelas'] as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                @endforeach
            </select>
        </div>
        

        <div id="pemberhentian-container">
            <div class="pemberhentian-row">
                <label for="stasiuns[]">Pilih Stasiun Pemberhentian</label>
                <select name="stasiuns[]" class="form-control">
                    @foreach($data['stasiun'] as $stasiun)
                        <option value="{{ $stasiun->id }}">{{ $stasiun->nama_stasiun }}</option>
                    @endforeach
                </select>
                <label for="jam_kedatangan[]">Jam Kedatangan</label>
                <input type="time" name="jam_kedatangan[]" class="form-control" required>
                <label for="jam_keberangkatan[]">Jam Keberangkatan</label>
                <input type="time" name="jam_keberangkatan[]" class="form-control" required>
            </div>
            
        </div>
        
        <button type="button" id="add-pemberhentian" class="btn btn-primary">Tambah Pemberhentian</button>
        
    
        <button type="button" id="tambah-pemberhentian" class="btn btn-primary">Tambah Pemberhentian</button>

        <!-- Input untuk Foto Kereta -->
        <div class="form-group">
            <label for="foto">Foto Kereta:</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let count = 1;
            const maxPemberhentian = {{ $data['stasiun']->count() }};
            const pemberhentianContainer = document.getElementById('pemberhentian-container');
            const tambahButton = document.getElementById('tambah-pemberhentian');

            tambahButton.addEventListener('click', function () {
                if (count >= maxPemberhentian) {
                    alert('Maksimal pemberhentian sudah tercapai!');
                    return;
                }
                count++;

                const newRow = document.createElement('div');
                newRow.classList.add('pemberhentian-row');

                newRow.innerHTML = `
                    <label for="stasiuns[]">Pilih Stasiun Pemberhentian ${count}</label>
                    <select name="stasiuns[]" class="form-control">
                        @foreach($data['stasiun'] as $stasiun)
                            <option value="{{ $stasiun->id }}">{{ $stasiun->nama_stasiun }}</option>
                        @endforeach
                    </select>
                `;

                pemberhentianContainer.appendChild(newRow);
            });
        });
    </script>

<script>
    let pemberhentianCount = 1;

    document.getElementById('add-pemberhentian').addEventListener('click', function() {
        pemberhentianCount++;
        
        const newPemberhentian = document.createElement('div');
        newPemberhentian.classList.add('pemberhentian-row');
        newPemberhentian.innerHTML = `
            <label for="stasiuns[]">Pilih Stasiun Pemberhentian ${pemberhentianCount}</label>
            <select name="stasiuns[]" class="form-control">
                @foreach($data['stasiun'] as $stasiun)
                    <option value="{{ $stasiun->id }}">{{ $stasiun->nama_stasiun }}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="jam_keberangkatan_${pemberhentianCount}">Jam Keberangkatan:</label>
                <input type="time" name="jam_keberangkatan[${pemberhentianCount}]" id="jam_keberangkatan_${pemberhentianCount}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jam_kedatangan_${pemberhentianCount}">Jam Kedatangan:</label>
                <input type="time" name="jam_kedatangan[${pemberhentianCount}]" id="jam_kedatangan_${pemberhentianCount}" class="form-control" required>
            </div>
        `;

        document.getElementById('pemberhentian-container').appendChild(newPemberhentian);
    });
</script>

    <script>
        $(document).ready(function() {
            $('#kelas').select2(); // Menggunakan Select2 untuk meningkatkan tampilan
        });
    </script>
@endsection
