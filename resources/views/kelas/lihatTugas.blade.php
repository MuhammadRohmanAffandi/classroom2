@extends('kelas/layout/layout')
@section('title', "tugas")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatKelas/'.$id) }}">Forum</a>
        </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg active" href="#">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$id)}}">Anggota</a>
    </li>
    @if ($isUserPembuat)
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatNilai/'.$id)}}">Nilai</a>
    </li>
    @endif
@endsection

@section('isi')
    @if ($isUserPembuat) 
    <a type="button" class="btn btn-outline-success mb-3" href="{{url('buatTugas/'.$id)}}">Tambah Tugas</a>
    @endif
    @foreach ($tugas as $tgs)
    <div class="card text-white bg-success mb-3" style="min-width: max-content">
        <a href="{{ url('tugas/'.$tgs->id) }}">
        <div class="card-header">
            <p class="card-title" style="color: white;"><b><i>{{$tgs->judul}}</i></b></p>
            <p class="card-text" style="color: white; line-height-step: 0%;"><i>{{$tgs->dibuat}}</i></p>
        </div>
        </a>
        <div class="card-body card bg-light">
            <p class="card-text" style="color: black;">{{$tgs->description}}</p>
        </div>
    </div>
    @endforeach
@endsection