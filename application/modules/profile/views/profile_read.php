
            <div class="x_panel">
                  <div class="x_title">
                        <h2>Detail Profile</h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                  </div><br>
                <div class="x_content">
                  <table class="table table-hover">
                	    <tr><td>Nama Perusahaan</td><td>:</td><td><?php echo $nama_perusahaan; ?></td></tr>
                	    <tr><td>Alamat</td><td>:</td><td><?php echo $alamat; ?></td></tr>
                	    <tr><td>No Telp</td><td>:</td><td><?php echo $no_telp; ?></td></tr>
                	    <tr><td>Email</td><td>:</td><td><?php echo $email; ?></td></tr>
                	    <tr><td>Website</td><td>:</td><td><?php echo $website; ?></td></tr>
                	    <tr><td></td><td></td><td><a href="<?php echo site_url('profile') ?>" class="btn btn-danger">Kembali</a></td></tr>
                	</table>
                </div>
           </div>
