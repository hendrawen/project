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
                  </table>
                  </div>
                </div>

              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-square-o"></i> Modals</h2>
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

                  <!-- modals -->
                  <!-- Large modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Text in a modal</h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <!-- Small modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Text in a modal</h4>
                          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                </div>
              </div>
