@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
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
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Data Produk</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <img class="img-fluid shadow mb-4" width="100%" src="{{ asset('foto_produk') }}/{{ $produk->foto }}" alt="Foto Produk">
                <form method="POST" enctype="multipart/form-data" action="{{ url('ganti-foto-produk',$produk->id_produk) }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Ganti Foto Produk</label>
                        <input type="file" class="form-control" name="new_foto">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Simpan Foto Baru</button>
                    </div>
                </form>
            </div>
            
            <div class="col-lg-8">
                <form action="{{ url('produk',$produk->id_produk) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Pilih Kategori</label>
                        <select name="id_kategori" class="form-control" id="">
                           @foreach ($kategori as $data_k)
                            @if ($data_k->id_kategori !== $produk->id_kategori)
                            <option value="{{ $data_k->id_kategori }}">{{ $data_k->nama_kategori }}</option>
                            @else
                            <option selected value="{{ $produk->id_kategori }}">{{ $produk->nama_kategori }}</option>
                            @endif
                              
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" value="{{ $produk->nama_produk }}" class="form-control" name="nama_produk" placeholder="Masukan Nama Produk...">
                    </div>
                
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" value="{{ $produk->harga }}" class="form-control" name="harga" value="0" placeholder="Masukan Harga Produk...">
                    </div>
                
                    <div class="form-group">
                        <label for="">Diskon</label>
                        <input type="number" value="{{ $produk->diskon }}" class="form-control" name="diskon" value="0" placeholder="Masukan Diskon Produk...">
                    </div>
                
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="number" value="{{ $produk->stok }}" class="form-control" name="stok" value="0" placeholder="Masukan Diskon Produk...">
                    </div>

                    <div class="modal-footer">
                       <a href="{{ url('produk') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection