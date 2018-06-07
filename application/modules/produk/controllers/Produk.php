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
        // $data['kelurahan'] = $this->produk->kelurahan_all();
        $data['barang']    = $this->produk->get_barang();
        $this->load->view('panel/dashboard', $data);
    }

    function load_kota()
    {
        # code...
        $kelurahan = $this->produk->get_kelurahan();
        $id_barang = $this->produk->get_id_barang();
        $data = $this->produk->kelurahan_all();
        $total = 0;
        $pesan = "";
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '
            <tr>
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>';
            foreach ($id_barang as $key) {
                # code...
            $pesan .= '
            <td>'.$this->produk->count_produk($row->kecamatan, $key->id).'</td>';
            }
            $pesan .= '
            </tr>';
        }

        } else {
        $pesan = '
        <td colspan=16>Record not found</td>
        ';

        }
        echo $pesan;
    }

    function cek()
    {
        # code...
        // print_r($this->produk->get_id_barang());
        print_r($this->produk->count_produk('pagesangan barat'));
    }

}

/* End of file Produk.php */
