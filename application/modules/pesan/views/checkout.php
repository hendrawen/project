<?php if(!$this->cart->contents()):
		echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Warning !</strong> Silahkan melakukan penambahan produk terlebih dahulu.
                  </div>
                <div class="text-right">
                <a href="'.base_url('pesan').'" type="button"  class="btn btn-success text-right"><i class="fa fa-plus-circle"></i> Input Transaksi</a>
                </div>';
					else:
?>

<div class="row">
  <form action="#" id="form_checkout" class="form-horizontal">
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
      <input type="text" name="id_pelanggan" id="autoidtransaksi2" class="form-control" placeholder="Masukkan ID Pelanggan" required="">
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
              <form method="POST" action="<?php echo site_url('pesan/checkout_action');?>">
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
                                    <strong><span name="nama_pelanggan" id="nama_pelanggan">Nama Pelanggan</span></strong>
                                    <br><span name="nama_dagang" id="nama_dagang">Nama Dagang</span>
                                    <br><span name="alamat" id="alamat">Alamat</span>
                                    <br>Telp : <span name="no_telp" id="no_telp"></span>
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
                    <b>ID Pelanggan:</b> <span name="idpelanggan" id="idpelanggan">ID Pelanggan</span>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                  <?php $i = 1; ?>
                <?php foreach($this->cart->contents() as $items): ?>

                <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <input type="hidden" name="idpesan[]" value="<?php echo rand(1,10000);?>">
								<input type="hidden" name="hutang" value="<?php echo $this->session->userdata('total_belanja') ?>">
								<input type="hidden" name="diskon" value="<?php echo $this->session->userdata('diskon') ?>">
                  <input type="hidden" name="id_transaksi_hutang" id="id_transaksi_hutang" value="<?php echo $generate_invoice; ?>">
                  <input type="hidden" name="id" id="id" class="form-control">
                  <input type="hidden" name="id_transaksi[]" readonly value="<?php echo $items['id_transaksi'];?>">
                  <input type="hidden" name="wp_barang_id[]" readonly value="<?php echo $items['wp_barang_id'];?>">
                  <input type="hidden" name="subtotal[]" value="<?php echo $this->session->userdata('total_belanja') ?>"></td>
                  <input type="hidden" name="harga[]" value="<?php echo $items['price'];?>"></td>

                  <input type="hidden" readonly value="<?php echo $items['id'];?>" style="border:0px;background:none;">
                  <input type="hidden" readonly value="<?php echo $items['name'];?>" style="border:0px;background:none;">
                  <input type="hidden" name="qty[]" readonly size="1" value="<?php echo $items['qty']; ?>" style="border:0px;background:none;">

                  <?php $i++; ?>
                  <?php endforeach; ?>

                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table">
                    <table class="table table-striped jambo_table dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID Produk</th>
                          <th>Nama Barang</th>
                          <th>Harga (Rp.)</th>
                          <th>QTY</th>
													<th>Satuan</th>
                          <th>Subtotal (Rp.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($this->cart->contents() as $items): ?>

                        <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

                        <tr <?php if($i&1){ echo 'class="alt"'; }?>>
                          <td>
                            <?php echo $items['id'];?>
                          </td>
                          <td>
                            <?php echo $items['name'];?>
                          </td>
                          <td>
                            Rp. <?php echo $this->cart->format_number($items['price'],2,'.','.'); ?>
                          </td>
                          <td>
                            <?php echo $items['qty']; ?>
                          </td>
													<td>
                            <?php echo $items['satuan']; ?>
                          </td>
                          <td>
                            Rp. <?php echo $this->cart->format_number($items['subtotal']); ?>
                          </div>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
												<tr>
														<td colspan="5"><strong>Diskon</strong></td>
														<td><?php
														$diskon = $this->session->userdata('diskon');
														 echo 'Rp. &nbsp;';  echo number_format($diskon,2,',','.') ?></td>
												</tr>
                        <tr>
                          <td colspan="5"><strong>Total</strong></td>
                          <td>Rp. <?php  echo number_format($this->session->userdata('total_belanja'),2,',','.')?></td>
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
                          <?php echo '<input type="radio" name="wp_status_id" id="'.$value->id.'" required value="'.$value->id.'"> '.$value->nama_status.'
                                      <br>
                          '; ?>
                        <?php
                        } ?>
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="text col-md-6 col-xs-12">
                    <p class="lead">Pembayaran</p>
                    <div class="form-group">
                      <label for="">Jumlah Bayar</label>
                      <input type="text" name="bayar" placeholder="Rp." class="form-control" value="0">
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                    <a href="<?php echo base_url('pesan')?>" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Back</a>
                  </div>
                </div>
              </section>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php
				endif;
			?>
