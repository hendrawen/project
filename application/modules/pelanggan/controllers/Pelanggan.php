<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin') AND !$this->ion_auth->in_group('members') AND
            !$this->ion_auth->in_group('som')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    $this->load->model('Model_pelanggan','pelanggan');
    $this->load->model('Daerah_model','daerah');
  }

  function index()
  {
    $data['aktif']			='Pelanggan';
		$data['title']			='Brajamarketindo';
		$data['judul']			='Dashboard';
		$data['sub_judul']		='Data Pelanggan';
    $data['content']			= 'main';
    // $kotas = $this->pelanggan->get_list_kota();

    // $opt = array('' => 'Semua Kota');
    //     foreach ($kotas as $kota) {
    //         $opt[$kota] = $kota;
    // }
    // $data['form_kota'] = form_dropdown('',$opt,'','id="kota" class="form-control"');

    $data['list_kota'] = $this->daerah->get_kota();

    $statuse = $this->pelanggan->get_list_status();

    $opt1 = array('' => 'Semua Status');
        foreach ($statuse as $status) {
            $opt1[$status] = $status;
    }

    $data['form_status'] = form_dropdown('',$opt1,'','id="status" class="form-control"');

    // $kecamatans = $this->pelanggan->get_list_kecamatan();

    // $opt2 = array('' => 'Semua Kecamatan');
    //     foreach ($kecamatans as $kecamatan) {
    //         $opt2[$kecamatan] = $kecamatan;
    // }

    // $data['form_kecamatan'] = form_dropdown('',$opt2,'','id="kecamatan" class="form-control"');

    // $kelurahans = $this->pelanggan->get_list_kelurahan();

    // $opt3 = array('' => 'Semua Kelurahan');
    //     foreach ($kelurahans as $kelurahan) {
    //         $opt3[$kelurahan] = $kelurahan;
    // }

    // $data['form_kelurahan'] = form_dropdown('',$opt3,'','id="kelurahan" class="form-control"');

    $surveyors = $this->pelanggan->get_list_surveyor();

    $opt4 = array('' => 'Semua Surveyor');
        foreach ($surveyors as $surveyor) {
            $opt4[$surveyor] = $surveyor;
    }

    $data['form_surveyor'] = form_dropdown('',$opt4,'','id="nama" class="form-control"');

    $bulans = $this->pelanggan->get_list_bulan();

    $opt5 = array('' => 'Bulan');
        foreach ($bulans as $bulan) {
            $opt5[$bulan] = $bulan;
    }

    $data['form_bulan'] = form_dropdown('',$opt5,'','id="bulan" class="form-control"');
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
          $kebutuhan = $this->pelanggan->get_kebutuhan($pelanggans->id);
          $row[] = $pelanggans->nama_pelanggan;
          $row[] = $pelanggans->no_telp;
          $row[] = $pelanggans->nama_dagang;
          $row[] = $pelanggans->nama_kategori;
          $row[] = $pelanggans->alamat;
          $row[] = $pelanggans->kota;
          $row[] = $pelanggans->kelurahan;
          $row[] = $pelanggans->kecamatan;
          $row[] = $pelanggans->lat.'<br />'.$pelanggans->long;
          // $row[] = $pelanggans->long;
          $row[] = $pelanggans->status;
          $list_kebutuhan = "";
          if ($kebutuhan) {

            foreach ($kebutuhan as $sip) {
              $list_kebutuhan .= '
                <ul>
                  <li>'.$sip->jenis.' = '.$sip->jumlah.'</li>
                </ul>
              ';
            }
            $row[] = $list_kebutuhan;
          } else {
            $row[] = "~";
          }
          // $row[] = print_r($kebutuhan);
          if($pelanggans->photo_toko)
              $row[] = '<a href="'.base_url('assets/uploads/'.$pelanggans->photo_toko).'" target="_blank"><img src="'.base_url('assets/uploads/'.$pelanggans->photo_toko).'" class="img-responsive" height="42" width="42"/></a>';
          else
              $row[] = '(tidak ada photo)';
          $row[] = $pelanggans->nama;
          $row[] = tgl_indo($pelanggans->created_at);
          $row[] = '
          <a href="'.base_url('pelanggan/update/'.$pelanggans->id).'" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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
  		$data['title']			='Brajamarketindo';
  		$data['judul']			='Dashboard';
  		$data['sub_judul']		='Mapping Pelanggan';
      $data['content']			= 'maps';
      $config['zoom'] = 'auto';
      $config['places'] = TRUE;
      $config['placesLocation'] = '-6.241586, 106.992416';
      $this->googlemap->initialize($config);
      $mapp = $this->db->query('select * from wp_pelanggan');
      foreach ($mapp->result_array() as $value) {
        # code...
        $lat = $value['lat'];
        $long = $value['long'];
        $info = $value['nama_dagang'];
        $alamat = $value['alamat'];
        $kota = $value['kota'];
        $kecamatan = $value['kecamatan'];
        $kelurahan = $value['kelurahan'];
        $marker = array();
        $marker['position'] = $lat.','.$long;
        $marker['infowindow_content'] = $info. '<br>Kota : ' . $kota. '<br>Kecamatan : ' . $kecamatan.  '<br>Kelurahan : ' . $kelurahan. '<br>alamat lengkap : ' .$alamat;
        $this->googlemap->add_marker($marker);
      }
      $data['map'] = $this->googlemap->create_map();

      $this->load->view('panel/dashboard', $data);
    }

    public function tambah()
    {
        $data = array(
            'list_kategori' => $this->pelanggan->get_kategori(),
              'button' => 'Tambah',
              'action' => site_url('pelanggan/aksi_tambah'),
              'id' => set_value('id'),
        	    'id_pelanggan' => set_value('id_pelanggan'),
        	    'id_kategori' => set_value('id_kategori'),
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
              'list_kota' => $this->daerah->get_kota(),
            	'wp_karyawan_id_karyawan' => set_value('wp_karyawan_id_karyawan'),
          );
          $data['aktif']			='Pelanggan';
      		$data['title']			='Brajamarketindo';
      		$data['judul']			='Dashboard';
      		$data['sub_judul']		='Pelanggan';
          $data['content']			= 'form';
          $data['id_pelanggan'] = $this->pelanggan->get_kode_pelanggan();
          $this->load->view('panel/dashboard', $data);
    }

    public function aksi_tambah()
    {
      # code...
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->tambah();
      } else {
          $config['upload_path'] = 'assets/uploads';
          $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
          $config['max_size'] = '3000'; // kb
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          $this->upload->do_upload('photo');
          $hasil1 = $this->upload->data();
          // upload gambar 2
          $this->upload->do_upload('photo_toko');
          $stat = $this->input->post('status');
          if ($stat!="Responden"){
          $test = $this->input->post('id_pelanggan', true);
          }else{
          $test = '';
          }
          $hasil2 = $this->upload->data();
          if ($hasil1['file_name']=='' && $hasil2['file_name']==''){
                    $data = array(
                      //status lunas
                      'id_pelanggan' => $test,
                      'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                      'no_telp' => $this->input->post('no_telp', true),
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'alamat' => $this->input->post('alamat', true),
                      'id_kategori' => $this->input->post('id_kategori', true),
                      'kota' => $this->input->post('kota', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan', true),
                      'created_at' => date('Y-m-d H:i:s'),
                      'username' => $this->session->identity,
                    );
            }else {
                    $data = array(
                      //status lunas
                      'id_pelanggan' => $test,
                      'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                      'no_telp' => $this->input->post('no_telp', true),
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'id_kategori' => $this->input->post('id_kategori', true),
                      'alamat' => $this->input->post('alamat', true),
                      'photo' => $hasil1['file_name'],
                      'photo_toko' => $hasil2['file_name'],
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'kota' => $this->input->post('kota', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan', true),
                      'created_at' => date('Y-m-d H:i:s'),
                    );
            }
          $this->pelanggan->save($data);
          $this->session->set_flashdata('message', 'tambah data pelanggan berhasil');
          redirect(site_url('pelanggan'));
      }
    }

    public function update($id)
    {
        $row = $this->pelanggan->get_by_id($id);
        if ($row) {
            $data = array(
                'list_kategori' => $this->pelanggan->get_kategori(),
                'button' => 'Update',
                'action' => site_url('pelanggan/update_action'),
            		'id' => set_value('id', $row->id),
            		'id_pelanggan' => set_value('id_pelanggan', $row->id_pelanggan),
            		'id_kategori' => set_value('id_kategori', $row->id_kategori),
            		'nama_pelanggan' => set_value('nama_pelanggan', $row->nama_pelanggan),
            		'no_telp' => set_value('no_telp', $row->no_telp),
            		'nama_dagang' => set_value('nama_dagang', $row->nama_dagang),
                'alamat' => set_value('alamat', $row->alamat),
            		'photo' => set_value('photo', $row->photo),
            		'photo_toko' => set_value('photo_toko', $row->photo_toko),
            		'kota' => set_value('kota', $row->kota),
            		'kelurahan' => set_value('kelurahan', $row->kelurahan),
            		'kecamatan' => set_value('kecamatan', $row->kecamatan),
                'list_kota' => $this->daerah->get_kota(),
            		'lat' => set_value('lat', $row->lat),
            		'long' => set_value('long', $row->long),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'status' => set_value('status', $row->status),
            		'wp_karyawan_id_karyawan' => set_value('wp_karyawan_id_karyawan', $row->wp_karyawan_id_karyawan),
	          );
            $data['aktif']			='Pelanggan';
        		$data['title']			='Edit Data Pelanggan';
        		$data['judul']			='Edit Data Pelanggan';
        		$data['sub_judul']		='';
            $data['content']			= 'form';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pelanggan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
          $config['upload_path'] = 'assets/uploads';
          $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
          $config['max_size'] = '3000'; // kb
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          $this->upload->do_upload('photo');
          $hasil1 = $this->upload->data();
          // upload gambar 2
          $this->upload->do_upload('photo_toko');
          $stat = $this->input->post('status');
          $stat2 = $this->input->post('id_pelanggan');
          if (($stat != "Responden" && $stat2 == "")){
          $test = $this->pelanggan->get_kode_pelanggan();
          }else{
          $test = '';
          }
          $hasil2 = $this->upload->data();
          if ($hasil1['file_name']=='' && $hasil2['file_name']==''){
                    $data = array(
                      'id_pelanggan' => $test,
                      'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                      'no_telp' => $this->input->post('no_telp', true),
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'alamat' => $this->input->post('alamat', true),
                      'kota' => $this->input->post('kota', true),
                      'id_kategori' => $this->input->post('id_kategori', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan', true),
                      'updated_at' => date('Y-m-d H:i:s'),
                      'username' => $this->session->identity,
                    );
            }else {
                    $data = array(
                      'id_pelanggan' => $test,
                      'nama_pelanggan' => $this->input->post('nama_pelanggan', true),
                      'no_telp' => $this->input->post('no_telp', true),
                      'id_kategori' => $this->input->post('id_kategori', true),
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'alamat' => $this->input->post('alamat', true),
                      'photo' => $hasil1['file_name'],
                      'photo_toko' => $hasil2['file_name'],
                      'nama_dagang' => $this->input->post('nama_dagang', true),
                      'kota' => $this->input->post('kota', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan', true),
                      'updated_at' => date('Y-m-d H:i:s'),
                    );
            }
            $this->pelanggan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pelanggan'));
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
    	$this->form_validation->set_rules('kota', 'kota', 'trim|required');
    	$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required');
    	$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
    	$this->form_validation->set_rules('status', 'status', 'trim|required');
    	$this->form_validation->set_rules('wp_karyawan_id_karyawan', 'wp karyawan id karyawan', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_kecamatan($kota)
    {
      $kecamatan = $this->daerah->get_kecamatan($kota);
      $pesan = "";
      $pesan .= '<option value="">--Pilih Kecamatan-- </option>';
  	  foreach($kecamatan as $k){
  	    $pesan.= "<option id_kecamatan='{$k->id_kec}' value='{$k->nama}'>{$k->nama}</option>";
  	  }
      echo $pesan;
    }

    function get_kelurahan($kecamatan)
    {
      $kelurahan = $this->daerah->get_kelurahan($kecamatan);
      $pesan = "";
      $pesan .= '<option value="">--Pilih Kelurahan-- </option>';
      foreach($kelurahan as $k){
  	    $pesan .= "<option value='{$k->nama}'>{$k->nama}</option>";
  	  }
      echo $pesan;
    }


}
