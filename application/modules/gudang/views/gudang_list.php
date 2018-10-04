<div class="x_panel">
      <div class="x_title">
            <h2>Gudang List</h2>
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

<!--Tambah Gudang-->
      <?php echo form_open_multipart($action);?>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <?php if ($button == 'Tambah') { ?>
        <div class="col-md-6">
      	    <div class="form-group">
                  <label for="varchar">Gudang <?php echo form_error('nama_gudang') ?></label>
                  <input type="text" class="form-control" name="nama_gudang" id="nama_gudang" placeholder="Isi Nama Gudang Disini...!!!" required/>
            </div>
            <div class="form-group">
                  <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
                  <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Isi Nama Alamat Disini...!!!" required/>
            </div>
        </div>
        <button style="margin-top:24px;" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $button; ?></button>
        <?php } elseif ($button == 'Update') { ?>
          <div class="col-md-6">
        	    <div class="form-group">
                  <label for="varchar">Gudang <?php echo form_error('nama_gudang') ?></label>
                  <input type="text" class="form-control" name="nama_gudang" id="nama_gudang" placeholder="Isi Nama Gudang Disini...!!!" value="<?php echo $nama_gudang; ?>" required/>
              </div>
              <div class="form-group">
                  <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
                  <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Isi Nama Alamat Disini...!!!" value="<?php echo $alamat; ?>" required/>
            </div>
          </div>
          <button style="margin-top:24px;" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button; ?></button>
          <a style="margin-top:24px;" href="<?php echo site_url('gudang') ?>" class="btn btn-danger">Batal</a>
        <?php } ?>
    	</form>
<!--akhir-->
  <br><hr>

          <div class="row">
            <div class="col-md-6">
                <!-- <?php echo anchor(site_url('karyawan/jabatan/create'),'Tambah Jabatan', 'class="btn btn-primary"'); ?> -->
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
                              <th>Nama Gudang</th>
                              <th>Alamat</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($gudang as $key){ ?>
                       <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $key->nama_gudang ?></td>
                            <td><?php echo $key->alamat ?></td>
                            <td style="text-align:center">
                              <!-- <a href="<?=base_url()?>karyawan/jabatan/read/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></a> -->
                              <a href="<?=base_url()?>gudang/update/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                              <!-- <a onclick="javasciprt: return confirm('Are You Sure ?')" href="<?=base_url()?>barang/delete/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></a> -->
                              <a class="btn btn-default btn-sm" onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?=base_url()?>gudang/delete/<?=$key->id ?>';
                                                                       });"><i class="glyphicon glyphicon-trash"></i></a>
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Nama Gudang</th>
                        <th>Alamat</th>
                        <th style="text-align:center">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <a></a>
                      <!-- <?php echo anchor(site_url('gudang/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php echo anchor(site_url('gudang/word'), 'Word', 'class="btn btn-primary"'); ?> -->
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
                                //  location.reload();
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
                                //  location.reload();
                               }
                             );
                       </script>
                     </small>
                <?php endif; ?>
