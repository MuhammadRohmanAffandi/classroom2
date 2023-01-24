<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index()
    {
        $kelas = DB::table('kelas_pengguna')->where('id_pengguna', '=', \Auth::user()->id)->get();
        // $kelas = DB::table('kelas_pengguna')->select('id_kelas')->where('id_pengguna', '=',\Auth::user()->id)->get();
        // dd($kelas);
        $i = 0;
        foreach ($kelas as $kls) {
            $id = $kls->id_kelas;
            $variabel_kelas = DB::table('kelas')->where('id', '=', $id)->get();
            $kelas[$i] = [
                "id" => $variabel_kelas[0]->id,
                "name" => $variabel_kelas[0]->name,
                "description" => $variabel_kelas[0]->description,
                "id_pembuat" => $variabel_kelas[0]->id_pembuat
            ];
            $i = $i+1;
        }
        // foreach ($kelas as $kls) {
        //     print_r($kls);
        // echo $kelas[0][name];
        // // $nama = DB::table('kelas')->select('name')->where('id', '=', '1')->get();
        // // echo $nama[0]->name;
        // }
        // dd($kelas);
        return view('index', compact('kelas'));
    }

    public function daftarKelas()
    {
        return view('daftarKelas');
    }
    
    public function nilaiKelas()
    {
        return view('nilaiKelas');
    }
}

