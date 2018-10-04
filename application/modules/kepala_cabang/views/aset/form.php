
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Gudang <?php echo form_error('gudang') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="gudang" id="gudang">
            <option disabled selected>--Pilih Gudang--</option>
            <?php
                  $users = $this->db->query("SELECT * FROM wp_gudang");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($gudang == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>" <?php echo $selected;?>>
                  <?php echo $value->id; ?> - <?php echo $value->nama_gudang; ?>
                  </option>
                <?php } ?>
            </select>
          </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Aset Krat</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="number" class="form-control" name="aset_krat" id="turun_krat" placeholder="aset krat" value="<?php echo $aset_krat; ?>" />
        </div>
      </div>

      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Aset Botol</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="number" min="0" class="form-control" name="aset_btl" id="aset_btl" placeholder="aset botol" value="<?php echo $aset_btl; ?>" />
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
          <a href="<?php echo site_url('kepala_cabang/aset') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
