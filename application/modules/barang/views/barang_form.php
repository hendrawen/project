
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
                      <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
                       <!-- <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
                       <select class="form-control" name="satuan" id="satuan">
                              <option disabled selected>--Pilih Satuan--</option>
                              <?php
                                    $query = $this->db->query("SELECT * FROM wp_barang");
                                     foreach ($query->result() as $rows) {
                                ?>
                                <option <?php echo ($satuan==$rows->satuan) ? 'selected=""':""; ?> value="<?php echo $rows->satuan; ?>"><?php echo $rows->satuan; ?></option>
                            <?php } ?>
                      </select> -->
                      <select class="form-control" name="satuan" id="satuan">
                            <option disabled selected>--Pilih Satuan--</option>
                            <option value="Krat" <?php if ($satuan=='Krat') {echo "selected";}?>>Krat</option>
                            <option value="Dus" <?php if ($satuan=='Dus') {echo "selected";}?>>Dus</option>
                      </select>
                  </div>
        	    <div class="form-group">
                    <label for="int">Nama Suplier <?php echo form_error('wp_suplier_id') ?></label>
                    <select name="wp_suplier_id" id="wp_suplier_id" class="form-control" required>
                    <option disabled selected>--Pilih Suplier--</option>

                        <?php
                          $users = $this->db->query("SELECT * FROM wp_suplier");
                          foreach($users->result() as $value){
                          $selected= '';
                          if($wp_suplier_id == $value->id){
                            $selected = 'selected="selected"';
                          }
                          ?>
                          <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                          <?php echo $value->id_suplier; ?> - <?php echo $value->nama_suplier; ?>
                          </option>
                          <?php }?>
                            </select>
               </div>
        	    <!-- <div class="form-group">
                    <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
                    <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
                </div>-->
        	    <div class="form-group">
                    <label for="int">Dari Gudang <?php echo form_error('gudang') ?></label>
                    <select name="wp_gudang_id" id="wp_gudang_id" class="form-control" required>
                    <option disabled selected>--Pilih Gudang--</option>

                        <?php
                          $users = $this->db->query("SELECT * FROM wp_gudang");
                          foreach($users->result() as $value){
                          $selected= '';
                          if($wp_gudang_id == $value->id){
                            $selected = 'selected="selected"';
                          }
                          ?>
                          <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                          <?php echo $value->nama_gudang; ?>
                          </option>
                          <?php }?>
                            </select>
                </div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
        	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
        	    <a href="<?php echo site_url('barang') ?>" class="btn btn-danger">Kembali</a>
        	</form>
      </div>
    </div>
