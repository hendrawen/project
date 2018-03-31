<div class="row">
  <form action="#" id="form_faktur" method="POST" class="form-horizontal">
  <div class="col-md-3 col-sm-12 col-xs-12 form-group">
    <select name="id_transaksi" id="id_transaksi" class="e1 form-control" required>
    <option disabled selected>--Pilih Id Transaksi--</option>
        <?php
          //$users = $this->db->query("SELECT * FROM wp_detail_transaksi");
          //foreach($users->result() as $value){
          //$selected= '';
            foreach ($query as $value) {
            $selected= '';
          ?>
          <option  value="<?php echo $value->id_transaksi; ?>"  <?php echo $selected;?> >
          <?php echo $value->id_transaksi; ?> - <?php echo $value->nama_pelanggan; ?>
          </option>
    <?php } ?>
    </select>
  </div>
  <input type="hidden" name="id" id="id" class="form-control">
  <input type="hidden" name="nama_barang" id="nama_barang" class="form-control">
  <input type="hidden" name="harga" id="harga" class="form-control">
  <input type="hidden" name="qty" id="qty" class="form-control">
  <!-- <input type="hidden" name="subtotal" id="subtotal" class="form-control"> -->
  <input type="hidden" name="bayar" id="bayar" class="form-control">
  <input type="hidden" name="utang" id="utang" class="form-control">
  <div class="col-md-2 col-sm-12 col-xs-12 form-group text-leftt">
      <button type="button"  class="add_faktur btn btn-success"><i class="fa fa-shopping-cart"></i> Tambah</button>
  </div>
</form>

</div>
  <div class="row">
        <div class="col-md-12">
          <div class="x_panel" style="border: 1px solid #ccc">
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
             <!-- <form action="<?php echo base_url('faktur/simpan_faktur');?>" method="post">
               <?php $i = 1; ?>
               <?php foreach($this->cart->contents() as $items): ?>
               <?php echo form_hidden('rowid[]', $items['rowid']); ?>
               <?php if($i&1){ echo 'class="alt"'; }?>
               <input type="hidden" name="no_faktur[]" readonly value="<?php echo $generate_faktur; ?>" style="border:0px;background:none;">
               <input type="hidden" name="wp_detail_transaksi_id[]" readonly value="<?php echo $items['wp_detail_transaksi_id'];?>" style="border:0px;background:none;">
               <input type="hidden" name="id" id="id" class="form-control">
               <input type="hidden" name="idfaktur[]" value="<?php echo rand(1,10000);?>">
               <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
               <?php $i++; ?>
               <?php endforeach; ?> -->
              <div class="row">
                <div class="col-xs-12 invoice-header">
                  <h1>
                                  <i class="fa fa-globe"></i> FAKTUR
                                  <small class="pull-right"></small>
                            </h1>
                </div>
                <!-- /.col -->
              </div>
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
                      <br>Telp: <span name="no_telp" id="no_telp"></span>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>No.Faktur    : <?php echo $generate_faktur; ?></b>
                  <br>
                  <b>ID Pelanggan : </b> <span name="id_pelanggan" id="id_pelanggan"></span>
                  <br>
                  <!-- <b>Tgl Transaksi : </b> <span name="tgl_transaksi" id="tgl_transaksi"></span> -->
                  <br>
                </div>
              </div>
              <!-- /.row -->

              <section class="content invoice">
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table">
                    <table class="table table-striped jambo_table dt-responsive nowrap">
                      <thead>
                        <tr>
                          <!-- <th>Id</th> -->
                          <th>Nama Barang</th>
                          <th>Harga</th>
                          <th>Qty</th>
                          <th>Total</th>
                          <th>Bayar</th>
                          <th>Hutang</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="detail_faktur">
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- this row will not appear when printing -->
                <br><br>
                <div class="row no-print">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Simpan</button>
                  </div>
                </div>
                <div class="row no-print">
                  <div class="col-xs-12">
                      <strong><span style="margin-left:40px;">Diterima,</span></strong><br><br><br><br>
                      <strong><span style="margin-left:27px;" name="nama_pelanggan" id="nama_pelanggan">Nama Pelanggan</span></strong><br>
                      <span>(Tanda Tangan & Stempel)</span>
                  </div>
                </div>
              </section>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>
