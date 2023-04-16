<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::all();
        $member = Member::all();
        $penjualan = Penjualan::all();
        $pengeluaran = Pengeluaran::all();
        return view('home',['user'=>$user,'member'=>$member,'penjualan'=>$penjualan,'pengeluaran'=>$pengeluaran]);
    }
}
