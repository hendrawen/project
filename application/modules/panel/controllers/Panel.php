<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$data['aktif']			='Dashboard';
		$data['title']			='Brajamarketindo';
		$data['judul']			='Dashboard';
		$data['sub_judul']		='';
		$data['content']		='content';
		$this->load->view('dashboard',$data);
	}
}
