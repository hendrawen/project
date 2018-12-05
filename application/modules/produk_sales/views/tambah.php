
  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Produk Sales </h2>
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
              <?php
                    if ($button == 'Create') {
                ?>
                    <input type="hidden" class="form-control" name="id_produksales" id="id_produksales" />
                <?php } elseif ($button == 'Update') {
                ?>
                <label for="varchar">Id Produk <?php echo form_error('id_produksales') ?></label>
                    <input type="text" class="form-control" name="id_produksales" id="id_produksales" value="<?php echo $id_produksales; ?>" readonly />
                <?php } ?>
        	    <div class="form-group">
                    <label for="int">Nama Produk <?php echo form_error('wp_barang_id') ?></label>
                    <select name="wp_barang_id" id="wp_barang_id" class="form-control" required>
                    <option disabled selected>--Pilih Produk--</option>
                        <?php
                          $barang = $this->db->query("SELECT * FROM wp_barang");
                          foreach($barang->result() as $value){
                          $selected= '';
                          if($wp_barang_id == $value->id){
                            $selected = 'selected="selected"';
                          }
                          ?>
                          <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                          <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
                          </option>
                          <?php }?>
                    </select>
               </div>    
               <div class="form-group">
                    <label for="int">Kategori Produk <?php echo form_error('wp_kategori_id_kategori') ?></label>
                    <select name="wp_kategori_id_kategori" id="wp_kategori_id_kategori" class="form-control" required>
                    <option disabled selected>--Pilih Produk--</option>
                        <?php
                          $barang = $this->db->query("SELECT * FROM wp_kategori");
                          foreach($barang->result() as $value){
                          $selected= '';
                          if($wp_kategori_id_kategori == $value->id){
                            $selected = 'selected="selected"';
                          }
                          ?>
                          <option  value="<?php echo $value->id_kategori; ?>"  <?php echo $selected;?> >
                          <?php echo $value->id_kategori; ?> - <?php echo $value->nama_kategori; ?>
                          </option>
                          <?php } ?>
                    </select>
               </div>   	    
        	    <div class="form-group">
                    <label for="varchar">Harga Jual <?php echo form_error('harga_jual') ?></label>
                    <input type="number" class="form-control" name="harga_jual" id="harga_jual" min="0" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" />
                </div>
                       
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
        	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
        	    <a href="<?php echo site_url('produk_sales') ?>" class="btn btn-danger">Kembali</a>
        	</form>
      </div>
    </div>
