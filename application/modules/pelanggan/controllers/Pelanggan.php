<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Model_pelanggan','pelanggan');
  }

  function index()
  {
    $data['aktif']			='Pelanggan';
		$data['title']			='Data Pelanggan';
		$data['judul']			='Data Pelanggan';
		$data['sub_judul']		='';
    $data['content']			= 'main';
    $kotas = $this->pelanggan->get_list_kota();

    $opt = array('' => 'Semua Kota');
        foreach ($kotas as $kota) {
            $opt[$kota] = $kota;
    }

    $data['form_kota'] = form_dropdown('',$opt,'','id="kota" class="form-control"');
    $statuse = $this->pelanggan->get_list_status();

    $opt1 = array('' => 'Semua Status');
        foreach ($statuse as $status) {
            $opt1[$status] = $status;
    }

    $data['form_status'] = form_dropdown('',$opt1,'','id="status" class="form-control"');

    $kecamatans = $this->pelanggan->get_list_kecamatan();

    $opt2 = array('' => 'Semua Kecamatan');
        foreach ($kecamatans as $kecamatan) {
            $opt2[$kecamatan] = $kecamatan;
    }

    $data['form_kecamatan'] = form_dropdown('',$opt2,'','id="kecamatan" class="form-control"');

    $kelurahans = $this->pelanggan->get_list_kelurahan();

    $opt3 = array('' => 'Semua Kelurahan');
        foreach ($kelurahans as $kelurahan) {
            $opt3[$kelurahan] = $kelurahan;
    }

    $data['form_kelurahan'] = form_dropdown('',$opt3,'','id="kelurahan" class="form-control"');

    $surveyors = $this->pelanggan->get_list_surveyor();

    $opt4 = array('' => 'Semua Serveyor');
        foreach ($surveyors as $surveyor) {
            $opt4[$surveyor] = $surveyor;
    }

    $data['form_surveyor'] = form_dropdown('',$opt4,'','id="nama" class="form-control"');
    $this->load->view('panel/dashboard', $data);
  }

  public function ajax_list()
    {
        $list = $this->pelanggan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pelanggans) {
            $row = array();
            $row[] = $pelanggans->id_pelanggan;
            $row[] = $pelanggans->nama_pelanggan;
            $row[] = $pelanggans->no_telp;
            $row[] = $pelanggans->nama_dagang;
            $row[] = $pelanggans->alamat;
            $row[] = $pelanggans->photo_toko;
            $row[] = $pelanggans->kota;
            $row[] = $pelanggans->kelurahan;
            $row[] = $pelanggans->kecamatan;
            $row[] = $pelanggans->lat;
            $row[] = $pelanggans->long;
            $row[] = $pelanggans->status;
            $row[] = $pelanggans->nama;
            $row[] = '<button type="button" class="btn btn-success btn-xs"><i class="fa fa-external-link"></i></button>
            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                     ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pelanggan->count_all(),
                        "recordsFiltered" => $this->pelanggan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}
