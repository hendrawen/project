<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gtransaksi extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Model_gtransaksi', 'gtransaksi');
        
    }
    

    public function index()
    {
        $data = array(
            'aktif'			=>'gtransaksi',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Growth Transaksi',
            'content'		=>'main',
            'month'         => $this->month,
        );
        $this->load->view('panel/dashboard', $data);   
    }

    function get_all()
    {
        $pesan = "";
        $pesan .= ' <tr> 
                        <td><b>Transaksi</b></td> 
                        ';
                        for ($i=1; $i <= 12; $i++) { 
                        $pesan .= '<td>'.$this->gtransaksi->count_transaksi($i).'</td>';
                        }
                    
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Qty</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_qty($i).'</td>';
                        }
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Customer Aktif</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_customer($i).'</td>';
                        }
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>New Customer</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_newcustomer($i).'</td>';
                        }';
                    </tr>
        ';
        echo $pesan;
    }

    function load_growth_transaksi()
    {
        # code...
        $tahun = $this->input->post('tahun');
        $pesan = "";
        $pesan .= ' <tr> 
                        <td><b>Transaksi</b></td> 
                        ';
                        for ($i=1; $i <= 12; $i++) { 
                        $pesan .= '<td>'.$this->gtransaksi->count_transaksi_tahun($i, $tahun).'</td>';
                        }
                    
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Qty</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_qty_tahun($i, $tahun).'</td>';
                        }
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Customer Aktif</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_customer_tahun($i, $tahun).'</td>';
                        }
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>New Customer</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_newcustomer_tahun($i, $tahun).'</td>';
                        }';
                    </tr>
        ';
        echo $pesan;

    }

}

/* End of file Gtransaksi.php */
