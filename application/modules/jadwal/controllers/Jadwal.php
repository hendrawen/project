<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Jadwal_model', 'jadwal');
  }

  function index()
  {
    $data['aktif']			='Jadwal';
    $data['title']			='Jadwal';
    $data['judul']			='Daftar Jadwal';
    $data['sub_judul']		='Pengiriman';
    $data['content']			= 'main';
    $this->load->view('panel/dashboard', $data);
  }

  Public function getEvents()
	{
		$result=$this->jadwal->getEvents();
		echo json_encode($result);
	}

  Public function addEvent()
	{
		$result=$this->jadwal->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
		$result=$this->jadwal->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->jadwal->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{

		$result=$this->jadwal->dragUpdateEvent();
		echo $result;
	}

}
