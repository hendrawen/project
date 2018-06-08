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
          <li><a href="#">Settings 2 <?php echo $from.$to ?></a>
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
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Tahun <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <select class="form-control" id="tahun">
            <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
              if ($tahun == $year) {
                echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
              } else {
                echo '<option  value="'.$tahun.'">'.$tahun.'</option>';
              }
            } ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <button type="button" id="btn-lap-pel" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
        <button type="button" id="exc-pel" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="transaksilist datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
      <!-- <table class="table"> -->

          <thead>
            <tr>
              <th rowspan = 2>No</th>
              <!-- <th rowspan = 2>ID Customer</th>
              <th rowspan = 2>Nama Customer</th> -->
              <th rowspan = 2>Kota</th>
              <th rowspan = 2>Kelurahan</th>
              <th rowspan = 2>Kecamatan</th>
              <!-- <th rowspan = 2>Surveyor</th>
              <th rowspan = 2>Piutang</th> -->
              <th colspan = 4>Costumers</th>
              <th colspan = 3>Responden</th>
              <th colspan = 3>Quantity</th>
              
            </tr>
            <tr>
              <th>Target</th>
              <th>Aktual</th>
              <th>Aktif</th>
              <th>Persen</th>
            
              <th>Target</th>
              <th>Aktual</th>
              <th>Persen</th>
            
              <th>Target</th>
              <th>Aktual</th>
              <th>Persen</th>
            </tr>
          </thead>
          <tbody id="tbody-tracking">

          </tbody>
      </table>
    </div>
  </div>
</div>

