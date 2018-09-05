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
                <span class="input-group-addon">Tanggal
                        <img
                            id="loading"
                            src="<?=base_url();?>assets/ajax-loader.gif"
                            alt=""
                            style="text-align:center; display:none"></span>
                    <input
                        type="date"
                        class="form-control"
                        id="tgl"
                        placeholder=""
                        value="<?php echo date('m/d/Y')?>">
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <button
                    type="button"
                    class="btn btn-success"
                    id="btn-laporan-pembayaran-harian">
                    <i class="fa fa-search">
                        Search</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                <button type="button" id="excel_pembayaran_harian" class="btn btn-primary">
                    <i class="fa fa-download"></i>
                    Excel</button>
                <button type="button" class="btn btn-warning" id="btn-refresh-pembayaran">
                    <i class="fa fa-refresh">
                        Reload</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right"></div>
            </div>
            <!-- end-view-day -->

            <!-- view-month -->
            <div id="view_month" class="row" style="display:none">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bulan dari</span>
                        <select class="form-control" id="bulan_dari">
                            <?php $i = 1; foreach ($month as $key): ?>
                            <option value="<?php echo $i++;?>"><?php echo $key?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Bulan ke</span>
                        <select class="form-control" id="bulan_ke">
                        <?php $i = 1;  foreach ($month as $key): ?>
                        <option value="<?php echo $i++;?>"><?php echo $key ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Tahun</span>
                        <select class="form-control" id="tahun">
                        <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
              echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
                    </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <button type="button" class="btn btn-success" id="btn-search_bulan">
                    <i class="fa fa-search">
                        Search</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                <button type="button" id="pembayaran_excel_bulanan" class="btn btn-primary">
                    <i class="fa fa-download"></i>
                    Excel</button>
                <button type="button" class="btn btn-warning" id="btn-refresh-pembayaran">
                    <i class="fa fa-refresh">
                        Reload</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                </div>
            </div>
            <!-- end-view-month -->

            <!-- view-year -->
            <div id="view_year" class="row" style="display:none">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">Tahun</span>
                        <select class="form-control" id="tahunan">
                            <option value="">Pilih Tahun</option>
                            <?php for ($tahun=(date('Y')-6); $tahun <= date('Y'); $tahun++) {
              echo '<option value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-success" id="btn-search_tahun">
                    <i class="fa fa-search">
                        Search</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                <button type="button" id="pembayaran_excel_tahunan" class="btn btn-primary">
                    <i class="fa fa-download"></i>
                    Excel</button>
                <button type="button" class="btn btn-warning" id="btn-refresh-pembayaran">
                    <i class="fa fa-refresh">
                        Reload</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                </div>
            </div>
            <!-- end-view-year -->

        </form>
        <hr>
        <div class="table-responsive">
        <table
                id="transaksilist datatable-buttons_wrapper"
                class="table table-striped jambo_table table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No Faktur</th>
                        <th>Tgl Kirim</th>
                        <th>Jatuh Tempo</th>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Satuan</th>
                        <th class="wider_kecamatan">Kecamatan</th>
                        <th class="wider_kecamatan">Kelurahan</th>
                        <th>No Telpon</th>
                        <th>Surveyor</th>
                        <th>Debt</th>
                        <th>Jumlah</th>
                        <th>Tgl Bayar</th>
                        <th>Bayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Sisa Hutang</th>
                        <th class"wider"="class"wider"">Status</th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>
        </div>
    </div>
</div>