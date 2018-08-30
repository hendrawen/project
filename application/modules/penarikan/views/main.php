<a
    href="<?php echo base_url('delivery/penarikan'); ?>"
    type="button"
    class="btn btn-success">
    <i class="fa fa-plus"></i>
    Tambah</a>
<div class="x_panel">
    <div class="x_title">
        <h2>
            <i class="fa fa-group"></i>
            Data Pembayaran Pelanggan</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </li>
            <li class="dropdown">
                <a
                    href="#"
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-expanded="false">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">Settings 1</a>
                    </li>
                    <li>
                        <a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="close-link">
                    <i class="fa fa-close"></i>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    
    
    <div class="x_content">
        <table
            id="tbl_penarikan"
            class="table table-striped jambo_table table-bordered dt-responsive nowrap"
            cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>No Faktur</th>
                    <th>Tgl Kirim</th>
                    <th>Jatuh Tempo</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Barang</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th class="wider_kecamatan">Kecamatan</th>
                    <th class="wider_kecamatan">Kelurahan</th>
                    <th>No Telpon</th>
                    <th>Surveyor</th>
                    <th>Debt</th>
                    <th>Jumlah</th>
                    <th>Tgl Penarikan</th>
                    <th>Bayar</th>
                    <th>Tgl Penarikan</th>
                    <th>Bayar</th>
                    <th>Jumlah</th>
                    <th>Sisa ASET</th>
                    <th class="wider">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>No Faktur</th>
                    <th>Tgl Kirim</th>
                    <th>Jatuh Tempo</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Barang</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th class="wider_kecamatan">Kecamatan</th>
                    <th class="wider_kecamatan">Kelurahan</th>
                    <th>No Telpon</th>
                    <th>Surveyor</th>
                    <th>Debt</th>
                    <th>Jumlah</th>
                    <th>Tgl Penarikan</th>
                    <th>Bayar Krat</th>
                    <th>Tgl Penarikan</th>
                    <th>Bayar Uang</th>
                    <th>Jumlah</th>
                    <th>Sisa ASET</th>
                    <th class="wider">Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade bs-example-modal-sm"
    id="modal_hapus"
    role="dialog"
    data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi Hapus Data Penarikan</h4>
            </div>
            <div class="modal-body">

                    <table class="table table-bordered">
                        <tr>
                            <td width="125">No Faktur</td>
                            <td width="25">:</td>
                            <td id="faktur"></td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>:</td>
                            <td id="nama_pelanggan"></td>
                        </tr>
                    </table>
                    
                    <input type="hidden" name="id" id="id">
                    
                    <label for="">Masukkan password untuk konfirmasi hapus</label>
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required="required">
                        <span class="input-group-btn">
                            <button type="button" id="btn_hapus" onClick="check_password()" class="btn btn-danger">
                                <span class="fa fa-trash"></span>
                                Hapus</button>
                        </span>
                    </div>
                <div id="pesan"></div>
            </div>
            <!-- <div class="modal-footer"> <button type="button" class="btn btn-default"
            data-dismiss="modal">Close</button> </div> -->
        </div>
    </div>
</div>