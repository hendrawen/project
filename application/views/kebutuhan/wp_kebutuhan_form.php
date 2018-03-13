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
        <h2 style="margin-top:0px">Wp_kebutuhan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Wp Pelanggan Id <?php echo form_error('wp_pelanggan_id') ?></label>
            <input type="text" class="form-control" name="wp_pelanggan_id" id="wp_pelanggan_id" placeholder="Wp Pelanggan Id" value="<?php echo $wp_pelanggan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wp Jkebutuhan Id <?php echo form_error('wp_jkebutuhan_id') ?></label>
            <input type="text" class="form-control" name="wp_jkebutuhan_id" id="wp_jkebutuhan_id" placeholder="Wp Jkebutuhan Id" value="<?php echo $wp_jkebutuhan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jumlah <?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl <?php echo form_error('tgl') ?></label>
            <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kebutuhan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>