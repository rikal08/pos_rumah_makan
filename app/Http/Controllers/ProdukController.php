<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kategori = Kategori::all();
        return view('page.produk.data',['kategori'=>$kategori]);
    }

    public function get_produk()
    {
        $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->get();
        return view('page.produk.get-produk',['produk'=>$produk]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_produk' => 'required',
            'harga'=> 'required|numeric',
            'diskon'=> 'required|numeric',
            'stok'=> 'required|numeric',
        ]);

        $imageName = time().'.'.$request->foto->extension();         
        $request->foto->move(public_path('foto_produk'), $imageName);

        Produk::create([
            'id_kategori'=>$request->id_kategori,
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'diskon'=>$request->diskon,
            'stok'=>$request->stok,
            'foto'=>$imageName,
        ]);

        return redirect('produk')->with('success',"Data Berhasil Disimpan");

    }

    public function hapus_produk(Request $request)
    {
        $produk = Produk::find($request->id_produk);

        $produk->delete();

        return redirect('produk')->with('error',"Data Berhasil Dihapus");


    }
}
