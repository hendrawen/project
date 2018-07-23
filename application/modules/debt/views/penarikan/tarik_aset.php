<?php if ($this->session->flashdata('message')): ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="alert alert-success alert-dismissible fade in" role="alert" id="message"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="x_panel">
        <div class="x_title">
          <h2>Cek Aset</h2>
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

          <!-- start form for validation -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="fullname">ID Pelanggan * :</label>
                <input type="text" id="id_track_aset" class="form-control" placeholder="Masukkan ID Pelanggan" name="id_track_aset" required="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
                <button id="button_aset" class="btn btn-success"><i class="fa fa-search"></i> Cek</button>
              </div>
            </div>
            <div class="row">
              <div class="table-responsive">
              <table class="table jambo_table table-bordered dt-responsive nowrap" id="tabel_cari_aset">
                    <thead>
                      <th>ID Pelanggan</th>
                      <th>Nama Pelanggan</th>
                      <th>Piutang</th>
                      <th>Tanggal Penarikan</th>
                      <th>Bayar Krat</th>
                      <th>Bayar Uang (Rp.)</th>
                    </thead>
                    <tbody id="result_aset">
                    </tbody>
                    </table>
              </div>
            </div>
          <!-- end form for validations -->

        </div>
      </div>

<div class="x_panel">
        <div class="x_title">
          <h2>Form Pembayaran/Penarikan Aset</h2>
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

          <form action="#" id="form-tarik-aset" method="post">
            <div id="pesan-post">
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 form-group">
              <label for="fullname">Tanggal Bayar/Tarik * :</label>
              <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal3" name="tgl_bayar" placeholder="Tanggal Transaksi" aria-describedby="inputSuccess2Status3">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12 form-group">
              <label for="jenis">Jenis Pembayaran * :</label>
              <select name="jenis" id="jenis" class="form-control">
                <option value="krat" selected>Krat</option>
                <option value="uang">Uang</option>
              </select>
            </div>
            <div id="form-input-uang" class="col-md-4 col-sm-4 col-lg-4 col-xs-12 form-group">
              <label for="bayar_uang">Bayar Uang (Rp.) *</label>
              <input type="text" id="bayar_uang" class="form-control" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="Masukkan jumlah bayar">
            </div>
            <div id="form-input-krat" class="col-md-4 col-sm-4 col-lg-4 col-xs-12 form-group">
              <label for="bayar_krat">Bayar Krat *</label>
              <input type="text" id="bayar_krat" class="form-control" autocomplete="off" placeholder="Masukkan jumlah bayar">
            </div>
            <!-- <input type="hidden" name="sudah" id="sudah"> -->
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" id="id" name="id" />
            
            <div class="form-group text-right">
              <a href="<?php echo base_url('pembayaran'); ?>" type="button" class="btn btn-default" > <i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="button" id="btn-bayar-aset" class="btn btn-success"><i class="fa fa-credit-card"></i> Bayar</button>
            </div>
            
          </form>
          <!-- end form for validations -->
        </div>
      </div>