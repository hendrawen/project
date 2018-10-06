<div class="x_panel">
    <div class="x_title">
        <h2 class="green saldo"></h2>
        <div class="nav navbar-right panel_toolbox">
            <div class="form-inline">
                <button type="button" onclick="tambah()" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Tambah</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <form action="" id="form-filter">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
                <span class="input-group-addon">Tanggal</span>
                <input type="date" class="form-control" id="filter-hari" placeholder="">
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">Dari Bulan</span>
                <select class="form-control" id="filter-bulan1">
                  <option value="">Semua Bulan</option>
                    <?php $i = 1;  foreach ($month as $key): ?>
                    <option value="<?php echo $i++;?>"><?php echo $key ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="input-group">
                <span class="input-group-addon">Ke Bulan</span>
                <select class="form-control" id="filter-bulan2">
                  <option value="">Semua Bulan</option>
                    <?php $i = 1;  foreach ($month as $key): ?>
                    <option value="<?php echo $i++;?>"><?php echo $key ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">Tahun</span>
                <select class="form-control" id="filter-tahun">
                  <option value="">Semua Tahun</option>
                    <?php for ($tahun=(date('Y')-5); $tahun <= date('Y'); $tahun++) {
                    echo '<option value="'.$tahun.'">'.$tahun.'</option>';
                  } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="input-group">
                <span class="input-group-addon">Kantor</span>
                <select class="form-control" id="filter-kantor">
                    <option value="">Semua Kantor</option>
                    <?php foreach ($list_kantor as $row): ?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->nama_gudang;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <button type="button" class="btn btn-success" id="btn-search"> <i class="fa fa-search"></i> Search</button>
            <button type="button" class="btn btn-warning" id="btn-reload"> <i class="fa fa-refresh"></i> Reload</button>
        </div>

    </div>
    </form>


    <div class="table-responsive">
        <table
            id="table-kas"
            class="table table-striped jambo_table table-bordered nowrap">
            <thead>
                <th>#</th>
                <th>Tanggal</th>
                <th>Kantor</th>
                <th>Creator</th>
                <th>Debt / Delivery</th>
                <th>Kategori</th>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Action</th>
            </thead>
            <tbody id="tbody"></tbody>
        </table>
    </div>
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal-kas" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Pendapatan Pengeluaran</h3>
            </div>
            <div class="modal-body form">
                <form action="#" method="POST" id="form" role="form">
                    <input type="hidden" class="form-control" id="id_kas" name="id_kas">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal">
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="id_kantor">Kantor</label>
                        <select name="id_kantor" id="id_kantor" class="form-control">
                            <option value="">-- Select One --</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <select name="id_karyawan" id="id_karyawan" class="form-control">
                            <option value="">-- Select One --</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control">
                            <option value="">-- Select One --</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="text" onKeyUp="FormatCurrency(this)" class="form-control" id="pendapatan" name="pendapatan" min=0 placeholder="Pendapatan">
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="pengeluaran">Pengeluaran</label>
                        <input type="text" onKeyUp="FormatCurrency(this)" class="form-control" id="pengeluaran" name="pengeluaran" min=0 placeholder="Pengeluaran">
                        <span class="help-block"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="simpan()" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
