@extends('kelas/layout/layout')
@section('title', "anggota")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatKelas/'.$id) }}">Forum</a>
        </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatTugas/'.$id)}}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg active" href="#">Anggota</a>
    </li>
    @if ($isUserPembuat)
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatNilai/'.$id)}}">Nilai</a>
    </li>
    @endif
@endsection

@section('isi')
    @if($user != false)
        <div class="card text-white bg-success mb-3" style="min-width: max-content">
            <div class="card-header container">
                        <p class="card-title"><b><i>Guru</i></b></p>
                        <!-- <button type="button" class="btn btn-light" style="float: right;">Tambah Pengajar</button> -->
            </div>
            <div class="card-body card bg-light">
                <p class="card-text" style="color: black;"><i>{{ $pembuat[0]->name }}</i></p>
            </div>
        </div>
        <div class="card text-white bg-success mb-3" style="min-width: max-content">
            <div class="card-header container">
                        <p class="card-title"><b><i>Anggota</i></b></p>
                        <a type="button" class="btn btn-light" style="float: right;" href="{{url('tambahAnggota/'.$id)}}">Tambah Anggota</a>
            </div>
            <div class="card-body card bg-light">
                @foreach ($user as $u)
                    @if($u->name == $pembuat[0]->name)
                    @else
                        <p class="card-text" style="color: black;"><i>{{ $u->name }}</i></p>
                    @endif
                @endforeach
            </div>
        </div>
    @else
        <h1>salah blog</h1>
    @endif
@endsection