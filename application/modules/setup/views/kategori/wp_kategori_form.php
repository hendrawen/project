<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-group"></i> <?php echo ($button == 'Create')?'Tambah':'Update' ?> Data Kategori</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Kategori <?php echo form_error('nama_kategori') ?></label>
            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" value="<?php echo $nama_kategori; ?>" autofocus/>
        </div>
	    <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" />
	    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('setup/kategori') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
	</form>
</div>
</div>