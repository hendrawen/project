
<div class="x_panel">
  <div class="x_title">
    <h2>Growth Transaksi <small> </small></h2>
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
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Tahun</span>
          <select class="form-control" id="tahun">
            <?php for ($tahun=(date('Y')-4); $tahun <= date('Y'); $tahun++) {
              echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
            } ?>
          </select>
        </div>
      </div>
      <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12 text-right">
        <button type="button" class="btn btn-success" id="btn-growth_transaksi"><i class="fa fa-search"></i> Search</button>
        <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none">
        <button type="button" id="excel_marketing_harian" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
        <button type="button" class="btn btn-warning" id="btn-refresh-gtransaksi"> <i class="fa fa-refresh"> Reload</i> <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">
          <thead>
            <tr>
                 <th class="wider_kecamatan">#</th>
              <?php
                foreach ($month as $value) {?>
                 <th><?php echo $value; ?></th>
                <?php }
              ?>
            </tr>
          </thead>
          <tbody id="tbody-gtransaksi">

          </tbody>
      </table>
    </div>
  </div>
</div>
