<div class="x_panel">
  <div class="x_title">
    <h2>Aset <small>Data Aset</small></h2>
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
    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <?php echo anchor(site_url('delivery/penarikan'),'<i class="fa fa-plus"></i> Create', 'class="btn btn-primary"'); ?>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ?
                '<div class="alert alert-success">'.$this->session->userdata('message').'</div>'
                 : ''; ?>
            </div>
        </div>

    </div>

    <div class="table-responsive">
      <table id="datatable" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
                <th>No. Faktur</th>
                <th>Tgl Kirim</th>
                <th>Jatuh Tempo</th>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Nama Barang</th>
                <th>qty</th>
                <th>Satuan</th>
                <th style="wider_kelurahan">Kelurahan</th>
                <th style="wider_kecamatan">Kecamatan</th>
                <th>No. telp</th>
                <th>Surveyor</th>
                <th>Debt</th>
                <th>Jumlah</th>
                <th>Tgl Penarikan</th>
                <th>Bayar</th>
                <th>Tgl Penarikan</th>
                <th>Bayar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
            foreach ($aset_data as $aset)
            {
                ?>
                <tr>
                  <td><?php echo $aset->id_transaksi ?></td>
                  <td><?php echo tgl_indo($aset->tgl_transaksi) ?></td>
                  <td><?php echo tgl_indo($aset->jatuh_tempo) ?></td>
                  <td><?php echo $aset->id_pelanggan ?></td>
                  <td><?php echo $aset->nama_pelanggan ?></td>
                  <td><?php echo $aset->nama_barang ?></td>
                  <td><?php echo $aset->qty ?></td>
                  <td><?php echo $aset->satuan ?></td>
                  <td><?php echo $aset->kelurahan ?></td>
                  <td><?php echo $aset->kecamatan ?></td>
                  <td><?php echo $aset->no_telp ?></td>
                  <td><?php echo $aset->nama ?></td>
                  <td><?php echo $aset->username ?></td>
                  <td><?php echo $aset->jumlah ?></td>
                  <td><?php echo tgl_indo($aset->tgl_penarikan) ?></td>
                  <td><?php echo $aset->bayar_krat ?></td>
                  <td><?php echo tgl_indo($aset->tgl_penarikan) ?></td>
                  <td><?php echo $aset->bayar_uang ?></td>
                  <!-- <td style="text-align:center" width="200px">
                    <?php
                    echo anchor(site_url('delivery/update/'.$aset->id), '<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update</button>');
                    echo '&nbsp;';
                    echo anchor(site_url('delivery/delete/'.$aset->id),'<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                    ?>
                  </td> -->
                </tr>
                <?php
            }
            ?>
          </tbody>
      </table>
    </div>
      </div>
    </div>
