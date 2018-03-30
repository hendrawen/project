<div class="x_panel">
    <div class="x_title">
      <h2>Edit User </h2>
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
        <?php echo form_open(uri_string());?>
         <div class="form-group">
            <label for="varchar">First name <?php echo form_error('first_name') ?></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" <?php echo form_input($first_name);?>
        </div>
         <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" <?php echo form_input($last_name);?>
        </div>
         <div class="form-group">
            <label for="varchar">Company <?php echo form_error('company') ?></label>
            <input type="text" class="form-control" name="company" id="company" placeholder="company" <?php echo form_input($company);?>
        </div>
        <!-- <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" <?php echo form_input($alamat);?>
        </div> -->
        <div class="form-group">
            <label for="varchar">Phone <?php echo form_error('phone') ?></label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="phone"  <?php echo form_input($phone);?>
        </div>
        <!-- <div class="form-group">
            <label for="varchar">Jatuh Tempo <?php echo form_error('jatuh_tempo') ?></label>
            <input type="text" class="form-control daterange-single" name="jatuh_tempo" id="jatuh_tempo" placeholder="phone"  <?php echo form_input($jatuh_tempo);?>
        </div> -->
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"  <?php echo form_input($password);?>
        </div>
         <div class="form-group">
            <label for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="password_confirm" <?php echo form_input($password_confirm);?>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php foreach ($groups as $group):?>
              <label class="checkbox" style="margin-left: 20px;">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"  <?php echo $checked;?>>
                 <?php echo htmlspecialchars ($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

        <?php endif ?>
         <div class="text-right">
          <?php echo form_hidden('id', $user->id);?>
        <?php echo form_hidden($csrf); ?>
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
         <button type="submit" value="upload" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	       <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>

        </div>
        </div>
        </div>
	<?php echo form_close(); ?>
</div>
</div>
