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
                  <li><a <?php echo ($aktif == 'Dashboard')?'class="active"':"";?> href="<?php echo base_url();?>"><i class="fa fa-home"></i> Dashboard</a>
                  </li>
                  <li><a <?php echo ($aktif == 'Profile')?'class="active"':"";?> href="<?php echo base_url();?>profile"><i class="fa fa-user"></i> Profile </a></li>
                  <li><a <?php echo ($aktif == 'Karyawan')?'class="active"':"";?>><i class="fa fa-clone"></i> Data Karyawan <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url();?>karyawan/jabatan">Jabatan</a></li>
                        <li><a href="<?php echo base_url();?>karyawan">Karyawan</a></li>
                      </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>pelanggan">Pelanggan</a></li>
                      <li><a href="<?php echo base_url();?>suplier">Suplier</a></li>
                      <li><a href="<?php echo base_url();?>barang">Barang</a></li>
                      <li><a href="<?php echo base_url();?>barang/stok">Stok</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-newspaper-o"></i> Kebutuhan<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>kebutuhan">Kebutuhan</a></li>
                      <li><a href="<?php echo base_url();?>jenis_kebutuhan">Jenis Kebutuhan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Payment<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>transaksi"> Transaksi</a>
                      </li>
                      <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>piutang"> Piutang</a>
                      </li>
                      <li><a <?php echo ($aktif == 'transaksi')?'class="active"':"";?> href="<?php echo base_url();?>pembayaran"> Pembayaran</a>
                      </li>
                    </ul>
                  </li>
                  <li><a <?php echo ($aktif == 'Jadwal')?'class="active"':"";?> href="<?php echo base_url();?>jadwal"><i class="fa fa-calendar-o"></i> Jadwal </a></li>
                  <li><a><i class="fa fa-cube"></i> Asset<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a <?php echo ($aktif == 'delivery')?'class="active"':"";?> href="<?php echo base_url();?>delivery"> Delivery</a>
                      </li>
                      <li><a <?php echo ($aktif == 'muat')?'class="active"':"";?> href="<?php echo base_url();?>delivery/muat"> Muat</a>
                      </li>
                    </ul>
                  </li>
                  <li><a <?php echo ($aktif == 'effectifcall')?'class="active"':"";?> href="<?php echo base_url();?>effectifcall"><i class="fa fa-tty"></i> Effectif Call </a></li>
                  <li><a <?php echo ($aktif == 'Faktur')?'class="active"':"";?> href="<?php echo base_url();?>faktur2"><i class="fa fa-file-text-o"></i> Faktur </a></li>
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
