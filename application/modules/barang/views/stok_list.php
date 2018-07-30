
<!-- Gagal -->
<?php if ($this->session->flashdata('msg')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Maaf",
                   text: "<?php echo $this->session->flashdata('msg'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'error'
               });
           </script>
         </small>
    <?php endif; ?>

<!-- sukses -->
<?php if ($this->session->flashdata('message')): ?>
         <small>
           <script type="text/javascript">
              swal({
                   title: "Done",
                   text: "<?php echo $this->session->flashdata('message'); ?>",
                    timer: 3000,
                   showConfirmButton: true,
                   type: 'success'
               });
           </script>
         </small>
    <?php endif; ?>
<a class="btn btn-primary" href="<?php echo base_url('barang/stok/create'); ?>"><i class="fa fa-plus-square"></i> input stok awal</a>
<div class="x_panel">
      <div class="x_title">
            <h2>Stok List</h2>
            <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
      </div>
          <div class="row">
            <div class="col-md-12 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php //echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

              <div class="x_content">
                  <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Barang</th>
                              <th>Stok</th>
                              <th>Dari Gudang</th>
                              <th>Tanggal Update</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($stok as $key) { ?>
                       <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $key->id_barang ?> - <?php echo $key->nama_barang ?></td>
                            <td><?php echo $key->stok ?></td>
                            <td><?php echo $key->nama_gudang ?></td>
                            <td><?php echo tgl_indo($key->updated_at) ?></td>
                           <td style="text-align:center">
                              <!-- <a href="<?=base_url()?>barang/stok/read/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></a> -->
                              <a href="<?=base_url()?>barang/stok/update/<?=$key->id ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
                              <a onclick="javasciprt: return confirm('Are You Sure ?')" href="<?=base_url()?>barang/stok/delete/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                              <!-- <a class="btn btn-danger btn-xs" onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?=base_url()?>barang/stok/delete/<?=$key->id ?>';
                                                                       });"><i class="glyphicon glyphicon-trash"></i></a> -->
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Dari Gudang</th>
                        <th>Tanggal Update</th>
                        <th style="text-align:center">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <!-- <a></a>
                      <?php echo anchor(site_url('barang/stok/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php echo anchor(site_url('barang/stok/word'), 'Word', 'class="btn btn-primary"'); ?> -->
                </div>
              </div>
            </div>

            <!-- Gagal -->
            <!-- <?php if ($this->session->flashdata('msg')): ?>
                     <small>
                       <script type="text/javascript">
                          swal({
                               title: "Maaf",
                               text: "<?php echo $this->session->flashdata('msg'); ?>",
                                timer: 3500,
                               showConfirmButton: true,
                               type: 'error' },
                               function(){
                                 location.reload();
                           });
                       </script>
                     </small>
                <?php endif; ?> -->

            <!-- sukses -->
            <!-- <?php if ($this->session->flashdata('message')): ?>
                     <small>
                       <script type="text/javascript">
                          swal({
                               title: "Done",
                               text: "<?php echo $this->session->flashdata('message'); ?>",
                                timer: 3500,
                               showConfirmButton: true,
                               type: 'success' },
                               function(){
                                 location.reload();
                           });
                       </script>
                     </small>
                <?php endif; ?> -->
