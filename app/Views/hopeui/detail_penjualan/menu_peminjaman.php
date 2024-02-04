 <div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?php echo base_url('peminjaman/create/' . $jojo2)?>" class="btn btn-success my-1"><i class="faj-button fa-regular fa-plus" style="color: #ffffff;"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Judul Buku</th>
                           <th>Jumlah Peminjaman</th>
                           <th>User Peminjam</th>
                           <th>Tanggal Peminjaman</th>
                           <th>Tanggal Pengembalian</th>
                           <th>Status Peminjaman</th>
                           <th>Aksi</th>
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
                            <td><?= $riz->stok_buku_peminjaman ?> buah</td>
                            <td><?= $riz->username ?></td>
                            <td><?= date('d M Y', strtotime($riz->tgl_peminjaman)) ?></td>
                            <td><?= date('d M Y', strtotime($riz->tgl_pengembalian)) ?></td>
                            <td>
                               <?php if ($riz->status_peminjaman == 1): ?>
                                Dipinjam
                             <?php elseif ($riz->status_peminjaman == 2): ?>
                                Dikembalikan
                             <?php endif; ?>
                          </td>
                          <td>
                           <?php if ($riz->status_peminjaman == 2): ?>
                             <!-- Jika status_peminjaman = 2, maka tombol aksi_edit di-disable -->
                             <button class="btn btn-primary my-1 disabled" ><i class="fa-regular fa-rotate-left" style="color: #ffffff;"></i></button>
                          <?php else: ?>
                             <!-- Jika status_peminjaman bukan 2, maka tombol aksi_edit aktif -->
                             <a href="<?php echo base_url('peminjaman/aksi_edit/'. $riz->id_peminjaman)?>" class="btn btn-primary my-1"><i class="fa-regular fa-rotate-left" style="color: #ffffff;"></i></a>
                          <?php endif; ?>

                          <?php if ($riz->status_peminjaman == 1): ?>
                             <!-- Jika status_peminjaman = 1, maka tombol delete di-disable -->
                             <button class="btn btn-danger my-1 disabled" ><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                          <?php else: ?>
                             <!-- Jika status_peminjaman bukan 1, maka tombol delete aktif -->
                             <a href="<?php echo base_url('peminjaman/delete/'. $riz->id_peminjaman)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                          <?php endif; ?>
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