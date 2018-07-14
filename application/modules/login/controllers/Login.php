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
            if ($this->ion_auth->in_group('Admin & Finance')) {
                redirect('admin','refresh');
            } elseif ($this->ion_auth->in_group('Marketing')) {
                redirect('marketing','refresh');
            } elseif ($this->ion_auth->in_group('Admin Gudang')) {
                redirect('admin_gudang','refresh');
            } elseif ($this->ion_auth->in_group('super user')) {
                redirect('panel','refresh');
            } elseif ($this->ion_auth->in_group('Debt')) {
                redirect('debt','refresh');
            } elseif ($this->ion_auth->in_group('Marketing')) {
                redirect('marketing','refresh');
            } elseif ($this->ion_auth->in_group('SOM')) {
                redirect('som','refresh');
            } elseif ($this->ion_auth->in_group('Customer Service')) {
                redirect('customerservice','refresh');
            } elseif ($this->ion_auth->in_group('Validator')) {
                redirect('validator','refresh');
            }else{
                redirect('login','refresh');
            }
        }
    }


}
