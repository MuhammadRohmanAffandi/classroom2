@extends('kelas/layout/layout')
@section('title', "materi")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatKelas/'.$materi[0]->id_kelas) }}">Forum</a>
        </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatTugas').$materi[0]->id_kelas }}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$materi[0]->id_kelas)}}">Anggota</a>
    </li>
@endsection

@section('isi')
    <div class="row">
        <div class="bs-component">
            <div class="card border-light mb-3" style="min-width: max-content">
                <div class="card-header">
                    <h1><i><b>{{ $materi[0]->judul }}</b></i></h1>
                    <table>
                    </table>
                    <p class="card-text" style="color: black">{{$pembuat[0]->name." - ".$materi[0]->dibuat}}</p>
                </div>
                <div class="card-body container">
                    <p class="card-text">{{ $materi[0]->description }}</p>
                    <form action="{{ url('komentar') }}" method="post">
                        @csrf
                        <div>
                            <input type="hidden" name="id_konten" value="{{ $materi[0]->id }}">
                            <input type="hidden" name="id_pengguna" value="{{ \Auth::user()->id }}">
                            <input type="hidden" name="alamatAsal" value="materi/">
                            <input type="text" name="komentar" class="form-control mb-3" placeholder="Tambahkan komentar kelas" id="inputDefault">
                        </div>
                        <button type="submit" class="badge rounded-pill bg-success" style="min-width: max-content; float: right;">Send</button>
                    </div>
                    <div class="container">
                        <h6>komentar kelas:</h6>
                        <?php $i = 0 ?>
                        @foreach ($komentar as $komen)
                            <li>{{"$user[$i] : $komen->komentar"}}</li>
                            <?php $i = $i + 1; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection