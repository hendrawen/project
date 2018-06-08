<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Riwayat Transaksi <small>Activity report</small></h2>
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
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img src="<?php echo base_url();?>assets/uploads/<?php echo $photo; ?>" width="100" height="100" class="img-responsive avatar-view">
                        </div>
                      </div>
                      <h3><?php echo $nama_pelanggan; ?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $alamat; ?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $nama_dagang; ?>
                        </li>
                      </ul>

                      <a href="<?php echo base_url('marketing'); ?>" class="btn btn-success"> Kembali</a>
                      <br>

                      <!-- start skills -->
                      <h4>Total</h4>
                      <ul class="list-unstyled user_data">
                        <?php foreach ($total_transaksi as $value): ?>
                        <li>
                          <p>Total Pembelian</p>
                        <h4> <b> Rp. <?php echo number_format($value->total,0,'.','.') ?></b></h4>
                        </li>
                        <li>
                          <p>Jumlah Transaksi</p>
                          <h4><b><?php echo $value->jmlh_transaksi ?></b></h4>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-12">
                          <h2>User Activity Report</h2>
                        </div>
                      </div>
                      <div class="table table-responsive">
                              <!-- start user projects -->
                        <table class="table table-striped no-margin">
                          <thead>
                            <tr>
                              <th>ID Transaksi</th>
                              <th>Barang</th>
                              <th>Qty</th>
                              <th>Subtotal (Rp.)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            foreach($riwayat_transaksi as $value){ ?>
                            <tr>
                              <td><?php echo $value->id_transaksi ?></td>
                              <td><?php echo $value->nama_barang ?></td>
                              <td><?php echo $value->qty ?></td>
                              <td><?php echo number_format($value->subtotal,0,'.','.') ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <!-- end user projects -->
                      </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
