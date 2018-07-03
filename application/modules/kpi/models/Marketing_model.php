<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_count_kategori($date, $id_kategori, $id_karyawan)
    {
        if($id_karyawan != 'semua')
        {
            $this->db->where('wp_karyawan_id_karyawan', $id_karyawan);
        }
        $this->db->select('count(id) as t');
        $this->db->where('id_kategori', $id_kategori);
        $this->db->where('DATE(created_at)', $date);
        $cek = $this->db->get('wp_pelanggan')->row();
        return $cek->t;
    }

    function get_count_qty($date, $id_karyawan)
    {
        // if($id_karyawan != 'semua')
        // {
        //     $this->db->where('username', $id_karyawan);
        // }
        $this->db->select('qty');
        $this->db->where('tanggal', $date);
        $cek = $this->db->get('wp_list_effectif')->row();
        if ($cek) {
            return $cek->qty;
        } else {
            return 0;
        }
    }

}

/* End of file Debt_model.php */
