@extends('layout.base')

@section('title', 'Genap Ganjil')

@section('content')

<h1 class="judul-pages">Genap Ganjil</h1>

<main class="container-pages">
<h2>Masukkan Angka</h2>
<form action="#" method="GET">
    <label for="n">Enter a number (n):</label>
    <input type="text" name="n" id="n" min="1" required>
    <button type="submit">Submit</button>
</form>

@if(count($numberDetails) > 0)
    <h2>Hasil</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor Urut</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($numberDetails as $detail)
                <tr>
                    <td>{{ $detail['number'] }}</td>
                    <td>{{ $detail['type'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</main>


@endsection