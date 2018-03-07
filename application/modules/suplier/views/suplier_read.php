
  <div class="x_panel">
        <div class="x_title">
              <h2>Detail Suplier</h2>
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
        <table class="table table-hover dt-responsive nowrap">
            <tr><td>Id Suplier</td><td>:</td><td><?php echo $id_suplier; ?></td></tr>
            <tr><td>Nama Suplier</td><td>:</td><td><?php echo $nama_suplier; ?></td></tr>
            <tr><td>Alamat</td><td>:</td><td><?php echo $alamat; ?></td></tr>
            <tr><td colspan="3" align="center"><a href="<?php echo site_url('suplier') ?>" class="btn btn-danger">Kembali</a></td></tr>
        </table>
      </div>
  </div>
