<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('pesan/Pesan_model', 'order');
  }

  function index()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Checkout Transaksi';
    $data['sub_judul']		='';
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
