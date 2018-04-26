<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Transaksi <small>Pelanggan</small></h2>
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
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Bulan dari</span>
          <select class="form-control" id="bulan-pelanggan-from">
            <?php $i = 1; foreach ($month as $key): ?>
              <option value="<?php echo $i++;?>"><?php echo $key?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Bulan ke</span>
          <select class="form-control" id="bulan-pelanggan-to">
            <?php $i = 1;  foreach ($month as $key): ?>
              <option <?php echo ($to == $key)?'selected':'' ?> value="<?php echo $i++;?>"><?php echo $key ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Tahun <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <select class="form-control" id="tahun-pelanggan">
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
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <button type="button" id="btn-lap-pelanggan" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
        <button type="button" id="excel_pelanggan" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="transaksilist datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
      <!-- <table class="table"> -->

          <thead>
            <tr>
              <th rowspan = 2>No</th>
              <th rowspan = 2>ID Customer</th>
              <th rowspan = 2>Nama Customer</th>
              <th rowspan = 2>Telpon</th>
              <th rowspan = 2>Kelurahan</th>
              <th rowspan = 2>Kecamatan</th>
              <th rowspan = 2>Surveyor</th>
              <th rowspan = 2>Piutang</th>
              <th colspan = 2>Januari</th>
              <th colspan = 2>Februari</th>
              <th colspan = 2>Maret</th>
              <th colspan = 2>April</th>
              <th colspan = 2>Mei</th>
              <th colspan = 2>Juni</th>
              <th colspan = 2>Juli</th>
              <th colspan = 2>Agustus</th>
              <th colspan = 2>September</th>
              <th colspan = 2>Oktober</th>
              <th colspan = 2>November</th>
              <th colspan = 2>Desember</th>
            </tr>
            <tr>
              <?php for ($i = 0 ; $i < 12 ; $i++): ?>
                <th>TRX</th>
                <th>QTY</th>
              <?php endfor ?>

            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
      </table>
    </div>
  </div>
</div>


<!--
<?php $no = 1; foreach ($record as $row): ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $row->id_pelanggan ?></td>
    <td><?php echo $row->nama_pelanggan ?></td>
    <td><?php echo $row->no_telp ?></td>
    <td><?php echo $row->kelurahan ?></td>
    <td><?php echo $row->kecamatan ?></td>
    <td><?php echo $row->nama ?></td>
    <?php
      $utang = $this->mLap->laporan_pelanggan_utang($row->id_pelanggan, 1, 4, 2018);
    ?>
    <td><?php echo ($utang)?$utang->piutang:'-' ?></td>
    <?php for ($month = 1 ; $month <= 12 ; $month++):
        $jumlah_trx = $this->mLap->laporan_pelanggan_trx($row->id_pelanggan, $month, 2018);
        $jumlah_qty = $this->mLap->laporan_pelanggan_qty($row->id_pelanggan, $month, 2018);
      ?>
       <td><?php echo ($jumlah_trx)?$jumlah_trx:'-' ?></td>
       <td><?php echo ($jumlah_qty)?$jumlah_qty:'-' ?></td>
    <?php endfor ?>
  </tr>
<?php endforeach; ?>
-->
