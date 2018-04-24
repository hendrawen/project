<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Selamat Datang !</strong> <?php echo $this->session->identity; ?>.
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
