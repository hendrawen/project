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
                        <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah</a> -->
                        <button class="btn btn-primary" onclick="add_suplier()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                    </div>
                  </div>
                    <div class="col-md-6 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>

                      <div class="x_content">
                          <table class="table table-striped table-bordered dt-responsive nowrap" id="table_id">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Id Suplier</th>
                                      <th>Nama Suplier</th>
                                      <th>Alamat</th>
                                      <th style="text-align:center">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                $no = 1;
                                foreach($suplier as $key){ ?>
                               <tr>
                                   <td><?php echo $no++ ?></td>
                                   <td><?php echo $key->id_suplier;?></td>
                                   <td><?php echo $key->nama_suplier;?></td>
                                   <td><?php echo $key->alamat;?></td>
                                   <td style="text-align:center">
                                    <button class="btn btn-warning" onclick="edit_suplier(<?php echo $key->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                    <button class="btn btn-danger" onclick="delete_suplier(<?php echo $key->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
                                   </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>#</th>
                                <th>Id Suplier</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                              </tr>
                            </tfoot>
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


            <!-- Bootstrap modal -->
              <div class="modal fade" id="modal_form" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Tambah Suplier</h3>
                  </div>
                  <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                      <input type="hidden" value="" name="id"/>
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Nama Suplier</label>
                          <div class="col-md-9">
                            <input name="nama_suplier" placeholder="Nama Suplier" class="form-control" type="text" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Alamat</label>
                          <div class="col-md-9">
                            <!-- <input name="alamat" placeholder="Alamat" class="form-control" type="text"> -->
                            <textarea name="alamat" placeholder="Alamat" class="form-control" rows="3" required></textarea>
                          </div>
                        </div>
                      </div>
                    </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              <!-- End Bootstrap modal -->
