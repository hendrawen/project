<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Selamat Datang !</strong> <?php echo $this->session->identity; ?>.
  </div>

  <div class="x_panel">
                  <div class="x_title">
                    <h2>Menu Pintasan</h2>
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
                    <a href="<?php echo base_url('dep/piutang') ?>" class="btn btn-app">
                      <i class="fa fa-credit-card"></i> Piutang
                    </a>
                    <a href="<?php echo base_url('dep/transaksi') ?>" class="btn btn-app">
                      <i class="fa fa-shopping-cart"></i> Transaksi
                    </a>
                    <a href="<?php echo base_url('dep/list') ?>" class="btn btn-app">
                      <i class="fa fa-file-text-o"></i> List Transaksi
                    </a>
                    <a href="<?php echo base_url('dep/muat/create') ?>" class="btn btn-app">
                      <i class="fa fa-truck"></i> Muat
                    </a>
                    <a href="<?php echo base_url('dep/jadwal') ?>" class="btn btn-app">
                      <span class="badge bg-red"><?php echo $total_jadwal ?></span>
                      <i class="fa fa-calendar-o"></i> Jadwal
                    </a>
                  </div>
                </div>
                <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="count"><?php echo $total_transaksi; ?></div>
                          <h3>Jumlah Transaksi</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="count">
                            <?php foreach ($total_penjualan as $value): ?>
                              Rp. <?php echo number_format($value->total,0,'.','.'); ?>
                            <?php endforeach; ?></div>
                          <h3>Total Penjualan</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="count"><?php echo $transaksi_perbulan; ?></div>
                          <h3>Transaksi Bulanan</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="count">
                          <?php foreach ($penjualan_bulanan as $value): ?>
                            Rp. <?php echo number_format($value->total,0,'.','.'); ?>
                          <?php endforeach; ?>
                          </div>
                          <h3>Penjualan Bulanan</h3>
                        </div>
                      </div>
                    </div>
