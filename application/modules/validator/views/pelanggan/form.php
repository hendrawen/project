<?php
$url = base_url('assets/uploads/').$photo;
$url2 = base_url('assets/uploads/').$photo_toko;
 ?>
 <?php
 define("API_KEY","AIzaSyDn1JrKoNqygrc0Wjei_wpPCSFIJXvvclk") ?>
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
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                          <input name="id_pelanggan" type="hidden" value="<?php echo $id_pelanggan; ?>">
                          <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan nama pelanggan" value="<?php echo $nama_pelanggan; ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>No Telp.</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="Masukkan nomer telp." value="<?php echo $no_telp; ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>Nama Dagang</label>
                            <input type="text" class="form-control" name="nama_dagang" placeholder="Masukkan nomer telp." value="<?php echo $nama_dagang; ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>Kategori Dagang</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                              <?php foreach ($list_kategori as $key): ?>
                                <option <?php echo ($id_kategori == $key->id_kategori)?'selected':'' ?> value="<?php echo $key->id_kategori ?>"><?php echo $key->nama_kategori ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Kota</label>
                            <select class="form-control" name="kota" id="kota">
                              <option value="">--Pilih Kota--</option>
                              <?php foreach ($list_kota as $row): ?>
                                <option <?php echo ($row->nama == $kota)?'selected':'' ?> id_kota="<?php echo $row->id_kab ?>" value="<?php echo $row->nama ?>"><?php echo $row->nama ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Kecamatan <img style="display:none" id="loader-kecamatan" src="<?php echo base_url('assets/ajax-loader.gif') ?>" alt=""></label>
                            <select class="form-control" name="kecamatan" id="kecamatan" >
                              <?php if ($button == 'Update'): ?>
                                <option value="<?php echo $kecamatan ?>"><?php echo $kecamatan ?></option>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Kelurahan <img style="display:none" id="loader-kelurahan" src="<?php echo base_url('assets/ajax-loader.gif') ?>" alt=""></label>
                            <select class="form-control" name="kelurahan" id="kelurahan">
                              <?php if ($button == 'Update'): ?>
                                <option value="<?php echo $kelurahan ?>"><?php echo $kelurahan ?></option>
                              <?php endif; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="masukkan alamat lengkap"><?php echo $alamat; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                              <label>Latitude</label>
                              <input type="text" name="lat" id="lat" class="form-control" placeholder="masukkan latitude" value="<?php echo $lat; ?>">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                              <label>Longlatitude</label>
                              <input type="text" name="long" id="long" class="form-control" placeholder="masukkan longlatitude" value="<?php echo $long; ?>">
                            </div>
                          </div>
                          <div id="button-layer"><button id="btnAction" onClick="locate()">Get Curent Location</button></div>
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" required="required">
                              <option value="">--Status--</option>
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
                            <label>Surveyor</label> <span class="required">*</span>
                            <select name="wp_karyawan_id_karyawan" id="wp_karyawan_id_karyawan" class="form-control" required="required">
                            <option value="" disabled selected>--Pilih Surveyor--</option>

                                <?php
                                  $users = $this->db->query("SELECT wp_karyawan.id_karyawan, wp_karyawan.nama FROM wp_karyawan INNER JOIN wp_jabatan where 
                                  wp_karyawan.wp_jabatan_id = wp_jabatan.id AND
                                  wp_jabatan.nama_jabatan='Marketing'");
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
                          <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                          <div class="text-right">
                            <a href="<?php echo base_url('validator/pelanggan')?>" type="button" class="btn btn-default" >Kembali</a>
                            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
                          </div>
                        </div>
                      </div>
                      </form>
                  </div>
                </div>
                <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap"
    async defer></script>
                <script type="text/javascript">
                var map;
                function initMap() {
                  var mapLayer = document.getElementById("map-layer");
                  var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
                  var defaultOptions = { center: centerCoordinates, zoom: 4 }

                  map = new google.maps.Map(mapLayer, defaultOptions);
                }

                function locate(){
                  document.getElementById("btnAction").disabled = true;
                  document.getElementById("btnAction").innerHTML = "Processing...";
                  if ("geolocation" in navigator){
                    navigator.geolocation.getCurrentPosition(function(position){
                      var currentLatitude = position.coords.latitude;
                      var currentLongitude = position.coords.longitude;

                      var infoWindowHTML = "lat: " + currentLatitude + "<br>Longitude: " + currentLongitude;
                      var lat = document.getElementById('lat').value = currentLatitude; //latitude
                      var lat = document.getElementById('long').value = currentLongitude; //latitude
                      var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
                      var currentLocation = { lat: currentLatitude, lng: currentLongitude };
                      infoWindow.setPosition(currentLocation);
              				document.getElementById("btnAction").style.display = 'none';
                    });
                  }
                }
                </script>
