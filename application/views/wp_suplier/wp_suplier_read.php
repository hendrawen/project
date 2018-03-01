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
        <h2 style="margin-top:0px">Wp_suplier Read</h2>
        <table class="table">
	    <tr><td>Id Suplier</td><td><?php echo $id_suplier; ?></td></tr>
	    <tr><td>Nama Suplier</td><td><?php echo $nama_suplier; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wp_suplier') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>