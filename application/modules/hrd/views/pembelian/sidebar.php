<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('dep') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Brajamarketindo</span></a>
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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url('dep');?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a <?php echo ($aktif == 'penjualan')?'class="active"':"";?> href="<?php echo base_url()?>dep/jadwal"><i class="fa fa-calendar-o"></i> Jadwal</a>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Payment<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'dep')?'class="active"':"";?> href="<?php echo base_url();?>dep/piutang"> Piutang</a>
                      </li>
                      <li><a <?php echo ($aktif == 'dep')?'class="active"':"";?> href="<?php echo base_url();?>dep/transaksi"> Transaksi</a>
                      </li>
                      <li><a <?php echo ($aktif == 'dep')?'class="active"':"";?> href="<?php echo base_url();?>dep/pembayaran"> Pembayaran</a>
                      </li>
                    </ul>
                  </li>
                  <li><a <?php echo ($aktif == 'dep')?'class="active"':"";?> href="<?php echo base_url()?>dep/list"><i class="fa fa-file-text"></i> List Transaksi</a>
                  </li>
                  <li><a <?php echo ($aktif == 'penjualan')?'class="active"':"";?> href="<?php echo base_url()?>dep/delivery"><i class="fa fa-cube"></i> Aset</a>
                  </li>
                  <li><a <?php echo ($aktif == 'penjualan')?'class="active"':"";?> href="<?php echo base_url()?>dep/muat"><i class="fa fa-file-text"></i> Muat</a>
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
