 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Judul Buku</th>
                           <th>Cover Buku</th>
                           <th>Kategori Buku</th>
                           <th>Stok Buku</th>
                           <th>Action</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riz->judul_buku ?></td>
                            <td>
                             <a href="<?= base_url('cover/' . $riz->cover_buku) ?>" target="_blank">
                              <img src="<?= base_url('cover/' . $riz->cover_buku) ?>" class="img-fluid" style="object-fit: cover; width: 95px; height: 140px;" alt="Cover Buku">
                           </a>
                        </td>
                        <td><?= $riz->nama_kategori ?></td>
                        <td><?= $riz->stok_buku ?> buah</td>
                        <td>
                           <a href="<?php echo base_url('peminjaman/menu_peminjaman/'. $riz->id_buku)?>" class="btn btn-success my-1"><i class="fa-duotone fa-retweet" style="color: #ffffff;"></i></a>
                        </td>
                     </tr>
                  <?php } ?>
               </tbody>
              <!--  <tfoot>
                  <tr>
                     <th>No.</th>
                     <th>Foto</th>
                     <th>Username</th>
                     <th>Level</th>
                     <th style="min-width: 100px">Action</th>
                  </tr>
               </tfoot> -->

            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->