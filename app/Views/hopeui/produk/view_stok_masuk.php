 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?php echo base_url('buku/add_stok_masuk/' . $jojo2)?>" class="btn btn-success my-1"><i class="faj-button fa-regular fa-plus" style="color: #ffffff;"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Judul Buku</th>
                           <th>Stok Buku Masuk</th>
                           <th>Tanggal Masuk</th>
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
                          <td><?= $riz->stok_buku_masuk ?></td>
                          <td><?= date('d M Y', strtotime($riz->created_at)) ?></td>

                          <td>

                           <a href="<?php echo base_url('buku/delete_stok_masuk/'. $riz->id_buku_masuk)?>" class="btn btn-danger my-1"><i class="fa-regular fa-minus" style="color: #ffffff;"></i></a>
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