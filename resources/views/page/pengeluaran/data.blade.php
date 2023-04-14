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
        <a href="" class="btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Input</th>
                        <th>Nominal</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($pengeluaran as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>Rp. {{ number_format($data->nominal,2) }}</td>
                        <td>{{ $data->deskripsi }}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#modalHapus{{ $data->id_pengeluaran }}" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            <a href="" data-toggle="modal" data-target="#modalUpdate{{ $data->id_pengeluaran }}" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @include('page.pengeluaran.hapus')
                    @include('page.pengeluaran.update')
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('page.pengeluaran.tambah')
@endsection