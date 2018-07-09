<div class="x_panel">
      <div class="x_title">
            <h2>Kategori kas list</h2>
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
                    <div class="col-xs-12">
                      <?php echo form_open_multipart($action);?>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
                      <a href="<?php echo site_url('kas/kategorikas') ?>" class="btn btn-danger" style="display:<?php echo $display ?>">Cancel</a>
                          <div class="form-group">
                                <input type="text" class="form-control inline" name="nama" id="nama" placeholder="Nama Kategori Kas" value="<?php echo $nama; ?>" required/>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                      </form>
                  </div>
                </div>

            <div class="x_content">
    <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th style="text-align:center;">Action</th>
        </tr>
      </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($kategorikas as $key){ ?>
         <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $key->nama ?></td>
              <td style="text-align:center;">
                <a href="<?=site_url()?>kas/kategorikas/update/<?=$key->id ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                <a class="btn btn-default btn-sm" onclick="return swal({
                                        title: 'Apakah Anda yakin untuk menghapus data ini?',
                                        text: 'Data yang terhapus tidak dapat dikembalikan!',
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d9534f',
                                           }, function(){
                                              window.location.href ='<?=site_url()?>kas/kategorikas/delete/<?=$key->id ?>';
                                                         });"><i class="glyphicon glyphicon-trash"></i></a>
             </td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th style="text-align:center;">Action</th>
        </tr>
      </tfoot>
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
