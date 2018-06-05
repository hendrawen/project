<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Models_share extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
        
    }
    
    function kelurahan_all()
    {
        # code...
        $this->db->select('wp_pelanggan.kota, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, COUNT(wp_transaksi.wp_barang_id) as jumlah');
        $this->db->from('wp_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'left');
        $this->db->group_by('wp_pelanggan.kelurahan');
        
        $data = $this->db->get();
        return $data->result();  
        
    }

    function get_kelurahan()
    {
        # code...
        $this->db->select('wp_pelanggan.kelurahan');
        $this->db->from('wp_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'left');
        
        $data = $this->db->get();
        return $data->result(); 
    }

    function get_barang()
    {
        # code...
        $this->db->select('id, nama_barang');
        $this->db->from('wp_barang');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_id_barang()
    {
        # code...
        $this->db->select('id');
        $this->db->from('wp_barang');
        $query = $this->db->get()->result();
        return $query;
    }

    function count_produk($kelurahan, $id)
    {
        # code...
        // $query = "SELECT count(wp_barang_id) as `jumlah` FROM `wp_transaksi` JOIN wp_pelanggan
        // WHERE EXISTS (SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id )
        // and `wp_pelanggan`.`kecamatan` = '$kelurahan' AND wp_transaksi.wp_barang_id = '1' GROUP BY wp_pelanggan.kecamatan";
        $this->db->select('COUNT(wp_transaksi.wp_barang_id) as jumlah');
        $this->db->from('wp_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'left');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id', 'left');  
        $this->db->where('wp_pelanggan.kecamatan', $kelurahan);
        $this->db->where('wp_transaksi.wp_barang_id', $id);
        $this->db->group_by('wp_pelanggan.kecamatan');
        $result =  $this->db->get()->row();
        if ($result) {
            # code...
            return $result->jumlah;
        } else {
            return 0;
        }
        
    }
    

}

/* End of file Models_share.php */

