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
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    </div>
    <div class="card-header py-3">
        <a href="" class="btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               <tbody id="getproduk">

               </tbody>
            </table>
        </div>
    </div>
</div>

@include('page.produk.tambah')
@include('page.produk.hapus')
@endsection