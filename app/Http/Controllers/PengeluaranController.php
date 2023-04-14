<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pengeluaran = Pengeluaran::orderBy('created_at','DESC')->get();
        return view('page.pengeluaran.data',['pengeluaran'=>$pengeluaran]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal'=>['required','numeric'],
            'deskripsi'=>['required'],
        ]);

        Pengeluaran::create([
            'deskripsi'=>$request->deskripsi,
            'nominal'=>$request->nominal
        ]);

        return redirect('pengeluaran')->with('success',"Data Berhasil Disimpan");


    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);

        $request->validate([
            'nominal'=>['required','numeric'],
            'deskripsi'=>['required'],
        ]);

        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->deskripsi = $request->deskripsi;

        $pengeluaran->save();

        return redirect('pengeluaran')->with('success',"Data Berhasil Diupdate");

    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('pengeluaran')->with('error',"Data Berhasil Dihapus");
    }
}
