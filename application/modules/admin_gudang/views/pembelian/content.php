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
                <input type="text" id="id_track" class="form-control" placeholder="Masukkan ID Pelanggan" name="id_track" required="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group text-right">
                <button id="button" class="btn btn-success"><i class="fa fa-search"></i> Cek</button>
              </div>
            </div>
            <div class="row">
              <div class="table-responsive">
              <table class="table jambo_table table-bordered dt-responsive nowrap" id="tabel_cari" style="display: none;">
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
                    <tbody id="result">
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
          <form action="<?php echo base_url(). 'dep/track_pembayaran'; ?>" method="post">
            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
              <label for="fullname">Tanggal Transaksi * :</label>
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
              <input type="text" name="bayar" id="bayar" class="form-control" onkeyup="FormatCurrency(this)" autocomplete="off" placeholder="Masukkan jumlah bayar" required>
            </div>
            <!-- <input type="hidden" name="sudah" id="sudah"> -->
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" id="id" name="id" />
            <div class="form-group text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i> Bayar</button>
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
