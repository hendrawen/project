<?php if ($this->session->flashdata('message')): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="alert alert-warning alert-dismissible fade in" role="alert" id="message"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="x_panel">
  <div class="x_title">
    <h2>Laporan <small>Rekapitulasi</small></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-12 text-right">
            <!-- <a class="btn btn-success" href="<?php echo base_url('delivery/muat/create') ?>">Tambah</a> -->
        </div>
    </div>
    <div class="table-responsive">
      <table id="table_produku" class="table table-striped jambo_table table-bordered">
          <thead>
            <tr>
              <th class="wider_kecamatan text-center">Customer</th>
              <th class="wider_kecamatan text-center">Nama Barang</th>
              <th class="wider_kecamatan text-center">QTY</th>
              <th class="wider_kecamatan text-center">Harga Modal</th>
              <th class="wider_kecamatan text-center">Harga Jual</th>
              <th class="wider_kecamatan text-center">Sisa</th>
            </tr>
          </thead>
          <tbody> 
          </tbody>
      </table>
    </div>
  </div>
</div>
