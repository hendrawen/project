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

    $opt4 = array('' => 'Semua Surveyor');
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
            $row[] = $pelanggans->kota;
            $row[] = $pelanggans->kelurahan;
            $row[] = $pelanggans->kecamatan;
            $row[] = $pelanggans->lat;
            $row[] = $pelanggans->long;
            $row[] = $pelanggans->status;
            if($pelanggans->photo_toko)
                $row[] = '<a href="'.base_url('assets/uploads/'.$pelanggans->photo_toko).'" target="_blank"><img src="'.base_url('assets/uploads/'.$pelanggans->photo_toko).'" class="img-responsive" height="42" width="42"/></a>';
            else
                $row[] = '(tidak ada photo)';
            $row[] = $pelanggans->nama;
            $row[] = '<button type="button" class="btn btn-success btn-xs"><i class="fa fa-external-link"></i></button>
            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
            <a type="button" href="javascript:void(0)" title="Hapus" onclick="delete_pelanggan('."'".$pelanggans->id."'".')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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

    public function test()
    {
      # code...
      $this->load->library('Googlemap');
      $data['aktif']			='Pelanggan';
  		$data['title']			='Data Pelanggan';
  		$data['judul']			='Mapping Pelanggan';
  		$data['sub_judul']		='';
      $data['content']			= 'maps';
      $config['center'] = '37.4419, -122.1419';
      $config['zoom'] = 'auto';
      $this->googlemap->initialize($config);

      $marker = array();
      $marker['position'] = '37.429, -122.1519';
      $marker['infowindow_content'] = '1 - Hello World!';
      $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
      $this->googlemap->add_marker($marker);

      $marker = array();
      $marker['position'] = '37.409, -122.1319';
      $marker['draggable'] = TRUE;
      $marker['animation'] = 'DROP';
      $this->googlemap->add_marker($marker);

      $marker = array();
      $marker['position'] = '37.449, -122.1419';
      $marker['onclick'] = 'alert("You just clicked me!!")';
      $this->googlemap->add_marker($marker);
      $data['map'] = $this->googlemap->create_map();

      $this->load->view('panel/dashboard', $data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'no_telp' => $this->input->post('no_telp'),
                'nama_dagang' => $this->input->post('nama_dagang'),
                'alamat' => $this->input->post('alamat'),
                'photo' => $this->input->post('photo'),
                'photo_toko' => $this->input->post('photo_toko'),
                'kota' => $this->input->post('kota'),
                'kelurahan' => $this->input->post('kelurahan'),
                'kecamatan' => $this->input->post('kecamatan'),
                'lat' => $this->input->post('lat'),
                'long' => $this->input->post('long'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->input->post('status'),
                'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan'),
            );
        $insert = $this->pelanggan->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->pelanggan->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('firstName') == '')
        {
            $data['inputerror'][] = 'firstName';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('lastName') == '')
        {
            $data['inputerror'][] = 'lastName';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('dob') == '')
        {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Date of Birth is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('gender') == '')
        {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = FALSE;
        }

        if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Addess is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
