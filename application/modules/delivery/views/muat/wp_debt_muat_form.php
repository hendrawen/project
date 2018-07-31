<div class="x_panel" >
  <div class="x_title">
    <h2>Muat Barang<small>Data Bongkar Muat</small></h2>
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
      <div class="row">
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo form_error('tanggal') ?>
            <input type="date" name="tanggal" id="tanggal" placeholder="input muat" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('gudang') ?>
            <select class="form-control" name="gudang" id="gudang">
                  <option value="">Pilih Gudang</option>
              <?php
                foreach ($gudang_list as $key) {?>
                  <option value="<?php echo $key->id ?>"><?php echo $key->nama_gudang ?></option>
                <?php }
              ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <select class="form-control" name="barang" id="barang">
                  <option value="">Pilih Barang</option>
              <?php
                foreach ($barang_list as $key) {?>
                  <option value="<?php echo $key->id ?>"><?php echo $key->nama_barang ?></option>
                <?php }
              ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <select name="debt" id="debt" class="form-control">
                  <option value="">Pilih Debt</option>
              <?php
                foreach ($karyawan->result() as $key) {?>
                  <option value="<?php echo $key->id_karyawan ?>"><?php echo $key->nama ?></option>
                <?php }
              ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('muat') ?>
            <input type="text" name="muat" id="muat" placeholder="input muat" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan') ?>
            <select name="satuan" id="satuan" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat">Krat</option>
              <option value="Botol">Botol</option>
              <option value="Dus">Dus</option>
              <option value="Pcs">Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('terkirim') ?>
            <input type="text" name="terkirim" id="terkirim" placeholder="input terkirim" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan_kirim') ?>
            <select name="satuan_kirim" id="satuan_kirim" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat">Krat</option>
              <option value="Botol">Botol</option>
              <option value="Dus">Dus</option>
              <option value="Pcs">Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('return') ?>
            <input type="text" name="return" id="return" placeholder="input retur" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan-return') ?>
            <select name="satuan_return" id="satuan_return" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat">Krat</option>
              <option value="Botol">Botol</option>
              <option value="Dus">Dus</option>
              <option value="Pcs">Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('rusak') ?>
            <input type="text" placeholder="input rusak" name="rusak" id="rusak" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan_rusak') ?>
            <select name="satuan_rusak" id="satuan_rusak" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat">Krat</option>
              <option value="Botol">Botol</option>
              <option value="Dus">Dus</option>
              <option value="Pcs">Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('aset_krat') ?>
            <input type="text" name="aset_krat" id="aset_krat" placeholder="input aset krat" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('aset_botol') ?>
            <input type="text" name="aset_botol" id="aset_botol" placeholder="input aset botol" class="form-control">
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('keterangan') ?>
            <input type="text" name="keterangan" id="keterangan" placeholder="Keterangan" class="form-control">
          </div>
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
            <a href="<?php echo base_url('delivery/muat') ?>" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
      </div>
    </form>

  </div>
</div>

