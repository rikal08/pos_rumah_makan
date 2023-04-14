<!-- Tambah -->
<div class="modal fade" id="modalUpdate{{ $data->id_pengeluaran }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('pengeluaran',$data->id_pengeluaran) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nominal Pengeluaran</label>
                    <input type="nominal" value="{{ $data->nominal }}" class="form-control" placeholder="Masukan Nominal.." name="nominal">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="" class="form-control" cols="30" rows="10" placeholder="Deskripsi Pengeluaran">{{ $data->deskripsi }}</textarea>
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