<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
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

    public function get_produk(Request $request)
    {
        if($request->id_kategori==true)
        {
            $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->where('id_kategori',$request->id_kategori)->get();
        }else{
            $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->get();
        }

       
        return view('page.produk.get-produk',['produk'=>$produk]);
    }

    public function cari_produk(Request $request)
    {
        if($request->id_kategori==true)
        {
            $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->where('produk.id_kategori',$request->id_kategori)->get();
        }else{
            $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->get();
        }

       
        return view('page.produk.get-produk',['produk'=>$produk]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_produk' => 'required',
            'harga'=> 'required|numeric',
            'stok'=> 'required|numeric',
        ]);

        $imageName = time().'.'.$request->foto->extension();         
        $request->foto->move(public_path('foto_produk'), $imageName);

        Produk::create([
            'id_kategori'=>$request->id_kategori,
            'nama_produk'=>strtoupper($request->nama_produk),
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'foto'=>$imageName,
        ]);

        return redirect('produk')->with('success',"Data Berhasil Disimpan");

    }

    public function show($id)
    {
        $kategori = Kategori::all();
        $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->where('id_produk',$id)->first();

        return view('page.produk.update',['produk'=>$produk,'kategori'=>$kategori]);
    }

    public function ganti_foto_produk(Request $request, $id)
    {
        $request->validate([
            'new_foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $produk = Produk::find($id);
        $imageName = time().'.'.$request->new_foto->extension();         
        $request->new_foto->move(public_path('foto_produk'), $imageName);

        $produk->foto = $imageName;

        $produk->save();

        return redirect('produk/'.$id.'')->with('success',"Foro Produk Berhasil Dirubah");

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga'=> 'required|numeric',
            'stok'=> 'required|numeric',
        ]);

        $produk = Produk::find($id);

        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = strtoupper($request->nama_produk);
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect('produk/'.$id.'')->with('success',"Data Produk Berhasil Dirubah");
    }

    public function cetak_laporan(Request $request)
    {
        if($request->id_kategori==true)
        {
        $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->where('produk.id_kategori',$request->id_kategori)->orderBy('produk.id_kategori')->get();
        }else{
            $produk = DB::table('produk')->join('kategori','produk.id_kategori','=','kategori.id_kategori')->orderBy('produk.id_kategori')->get();
        }
        $pdf = Pdf::loadView('page.produk.print', ['produk'=>$produk])->setPaper('a4', 'landscape');
     
        return $pdf->download('laporan_produk.pdf');

    }

    public function hapus_produk(Request $request)
    {
        $produk = Produk::find($request->id_produk);

        $produk->delete();

        return redirect('produk')->with('error',"Data Berhasil Dihapus");


    }

    public function update_stok()
    {
        $produk = Produk::all();

        foreach($produk as $item)
        {
            $produk = Produk::find($item->id_produk);
            $produk->stok = 50;

            $produk->save();
        }

        return redirect('produk')->with('success',"Stok Berhasil Diupdate ");

    }
}
