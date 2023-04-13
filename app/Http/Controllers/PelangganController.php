<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

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
}
