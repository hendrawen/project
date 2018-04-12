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
        <h2 style="margin-top:0px">Wp_asis_debt Read</h2>
        <table class="table">
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Jam</td><td><?php echo $jam; ?></td></tr>
	    <tr><td>Turun Krat</td><td><?php echo $turun_krat; ?></td></tr>
	    <tr><td>Turun Btl</td><td><?php echo $turun_btl; ?></td></tr>
	    <tr><td>Naik Krat</td><td><?php echo $naik_krat; ?></td></tr>
	    <tr><td>Naik Btl</td><td><?php echo $naik_btl; ?></td></tr>
	    <tr><td>Aset Krat</td><td><?php echo $aset_krat; ?></td></tr>
	    <tr><td>Aset Btl</td><td><?php echo $aset_btl; ?></td></tr>
	    <tr><td>Bayar</td><td><?php echo $bayar; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Wp Pelanggan Id</td><td><?php echo $wp_pelanggan_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('aset') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>