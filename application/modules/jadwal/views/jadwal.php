
<!--Batas-->
<div class="x_panel">
      <div class="x_title">
            <h2>Jadwal List</h2>
            <div class="text-right">
            <a href="<?php echo site_url('som/jadwal2/create'); ?>" type="button" class="btn btn-primary text-right" > <i class="fa fa-plus" ></i> Tambah Data</a>
            </div>
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon">Tanggal <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></span>
                    <input type="date" class="form-control" id="tgl" placeholder="" value="<?php echo date('m/d/Y')?>">
                  </div>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12 text-right">
                  <button type="button" class="btn btn-success" id="btn-jadwal-harian"> <i class="fa fa-search"> Search</i> <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></button>
                  <button type="button" class="btn btn-warning" id="btn-refresh-jadwal"> <i class="fa fa-refresh"> Reload</i> <img id="loading" src="<?=base_url();?>assets/ajax-loader.gif" alt="" style="text-align:center; display:none"></button>
                </div>
              </div>
              <div class="table-responsive">
                  <table class="table jambo_table table-bordered" id="transaksilist">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Id Jadwal</th>
                              <th>Nama Barang</th>
                              <th>Qty</th>
                              <th>Tanggal Kirim</th>
                              <!-- <th>End</th> -->
                              <th>Username</th>
                              <th>Judul</th>
                              <th>Sumber Data</th>
                              <th>Deskripsi</th>
                              <th>Nama Pelanggan</th>
                          		<th>Karyawan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody id="tbody-jadwal">
                    </tbody>
                  </table>
                  </div>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <a></a>
                      <?php //echo anchor(site_url('som/transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php //echo anchor(site_url('transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
                </div>
              </div>
            </div>


            <!-- Gagal -->
            <?php if ($this->session->flashdata('msg')): ?>
                     <small>
                       <script type="text/javascript">
                          swal({
                               title: "Maaf",
                               text: "<?php echo $this->session->flashdata('msg'); ?>",
                                timer: 3500,
                               showConfirmButton: true,
                               type: 'error' },
                               function(){
                                 location.reload();
                             });
                       </script>
                     </small>
                <?php endif; ?>

            <!-- sukses -->
            <?php if ($this->session->flashdata('message')): ?>
                     <small>
                       <script type="text/javascript">
                          swal({
                               title: "Done",
                               text: "<?php echo $this->session->flashdata('message'); ?>",
                                timer: 3500,
                               showConfirmButton: true,
                               type: 'success' },
                               function(){
                                 location.reload();
                               }
                             );
                       </script>
                     </small>
                <?php endif; ?>
