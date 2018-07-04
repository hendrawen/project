
<div class="x_panel">
  <div class="x_title">
    <h2><?php echo ($button == "Create")?"Form Tambah Aset":"Form Update Aset" ?></h2>
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
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Nama Pelanggan <?php echo form_error('wp_pelanggan_id') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="wp_pelanggan_id" id="wp_pelanggan_id">
              <option value="" disabled selected>-- Pilih Pelanggan --</option>
              <?php foreach ($pelanggan_list as $key): ?>
                <option <?php echo ($key->id == $wp_pelanggan_id)?'selected':'' ?> value="<?php echo $key->id ?>"><?php echo $key->id_pelanggan.' - '. $key->nama_pelanggan ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Nama Barang <?php echo form_error('wp_barang_id') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="wp_barang_id" id="wp_barang_id">
            <option disabled selected>--Pilih Barang--</option>
            <?php
                  $users = $this->db->query("SELECT * FROM wp_barang");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($wp_barang_id == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>" <?php echo $selected;?>>
                  <?php echo $value->id; ?> - <?php echo $value->nama_barang; ?>
                  </option>
                <?php } ?>
            </select>
          </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Turun Krat <?php echo form_error('turun_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="number" class="form-control" name="turun_krat" id="turun_krat" placeholder="Turun Krat" value="<?php echo $turun_krat; ?>" />
        </div>
      </div>
      
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Bayar Krat <?php echo form_error('bayar_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="number" min="0" class="form-control" name="bayar_krat" id="bayar_krat" placeholder="Naik Krat" value="<?php echo $bayar_krat; ?>" />
        </div>
      </div>
      
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Bayar Uang <?php echo form_error('bayar_uang') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="number" min="0" class="form-control" name="bayar_uang" id="bayar_uang" placeholder="Bayar Uang" value="<?php echo $bayar_uang; ?>" />
        </div>
      </div>

       <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Piutang <?php echo form_error('piutang') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" min="0" class="form-control" name="piutang" placeholder="Piutang" value="<?php echo $piutang; ?>" />
          </div>
      </div>

      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('aset') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
