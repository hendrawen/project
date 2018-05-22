<?php if ($this->session->flashdata('message')): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="alert alert-success alert-dismissible fade in" role="alert" id="message"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
  </div>
</div>
<?php endif; ?>
                  <div class="alert alert-success alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <strong>Selamat Datang !</strong> <?php echo $this->session->identity; ?>.
                    </div>
                    <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i>
                          </div>
                          <div class="count"><?php echo $total_pelanggan; ?></div>

                          <h3>Total Pelanggan</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-comments-o"></i>
                          </div>
                          <div class="count"><?php echo $total_responden ?></div>

                          <h3>Total Responden</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                          </div>
                          <div class="count"><?php echo $pelanggan_perbulan ?></div>

                          <h3>Pelanggan Baru</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i>
                          </div>
                          <div class="count"><?php echo $responden_perbulan ?></div>

                          <h3>Responden Baru</h3>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="title">
                        <form action="<?php echo site_url('marketing/index'); ?>" class="form-inline" method="get">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                          <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Cari...">
                            <span class="input-group-btn">
                              <?php
                                  if ($q <> '') {
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
                                <h5><?php echo $value->id_pelanggan ?> <?php echo $value->nama_pelanggan ?></h5>
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
                            <div class="col-xs-12 bottom text-right">
                              <div class="col-xs-12 col-sm-12 emphasis text-right">
                                <a href="<?=base_url()?>marketing/kebutuhan/<?php echo $value->id ?>" type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-download"> </i> Kebutuhan
                                </a>
                                <a href="<?=base_url()?>marketing/detail/<?php echo $value->id ?>" type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-user"> </i> profile
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
