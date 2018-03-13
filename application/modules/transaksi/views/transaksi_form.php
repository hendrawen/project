
    <div class="x_panel">
        <div class="x_title">
          <h2><?php echo $button ?> Transaksi </h2>
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
              <label for="varchar">Id Transaksi <?php echo form_error('id_transaksi') ?></label>
              <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" placeholder="Id Transaksi" value="<?php echo $id_transaksi; ?>" />
          </div> -->
        <div class="form-group">
              <label for="int">Nama Barang <?php echo form_error('wp_barang_id') ?></label>
              <!-- <input type="text" class="form-control" name="wp_barang_id" id="wp_barang_id" placeholder="Wp Barang Id" value="<?php echo $wp_barang_id; ?>" /> -->
              <select name="wp_barang_id" id="wp_barang_id" class="form-control" required>
              <option disabled selected>--Pilih Barang--</option>

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
                    <?php }?>
                      </select>
          </div>
        <div class="form-group">
              <label for="varchar">Harga <?php echo form_error('harga') ?></label>
              <input type="number" class="form-control" name="harga" id="harga" min="0" placeholder="Harga Beli" value="<?php echo $harga; ?>" />
          </div>
        <div class="form-group">
              <label for="varchar">Jumlah/Qty <?php echo form_error('harga_jual') ?></label>
              <input type="number" class="form-control" name="qty" id="qty" min="0" placeholder="Qty" value="<?php echo $qty; ?>" />
          </div>
        <div class="form-group">
              <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
              <!-- <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" /> -->
              <select class="form-control" name="satuan" id="satuan">
                      <option disabled selected>--Pilih Satuan--</option>
                      <option value="Krat" <?php if ($satuan=='Krat'){echo "selected";} ?>>Krat</option>
                      <option value="Dus" <?php if ($satuan=='Dus'){echo "selected";} ?>>Dus</option>
                      <option value="Botol" <?php if ($satuan=='Botol'){echo "selected";} ?>>Botol</option>
              </select>
          </div>
        <!-- <div class="form-group">
              <label for="date">Tgl Transaksi <?php echo form_error('tgl_transaksi') ?></label>
              <input type="text" class="form-control" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl Transaksi" value="<?php echo $tgl_transaksi; ?>" />
          </div>
        <div class="form-group">
              <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
              <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
          </div> -->
        <div class="form-group">
              <label for="int">Nama Pelanggan <?php echo form_error('wp_pelanggan_id') ?></label>
              <!-- <input type="text" class="form-control" name="wp_pelanggan_id" id="wp_pelanggan_id" placeholder="Wp Pelanggan Id" value="<?php echo $wp_pelanggan_id; ?>" /> -->
              <select name="wp_pelanggan_id" id="wp_pelanggan_id" class="form-control" required>
              <option disabled selected>--Pilih Pelanggan--</option>

                  <?php
                    $users = $this->db->query("SELECT * FROM wp_pelanggan");
                    foreach($users->result() as $value){
                    $selected= '';
                    if($wp_pelanggan_id == $value->id){
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                    <?php echo $value->id_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?>
                    </option>
                    <?php }?>
                      </select>
          </div>
        <div class="form-group">
              <label for="varchar">Username <?php echo form_error('username') ?></label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
          </div>
        <div class="form-group">
              <label for="int">Status <?php echo form_error('wp_status_id') ?></label>
              <!-- <input type="text" class="form-control" name="wp_status_id" id="wp_status_id" placeholder="Wp Status Id" value="<?php echo $wp_status_id; ?>" /> -->
              <select name="wp_status_id" id="wp_status_id" class="form-control" required>
              <option disabled selected>--Pilih Status--</option>

                  <?php
                    $users = $this->db->query("SELECT * FROM wp_status");
                    foreach($users->result() as $value){
                    $selected= '';
                    if($wp_status_id == $value->id){
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> > <?php echo $value->status; ?>
                    </option>
                    <?php }?>
                      </select>
          </div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
              <a href="<?php echo site_url('transaksi') ?>" class="btn btn-danger">Kembali</a>
          	</form>
        </div>
      </div>
