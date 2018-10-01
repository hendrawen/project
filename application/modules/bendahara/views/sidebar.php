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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo site_url('bendahara');?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a <?php echo ($aktif == 'pembelian')?'class="active"':"";?> href="<?php echo site_url('bendahara/pembelian')?>"><i class="fa fa-shopping-cart"></i> Pembelian</a></li>
                  <li><a <?php echo ($aktif == 'pembayaran_barang')?'class="active"':"";?> href="<?php echo site_url('bendahara/pembayaran_barang/barang')?>"><i class="fa fa-credit-card"></i> Pembayaran Barang</a></li>
                  <li><a <?php echo ($aktif == 'pembayaran_aset')?'class="active"':"";?> href="<?php echo site_url('bendahara/pembayaran_aset/penarikan')?>"><i class="fa fa-money"></i> Pembayaran Aset</a></li>
                  <li><a <?php echo ($aktif == 'kas')?'class="active"':"";?> href="<?php echo site_url('bendahara/kas')?>"><i class="fa fa-bank"></i> Kas</a></li>
                  <!-- <li><a <?php echo ($aktif == 'repot-kas')?'class="active"':"";?> href="<?php echo site_url('bendahara/report_kas')?>"><i class="fa fa-file"></i> Report Kas</a></li> -->
                  <li><a><i class="fa fa-sort-alpha-asc"></i> KPI <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/sumberdata">Sumber Data Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/sudavalidator">Sumber Data Validator</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/effectivecall">Activity Effectif Call</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/validator">Activity Validator</a></li>

                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/debt">Debt & Delivery</a></li>
                      <li><a <?php echo ($aktif == 'Master')?'class="active"':"";?> href="<?php echo base_url();?>bendahara/marketing">Marketing</a></li>
                    </ul>
                  </li>
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
