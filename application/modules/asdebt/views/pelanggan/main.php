            
                <p class="text-muted font-13 m-b-30">
                  <div class="row">
                    <form id="form-filter" class="form-horizontal">
                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <select class="form-control" id="filter-kota" >
                        <option value="" selected>--Semua Kota--</option>
                        <?php foreach ($list_kota as $row): ?>
                          <option id_kota="<?php echo $row->id_kab ?>" value="<?php echo $row->nama ?>"><?php echo $row->nama ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <select class="form-control" id="filter-kecamatan">
                        <option value="" selected>--Semua Kecamatan--</option>
                      </select>
                    </div>

                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <select class="form-control" id="filter-kelurahan">
                        <option value="" selected>--Semua Kelurahan--</option>
                      </select>
                    </div>

                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <?php echo $form_status; ?>
                    </div>
                    <?php
                        echo '<div class="col-md-2 col-sm-12 col-xs-12 form-group">
                           '.$form_surveyor.'
                        </div>';
                    ?>
                    
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                      <select class="form-control select2" data-width="100%" name="created_at" id="created_at">
                         <option value="" readonly>Bulan</option>
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
                    <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                      <select name="tahun" id="tahun" class="form-control">
                        <option selected="selected" value="">Tahun</option>
                        <?php
                        for($i=date('Y'); $i>=date('Y')-9; $i-=1) {
                        echo"<option value='$i'> $i </option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <div class="text-right">
                        <button type="button" id="btn-filter" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                        <button type="button" id="btn-reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Tampilkan Semua</button>
                      </div>

                    </div>
                  </form>
                  </div>
                </p>
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-group"></i> Data Pelanggan</h2>
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
                    <table id="table" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>ID Pelanggan</th>
                              <th>Nama</th>
                              <th>Telp</th>
                              <th>Nama Dagang</th>
                              <th>Kategori</th>
                              <th>Alamat</th>
                              <th>Kota</th>
                              <th>Kecamatan</th>
                              <th>Kelurahan</th>
                              <th>GPS</th>
                              <th>Status</th>
                              <th>Kebutuhan</th>
                              <th>Photo</th>
                              <th>Surveyor</th>
                              <th>Tanggal</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID Pelanggan</th>
                          <th>Nama</th>
                          <th>Telp</th>
                          <th>Nama Dagang</th>
                          <th>Kategori</th>
                          <th>Alamat</th>
                          <th>Kota</th>
                          <th>Kecamatan</th>
                          <th>Kelurahan</th>
                          <th>GPS</th>
                          <th>Status</th>
                          <th>Kebutuhan</th>
                          <th>Photo</th>
                          <th>Surveyor</th>
                          <th>Tanggal</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                  </table>
                  </div>
                </div>
