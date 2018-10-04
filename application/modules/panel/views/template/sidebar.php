<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-paw"></i> <span>Brajamarketindo</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url()?>assets/template/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('username');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url();?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                <!-- master Data -->
                  <li <?= ($aktif == 'Karyawan' || $aktif == 'Supplier' || $aktif == 'Gudang' || $aktif == 'Barang' || $aktif == 'Pelanggan' || $aktif == 'Master')?'class="active"':''?> >
                  <a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" 
                    <?= ($aktif == 'Karyawan' || $aktif == 'Supplier' || $aktif == 'Gudang' || $aktif == 'Barang' || $aktif == 'Pelanggan' || $aktif == 'Master')?'style="display:block"':'' ?>>
                      <li <?=($aktif == 'Karyawan')?'class="current-page"':''?> ><a href="<?php echo base_url();?>karyawan">Karyawan</a></li>
                      <li <?=($aktif == 'Supplier')?'class="current-page"':''?>><a href="<?php echo base_url();?>suplier">Suplier</a></li>
                      <li <?=($aktif == 'Gudang')?'class="current-page"':''?>><a href="<?php echo base_url();?>gudang">Gudang</a></li>
                      <li <?=($aktif == 'Barang')?'class="current-page"':''?>><a href="<?php echo base_url();?>barang">Barang</a></li>
                      <li <?=($aktif == 'Pelanggan' || $aktif == 'Master')?'class="current-page"':''?>><a href="<?php echo base_url();?>pelanggan">Pelanggan</a></li>
                      <!-- <li><a href="<?php echo base_url();?>barang/stok">Stok</a></li> -->
                    </ul>
                  </li>
                      <li><a><i class="fa fa-bar-chart-o"></i> Transaksi<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">

                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembelian"> Pembelian Barang</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaranbarang/barang"> Pembayaran Barang</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaranaset/penarikan"> Pembayaran Aset</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>transaksi">Penjualan</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaran"> Pembayaran</a>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>penarikan"> Penarikan Aset</a>
                        <!-- <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>piutang"> Piutang</a> -->
                        </li>
                        </li>
                      </ul>
                    </li>
                      <li><a><i class="fa fa-clone"></i> Manage Pelanggan<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>status_pelanggan"> SOM </a>
                        <li><a href="<?php echo base_url();?>effectifcall">Customer Service / Validator</a></li>
                      </ul>
                  </li>
                  <!-- <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url('laporan/penjualan/');?>"><i class="fa fa-line-chart"></i> Report Penjualan</a>
                  <li><a <?php echo ($aktif == 'laporan')?'class="active"':"";?> href="<?php echo base_url('laporan/pembayaran/utama');?>"><i class="fa fa-line-chart"></i> Report Pembayaran</a> -->
                    <!-- <li><a><i class="fa fa-line-chart"></i> Report Pembayaran <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_harian">Pembayaran Harian</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_bulanan">Pembayaran Bulanan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_tahunan">Pembayaran Tahunan</a></li>
                      </ul>
                    </li> -->
                    <li><a><i class="fa fa-line-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/penjualan">Penjualan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/utama">Pembayaran</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penarikan">Penarikan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk">Trx Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area">Trx Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing">Trx Marketing</a></li>
                      </ul>
                    </li>
                    <!-- <li><a><i class="fa fa-line-chart"></i> Report Trx Produk <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_harian">Penjualan Harian Per Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_bulanan">Penjualan Bulanan Per Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_tahun">Penjualan Tahunan Per Produk</a></li>
                      </ul>
                    </li> -->
                    <!-- <li><a><i class="fa fa-line-chart"></i> Report Trx Area <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/area/harian">Penjualan Harian Per Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area/bulanan">Penjualan Bulanan Per Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area/tahun">Penjualan Tahunan Per Area</a></li>
                      </ul>
                    </li> -->
                    <!-- <li><a><i class="fa fa-line-chart"></i> Report Trx Marketing <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/marketing/harian_marketing">Penjualan Harian Marketing</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing/bulanan_marketing">Penjualan Bulanan Marketing</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing/tahunan_marketing">Penjualan Tahunan Marketing</a></li>
                      </ul>
                    </li> -->
                  <li><a><i class="fa fa-list-alt"></i> Report Debt & Delivery <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/penjualan/penjualan_debt">Penjualan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/pembayaran_debt">Pembayaran</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/penarikan_debt">Penarikan</a></li>
                      </ul>
                  </li>
                  <li><a href="<?php echo base_url();?>tracking"><i class="fa fa-search"></i> Tracking Pelanggan</a></li>
                  <li><a href="<?php echo base_url();?>tracking_aset"><i class="fa fa-search"></i> Tracking Aset</a></li>
                  <li><a href="<?php echo base_url();?>market"><i class="fa fa-shopping-cart"></i> Market Share</a></li>
                  <li><a href="<?php echo base_url();?>produk"><i class="fa fa-share-alt"></i> Produk Share</a></li>
                  <li><a href="<?php echo base_url();?>statspel/laporan/pelanggan"><i class="fa fa-users"></i> Growth Pelanggan</a></li>
                  <li><a href="<?php echo base_url();?>gtransaksi"><i class="fa fa-pie-chart"></i> Growth Transaksi</a></li>

                  <li><a <?php echo ($aktif == 'users')?'class="active"':"";?>><i class="fa fa-database"></i> Data Stok & Aset<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>aset">Aset Awal</a></li>
                        <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>barang/stok">Stok Awal</a></li>
                        <li><a href="<?php echo base_url();?>muat">Muat Barang</a></li>
                        <li><a href="<?php echo base_url();?>stok_opname">Stock Opname</a></li>
                      </ul>
                  </li>

                  <li><a <?php echo ($aktif == 'Kas')?'class="active"':"";?>><i class="fa fa-clone"></i> Data Kas <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>kas">Kas</a></li>
                        <li><a href="<?php echo base_url();?>kas/kategorikas">Kategori Kas</a></li>
                      </ul>
                  <li><a <?php echo ($aktif == 'users')?'class="active"':"";?>><i class="fa fa-clone"></i> Setting <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>users">User</a></li>
                        <li><a href="<?php echo base_url();?>users/groups">User Group</a></li>
                      </ul>
                  </li>

                  <li><a <?php echo ($aktif == 'Profile')?'class="active"':"";?> href="<?php echo base_url();?>profile"><i class="fa fa-user"></i> Profile Perusahaan</a></li>

                  <li><a <?php echo ($aktif == 'Faktur')?'class="active"':"";?> href="<?php echo base_url();?>faktur2"><i class="fa fa-file-text-o"></i> Faktur </a></li>

                  <li><a><i class="fa fa-sort-alpha-asc"></i> KPI <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/sumberdata">Sumber Data Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/sudavalidator">Sumber Data Validator</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/effectivecall">Activity Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/validator">Activity Validator</a></li>

                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/debt">Debt & Delivery</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/marketing">Marketing</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
