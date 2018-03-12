<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Wp_transaksi Read</h2>
        <table class="table">
	    <tr><td>Id Transaksi</td><td><?php echo $id_transaksi; ?></td></tr>
	    <tr><td>Wp Barang Id</td><td><?php echo $wp_barang_id; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>Tgl Transaksi</td><td><?php echo $tgl_transaksi; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td>Wp Pelanggan Id</td><td><?php echo $wp_pelanggan_id; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Wp Status Id</td><td><?php echo $wp_status_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wp_transaksi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>