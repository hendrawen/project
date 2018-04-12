

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
          <label class="control-label col-md-3 col-sm-3" for="int">Nama Pelanggan <?php echo form_error('wp_pelanggan_id') ?></label>
          <div class="col-md-9 col-sm-9">
            <select class="form-control js-example-basic-single" name="wp_pelanggan_id" id="wp_pelanggan_id">
              <option value="" disabled selected>-- Pilih Pelanggan --</option>
              <?php foreach ($pelanggan_list as $key): ?>
                <option value="<?php echo $key->id_pelanggan ?>"><?php echo $key->nama_pelanggan ?></option>
              <?php endforeach; ?>
            </select>
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Turun Krat <?php echo form_error('turun_krat') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="turun_krat" id="turun_krat" placeholder="Turun Krat" value="<?php echo $turun_krat; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Turun Botol <?php echo form_error('turun_btl') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="turun_btl" id="turun_btl" placeholder="Turun Botol" value="<?php echo $turun_btl; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Naik Krat <?php echo form_error('naik_krat') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="naik_krat" id="naik_krat" placeholder="Naik Krat" value="<?php echo $naik_krat; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Naik Botol <?php echo form_error('naik_btl') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="naik_btl" id="naik_btl" placeholder="Naik Botol" value="<?php echo $naik_btl; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Aset Krat <?php echo form_error('aset_krat') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="aset_krat" id="aset_krat" placeholder="Aset Krat" value="<?php echo $aset_krat; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Aset Botol <?php echo form_error('aset_btl') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="aset_btl" id="aset_btl" placeholder="Aset Botol" value="<?php echo $aset_btl; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="int">Bayar <?php echo form_error('bayar') ?></label>
          <div class="col-md-9 col-sm-9">
          <input type="number" class="form-control" name="bayar" id="bayar" placeholder="Bayar" value="<?php echo $bayar; ?>" />
        </div>
      </div>
      <div class="row form-group">
          <label class="control-label col-md-3 col-sm-3" for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
          <div class="col-md-9 col-sm-9">
          <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9 col-sm-9">
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo $button ?></button>
          <a href="<?php echo site_url('aset') ?>" class="btn btn-default"><i class="fa fa-times"></i> Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
