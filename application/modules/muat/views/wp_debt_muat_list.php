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
    <h2>Dev Muat <small>Data Muat</small></h2>
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
            <a class="btn btn-success" href="<?php echo base_url('muat/create') ?>">Tambah</a>
        </div>
    </div>
    <div class="table-responsive">
      <table id="table_muat" class="table table-striped jambo_table table-bordered ">
          <thead>
          <tr>
                <th rowspan ="2" class="wider_kecamatan text-center">Tanggal</th>
                <th rowspan ="2" class="wider_kecamatan text-center">Gudang</th>
                <th rowspan ="2" class="wider_kecamatan text-center">Nama Debt</th>
                <th rowspan ="2" class="wider_kecamatan text-center">Nama Barang</th>
                <th colspan ="2" class="text-center">Muat</th>
                <th colspan ="2" class="text-center">Terkirim</th>
                <th colspan ="2" class="text-center">Kembali</th>
                <th colspan ="2" class="text-center">Retur</th>
                <th colspan ="2" class="text-center">Rusak</th>
                <th colspan ="2" class="text-center">Aset</th>
                <th rowspan ="2" class="wider_kecamatan text-center">Keterangan</th>
                <th rowspan ="2" class="wider_kecamatan text-center">Creator</th>
                <th rowspan ="2"  class="wider_kecamatan text-center">Aksi</th>
            </tr>
            <tr>
              <?php 
                for ($i=1; $i < 7 ; $i++) {?>
                  <th class="text-center">Qty</th>
                  <th class="text-center">Satuan</th>
                <?php }
              ?>
              
            </tr>
          </thead>
          <tbody> 
          </tbody>
      </table>
    </div>
  </div>
</div>
