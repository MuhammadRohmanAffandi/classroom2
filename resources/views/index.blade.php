@extends('layout/main')

@section('title', 'kelas')

@section('nav aktif')
    <li class="nav-item">
        <a class="nav-link active" href="{{ url('beranda') }}">Beranda</a>
    </li>
@endsection

@section('isi')
    <!-- {{ Auth::user()->id}} -->
    @foreach( $kelas as $kls)
    
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="Tab1" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc1"
                        type="button" role="tab" aria-controls="desc1" aria-selected="true">Kelas</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="desc1" role="tabpanel" aria-labelledby="home">
                    <h3 class="card-title">{{ $kls["name"] }}</h3>
                    <p class="card-text">{{ $kls["description"] }}</p>
                    <input type="hidden" name="id" value="{{ $kls['id'] }}">
                    <a href="lihatKelas/{{ $kls['id'] }}" class="btn btn-primary">Klik, untuk melihat kelas</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
   
    <div class="card text-center">
        <div class=c ard-body>
            <p> </p>
            <a href="{{ url('buatKelas') }}" class="btn btn-primary btn-lg">Buat Kelas</a>
            <a href="{{ url('joinKelas') }}" class="btn btn-primary btn-lg">Join Kelas</a>
            <p> </p>
        </div>
    </div>
@endsection