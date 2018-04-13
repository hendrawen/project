<div class="x_panel">
  <div class="x_title">
    <h2>Dev Muat <small>Data Muat</small></h2>
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
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Wp Barang Id <?php echo form_error('wp_barang_id') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control js-example-basic-single" name="wp_barang_id" id="wp_barang_id">
              <option value="" disabled selected>-- Pilih Barang --</option>
              <?php foreach ($barang_list as $key): ?>
                <option <?php echo ($key->id == $wp_barang_id)?'selected':'' ?> value="<?php echo $key->id ?>"><?php echo $key->id_barang.' - '. $key->nama_barang ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Wp Gudang Id <?php echo form_error('wp_gudang_id') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control js-example-basic-single" name="wp_gudang_id" id="wp_gudang_id">
              <option value="" disabled selected>-- Pilih Barang --</option>
              <?php foreach ($gudang_list as $key): ?>
                <option <?php echo ($key->id == $wp_gudang_id)?'selected':'' ?> value="<?php echo $key->id ?>"><?php echo $key->nama_gudang ?></option>
              <?php endforeach; ?>
            </select>
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Muat Krat <?php echo form_error('muat_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="muat_krat" id="muat_krat" placeholder="Muat Krat" value="<?php echo $muat_krat; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Muat Dust <?php echo form_error('muat_dust') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="muat_dust" id="muat_dust" placeholder="Muat Dust" value="<?php echo $muat_dust; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Terkirim Krat <?php echo form_error('terkirim_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="terkirim_krat" id="terkirim_krat" placeholder="Terkirim Krat" value="<?php echo $terkirim_krat; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Terkirim Botol <?php echo form_error('terkirim_btl') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="terkirim_btl" id="terkirim_btl" placeholder="Terkirim Botol" value="<?php echo $terkirim_btl; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Kembali Krat <?php echo form_error('kembali_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="kembali_krat" id="kembali_krat" placeholder="Kembali Krat" value="<?php echo $kembali_krat; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Kembali Botol <?php echo form_error('kembali_btl') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="kembali_btl" id="kembali_btl" placeholder="Kembali Botol" value="<?php echo $kembali_btl; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="int">Retur Krat <?php echo form_error('retur_krat') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control" name="retur_krat" id="retur_krat" placeholder="Retur Krat" value="<?php echo $retur_krat; ?>" />
          </div>
      </div>
      <div class="row form-group">
          <label class="col-md-3 col-sm-3 col-xs-12 control-label" for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
          </div>
      </div>

      <div class="row form-group">
        <div class="col-md-3 col-sm-3 col-xs-12">
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('delivery/muat') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
        </div>
    </form>

  </div>
</div>
