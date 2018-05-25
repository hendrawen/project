<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Models_laporan', 'laporan');
        $this->load->library('table');
        
    }
    

    public function index()
    {
        
    }

    function pembayaran_bulanan()
    {
        # code...
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_bulanan',
            'month'         => $this->month,
        );
        $this->load->view('panel/dashboard', $data);
    }

    function load_pembayaran_bulanan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->laporan_bulanan($from, $to, $tahun);
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
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->bayar;
        }
        $pesan .= '<tr>
        <td colspan=15 class=text-left><b>Total</b></td>
        <td colspan=4><b>'.number_format($total,2,',','.').'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

  function penarikan_bulanan()
    {
        # code...
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan_bulanan',
            'month'         => $this->month,
        );
        $this->load->view('panel/dashboard', $data);
    }

    function load_penarikan_bulanan()
    {
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


    function template_table()
    {
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

/* End of file Controllername.php */
