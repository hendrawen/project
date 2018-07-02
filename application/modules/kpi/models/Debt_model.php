<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Debt_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_month()
    {
        $month = array(
            array ('key' => 1, 'month' => 'Januari'),
            array ('key' => 2, 'month' => 'Februari'),
            array ('key' => 3, 'month' => 'Maret'),
            array ('key' => 4, 'month' => 'April'),
            array ('key' => 5, 'month' => 'Mei'),
            array ('key' => 6, 'month' => 'Juni'),
            array ('key' => 7, 'month' => 'Juli'),
            array ('key' => 8, 'month' => 'Agustus'),
            array ('key' => 9, 'month' => 'September'),
            array ('key' => 10, 'month' => 'Oktober'),
            array ('key' => 11, 'month' => 'November'),
            array ('key' => 12, 'month' => 'Desember'),
        );
        return $month;
    }

    function get_customer_jadwal($date)
    {
        $this->db->select('count(id) as t');
        $this->db->where('DATE(start)', $date);
        $this->db->from('wp_jadwal');
        $count = $this->db->get()->row();
        return $count->t;
        
    }

    function get_customer_actual($date)
    {
        // $this->db->select('count(id) as t');
        // $this->db->where('DATE(start)', $date);
        // $this->db->from('wp_jadwal');
        // $count = $this->db->get()->row();
        // return $count->t;
        return 1;
        
    }
    

}

/* End of file Debt_model.php */
