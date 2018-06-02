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
    <div class="table-responsive">
      <table id="table-market" class="table table-striped jambo_table table-bordered nowrap">
          <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2" class="wider_kecamatan">KOTA</th>
                <th rowspan="2" class="wider_kecamatan">KECAMATAN</th>
                <th rowspan="2" class="wider_kecamatan">KELURAHAN</th>
                <?php foreach ($bulan as $key) {
                    echo '<th colspan=3>'.$key['month'].'</th>';
                }?>
            </tr>
            <tr>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
                <th>CST</th><th>AKT</th><th>QTY</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
  </div>
</div>