<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class jadwal extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Model_jadwal', 'jadwal');
        
    }
    
    public function index()
    {
        $data['aktif']			='Dashboard';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Jadwal';
        $data['content']		='jadwal/main';
        $data['jadwal'] = $this->jadwal->get_by_validator();
        $this->load->view('dashboard',$data);
    }

}

/* End of file jadwal.php */
