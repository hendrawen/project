<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Selamat Datang
    </strong>di Sistem Informasi Brajamarketindo !
</div>
<div class="row top_tiles">
    <a href="<?php echo base_url('karyawan');?>">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-caret-square-o-right"></i>
                </div>
                <?php $jml = $this->db->query("select * from wp_karyawan")->num_rows();?>
                <div class="count"><?php echo $jml; ?></div>
                <h3>Karyawan</h3>
                <p></p>
            </div>
        </div>
    </a>
    <a href="<?php echo base_url('suplier');?>">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-comments-o"></i>
                </div>
                <?php $jml = $this->db->query("select * from wp_suplier")->num_rows();?>
                <div class="count"><?php echo $jml; ?></div>
                <h3>Suplier</h3>
                <p></p>
            </div>
        </div>
    </a>
    <a href="<?php echo base_url('barang');?>">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-sort-amount-desc"></i>
                </div>
                <?php $jml = $this->db->query("select * from wp_barang")->num_rows();?>
                <div class="count"><?php echo $jml; ?></div>
                <h3>Barang</h3>
                <p></p>
            </div>
        </div>
    </a>
    <a href="<?php echo base_url('barang/stok');?>">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <?php $jml = $this->db->query("select * from wp_stok")->num_rows();?>
                <div class="count"><?php echo $jml; ?></div>
                <h3>Stok Barang</h3>
                <p></p>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Penjualan<small>Chart</small>
                </h2>
                <div class="nav navbar-right panel_toolbox">
                    <select class="form-control" name="tahun-penjualan" id="tahun-penjualan">
                        <?php for ($tahun=(date('Y')-5); $tahun <= date('Y'); $tahun++) {
                    echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="penjualan_chart" width="300" height="75"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Produk
                    <small>Chart</small>
                </h2>
                <div class="nav navbar-right panel_toolbox">
                    <select class="form-control" name="tahun-produk" id="tahun-produk">
                        <?php for ($tahun=(date('Y')-5); $tahun <= date('Y'); $tahun++) {
                    echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="" style="width:100%">
                    <tr>
                        <th style="width:37%;">
                            Top 5
                        </th>
                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <p class="">Barang</p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <p class="">Jumlah</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <canvas
                                class="produk-chart"
                                height="140"
                                width="140"
                                style="margin: 15px 10px 10px 0"></canvas>
                        </td>
                        <td>
                            <table class="tile_info"></table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pembayaran<small>Chart</small>
                </h2>
                <div class="nav navbar-right panel_toolbox">
                    <select class="form-control" name="tahun-pembayaran" id="tahun-pembayaran">
                        <?php for ($tahun=(date('Y')-5); $tahun <= date('Y'); $tahun++) {
                    echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
                    } ?>
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="pembayaran_chart" width="300" height="75"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>