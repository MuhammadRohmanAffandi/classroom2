@extends('layout/main')

@section('title', 'kelas')

@section('nav aktif')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('beranda') }}">Beranda</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('nilaiKelas') }}">Nilai Kelas</a>
    </li>
@endsection