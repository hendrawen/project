<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('Marketing')) {//cek admin ga?
                redirect('login','refresh');
            }
    }
    //Codeigniter : Write Less Do More
    $this->load->model('Marketing_models', 'marketing');
    $this->load->model('kebutuhan/Model_kebutuhan','kebutuhan');
    $this->load->model('pelanggan/Daerah_model','daerah');
  }
  public function index()
  {
  $q = urldecode($this->input->get('q', TRUE));
  $start = intval($this->input->get('start'));

  if ($q <> '') {
      $config['base_url'] = base_url() . 'marketing/index?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'marketing/index?q=' . urlencode($q);
  } else {
      $config['base_url'] = base_url() . 'marketing/index';
      $config['first_url'] = base_url() . 'marketing/index';
  }

  $config['per_page'] = 6;
  $config['page_query_string'] = TRUE;
  $config['total_rows'] = $this->marketing->total_rows($q);
  $marketing = $this->marketing->get_limit_data($config['per_page'], $start, $q);

  $this->load->library('pagination');
  $this->pagination->initialize($config);

  $data = array(
      'marketing_data' => $marketing,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
  );
  $data['aktif']			='Dashboard';
  $data['title']			='Brajamarketindo';
  $data['judul']			='Dashboard';
  $data['sub_judul']	='Marketing';
  $data['content']		='content';
  $data['total_pelanggan'] = $this->marketing->total_pelanggan();
  $data['total_responden'] = $this->marketing->total_responden();
  $data['pelanggan_perbulan'] = $this->marketing->pelanggan_perbulan();
  $data['responden_perbulan'] = $this->marketing->responden_perbulan();
  $data['total'] = $this->marketing->total_transaksi();
  $this->load->view('marketing/dashboard',$data);
  }

  public function kebutuhan()
  {
    # code...
    $data = array(
        'button' => 'Simpan',
        'action' => site_url('marketing/create_action'),
        'id' => set_value('id'),
        'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
        'wp_jkebutuhan_id' => set_value('wp_jkebutuhan_id'),
        'jumlah' => set_value('jumlah'),
        'tgl' => set_value('tgl'),
    );
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pelanggan';
    $data['sub_judul']	='Kebutuhan';
    $data['content']		='form_kebutuhan';
    $this->load->view('marketing/dashboard',$data);

  }

  public function create_action()
  {
      $this->_rules_kebutuhan();

      if ($this->form_validation->run() == FALSE) {
          $this->kebutuhan();
      } else {
          $data = array(
            'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
            'wp_jkebutuhan_id' => $this->input->post('wp_jkebutuhan_id',TRUE),
            'jumlah' => $this->input->post('jumlah',TRUE),
            'tgl' => date('Y-m-d H:i:s'),
            'username' => $this->session->identity,
           );

          $this->kebutuhan->save($data);
          $this->session->set_flashdata('message', 'Kebutuhan pelanggan berhasil di tambahkan');
          redirect(site_url('marketing'));
      }
  }

  public function transaksi_pelanggan($id)
  {
    # code...

    $id_pelanggan = $this->uri->segment(3);
    $row = $this->marketing->get_by_idpelanggan($id);
    if ($row) {
        $data = array(
        'id_pelanggan' => $row->id_pelanggan,
        'nama_pelanggan' => $row->nama_pelanggan,
        'nama_dagang' => $row->nama_dagang,
        'no_telp' => $row->no_telp,
        'photo' => $row->photo,
        'status' => $row->status,
        'alamat' => $row->alamat,
        'photo_toko' => $row->photo_toko,
        'kota'  => $row->kota,
        'kelurahan' => $row->kelurahan,
        'kecamatan' => $row->kecamatan,
        'status'  => $row->status,
        'created_at'  => $row->created_at,
        'updated_at'  => $row->updated_at,
          );
        $data['aktif']			='marketing';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Detail';
        $data['sub_judul']	='Pelanggan';
        $data['content']		='detail_transaksi';
        $data['total_transaksi'] = $this->marketing->detail_total_transaksi($id_pelanggan);
        $data['riwayat_transaksi'] =  $this->marketing->transaksi_detail_pelanggan($id_pelanggan);
        $this->load->view('marketing/dashboard', $data);
    } else {
        $this->session->set_flashdata('msg', 'Data Tidak Ada');
        redirect(site_url('marketing'));
    }
  }

  public function detail($id)
  {
      $row = $this->marketing->get_by_id($id);
      if ($row) {
          $data = array(
          'id_pelanggan' => $row->id_pelanggan,
          'nama_pelanggan' => $row->nama_pelanggan,
          'nama_dagang' => $row->nama_dagang,
          'no_telp' => $row->no_telp,
          'photo' => $row->photo,
          'status' => $row->status,
          'alamat' => $row->alamat,
          'photo_toko' => $row->photo_toko,
          'kota'  => $row->kota,
          'kelurahan' => $row->kelurahan,
          'kecamatan' => $row->kecamatan,
          'status'  => $row->status,
          'created_at'  => $row->created_at,
          'updated_at'  => $row->updated_at,
            );
          $data['aktif']			='marketing';
          $data['title']			='Brajamarketindo';
          $data['judul']			='Detail';
          $data['sub_judul']	='Pelanggan';
          $data['content']		='detail';
          $this->load->view('marketing/dashboard', $data);
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('marketing'));
      }
  }

  public function tambah()
  {
    $data = array(
        'list_kategori' => $this->marketing->get_kategori(),
          'button' => 'Tambah',
          'action' => site_url('marketing/aksi_tambah'),
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
            'kecamatan' => set_value('kecamatan'),
            'kelurahan' => set_value('kelurahan'),
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
      $data['id_pelanggan']     = $this->marketing->get_kode_pelanggan();
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
          if ($stat!=="Responden" && $stat!=="Leads"){
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
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->session->identity,
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
                      'kecamatan' => $this->input->post('kecamatan', true),
                      'kelurahan' => $this->input->post('kelurahan', true),
                      'lat' => $this->input->post('lat', true),
                      'long' => $this->input->post('long', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'status' => $this->input->post('status', true),
                      'wp_karyawan_id_karyawan' => $this->session->identity,
                      'created_at' => date('Y-m-d H:i:s'),
                    );
            }
          $this->marketing->save($data);
          $this->session->set_flashdata('message', 'tambah data pelanggan berhasil');
          redirect(site_url('marketing'));
    }
  }

  public function update($id)
  {
      $row = $this->marketing->get_by_id($id);
      if ($row) {
        $data = array(
            'list_kategori' => $this->marketing->get_kategori(),
            'button' => 'Update',
            'action' => site_url('marketing/update_action'),
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
                'kecamatan' => set_value('kecamatan', $row->kecamatan),
                'kelurahan' => set_value('kelurahan', $row->kelurahan),
                'list_kota' => $this->daerah->get_kota(),
                'lat' => set_value('lat', $row->lat),
                'long' => set_value('long', $row->long),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'status' => set_value('status', $row->status),
                'wp_karyawan_id_karyawan' => $this->session->identity,
          );
        $data['aktif']			='Pelanggan';
        $data['title']			='Edit Data Pelanggan';
        $data['judul']			='Edit Data Pelanggan';
        $data['sub_judul']		='';
        $data['content']			= 'form';
        $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('marketing'));
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
      }else if ($stat2 !== ""){
      $test = $stat2;
      } else {
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
                  'wp_karyawan_id_karyawan' => $this->session->identity,
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
                        'wp_karyawan_id_karyawan' => $this->session->identity,
                        'updated_at' => date('Y-m-d H:i:s'),
                        );
                }
          $this->marketing->update($this->input->post('id', TRUE), $data);
          $this->session->set_flashdata('message', 'Update Record Success');
          redirect(site_url('marketing'));
      }
  }

  public function ajax_delete($id)
  {
      $this->marketing->delete_by_id($id);
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

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function _rules_kebutuhan()
  {
      $this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
      $this->form_validation->set_rules('wp_jkebutuhan_id', 'wp jkebutuhan id', 'trim|required');
      $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

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
