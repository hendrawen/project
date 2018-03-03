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
                    <div class="col-md-4">
                        <?php echo anchor(site_url('suplier/create'),'Tambah', 'class="btn btn-primary"'); ?>
                    </div>
                  </div>
                    <div class="col-md-4 text-center">
                        <div style="margin-top: 8px" id="message">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
                    </div>

                      <div class="x_content">

                        <!-- <table id="datasuplier" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>#</th>
                          		<th>Id Suplier</th>
                          		<th>Nama Suplier</th>
                          		<th>Alamat</th>
                          		<th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            foreach ($suplier_data as $suplier)
                            {
                                ?>
                            <tr>
                              <td width="30px"><?php echo $no++ ?></td>
                              <td><?php echo $suplier->id_suplier ?></td>
                        			<td><?php echo $suplier->nama_suplier ?></td>
                        			<td><?php echo $suplier->alamat ?></td>
                        			<td style="text-align:center" width="200px">
                        				<?php
                        				echo anchor(site_url('suplier/read/'.$suplier->id),'Read');
                        				echo ' | ';
                        				echo anchor(site_url('suplier/update/'.$suplier->id),'Update');
                        				echo ' | ';
                        				echo anchor(site_url('suplier/delete/'.$suplier->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                        				?>
                              </td>
                            </tr>
                            <?php
                                }
                            ?>
                          </tbody>
                        </table> -->
                          <table class="table table-striped table-bordered dt-responsive nowrap" id="mydata">
                              <thead>
                                  <tr>
                                      <th>Id Suplier</th>
                                      <th>Nama Suplier</th>
                                      <th>Alamat</th>
                                      <th>Aksi</th>
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
