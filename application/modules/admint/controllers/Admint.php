<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admint extends CI_Controller {

    public function index()
    {
        $data = array(
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul' 	=>'Admin',
            'content'		=>'content',
          );
          $this->load->view('dashboard', $data);
    }

}

/* End of file Admint.php */
