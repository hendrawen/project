
<div class="x_panel">
    <div class="x_title">
      <h2>Tambah Group </h2>
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
      <?php echo form_open_multipart($action);?>
       <div class="form-group">
          <label for="varchar">Nama Group <?php echo form_error('name') ?></label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" required="required"/>
      </div>
       <div class="form-group">
          <label for="varchar">Deskripsi <?php echo form_error('description') ?></label>
          <!-- <input type="text" class="form-control" name="description" id="description" placeholder="Deskripsi" value="<?php echo $description; ?>" required="required"  /> -->
          <textarea class="form-control" rows="3" name="description" id="description" placeholder="Deskripsi" required><?php echo $description; ?></textarea>
      </div>
      <br>
       <div class="text-right">
         <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
       <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button; ?></button>
     <a href="<?php echo site_url('users/groups') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Batal</a>
   </div>
      <?php echo form_close(); ?>
   </div>
  </div>
