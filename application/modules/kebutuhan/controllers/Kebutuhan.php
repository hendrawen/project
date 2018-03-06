<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebutuhan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Model_kebutuhan','kebutuhan');
  }

  function index()
  {
    $data['aktif']			='Pelanggan';
		$data['title']			='Kebuthan Pelanggan';
		$data['judul']			='Data Kebutuhan Pelanggan';
		$data['sub_judul']		='';
    $data['content']			= 'kebutuhan';
    $this->load->view('panel/dashboard', $data);
  }

  public function ajax_list()
    {
        $list = $this->kebutuhan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kebutuhans) {
            $row = array();
            $row[] = $kebutuhans->id_pelanggan;
            $row[] = $kebutuhans->nama_pelanggan;
            $row[] = $kebutuhans->no_telp;
            $row[] = $kebutuhans->jenis;
            $row[] = $kebutuhans->jumlah;
            $row[] = $kebutuhans->tgl;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kebutuhan->count_all(),
                        "recordsFiltered" => $this->kebutuhan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}
