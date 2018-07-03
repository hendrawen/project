<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller{
  private $permit;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ion_auth_model');
    $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
    //Codeigniter : Write Less Do More
    $this->load->model('Jadwal_model', 'jadwal');
  }

  function index()
  {
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
    $data['aktif']			='Jadwal';
    $data['title']			='Jadwal';
    $data['judul']			='Daftar Jadwal';
    $data['sub_judul']		='Pengiriman';
    $data['content']			= 'main';
    $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
    $this->load->view('panel/dashboard', $data);
  }

  Public function getEvents()
	{
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
		$result=$this->jadwal->getEvents();
		echo json_encode($result);
	}

  Public function addEvent()
	{
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
		$result=$this->jadwal->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
		$result=$this->jadwal->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
		$result=$this->jadwal->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{
    $cek = get_permission('Jadwal', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
    }
		$result=$this->jadwal->dragUpdateEvent();
		echo $result;
	}

}
