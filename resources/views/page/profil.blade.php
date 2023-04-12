@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil User</h6>
                </div>
                <form action="{{ url('profil', Auth::user()->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama User</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Nama User"
                                name="nama_user">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" readonly class="form-control" value="{{ $user->email }}"
                                placeholder="Nama User" name="nama_user">
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <input type="text" readonly class="form-control"
                                value="@if ($user->level == 1) Admin @elseif($user->level == 2) Pimpinan @else Kasir @endif"
                                placeholder="Nama User" name="nama_user">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Update Password</label>
                            <input type="text" class="form-control" placeholder="Masukan Password baru" name="password">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('home') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
