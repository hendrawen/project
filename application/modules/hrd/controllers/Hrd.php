<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Hrd extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
                if (!$this->ion_auth->in_group('HRD')) {//cek admin ga?
                        redirect('login','refresh');
                }
		}
    }

    public function index()
    {
        $data['aktif']			='Dashboard';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Bendahara';
        $data['content']		='main';
        $this->load->view('dashboard',$data);
    }

}

/* End of file Bendahara.php */
