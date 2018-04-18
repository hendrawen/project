<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('barang/Barang_model','barang/Stok_model'));
  }

  function index()
  {
    $data = array(
        'aktif'			=>'gudang',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Gudang',
        'content'		=>'content',
    );
    $this->load->view('gudang/dashboard', $data);
  }
  /* ----------------
        barang
  ---------------- */
  function barang()
  {

    $data = array(
        'barang' => $this->Barang_model->get_all_gudang(),
        'aktif'			=>'Gudang',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Barang',
        'content'		=>'gudang/barang/barang_list',
    );
    $this->load->view('gudang/dashboard', $data);
  }

  function barang_create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('gudang/barang_create_action'),
        'id' => set_value('id'),
        'id_barang' => set_value('id_barang'),
        'nama_barang' => set_value('nama_barang'),
        'harga_beli' => set_value('harga_beli'),
        'harga_jual' => set_value('harga_jual'),
        'satuan' => set_value('satuan'),
        'wp_suplier_id' => set_value('wp_suplier_id'),
        'created_at' => set_value('created_at'),
        'updated_at' => set_value('updated_at'),
      );
    $data['aktif']			='Master';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Tambah Barang';
    $data['content']		='gudang/barang/barang_form';
    $this->load->view('gudang/dashboard', $data);
  }

  function barang_create_action()
  {
    $this->barang_rules();
    $datestring = '%Y-%m-%d %h:%i:%s';
    $time = time();
    if ($this->form_validation->run() == FALSE) {
        $this->barang_create();
    } else {
        $data = array(
          'id_barang' => $this->Barang_model->buat_kode(),
          'nama_barang' => $this->input->post('nama_barang',TRUE),
          'harga_beli' => $this->input->post('harga_beli',TRUE),
          'harga_jual' => $this->input->post('harga_jual',TRUE),
          'satuan' => $this->input->post('satuan',TRUE),
          'wp_suplier_id' => $this->input->post('wp_suplier_id',TRUE),
          'created_at' => date('Y-m-d H:i:s'),
          'username' => $this->session->identity,
         );

        $this->Barang_model->insert($data);
        $this->session->set_flashdata('message', 'Simpan Data Success');
        redirect(site_url('gudang/barang'));
    }
  }

  public function barang_update($id)
  {
      $row = $this->Barang_model->get_by_id($id);
      if ($row) {
          $data = array(
              'button' => 'Update',
              'action' => site_url('gudang/barang_update_action'),
          'id' => set_value('id', $row->id),
          'id_barang' => set_value('id_barang', $row->id_barang),
          'nama_barang' => set_value('nama_barang', $row->nama_barang),
          'harga_beli' => set_value('harga_beli', $row->harga_beli),
          'harga_jual' => set_value('harga_jual', $row->harga_jual),
          'satuan' => set_value('satuan', $row->satuan),
          'wp_suplier_id' => set_value('wp_suplier_id', $row->wp_suplier_id),
          'created_at' => set_value('created_at', $row->created_at),
          'updated_at' => set_value('updated_at', $row->updated_at),
          );
          $data['aktif']			='Master';
          $data['title']			='Brajamarketindo';
          $data['judul']			='Dashboard';
          $data['sub_judul']	='Edit Barang';
          $data['content']		='gudang/barang/barang_form';
          $this->load->view('gudang/dashboard', $data);
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('gudang/barang'));
      }
  }

  public function barang_update_action()
  {
      $this->barang_rules();
      $datestring = '%Y-%m-%d %h:%i:%s';
      $time = time();
      if ($this->form_validation->run() == FALSE) {
          $this->barang_update($this->input->post('id', TRUE));
      } else {
          $data = array(
            'nama_barang' => $this->input->post('nama_barang',TRUE),
            'harga_beli' => $this->input->post('harga_beli',TRUE),
            'harga_jual' => $this->input->post('harga_jual',TRUE),
            'satuan' => $this->input->post('satuan',TRUE),
            'wp_suplier_id' => $this->input->post('wp_suplier_id',TRUE),
            'username' => $this->session->identity,
            'updated_at' => date('Y-m-d H:i:s'),
          );

          $this->Barang_model->update($this->input->post('id', TRUE), $data);
          $this->session->set_flashdata('message', 'Update Data Success');
          redirect(site_url('gudang/barang'));
      }
  }

  public function barang_delete($id)
  {
      //$row = $this->Barang_model->get_by_id($id);
      $row = $this->Barang_model->cek_kode_stok($id);
      if ($row) {
          $this->session->set_flashdata('msg', 'Maaf, Data Barang Ini Masih Ada Stok, Mohon Hapus Stoknya Dulu!!!');
          redirect(site_url('gudang/barang'));
      } else {
        $this->Barang_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Data Success');
        redirect(site_url('gudang/barang'));
      }
  }

  public function barang_rules()
  {
    $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
    $this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
    $this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');
    $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
    $this->form_validation->set_rules('wp_suplier_id', 'wp suplier id', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  /* ----------------
      end barang
  ---------------- */
  /* ----------------
      stok
  ---------------- */

  function stok()
  {
    $data = array(
        'stok' => $this->Stok_model->get_all_gudang(),
        'aktif'			=>'stok',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Stok',
        'content'		=>'gudang/stok/stok_list',
    );
    $this->load->view('gudang/dashboard', $data);
  }

  function stok_create()
  {
    $data = array(
        'button' => 'Simpan',
        'action' => site_url('gudang/stok_create_action'),
        'id' => set_value('id'),
        'wp_barang_id' => set_value('wp_barang_id'),
        'wp_gudang_id' => set_value('wp_gudang_id'),
        'stok' => set_value('stok'),
        'updated_at' => set_value('updated_at'),
        'aktif'			=>'stok',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Stok',
        'content'		=>'gudang/stok/stok_form',
    );
    $this->load->view('gudang/dashboard', $data);
  }

  function stok_create_action()
  {
      $this->stok_rules();
      $datestring = '%Y-%m-%d %h:%i:%s';
      $time = time();
      if ($this->form_validation->run() == FALSE) {
          $this->stok_create();
      } else {
          $data = array(
            'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
            'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
            'stok' => $this->input->post('stok',TRUE),
          );
          $this->Stok_model->insert($data);
          $this->session->set_flashdata('message', 'Data Success Disimpan');
          redirect(site_url('barang/stok'));
      }
  }

  function stok_update($id)
  {
      $row = $this->Stok_model->get_by_id($id);
      if ($row) {
          $data = array(
              'button' => 'Update',
              'action' => site_url('gudang/stok_update_action'),
              'id' => set_value('id', $row->id),
              'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
              'wp_gudang_id' => set_value('wp_gudang_id', $row->wp_gudang_id),
              'stok' => set_value('stok', $row->stok),
              'updated_at' => set_value('updated_at', $row->updated_at),
              'aktif'			=>'stok',
              'title'			=>'Brajamarketindo',
              'judul'			=>'Dashboard',
              'sub_judul'	=>'Stok',
              'content'		=>'gudang/stok/stok_form',
            );
          $this->load->view('gudang/dashboard', $data);
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('gudang/stok'));
      }
  }

  function stok_update_action()
  {
    $this->stok_rules();
    $datestring = '%Y-%m-%d %h:%i:%s';
    $time = time();
    if ($this->form_validation->run() == FALSE) {
        $this->stok_update($this->input->post('id', TRUE));
    } else {
        $data = array(
        'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
        'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
        'stok' => $this->input->post('stok',TRUE),
        'updated_at' => mdate($datestring, $time),
      );

        $this->Stok_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Data Success');
        redirect(site_url('gudang/stok'));
    }
  }

  function stok_delete($id)
  {
    $row = $this->Stok_model->get_by_id($id);
    if ($row) {
        $this->Stok_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Data Success');
        redirect(site_url('gudang/stok'));
    } else {
        $this->session->set_flashdata('msg', 'Data Tidak Ada');
        redirect(site_url('gudang/stok'));
    }
  }

  function stok_rules()
  {
    $this->form_validation->set_rules('wp_barang_id', 'wp barang id', 'trim|required');
  	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
  	$this->form_validation->set_rules('wp_gudang_id', 'gudang', 'trim|required');
  	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
  /* ----------------
      end stok
  ---------------- */
}
