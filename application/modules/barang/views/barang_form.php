
  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Barang </h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
            <form action="<?php echo $action; ?>" method="post">
        	    <!-- <div class="form-group">
                    <label for="varchar">Id Barang <?php echo form_error('id_barang') ?></label>
                    <input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" />
              </div> -->
              <?php
                    if ($button == 'Create') {
                ?>
                    <input type="hidden" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" />
                <?php } elseif ($button == 'Update') {
                ?>
                <label for="varchar">Id Barang <?php echo form_error('id_barang') ?></label>
                    <input type="text" class="form-control" name="id_barang" id="id_barang" value="<?php echo $id_barang; ?>" readonly />
                <?php } ?>
        	    <div class="form-group">
                    <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="varchar">Harga Beli <?php echo form_error('harga_beli') ?></label>
                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" min="0" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="varchar">Harga Jual <?php echo form_error('harga_jual') ?></label>
                    <input type="number" class="form-control" name="harga_jual" id="harga_jual" min="0" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="int">Nama Suplier <?php echo form_error('wp_suplier_id') ?></label>
                    <select name="wp_suplier_id" id="wp_suplier_id" class="form-control" required>
                    <option disabled selected>--Pilih Suplier--</option>
                        <?php
                            $coba = $this->db->query("SELECT * FROM wp_suplier");
                             foreach ($coba->result() as $rows) {
                               if ($button == 'Tambah') {
                        ?>
                    <option <?php echo ($id==$rows->id) ? 'selected=""':"";?> value="<?php echo $rows->id; ?>"><?php echo $rows->id; ?> - <?php echo $rows->nama_suplier; ?></option>
                  <?php } elseif ($button == 'Update') { ?>
                    <option <?php echo ($id==$rows->id) ? 'selected=""':"selected";?> value="<?php echo $rows->id; ?>"><?php echo $rows->id; ?> - <?php echo $rows->nama_suplier; ?></option>
                  <?php } }?>
                    </select>
               </div>
        	    <!-- <div class="form-group">
                    <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
                    <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
                </div>
        	    <div class="form-group">
                    <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
                    <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
                </div> -->
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
        	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        	    <a href="<?php echo site_url('barang') ?>" class="btn btn-danger">Kembali</a>
        	</form>
      </div>
    </div>
