<div class="x_panel">
    <div class="x_title">
        <h2>Laporan Penarikan
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
                    <span class="input-group-addon">Tanggal
                        <img
                            id="loading"
                            src="<?=base_url();?>assets/ajax-loader.gif"
                            alt=""
                            style="text-align:center; display:none"></span>
                    <input type="date" class="form-control" id="tgl" placeholder="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon">Pilih Debt
                        <img
                            id="loading-combo"
                            src="<?=base_url();?>assets/ajax-loader.gif"
                            alt=""
                            style="text-align:center; display:none"></span>
                    <select class="form-control" id="debt">
                        <?php
                          foreach ($debt as $key) {?>
                                    <option value="<?php echo $key->nama ?>"><?php echo $key->nama ?></option>
                                    <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <button type="button" class="btn btn-success" id="btn-laporan-penarikan-harian">
                    <i class="fa fa-search">
                        Search</i>
                    <img
                        id="loading"
                        src="<?=base_url();?>assets/ajax-loader.gif"
                        alt=""
                        style="text-align:center; display:none"></button>
                <button type="button" id="excel_penarikan_harian" class="btn btn-primary">
                    <i class="fa fa-download"></i>
                    Excel</button>
                <button type="button" class="btn btn-warning" id="btn-refresh-penarikan">
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
                id="transaksilist_penarikan datatable-buttons_wrapper"
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
                        <th>Tgl Penarikan</th>
                        <th>Bayar</th>
                        <th>Tgl Penarikan</th>
                        <th>Bayar</th>
                        <th>Jumlah</th>
                        <th>Sisa ASET</th>
                        <th class="wider">Status</th>
                    </tr>
                </thead>
                <tbody id="tbody-penarikan-debt"></tbody>
            </table>
        </div>
    </div>
</div>