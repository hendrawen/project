<div class="x_panel">
    <div class="x_title">
      <h2>List Jadwal Kunjungan</h2>
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
  <ul class="list-unstyled timeline">
    <?php foreach ($jadwal as $key): ?>
      <li>
        <div class="block">
          <div class="tags">
            <a target="_blank" href="https://maps.google.com?q=<?php echo $key->lat .',' .$key->long ?>" class="tag">
              <span><i class="fa fa-map-marker"></i> Map</span>
            </a>
          </div>
          <div class="block_content">
            <h2 class="title">
               <?php echo $key->id_pelanggan; ?> - <?php echo $key->nama_pelanggan; ?>
            </h2>
            <div class="byline">
               <span>Tanggal</span> <i class="fa fa-truck"></i> <b><?php echo tgl_indo($key->tanggal_kunjungan); ?></b>
            </div>
            <p class="excerpt">
              <i class="fa fa-building"></i> Alamat: <?php echo $key->alamat ?>
              <br>
              <i class="fa fa-phone"></i> No. telp. #: <?php echo $key->no_telp ?>
              <br>
                <?php echo $key->keterangan ?>
              <br>
            </p>
          </div>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

</div>
</div>
