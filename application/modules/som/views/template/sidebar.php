<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Brajamarketindo</span></a>
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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo site_url('som');?>"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a <?php echo ($aktif == 'jadwal')?'class="active"':"";?> href="<?php echo site_url();?>som/jadwal"><i class="fa fa-user"></i> Jadwal</a></li>
                  <li><a <?php echo ($aktif == 'effectifcall')?'class="active"':"";?> href="<?php echo site_url();?>som/validator"><i class="fa fa-tty"></i> Validator </a></li>
                  <li><a <?php echo ($aktif == 'Faktur')?'class="active"':"";?> href="<?php echo site_url();?>som/pelanggan"><i class="fa fa-file-text-o"></i> Pelanggan</a></li>
                  <li><a><i class="fa fa-edit"></i> Report Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>som/laporan/harian">Penjualan Harian</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/bulanan">Penjualan Bulanan</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/tahunan">Penjualan Tahunan</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/produk">Penjualan Per Produk</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/area">Penjualan Per Area</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/marketing">Penjualan Per Marketing</a></li>
                      <li><a href="<?php echo base_url();?>som/laporan/pelanggan">Pelanggan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Report Transaksi Dep <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>som/lap_dep/harian">Penjualan Harian</a></li>
                      <li><a href="<?php echo base_url();?>som/lap_dep/bulanan">Penjualan Bulanan</a></li>
                      <li><a href="<?php echo base_url();?>som/lap_dep/tahunan">Penjualan Tahunan</a></li>

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
