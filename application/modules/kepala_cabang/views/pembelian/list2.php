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
            <?php echo anchor(site_url('dep/delivery/create'),'<i class="fa fa-plus"></i> Create', 'class="btn btn-primary"'); ?>
        </div>
    </div>

    <div class="table-responsive">
      <table id="datatable" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
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
                <th>Pelanggan</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
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
                  <td><?php echo $aset->nama_pelanggan ?></td>
                  <td style="text-align:center" width="200px">
                    <?php
                    echo anchor(site_url('dep/delivery/update/'.$aset->id), '<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update</button>');
                    echo '&nbsp;';
                    echo anchor(site_url('dep/delivery/delete/'.$aset->id),'<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                    ?>
                  </td>
                </tr>
                <?php
            }
            ?>
          </tbody>
      </table>
    </div>
      </div>
    </div>
