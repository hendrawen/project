<?php
      if (empty($record)) { ?>
        <center>
        <div class="alert alert-danger" role="alert">Pelanggan Ini Tidak Memiliki Hutang
        </div>
        <a href="<?php echo base_url('pembayaran'); ?>" type="button" class="btn btn-default" > <i class="fa fa-arrow-left"></i> Kembali</a>
      </center>
     <?php } else  {
?>

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
          <h2>Cek Piutang</h2>
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
                <input type="text" id="id_track_admin" class="form-control" placeholder="Masukkan ID Pelanggan" name="id_track_admin" value="<?=$record[0]->id_pelanggan?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
                <button id="button_admin" class="btn btn-success"><i class="fa fa-search"></i> Cek</button>
              </div>
            </div>
            <div class="row">
              <div class="table-responsive">
              <table class="table jambo_table table-bordered dt-responsive nowrap" id="tabel_cari">
                    <thead>
                      <th>Tanggal Transaksi</th>
                      <th>ID Pelanggan</th>
                      <th>Nama Pelanggan</th>
                      <th>ID Transaki</th>
                      <th>Utang (Rp.)</th>
                      <th>Tanggal Bayar</th>
                      <th>Bayar (Rp.)</th>
                      <th>Sisa Hutang (Rp.)</th>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($record)){
                      foreach ($record as $key){
                        ?>
                        <tr>
                        <td><?=tgl_indo($key->tgl_transaksi)?></td>
                        <td><?=$key->id_pelanggan?></td>
                        <td><?=$key->nama_pelanggan?></td>
                        <td><?=$key->id_transaksi?></td>
                        <td><?=$key->utang?></td>
                        <td><?=tgl_indo($key->tgl_bayar)?></td>
                        <td><?=$key->bayar?></td>
                        <td><?=$key->sisa?></td>
                        </tr>
                        <?php
                      }
                    } else { ?>
                        <tr>
                          <td colspan="9">
                            <center>
                                <div class="alert alert-danger" role="alert">Pelanggan Tidak Memiliki Utang
                                </div>
                            </center>
                          </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
            </div>
            </div>
          <!-- end form for validations -->
        </div>
      </div>

<div class="x_panel">
        <div class="x_title">
          <h2>Form Pembayaran</h2>
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
          <form action="<?php echo base_url(). 'pembayaran/ubah_pembayaran'; ?>" method="post">
            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
              <label for="fullname">Tanggal Pembayaran * :</label>
              <div class="controls">
                  <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="single_cal3" name="tgl_bayar" placeholder="Tanggal Transaksi" aria-describedby="inputSuccess2Status3">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
              <label for="bayar">Bayar (Rp.) *</label>
                <!-- <input type="hidden" name="id_transaksi" value="<?php echo $key->id_transaksi; ?>" id="idtransaksi" class="form-control"> -->
                <input type="text" name="bayar" id="bayar" class="form-control" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="Masukkan jumlah bayar" required>
            </div>
            <!-- <input type="hidden" name="sudah" id="sudah"> -->
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" id="id" name="id" />
            <div class="form-group text-right">
            <a href="<?php echo base_url('pembayaran'); ?>" type="button" class="btn btn-default" > <i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i> Bayar</button>
            </div>
          </form>
          <!-- end form for validations -->
        </div>
      </div>

  <?php } ?>