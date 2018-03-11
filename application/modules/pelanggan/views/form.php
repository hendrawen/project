<?php
$url = base_url('assets/uploads/').$photo;
$url2 = base_url('assets/uploads/').$photo_toko;
 ?>
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
                    <form action="<?php echo $action; ?>" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                      <div class="class-row">
                        <div class="col-md-6 form-group">
                          <input name="id_pelanggan" type="hidden" value="<?php echo $id_pelanggan; ?>">
                          <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" value="<?php echo $nama_pelanggan; ?>">
                          </div>
                          <div class="form-group">
                            <label>No Telp.</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="Masukkan nomer telp." value="<?php echo $no_telp; ?>">
                          </div>
                          <div class="form-group">
                            <label>Nama Dagang</label>
                            <input type="text" class="form-control" name="nama_dagang" placeholder="Masukkan nomer telp." value="<?php echo $nama_dagang; ?>">
                          </div>
                          <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control" name="kota" placeholder="kota" value="<?php echo $kota; ?>">
                          </div>
                          <div class="form-group">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan" value="<?php echo $kelurahan; ?>">
                          </div>
                          <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" placeholder="kecamatan" value="<?php echo $kecamatan; ?>">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="masukkan alamat lengkap"><?php echo $alamat; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-6 form-group">
                          <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="lat" class="form-control" placeholder="masukkan latitude" value="<?php echo $lat; ?>">
                          </div>
                          <div class="form-group">
                            <label>Longlatitude</label>
                            <input type="text" name="long" class="form-control" placeholder="masukkan longlatitude" value="<?php echo $long; ?>">
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                              <option>Choose option</option>
                              <option <?php if( $status=='Responden'){echo "selected"; } ?> value="Responden">Responden</option>
                              <option <?php if( $status=='Pelanggan'){echo "selected"; } ?> value="pelanggan">Pelanggan</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label id="label-photo">Photo</label>
                            <div class="media-left">
                                  <a href="<?=$url?>" target="_blank"><img src="<?=$url?>" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                            </div>

                            <div class="media-body">
                                  <input type="file" class="form-control" name="photo" id="photo">
                                  <span class="help-block">Accepted formats: gif, png, jpg, bmp. Max file size 2Mb</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Photo Toko</label>
                            <div class="media-left">
                                  <a href="<?=$url2?>" target="_blank"><img src="<?=$url2?>" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                            </div>

                            <div class="media-body">
                                  <input type="file" class="form-control" name="photo_toko" id="photo_toko">
                                  <span class="help-block">Accepted formats: gif, png, jpg, bmp. Max file size 2Mb</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?php echo $keterangan; ?></textarea>
                          </div>
                          <div class="form-group">
                            <label>Surveyor</label>
                            <input type="text" name="wp_karyawan_id_karyawan" class="form-control" <?php echo $wp_karyawan_id_karyawan; ?>>
                          </div>
                          <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                          <div class="text-right">
                            <a href="<?php echo base_url('pelanggan')?>" type="button" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                          </div>
                        </div>
                      </div>
                      </form>
                  </div>
                </div>
