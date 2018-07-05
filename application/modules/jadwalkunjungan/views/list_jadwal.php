<div class="x_panel">
      <div class="x_title">
            <h2>Jadwal Kunjungan List</h2>
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
                <a href="<?php echo site_url('jadwalkunjungan/create'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus" ></i> Tambah</a>
                </div>
          </div>
            <div class="col-md-6 text-right">
            </div>

            <div class="x_content">
    <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Validator</th>
          <th>Tanggal Kunjungan</th>
          <th>Sumber Data</th>
          <th>Keterangan</th>
          <th style="text-align:center" >Action</th>
        </tr>
      </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($jadwal as $key){ ?>
         <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $key->id_pelanggan ?> - <?php echo $key->nama_pelanggan ?></td>
              <td><?php echo $key->nama ?></td>
              <td><?php echo $key->tanggal_kunjungan ?></td>
              <td><?php echo $key->sumber_data ?></td>
              <td><?php echo $key->keterangan ?></td>
              <td style="text-align:center">
                <a href="<?=site_url()?>jadwalkunjungan/update/<?=$key->id_jadwal ?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                <a class="btn btn-default btn-sm" onclick="return swal({
                                        title: 'Apakah Anda yakin untuk menghapus data ini?',
                                        text: 'Data yang terhapus tidak dapat dikembalikan!',
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d9534f',
                                           }, function(){
                                              window.location.href ='<?=site_url()?>jadwalkunjungan/delete/<?=$key->id_jadwal ?>';
                                                         });"><i class="glyphicon glyphicon-trash"></i></a>
             </td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Pelanggan</th>
          <th>Validator</th>
          <th>Tanggal Kunjungan</th>
          <th>Keterangan</th>
          <th style="text-align:center" >Action</th>
        </tr>
      </tfoot>
    </table>

</div>
<div class="row">
    <div class="col-md-6">
        <?php echo anchor(site_url('jadwalkunjungan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        <!-- <?php echo anchor(site_url('jadwalkunjungan/word'), 'Word', 'class="btn btn-primary"'); ?> -->
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
