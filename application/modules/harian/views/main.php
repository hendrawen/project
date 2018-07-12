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
            <div class="row no-print">
            <form action="#" id="myformrm" class="form-horizontal form-label-left"></form>
              <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                <input type="text" id="autofakturdebt" class="form-control" placeholder="ID Pelanggan" name="autofakturdebt" required="" autocomplete="off">
              </div>
              <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                <input type="text" id="autofakturdriver" class="form-control" placeholder="Driver" name="autofakturdriver" required="" autocomplete="off">
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                <input type="text" id="autogetdebt" class="form-control" placeholder="Debt" name="autogetdebt" required="" autocomplete="off">
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 form-group text-right">
                <button id="button_track_faktur" class="btn btn-success"><i class="fa fa-plus-square"></i> Tambah</button>
                <button id="button_reset_faktur" class="btn btn-warning"><i class="fa fa-refresh"></i> Ulang</button>
                <a href="javascript:void(0)" id="printButton" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</a>
              </div>
            </div>
    <div id="printable">
    <br>
    <br>
    <div class="table-responsive" >
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
                <th colspan = 2 class="text-center"><span name="nama_debt_atas" id="nama_debt_atas"></span></th>
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

    <div class="row no-print">
        <div class="col-xs-4 text-center">
          <strong><span style="margin-center">Admin & Finance</span></strong><br><br><br><br>
          <strong><span name="nama_pelanggan" id="nama_pelanggan"><?php echo $this->session->identity; ?></span></strong><br>
        </div>
        <div class="col-xs-4 text-center">
          <strong><span style="margin-center">Pick Up</span></strong><br><br><br><br>
          <strong><span name="nama_driver" id="nama_driver"></span></strong><br>
        </div>
        <div class="col-xs-4 text-center">
          <strong><span style="margin-center">Debt & Deliverry</span></strong><br><br><br><br>
          <strong><span name="nama_debt" id="nama_debt"></span></strong><br>
        </div>
    </div>
    </div>

  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2>Belakang</h2>
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
            <div class="row no-print">
            <form action="#" id="myformrmmm" class="form-horizontal form-label-left"></form>
              <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
                <a href="javascript:void(0)" id="printBawah" class="btn btn-danger"><i class="fa fa-print"></i> Cetak</a>
              </div>
            </div>
    <div id="printbawahtabel">
    <br>
    <br>
    <div class="table-responsive" >
      <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur2">
        <thead>
            <tr>
                <th colspan = 10 class="text-center">List Faktur Customer Jatuh Tempo</th>
            </tr>
            <tr> 
                <th rowspan = 2 class="wider_harian text-center">ID Customer</th>
                <th rowspan = 2 class="wider_harian text-center">Nama Customer</th>
                <th rowspan = 2 class="wider_harian text-center">Nama Barang</th>
                <th colspan = 2 class="text-center">Turun</th>
                <th colspan = 2 class="text-center">Naik</th>
                <th colspan = 2 class="text-center">Aset</th>
                <th rowspan = 2 class="wider_harian text-center">Keterangan</th>      
            </tr>
            <tr>
                <th class="text-center">Krat/Dus</th>
                <th class="text-center">Btl/Pcs</th> 
                <th class="text-center">Krat</th>
                <th class="text-center">Btl</th>
                <th class="text-center">Krat</th>
                <th class="text-center">Btl</th> 
            </tr>
            <tr>
            </tr>
          </thead>
          <tbody id="result-faktur2">
          </tbody>
      </table>
    </div>

    <div class="table-responsive" >
      <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur">
        <thead>
            <tr>
                <th colspan = 10 class="text-center">Laporan Muat Barang</th>
            </tr>
            <tr> 
                <th rowspan = 2 class="wider_harian text-center">Nama Barang</th>
                <th colspan = 2 class="text-center">Muat</th>
                <th colspan = 2 class="text-center">Terkirim</th>
                <th colspan = 2 class="text-center">Kembali</th>
                <th class="text-center">Retur</th>
                <th rowspan = 2 class="wider_harian text-center">Keterangan</th>      
            </tr>
            <tr>
                <th class="text-center">Krat/Dus</th>
                <th class="text-center">Btl/Pcs</th>
                <th class="text-center">Krat/Dus</th>
                <th class="text-center">Btl/Pcs</th>
                <th class="text-center">Krat/Dus</th>
                <th class="text-center">Btl/Pcs</th>
                <th class="text-center">Krat/Dus</th>
            </tr>
            <tr>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($getbarang->result() as $key) {?>
              <tr>
                <td><?php echo $key->nama_barang ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            <?php } ?>
            <tr>
              <td>Jumlah</td>
              <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col-md-6 col-lg-6">
        <div class="table-responsive" >
          <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur">
            <thead>
              <tr>
                <th colspan= 3 class="text-center">Laporan Krat & Botol Kosong</th>
              </tr>
              <tr>
                <th>Krat</th>
                <th>Botol</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="wider_kosong"></th>
                <th class="wider_kosong"></th>
                <th class="wider_kosong"></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="table-responsive" >
          <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur">
            <thead>
              <tr>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Setor Tunai</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="wider_kosong"></th>
                <th class="wider_kosong"></th>
                <th class="wider_kosong"></th>
              </tr>
            </tbody>
              
          </table>
        </div>
      </div>
    </div>
            </div>

  </div>
</div>
</div>

