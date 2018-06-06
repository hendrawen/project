<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Transaksi Per area - Harian</h2>
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
    <div class="row">
      <div class="col-lg-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Tanggal <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <input type="date" class="form-control" id="tgl" placeholder="" value="<?php echo date('m/d/Y')?>">
          </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Berdasarkan </span>
          <select class="form-control" id="berdasarkan-area">
            <option value="">--Semua--</option>
            <option value="kota">Kota</option>
            <option value="kelurahan">Kelurahan</option>
            <option value="kecamatan">Kecamatan</option>
          </select>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Pilih <img id="loading-combo" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <select class="form-control" id="pilih-area">
            <option value="">--Pilih--</option>
          </select>
        </div>
      </div>
      <div class="col-lg-12 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-success" id="btn-area-hari"><i class="fa fa-search"></i> Search</button>
        <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none">
        <button type="button" id="excel_area" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
        <button type="button" id="btn-refresh" class="btn btn-info"><i class="fa fa-refresh fa-spin"></i> Reload</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>No Faktur</th>
              <th>Tgl Kirim</th>
              <th>Jatuh Tempo</th>
              <th>ID Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th>Nama Barang</th>
              <th>QTY</th>
              <th>Satuan</th>
              <th>Kota</th>
              <th>Kecamatan</th>
              <th>Kelurahan</th>
              <th>No Telpon</th>
              <th>Surveyor</th>
              <th>Debt</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
      </table>
    </div>
  </div>
</div>
