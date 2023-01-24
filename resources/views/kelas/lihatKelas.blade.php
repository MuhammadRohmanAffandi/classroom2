@extends('kelas/layout/layout')
@foreach ($kelas as $kls)
@section('title', "$kls->name")

@section('nav aktif')
    <li class="nav-item">
        <a class="btn btn-primary btn-lg active" href="#">Forum</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{ url('lihatTugas/'.$kls->id) }}">Tugas Kelas</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('anggotaKelas/'.$kls->id)}}">Anggota</a>
    </li>
    @if($isUserPembuat)
    <li class="nav-item">
        <a class="btn btn-primary btn-lg" href="{{url('lihatNilai/'.$kls->id)}}">Nilai</a>
    </li>
    @endif
@endsection

@section('isi')
    <div class="card text-white bg-primary mb-3" style="min-height: 15rem">
        <div class="card-body">
            <p></p>
            <h4 class="card-title"><b>{{$kls->name}}</b></h4>
            <p class="card-text">Code kelas: {{$kls->id}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="bs-component">
            @if ($isUserPembuat) 
            <a type="button" class="btn btn-outline-success mb-3" href="{{url('tambahMateri/'.$kls->id)}}" style="min-width: 100%">Tambah materi</a>   
            @endif
                <div class="card bg-light mb-3" style="max-width: 20rem;">
                    <div class="card-header">Mendatang</div>
                    <div class="card-body">
                        <?php $adaDeadline = true?>
                        @foreach ($deadline as $dead)
                            <?php $adaDeadline = true?>
                            <div>
                                <a href="{{url('tugas/'.$dead->id)}}" class="alert-link">{{ "$dead->judul->$dead->deadline" }}</a>
                            </div>
                        @endforeach
                        @if($adaDeadline)
                        @else
                        <p class="card-text" style="color: darkgrey;">Tidak ada tugas yang perlu diselesaikan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="bs-component">
                <div class="card bg-light mb-3" style="min-width: max-content">

                    <form action="{{ url('buatPengumuman') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $kls->id }}">
                        <div>
                            <input type="text" name="isi" class="form-control" placeholder="Umumkan sesuau kekelas Anda"
                                id="inputDefault">
                        </div>
                        <button type="submit" class="badge rounded-pill bg-success" name="submit" style="min-width: 100%">send</button>
                    </form>

                </div>
                <?php $i = 0?>
                @foreach ($isi_kelas as $isi)
                    @if($isi->jenis == 1)
                    <div class="card text-white bg-success mb-3" style="min-width: max-content">
                        <a href="{{url('tugas/'.$isi->id)}}">
                            <div class="card-header">
                                <p class="card-title" style="color: white;"><b><i>{{$user[$i]}}</i></b> mamposting tugas baru: <b><i>{{ $isi->judul }}</i></b></p>
                                <p class="card-text" style="color: white; line-height-step: 0%;"><i>{{ $isi->dibuat }}</i></p>
                            </div>
                        </a>
                        
                        <div class="card-body card bg-light">
                            <p class="card-text" style="color: black;">{{ $isi->description }}</p>
                        </div>
                    </div>
                    @elseif ($isi->jenis == 2)
                    <div class="card text-white bg-success mb-3" style="min-width: max-content">
                        <a href="{{url('materi/'.$isi->id)}}">
                            <div class="card-header">
                                <p class="card-title" style="color: white;"><b><i>{{$user[$i]}}</i></b> mamposting materi baru: <b><i>{{ $isi->judul }}</i></b></p>
                                <p class="card-text" style="color: white; line-height-step: 0%;"><i>{{ $isi->dibuat }}</i></p>
                            </div>
                        </a>
                        
                        <div class="card-body card bg-light">
                            <p class="card-text" style="color: black;">{{ $isi->description }}</p>
                        </div>
                    </div>
                    @else
                    <div class="card bg-light mb-3" style="min-width: max-content">
                        <div class="card-header">
                            <b><i>{{$user[$i]}}</i></b>
                            <p class="card-text" style="color: darkgray;"><i>{{ $isi->dibuat }}</i></p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $isi->description }}</p>
                        </div>
                    </div>
                    @endif
                    <?php $i = $i + 1 ?>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@endforeach