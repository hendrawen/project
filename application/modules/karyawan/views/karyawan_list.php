
        <!-- <h2 style="margin-top:0px">Karyawan List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('karyawan/create'),'Tambah', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('karyawan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('karyawan'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>Photo</th>
		<th>Status</th>
		<th>Wp Jabatan Id</th>
		<th>Action</th>
            </tr><?php
            foreach ($karyawan_data as $karyawan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $karyawan->nama ?></td>
			<td><?php echo $karyawan->alamat ?></td>
			<td><?php echo $karyawan->no_telp ?></td>
			<td><?php echo $karyawan->photo ?></td>
			<td><?php echo $karyawan->status ?></td>
			<td><?php echo $karyawan->wp_jabatan_id ?></td>
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('karyawan/read/'.$karyawan->id_karyawan),'Read');
				echo ' | ';
				echo anchor(site_url('karyawan/update/'.$karyawan->id_karyawan),'Update');
				echo ' | ';
				echo anchor(site_url('karyawan/delete/'.$karyawan->id_karyawan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
		<?php echo anchor(site_url('karyawan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('karyawan/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->


        <div class="x_panel">
              <div class="x_title">
                    <h2>Karyawan List</h2>
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
                        <?php echo anchor(site_url('karyawan/create'),'Tambah', 'class="btn btn-primary"'); ?>
                        </div>
                  </div>
                    <div class="col-md-6 text-right">
                        <!-- <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div> -->
                    </div>

                      <div class="x_content">
                          <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Nama</th>
                                  		<th>Alamat</th>
                                  		<th>Telepon</th>
                                      <th style="text-align:center">Photo</th>
                                  		<th>Status</th>
                                  		<th>Jabatan</th>
                                      <th style="text-align:center">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $no = 1;
                                foreach($karya as $key){ ?>
                               <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $key->nama ?></td>
                              			<td><?php echo $key->alamat ?></td>
                              			<td><?php echo $key->no_telp ?></td>
                                    <td style="text-align:center"><img src="<?php echo base_url();?>assets/uploads/<?php echo $key->photo; ?>"width="200" height="100"></td>
                              			<td><?php echo $key->status ?></td>
                              			<td><?php echo $key->nama_jabatan ?></td>
                                    <td style="text-align:center">
                                      <a href="<?=base_url()?>karyawan/read/<?=$key->id_karyawan ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></a>
                                      <a href="<?=base_url()?>karyawan/update/<?=$key->id_karyawan ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                      <!-- <a onclick="javasciprt: return confirm('Are You Sure ?')" href="<?=base_url()?>barang/delete/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></a> -->
                                      <a class="btn btn-default btn-sm" onclick="return swal({
                                                              title: 'Yakin akan hapus data ini?',
                                                              text: 'Anda tidak akan melihat data ini lagi!',
                                                              type: 'warning',
                                                              showCancelButton: true,
                                                              confirmButtonColor: '#d9534f',
                                                                 }, function(){
                                                                    window.location.href ='<?=base_url()?>karyawan/delete/<?=$key->id_karyawan ?>';
                                                                               });"><i class="glyphicon glyphicon-trash"></i></a>
                                   </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th style="text-align:center">Photo</th>
                                <th>Status</th>
                                <th>Jabatan</th>
                                <th style="text-align:center">Aksi</th>
                              </tr>
                            </tfoot>
                          </table>

                  </div>
                      <div class="row">
                          <div class="col-md-6">
                              <a></a>
                          		<?php echo anchor(site_url('karyawan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                          		<?php echo anchor(site_url('karyawan/word'), 'Word', 'class="btn btn-primary"'); ?>
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
