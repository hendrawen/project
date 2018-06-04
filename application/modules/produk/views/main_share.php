<div class="x_panel">
  <div class="x_title">
    <h2>Produk Share <small>Bulanan</small></h2>
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
          <span class="input-group-addon">Dari</span>
          <select class="form-control" id="bulan-pelanggan-from">
            <?php $i = 1; foreach ($month as $key): ?>
              <option value="<?php echo $i++;?>"><?php echo $key?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Ke</span>
          <select class="form-control" id="bulan-pelanggan-to">
            <?php $i = 1;  foreach ($month as $key): ?>
              <option <?php echo ($to == $key)?'selected':'' ?> value="<?php echo $i++;?>"><?php echo $key ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
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
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-right">
        <button type="button" id="btn-lap-pelanggan" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
        <button type="button" id="excel_pelanggan" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
        <button type="button" id="btn-refresh-tracking" class="btn btn-info"><i class="fa fa-refresh fa-spin"></i> Reload</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
      <!-- <table class="table"> -->

          <thead>
            <tr>
              <th>Kota</th>
              <th>Kecamatan</th>
              <th>Kelurahan</th>
              <?php
              $this->db->select('nama_barang');
              $this->db->from('wp_barang');
              $query = $this->db->get()->result();
              foreach($query as $key){ ?>
                <th><?php echo $key->nama_barang ?></th>
              <?php
              }
              ?>
            </tr>
          </thead>
          <tbody id="tbody-produk">

          </tbody>
      </table>
    </div>
  </div>
</div>