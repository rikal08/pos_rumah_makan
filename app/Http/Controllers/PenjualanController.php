<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penjualan = Penjualan::query()
            ->select('penjualan.*', 'pelanggan.nama_pelanggan', 'users.name')
            ->leftjoin('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->leftjoin('users', 'penjualan.id_user', '=', 'users.id')
            ->orderBy('created_at', 'DESC')->get();
            $cart = PenjualanDetail::query()
            ->select('penjualan_detail.*','produk.nama_produk','produk.harga')
            ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')->get();
        return view('page.penjualan.data', ['penjualan' => $penjualan,'detail'=>$cart]);
    }

    public function show($id)
    {
        $penjualan = Penjualan::query()
            ->select('penjualan.*', 'pelanggan.nama_pelanggan', 'users.name')
            ->leftjoin('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
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
            ->select('penjualan.*', 'pelanggan.nama_pelanggan', 'users.name')
            ->leftjoin('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->leftjoin('users', 'penjualan.id_user', '=', 'users.id')
            ->whereDate('penjualan.created_at', '>=', $tgl_awal)
            ->whereDate('penjualan.created_at', '<=', $tgl_akhir)
            ->orderBy('penjualan.created_at', 'DESC')
            ->get();

            $cart = PenjualanDetail::query()
            ->select('penjualan_detail.*','produk.nama_produk','produk.harga')
            ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')->get();
        $pdf = Pdf::loadView('page.penjualan.print', ['penjualan' => $penjualan, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir,'detail'=>$cart])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_penjualan.pdf');
    }

    public function cetak_rekap(Request $request)
    {
        $tahun = $request->tahun;
        $cart = PenjualanDetail::query()
        ->select(DB::raw('sum(penjualan_detail.jumlah) as all_jumlah'),'produk.nama_produk','penjualan_detail.harga_jual')
        ->join('produk','penjualan_detail.id_produk','=','produk.id_produk')
        ->groupBy('produk.nama_produk','penjualan_detail.harga_jual')
        ->whereYear('penjualan_detail.created_at',$tahun)
        ->get();

        $pdf = Pdf::loadView('page.penjualan.rekap', ['detail' => $cart,'tahun'=>$tahun])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_penjualan.pdf');
    }
    
}
