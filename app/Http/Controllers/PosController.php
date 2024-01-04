<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use PDF;

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
                ->select('penjualan_detail.*','produk.nama_produk','produk.harga')
                ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')
                ->where('penjualan_detail.no_transaksi',$request->no_transaksi)->get();
        
        return view('page.pos.show-cart',['cart'=>$cart]);
    }

    public function show_form_cart(Request $request)
    {
        $subtotal = PenjualanDetail::where('no_transaksi',$request->no_transaksi)->sum('subtotal');
        $total_item = PenjualanDetail::where('no_transaksi',$request->no_transaksi)->sum('jumlah');
   

        $data = array([
            'subtotal'=>$subtotal,
            'total_item'=>$total_item,
        ]);

        return response()->json($data);


    }

    public function add_cart(Request $request)
    {
        $produk = Produk::find($request->id_produk);
        $pen_detail = PenjualanDetail::where([['no_transaksi',$request->no_transaksi],['id_produk',$request->id_produk]])->first();

        if ($pen_detail==true) {
           $pen_detail->jumlah = $pen_detail->jumlah + $request->jumlah;
           $pen_detail->subtotal = ($produk->harga * $pen_detail->jumlah);
           $pen_detail->save();
        } else {
            PenjualanDetail::create([
                'no_transaksi'=>$request->no_transaksi,
                'id_produk'=>$request->id_produk,
                'harga_jual'=>$produk->harga,
                'jumlah'=>$request->jumlah,
                'subtotal'=>($produk->harga * $request->jumlah),
            ]);
        }

                
        
    }

    public function kurang_cart(Request $request)
    {
        
            $pen_detail = PenjualanDetail::find($request->id_detail);

            $produk = Produk::find($pen_detail->id_produk);

       
           $pen_detail->jumlah = $pen_detail->jumlah - 1;

           $pen_detail->subtotal = ($produk->harga * $pen_detail->jumlah);
           $pen_detail->save();
        

                
        
    }

    public function hapus_cart(Request $request)
    {
        $pen_detail = PenjualanDetail::find($request->id_detail);
        $pen_detail->delete();
    }

    public function simpan_penjualan(Request $request)
    {
        $request->validate([
            'no_transaksi' => ['unique:penjualan'],
        ]);

        $penjualan_detail = PenjualanDetail::where('no_transaksi',$request->no_transaksi)->get();

        foreach ($penjualan_detail as $key) {
            $produk = Produk::find($key->id_produk);
            $produk->stok = $produk->stok - $key->jumlah;
            $produk->save();
        }

        Penjualan::create([
            'no_transaksi'=> $request->no_transaksi,
            'id_pelanggan'=> $request->id_member,
            'total_item'=> $request->total_item,
            'total_harga'=> $request->total_harga,
          
            'bayar'=> $request->bayar,
            'kembali'=> $request->kembali,
            'id_user'=> $request->id_user,
        ]);
    }

    public function cetak_faktur(Request $request)
    {
        $penjualan = Penjualan::query()
        ->select('penjualan.*','pelanggan.nama_pelanggan','users.name')
        ->leftjoin('pelanggan','penjualan.id_pelanggan','=','pelanggan.id_pelanggan')
        ->leftjoin('users','penjualan.id_user','=','users.id')
        ->where('penjualan.no_transaksi',$request->no_transaksi)->first();
        $detail = PenjualanDetail::query()
                ->select('penjualan_detail.*','produk.nama_produk','produk.harga')
                ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')
                ->where('penjualan_detail.no_transaksi',$request->no_transaksi)->get();
        $customPaper = array(0,0,400,500);
        $pdf = Pdf::loadView('page.pos.faktur',['penjualan'=>$penjualan,'detail'=>$detail])->setPaper($customPaper);
        return  $pdf->stream('faktur.pdf');

    }

   
}
