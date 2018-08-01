<div class="x_panel">
    <div class="x_title">

    <div class="row">
            <div class="col-md-4">
                <h2>Laporan Penjualan</h2>
            </div>
            <div class="col-md-4">
                <h2 id="total"></h2>
            </div>
            <div class="col-md-4">
                <ul class="nav navbar-right panel_toolbox">
                    <form>
                        <label class="radio-inline">
                            <input type="radio" onclick="view('day')" name="optradio" checked="checked">Tanggal
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="view('month')" name="optradio">Bulan
                        </label>
                        <label class="radio-inline">
                            <input type="radio" onclick="view('year')" name="optradio">Tahun
                        </label>
                    </form>
                </ul>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <form action="#" method="post" id="form-laporan">
            <!-- view-day -->
            <div id="view_day" class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Tanggal</span>
                        <input type="date" class="form-control" id="filter-tgl" placeholder="Tanggal">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Status</span>
                        <select class="form-control" id="filter-status">
                            <option value="">Pilih Status</option>
                            <?php foreach ($list_status as $key): ?>
                            <option value="<?php echo $key->id?>"><?php echo $key->nama_status?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <button
                        type="button"
                        id="btn-search"
                        onclick="search()"
                        class="btn btn-success">
                        <i class="fa fa-search"></i>
                        Search</button>
                    <button type="button" onClick="excel_tanggal()" class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Excel</button>
                    <button type="button" id="btn-refresh" onclick="refresh()" class="btn btn-info">
                        <i class="fa fa-refresh"></i>
                        Reload</button>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right"></div>
            </div>
            <!-- end-view-day -->
            <!-- view-month -->
            <div id="view_month" class="row" style="display:none">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bulan dari</span>
                        <select class="form-control" id="filter-bulan-dari">
                            <option value="">Pilih Bulan</option>
                            <?php $i = 1; foreach ($month as $key): ?>
                            <option value="<?php echo $i++;?>"><?php echo $key?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bulan ke</span>
                        <select class="form-control" id="filter-bulan-ke">
                            <option value="">Pilih Bulan</option>
                            <?php $i = 1;  foreach ($month as $key): ?>
                            <option value="<?php echo $i++;?>"><?php echo $key ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Tahun</span>
                        <select class="form-control" id="filter-tahun">
                            <option value="">Pilih Tahun</option>
                            <?php for ($tahun=(date('Y')-6); $tahun <= date('Y'); $tahun++) {
                                echo '<option value="'.$tahun.'">'.$tahun.'</option>';
                                } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Status</span>
                        <select class="form-control" id="filter-status2">
                            <option value="">Pilih Status</option>
                            <?php foreach ($list_status as $key): ?>
                            <option value="<?php echo $key->id?>"><?php echo $key->nama_status?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <button
                        type="button"
                        id="btn-search"
                        onclick="search()"
                        class="btn btn-success">
                        <i class="fa fa-search"></i>
                        Search</button>
                    <button type="button" onClick="excel_bulan()" class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Excel</button>
                    <button type="button" id="btn-refresh" onclick="refresh()" class="btn btn-info">
                        <i class="fa fa-refresh"></i>
                        Reload</button>
                </div>
            </div>
            <!-- end-view-month -->

            <!-- view-month -->
            <div id="view_year" class="row" style="display:none">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Tahun</span>
                        <select class="form-control" id="filter-tahun2">
                            <option value="">Pilih Tahun</option>
                            <?php for ($tahun=(date('Y')-6); $tahun <= date('Y'); $tahun++) {
              echo '<option value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Status</span>
                        <select class="form-control" id="filter-status3">
                            <option value="">Pilih Status</option>
                            <?php foreach ($list_status as $key): ?>
                            <option value="<?php echo $key->id?>"><?php echo $key->nama_status?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <button
                        type="button"
                        id="btn-search"
                        onclick="search()"
                        class="btn btn-success">
                        <i class="fa fa-search"></i>
                        Search</button>
                    <button type="button" onClick="excel_tahun()" class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        Excel</button>
                    <button type="button" id="btn-refresh" onclick="refresh()" class="btn btn-info">
                        <i class="fa fa-refresh"></i>
                        Reload</button>
                </div>
            </div>
            <!-- end-view-month -->

        </form>
        <hr>
        <div class="table-responsive">
            <table
                id="table-penjualan2"
                class="table table-striped jambo_table table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Faktur</th>
                        <th>Tgl Kirim</th>
                        <th>Jatuh Tempo</th>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Satuan</th>
                        <th>Kota</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>No Telpon</th>
                        <th>Surveyor</th>
                        <th>Debt</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>