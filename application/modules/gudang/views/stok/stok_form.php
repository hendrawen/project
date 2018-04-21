  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Stok Barang </h2>
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
        <div class="form-group">
            <label for="int">Nama Barang <?php echo form_error('wp_barang_id') ?></label>
            <!-- <input type="text" class="form-control" name="wp_barang_id" id="wp_barang_id" placeholder="Wp Barang Id" value="<?php echo $wp_barang_id; ?>" /> -->
            <select name="wp_barang_id" id="wp_barang_id" class="form-control" required>
            <option disabled selected>--Pilih Nama Barang--</option>

                <?php
                  $users = $this->db->query("SELECT * FROM wp_barang");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($wp_barang_id == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                  <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
                  </option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok Barang" value="<?php echo $stok; ?>" min="0"/>
        </div>
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
        <a href="<?php echo site_url('gudang/stok') ?>" class="btn btn-danger">Kembali</a>
        </form>
      </div>
    </div>
