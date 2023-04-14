 {{-- tambah --}}
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ url('produk') }}" method="POST" enctype="multipart/form-data">
                 @method('POST')
                 @csrf
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="">Pilih Foto Produk</label>
                         <input type="file" class="form-control" name="foto">
                     </div>

                     <div class="form-group">
                         <label for="">Pilih Kategori</label>
                         <select name="id_kategori" class="form-control" id="">
                            @foreach ($kategori as $data_k)
                                <option value="{{ $data_k->id_kategori }}">{{ $data_k->nama_kategori }}</option>
                            @endforeach
                         </select>

                         <a href="" class="btn btn-primary">Input Kategori</a>
                     </div>
                
                     <div class="form-group">
                         <label for="">Nama Produk</label>
                         <input type="text" class="form-control" name="nama_produk" placeholder="Masukan Nama Produk...">
                     </div>
                 
                     <div class="form-group">
                         <label for="">Harga</label>
                         <input type="number" class="form-control" name="harga" value="0" placeholder="Masukan Harga Produk...">
                     </div>
                 
                     <div class="form-group">
                         <label for="">Diskon</label>
                         <input type="number" class="form-control" name="diskon" value="0" placeholder="Masukan Diskon Produk...">
                     </div>
                 
                     <div class="form-group">
                         <label for="">Stok</label>
                         <input type="number" class="form-control" name="stok" value="0" placeholder="Masukan Diskon Produk...">
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
