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
        <h2 style="margin-top:0px">Wp_kebutuhan Read</h2>
        <table class="table">
	    <tr><td>Wp Pelanggan Id</td><td><?php echo $wp_pelanggan_id; ?></td></tr>
	    <tr><td>Wp Jkebutuhan Id</td><td><?php echo $wp_jkebutuhan_id; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Tgl</td><td><?php echo $tgl; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kebutuhan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>