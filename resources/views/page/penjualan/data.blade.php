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
        <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>

       
    </div>
    <div class="card-header py-3">
        <a href="{{ url('pos') }}" class="btn-sm btn-success">Tambah Data</a>
        <a href="" data-toggle="modal" data-target="#cetakLaporan" class="btn-sm btn-danger"><i class="fa fa-print"></i> Laporan Pengeluaran</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 14px !important" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
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
                        <td>
                            @if ($data->id_member==0)
                                Non Member
                            @else
                                {{ $data->nama_member }}
                            @endif
                        </td>
                        <td>{{ $data->total_item }}</td>
                        <td>Rp. {{ number_format($data->total_harga) }}</td>
                        <td>Rp. {{ number_format($data->diskon) }}</td>
                        <td>Rp. {{ number_format($data->bayar) }}</td>
                        <td>Rp. {{ number_format($data->kembali) }}</td>
                        <td>{{  $data->name }}</td>
                        <td>
                            <a href="" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            <a href="" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection