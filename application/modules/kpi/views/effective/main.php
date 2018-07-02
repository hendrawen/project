<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Tracking <small>Pelanggan</small></h2>
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
      <form action="#" id="form-tracking">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Tahun <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="tahun-tracking">
              <option value="">--Pilih Tahun --</option>
              <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
                  echo '<option  value="'.$tahun.'">'.$tahun.'</option>';
              } ?>
            </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Kota <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="filter-kota" >
              <option value="" selected>--Semua Kota--</option>
              <?php foreach ($list_kota as $row): ?>
                <option id_kota="<?php echo $row->id_kab ?>" value="<?php echo $row->nama ?>"><?php echo $row->nama ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Kecamatan <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="filter-kecamatan">
              <option value="" selected>--Semua Kecamatan--</option>
            </select>
          </div>
        </div>
      
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 text-right">
          <button type="button" id="btn-filter-tracking" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
          <button type="button" id="excel-tracking" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
          <button type="button" id="btn-reset-tracking" class="btn btn-info"><i class="fa fa-refresh"></i> Reload</button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table id="table-tracking" class="table table-striped jambo_table table-bordered nowrap">
        <thead>
            <tr>
                <th rowspan = 3 class="wider_kecamatan text-center">Tanggal</th>
                <th colspan = 15 class="text-center">ACTIFITY</th>
                <th colspan = 12 class="text-center">Nama Barang</th>
            </tr>
            <tr>
              <th colspan = 3 class="text-center">Due Date</th>
              <th colspan = 3 class="text-center">Biru</th>
              <th colspan = 3 class="text-center">Kuning</th>
              <th colspan = 3 class="text-center">Ijo</th>
              <th colspan = 3 class="text-center">Pink</th>
              <?php foreach ($barang as $key) {?>
                    <th rowspan = 3 class="wider_kecamatan"><?php echo $key->nama_barang ?></th>
              <?php } ?>              
            </tr>
            <tr>
              <?php for ($i = 0 ; $i < 5 ; $i++): ?>
                <th>TO</th>
                <th>STOK</th>
                <th>FOLLOW UP</th>
              <?php endfor ?>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>

  </div>
</div>
