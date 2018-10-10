
<div class="x_panel">
    <div class="x_title">
      <h2>Tambah User </h2>
      <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
        <!--   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul> -->
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <?php echo form_open("users/auth/create_user");?>
       <div class="form-group">
          <label for="varchar">First name <?php echo form_error('first_name') ?></label>
          <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required="required"  />
      </div>
       <div class="form-group">
          <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
          <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" required="required"  />
      </div>

    <div class="form-group">
          <label for="varchar">Username <?php echo form_error('username') ?></label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required"  />
      </div>

       <div class="form-group">
          <label for="varchar">identity <?php echo form_error('identity') ?></label>
          <input type="text" class="form-control" name="identity" id="identity" placeholder="identity" required="required"  />
      </div>
      <div class="form-group">
          <label for="varchar">Company <?php echo form_error('company') ?></label>
          <input type="text" class="form-control" name="company" id="company" placeholder="company" required="required" />
      </div>
      <!-- <div class="form-group">
          <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
          <textarea class="form-control" name="alamat" id="alamat" placeholder="alamat" required="required" /></textarea>
      </div> -->
      <div class="form-group">
          <label for="varchar">Email <?php echo form_error('email') ?></label>
          <input type="text" class="form-control" name="email" id="email" placeholder="email" required="required"  />
      </div>
      <div class="form-group">
          <label for="varchar">Phone <?php echo form_error('phone') ?></label>
          <input type="text" class="form-control" name="phone" id="phone" placeholder="phone"  required="required" />
      </div>

	  <div class="form-group">
			<label for="cabang">Cabang</label>
				<select name="cabang" id="cabang" class="form-control">
					<option value="">Pilih</option>
					<?php
					$penempatan = $this->db->get('wp_cabang')->result();
					foreach($penempatan as $value){
						$selected= '';
						if($cabang == $value->id){
							$selected = 'selected="selected"';
						}
						?>
						<option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
						<?php echo $value->id; ?> - <?php echo $value->nama_cabang; ?>
						</option>
					<?php }?>
				</select>
		</div>
      <!-- <div class="form-group">
          <label for="varchar">Jatuh Tempo <?php echo form_error('jatuh_tempo') ?></label>
          <input type="text" class="form-control daterange-single" name="jatuh_tempo" id="jatuh_tempo" placeholder="jatuh tempo" required="required"  />
      </div> -->
    <div class="form-group">
          <label for="varchar">Password <?php echo form_error('password') ?></label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password"  required="required" />
      </div>
       <div class="form-group">
          <label for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
          <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="password_confirm"  required="required" />
      </div>
      <br>
       <div class="text-right">
          <input type="hidden" name="id" id="id" />
              <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
       <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
       <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
     <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>

      </div>

      <?php echo form_close(); ?>

    </div>
  </div>
