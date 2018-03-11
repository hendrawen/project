                <a href="<?php echo base_url('pelanggan/tambah'); ?>" type="button" class="btn btn-success" ><i class="fa fa-user"></i> Tambah</a>
                <a href="<?php echo base_url('pelanggan/test'); ?>" type="button" class="btn btn-info" ><i class="fa fa-map-marker"></i> Map</a>
                <a href="<?php echo base_url('kebutuhan') ?>" type="button" class="btn btn-warning" ><i class="fa fa-bar-chart"></i> Kebutuhan Pelanggan</a>
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-group"></i> Data Pelanggan</h2>
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
                    <p class="text-muted font-13 m-b-30">
                      <div class="row">
                        <form id="form-filter" class="form-horizontal">
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_kota; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_kelurahan; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_kecamatan; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_status; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_surveyor; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <div class="text-right">
                            <button type="button" id="btn-filter" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-warning"><i class="fa fa-refresh"></i> All</button>
                          </div>

                        </div>
                      </form>
                      </div>
                    </p>

                    <table id="table" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>ID Pelanggan</th>
                              <th>Nama</th>
                              <th>Telp</th>
                              <th>Nama Dagang</th>
                              <th>Alamat</th>
                              <th>Kota</th>
                              <th>Kelurahan</th>
                              <th>Kecamatan</th>
                              <th>Lat</th>
                              <th>Long</th>
                              <th>status</th>
                              <th>Photo</th>
                              <th>Surveyor</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID Pelanggan</th>
                          <th>Nama</th>
                          <th>Telp</th>
                          <th>Nama Dagang</th>
                          <th>Alamat</th>
                          <th>Kota</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Lat</th>
                          <th>Long</th>
                          <th>status</th>
                          <th>Photo</th>
                          <th>Surveyor</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                  </table>
                  </div>
                </div>
