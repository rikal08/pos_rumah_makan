<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Pengeluaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'deskripsi'=>strtoupper($request->deskripsi),
            'nominal'=>$request->nominal,
            'created_at'=>$request->created_at,
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

    public function cetak_laporan(Request $request)
    {
        $tgl_awal = Carbon::createFromFormat('Y-m-d', $request->tgl_awal);
        $tgl_akhir = Carbon::createFromFormat('Y-m-d', $request->tgl_akhir);
        $pengeluaran = Pengeluaran::query()
                        ->whereDate('created_at', '>=', $tgl_awal)
                        ->whereDate('created_at', '<=', $tgl_akhir)
                        ->get();

        $pdf = Pdf::loadView('page.pengeluaran.print', ['pengeluaran'=>$pengeluaran,'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir])->setPaper('a4', 'landscape');
     
        return $pdf->download('laporan_pengeluaran.pdf');

    }
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('pengeluaran')->with('error',"Data Berhasil Dihapus");
    }
}
