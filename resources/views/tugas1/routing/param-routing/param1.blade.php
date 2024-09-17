@extends('layout.base')

@section('title', 'Genap Ganjil')

@section('content')
<h1 class="judul-pages">One Parameter Result</h1>
<main class="container-pages">
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Hasil</h5>
    </div>
    <div class="card-body">
        <div>URL : {{ url()->current() }}</div>
        <div> Parameter 1 : {{ $data['param1']}}</div>
    </div>
    <div class="card-footer">
        <a href="{{ url('/tugas1/routing/param') }}">
            <button class="btn btn-primary">Kembali</button>
        </a>
    </div>
</div>
</main>

@endsection


