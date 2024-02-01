<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('buku/aksi_create')?>" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="form-group">
                           <label class="form-label" for="fname">Judul Buku</label>
                           <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 6px; margin-top: 6px;">
                           <label for="Foto" class="form-label">Cover Buku (Opsional)</label>
                           <input type="file" class="logo-perusahaan" id="cover_buku" name="cover_buku" accept="image/*">
                        </div>

                        <div class="form-group">
                          <label class="form-label" for="kategori_buku">Kategori Buku</label>
                          <select class="form-select" id="kategori_buku" name="kategori_buku" required>
                            <option>- Pilih -</option>
                            <?php foreach ($kategori as $k): ?>
                              <?php if ($k->id_kategori != 10): ?>
                                <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                             <?php endif; ?>
                          <?php endforeach; ?>
                       </select>
                    </div>

                    <div class="form-group">
                     <label class="form-label" for="fname">Stok Buku</label>
                     <input type="text" class="form-control" id="stok_buku" name="stok_buku" placeholder="Masukkan Stok Buku" required>
                  </div>

               </div>
               <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
               <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
</div>