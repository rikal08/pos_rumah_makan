<!-- Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('data-user') }}" method="POST">
            @method('POST')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" placeholder="Masukan Nama.." name="nama_pelanggan">
                </div>
                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="text" class="form-control" placeholder="Masukan Email.." name="telepon">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" placeholder="Masukan Email.." name="email">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
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