<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>Selamat Datang !</strong>
    <?php echo $this->session->identity; ?>.
</div>

<a href="<?php echo base_url('som/takeorder/tambah'); ?>" type="button" class="btn btn-success" ><i class="fa fa-user"></i> Tambah</a>

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-group"></i> List <?php echo $judul_list; ?></h2>
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
    <p class="text-muted font-13 m-b-30">
      <div class="row">
        <form id="form-filter2" class="form-horizontal">
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <?php echo $form_status; ?>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <select name="sumber_data" class="form-control" id="sumber_data">
              <option value="semua">Sumber Data</option>
              <option value="Due Date">Due Date</option>
              <option value="Hijau">Hijau</option>
              <option value="Biru">Biru</option>
              <option value="Kuning">Kuning</option>
              <option value="Orange">Orange</option>
              <option value="Jingga">Jingga</option>
              <option value="Hijau Muda">Hijau Muda</option>
              <option value="New Customer">New Customer</option>
          </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <select name="melalui" class="form-control" id="melalui">
              <option value="semua">Melalui</option>
              <option value="Call">Call</option>
              <option value="Kunjungan">Kunjungan</option>
          </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <select name="creator" class="form-control" id="creator">
              <option value="semua">Creator</option></option>
              <?php
                foreach ($creator->result() as $key) {?>
                  <option value="<?php echo $key->id_karyawan ?>"><?php echo $key->nama ?></option>
                <?php }
              ?>
          </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <select class="form-control select2" data-width="100%" name="tanggal" id="tanggal">
             <option value="semua" readonly>Bulan</option>
             <option value="1">Januari</option>
             <option value="2">Pebruari</option>
             <option value="3">Maret</option>
             <option value="4">April</option>
             <option value="5">Mei</option>
             <option value="6">Juni</option>
             <option value="7">Juli</option>
             <option value="8">Agustus</option>
             <option value="9">September</option>
             <option value="10">Oktober</option>
             <option value="11">November</option>
             <option value="12">Desember</option>
         </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
          <select name="tahun" id="tahun" class="form-control">
            <option selected="selected" value="semua">Tahun</option>
            <?php
            for($i=date('Y'); $i>=date('Y')-9; $i-=1) {
            echo"<option value='$i'> $i </option>";
            }
            ?>
            </select>
        </div>
        <input type="hidden" name="akses" id="akses" value="<?php echo $this->session->userdata('username'); ?>">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="text-right">
            <button type="button" id="btn-filter2" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
            <button type="button" id="btn-reset2" class="btn btn-warning"><i class="fa fa-refresh"></i> Semua</button>
          </div>

        </div>
      </form>
      </div>
    </p>
  </div>
  <div class="x_content">
    <table id="table_call" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
      <thead>
          <tr>
              <th>Tanggal</th>
              <th>ID Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Tanggal Kirim</th>
              <th>Status</th>
              <th>Sumber Data</th>
              <th>Keterangan</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
      </tbody>
  </table>
  </div>
</div>
