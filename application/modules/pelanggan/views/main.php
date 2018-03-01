                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-user"></i> Tambah</button>
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
                          <?php echo $form_status; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_kecamatan; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_kelurahan; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <?php echo $form_surveyor; ?>
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <button type="button" id="btn-filter" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                          <button type="button" id="btn-reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
                        </div>
                      </form>
                      </div>
                    </p>

                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>ID Pelanggan</th>
                              <th>Nama</th>
                              <th>Telp</th>
                              <th>Nama Dagang</th>
                              <th>Alamat</th>
                              <th>Photo</th>
                              <th>Kota</th>
                              <th>Kelurahan</th>
                              <th>Kecamatan</th>
                              <th>Lat</th>
                              <th>Long</th>
                              <th>status</th>
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
                          <th>Photo</th>
                          <th>Kota</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Lat</th>
                          <th>Long</th>
                          <th>status</th>
                          <th>Surveyor</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                  </table>
                  </div>
                </div>

                  <!-- modals -->
                  <!-- Large modal -->
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Tambah Pelanggan</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal form-label-left">
                            <div class="class-row">
                              <div class="col-md-6 form-group">
                                <div class="form-group">
                                  <label>Nama Pelanggan</label>
                                  <input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan nama pelanggan">
                                </div>
                                <div class="form-group">
                                  <label>No Telp.</label>
                                  <input type="text" class="form-control" name="no_telp" placeholder="Masukkan nomer telp.">
                                </div>
                                <div class="form-group">
                                  <label>Nama Dagang</label>
                                  <input type="text" class="form-control" name="nama_dagang" placeholder="Masukkan nomer telp.">
                                </div>
                                <div class="form-group">
                                  <label>Kota</label>
                                  <input type="text" class="form-control" name="kota" placeholder="kota">
                                </div>
                                <div class="form-group">
                                  <label>Kelurahan</label>
                                  <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan">
                                </div>
                                <div class="form-group">
                                  <label>Kecamatan</label>
                                  <input type="text" class="form-control" name="kecamatan" placeholder="kecamatan">
                                </div>
                                <div class="form-group">
                                  <label>Alamat</label>
                                  <textarea name="alamat" class="form-control" placeholder="masukkan alamat lengkap"></textarea>
                                </div>
                              </div>
                              <div class="col-md-6 form-group">
                                <div class="form-group">
                                  <label>Email address</label>
                                  <input type="text" class="form-control" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="text" class="form-control" placeholder="Password">
                                </div>
                              </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>
