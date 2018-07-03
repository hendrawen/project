<div class="x_panel">
  <div class="x_title">
    <h2>KPI Debt & Delivery <small>Laporan</small></h2>
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
      <form action="" id="form-kpi-debt">
        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
          <div class="input-group">
            <span class="input-group-addon">Bulan <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="filter-bulan" >
              <option value="" selected>--Pilih Bulan--</option>
              <?php foreach ($list_bulan as $row): ?>
                <option <?=($row['key'] == date('n'))?'selected':'';?> value="<?=$row['key'] ?>"><?=$row['month'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
          <div class="input-group">
            <span class="input-group-addon">Tahun <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="filter-tahun">
              <option value="" selected>--Pilih Tahun --</option>
              <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) :?>
                  <option <?=($tahun == date('Y'))?'selected':'' ?> value="<?=$tahun?>"><?=$tahun?></option>
              <?php endfor?>
            </select>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
          <div class="input-group">
            <span class="input-group-addon">Karyawan <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="filter-karyawan">
              <option value="" selected>--Semua Karyawan --</option>
              <?php foreach ($list_karyawan as $k):?>
              <option value="<?=$k->id_karyawan?>"><?=$k->nama?></option>
              <?php endforeach?>
            </select>
          </div>
        </div>
      
        <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
          <button type="button" id="btn-filter-kpi-debt" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Filter</button>
          <!-- <button type="button" id="excel-kpi-debt" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Excel</button> -->
          <button type="button" id="btn-reset-kpi-debt" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i> Reload</button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table id="table-kpi-debt" class="table table-striped jambo_table table-bordered nowrap">
          <thead>
            <tr>
              <th rowspan=2>Tanggal</th>
              <th colspan=3 class="text-center">Customer</th>
              <th colspan=5 class="text-center">Barang</th>
              <th colspan=3 class="text-center">Quantity</th>
              <th colspan=3 class="text-center">Penarikan Aset</th>
              <th colspan=2 class="text-center">Actual Value</th>
              <th colspan=2 class="text-center">Keterangan</th>
            </tr>
            <tr>
                <th>Jadwal</th><th>Actual</th><th>Percent</th>
                <th>Muat</th><th>Terkirim</th><th>Kembali</th><th>Return</th><th>Rusak</th>
                <th>Target</th><th>Actual</th><th>Percent</th>
                <th>Krat</th><th>Botol</th><th>Value</th>
                <th>Pendapatan</th><th>Pengeluaran</th>
                <th>Return</th><th>Rusak</th>
            </tr>
          </thead>
          <tbody id="tbody-kpi-debt">
          </tbody>
      </table>
    </div>
  </div>
</div>