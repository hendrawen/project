<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Tracking Aset <small></small></h2>
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

    <div class="table-responsive">
      <table id="table" class="table table-striped jambo_table table-bordered nowrap">
        <thead>
            <tr>
            <?php
            for ($i=0; $i < sizeof($barang) ; $i++) :?>
                <th colspan ="<?php echo sizeof($barang[$i]['satuan']) ?>"><?php echo $barang[$i]['nama_barang']?></th>
            <?php endfor?>
            </tr>
            <tr>
            <?php foreach ($barangall as $key):?>
                <th><?php echo $key->satuan ?></th>
            <?php endforeach?>
            </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>

  </div>
</div>