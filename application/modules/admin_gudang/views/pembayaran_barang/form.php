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
                    <form action="<?php echo base_url(). 'pembayaran/update_action'; ?>" method="post">
                      <div class="form-group">
                        <label for="fullname">ID Pelanggan * :</label>
                        <input type="text" id="title" class="form-control" placeholder="Masukkan ID Pelanggan" name="id_pelanggan" required="">
                      </div>
                      <div class="form-group">
                        <label for="fullname">ID Transaksi :</label>
                        <input type="text" id="id_transaksi" class="form-control" placeholder="ID Transaksi" name="id_transaksi" readonly>
                      </div>
                      <div class="form-group">
                        <label for="fullname">Sisa Hutang (Rp.):</label>
                        <input type="text" id="hutang" class="form-control" onloadstart="FormatCurrency(this)" placeholder="Total Hutang" name="hutang" readonly>
                      </div>
                      <div class="form-group">
                        <label for="bayar">Bayar (Rp.) *</label>
                        <input type="text" name="bayar" id="bayar" class="form-control" onkeyup="FormatCurrency(this)" placeholder="Masukkan jumlah bayar" required>
                      </div>
                      <input type="hidden" name="sudah" id="sudah">
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                      <input type="hidden" id="id" name="id" />
                      <div class="form-group text-right">
                        <button type="button" class="btn btn-default">Batal</button>
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
