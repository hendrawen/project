<div class="x_panel">
    <div class="x_title">
        <h2>Laporan Pembayaran
            <small>Harian</small>
        </h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </li>
            <li class="dropdown">
                <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">Settings 1</a>
                    </li>
                    <li>
                        <a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="close-link">
                    <i class="fa fa-close"></i>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Tahun
                        <img
                            id="loading"
                            src="<?=base_url();?>assets/ajax-loader.gif"
                            alt=""
                            style="text-align:center; display:none"></span>
                    <select class="form-control" id="tahunan">
                        <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
              echo '<option value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Berdasarkan
                    </span>
                    <select class="form-control" id="berdasarkan">
                        <option value="semua">Semua Dept</option>
                        <option value="dept">Per Dept</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Nama Dept
                        <img
                            id="loading-combo"
                            src="<?=base_url();?>assets/ajax-loader.gif"
                            alt=""
                            style="text-align:center; display:none"></span>
                    <select class="form-control" id="nama">
                        <option value="semua">Semua</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
                <button type="button" id="btn-debttahunan" class="btn btn-success">
                    <i class="fa fa-search"></i>
                    Search</button>
                <button type="button" id="exceltahunan" class="btn btn-primary">
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