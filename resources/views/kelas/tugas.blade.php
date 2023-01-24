@extends('kelas/layout/layout')
@section('title', "tugas")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatKelas/'.$tugas[0]->id_kelas) }}">Forum</a>
        </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatTugas/').$tugas[0]->id_kelas }}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$tugas[0]->id_kelas)}}">Anggota</a>
    </li>
@endsection

@section('isi')
    <div class="row">
        <div class="col-lg-9">
            <div class="bs-component">
                <div class="card border-light mb-3" style="min-width: max-content">
                    <div class="card-header">
                        <h1><i><b>{{ $tugas[0]->judul }}</b></i></h1>
                        <table>
                        </table>
                        <p class="card-text" style="color: black">{{$pembuat[0]->name." - ".$tugas[0]->dibuat}}</p>
                        <p style="float: right" class="text-danger">{{ $tugas[0]->deadline }}</p>
                    </div>
                    <div class="card-body container">
                        <p class="card-text">{{ $tugas[0]->description }}</p>
                        <form action="{{ url('komentar') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_konten" value="{{ $tugas[0]->id }}">
                            <input type="hidden" name="id_pengguna" value="{{ \Auth::user()->id }}">
                            <input type="hidden" name="alamatAsal" value="tugas/">
                            <div>
                                <input type="text" name="komentar" class="form-control mb-3" placeholder="Tambahkan komentar kelas" id="komentar">
                            </div>
                            <button type="submit" class="badge rounded-pill bg-success" style="min-width: max-content; float: right;">Send</button>
                        </form>
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
        <div class="col-lg-3">
            <div class="bs-component">
                <div class="card border-success mb-3" style="max-width: 20rem;">
                    <div class="card-header">Masukan file tugas</div>
                    <div class="card-body">
                        <input type="file" id="fileTugas" name="fileTugas" class="form-control mb-3">
                        <button type="submit" class="badge rounded-pill  bg-success" style="min-width: 100%" name="submit">Unggah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection