<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Effectivecall extends CI_Controller {

    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
        //Do your magic here
        $this->load->model('Effective_model', 'call');
        
    }
    

    function index()
    {
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Effectife Call';
        $data['content']		='effective/main';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['barang']         = $this->call->get_barang();
        $this->load->view('panel/dashboard', $data);
    }

    function load_all()
    {
        # code...
        
    }

}

/* End of file Effectivecall.php */
