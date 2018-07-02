<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    private $permit;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
        //Do your magic here
        $this->load->model('Models_laporan', 'laporan');
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->model('som/Model_dep', 'dep');
        $this->load->library('table');
    }
    

    function bulanan()
    {
        $cek = get_permission('Debt', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        # code...
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan_bulanan',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_penarikan_bulanan()
    {
        $cek = get_permission('Debt', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->penarikan_bulanan($from, $to, $tahun);
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_uang.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function load_penarikan_all()
    {
        $cek = get_permission('Debt', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = $this->laporan->penarikan_bulanan_all();
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_uang.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=21>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }


    function template_table()
    {
        $cek = get_permission('Debt', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $template = array(
            'table_open'            => ' <table id="datatable" class="table table-striped table-bordered">',
            // 'table_open'            => '<table id="example" class="table table-striped jambo_table table-bordered dt-responsive nowrap">',
            'thead_open'            => '<thead>',
            'thead_close'           => '</thead>',
            'heading_row_start'     => '<tr>',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th>',
            'heading_cell_end'      => '</th>',
            'tbody_open'            => '<tbody>',
            'tbody_close'           => '</tbody>',
            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td>',
            'cell_end'              => '</td>',
            'row_alt_start'         => '<tr>',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td>',
            'cell_alt_end'          => '</td>',
            'table_close'           => '</table>'
        );
        $this->table->set_template($template);
    }

}

/* End of file Penarikan.php */
