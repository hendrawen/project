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

<div class="row">
  <form action="#" id="form_barang" class="form-horizontal">
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    <label for="varchar">Nama Suplier </label>
    <select name="wp_suplier_id" id="wp_suplier_id" class="e1 form-control" required>
    <option disabled selected>--Nama Suplier--</option>
        <?php
          $users = $this->db->query("SELECT * FROM wp_suplier");
          foreach($users->result() as $value){
          $selected= '';
          ?>
          <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
          <?php echo $value->id_suplier; ?> - <?php echo $value->nama_suplier; ?>
          </option>
    <?php } ?>
    </select>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    <label for="varchar">Id Barang </label>
    <select name="id_barang" id="id_barang" class="e1 form-control" required>
    <option disabled selected>--ID Barang--</option>
        <?php
          $users = $this->db->query("SELECT * FROM wp_barang");
          foreach($users->result() as $value){
          $selected= '';
          ?>
          <option  value="<?php echo $value->id_barang; ?>"  <?php echo $selected;?> >
          <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
          </option>
    <?php } ?>
    </select>
  </div>
  <!-- <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?php echo $generate_invoice; ?>"> -->
  <input type="hidden" name="id" id="id" class="form-control">
  <input type="hidden" name="nama_barang" id="nama_barang" placeholder="Nama Barang" readonly class="form-control" required>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
      <label for="varchar">Satuan </label>
      <select class="form-control" name="satuan2" id="satuan2" required>
            <option disabled selected>--Pilih Satuan--</option>
            <option value="Krat" <?php if ($satuan=='Krat') {echo "selected";}?>>Krat</option>
            <option value="Dus" <?php if ($satuan=='Dus') {echo "selected";}?>>Dus</option>
      </select>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
      <label for="varchar">Harga </label>
      <input type="number" name="harga" id="harga" placeholder="Harga" class="form-control" onkeyup="isiSubtotal()" required>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
      <label for="varchar">QTY </label>
      <input type="number" name="qty" id="qty" value="1" placeholder="QTY" class="form-control" onkeyup="isiSubtotal()" required>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
      <label for="varchar">Jumlah </label>
      <input type="number" name="subtotal" id="subtotal" placeholder="subtotal" class="form-control" onloadstart="FormatCurrency(this)" readonly required>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
      <button type="button"  class="add_cart btn btn-success"><i class="fa fa-shopping-cart"></i> Tambah</button>
  </div>
</form>
</div>

<form class="" action="<?php echo site_url('pembelian/checkout_action');?>" method="post">
  <?php $i = 1; ?>
  <?php foreach($this->cart->contents() as $items): ?>

  <?php echo form_hidden('rowid[]', $items['rowid']); ?>
  <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
  <!-- <input type="text" name="idpesan[]" value="<?php echo rand(1,10000);?>"> -->
    <!-- <input type="text" name="id" id="id" class="form-control"> -->
    <!-- <input type="text" name="id_transaksi" value="<?php echo $generate_invoice; ?>"> -->
    <input type="hidden" name="satuan[]" readonly value="<?php echo $items['satuan'];?>">
    <input type="hidden" name="wp_barang_id[]" readonly value="<?php echo $items['wp_barang_id'];?>">
    <input type="hidden" name="wp_suplier_id[]" readonly value="<?php echo $items['wp_suplier_id'];?>">
    <input type="hidden" name="subtotal[]" value="<?php echo $items['subtotal']; ?>"></td>
    <input type="hidden" name="harga[]" value="<?php echo $items['price'];?>"></td>
    <input type="hidden" readonly value="<?php echo $items['id'];?>" style="border:0px;background:none;">
    <input type="hidden" readonly value="<?php echo $items['name'];?>" style="border:0px;background:none;">
    <input type="hidden" name="qty[]" readonly size="1" value="<?php echo $items['qty']; ?>" style="border:0px;background:none;">

    <?php $i++; ?>
    <?php endforeach; ?>

  <div class="row">
        <div class="col-md-12 col-xs-12">
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
                <!-- Table row -->
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="table-responsive">
                    <table class="table table-striped jambo_table dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID Produk</th>
                          <th>Product</th>
                          <th>Harga (Rp.)</th>
                          <th>QTY</th>
                          <th>Satuan</th>
                          <th>Subtotal (Rp.)</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="detail_cart">
                      </tbody>
                    </table>
                  </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <div class="row no-print">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Simpan</button>
                    <button type="button" class="hapus_cart btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-upload"></i> Hapus Semua</button>
                    <a href="<?php echo site_url('pembelian') ?>" class="btn btn-danger pull-right">Kembali</a>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
<form>
      <script type="text/javascript">
          function isiSubtotal(){
            var harga = document.getElementById('harga').value;
            var qty = document.getElementById('qty').value;
            document.getElementById('subtotal').value = harga * qty;
            }
          </script>
