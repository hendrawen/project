
  <div class="x_panel">
      <div class="x_title">
        <h2><?php echo $button ?> Barang </h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
            <form action="<?php echo $action; ?>" method="post">
              <?php
                    if ($button == 'Create') {
                ?>
                    <input type="hidden" class="form-control" name="id_transaksi" id="id_transaksi" placeholder="Id Transaksi" />
                <?php } elseif ($button == 'Update') {
                ?>
                <label for="varchar">Id Transaksi</label>
                    <input type="text" class="form-control" name="id_transaksi" id="id_transaksi" value="<?php echo $id_transaksi; ?>" readonly />
                <?php } ?>
        	    <div class="form-group">
                    <label for="varchar">Nama Barang <?php echo form_error('wp_barang_id') ?></label>
                    <select name="wp_barang_id" id="wp_barang_id" class="form-control" required>
                    <option disabled selected>--Pilih Nama Barang--</option>

                        <?php
                          $users = $this->db->query("SELECT * FROM wp_barang");
                          foreach($users->result() as $value){
                          $selected= '';
                          if($wp_barang_id == $value->id){
                            $selected = 'selected="selected"';
                          }
                          ?>
                          <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                          <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
                          </option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                        <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
                        <select class="form-control" name="satuan" id="satuan">
                              <option disabled selected>--Pilih Satuan--</option>
                              <option value="Krat" <?php if ($satuan=='Krat') {echo "selected";}?>>Krat</option>
                              <option value="Dus" <?php if ($satuan=='Dus') {echo "selected";}?>>Dus</option>
                        </select>
                    </div>
                  <div class="form-group">
                        <label for="varchar">Harga <?php echo form_error('harga') ?></label>
                        <input type="number" class="form-control" name="harga" id="harga" min="0" placeholder="Harga" value="<?php echo $harga; ?>" onkeyup="isiSubtotal() FormatCurrency(this)"/>
                    </div>
                  <div class="form-group">
                        <label for="varchar">QTY <?php echo form_error('qty') ?></label>
                        <input type="number" class="form-control" name="qty" id="qty" min="1" placeholder="Qty" value="<?php echo $qty; ?>" onkeyup="isiSubtotal()"/>
                    </div>
                    <div class="form-group">
                          <label for="varchar">Jumlah <?php echo form_error('subtotal') ?></label>
                          <input type="number" class="form-control" name="subtotal" id="subtotal" min="0" placeholder="Jumlah" value="<?php echo $subtotal; ?>" onloadstart="FormatCurrency(this)" readonly/>
                      </div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" />
        	    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
        	    <a href="<?php echo site_url('pembelian') ?>" class="btn btn-danger">Kembali</a>
        	</form>
      </div>
    </div>

<script type="text/javascript">

    function isiSubtotal(){
      var harga = document.getElementById('harga').value;
      var qty = document.getElementById('qty').value;
      document.getElementById('subtotal').value = harga * qty;
    }

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
