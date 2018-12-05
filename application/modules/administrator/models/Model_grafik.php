<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_grafik extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_chart_pembayaran($year, $month)
    {
        $this->db->select('sum(bayar) as total');
        $this->db->where('year(tgl_bayar)', $year);
        $this->db->where('month(tgl_bayar)', $month);
        
        $hasil = $this->db->get('wp_pembayaran')->row();
        if ($hasil) {
            return $hasil->total;
        } else {
            $hasil = 0;
            return $hasil;
        }   
    }

    public function get_chart_data($year, $month)
    {
        $this->db->select('sum(bayar) as total');
        $this->db->where('year(tgl_bayar)', $year);
        $this->db->where('month(tgl_bayar)', $month);
        
        $hasil = $this->db->get('wp_pembayaran')->row();
        if ($hasil) {
            return $hasil->total;
        } else {
            $hasil = 0;
            return $hasil;
        }   
    }

}

/* End of file Model_grafik.php */
