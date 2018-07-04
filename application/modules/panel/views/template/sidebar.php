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

                  <?php if (in_array("Profile Perusahaan", $submenu)):?>
                  <li><a <?php echo ($aktif == 'Profile')?'class="active"':"";?> href="<?php echo base_url();?>profile"><i class="fa fa-user"></i> Profile Perusahaan</a></li>
                  <?php endif ?>

                  <?php if (in_array("Karyawan", $menu)):?>
                  <li><a <?php echo ($aktif == 'Karyawan')?'class="active"':"";?>><i class="fa fa-clone"></i> Data Karyawan <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>karyawan/jabatan">Jabatan</a></li>
                        <li><a href="<?php echo base_url();?>karyawan">Karyawan</a></li>
                      </ul>
                  </li>
                  <?php endif ?>
                
                  <?php if (in_array("Master Data", $menu)):?>
                  <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>pelanggan">Pelanggan</a></li>
                      <?php if (in_array("Suplier", $submenu)):?>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>suplier">Suplier</a></li>
                      <?php endif ?>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>barang">Barang</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>barang/stok">Stok</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kebutuhan">Kebutuhan</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>jenis_kebutuhan">Jenis Kebutuhan</a></li>
                    </ul>
                  </li>
                  <?php endif ?>
                  
                    <?php if (in_array("Transaksi", $menu)):?>
                      <li><a><i class="fa fa-bar-chart-o"></i> Transaksi<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">

                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembelian"> Pembelian Barang</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaranbarang/barang"> Pembayaran Barang</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>transaksi"> Transaksi Penjualan</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>piutang"> Piutang</a>
                        </li>
                        <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaran"> Pembayaran</a>
                        </li>
                      </ul>
                    </li>
                    <?php endif ?>
                    <?php if (in_array("Jadwal", $submenu)):?>
                    <li><a <?php echo ($aktif == 'jadwal')?'class="active"':"";?> href="<?php echo base_url();?>jadwal"><i class="fa fa-calendar"></i> Jadwal</a>
                    </li>
                    <?php endif ?>
                    <?php if (in_array("Aset", $submenu)):?>
                    <li><a <?php echo ($aktif == 'aset')?'class="active"':"";?> href="<?php echo base_url();?>aset"><i class="fa fa-cube"></i> Aset</a>
                    </li>
                    <?php endif ?>

                    <?php if (in_array("Effectif Call", $submenu)):?>
                    <li><a <?php echo ($aktif == 'effectifcall')?'class="active"':"";?> href="<?php echo base_url();?>effectifcall"><i class="fa fa-tty"></i> Effectif Call </a></li>
                    <?php endif ?>  
                    
                    <?php if (in_array("Jadwal Kunjungan", $submenu)):?>
                    <li><a <?php echo ($aktif == 'Jadwal Kunjungan')?'class="active"':"";?> href="<?php echo base_url();?>jadwalkunjungan"><i class="fa fa-tty"></i> Jadwal Kunjungan </a></li>
                    <?php endif ?>  

                    <?php if (in_array("Faktur", $submenu)):?>
                  <li><a <?php echo ($aktif == 'Faktur')?'class="active"':"";?> href="<?php echo base_url();?>faktur2"><i class="fa fa-file-text-o"></i> Faktur </a></li>
                  <?php endif ?>  

                  <?php if (in_array("Report Transaksi", $menu)):?>
                    <li><a><i class="fa fa-line-chart"></i> Report Transaksi <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/penjualan/harian">Penjualan Harian</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/bulanan">Penjualan Bulanan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/tahunan">Penjualan Tahunan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_harian">Penjualan Harian Per Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_bulanan">Penjualan Bulanan Per Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk/produk_tahun">Penjualan Tahunan Per Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area/harian">Penjualan Harian Per Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area/bulanan">Penjualan Bulanan Per Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area/tahun">Penjualan Tahunan Per Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing/harian_marketing">Penjualan Harian Marketing</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing/bulanan_marketing">Penjualan Bulanan Marketing</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing/tahunan_marketing">Penjualan Tahunan Marketing</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_harian">Pembayaran Harian</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_bulanan">Pembayaran Bulanan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/pembayaran/pembayaran_tahunan">Pembayaran Tahunan</a></li>
                      </ul>
                    </li>
                  <?php endif ?>

                  <?php if (in_array("Tracking Pelanggan", $submenu)):?>
                  <li><a href="<?php echo base_url();?>tracking"><i class="fa fa-search"></i> Tracking Pelanggan</a></li>
                  <?php endif ?>

                  <?php if (in_array("Market Share", $submenu)):?>
                  <li><a href="<?php echo base_url();?>market"><i class="fa fa-shopping-cart"></i> Market Share</a></li>
                  <?php endif ?>

                  <?php if (in_array("Produk Share", $submenu)):?>
                  <li><a href="<?php echo base_url();?>produk"><i class="fa fa-share-alt"></i> Produk Share</a></li>
                  <?php endif ?>

                  <?php if (in_array("Growth Pelanggan", $submenu)):?>
                  <li><a href="<?php echo base_url();?>statspel/laporan/pelanggan"><i class="fa fa-users"></i> Growth Pelanggan</a></li>
                  <?php endif ?>

                  <?php if (in_array("Growth Transaksi", $submenu)):?>
                  <li><a href="<?php echo base_url();?>gtransaksi"><i class="fa fa-pie-chart"></i> Growth Transaksi</a></li>
                  <?php endif ?>

                  <?php if (in_array("Report Debt & Delivery", $submenu)):?>
                  <li><a><i class="fa fa-list-alt"></i> Report Debt & Delivery <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>lap_dep/harian">Laporan Transaksi Harian</a></li>
                        <li><a href="<?php echo base_url();?>lap_dep/bulanan">Laporan Transaksi Bulanan</a></li>
                        <li><a href="<?php echo base_url();?>lap_dep/tahunan">Laporan Transaksi Tahunan</a></li>
                      </ul>
                    </li>
                  <?php endif ?>

                  <?php if (in_array("Report Penarikan ASET", $submenu)):?>
                  <li><a href="<?php echo base_url();?>laporan/penarikan/bulanan"><i class="fa fa-truck"></i> Report Penarikan ASET</a></li>
                  <?php endif ?>

                  <?php if (in_array("Master Data", $menu)):?>
                  <li><a><i class="fa fa-sort-alpha-asc"></i> KPI <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/sumberdata">Sumber Data Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/effectivecall">Activity Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/debt">Debt & Delivery</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>kpi/marketing">Marketing</a></li>   
                    </ul>
                  </li>
                  <?php endif ?>

                  <?php if (in_array("Users", $submenu)):?>
                  <li><a <?php echo ($aktif == 'User')?'class="active"':"";?> href="<?php echo base_url();?>users"><i class="fa fa-table"></i> Users </a></li>
                  <?php endif ?>

                  <?php if (in_array("User Groups", $submenu)):?>
                  <li><a <?php echo ($aktif == 'Group')?'class="active"':"";?> href="<?php echo base_url();?>users/groups"><i class="fa fa-clone"></i> User Groups </a></li>
                  <?php endif ?>

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

