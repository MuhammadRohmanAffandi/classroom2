@extends('kelas/layout/layout')

@section('title', "tambah materi")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg " href="{{ url('lihatKelas/'.$isi[0]->id_kelas) }}">Forum</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatTugas/'.$isi[0]->id_kelas) }}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$isi[0]->id_kelas)}}">Anggota</a>
    </li>
@endsection

@section('isi')
<div class="card border-primary mb-3" style="max-width: 20rem;">
  <div class="card-header">{{ $user[0]->name }}</div>
  <div class="card-body">
    <h4 class="card-title">{{ $isi[0]->judul }}</h4>
    <form action="{{ url('updateNilai') }}" method="post">
        @csrf
        <input type="hidden" name="id_tugas" value="{{ $isi[0]->id}}">
        <input type="hidden" name="id_pengguna" value="{{ $user[0]->id}}">
        <input type="hidden" name="id_kelas" value="{{ $isi[0]->id_kelas}}">
        <label for="nilai" class="form-label">Ganti nilai</label>
        <input type="text" id="nilai" name="nilai" class="form-control" placeholder="Masukan nilai" value="{{$nilai[0]->nilai}}" min="0" max="100>
        <div class="card-body">
            <button type="submit" class="btn btn-primary" name="submit">Ganti</button>
            <a href="{{ url('lihatKelas/'.$isi[0]->id_kelas) }}" class="btn btn-primary">Batal</a>
        </div>
    </form>
    </div>
</div>
@endsection