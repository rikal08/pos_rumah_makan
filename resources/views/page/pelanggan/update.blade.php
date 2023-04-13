<!-- Tambah -->
<div class="modal fade" id="updateModal{{ $data->id_pelanggan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Pelanggan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('pelanggan',$data->id_pelanggan) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" value="{{ $data->nama_pelanggan }}" placeholder="Masukan Nama.." name="nama_pelanggan">
                </div>
                @php
                    $hp =$data->telepon;
                    $hp0 = substr_replace($hp,'0',0,3);
                @endphp
                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="text" class="form-control" value="{{ $hp0 }}" placeholder="Masukan Email.." name="telepon">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" value="{{ $data->email }}" placeholder="Masukan Email.." name="email">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{ $data->alamat }}</textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>