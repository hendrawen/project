<div class="x_panel">
  <div class="x_title">
    <h2>Form <?php echo $button ?></h2>
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
    <br>
    <form action="<?php echo $action; ?>" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
      <div class="class-row">
        <div class="col-md-12 form-group">
          <div class="form-group">
            <label>ID/Nama Pelanggan</label>
            <select name="wp_pelanggan_id" id="wp_pelanggan_id" class="form-control js-example-basic-single" required>
            <option disabled selected>--Pilih Pelanggan--</option>

                <?php
                  $users = $this->db->query("SELECT * FROM wp_pelanggan Where status='Pelanggan'");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($wp_pelanggan_id == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                  <?php echo $value->id_pelanggan; ?> - <?php echo $value->nama_pelanggan; ?>
                  </option>
                  <?php }?>
                    </select>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <select name="barang" id="barang" class="form-control">
            <option value="" selected>--Pilih Barang--</option>

                <?php
                  $users = $this->db->query("SELECT * FROM wp_barang");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($barang == $value->nama_barang){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->nama_barang; ?>"  <?php echo $selected;?> >
                  <?php echo $value->id_barang; ?> - <?php echo $value->nama_barang; ?>
                  </option>
                  <?php }?>
                    </select>
          </div>
          <div class="form-group">
            <label>QTY</label>
            <input type="number" class="form-control" name="qty" value="<?php echo $qty; ?>">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <select class="form-control" name="satuan">
              <option>--Satuan--</option>
              <option <?php if( $satuan=='Krat'){echo "selected"; } ?> value="Krat">Krat</option>
              <option <?php if( $satuan=='Dus'){echo "selected"; } ?> value="Dus">Dus</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal Kirim</label>
            <input type="date" class="form-control" name="tgl_kirim" value="<?php echo $tgl_kirim; ?>">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="wp_status_effectif_id" id="wp_status_effectif_id" class="form-control">
            <option selected>--Status--</option>

                <?php
                  $users = $this->db->query("SELECT * FROM wp_status_effectif");
                  foreach($users->result() as $value){
                  $selected= '';
                  if($wp_status_effectif_id == $value->id){
                    $selected = 'selected="selected"';
                  }
                  ?>
                  <option  value="<?php echo $value->id; ?>"  <?php echo $selected;?> >
                  <?php echo $value->status; ?>
                  </option>
                  <?php }?>
                    </select>
          </div>
          <div class="form-group">
            <label>Sumber Data</label>
            <select name="sumber_data" id="sumber_data" class="form-control">
              <option selected>--Sumber Data--</option>
              <option <?php if( $sumber_data=='Due Date'){echo "selected"; } ?> value="Due Date">Due Date</option>
              <option <?php if( $sumber_data=='Biru'){echo "selected"; } ?> value="Biru">Biru</option>
              <option <?php if( $sumber_data=='Kuning'){echo "selected"; } ?> value="Kuning">Kuning</option>
              <option <?php if( $sumber_data=='Ijo'){echo "selected"; } ?> value="Ijo">Ijo</option>
              <option <?php if( $sumber_data=='Pink'){echo "selected"; } ?> value="Pink">Pink</option>
            </select>
          </div>
          <div class="form-group">
            <label>Melalui</label>
            <select name="by_status" id="by_status" class="form-control">
              <option selected>--Pilih--</option>
              <option <?php if( $by_status=='Call'){echo "selected"; } ?>  value="Call">Call</option>
              <option <?php if( $by_status=='Kunjungan'){echo "selected"; } ?> value="Kunjungan">Kunjungan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?php echo $keterangan; ?></textarea>
          </div>
          <input type="hidden" value="<?php echo $id; ?>" name="id"/>
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
          <div class="text-right">
            <a href="<?php echo base_url('som/takeorder')?>" type="button" class="btn btn-default" >Kembali</a>
            <button type="submit" class="btn btn-success"><?php echo $button ?></button>
          </div>
        </div>
      </div>
      </form>
  </div>
</div>
