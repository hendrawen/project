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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo site_url('admin_gudang');?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a <?php echo ($aktif == 'pembelian')?'class="active"':"";?> href="<?php echo site_url('admin_gudang/pembelian')?>"><i class="fa fa-shopping-cart"></i> Pembelian</a></li>
                  <li><a <?php echo ($aktif == 'pembayaran_barang')?'class="active"':"";?> href="<?php echo site_url('admin_gudang/pembayaran_barang/barang')?>"><i class="fa fa-credit-card"></i> Pembayaran Barang</a></li>
                  <!-- <li><a <?php echo ($aktif == 'pembayaran_aset')?'class="active"':"";?> href="<?php echo site_url('admin_gudang/pembayaran_aset')?>"><i class="fa fa-money"></i> Pembayaran Aset</a></li> -->
                  <li><a <?php echo ($aktif == 'stok_opname')?'class="active"':"";?> href="<?php echo site_url('admin_gudang/stok')?>"><i class="fa fa-sticky-note"></i> Stok Opname</a></li>
                  <li><a <?php echo ($aktif == 'muat')?'class="active"':"";?> href="<?php echo site_url('admin_gudang/muat')?>"><i class="fa fa-truck"></i> Muatan Barang</a></li>
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
