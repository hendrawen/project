<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Som extends CI_Controller{

  private $permit;
  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('SOM')) {//cek admin ga?
							redirect('login','refresh');
					}
    }
    $this->load->model('Takeorder_model', 'takeorder');
    //Codeigniter : Write Less Do More
  }

  function index() {
      $data['aktif'] = 'Active Call';
      $data['title'] = 'Brajamarketindo';
      $data['judul'] = 'Dashboard';
      $data['sub_judul'] = 'List Effectif Call';
      $data['judul_list'] = 'Effectif Call';
      $data['content'] = 'takeorder/main';
      $data['creator']        = $this->takeorder->get_list_creator();
      $statuse = $this -> takeorder -> get_list_status();

      $opt = array('' => 'Semua Status');
      foreach($statuse as $status) {
          $opt[$status] = $status;
      }
      $data['form_status'] = form_dropdown(
          '',
          $opt,
          '',
          'id="status" class="form-control"'
      );
      $this -> load -> view('som/dashboard', $data);
  }

//   public function jadwal()
//   { 
//     $cek = get_permission('som', $this->permit[1]);
//     if (!$cek) {//cek admin ga?
//         redirect('panel','refresh');
//     }
//     $data['aktif']			='Jadwal';
//     $data['title']			='Jadwal';
//     $data['judul']			='Daftar Jadwal';
//     $data['sub_judul']		='Pengiriman';
//     $data['content']			= 'jadwal/main';
//     $this->load->view('som/dashboard', $data);
//   }

  public function validator()
  {
    $data['aktif']			='validator';
    $data['title']			='Validator';
    $data['judul']			='Daftar Validator';
    $data['sub_judul']		='Pengiriman';
    $data['content']			= 'jadwal/main';
    $this->load->view('som/dashboard', $data);
  }

//   public function pelanggan()
//   { 
//     $cek = get_permission('som', $this->permit[1]);
//     if (!$cek) {//cek admin ga?
//         redirect('panel','refresh');
//     }
//     $this->load->model('pelanggan/Model_pelanggan', 'pelanggan');
//     $data['aktif']			='Pelanggan';
// 		$data['title']			='Brajamarketindo';
// 		$data['judul']			='Dashboard';
// 		$data['sub_judul']		='Data Pelanggan';
//     $data['content']			= 'pelanggan/main';
//     $kotas = $this->pelanggan->get_list_kota();

//     $opt = array('' => 'Semua Kota');
//         foreach ($kotas as $kota) {
//             $opt[$kota] = $kota;
//     }

//     $data['form_kota'] = form_dropdown('',$opt,'','id="kota" class="form-control"');
//     $statuse = $this->pelanggan->get_list_status();

//     $opt1 = array('' => 'Semua Status');
//         foreach ($statuse as $status) {
//             $opt1[$status] = $status;
//     }

//     $data['form_status'] = form_dropdown('',$opt1,'','id="status" class="form-control"');

//     $kecamatans = $this->pelanggan->get_list_kecamatan();

//     $opt2 = array('' => 'Semua Kecamatan');
//         foreach ($kecamatans as $kecamatan) {
//             $opt2[$kecamatan] = $kecamatan;
//     }

//     $data['form_kecamatan'] = form_dropdown('',$opt2,'','id="kecamatan" class="form-control"');

//     $kelurahans = $this->pelanggan->get_list_kelurahan();

//     $opt3 = array('' => 'Semua Kelurahan');
//         foreach ($kelurahans as $kelurahan) {
//             $opt3[$kelurahan] = $kelurahan;
//     }

//     $data['form_kelurahan'] = form_dropdown('',$opt3,'','id="kelurahan" class="form-control"');

//     $surveyors = $this->pelanggan->get_list_surveyor();

//     $opt4 = array('' => 'Semua Surveyor');
//         foreach ($surveyors as $surveyor) {
//             $opt4[$surveyor] = $surveyor;
//     }

//     $data['form_surveyor'] = form_dropdown('',$opt4,'','id="nama" class="form-control"');

//     $bulans = $this->pelanggan->get_list_bulan();

//     $opt5 = array('' => 'Bulan');
//         foreach ($bulans as $bulan) {
//             $opt5[$bulan] = $bulan;
//     }

//     $data['form_bulan'] = form_dropdown('',$opt5,'','id="bulan" class="form-control"');
//     $this->load->view('panel/dashboard', $data);
//   }

  public function report()
  { 
    $cek = get_permission('som', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
    $data['aktif']			='Report';
    $data['title']			='Report';
    $data['judul']			='Daftar Report';
    $data['sub_judul']		='Report';
    $data['content']			= 'jadwal/main';
    $this->load->view('som/dashboard', $data);
  }

}
