<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller{

  private $permit;
  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Ion_auth_model');
    $this->permit = $this->Ion_auth_model->permission($this->session->identity);
    $this->load->model('pesan/Pesan_model', 'order');

    if (!$this->ion_auth->logged_in()) {//cek login ga?
      redirect('login','refresh');
  }
  }

  function index()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Checkout Transaksi';
    $data['sub_judul']	='';
    $data['menu']			= $this->permit[0];
    $data['submenu']		= $this->permit[1];
    $data['content']			= 'pesan/checkout';
    $data['data']=$this->order->get_all_product();
    $data['profile']=$this->order->get_profile();
    $data['generate_invoice'] = $this->order->generatekode_invoice();
    $this->load->view('panel/dashboard', $data);
  }

  function get_pelanggan(){
		$kode=$this->input->post('id_pelanggan');
		$data=$this->order->get_data_pelanggan_bykode($kode);
		echo json_encode($data);
	}

}
