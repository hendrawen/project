                    <a href="<?php echo base_url()?>marketing/tambah"  class="btn btn-app">
                      <i class="fa fa-user"></i> Tambah
                    </a>
                    <a class="btn btn-app">
                      <span class="badge bg-orange"><?php echo $total_pelanggan; ?></span>
                      <i class="fa fa-users"></i> Pelanggan
                    </a>
                    <a class="btn btn-app">
                      <span class="badge bg-orange"><?php echo $total_responden ?></span>
                      <i class="fa fa-users"></i> Responden
                    </a>

                    <div class="row">
                      <div class="title">
                        <form action="<?php echo site_url('marketing/index'); ?>" class="form-inline" method="get">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                          <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Cari...">
                            <span class="input-group-btn">
                              <?php
                                  if ($q <> '')
                                  {
                                      ?>
                                      <a href="<?php echo site_url('marketing'); ?>" class="btn btn-default">Reset</a>
                                      <?php
                                  }
                              ?>
                              <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="clearfix"></div>
                      <?php foreach ($marketing_data as $value): ?>
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                          <div class="well profile_view">
                            <div class="col-sm-12">
                              <h4 class="brief"><?php echo $value->status; ?></h4>
                              <div class="left col-xs-7">
                                <h2><?php echo $value->nama_pelanggan ?></h2>
                                <p><strong>Nama Toko: </strong> <?php echo $value->nama_dagang ?> </p>
                                <ul class="list-unstyled">
                                  <li><i class="fa fa-building"></i> Alamat: <?php echo $value->alamat ?></li>
                                  <li><i class="fa fa-phone"></i> No. telp. #: <?php echo $value->no_telp ?></li>
                                </ul>
                              </div>
                              <div class="right col-xs-5 text-center">
                                <img src="<?php echo base_url()?>assets/uploads/<?php echo $value->photo ?>" alt="" height="80" width="80" class="img-circle">
                              </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                              <div class="col-xs-12 col-sm-12 emphasis text-right">
                                <a href="<?=base_url()?>marketing/update/<?php echo $value->id ?>" type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-edit"> </i> Ubah
                                </a>
                                <a href="<?=base_url()?>marketing/detail/<?php echo $value->id ?>" type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-user"> </i> Lihat Profile
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
