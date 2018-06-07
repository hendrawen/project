<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_gtransaksi extends CI_Model {

    
    function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function count_transaksi($bulan)
    {
        # code...
        $this->db->select('count(wp_transaksi.id_transaksi) as jumlah');
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $bulan);
        $result = $this->db->get('wp_transaksi')->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_qty($bulan)
    {
        # code...
        $this->db->select('sum(wp_transaksi.qty) as jumlah');
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $bulan);
        $result = $this->db->get('wp_transaksi')->row();
        if ($result->jumlah > 0) {
            # code...
            return $result->jumlah;
        } else {
            return '0';
        }
    }

    function count_customer($bulan)
    {
        # code...
        $query = " SELECT count(wp_pelanggan.id) as `jumlah` FROM `wp_pelanggan` 
            WHERE EXISTS (SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id AND month(wp_transaksi.tgl_transaksi) = $bulan)";
        $result =  $this->db->query($query)->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_newcustomer($bulan)
    {
        # code...
        $this->db->select('count(wp_pelanggan.id_pelanggan) as jumlah');
        $this->db->where('wp_pelanggan.status', 'Pelanggan');
        $this->db->where('month(wp_pelanggan.created_at)', $bulan);
        $result = $this->db->get('wp_pelanggan')->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_transaksi_tahun($bulan, $tahun)
    {
        # code...
        $this->db->select('count(wp_transaksi.id_transaksi) as jumlah');
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $bulan);
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $tahun);
        $result = $this->db->get('wp_transaksi')->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_qty_tahun($bulan, $tahun)
    {
        # code...
        $this->db->select('sum(wp_transaksi.qty) as jumlah');
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $bulan);
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $tahun);
        $result = $this->db->get('wp_transaksi')->row();
        if ($result->jumlah > 0) {
            # code...
            return $result->jumlah;
        } else {
            return '0';
        }
    }

    function count_customer_tahun($bulan, $tahun)
    {
        # code...  
        $this->db->select('count(wp_pelanggan.id) as jumlah');
        $this->db->from('wp_pelanggan');     
        $this->db->where_in('SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $bulan);
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $tahun);  
        $this->db->join('wp_transaksi', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'inner');
        $result =  $this->db->get()->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_newcustomer_tahun($bulan, $tahun)
    {
        # code...
        $this->db->select('count(wp_pelanggan.id_pelanggan) as jumlah');
        $this->db->where('wp_pelanggan.status', 'Pelanggan');
        $this->db->where('month(wp_pelanggan.created_at)', $bulan);
        $this->db->where('year(wp_pelanggan.created_at)', $tahun);
        $result = $this->db->get('wp_pelanggan')->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
    }
   

}

/* End of file Model_gtransaksi.php */
