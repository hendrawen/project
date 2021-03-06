<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Market <small>Share</small></h2>
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
      <form action="" id="form-market">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Tahun <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="tahun-market">
              <option value="" selected>--Pilih Tahun --</option>
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
          <button type="button" id="btn-filter-market" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
          <button type="button" id="excel-market" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
          <button type="button" id="btn-reset-market" class="btn btn-info"><i class="fa fa-refresh"></i> Reload</button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table id="table-market" class="table table-striped jambo_table table-bordered nowrap">
          <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2" class="wider_kecamatan">KOTA</th>
                <th rowspan="2" class="wider_kecamatan">KECAMATAN</th>
                <th rowspan="2" class="wider_kecamatan">KELURAHAN</th>
                <?php foreach ($bulan as $key) {
                    echo '<th colspan=3>'.$key['month'].'</th>';
                }?>
            </tr>
            <tr>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
  </div>
</div>