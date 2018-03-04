                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form <?php echo $button ?> Pelanggan</h2>
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
                    <form action="<?php echo $action; ?>" class="form-horizontal form-label-left">
                      <div class="class-row">
                        <div class="col-md-6 form-group">
                          <input type="hidden" value="" name="id"/>
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
                            <label>Latitude</label>
                            <input type="text" name="lat" class="form-control" placeholder="masukkan latitude">
                          </div>
                          <div class="form-group">
                            <label>Longlatitude</label>
                            <input type="text" name="long" class="form-control" placeholder="masukkan longlatitude">
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                              <option>Choose option</option>
                              <option value="Responden">Responden</option>
                              <option value="pelanggan">Pelanggan</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label id="label-photo">Photo</label>
                            <input type="file" name="photo" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Photo Toko</label>
                            <input type="file" name="photo_toko" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                            <label>Surveyor</label>
                            <input type="text" name="wp_karyawan_id_karyawan" class="form-control">
                          </div>
                          <input type="hidden" name="id" value="">
                          <div class="text-right">
                            <a href="<?php echo base_url('pelanggan')?>" type="button" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                          </div>
                        </div>
                      </div>
                      </form>
                  </div>
                </div>
