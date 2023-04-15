<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $penjualan = Penjualan::all();
        $produk = Produk::query()->join('kategori','produk.id_kategori','=','kategori.id_kategori')->get();
        $member = Member::all();

        $y = date('Y');
        $m = date('m');
        $d = date('d');

        $cek = Penjualan::orderBy('id_penjualan','DESC')->first();

        if ($cek==false) {
            $latest=0;
        } else {
            $latest= $cek->id_penjualan;
        }
        
        $invoice = 'TRX' .$y.$m.$d. ((int)$latest+1);
        return view('page.pos.hal-pos',['penjualan'=>$penjualan,'produk'=>$produk,'member'=>$member,'invoice'=>$invoice]);
    }

    public function show_cart(Request $request)
    {
        $cart = PenjualanDetail::query()
                ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')
                ->where('penjualan_detail.no_transaksi',$request->no_transaksi)->get();
        
        return view('page.pos.show-cart',['cart'=>$cart]);
    }

    public function show_form_cart(Request $request)
    {
        
        
    }
}
