<a href="<?php echo base_url('jenis_kebutuhan/tambah')?>" type="button" class="btn btn-success" ><i class="fa fa-user"></i> Tambah</a>
<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-group"></i> Data Jenis Kebutuhan</h2>
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
<table id="datatable" class="table table-striped jambo_table table-bordered bulk_action" style="margin-bottom: 10px">
  <thead>
    <tr>
        <th>No</th>
        <th>Jenis</th>
        <th>Created</th>
        <th>Updated</th>
        <th style="text-align:center" width="200px">Action</th>
    </tr>
  </thead>
    <?php
    foreach ($jenis_kebutuhan_data as $jenis_kebutuhan)
    {
        ?>
        <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $jenis_kebutuhan->jenis ?></td>
            <td><?php echo $jenis_kebutuhan->created_at ?></td>
            <td><?php echo $jenis_kebutuhan->updated_at ?></td>
            <td style="text-align:center" width="200px">
              <a href="<?php echo base_url('jenis_kebutuhan/update/'.$jenis_kebutuhan->id) ?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
              <a type="button" href="<?php echo base_url('jenis_kebutuhan/delete/'.$jenis_kebutuhan->id) ?>" title="Hapus" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<!-- <div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
</div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div> -->
</div>
</div>
