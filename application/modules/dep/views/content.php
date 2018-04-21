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
          <form action="<?php echo base_url(). 'pembayaran/update_action'; ?>" method="post">
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label for="fullname">ID Pelanggan * :</label>
              <input type="text" id="title" class="form-control" placeholder="Masukkan ID Pelanggan" name="id_pelanggan" required="">
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label for="fullname">ID Transaksi :</label>
              <input type="text" id="id_transaksi" class="form-control" placeholder="ID Transaksi" name="id_transaksi" readonly>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label for="bayar">Jumlah Hutang (Rp.) *</label>
              <input type="text" name="jumlah" id="jumlah" class="form-control" onloadstart="FormatCurrency(this)" placeholder="Jumlah Hutang" readonly>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label for="fullname">Sisa Hutang (Rp.):</label>
              <input type="text" id="hutang" class="form-control" onloadstart="FormatCurrency(this)" placeholder="Total Hutang" name="hutang" readonly>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
              <label for="bayar">Bayar (Rp.) *</label>
              <input type="text" name="bayar" id="bayar" class="form-control" onkeyup="FormatCurrency(this)" placeholder="Masukkan jumlah bayar" required>
            </div>
            <input type="hidden" name="sudah" id="sudah">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" id="id" name="id" />
            <div class="form-group text-right">
              <button type="submit" class="btn btn-success">Bayar</button>
            </div>
          </form>
          <!-- end form for validations -->

        </div>
      </div>

      <script type="text/javascript">

      function FormatCurrency(objNum)
    {
       var num = objNum.value
       var ent, dec;
       if (num != '' && num != objNum.oldvalue)
       {
         num = HapusTitik(num);
         if (isNaN(num))
         {
           objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
         } else {
           var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
           if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
           {
             alert(num.split('.')[1]);
             objNum.value = TambahTitik(num.split('.')[0])+'.'+num.split('.')[1];
           }
           else
           {
             objNum.value = TambahTitik(num.split('.')[0]);
           }
           objNum.oldvalue = objNum.value;
         }
       }
    }
    function HapusTitik(num)
    {
       return (num.replace(/\./g, ''));
    }

    function TambahTitik(num)
    {
       numArr=new String(num).split('').reverse();
       for (i=3;i<numArr.length;i+=3)
       {
         numArr[i]+='.';
       }
       return numArr.reverse().join('');
    }

    function formatCurrency(num) {
       num = num.toString().replace(/\$|\./g,'');
       if(isNaN(num))
       num = "0";
       sign = (num == (num = Math.abs(num)));
       num = Math.floor(num*100+0.50000000001);
       cents = num0;
       num = Math.floor(num/100).toString();
       for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
       num = num.substring(0,num.length-(4*i+3))+'.'+
       num.substring(num.length-(4*i+3));
       return (((sign)?'':'-') + num);
    }
  </script>

                <div class="x_panel">
                    <div class="x_title">
                      <h2>List Jadwal Pengiriman</h2>
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
                  <ul class="list-unstyled timeline">
                    <?php foreach ($jadwal as $key): ?>
                      <li>
                        <div class="block">
                          <div class="tags">
                            <a target="_blank" href="https://maps.google.com?q=<?php echo $key->lat .',' .$key->long ?>" class="tag">
                              <span><i class="fa fa-map-marker"></i> Map</span>
                            </a>
                          </div>
                          <div class="block_content">
                            <h2 class="title">
                                            <a href="<?php echo base_url('dep/detail/'.$key->id_pelanggan); ?>"><i class="fa fa-user"></i> <?php echo $key->id_pelanggan; ?>  <?php echo $key->nama_pelanggan; ?> </a>
                                        </h2>
                            <div class="byline">
                              <span>Tanggal Kirim</span> <i class="fa fa-truck"></i> <b><?php echo tgl_indo($key->start); ?></b>
                            </div>
                            <p class="excerpt">
                              <i class="fa fa-building"></i> Alamat: <?php echo $key->alamat ?>
                              <br>
                              <i class="fa fa-phone"></i> No. telp. #: <?php echo $key->no_telp ?>
                              <br>
                              <?php echo $key->title ?>
                              <br>
                              <?php echo $key->description ?>
                              <br>
                            </p>
                          </div>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>

                </div>
                  </div>
