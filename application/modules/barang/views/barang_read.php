<div class="x_panel">
      <div class="x_title">
            <h2>Detail Barang</h2>
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
	    <tr><td>Id Barang</td><td>:</td><td><?php echo $id_barang; ?></td></tr>
	    <tr><td>Nama Barang</td><td>:</td><td><?php echo $nama_barang; ?></td></tr>
	    <tr><td>Harga Beli</td><td>:</td><td><?php echo $harga_beli; ?></td></tr>
	    <tr><td>Harga Jual</td><td>:</td><td><?php echo $harga_jual; ?></td></tr>
	    <tr><td>Wp Suplier Id</td><td>:</td><td><?php echo $wp_suplier_id; ?></td></tr>
	    <tr><td>Tanggal Input</td><td>:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Tanggal Update</td><td>:</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td colspan="3" align="center"><a href="<?php echo site_url('barang') ?>" class="btn btn-danger">Kembali</a></td></tr>
    </table>
  </div>
  </div>
