
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
    <div id="printbawah">
    <br>
    <br>
    <div class="table-responsive" >
      <table class="table table-striped jambo_table table-bordered nowrap" id="table_faktur">
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

