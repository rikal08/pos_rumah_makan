<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('page.pelanggan.data',['pelanggan'=>$pelanggan]);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20', 'unique:pelanggan'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pelanggan'],
            'alamat' => ['required'],
        ]);

        $nohp = $request->telepon;

            // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62'.substr(trim($nohp), 1);
            }
        }

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'telepon' => $hp,
            'email' => $request->email,
            'alamat'=> $request->alamat,
        ]);

        return redirect('/pelanggan')->with('success',"Data Berhasil Disimpan");


    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20', 'unique:pelanggan'],
            'alamat' => ['required'],
        ]);

        $nohp = $request->telepon;

            // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62'.substr(trim($nohp), 1);
            }
        }

        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->telepon = $hp;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return redirect('/pelanggan')->with('success',"Data Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        $pelanggan->delete();

        return redirect('/pelanggan')->with('error',"Data Berhasil Dihapus");
    }
}
