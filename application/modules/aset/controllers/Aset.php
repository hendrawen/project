<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Aset';
    $data['content']		='main';
    $this->load->view('panel/dashboard', $data);
  }

}
