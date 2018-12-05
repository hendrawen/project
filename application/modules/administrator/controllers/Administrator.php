<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	private $permit;
	function __construct()
	{
		parent::__construct();
		//$this->load->model('Main_model');
		$this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
		if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
		} 
		else {
            if (!$this->ion_auth->in_group($this->permit[1])) {//cek admin ga?
                redirect('login','refresh');
            }
		}
		$this->load->model('Model_grafik');
	}

	public function index()
	{
		$data['aktif']			='Dashboard';
		$data['title']			='Admin Panel';
		$data['judul']			='Dashboard';
		$data['sub_judul']		='';
		$data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
		$data['content']		='content';
		//$data['grafik']			= $this->Model_grafik->get_data();
		$this->load->view('panel/dashboard',$data);
	}

	public function chart_pembayaran()
	{
		$month = get_list_month();
		$value = array();
		foreach ($month as $row) {
			$value[] = $this->Model_grafik->get_chart_pembayaran($this->input->post('tahun'), $row['key']);
			$bulan[] = $row['month'];
		}
		$hasil = array(
			'bulan' => $bulan,
			'value' => $value,
		);
		echo json_encode($hasil);
	}


}
