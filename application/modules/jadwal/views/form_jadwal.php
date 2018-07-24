<div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Jadwal </h2>
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
        <form action="<?php echo $action; ?>" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
              <input type="hidden" id="start">
              <input type="hidden" id="end">
              <div class="form-group">
                <label for="title">Pelanggan</label>
                <select name="wp_pelanggan_id" id="wp_pelanggan_id" class="form-control js-example-basic-single" required>
                <option disabled selected>--Pilih Pelanggan--</option>

                    <?php
                      $users = $this->db->query("SELECT * FROM wp_pelanggan Where status='Pelanggan'");
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
                  <label for="title">Judul</label>
                      <input id="title" name="title" type="text" value="<?php echo $title; ?>" class="form-control input-md" />
              </div>
              <div class="form-group">
                <label for="title">Barang</label>
                <select name="wp_barang_id" id="wp_barang_id" class="form-control js-example-basic-single" required>
                <option value="" selected>--Pilih--</option>
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
                <label for="qty">Qty</label>
                <input type="number" name="qty" id="qty" value="<?php echo $qty; ?>" class="form-control">
              </div>
              <div class="form-group">
                  <label for="description">Keterangan</label>
                      <textarea class="form-control" id="description" name="description" value=""><?php echo $description; ?></textarea>
              </div>
              <div class="form-group">
                  <label for="color">Sumber Data</label>
                  <select id="color" name="color" class="form-control">
                  <option disabled selected>--Pilih--</option>
                  <option value="Due Date" <?php if ($color =='Due Date') { echo "selected";}?>>Due Date</option>    
                  <option value="Hijau" <?php if ($color =='Hijau') { echo "selected";}?>>Hijau</option>
                  <option value="Biru" <?php if ($color =='Biru') { echo "selected";}?>>Biru</option>
                  <option value="Kuning" <?php if ($color =='Kuning') { echo "selected";}?>>Kuning</option>
                  <option value="Orange" <?php if ($color =='Orange') { echo "selected";}?>>Orange</option>
                  <option value="Jingga" <?php if ($color =='Jingga') { echo "selected";}?>>Jingga</option>
                  <option value="Hijau Muda" <?php if ($color =='Hijau Muda') { echo "selected";}?>>Hijau Muda</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="title">Pilih Driver</label>
                <select name="wp_karyawan_id_karyawan" id="wp_karyawan_id_karyawan" class="form-control js-example-basic-single" required>
                <option value="" selected>--Pilih--</option>
                    <?php
                      $users = $this->db->query("SELECT * FROM wp_karyawan join wp_jabatan where wp_karyawan.wp_jabatan_id = wp_jabatan.id AND
                      wp_jabatan.nama_jabatan = 'Debt & Delivery'");
                      foreach($users->result() as $value){
                      $selected= '';
                      if($wp_karyawan_id_karyawan == $value->id_karyawan){
                        $selected = 'selected="selected"';
                      }
                      ?>
                      <option  value="<?php echo $value->id_karyawan; ?>"  <?php echo $selected;?> >
                      <?php echo $value->id_karyawan; ?> - <?php echo $value->nama; ?>
                      </option>
                      <?php }?>
                </select>
              </div>

              <input type="hidden" name="id" value="<?php echo $id; ?>" />
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                          <div class="text-left">
                            <a href="<?php echo base_url('jadwal')?>" type="button" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                          </div>
            </form>
      </div>
    </div>
