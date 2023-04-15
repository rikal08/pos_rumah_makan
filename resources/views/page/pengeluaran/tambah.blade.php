<!-- Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('pengeluaran') }}" method="POST">
            @method('POST')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tanggan</label>
                    <input type="datetime-local" name="created_at" value="{{ date('Y-m-d H:i:s') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nominal Pengeluaran</label>
                    <input type="nominal" class="form-control" placeholder="Masukan Nominal.." name="nominal">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="" class="form-control" cols="30" rows="10" placeholder="Deskripsi Pengeluaran"></textarea>
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