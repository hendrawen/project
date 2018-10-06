<div class="x_panel">
  <div class="x_title">
    <h2>Sumber Data</h2>
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
            <span class="input-group-addon">Bulan <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="bulan-sumber">
              <option value="semua">--Pilih Bulan --</option>
              <?php $i = 1; foreach ($month as $key): ?>
                <option value="<?php echo $i++;?>"><?php echo $key?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Berdasarkan <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="berdasarkan-sumber" >
            <option value="semua">Semua Karyawan</option>
            <option value="karyawan">Per Karyawan</option>
            </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon">Pilih <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
            <select class="form-control" id="nama-sumber">
            <option value="semua">Semua</option>
            </select>
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 text-right">
          <button type="button" id="btn-filter-sumber" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
          <button type="button" id="btn-reset-sumber" class="btn btn-info"><i class="fa fa-refresh"></i> Reload</button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-striped jambo_table table-bordered nowrap">
        <thead>
            <tr>
                <th rowspan = 3 class="wider_kecamatan text-center">Tanggal</th>
                <th rowspan = 3 class="wider_kecamatan text-center">Absensi</th>
                <th colspan = 6 class="text-center">Sumber Data</th>
                <th colspan = 3 class="text-center">Actual</th>
            </tr>
            <tr>
              <th colspan = 3 class="text-center">Kunjungan</th>
              <th colspan = 3 class="text-center">Quantity</th>
              <th colspan = 3 class="text-center">Jumlah Dalam Percent</th>
            </tr>
            <tr>
              <?php for ($i = 0 ; $i < 3 ; $i++): ?>
                <th>TAR</th>
                <th>ACT</th>
                <th>PRC</th>
              <?php endfor ?>
            </tr>
          </thead>
          <tbody id="tbody-sumber-val">
          </tbody>
      </table>
    </div>

  </div>
</div>
