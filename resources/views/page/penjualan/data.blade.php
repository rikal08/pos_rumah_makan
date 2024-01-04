@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>

       
    </div>
    <div class="card-header py-3">
        <a href="{{ url('pos') }}" class="btn-sm btn-success">Tambah Data</a>
        <a href="" data-toggle="modal" data-target="#cetakLaporan" class="btn-sm btn-danger"><i class="fa fa-print"></i> Laporan Penjualan</a>
        <a href="" data-toggle="modal" data-target="#rekapLaporan" class="btn-sm btn-danger"><i class="fa fa-print"></i> Rekap Penjualan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px !important" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>No Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Pembelian</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                        <th>Nama Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($penjualan as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->no_transaksi }}</td>
                        <td>
                            @if ($data->id_pelanggan==0)
                                Tidak ada nama pelanggan
                            @else
                                {{ $data->nama_pelanggan }}
                            @endif
                        </td>
                        <td>
                            @foreach ($detail as $item)
                                @if ($data->no_transaksi==$item->no_transaksi)
                                    <p>- ({{ $item->jumlah }}) * {{ $item->nama_produk }}</p>
                                @else
                                    
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $data->total_item }}</td>
                        <td>Rp. {{ number_format($data->total_harga) }}</td>
                        <td>Rp. {{ number_format($data->bayar) }}</td>
                        <td>Rp. {{ number_format($data->kembali) }}</td>
                        <td>{{  $data->name }}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#fakturModal{{ $data->no_transaksi }}" class="btn-sm btn-danger"><i class="fa fa-print"></i></a>
                            <a href="{{ url('penjualan',$data->no_transaksi) }}" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    {{-- faktur modal --}}
                    <div class="modal fade" id="fakturModal{{ $data->no_transaksi }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Transaksi Berhasil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('cetak-faktur') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name="no_transaksi" value="{{ $data->no_transaksi }}" hidden id="id_faktur">
                                    <p align="center">Transaksi Berhasil Silahkan Cetak Faktur</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger"> <i class="fa fa-print"></i> Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('page.penjualan.form-laporan')


{{-- tambah --}}
<div class="modal fade" id="rekapLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('cetak-rekap-penjualan') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tanggal Awal</label>
                    <select name="tahun" class="form-control" id="">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection