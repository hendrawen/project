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
                    $coba = $this->db->query("SELECT * FROM wp_barang");
                     foreach ($coba->result() as $rows) {
                ?>
            <option <?php echo ($id==$rows->id) ? 'selected=""':"";?> value="<?php echo $rows->id; ?>"><?php echo $rows->id; ?> - <?php echo $rows->nama_barang; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
        <!-- <div class="form-group">
            <label for="timestamp">Tanggal Update <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div> -->
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('barang/stok') ?>" class="btn btn-danger">Kembali</a>
        </form>
      </div>
    </div>
