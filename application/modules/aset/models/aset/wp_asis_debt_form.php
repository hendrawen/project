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
        <h2 style="margin-top:0px">Wp_asis_debt <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="time">Jam <?php echo form_error('jam') ?></label>
            <input type="text" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $jam; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Turun Krat <?php echo form_error('turun_krat') ?></label>
            <input type="text" class="form-control" name="turun_krat" id="turun_krat" placeholder="Turun Krat" value="<?php echo $turun_krat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Turun Btl <?php echo form_error('turun_btl') ?></label>
            <input type="text" class="form-control" name="turun_btl" id="turun_btl" placeholder="Turun Btl" value="<?php echo $turun_btl; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Naik Krat <?php echo form_error('naik_krat') ?></label>
            <input type="text" class="form-control" name="naik_krat" id="naik_krat" placeholder="Naik Krat" value="<?php echo $naik_krat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Naik Btl <?php echo form_error('naik_btl') ?></label>
            <input type="text" class="form-control" name="naik_btl" id="naik_btl" placeholder="Naik Btl" value="<?php echo $naik_btl; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Aset Krat <?php echo form_error('aset_krat') ?></label>
            <input type="text" class="form-control" name="aset_krat" id="aset_krat" placeholder="Aset Krat" value="<?php echo $aset_krat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Aset Btl <?php echo form_error('aset_btl') ?></label>
            <input type="text" class="form-control" name="aset_btl" id="aset_btl" placeholder="Aset Btl" value="<?php echo $aset_btl; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Bayar <?php echo form_error('bayar') ?></label>
            <input type="text" class="form-control" name="bayar" id="bayar" placeholder="Bayar" value="<?php echo $bayar; ?>" />
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wp Pelanggan Id <?php echo form_error('wp_pelanggan_id') ?></label>
            <input type="text" class="form-control" name="wp_pelanggan_id" id="wp_pelanggan_id" placeholder="Wp Pelanggan Id" value="<?php echo $wp_pelanggan_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('aset') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>