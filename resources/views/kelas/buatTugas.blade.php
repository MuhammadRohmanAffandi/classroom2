@extends('kelas/layout/layout')

@section('title', "tambah materi")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg " href="{{ url('lihatKelas/'.$id) }}">Forum</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatTugas/'.$id) }}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$id)}}">Anggota</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatNilai/'.$id)}}">Nilai</a>
    </li>
@endsection

@section('isi')
    <div class="card">
        <div class="container">
        <form action="{{ url('buatkanTugas') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <fieldset>
                <legend>Tambah tugas</legend>
                
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukan judul tugas">
                    @error('judul')
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi tugas</label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukan deskripsi tugas">
                </div>

                <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="text" id="deadline" name="deadline" class="form-control" placeholder="YYYY-MM-DD">
                </div>

                <div class=c ard-body>
                    <button type="submit" class="btn btn-primary" name="submit">Unggah</button>
                    <a href="{{ url('lihatTugas/'.$id) }}" class="btn btn-primary">Batal</a>
                </div>
                <br>
                
            </fieldset>
        </form>
        </div>
    </div>            
@endsection