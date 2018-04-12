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
            <?php echo anchor(site_url('aset/create'),'Create', 'class="btn btn-primary"'); ?>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-1 text-right">
        </div>
        <div class="col-md-3 text-right">
            <form action="<?php echo site_url('aset/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('aset'); ?>" class="btn btn-default">Reset</a>
                                <?php
                            }
                        ?>
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Turun Krat</th>
<th>Turun Btl</th>
<th>Naik Krat</th>
<th>Naik Btl</th>
<th>Aset Krat</th>
<th>Aset Btl</th>
<th>Bayar</th>
<th>Keterangan</th>
<th>Username</th>
<th>Wp Pelanggan Id</th>
<th>Action</th>
        </tr><?php
        foreach ($aset_data as $aset)
        {
            ?>
            <tr>
  <td width="80px"><?php echo ++$start ?></td>
  <td><?php echo $aset->tanggal ?></td>
  <td><?php echo $aset->jam ?></td>
  <td><?php echo $aset->turun_krat ?></td>
  <td><?php echo $aset->turun_btl ?></td>
  <td><?php echo $aset->naik_krat ?></td>
  <td><?php echo $aset->naik_btl ?></td>
  <td><?php echo $aset->aset_krat ?></td>
  <td><?php echo $aset->aset_btl ?></td>
  <td><?php echo $aset->bayar ?></td>
  <td><?php echo $aset->keterangan ?></td>
  <td><?php echo $aset->username ?></td>
  <td><?php echo $aset->wp_pelanggan_id ?></td>
  <td style="text-align:center" width="200px">
    <?php
    echo anchor(site_url('aset/read/'.$aset->id),'Read');
    echo ' | ';
    echo anchor(site_url('aset/update/'.$aset->id),'Update');
    echo ' | ';
    echo anchor(site_url('aset/delete/'.$aset->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
    ?>
  </td>
</tr>
            <?php
        }
        ?>
    </table>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
<?php echo anchor(site_url('aset/excel'), 'Excel', 'class="btn btn-primary"'); ?>
  </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>
        </div>
    </div>

  </div>
</div>
