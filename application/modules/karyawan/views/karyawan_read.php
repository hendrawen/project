
  <div class="x_panel">
        <div class="x_title">
              <h2>Detail Karyawan</h2>
              <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
        </div><br>
      <div class="x_content">
        <table class="table table-hover dt-responsive nowrap">
          <tr><td>Photo</td><td>:</td><td><img src="<?php echo base_url();?>assets/uploads/<?php echo $photo; ?>" width="250" height="250"></td></tr>
          <tr><td>Format</td><td>:</td><td><?php echo $photo; ?></td></tr>
          <tr><td>Nama</td><td>:</td><td><?php echo $nama; ?></td></tr>
    	    <tr><td>Alamat</td><td>:</td><td><?php echo $alamat; ?></td></tr>
    	    <tr><td>No Telp</td><td>:</td><td><?php echo $no_telp; ?></td></tr>
    	    <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
    	    <tr><td>Id Jabatan</td><td>:</td><td><?php echo $wp_jabatan_id; ?></td></tr>
  	    <tr><td colspan="3" align="center"><a href="<?php echo site_url('karyawan') ?>" class="btn btn-danger">Kembali</a></td></tr>
      </table>
    </div>
    </div>
