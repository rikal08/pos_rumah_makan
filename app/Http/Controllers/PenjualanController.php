<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $penjualan = Penjualan::query()
                ->select('penjualan.*','member.nama_member','users.name')
                ->leftjoin('member','penjualan.id_member','=','member.id_member')
                ->leftjoin('users','penjualan.id_user','=','users.id')
                ->orderBy('created_at','DESC')->get();
        return view('page.penjualan.data',['penjualan'=>$penjualan]);
    }

}
