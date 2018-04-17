
    <div class="x_panel">
      <div class="x_title">
        <h2> <?php echo $button ?> Profile</h2>
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
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
            <div class="row form-group">
                  <label for="int" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan <?php echo form_error('nama_perusahaan') ?></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan" value="<?php echo $nama_perusahaan; ?>" />
                  </div>
              </div>
            <div class="row form-group">
                  <label for="alamat" class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <?php echo form_error('alamat') ?></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                  </div>
              </div>
            <div class="row form-group">
                  <label for="varchar" class="control-label col-md-3 col-sm-3 col-xs-12">No Telp <?php echo form_error('no_telp') ?></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                  </div>
              </div>
            <div class="row form-group">
                  <label for="varchar" class="control-label col-md-3 col-sm-3 col-xs-12">Email <?php echo form_error('email') ?></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                  </div>
              </div>
            <div class="row form-group">
                  <label for="varchar" class="control-label col-md-3 col-sm-3 col-xs-12">Website <?php echo form_error('website') ?></label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="website" id="website" placeholder="Website" value="<?php echo $website; ?>" />
                  </div>
              </div>
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12"></div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
            <a href="<?php echo site_url('profile') ?>" class="btn btn-danger">Batal</a>
          </div>
        </div>
        </form>
      </div>
    </div>
