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
    <h2>Dev Muat <small>Data Muat</small></h2>
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
            <?php echo anchor(site_url('dep/muat/create'),'<i class="fa fa-plus"> Create</i>' , 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <div class="table-responsive">
      <table id="datatable" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
                <th>No</th>
                <th>Muat Krat</th>
                <th>Muat Dust</th>
                <th>Terkirim Krat</th>
                <th>Terkirim Botol</th>
                <th>Kembali Krat</th>
                <th>Kembali Botol</th>
                <th>Retur Krat</th>
                <th>Keterangan</th>
                <th>Created At</th>
                <th>Username</th>
                <th>Nama Barang</th>
                <th>Nama Gudang</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $start = 0;
            foreach ($muat_data as $muat)
            {
                ?>
                <tr>
                  <td width="80px"><?php echo ++$start ?></td>
                  <td><?php echo $muat->muat_krat ?></td>
                  <td><?php echo $muat->muat_dust ?></td>
                  <td><?php echo $muat->terkirim_krat ?></td>
                  <td><?php echo $muat->terkirim_btl ?></td>
                  <td><?php echo $muat->kembali_krat ?></td>
                  <td><?php echo $muat->kembali_btl ?></td>
                  <td><?php echo $muat->retur_krat ?></td>
                  <td><?php echo $muat->keterangan ?></td>
                  <td><?php echo $muat->created_at ?></td>
                  <td><?php echo $muat->username ?></td>
                  <td><?php echo $muat->nama_barang ?></td>
                  <td><?php echo $muat->nama_gudang ?></td>
                  <td style="text-align:center" width="200px">
                    <?php
                    echo anchor(site_url('dep/muat/update/'.$muat->id), '<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"> Update</i></button>');
                    echo '&nbsp;';
                    echo anchor(site_url('dep/muat/delete/'.$muat->id),'<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"> Hapus</i></button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
