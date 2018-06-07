<style>
  .label-biru {
    background-color: #006CFF;
  }

  .label-merah {
    background-color: #FF0030;
  }

  .label-hijau {
    background-color : #66AE42;
  }

  .label-kuning {
    background-color : #FFDD11;
  }

  .label-orange {
    background-color : #DD9600;
  }

  .label-jingga {
    background-color : #E3479B;
  }

  .label-hijau-muda {
    background-color : #B5E59F;
  }

  .label-black {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #0d0d0d;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
  }

</style>

<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Pembayaran <small>Bulanan</small></h2>
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
      <form action="" id="form-tracking">
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
              <th rowspan = 2>No</th>
              <th rowspan = 2>ID Customer</th>
              <th rowspan = 2>Nama Customer</th>
              <th rowspan = 2>Telpon</th>
              <th rowspan = 2>Kota</th>
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
          <tbody>
          </tbody>
      </table>
    </div>

  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2>Keterangan Warna</h2>
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
        <div class="col-md-4 col-md-4 col-sm-6 col-xs-12">
          <table class="table">
            <tr>
                <td><span class="label-black label-hijau">Hijau</span></td>
                <td>:</td>
                <td>Melakukan transaksi bulan ini</td>
            </tr>
            <tr>
                <td><span class="label label-biru">Biru</span></td>
                <td>:</td>
                <td>Tidak transaksi 1 bulan</td>
            </tr>
            <tr>
                <td><span class="label-black label-kuning">Kuning</span></td>
                <td>:</td>
                <td>Tidak transaksi 2 bulan</td>
            </tr>
            <tr>
                <td><span class="label-black label-jingga">Jingga</span></td>
                <td>:</td>
                <td>Tidak transaksi 3 bulan</td>
            </tr>
            <tr>
                <td><span class="label-black label-hijau-muda">Hijau Muda</span></td>
                <td>:</td>
                <td>Tidak transaksi 4 bulan</td>
            </tr>
            <tr>
                <td><span class="label label-warning">Kuning</span></td>
                <td>:</td>
                <td>Tidak transaksi 5 bulan</td>
            </tr>
          </table>
        </div>
    </div>
  </div>
</div>