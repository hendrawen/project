<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $data = array(
      'aktif'			=>'delivery',
      'title'			=>'Brajamarketindo',
      'judul'			=>'Dashboard',
      'sub_judul' 	=>'Admin',
      'content'		=>'content',
    );
    $this->load->view('dashboard', $data);
  }

}
