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
        $this->db->select('wp_pelanggan.kota, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan');
        $this->db->from('wp_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'left');
        $this->db->group_by('wp_pelanggan.kelurahan');
        
        $data = $this->db->get();
        return $data->result();  
        
    }
    

}

/* End of file Models_share.php */

