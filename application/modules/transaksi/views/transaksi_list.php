
        <!-- <h2 style="margin-top:0px">Wp_transaksi List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('wp_transaksi/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('wp_transaksi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('wp_transaksi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
            		<th>Id Transaksi</th>
            		<th>Wp Barang Id</th>
            		<th>Harga</th>
            		<th>Qty</th>
            		<th>Satuan</th>
            		<th>Tgl Transaksi</th>
            		<th>Updated At</th>
            		<th>Wp Pelanggan Id</th>
            		<th>Username</th>
            		<th>Wp Status Id</th>
            		<th>Action</th>
            </tr><?php
            foreach ($wp_transaksi_data as $wp_transaksi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $wp_transaksi->id_transaksi ?></td>
			<td><?php echo $wp_transaksi->wp_barang_id ?></td>
			<td><?php echo $wp_transaksi->harga ?></td>
			<td><?php echo $wp_transaksi->qty ?></td>
			<td><?php echo $wp_transaksi->satuan ?></td>
			<td><?php echo $wp_transaksi->tgl_transaksi ?></td>
			<td><?php echo $wp_transaksi->updated_at ?></td>
			<td><?php echo $wp_transaksi->wp_pelanggan_id ?></td>
			<td><?php echo $wp_transaksi->username ?></td>
			<td><?php echo $wp_transaksi->wp_status_id ?></td>
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('wp_transaksi/read/'.$wp_transaksi->id),'Read');
				echo ' | ';
				echo anchor(site_url('wp_transaksi/update/'.$wp_transaksi->id),'Update');
				echo ' | ';
				echo anchor(site_url('wp_transaksi/delete/'.$wp_transaksi->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('wp_transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('wp_transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->


<!--Batas-->
<div class="x_panel">
      <div class="x_title">
            <h2>Transaksi List</h2>
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
                <!-- <?php echo anchor(site_url('barang/create'),'Tambah', 'class="btn btn-primary"'); ?> -->
                <a href="<?php echo base_url('transaksi/create'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus"></i> Tambah</a>
            </div>
          </div>
            <div class="col-md-6 text-right">
                <!-- <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div> -->
            </div>

              <div class="x_content">
                  <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Id Transaksi</th>
                          		<th>Nama Barang</th>
                          		<th>Harga</th>
                          		<th>Qty</th>
                          		<th>Satuan</th>
                          		<th>Tgl Transaksi</th>
                          		<th>Tanggal Update</th>
                          		<th>Nama Pelanggan</th>
                          		<th>Username</th>
                          		<th>Status</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($transaksi as $key){ ?>
                       <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $key->id_transaksi ?></td>
                      			<td><?php echo $key->nama_barang ?></td>
                      			<td><?php echo $key->harga ?></td>
                      			<td><?php echo $key->qty ?></td>
                      			<td><?php echo $key->satuan ?></td>
                            <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                            <td><?php echo tgl_indo($key->updated_at) ?></td>
                      			<td><?php echo $key->nama_pelanggan ?></td>
                      			<td><?php echo $key->username ?></td>
                      			<td><?php echo $key->status ?></td>
                           <td style="text-align:center">
                              <a href="<?=base_url()?>transaksi/read/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></a>
                              <a href="<?=base_url()?>transaksi/update/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                              <!-- <a onclick="javasciprt: return confirm('Are You Sure ?')" href="<?=base_url()?>barang/delete/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></a> -->
                              <a class="btn btn-default btn-sm" onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?=base_url()?>transaksi/delete/<?=$key->id ?>';
                                                                       });"><i class="glyphicon glyphicon-trash"></i></a>
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Id Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Tgl Transaksi</th>
                        <th>Tanggal Update</th>
                        <th>Nama Pelanggan</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th style="text-align:center">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <a></a>
                      <?php echo anchor(site_url('transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php echo anchor(site_url('transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
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
