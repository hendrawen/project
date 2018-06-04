<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Models_share', 'produk');
        
    }
    
    public function index()
    {
        $to = date('n');
        $from = $to - 1 ;
        $year = date('Y');

        // $record = $this->mLap->laporan_pelanggan($from, $to, $year);
        $data = array(
            'aktif'			=>'produk',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Produk',
            'content'		=>'main_share',
            'month'         => $this->month,
            // 'record'    => $record,
            'from'  => set_value('from', $from),
            'to'  => set_value('to', $to),
            'year'  => set_value('year', $year)
        );

        $this->load->view('panel/dashboard', $data);
    }

    function load_kota()
    {
        # code...
        $data = $this->produk->kelurahan_all();
        $total = 0;
        $pesan = "";
        if ($data) {
        foreach ($data as $row) {
            $utang = $this->produk->kelurahan_all();
            $pesan .= '
            <tr>
            <td>'.$row->kota.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->kecamatan.'</td>
            </tr>';
        }

        } else {
        $pesan = '
        <td colspan=16>Record not found</td>
        ';

        }
        echo $pesan;
    }

}

/* End of file Produk.php */
