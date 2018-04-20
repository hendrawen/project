  <div class="x_panel">
      <div class="x_content">
        <table class="table table-hover dt-responsive nowrap">
          <tr><td>Photo </td><td>:</td><td><img src="<?php echo base_url();?>assets/uploads/<?php echo $photo; ?>" width="100" height="100"></td></tr>
          <tr><td>Nama</td><td>:</td><td><?php echo $nama_pelanggan; ?></td></tr>
          <tr><td>Nama Dagang</td><td>:</td><td><?php echo $nama_dagang; ?></td></tr>
          <tr><td>Kota</td><td>:</td><td><?php echo $kota; ?></td></tr>
          <tr><td>Kelurahan</td><td>:</td><td><?php echo $kelurahan; ?></td></tr>
          <tr><td>Kecamatan</td><td>:</td><td><?php echo $kecamatan; ?></td></tr>
    	    <tr><td>Alamat Lengkap</td><td>:</td><td><?php echo $alamat; ?></td></tr>
    	    <tr><td>No Telp</td><td>:</td><td><?php echo $no_telp; ?></td></tr>
    	    <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
    	    <tr><td>Tangal</td><td>:</td><td><?php echo $created_at; ?></td></tr>
  	    <tr><td colspan="3" align="center"><a href="<?php echo site_url('marketing') ?>" class="btn btn-danger">Kembali</a></td></tr>
      </table>
    </div>
    </div>
