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
        <h2 style="margin-top:0px">Wp_profile Read</h2>
        <table class="table">
	    <tr><td>Nama Perusahaan</td><td><?php echo $nama_perusahaan; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Website</td><td><?php echo $website; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('wp_profile') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>