<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Effective_model extends CI_Model {

    
    function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_barang()
    {
        # code...
        return $this->db->get('wp_barang')->result();
    }
    

}

/* End of file Effective_model.php */
