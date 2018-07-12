
  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Karyawan </h2>
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
        <!-- <form action="<?php echo $action; ?>" method="post"> -->
      <?php echo form_open_multipart($action);?>
            <div class="form-group">
                <label for="varchar">ID Karyawan <?php echo form_error('id_karyawan') ?></label>
                <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" placeholder="ID Karyawan" value="<?php echo $id_karyawan; ?>" readonly/>
            </div>
    	    <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
            </div>
    	    <div class="form-group">
                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
            </div>
    	    <div class="form-group">
                <label for="int">No Telp <?php echo form_error('no_telp') ?></label>
                <!-- <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" /> -->
                <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Telepon" value="<?php echo $no_telp; ?>" min="0" maxlength="12"/>
            </div>
    	    <div class="form-group">
                <label for="varchar">Photo <?php echo form_error('photo') ?></label>
                <!-- <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" /> -->
                <?php
                    if ($button == 'Simpan') {
                ?>
                    <input type="file" class="form-control" name="photo" id="photo" required />
                <?php } elseif ($button == 'Update') {
                ?>
                    <div class="">
                        <a href="" target="_blank"><img src="<?=base_url();?>assets/uploads/<?=$photo;?>" style="width: 200px; height: 180px; margin-bottom: 5px;" class="img-rounded" alt=""></a><br /><p><?php echo $photo; ?></p>
                    </div>
                    <input type="file" class="form-control" name="photo" id="photo"/>
                <?php } ?>
            <span class="help-block">Format Foto : gif, png, jpg, jpeg, bmp. Max file size 50Mb</span>
            </div>
    	    <div class="form-group">
                <label for="varchar">Status <?php echo form_error('status') ?></label>
                <select class="form-control" name="status" id="status">
                  <option <?php echo ($status == 'NIKAH')?'selected':'' ?> value="NIKAH">NIKAH</option>
                  <option <?php echo ($status == 'BELUM NIKAH')?'selected':'' ?> value="BELUM NIKAH">BELUM NIKAH</option>
                </select>
            </div>
          <div class="form-group">
                <label for="int">Jabatan <?php echo form_error('wp_jabatan_id') ?></label>
                <select name="wp_jabatan_id" id="wp_jabatan_id" class="form-control" required>
                <option disabled selected>--Pilih Jabatan--</option>

                    <?php
                      $users = $this->db->query("SELECT * FROM wp_jabatan");
                      foreach($users->result() as $value){
                      $selected= '';
                      if($wp_jabatan_id == $value->id){
                        $selected = 'selected="selected"';
                      }
                      ?>
                      <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                      <?php echo $value->id; ?> - <?php echo $value->nama_jabatan; ?>
                      </option>
                <?php } ?>
                </select>
            </div>
    	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
    	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-danger">Kembali</a>
    	</form>
      <!-- <?php echo form_close();?> -->
      </div>
    </div>
