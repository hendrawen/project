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
                        <?php echo anchor(site_url('suplier/create'),'Tambah', 'class="btn btn-primary"'); ?>
                        <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah</a>-->
                        <!-- <button class="btn btn-primary" onclick="add_suplier()"><i class="glyphicon glyphicon-plus"></i> Tambah</button> -->
                    </div>
                  </div>
                    <div class="col-md-6 text-right">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>
                    <!-- table table-striped table-bordered dt-responsive nowrap -->
                      <div class="x_content">
                          <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
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
                                      <a href="<?=base_url()?>suplier/read/<?=$key->id?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></a>
                                      <a href="<?=base_url()?>suplier/update/<?=$key->id?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                      <a onclick="javasciprt: return confirm('Are You Sure ?')" href="<?=base_url()?>suplier/delete/<?=$key->id?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
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
                                <th style="text-align:center">Aksi</th>
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
