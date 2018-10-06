<div class="row">
  <div class="col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Buttons <small>Sessions</small></h2>
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

                  <div class="col-sm-12">

                      <div class="col-md-8 col-sm-12 col-xs-12 form-group">
                        <div class="input-group">
                           <input type="text" name="id_transaksi" id="autopelanggan" class="form-control" placeholder="Input Id Pelanggan" required>
                           <span class="input-group-btn">
                               <button type="button" id="button_pelanggan" class="btn btn-primary">Add</button>
                           </span>
                         </div>
                      </div>

                <div class="divider-dashed"></div>
                  <div class="x_content">

                  <form class="form-horizontal" action="#" method="post">
                      <br>
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
                            } ?><br>
                              <!-- <br>Tgl Kirim   : <span name="tgl_transaksi" id="tgl_transaksi">Tgl Transaksi</span> -->
                              <br>Jatuh Tempo : <span name="jatuh_tempo" id="jatuh_tempo">Jatuh Tempo</span>
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
                        <br>Kelurahan : <span name="kelurahan" id="kelurahan"></span>
                        <br>Kecamatan : <span name="kecamatan" id="kecamatan"></span>
                        <br>GPS : <span name="lat" id="lat"></span>&nbsp;<span name="long" id="long"></span>
                        <br>Surveyor : <span name="nama" id="nama"></span>
                        <br>
                      </div>
                    </div>
            </form>
            <div class="table-responsive">
              <table class="table jambo_table table-bordered dt-responsive nowrap" id="tabel_pelanggan" style="display: none;">
                    <thead>
                      <th>Id Transaksi</th>
                      <th>Tanggal Transaksi</th>
                      <th>Nama Barang</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th>Diskon</th>
                      <th>Hutang</th>
                      <th>Bayar</th>
                      <th>Sisa Hutang</th>
                    </thead>
                    <tbody id="result">
                    </tbody>
                    </table>
                  </div>
                    <br><br>
                    <div class="row no-print">
                      <div class="col-xs-12">
                          <strong><span style="margin-left:40px;">Diterima,</span></strong><br><br><br><br>
                          <strong><span name="nama_pelanggan" id="nama_pelanggan"></span></strong><br>
                          <span>(Tanda Tangan & Stempel)</span>
                      </div>
                    </div>

                  </div>
                    <div class="row no-print">
                      <div class="col-xs-12">
                        <!--<button type="submit" class="btn btn-primary pull-right" id="printButton" onclick="javascript:void(0);"><i class="fa fa-print"></i> Simpan & Cetak</button> -->
                        <a href="javascript:void(0);" id="printButton" class="btn btn-primary pull-right">Save & Print</a>
                      </div>
                    </div>

                  </div>
            </div>
      </div>
</div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="assets/jquery-1.10.2.js" type="text/JavaScript" language="javascript"></script>
    <script src="assets/jquery-ui-1.10.4.custom.js"></script>
    <script src="assets/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
    <script type="text/javascript">

    $(document).ready(function(){
	      function search(){
	         var judul=$("#id_transaksi").val();
	          if(judul!=""){
	              $("#result").html("<img src='<?=base_url()?>assets/ajax-loader.gif'/>");
	                $.ajax({
	                       type : "POST",
               				url  : '<?php echo base_url();?>faktur2/cari_faktur',
	                    data:"judul="+judul,

	                    success:function(data){
	                      $("#result").html(data);
	                      $("#id_transaksi").val("");
	                    }
	             });
               $('#tabel_cari').show();
	          }
	      }

	      $("#button").click(function(){
	          search();
	      });

	      $('#id_transaksi').keyup(function(e) {
	          if(e.keyCode == 13) {
	             search();
	          }
	      });
      });

      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;

          document.body.innerHTML = printContents;

          window.print();

          document.body.innerHTML = originalContents;
      }

        $("#printButton").click(function(){
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("div.x_content").printArea( options );
        });

    </script>
