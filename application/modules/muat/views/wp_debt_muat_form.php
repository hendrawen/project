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
          <label for="tanggal">Tanggal</label>
            <?php echo form_error('tanggal') ?>
            <input type="date" name="tanggal" value="<?php echo $tanggal ?>" id="tanggal" placeholder="input muat" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('gudang') ?>
          <label for="gudang">Gudang</label>
            <select class="form-control" name="gudang" id="gudang">
                  <option value="">Pilih Gudang</option>
                  <?php
                      foreach($gudang_list as $value){
                      $selected= '';
                      if($wp_gudang_id == $value->id){
                        $selected = 'selected="selected"';
                      }
                      ?>
                      <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                      <?php echo $value->nama_gudang; ?>
                      </option>
                      <?php }
                  ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <label for="barang">Barang</label>
            <select class="form-control" name="barang" id="barang">
                  <option value="">Pilih Barang</option>
                  <?php
                      foreach($barang_list as $value){
                      $selected= '';
                      if($wp_barang_id == $value->id){
                        $selected = 'selected="selected"';
                      }
                      ?>
                      <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                      <?php echo $value->nama_barang; ?>
                      </option>
                      <?php }
                  ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <label for="debt">Debt</label>
            <select name="debt" id="debt" class="form-control">
                  <option value="">Pilih Debt</option>
                  <?php
                      foreach($karyawan->result() as $value){
                      $selected= '';
                      if($id_karyawan == $value->id_karyawan){
                        $selected = 'selected="selected"';
                      }
                      ?>
                      <option  value="<?php echo $value->id_karyawan; ?>"  <?php echo $selected;?> >
                      <?php echo $value->nama; ?>
                      </option>
                      <?php }
                  ?>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('muat') ?>
          <label for="muat">Muat</label>
            <input type="text" name="muat" id="muat" placeholder="input muat" value="<?php echo $muat; ?>" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan') ?>
          <label for="">Satuan Muat</label>
            <select name="satuan" id="satuan" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat" <?php if ($satuan=='Krat') {echo "selected";}?>>Krat</option>
              <option value="Botol" <?php if ($satuan=='Botol') {echo "selected";}?>>Botol</option>
              <option value="Dus" <?php if ($satuan=='Dus') {echo "selected";}?>>Dus</option>
              <option value="Pcs" <?php if ($satuan=='Pcs') {echo "selected";}?>>Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('terkirim') ?>
          <label for="terkirim">Terkirim</label>
            <input type="text" name="terkirim" id="terkirim" value="<?php echo $terkirim; ?>" placeholder="input terkirim" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan_kirim') ?>
          <label for="satuan_terkirim">Satuan Terkirim</label>
            <select name="satuan_kirim" id="satuan_kirim" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat" <?php if ($satuan_kirim=='Krat') {echo "selected";}?>>Krat</option>
              <option value="Botol" <?php if ($satuan_kirim=='Botol') {echo "selected";}?>>Botol</option>
              <option value="Dus" <?php if ($satuan_kirim=='Dus') {echo "selected";}?>>Dus</option>
              <option value="Pcs" <?php if ($satuan_kirim=='Pcs') {echo "selected";}?>>Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <label for="return">Retur</label>
          <?php echo form_error('return') ?>
            <input type="text" name="return" id="return" value="<?php echo $return; ?>" placeholder="input retur" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('satuan-return') ?>
          <label for="satuan_return">Satuan Return</label>
            <select name="satuan_return" id="satuan_return" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat" <?php if ($satuan_return=='Krat') {echo "selected";}?>>Krat</option>
              <option value="Botol" <?php if ($satuan_return=='Botol') {echo "selected";}?>>Botol</option>
              <option value="Dus" <?php if ($satuan_return=='Dus') {echo "selected";}?>>Dus</option>
              <option value="Pcs" <?php if ($satuan_return=='Pcs') {echo "selected";}?>>Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('rusak') ?>
          <label for="rusak">Rusak</label>
            <input type="text" placeholder="input rusak" name="rusak" value="<?php echo $rusak; ?>" id="rusak" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <label for="satuan_rusak">Satuan Rusak</label>
          <?php echo form_error('satuan_rusak') ?>
            <select name="satuan_rusak" id="satuan_rusak" class="form-control">
              <option value="">--Satuan--</option>
              <option value="Krat" <?php if ($satuan_rusak=='Krat') {echo "selected";}?>>Krat</option>
              <option value="Botol" <?php if ($satuan_rusak=='Botol') {echo "selected";}?>>Botol</option>
              <option value="Dus" <?php if ($satuan_rusak=='Dus') {echo "selected";}?>>Dus</option>
              <option value="Pcs" <?php if ($satuan_rusak=='Pcs') {echo "selected";}?>>Pcs</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('aset_krat') ?>
          <label for="aset_krat">Aset Krat</label>
            <input type="text" name="aset_krat" id="aset_krat" value="<?php echo $aset_krat; ?>" placeholder="input aset krat" class="form-control">
          </div>
          <div class="col-md-3 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('aset_botol') ?>
          <label for="aset_botol">Aset Botol</label>
            <input type="text" name="aset_botol" id="aset_botol" value="<?php echo $aset_botol; ?>" placeholder="input aset botol" class="form-control">
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 form-group">
          <?php echo form_error('keterangan') ?>
          <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" value="<?php echo $keterangan; ?>" placeholder="Keterangan" class="form-control">
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

