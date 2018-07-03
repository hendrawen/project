<div class="x_panel">
  <div class="x_title">
    <h2>Pendapatan dan Pengeluaran <small></small></h2>
    <div class="nav navbar-right panel_toolbox">
        <h2>Saldo</h2>
    </div>
    <div class="clearfix"></div>
  </div>

    <button type="button" onClick="tambah()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
    <div class="x_content">
        <div class="table-responsive">
            <table id="table-kas" class="table table-striped jambo_table table-bordered nowrap">
                <thead>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kantor</th>
                    <th>Debt / Delivery</th>
                    <th>Keterangan</th>
                    <th>Pendapatan</th>
                    <th>Pengeluaran</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal-kas" role="dialog">
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
                        <label for="id_karyawan">Debt / Delivery</label>
                        <select name="id_karyawan" id="id_karyawan" class="form-control">
                            <option value="">-- Select One --</option>
                        </select>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" name="keterangan" id="keterangan" class="form-control" placeholder= "Keterangan" rows="3" required="required"></textarea>
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="pendapatan">Pendapatan</label>
                        <input type="number" class="form-control" id="pendapatan" name="pendapatan" min=0 placeholder="Pendapatan">
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                        <label for="pengeluaran">Pengeluaran</label>
                        <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" min=0 placeholder="Pengeluaran">
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