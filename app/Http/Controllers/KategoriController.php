<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategori = Kategori::all();
        return view('page.master.kategori',['kategori'=>$kategori]);
    }

    protected function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
        ]);

        Kategori::create([
            'nama_kategori' => strtoupper($request->nama_kategori),
        ]);

        return redirect('/kategori')->with('success',"Data Berhasil Disimpan");


    }

    public function update(Request $request, $id)
    {
    
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = strtoupper($request->nama_kategori);

        
        $kategori->save();
        return redirect('/kategori')->with('success',"Data Berhasil Diupdate");
        
    }

}
