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
        <a class="btn btn-primary btn-lg active" href="{{url('lihatNilai/'.$id)}}">Nilai</a>
    </li>
@endsection

@section('isi')
    @if ($adaTugas)
        <table class="table table-bordered">
            <thead>
            <tr  class="table-success">
                <th scope="col">Nama</th>
                @foreach($tugas as $t)

                <th scope="col">{{ $t->judul }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @foreach ($anggota as $a)
                    @if ($a->id_pengguna == $id_pembuat)
                    @else
                    <tr">
                        <th scope="row">{{ $namaPengguna[$i] }}</th>
                        <?php $j = 0 ?>
                        @foreach ($tugas as $t)
                        <form action="{{ url('ubahNilai') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_tugas" value="{{ $t->id }}">
                            <input type="hidden" name="id_pengguna" value="{{ $a->id_pengguna }}">
                            @if($nilai[$i][$j] == " ")
                            <td><button type="submit" class="btn btn-link"> nilai sekarang </button></td>
                            @else
                            <td><button type="submit" class="btn btn-link"> {{ $nilai[$i][$j] }} </button></td>
                            @endif
                            <?php $j = $j + 1 ?>
                        </form>
                        @endforeach
                    </tr>
                    @endif
                    <?php $i = $i + 1 ?>
                @endforeach
            </tbody>
        </table>   
    @else
        <div class="alert alert-dismissible alert-success">
        <h3>Belum ada tugas dibuat</h3>
        </div>
    @endif      
@endsection