

<a href="<?php echo base_url('validator/kebutuhan/tambah')?>" type="button" class="btn btn-success" ><i class="fa fa-user"></i> Tambah Kebutuhan</a>
<a href="<?php echo base_url('validator/jenis_kebutuhan')?>" type="button" class="btn btn-success" ><i class="fa fa-user"></i> Jenis Kebutuhan</a>
<a href="<?php echo base_url('validator/kebutuhan/presentasi')?>" type="button" class="btn btn-info" ><i class="fa fa-bar-chart"></i>Persentasi Kebutuhan</a>
<a href="<?php echo base_url('validator/pelanggan')?>" type="button" class="btn btn-danger text-right">Kembali</a>
<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-bar-chart"></i> Progres Kebutuhan Pelanggan</h2>
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
    <?php
    if ($kebutuhan){
    foreach ($kebutuhan as $value) {
    echo '<div class="widget_summary">
      <div class="w_left w_20">
        <span>'.$value->jenis.'</span>
      </div>
      <div class="w_center w_55">
        <div class="progress">
          <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="1000" style="width: '.$value->total.'%;">
            <span class="sr-only">60% Complete</span>
          </div>
        </div>
      </div>
      <div class="w_right w_20">
        <span>'.$value->total.'</span>
      </div>
      <div class="clearfix"></div>
    </div>';
    }}
    ?>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-group"></i> Data Kebutuhan Pelanggan</h2>
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
    <table id="kebutuhanku" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>ID Pelanggan</th>
              <th>Nama</th>
              <th>Telp</th>
              <th>Jenis Kebutuhan</th>
              <th>Jumlah</th>
              <th>Tanggal</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>ID Pelanggan</th>
          <th>Nama</th>
          <th>Telp</th>
          <th>Jenis</th>
          <th>Jumlah</th>
          <th>Tanggal</th>
        </tr>
      </tfoot>
  </table>
  </div>
</div>
