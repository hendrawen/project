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
      $config['center'] = '-6.241586
      $marker = array();
, 106.992416';
      $config['zoom'] = 'auto';
      $this->googlemap->initialize($config);

      $marker = array();
      $marker['position'] = '-7.025253, 107.519760';
      $marker['infowindow_content'] = '1 - Hello World!';
      $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
      $this->googlemap->add_marker($marker);

      $marker = array();
      $marker['position'] = '-6.241586, 106.992416';
      $marker['draggable'] = TRUE;
      $marker['animation'] = 'DROP';
      $this->googlemap->add_marker($marker);

      $marker = array();
      $marker['position'] = '-7.866688, 111.466614';
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

    public function tambah()
    {
      # code...
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('pelanggan/aksi_tambah'),
          'id' => set_value('id'),
    	    'id_pelanggan' => set_value('id_pelanggan'),
    	    'nama_pelanggan' => set_value('nama_pelanggan'),
    	    'no_telp' => set_value('no_telp'),
    	    'nama_dagang' => set_value('nama_dagang'),
    	    'alamat' => set_value('alamat'),
    	    'photo' => set_value('photo'),
    	    'photo_toko' => set_value('photo_toko'),
    	    'kota' => set_value('kota'),
    	    'kelurahan' => set_value('kelurahan'),
    	    'kecamatan' => set_value('kecamatan'),
    	    'lat' => set_value('lat'),
    	    'long' => set_value('long'),
    	    'keterangan' => set_value('keterangan'),
    	    'status' => set_value('status'),
    	    'created_at' => set_value('created_at'),
    	    'updated_at' => set_value('updated_at'),
    	    'wp_karyawan_id_karyawan' => set_value('wp_karyawan_id_karyawan'),
      );
      $data['aktif']			='Pelanggan';
  		$data['title']			='Data Pelanggan';
  		$data['judul']			='Pelanggan';
  		$data['sub_judul']		='';
      $data['content']			= 'form';
      $this->load->view('panel/dashboard', $data);
    }

    public function aksi_tambah()
    {
      # code...
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->tambah();
      } else {
          $data = array(
            'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
            'no_telp' => $this->input->post('no_telp', true),
            'nama_dagang' => $this->input->post('nama_dagang', true),
            'alamat' => $this->input->post('alamat', true),
            'photo' => $this->input->post('photo', true),
            'photo_toko' => $this->input->post('photo_toko', true),
            'kota' => $this->input->post('kota', true),
            'kelurahan' => $this->input->post('kelurahan', true),
            'kecamatan' => $this->input->post('kecamatan', true),
            'lat' => $this->input->post('lat', true),
            'long' => $this->input->post('long', true),
            'keterangan' => $this->input->post('keterangan', true),
            'status' => $this->input->post('status', true),
            'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan', true),
          );
          $this->pelanggan->insert($data);
          $this->session->set_flashdata('message', 'tambah data pelanggan berhasil');
          redirect(site_url('pelanggan'));
      }
    }

    public function update($id)
    {
        $row = $this->Wp_pelanggan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wp_pelanggan/update_action'),
		'id' => set_value('id', $row->id),
		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
		'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'nama_dagang' => set_value('nama_dagang', $row->nama_dagang),
		'alamat' => set_value('alamat', $row->alamat),
		'photo' => set_value('photo', $row->photo),
		'photo_toko' => set_value('photo_toko', $row->photo_toko),
		'kota' => set_value('kota', $row->kota),
		'kelurahan' => set_value('kelurahan', $row->kelurahan),
		'kecamatan' => set_value('kecamatan', $row->kecamatan),
		'lat' => set_value('lat', $row->lat),
		'long' => set_value('long', $row->long),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'status' => set_value('status', $row->status),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'wp_karyawan_id_karyawan' => set_value('wp_karyawan_id_karyawan', $row->wp_karyawan_id_karyawan),
	    );
            $this->load->view('wp_pelanggan/wp_pelanggan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_pelanggan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_pelanggan' => $this->input->post('id_pelanggan',TRUE),
		'nama_pelanggan' => $this->input->post('nama_pelanggan',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'nama_dagang' => $this->input->post('nama_dagang',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'photo' => $this->input->post('photo',TRUE),
		'photo_toko' => $this->input->post('photo_toko',TRUE),
		'kota' => $this->input->post('kota',TRUE),
		'kelurahan' => $this->input->post('kelurahan',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'lat' => $this->input->post('lat',TRUE),
		'long' => $this->input->post('long',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
		'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan',TRUE),
	    );

            $this->Wp_pelanggan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wp_pelanggan'));
        }
    }

    public function ajax_delete($id)
    {
        $this->pelanggan->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function _rules()
    {
      # code...
    	$this->form_validation->set_rules('nama_pelanggan', 'nama pelanggan', 'trim|required');
    	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
    	$this->form_validation->set_rules('nama_dagang', 'nama dagang', 'trim|required');
    	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    	$this->form_validation->set_rules('photo', 'photo', 'trim|required');
    	$this->form_validation->set_rules('photo_toko', 'photo toko', 'trim|required');
    	$this->form_validation->set_rules('kota', 'kota', 'trim|required');
    	$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required');
    	$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
    	$this->form_validation->set_rules('lat', 'lat', 'trim|required');
    	$this->form_validation->set_rules('long', 'long', 'trim|required');
    	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    	$this->form_validation->set_rules('status', 'status', 'trim|required');
    	$this->form_validation->set_rules('wp_karyawan_id_karyawan', 'wp karyawan id karyawan', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


}
