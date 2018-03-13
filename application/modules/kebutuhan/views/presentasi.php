          <div class="row">
              <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Laporan</small></h2>
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
                    <?php echo form_open("kebutuhan/proses_laporan"); ?>
                    <div class="row">
                    <div class="col-sm-12">
                    Bulan Awal
                    <div class="form-group">
					               <!-- <input type="text" class="form-control" placeholder="Bulan"> -->
                         <select class="form-control select2" data-width="100%" name="awal" id="awal" required>
                            <option value="" readonly>--Bulan--</option>
                            <option value="1">Januari</option>
      											<option value="2">Pebruari</option>
      											<option value="3">Maret</option>
      											<option value="4">April</option>
      											<option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
      									</select>
				              </div>
                    </div>
                    <div class="col-sm-12">
                    Bulan Akhir
                    <div class="form-group">
					               <!-- <input type="text" class="form-control" placeholder="Bulan"> -->
                         <select class="form-control select2" data-width="100%" name="akhir" id="akhir" required>
                            <option value="" readonly>--Bulan--</option>
                            <option value="1">Januari</option>
      											<option value="2">Pebruari</option>
      											<option value="3">Maret</option>
      											<option value="4">April</option>
      											<option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
      									</select>
				              </div>
                      </div>
                    <div class="col-sm-12">
                    Periode Tahun
                    <div class="form-group">
                        <select name="tahun" class="form-control" required>
                          <option selected="selected" value="">--Tahun--</option>
                          <?php
                          for($i=date('Y'); $i>=date('Y')-15; $i-=1){
                          echo"<option value='$i'> $i </option>";
                          }
                          ?>
                          </select>
				              </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                      <div class="form-group">
                        <button type="submit" id="btn-filter" class="btn btn-success"><i class="fa fa-refresh"></i> Proses</button>
                        <button type="button" id="btn-reset" class="btn btn-warning"><i class="fa fa-print"></i> Cetak</button>
                      </div>
                    </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Kebutuhan Pelanggan</h2>
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
                  <?php
                  if (isset($result_display2)) {
                    echo "";
                    if ($result_display2 == 'No record found !') {
                    echo $result_display2;
                    } else {
                    foreach ($result_display2 as $value) {
                    echo '<div class="widget_summary">
                      <div class="w_left w_25">
                        <span>'.$value->jenis.'</span>
                      </div>
                      <div class="w_center w_55">
                        <div class="progress">
                          <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="1000" style="width: '.$value->total.'%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                      </div>
                      <div class="w_right w_20">
                        <span>'.$value->total.'</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>';
                  }
                  }
                  }
                  ?>
                </div>

              </div>
            </div>

            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Detail Kebutuhan</h2>
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
                  <?php
                  if (isset($result_display)) {
                    echo "";
                    if ($result_display == 'No record found !') {
                    echo $result_display;
                    } else {
                    echo "
                    <table id='datatable' class='table table-striped jambo_table bulk_action table-bordered'>";
                    echo "<thead>
                            <tr>
                              <th>ID Pelanggan</th>
                              <th>Nama</th>
                              <th>Jenis</th>
                              <th>Jumlah</th>
                              <th>Tanggal</th>
                            </tr>
                          </thead>";
                    foreach ($result_display as $value) {
                    echo '<tbody><tr>' . '<td>' . $value->id_pelanggan . '</td>' . '<td>' . $value->nama_pelanggan . '</td>' .  '<td>' . $value->jenis . '</td>' . '<td>' . $value->total . '</td>' . '<td>' . tgl_indo($value->tgl) . '</td>'. '<tr/>' . ' </tbody>';
                    }
                    echo '
                    </table>';
                  }
                  }
                  ?>

                </div>
              </div>
            </div>
            </div>
