
<!--Batas-->
<div class="x_panel">
      <div class="x_title">
            <h2>Jadwal List</h2>
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
            <div class="col-md-6 text-right">
                <!-- <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div> -->
            </div>

              <div class="x_content">
              <a href="<?php echo site_url('som/jadwal2/create'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus" ></i> Tambah Data</a>
              <div class="table-responsive">
                  <table class="table jambo_table table-bordered" id="transaksilist">
                      <thead>
                          <tr>
                              <th>Id Jadwal</th>
                              <th>Nama Barang</th>
                              <th>Qty</th>
                              <th>Tanggal Kirim</th>
                              <!-- <th>End</th> -->
                                <th>Username</th>
                                <th>Judul</th>
                                <th>Sumber Data</th>
                              <th>Deskripsi</th>
                              <th>Nama Pelanggan</th>
                          		<th>Karyawan</th>
                                  <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $jum = 1;
                        foreach($jadwal as $key){ ?>
                       <tr>
                            <td><?php echo $key->id_jadwal ?></td>
                            <td><?php echo $key->nama_barang ?></td>
                            <td><?php echo $key->qty ?></td>
                            <td><?php echo tgl_indo($key->start) ?></td>
                            <!-- <td><?php echo tgl_indo($key->end) ?></td> -->
                            <td><?php echo $key->username ?></td>
                            <td><?php echo $key->title ?></td>
                            <td><?php echo $key->color ?></td>
                            <td><?php echo $key->description ?></td>
                            <td><?php echo $key->nama_pelanggan ?></td>
                            <td><?php echo $key->nama ?></td>
                            <td style="text-align:center">
                              <a href="<?=base_url()?>som/jadwal2/update/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                              <a class="btn btn-default btn-sm" onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?=base_url()?>som/jadwal2/delete/<?=$key->id ?>';
                                                                       });"><i class="glyphicon glyphicon-trash"></i></a>
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <a></a>
                      <?php //echo anchor(site_url('som/transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php //echo anchor(site_url('transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
                </div>
              </div>
            </div>


            <!-- Gagal -->
            <?php if ($this->session->flashdata('msg')): ?>
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
                <?php endif; ?>

            <!-- sukses -->
            <?php if ($this->session->flashdata('message')): ?>
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
                               }
                             );
                       </script>
                     </small>
                <?php endif; ?>
