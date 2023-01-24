<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('kelas/buatKelas');
    }

    public function join()
    {
        return view('kelas/joinKelas');
    }

    public function komentar(Request $request)
    {
        $komentar = $request->komentar;
        $id_asal = $request->id_konten;
        //  dd("$request->alamatAsal$id_asal");
        if ($komentar == null) {
            return redirect("$request->alamatAsal$id_asal");
        }
        DB::table('komentar')->insert(
            [
                'id_konten' => $request->id_konten, 
                'id_pengguna' => $request->id_pengguna, 
                'komentar' => $komentar
            ]
        );
        return redirect("$request->alamatAsal$id_asal");
    }

    public function tugas($id) {
        $tugas = DB::table('isi_kelas')
            ->where('id', '=', $id)
            ->get();
        $pembuat = DB::table('users')->select('name')->where('id', '=', $tugas[0]->id_pembuat)->get();
        $komentar = DB::table('komentar')
            ->where('id_konten', '=', $id)
            ->get();
        $i = 0;
        $user = false;
        foreach ($komentar as $kom)
        {
            $temp = DB::table('users')->where('id', '=', $kom->id_pengguna)->get();
            $user[$i] = $temp[0]->name;
            $i = $i + 1;
        }
        // dd($pembuat);
        // dd($komentar);
        return view('kelas/tugas', compact('tugas', 'pembuat', 'komentar', 'user'));
    }

    public function materi($id) 
    {
        $materi = DB::table('isi_kelas')
            ->where('id', '=', $id)
            ->get();
        $pembuat = DB::table('users')->select('name')->where('id', '=', $materi[0]->id_pembuat)->get();
        // dd($pembuat);
        $komentar = DB::table('komentar')
            ->where('id_konten', '=', $id)
            ->get();
        $i = 0;
        $user = false;
        foreach ($komentar as $kom)
        {
            $temp = DB::table('users')->where('id', '=', $kom->id_pengguna)->get();
            $user[$i] = $temp[0]->name;
            $i = $i + 1;
        }
        return view('kelas/materi', compact('materi', 'pembuat', 'komentar', 'user'));
    }

    public function nilai($id)
    {
        $cek = DB::table('kelas_pengguna')
            ->where('id_pengguna', '=', \Auth::user()->id)
            ->where('id_kelas', '=', $id)
            ->count();
        if ($cek == 0) {
            return redirect('beranda');
        }

        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        if ($cek == 0) {
            return redirect('lihatKelas/'.$id);
        }

        $anggota = DB::table('kelas_pengguna')->where('id_kelas', '=', $id)->get();
        $tugas = DB::table('isi_kelas')
            ->where('jenis', '=', 1)
            ->where('id_kelas', '=', $id)
            ->get();
        if (count($tugas) == 0) {
            $adaTugas = false;
            return view('kelas/lihatNilai', compact('id', 'adaTugas'));
        }
        $adaTugas = true;
        // dd($tugas);
        $i = 0;
        foreach($anggota as $a)
        {   
            $temp = DB::table('users')->where('id', '=', $a->id_pengguna)->get();
            $namaPengguna[$i] = $temp[0]->name;
            $j = 0;
            foreach($tugas as $t) 
            {
                $temp = DB::table('nilai')
                    ->where('id_tugas', '=', $t->id)
                    ->where('id_pengguna', '=', $a->id_pengguna)
                    ->get();
                if (count($temp) == 0) 
                {
                    $nilai[$i][$j] = " ";
                } else
                {
                    $nilai[$i][$j] = $temp[0]->nilai;
                }
                $j = $j + 1;
            }
            $i = $i + 1;
        }
        $id_pembuat = DB::table('kelas')->where('id', '=', $id)->get();
        $id_pembuat = $id_pembuat[0]->id_pembuat;
        // dd($id_pembuat);
        // echo $nilai[1][1];
        // dd($nilai);
        return view('kelas/lihatNilai', compact('id', 'namaPengguna', 'nilai', 'tugas', 'adaTugas', 'id_pembuat', 'anggota'));
    }

    public function ubahNilai(Request $request)
    {
        $nilai = DB::table('nilai')
        ->where('id_tugas', '=', $request->id_tugas)
        ->where('id_pengguna', '=', $request->id_pengguna)
        ->get();
        $isi = DB::table('isi_kelas')
        ->where('id', '=', $request->id_tugas)
        ->get();
        $user = DB::table('users')
        ->where('id', '=', $request->id_pengguna)
        ->get();
        if (count($nilai) == 0) {
            return view('kelas/beriNilai', compact('isi', 'user'));
        }
        return view('kelas/ubahNilai', compact('nilai', 'isi', 'user'));
    }
    
    public function updateNilai(Request $request)
    {
        // $request->validate([
        //     'nilai' => 'max:100',
        //     'nilai' => 'min:0',
        // ]);
        // dd($request);
        DB::table('nilai')
        ->where('id_tugas', $request->id_tugas)
        ->where('id_pengguna', $request->id_pengguna)
        ->update(['nilai' => $request->nilai]);
        return redirect('lihatNilai/'.$request->id_kelas);
    }

    public function createNilai(Request $request)
    {
        DB::table('nilai')->insert(
            [
                'id_tugas' => $request->id_tugas, 
                'id_pengguna' => $request->id_pengguna, 
                'nilai' => $request->nilai
            ]
        );
        return redirect('lihatNilai/'.$request->id_kelas);
    }

    public function lihatTugas($id)
    {
        $cek = DB::table('kelas_pengguna')
            ->where('id_pengguna', '=', \Auth::user()->id)
            ->where('id_kelas', '=', $id)
            ->count();
        if ($cek == 0) {
            return redirect('beranda');
        }
        $tugas = DB::table('isi_kelas')
            ->where('jenis', '=', 1)
            ->where('id_kelas', '=', $id)
            ->get();
        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        $isUserPembuat = false;
        if ($cek == 1) {
            $isUserPembuat = true;
        }
        return view('kelas/lihatTugas', compact('tugas', 'id', 'isUserPembuat'));
    }

    public function anggotaKelas($id)
    {
        $cek = DB::table('kelas_pengguna')
            ->where('id_pengguna', '=', \Auth::user()->id)
            ->where('id_kelas', '=', $id)
            ->count();
        if ($cek == 0) {
            return redirect('beranda');
        }
        $jumlah = DB::table('kelas_pengguna')->where('id_kelas', '=', $id)->count();
        $cek = DB::table('kelas')->select('id_pembuat')->where('id', '=', $id)->get();
        $pembuat = DB::table('users')->select('name')->where('id', '=', $cek[0]->id_pembuat)->get();
        $user = false;
        if ($jumlah > 0) {
            $cek = DB::table('kelas_pengguna')->where('id_kelas', '=', $id)->get();
            $i = 1;
            foreach($cek as $c) 
            {
                if ($i == 1) 
                {
                    $user = DB::table('users')->select('name')->where('id', '=', $c->id_pengguna)->get();
                    $i = $i+1;
                } else 
                {
                    $temp = DB::table('users')->select('name')->where('id', '=', $c->id_pengguna)->get();
                        foreach ($temp as $t)
                        {
                            $user->add($t);
                        }
                }
            }
        }
        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        $isUserPembuat = false;
        if ($cek == 1) {
            $isUserPembuat = true;
        }
        return view('kelas/anggotaKelas', compact('user', 'id', 'pembuat', 'isUserPembuat'));
        // dd($user);
        // $request = DB::table('users')->where('id', '=', 1)->get();
        // $temp = DB::table('users')->where('id', '=', 2)->get();
        // foreach ($temp as $t)
        // {
        //     $request->add($t);
        // }
        
        // foreach($request as $req)
        // {
        //     echo $req->name;
        // }
        // print_r($request);
        // $request->request->add(['name' => 'asw']);
    }

    public function pengumuman(Request $request)
    {
        $deskripsi = $request->isi;
        $id_kelas = $request->id;
        if ($deskripsi == null) {
            return redirect('lihatKelas/'.$id_kelas);
        }
        
        $jenis = 3;
        $id_pembuat = \Auth::user()->id;

        DB::table('isi_kelas')->insert(
            [
                'id_kelas' => $id_kelas, 
                'jenis' => $jenis,
                'description' => $deskripsi,
                'id_pembuat' => $id_pembuat
            ]
        );
        return redirect('lihatKelas/'.$id_kelas);
        // dd($isi_kelas);
    }

    public function tambahMateri($id)
    {
        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        if ($cek == 0) {
            return redirect('lihatKelas/'.$id);
        }
        return view('kelas/tambahMateri', compact('id'));
    }

    public function tambahkanMateri(Request $request)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        $id_kelas = $request->id;
        $judul = $request->judul;
        $jenis = 2;
        $deskripsi = $request->deskripsi;
        $id_pembuat = \Auth::user()->id;

        DB::table('isi_kelas')->insert(
            [
                'id_kelas' => $id_kelas, 
                'judul' => $judul,
                'jenis' => $jenis,
                'description' => $deskripsi,
                'id_pembuat' => $id_pembuat
            ]
        );
        return redirect('lihatKelas/'.$id_kelas);
    }

    public function buatTugas($id)
    {
        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        if ($cek == 0) {
            return redirect('lihatTugas/'.$id);
        }
        return view('kelas/buatTugas', compact('id'));
    }

    public function buatkanTugas(Request $request) {
        
        $request->validate([
            'judul' => 'required'
        ]);

        $id_kelas = $request->id;
        $judul = $request->judul;
        $jenis = 1;
        $deskripsi = $request->deskripsi;
        $id_pembuat = \Auth::user()->id;
        $deadline = $request->deadline;

        DB::table('isi_kelas')->insert(
            [
                'id_kelas' => $id_kelas, 
                'judul' => $judul,
                'jenis' => $jenis,
                'description' => $deskripsi,
                'id_pembuat' => $id_pembuat,
                'deadline' => $deadline
            ]
        );
        return redirect('lihatKelas/'.$id_kelas);
    }

    public function tambahAnggota($id) {
        return view('kelas/tambahAnggota', compact('id'));
    }

    public function tambahkanAnggota(Request $request) 
    {
        $request->validate([
            'id_user' => 'required'
        ]);
        
        $user = DB::table('users')->where('id', '=', $request->id_user)->count();
        if ($user != 1) {
            echo 'tidak ditemukan';
            return redirect('tambahAnggota/'.$request->id)->with('statusTambahAnggota', 'Pengguna tidak ditemukan!');
        } else {
            $kelas_pengguna = DB::table('kelas_pengguna')
                            ->where('id_pengguna', '=', $request->id_user)
                            ->where('id_kelas', '=', $request->id)
                            ->count();
            if ($kelas_pengguna == 1) {
                echo 'telas dikelas';
                return redirect('tambahAnggota/'.$request->id)->with('statusTambahAnggota', 'Pengguna telah berada pada kelas ini!');
            } else {
                DB::table('kelas_pengguna')->insert(
                    [
                    'id_pengguna' => $request->id_user, 
                    'id_kelas' => $request->id
                    ]
                );
                return redirect('anggotaKelas/'.$request->id);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        DB::table('kelas')->insert(
            [
            'name' => $request->name, 
            'description' => $request->deskripsi,
            'id_pembuat' => \Auth::user()->id
            ]
        );
        //kurang menambahkan user pembuat ke tabel kelas_pengguna
        $tambah = DB::table('kelas')->where('dibuat', '=', DB::table('kelas')->max('dibuat'))->get();
        foreach($tambah as $tbh) {
            DB::table('kelas_pengguna')->insert(
                [
                'id_pengguna' => \Auth::user()->id, 
                'id_kelas' => $tbh->id
                ]
            );  
        }
        //
        return redirect('beranda');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);
        
        $kelas = DB::table('kelas')->where('id', '=', $request->code)->count();
        if ($kelas != 1) {
            return redirect('joinKelas')->with('statusJoin', 'Kelas tidak ditemukan!');
        } else {
            $kelas_pengguna = DB::table('kelas_pengguna')
                            ->where('id_pengguna', '=', \Auth::user()->id)
                            ->where('id_kelas', '=', $request->code)
                            ->count();
            if ($kelas_pengguna == 1) {
                return redirect('joinKelas')->with('statusJoin', 'Anda sudah berada dikelas tersebut!');
            } else {
                DB::table('kelas_pengguna')->insert(
                    [
                    'id_pengguna' => \Auth::user()->id, 
                    'id_kelas' => $request->code
                    ]
                );
                return redirect('beranda');
            }
        }
        
        // dd($kelas_pengguna);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cek = DB::table('kelas_pengguna')
            ->where('id_pengguna', '=', \Auth::user()->id)
            ->where('id_kelas', '=', $id)
            ->count();
        if ($cek == 0) {
            return redirect('beranda');
        }
        $tanggal = date("Y-m-d");
        $deadline = DB::table('isi_kelas')
            ->where('id_kelas', '=', $id)
            ->where('deadline', '>', "$tanggal")
            ->orderBy('deadline', 'asc')
            ->get();
        $cek = DB::table('kelas')
            ->where('id', '=', $id)
            ->where('id_pembuat', '=', \Auth::user()->id)
            ->count();
        $isUserPembuat = false;
        if ($cek == 1) {
            $isUserPembuat = true;
        }
        $kelas = DB::table('kelas')->where('id', '=', $id)->get();
        $isi_kelas = DB::table('isi_kelas')->where('id_kelas', '=', $id)->orderBy('id', 'desc')->get();
        $i = 0;
        foreach ($isi_kelas as $isi) {
            $namaUser = DB::table('users')->select('name')->where('id', '=', $isi->id_pembuat)->get();
            // dd($namaUser);
            $user[$i] = $namaUser[0]->name;
            $i = $i + 1;
        }
        // dd($user);
        if ($i > 0) {
            return view('kelas/lihatKelas', compact('kelas', 'isi_kelas', 'user', 'isUserPembuat', 'deadline'));
        }
        // dd($user);
        return view('kelas/lihatKelas', compact('kelas', 'isi_kelas', 'isUserPembuat', 'deadline'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
