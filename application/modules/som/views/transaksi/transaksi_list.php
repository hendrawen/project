
<!--Batas-->
<div class="x_panel">
      <div class="x_title">
            <h2>Transaksi List</h2>
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
            <div class="col-md-6 text-right">
                <!-- <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div> -->
            </div>

              <div class="x_content">
              <div class="row">
              <form action="#" id="form-filter2">
              <div class="col-lg-3 col-sm-12 col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon">Dari <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
                    <input type="date" class="form-control" name="dari" id="dari">
                  </div>
                </div>

                <div class="col-lg-3 col-sm-12 col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon">Ke <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
                    <input type="date" class="form-control" name="ke" id="ke">
                  </div>
                </div>
              
                <div class="col-lg-6 col-sm-12 col-xs-12 text-right">
                  <button type="button" id="btn-filter2" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
                  <button type="button" id="excel_transaksi" class="btn btn-primary"><i class="fa fa-download"></i> Excel</button>
                  <button type="button" id="btn-reset2" class="btn btn-info"><i class="fa fa-refresh"></i> All</button>
                </div>
              </form>
              </div>
              <div class="table-responsive">
              <!-- <?php echo anchor(site_url('som/transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?> -->
                  <table id="table_transaksi" class="table jambo_table table-bordered" id="transaksilist">
                      <thead>
                          <tr>
                            <th>No Faktur</th>
                            <th>Tgl Kirim</th>
                            <th>Jatuh Tempo</th>
                            <th>ID Pelanggan</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Kota</th>
                            <th class="wider_kecamatan">Kecamatan</th>
                            <th class="wider_kecamatan">Kelurahan</th>
                            <th>No Telpon</th>
                            <th>Marketing</th>
                            <th>Debt</th> <!-- username-->
                            <th>Jumlah</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                  </table>
                  </div>
          </div>