<div class="x_panel">
  <div class="x_title">
    <h2>Depan</h2>
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
            <form action="#" class="form-horizontal form-label-left"></form>
              <div class="col-md-8 col-sm-12 col-xs-12 form-group">
                <input type="text" id="autofakturdebt" class="form-control" placeholder="Masukkan ID Pelanggan" name="autofakturdebt" required="">
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 form-group text-right">
                <button id="button_track_faktur" class="btn btn-success"><i class="fa fa-plus-square"></i> Tambah</button>
                <button id="button_reset_faktur" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulang</button>
                <button id="button_cetak_faktur" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</button>
              </div>
            </div>

    <div class="table-responsive">
      <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur">
        <thead>
            <tr>
                <th colspan = 4 class="text-center">List Faktur Customer Jatuh Tempo</th>
                <th colspan = 2 class="text-center">
                <?php
                        $tgl=date('Y-m-d');
                        echo tgl_indo($tgl);
                ?>
                </th>
                <th colspan = 2 class="text-center"><?php
                $tgl=date('Y-m-d');
                $day = date('D', strtotime($tgl));
                $dayList = array(
                    'Sun' => 'Minggu',
                    'Mon' => 'Senin',
                    'Tue' => 'Selasa',
                    'Wed' => 'Rabu',
                    'Thu' => 'Kamis',
                    'Fri' => 'Jumat',
                    'Sat' => 'Sabtu'
                );
                echo $dayList[$day]; ?></th>
                <th colspan = 2 class="text-center"></th>
            </tr>
            <tr>
              <th class="text-center">No Faktur</th>
              <th class="text-center">ID Pelanggan</th>
              <th class="text-center">Nama Customer</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Satuan</th>             
              <th class="text-center">Surveyor</th>             
              <th class="text-center">Jumlah</th>             
              <th class="text-center">Bayar</th>             
              <th class="text-center">Keterangan</th>             
            </tr>
          </thead>
          <tbody id="result-faktur">
          </tbody>
      </table>
    </div>

  </div>
</div>
