<div class="x_panel">
      <div class="x_title">
            <h2>Daftar Pembayaran Barang</h2>
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
            <div class="col-md-6">
                <a href="<?php echo site_url('admin_gudang/pembayaran_barang/barang'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus"></i> Tambah</a>
            </div>
          </div>
            <div class="col-md-6 text-right">
            </div>

              <div class="x_content">
                  <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="transaksilist">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>No Faktur</th>
                              <th>Nama Suplier</th>
                              <th>Tanggal</th>
                              <th>Kode Barang</th>
                              <th>Nama Barang</th>
                              <th>Satuan</th>
                              <th>QTY</th>
                              <th>Harga</th>
                              <th>Jumlah</th>
                              <th>Username</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($pembayaran as $key){ ?>
                       <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $key->id_transaksi ?></td>
                            <td><?php echo $key->id_suplier ?> - <?php echo $key->nama_suplier ?></td>
                            <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                            <td><?php echo $key->id_barang ?></td>
                            <td><?php echo $key->nama_barang ?></td>
                            <td><?php echo $key->satuan ?></td>
                            <td><?php echo $key->qty ?></td>
                            <td><?php echo $key->harga ?></td>
                            <td><?php echo $key->subtotal ?></td>
                            <!-- <td><span class="label label-danger pull-right"><?php echo $key->status ?></span></td> -->
                            <td><?php echo $key->username ?></td>
                           <td style="text-align:center">
                              <!-- <a href="<?=base_url()?>pembelian/update/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a> -->
                              <a class="btn btn-danger btn-xs" onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?=base_url()?>pembelian/delete/<?=$key->id ?>';
                                                                       });"><i class="fa fa-folder"></i> Delete</a>
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    
                  </table>

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
