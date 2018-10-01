<div class="row">
  <form action="#" id="form_checkout" class="form-horizontal">
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    
      <input type="text" name="id_pelanggan" id="autoidtransaksi2" class="form-control" value="<?php echo $id_pelanggan; ?>" placeholder="Masukkan ID Pelanggan" readonly>
    
    </div>
</form>
</div>
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
  <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
          <div class="x_panel">
            <div class="x_title">
              <h2>Transaksi <small>Braja Marketindo</small></h2>
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
            <div class="x_content" id="printable">
              <form method="POST" action="<?php echo site_url('transaksi/update_bayar');?>">
              <input type="hidden" name="wp_pelanggan_id" id="" value="<?php echo $wp_pelanggan_id; ?>">
              <input type="hidden" name="id_transaksi" id="" value="<?php echo $id_transaksi; ?>">
              <input type="hidden" name="subtotal" id="" value="<?php echo $subtotal; ?>">
              <section class="content invoice">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12 invoice-header">
                    <h1>
                        <i class="fa fa-globe"></i> Invoice.
                        <small class="pull-right"></small>
                    </h1>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                      <?php
                          foreach ($profile as $value) {
                              ?>
                                    <strong><?php echo $value->nama_perusahaan ?></strong>
                                    <br><?php echo $value->alamat ?>
                                    <br>Phone: <?php echo $value->no_telp ?>
                                    <br>Email: <?php echo $value->email ?>
                                    <br>Website: <?php echo $value->website ?>
                          <?php
                          } ?>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Kepada
                        <address>
                        
                            <strong><span name="nama_pelanggan" id="nama_pelanggan"><?php echo $nama_pelanggan;?></span></strong>
                            <br><span name="nama_dagang" id="nama_dagang"><?php echo $nama_dagang;?></span>
                            <br><span name="alamat" id="alamat"><?php echo $alamat;?></span>
                            <br>Telp : <span name="no_telp" id="no_telp"><?php echo $no_telp; ?></span>
                        
                        </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Order ID:</b> #<?php echo $generate_invoice; ?>
                    <br>
                    <b>Tanggal Transaksi:</b> <?php
                                          $date = Date("Y-m-d");
                                          Echo tgl_indo($date);
                                        ?>
                    <br>
                    <b>ID Pelanggan:</b> <span name="idpelanggan" id="idpelanggan"> <?php echo $id_pelanggan;?> </span>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table table-responsive">
                    <table class="table table-striped jambo_table dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID Produk</th>
                          <th>Nama Barang</th>
                          <th>Harga (Rp.)</th>
                          <th>QTY</th>
													<th>Satuan</th>
                          <th>Diskon (Rp.)</th>
                          <th>Subtotal (Rp.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <tr>
                          <td><?php echo $id_transaksi; ?></td>
                          <td><?php echo $name; ?></td>
                          <td>Rp. <?php echo $this->cart->format_number($price,2,'.','.'); ?></td>
                          <td><?php echo $qty; ?></td>
						  <td><?php echo $satuan; ?></td>
                          <td><?php echo $this->cart->format_number($diskon,2,'.','.'); ?></td>
                          <td><?php echo $this->cart->format_number($subtotal,2,'.','.'); ?></td>
                        </tr>
                        <tr>
                          <td colspan="6"><strong>Total</strong></td>
                          <td>
                            <?php 
                                $total = ($subtotal - $diskon) * $qty;
                                echo $this->cart->format_number($total,2,'.','.');
                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-md-6 col-sm-12 col-xs-12">
                    <p class="lead">Jenis Pembayaran:</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      <?php
                        foreach ($jenis_pembayaran as $value) {  
                          ?>
                          <input type="radio" name="wp_status_id" id="<?php echo $value->id; ?>" required value="<?php echo $value->id; ?>" <?php if ($wp_status_id == $value->id) { echo "checked"; }?> > <?php echo $value->nama_status; ?><br>
                        <?php
                        } ?>
                    </p>
                  </div>
                  <!-- /.col -->
                <div class="text col-md-6 col-xs-12">
                    <p class="lead">Pembayaran</p>
                    <div class="form-group">
                      <label for="">Jumlah Bayar</label>
                        <input type="text" name="bayar" placeholder="Rp." class="form-control" value="0" readonly>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-lg-4 col-sm-12 col-xs-12 form-group">
                    <input type="date" class="form-control has-feedback-left" name="tgltransaksi" value="<?php echo $tgl_transaksi; ?>" placeholder="Tanggal Transaksi" aria-describedby="inputSuccess2Status3">
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-xs-12">
                    
                    <div class="form-group">
                      <select class="form-control" name="gudang" id="gudang" required>
                        <option disabled selected>--Pilih Gudang--</option>
                            <?php
                              foreach ($data_gudang->result() as $key) { 
                                $selected= '';
                                if($gudang == $key->id){
                                    $selected = 'selected="selected"';
                                } 
                            ?>
                                <option value="<?php echo $key->id; ?>" <?php echo $selected; ?> ><?php echo $key->nama_gudang ?></option>
                              <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                    <a href="<?php echo base_url('transaksi')?>" class="hapus_cart3 btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Batal</a>
                  </div>
                </div>
              </section>
            </div>
            </form>
          </div>
        </div>
      </div>
      