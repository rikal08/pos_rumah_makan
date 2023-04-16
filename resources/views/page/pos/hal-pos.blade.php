@extends('layouts.app')


@section('content')
    <div class="row mb-5">
        <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-12">
                    <h6>Makanan</h6>
                </div>
            </div>
            <div class="row">
                @foreach ($produk as $data)
                    @if ($data->nama_kategori == 'MAKANAN')
                        <div class="col-lg-3 col-md-3">
                            <div class="card p-2">
                                <img width="100%" height="100px" src="{{ asset('foto_produk') }}/{{ $data->foto }}"
                                    alt="">
                                <p style="font-size: 12px" class="mt-2">{{ $data->nama_produk }}</p>
                                <p style="font-size: 12px;color:red;margin-top:-15px">{{ number_format($data->harga) }}</p>
                                <p style="font-size: 12px;color:#222;margin-top:-15px">Sisa {{ $data->stok }}</p>
                               <div class="row">
                                    <div class="col-lg-7">
                                        <input style="text-align: center" id="jumlah_add" type="number"  class="form-control jumlah_add" value="1">
                                       
                                    </div>
                                    <div class="col-lg-5">
                                        <a type="button" onclick="addCart({{ $data->id_produk }})" class="btn btn-danger text-center"><i class="fa fa-plus"></i></a>
                                    </div>
                               </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h6>Minuman</h6>
                </div>
            </div>
            <div class="row">
                @foreach ($produk as $data)
                    @if ($data->nama_kategori == 'MINUMAN')
                        <div class="col-lg-3 col-md-3">
                            <div class="card p-2">
                                <img width="100%" height="100px" src="{{ asset('foto_produk') }}/{{ $data->foto }}"
                                    alt="">
                                <p style="font-size: 12px" class="mt-2">{{ $data->nama_produk }}</p>
                                <p style="font-size: 12px;color:red;margin-top:-15px">{{ number_format($data->harga) }}</p>
                                <p style="font-size: 12px;color:#222;margin-top:-15px">Sisa {{ $data->stok }}</p>
                                
                                <div class="row">
                                    <div class="col-lg-7">
                                        <input style="text-align: center" id="jumlah_add" type="number" class="form-control jumlah_add" value="1">
                                       
                                    </div>
                                    <div class="col-lg-5">
                                        <a type="button" onclick="addCart({{ $data->id_produk }})" class="btn btn-danger text-center"><i class="fa fa-plus"></i></a>
                                    </div>
                               </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
                </div>
                <div class="card-body">
                    <p>Detail Transaksi</p>
                    <table class="table table-bordered" style="font-size: 10px">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Product</td>
                                <td>Qty</td>
                                <td>Rp</td>
                                <td>%</td>
                                <td>SubTotal</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody id="showCart"></tbody>
                    </table>
                    <div class="form-group">
                        <label for="">No. Transaksi</label>
                        <input type="text" id="no_transaksi" value="{{ $invoice }}" readonly class="form-control w-100" style="height: 30px ">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="text" id="tgl" value="{{ date('Y-m-d H:i:s') }}" readonly class="form-control w-100"
                            style="height: 30px ">
                    </div>
                    <div class="form-group">
                        <label for="">Member</label>
                        <select name="" class="form-control w-100" style="height: 30px " id="id_member">
                            <option value="0" selected>No Member</option>
                            @foreach ($member as $data)
                                <option value="{{ $data->id_member }}">{{ $data->nama_member }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <table width="100%">
                        <tr>
                            <td>Total Item</td>
                            <td><input style="text-align: right" readonly id="total_item" class="form-control" type="text"></td>
                        </tr>
                        <tr>
                            <td>Total Harga (Rp)</td>
                            <td><input style="text-align: right" readonly id="total_harga" class="form-control" type="text"></td>
                        </tr>
                        <tr>
                            <td>Diskon (Rp)</td>
                            <td><input style="text-align: right" readonly class="form-control" id="total_diskon" type="text"></td>
                        </tr>

                        <tr>
                            <td>Grand Total (Rp)</td>
                            <td><input style="text-align: right" readonly class="form-control" id="grand_total" type="text"></td>
                        </tr>
                        <tr>
                            <td>Bayar (Rp)</td>
                            <td><input style="text-align: right" type="text" id="bayar" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Kembali (Rp)</td>
                            <td><input style="text-align: right" id="kembali" type="text" class="form-control"></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('penjualan') }}" class="btn btn-danger">Batal</a>
                    <a href="{{ url('pos') }}" class="btn btn-warning">Refresh</a>
                    <button onclick="simpanTransaksi()" id="simpan_transaksi" type="button" class="btn btn-primary disabled">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@include('page.pos.form-cetak-faktur')
@endsection
