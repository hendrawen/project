<div class="row">
  <form action="#" id="form_checkout" class="form-horizontal">
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
      <select name="id_pelanggan" id="id_pelanggan" class="e1 form-control" required>
      <option disabled selected>--Pilih Pelanggan--</option>
          <?php
            $users = $this->db->query("SELECT * FROM wp_pelanggan");
            foreach ($users->result() as $value) {
                $selected= '';
                if ($wp_pelanggan_id == $value->id_pelanggan) {
                    $selected = 'selected="selected"';
                } ?>
            <option  value="<?php echo $value->id_pelanggan; ?>"  <?php echo $selected; ?> >
            <?php echo $value->id_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?>
            </option>
      <?php
            } ?>
      </select>
    </div>
</form>
</div>
  <div class="row">
        <div class="col-md-12">
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
            <div class="x_content">

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
                    <b>Invoice #<?php echo $generate_invoice; ?></b>
                    <br>
                    <br>
                    <b>Order ID:</b> 4F3S8J
                    <br>
                    <b>Payment Due:</b> 2/22/2014
                    <br>
                    <b>Account:</b> 968-34567
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table">
                    <table class="table table-striped jambo_table dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID Produk</th>
                          <th>Product</th>
                          <th>QTY</th>
                          <th>Subtotal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="detail_cart">
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-md-6 col-sm-12">
                    <p class="lead">Jenis Pembayaran:</p>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      <label>
                        <input type="radio" class="flat" checked name="iCheck"> Lunas
                      </label>
                      <br>
                      <label>
                          <input type="radio" class="flat" name="iCheck"> Utang
                      </label>
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6 col-sm-12">
                    <p class="lead">Pembayaran</p>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <label for="">Jumlah Bayar</label>
                      <input type="text" placeholder="Rp." class="form-control">
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <label for="">Kembalian</label>
                      <input type="text" placeholder="Rp." class="form-control" readonly>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Back</button>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
