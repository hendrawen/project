<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Login extends CI_Controller
{

	function __construct() {
       parent::__construct();
    }

    public function index() {
    	if (!$this->ion_auth->logged_in()) {//cek login ga?
            $this->load->view('login');
        } else {
            if ($this->ion_auth->in_group('admin')) {
                redirect('administrator','refresh');
                 }elseif ($this->ion_auth->in_group('members')) {
            	redirect('panel','refresh');
	        }else{
				$this->load->view('login');
			}}
    }


}
