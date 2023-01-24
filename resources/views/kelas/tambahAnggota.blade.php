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
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$id)}}">Anggota</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatNilai/'.$id)}}">Nilai</a>
    </li>
@endsection

@section('isi')
    @if (session('statusTambahAnggota'))
        <div class="alert alert-dismissible alert-danger">
            {{ session('statusTambahAnggota') }}
        </div>
    @endif
    <div class="card text-center">
        <div class=c ard-body>
            <div class="container">
                <br>
                <form action="{{ url('tambahkanAnggota') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="mb-3">
                        <label for="id_user" class="form-label">Masukan id user</label>
                        <input type="text" id="id user" name="id user" class="form-control @error('id user') is-invalid @enderror" placeholder="Masukan id user">
                        @error('code')
                        <div id="validationServer05Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class=c ard-body>
                        <button type="submit" class="btn btn-primary" name="submit">Tambahkan</button>
                        <a href="{{url('anggotaKelas/'.$id)}}" class="btn btn-primary">Batal</a>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
@endsection
            