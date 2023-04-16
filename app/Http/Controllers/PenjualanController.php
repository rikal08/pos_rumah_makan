<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PenjualanDetail;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penjualan = Penjualan::query()
            ->select('penjualan.*', 'member.nama_member', 'users.name')
            ->leftjoin('member', 'penjualan.id_member', '=', 'member.id_member')
            ->leftjoin('users', 'penjualan.id_user', '=', 'users.id')
            ->orderBy('created_at', 'DESC')->get();
        return view('page.penjualan.data', ['penjualan' => $penjualan]);
    }

    public function show($id)
    {
        $penjualan = Penjualan::query()
            ->select('penjualan.*', 'member.nama_member', 'users.name')
            ->leftjoin('member', 'penjualan.id_member', '=', 'member.id_member')
            ->leftjoin('users', 'penjualan.id_user', '=', 'users.id')
            ->where('penjualan.no_transaksi',$id)->first();

        $cart = PenjualanDetail::query()
                ->select('penjualan_detail.*','produk.nama_produk','produk.diskon','produk.harga')
                ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')
                ->where('penjualan_detail.no_transaksi',$id)->get();

        return view('page.penjualan.data_detail',['penjualan'=>$penjualan,'cart'=>$cart]);
    }

    public function cetak_laporan(Request $request)
    {
        $tgl_awal = Carbon::createFromFormat('Y-m-d', $request->tgl_awal);
        $tgl_akhir = Carbon::createFromFormat('Y-m-d', $request->tgl_akhir);
        $penjualan = Penjualan::query()
            ->select('penjualan.*', 'member.nama_member', 'users.name')
            ->leftjoin('member', 'penjualan.id_member', '=', 'member.id_member')
            ->leftjoin('users', 'penjualan.id_user', '=', 'users.id')
            ->whereDate('penjualan.created_at', '>=', $tgl_awal)
            ->whereDate('penjualan.created_at', '<=', $tgl_akhir)
            ->orderBy('penjualan.created_at', 'DESC')
            ->get();

        $pdf = Pdf::loadView('page.penjualan.print', ['penjualan' => $penjualan, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_penjualan.pdf');
    }
}
