<div class="x_panel">
    <div class="x_title">
      <h2><?php echo $button ?> Suplier </h2>
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
      <form action="<?php echo $action; ?>" method="post">
          <!-- <div class="form-group">
                <label for="varchar">Id Suplier <?php echo form_error('id_suplier') ?></label>
                <input type="text" class="form-control" name="id_suplier" id="id_suplier" placeholder="Id Suplier" value="<?php echo $id_suplier; ?>" />
          </div> -->
          <div class="form-group">
                <label for="varchar">Nama Suplier <?php echo form_error('nama_suplier') ?></label>
                <input type="text" class="form-control" name="nama_suplier" id="nama_suplier" placeholder="Nama Suplier" value="<?php echo $nama_suplier; ?>" />
            </div>
          <div class="form-group">
                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
            </div>
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
          <a href="<?php echo site_url('suplier') ?>" class="btn btn-danger">Batal</a>
      </form>
    </div>
  </div>
