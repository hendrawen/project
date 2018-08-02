  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Jadwal Kunjungan </h2>
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
      <?php echo form_open_multipart($action);?>
      <div class="form-group">
            <label for="int">Nama Pelanggan <?php echo form_error('nama_pel') ?></label>
            <select name="nama_pel" id="nama_pel" class="form-control" required>
            <option disabled selected>--Pilih Pelanggan--</option>

                <?php
                  foreach($pelanggan as $value){
                  $selected= '';
                  if($nama_pel == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                  <?php echo $value->id_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?>
                  </option>
            <?php } ?>
            </select>
        </div>

        <div class="form-group">
              <label for="int">Validator <?php echo form_error('validator') ?></label>
              <select name="validator" id="validator" class="form-control" required>
              <option disabled selected>--Pilih Validator--</option>

                  <?php
                    foreach($m_validator as $value){
                    $selected= '';
                    if($validator == $value->id_karyawan){
                      $selected = 'selected="selected"';
                    }
                    ?>
                    <option value="<?php echo $value->id_karyawan; ?>"  <?php echo $selected;?> >
                    <?php echo $value->id_karyawan; ?> - <?php echo $value->nama; ?>
                    </option>
              <?php } ?>
              </select>
          </div>

    	    <div class="form-group">
                <label for="varchar">Tanggal Kunjungan <?php echo form_error('tanggal') ?></label>
                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>" />
            </div>
          <div class="form-group">
          <label>Sumber Data <?php echo form_error('sumber_data') ?></label>
          <select name="sumber_data" id="sumber_data" class="form-control">
            <option disabled selected>--Sumber Data--</option>
              <option <?php if( $sumber_data=='Due Date'){echo "selected"; } ?> value="Due Date">Due Date</option>
              <option <?php if( $sumber_data=='Hijau'){echo "selected"; } ?> value="Hijau">Hijau</option>
              <option <?php if( $sumber_data=='Biru'){echo "selected"; } ?> value="Biru">Biru</option>
              <option <?php if( $sumber_data=='Kuning'){echo "selected"; } ?> value="Kuning">Kuning</option>
              <option <?php if( $sumber_data=='Orange'){echo "selected"; } ?> value="Orange">Orange</option>
              <option <?php if( $sumber_data=='Jingga'){echo "selected"; } ?> value="Jingga">Jingga</option>
              <option <?php if( $sumber_data=='Hijau Muda'){echo "selected"; } ?> value="Hijau Muda">Hijau Muda</option>
              <option <?php if( $sumber_data=='New Customer'){echo "selected"; } ?> value="New Customer">New Customer</option>
          </select>
            </div>
    	    <div class="form-group">
                <label for="alamat">Keterangan <?php echo form_error('ket') ?></label>
                <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Keterangan"><?php echo $ket; ?></textarea>
            </div>

    	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" />
    	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
    	    <a href="<?php echo site_url('jadwalkunjungan') ?>" class="btn btn-danger">Kembali</a>
    	</form>
      <!-- <?php echo form_close();?> -->
      </div>
    </div>
