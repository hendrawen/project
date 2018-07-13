            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jadwal <small>Sessions</small></h2>
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

                    <div id='calendar'></div>

                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <div class="error"></div>
                          <form class="form-horizontal" id="crud-form">
                          <input type="hidden" id="start">
                          <input type="hidden" id="end">
                          <div class="form-group">
                            <label for="title">Pelanggan</label>
                            <!-- <input type="text" name="wp_pelanggan_id" id="autoidjadwal" class="form-control" placeholder="Masukkan ID Pelanggan" required=""> -->
                            <select name="wp_pelanggan_id" id="wp_pelanggan_id" class="form-control js-example-basic-single" required>
                            <option disabled selected>--Pilih Pelanggan--</option>

                                <?php
                                  $users = $this->db->query("SELECT * FROM wp_pelanggan Where status='Pelanggan'");
                                  foreach($users->result() as $value){
                                  $selected= '';
                                  if($wp_pelanggan_id == $value->id){
                                    $selected = 'selected="selected"';
                                  }
                                  ?>
                                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                                  <?php echo $value->id_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?>
                                  </option>
                                  <?php }?>
                                </select>
                          </div>
                          <div class="form-group">
                              <label for="title">Judul</label>
                                  <input id="title" name="title" type="text" class="form-control input-md" />
                          </div>
                          <div class="form-group">
                            <label for="title">Barang</label>
                            <select name="wp_barang_id" id="wp_barang_id" class="form-control" required>
                            <option value="" selected>--Pilih--</option>
                                <?php
                                  $users = $this->db->query("SELECT * FROM wp_barang");
                                  foreach($users->result() as $value){
                                  $selected= '';
                                  if($wp_barang_id == $value->id){
                                    $selected = 'selected="selected"';
                                  }
                                  ?>
                                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                                  <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
                                  </option>
                                  <?php }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control" name="" value="">
                          </div>
                          <div class="form-group">
                              <label for="description">Keterangan</label>
                                  <textarea class="form-control" id="description" name="description"></textarea>
                          </div>
                          <div class="form-group">
                              <label for="color">Pilih Warna</label>
                                  <input id="color" name="color" type="text" class="form-control" readonly="readonly" />
                                  <span class="help-block">Click to pick a color</span>
                          </div>
                          <div class="form-group">
                            <label for="title">Pilih Driver</label>
                            <select name="wp_karyawan_id_karyawan" id="wp_karyawan_id_karyawan" class="form-control" required>
                            <option value="" selected>--Pilih--</option>
                                <?php
                                  $users = $this->db->query("SELECT * FROM wp_karyawan join wp_jabatan where wp_karyawan.wp_jabatan_id = wp_jabatan.id AND
                                  wp_jabatan.nama_jabatan = 'Debt & Delivery'");
                                  foreach($users->result() as $value){
                                  $selected= '';
                                  if($wp_karyawan_id_karyawan == $value->id_karyawan){
                                    $selected = 'selected="selected"';
                                  }
                                  ?>
                                  <option  value="<?php echo $value->id_karyawan; ?>"  <?php echo $selected;?> >
                                  <?php echo $value->id_karyawan; ?> - <?php echo $value->nama; ?>
                                  </option>
                                  <?php }?>
                            </select>
                          </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>

                      </div>
                    </div>
                  </div>
