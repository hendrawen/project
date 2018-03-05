        <div class="x_panel">
              <div class="x_title">
                    <h2>Suplier List</h2>
                    <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
              </div>
                  <div class="row">
                    <div class="col-md-6">
                        <!-- <?php echo anchor(site_url('suplier/create'),'Tambah', 'class="btn btn-primary"'); ?> -->
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah</a>
                    </div>
                  </div>
                    <div class="col-md-6 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>

                      <div class="x_content">
                          <table class="table table-striped table-bordered dt-responsive nowrap" id="mydata">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Id Suplier</th>
                                      <th>Nama Suplier</th>
                                      <th>Alamat</th>
                                      <th style="text-align:center">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody id="show_data">

                              </tbody>
                          </table>

                  </div>
                      <div class="row">
                          <div class="col-md-6">
                              <a></a>
                          		<?php echo anchor(site_url('suplier/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                          		<?php echo anchor(site_url('suplier/word'), 'Word', 'class="btn btn-primary"'); ?>
                  	    </div>
                      </div>
                    </div>

  <!-- MODAL ADD -->
  <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="myModalLabel">Tambah Suplier</h3>
      </div>
      <form class="form-horizontal">
          <div class="modal-body">
              <!-- <div class="form-group">
                  <label class="control-label col-xs-3" >Id Suplier</label>
                  <div class="col-xs-9">
                      <input name="id_suplier" id="id_suplier" class="form-control" type="text" placeholder="Id Suplier" style="width:335px;" required>
                  </div>
              </div> -->

              <div class="form-group">
                  <label class="control-label col-xs-3" >Nama Barang</label>
                  <div class="col-xs-9">
                      <input name="nama_suplier" id="nama_suplier2" class="form-control" type="text" placeholder="Nama Suplier" style="width:335px;" required>
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-xs-3" >Alamat</label>
                  <div class="col-xs-9">
                      <!-- <input name="alamat" id="alamat" class="form-control" type="text" placeholder="Harga" style="width:335px;" required> -->
                      <textarea name="alamat" id="alamat2" class="form-control" rows="3" placeholder="Alamat" style="width:335px;" required></textarea>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
              <button class="btn btn-info" id="btn_simpan">Simpan</button>
          </div>
      </form>
      </div>
      </div>
  </div>
  <!--END MODAL ADD-->

  <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Suplier</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Id Suplier</label>
                        <div class="col-xs-9">
                            <input name="id_suplier" id="id_suplier2" class="form-control" type="text" placeholder="Id Suplier" style="width:335px;" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Suplier</label>
                        <div class="col-xs-9">
                            <input name="nama_suplier" id="nama_suplier2" class="form-control" type="text" placeholder="Nama Suplier" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Alamat</label>
                        <div class="col-xs-9">
                            <!-- <input name="alamat" id="harga2" class="form-control" type="text" placeholder="Alamat" style="width:335px;" required> -->
                            <textarea name="alamat" id="alamat2" placeholder="Alamat" class="form-control" rows="3" style="width:335px;" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                    <input type="hidden" name="id" id="id2"/>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
    <!--END MODAL EDIT-->

    <!--MODAL HAPUS-->
            <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                            <h4 class="modal-title" id="myModalLabel">Hapus Data Suplier</h4>
                        </div>
                        <form class="form-horizontal">
                        <div class="modal-body">

                                <input type="hidden" name="id" id="id2" value="">
                                <div class="alert alert-warning"><p>Apakah Anda yakin mau memhapus Data Ini?</p></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <!--END MODAL HAPUS-->
