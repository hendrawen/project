<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('asdebt') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Brajamarketindo</span></a>
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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo site_url('kepala_cabang');?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a><i class="fa fa-line-chart"></i> Report <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>kepala_cabang/penjualan">Penjualan</a></li>
                        <li><a href="<?php echo base_url();?>kepala_cabang/pembayaran/utama">Pembayaran</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penarikan">Penarikan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/produk">Trx Produk</a></li>
                        <li><a href="<?php echo base_url();?>laporan/area">Trx Area</a></li>
                        <li><a href="<?php echo base_url();?>laporan/marketing">Trx Marketing</a></li>
                      </ul>
                  </li>
                  <li><a><i class="fa fa-list-alt"></i> Report Debt & Delivery <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>laporan/penjualan/penjualan_debt">Penjualan</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/pembayaran_debt">Pembayaran</a></li>
                        <li><a href="<?php echo base_url();?>laporan/penjualan/penarikan_debt">Penarikan</a></li>
                      </ul>
                  </li>
									<li><a href="<?php echo base_url();?>kepala_cabang/tracking"><i class="fa fa-search"></i> Tracking Pelanggan</a></li>
                  <li><a href="<?php echo base_url();?>kepala_cabang/tracking_aset"><i class="fa fa-search"></i> Tracking Aset</a></li>
                  <li><a href="<?php echo base_url();?>kepala_cabang/market"><i class="fa fa-shopping-cart"></i> Market Share</a></li>
                  <li><a href="<?php echo base_url();?>kepala_cabang/produk"><i class="fa fa-share-alt"></i> Produk Share</a></li>
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
