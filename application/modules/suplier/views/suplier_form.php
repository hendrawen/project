        <h2 style="margin-top:0px"><?php echo $button ?> Suplier</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Id Suplier <?php echo form_error('id_suplier') ?></label>
            <input type="text" class="form-control" name="id_suplier" id="id_suplier" placeholder="Id Suplier" value="<?php echo $id_suplier; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Suplier <?php echo form_error('nama_suplier') ?></label>
            <input type="text" class="form-control" name="nama_suplier" id="nama_suplier" placeholder="Nama Suplier" value="<?php echo $nama_suplier; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('suplier') ?>" class="btn btn-danger">Cancel</a>
	</form>
