
<?php if ($this->session->flashdata('message')): ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div
            class="alert alert-success alert-dismissible fade in"
            role="alert"
            id="message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="x_panel">
    <div class="x_title">
        <h2><?php echo $detail[0]->nama_pelanggan .' : ['.$detail[0]->id_pelanggan.']' ?></h2>
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
        <div class="row">
            <div class="table-responsive">
                <table
                    class="table jambo_table table-bordered dt-responsive nowrap"
                    id="tabel_cari_aset">
                    <thead>
                        <th>Tanggal Penarikan</th>
                        <th>Bayar Krat</th>
                        <th>Bayar Uang (Rp.)</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($detail as $key):
                        if ($key->bayar_krat > 0 || $key->bayar_uang > 0 ):
                    ?>
                    <tr>
                    <td><?=tgl_indo($key->tgl_penarikan)?></td>
                    <td><?=$key->bayar_krat?></td>
                    <td><?=$key->bayar_uang?></td>
                    <td>
                    <button type="button" onClick="<?php echo 'ubah_penarikan('.$key->id_penarikan.')' ?>" class="btn btn-success btn-xs">Edit</button>
                    </td>
                    </tr>
                    <?php
                    endif;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                
                <a href="<?=site_url('penarikan')?>" type="button" class="btn btn-danger">Kembali</a>
                
            </div>
        </div>
        <!-- end form for validations -->

    </div>
</div>


<div class="modal fade" id="modal_edit_penarikan" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ubah Data Penarikan</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form-tarik-aset-update" method="post">
                <div id="pesan-post"></div>
                    <div class="form-group">
                        <label for="fullname">Tanggal Bayar/Tarik * :</label>
                        <input
                            type="date"
                            class="form-control"
                            id="tgl_bayar"
                            name="tgl_bayar"
                            placeholder="Tanggal Transaksi">
                    </div>
                    <div id="form_bayar_uang"
                        class="form-group">
                        <label for="bayar_uang">Bayar Uang (Rp.) *</label>
                        <input
                            type="text"
                            id="bayar_uang"
                            name="bayar_uang"
                            class="form-control"
                            onkeyup="FormatCurrency(this)"
                            autocomplete="off"
                            placeholder="Masukkan jumlah bayar">
                    </div>
                    <div id="form_bayar_krat"
                        class="form-group">
                        <label for="bayar_krat">Bayar Krat *</label>
                        <input
                            type="text"
                            id="bayar_krat"
                            name="bayar_krat"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Masukkan jumlah bayar">
                    </div>
                    <div
                        class="form-group">
                        <label for="bayar_krat">Gudang</label>
                        <select name="gudang" class="form-control" id="gudang">
                            <option value="">Pilih Gudang</option>
                            <?php 
                        foreach ($gudang->result() as $key) {?>
                            <option value="<?php echo $key->id ?>"><?php echo $key->nama_gudang ?></option>
                            <?php }
                        ?>
                        </select>
                    </div>
                    <!-- <input type="hidden" name="sudah" id="sudah"> -->
                    <input
                        type="hidden"
                        name="<?=$this->security->get_csrf_token_name();?>"
                        value="<?=$this->security->get_csrf_hash();?>">
                    <input type="hidden" id="id_penarikan" name="id_penarikan"/>
                    <input type="hidden" id="id_asis_debt" name="id_asis_debt"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="update_data_penarikan()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php

// echo "<pre>";
// print_r ($detail);
// echo "</pre>";

?>