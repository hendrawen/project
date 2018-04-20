<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Transaksi <small>Harian</small></h2>
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
      <div class="col-md-4">
        <div class="input-group">
          <span class="input-group-addon">Tanggal <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <input type="date" class="form-control" id="tgl" placeholder="">
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>QTY</th>
                <th>Subtotal</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Tgl Transaksi</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
      </table>
    </div>
  </div>
</div>
