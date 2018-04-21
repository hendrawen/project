<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Transaksi <small>Per Produk</small></h2>
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
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Tahun </span>
          <select class="form-control" id="tahun-area">
            <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
              echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Berdasarkan </span>
          <select class="form-control" id="berdasarkan-area">
            <option value="kota">Kota</option>
            <option value="kelurahan">Kelurahan</option>
            <option value="kecamatan">Kecamatan</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Pilih <img id="loading-combo" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <select class="form-control" id="pilih-area">
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-primary" id="btn-area"><i class="fa fa-search"></i> Search</button>
        <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none">
      </div>
    </div>
    <div class="table-responsive" id="tabel">

    </div>
  </div>
</div>
