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
        <h2 style="margin-top:0px">Wp_transaksi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Id Transaksi <?php echo form_error('id_transaksi') ?></label>
            <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" placeholder="Id Transaksi" value="<?php echo $id_transaksi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wp Barang Id <?php echo form_error('wp_barang_id') ?></label>
            <input type="text" class="form-control" name="wp_barang_id" id="wp_barang_id" placeholder="Wp Barang Id" value="<?php echo $wp_barang_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Qty <?php echo form_error('qty') ?></label>
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Transaksi <?php echo form_error('tgl_transaksi') ?></label>
            <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl Transaksi" value="<?php echo $tgl_transaksi; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wp Pelanggan Id <?php echo form_error('wp_pelanggan_id') ?></label>
            <input type="text" class="form-control" name="wp_pelanggan_id" id="wp_pelanggan_id" placeholder="Wp Pelanggan Id" value="<?php echo $wp_pelanggan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wp Status Id <?php echo form_error('wp_status_id') ?></label>
            <input type="text" class="form-control" name="wp_status_id" id="wp_status_id" placeholder="Wp Status Id" value="<?php echo $wp_status_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('wp_transaksi') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>