<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Transaksi Dept <small>Harian</small></h2>
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
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Tanggal <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <input type="date" class="form-control" id="tgl" placeholder="" value="<?php echo date('m/d/Y')?>">
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Berdasarkan </span>
          <select class="form-control" id="berdasarkan-dept">
            <option value="semua">Semua Dept</option>
            <option value="dept">Per Dept</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Nama Dept <img id="loading-combo" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
          <select class="form-control" id="nama-dept">
            <option value="semua">Semua</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <button type="button" id="btn-dept" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
        <button type="button" id="excelharian" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
                <th>No</th>
                <th>No Faktur</th>
                <th>Tgl Kirim</th>
                <th>Jatuh Tempo</th>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>QTY</th>
                <th>Satuan</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>No Telpon</th>
                <th>Surveyor</th>
                <th>Debt</th>
                <th>Jumlah</th>
            </tr>
          </thead>
          <tbody id="tbody">
            <?php
                $no = 1;
                $total = 0;
                foreach ($harian as $key) {
            ?>
            <tr>
              <td><?php echo $no++;?></td>
              <td><?php echo $key->id_transaksi; ?></td>
              <td><?php echo $key->tgl_transaksi; ?></td>
              <td><?php echo $key->jatuh_tempo; ?></td>
              <td><?php echo $key->id_pelanggan; ?></td>
              <td><?php echo $key->nama_pelanggan; ?></td>
              <td><?php echo $key->nama_barang; ?></td>
              <td><?php echo $key->qty; ?></td>
              <td><?php echo $key->satuan; ?></td>
              <td><?php echo $key->kota; ?></td>
              <td><?php echo $key->kecamatan; ?></td>
              <td><?php echo $key->kelurahan; ?></td>
              <td><?php echo $key->no_telp; ?></td>
              <td><?php echo $key->nama_karyawan; ?></td>
              <td><?php echo $key->nama_debt; ?></td>
              <td><?php echo number_format($key->subtotal); ?></td>
            </tr>
              <?php $total += $key->subtotal; } ?>
            <tr>
            <td colspan=15 class=text-center>Total</td>
            <td><?php echo number_format($total) ?></td>
            </tr>
          </tbody>
      </table>
    </div>
  </div>
</div>
