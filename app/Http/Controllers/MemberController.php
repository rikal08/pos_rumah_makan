<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $member = Member::all();
        return view('page.member.data',['member'=>$member]);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'nama_member' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20', 'unique:member'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:member'],
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

        Member::create([
            'nama_member' => $request->nama_member,
            'telepon' => $hp,
            'email' => $request->email,
            'alamat'=> $request->alamat,
        ]);

        return redirect('/member')->with('success',"Data Berhasil Disimpan");


    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);

        $request->validate([
            'nama_member' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20', 'unique:member'],
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

        $member->nama_member = $request->nama_member;
        $member->telepon = $hp;
        $member->email = $request->email;
        $member->alamat = $request->alamat;
        $member->save();

        return redirect('/member')->with('success',"Data Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        $member->delete();

        return redirect('/member')->with('error',"Data Berhasil Dihapus");
    }
}
