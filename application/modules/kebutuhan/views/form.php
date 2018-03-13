                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form <?php echo $button ?> Kebutuhan</h2>
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
                    <br>
                    <form action="<?php echo $action; ?>" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                      <div class="class-row">
                        <div class="col-md-12 form-group">
                          <div class="form-group">
                            <label>Pelanggan</label>
                            <select name="wp_pelanggan_id" id="e1" class="form-control select2" required>
                            <option disabled selected>--Pilih--</option>
                                <?php
                                  $users = $this->db->query("SELECT * FROM wp_pelanggan");
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
                            <label>Jenis Kebutuhan</label>
                            <select name="wp_jkebutuhan_id" id="wp_jkebutuhan_id" class="form-control" required>
                            <option disabled selected>--Pilih--</option>
                                <?php
                                  $users = $this->db->query("SELECT * FROM wp_jkebutuhan");
                                  foreach($users->result() as $value){
                                  $selected= '';
                                  if($wp_jkebutuhan_id == $value->id){
                                    $selected = 'selected="selected"';
                                  }
                                  ?>
                                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                                  <?php echo $value->jenis; ?>
                                  </option>
                                  <?php }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah" value="<?php echo $jumlah; ?>">
                          </div>
                          <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                          <div class="text-right">
                            <a href="<?php echo base_url('kebutuhan')?>" type="button" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                          </div>
                        </div>
                      </div>
                      </form>
                  </div>
                </div>
