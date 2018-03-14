<div class="col-md-6 col-xs-12" style="border: 1px solid #ccc">
  <div class="x_panel">
        <div class="x_title">
              <h2>Detail Transaksi</h2>
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
        <tr><td>Id Transaksi</td><td>:</td><td><?php echo $id_transaksi; ?></td></tr>
  	    <tr><td>Barang ID</td><td>:</td><td><?php echo $wp_barang_id; ?></td></tr>
  	    <tr><td>Harga</td><td>:</td><td><?php echo $harga; ?></td></tr>
  	    <tr><td>Qty</td><td>:</td><td><?php echo $qty; ?></td></tr>
  	    <tr><td>Satuan</td><td>:</td><td><?php echo $satuan; ?></td></tr>
  	    <tr><td>Tgl Transaksi</td><td>:</td><td><?php echo $tgl_transaksi; ?></td></tr>
  	    <tr><td>Updated At</td><td>:</td><td><?php echo $updated_at; ?></td></tr>
  	    <tr><td>Pelanggan Id</td><td>:</td><td><?php echo $wp_pelanggan_id; ?></td></tr>
  	    <tr><td>Username</td><td>:</td><td><?php echo $username; ?></td></tr>
  	    <tr><td>Status Id</td><td>:</td><td><?php echo $wp_status_id; ?></td></tr>
  	    <tr><td colspan="3" align="center"><a href="<?php echo site_url('transaksi') ?>" class="btn btn-danger">Kembali</a></td></tr>
      </table>
    </div>
    </div>
</div
