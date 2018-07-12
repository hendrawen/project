<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategorikas extends CI_Controller {

  private $permit;
  public function __construct()
  {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model('Ion_auth_model');
      $this->permit = $this->Ion_auth_model->permission($this->session->identity);
      $this->load->model('Kas_model', 'm_kas');

      if (!$this->ion_auth->logged_in()) {//cek login ga?
          redirect('login','refresh');
      }
  }

    function index(){

      $cek = get_permission('Kas', $this->permit[1]);
      if (!$cek) {
          redirect('panel','refresh');
      }
        $data = array(
            'aktif'      => 'Kategori Kas',
            'menu'       => $this->permit[0],
            'submenu'	   => $this->permit[1],
            'content'    => 'kategorikas_list',
            'judul'      => 'Dashboard',
            'sub_judul'  => 'Kategori Kas',
              'button'     => 'Tambah',
            'action'     => site_url('kas/kategorikas/create_action'),
            'id'  => set_value('id'),
            'nama'   => set_value('nama'),
            'display' => 'none',
            'kategorikas'   => $this->m_kas->get_all()
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function create()
    {
        $cek = get_permission('Kas', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
          'button'     => 'Tambah',
          'action'     => site_url('kas/kategorikas/create_action'),
          'id'  => set_value('id'),
          'nama'   => set_value('nama'),
          'aktif'      => 'Kategori Kas',
          'menu'       => $this->permit[0],
          'submenu'	   => $this->permit[1],
          'content'    => 'kategorikas_form',
          'judul'      => 'Dashboard',
          'sub_judul'  => 'Kategori kas',
          'kategorikas'   => $this->m_kas->get_all()
         );

        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $cek = get_permission('Kas', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }

            $data = array(
            'nama' => $this->input->post('nama',TRUE),
            );

            $this->m_kas->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('kas/kategorikas'));
    }

    public function update($id)
    {
        $cek = get_permission('Kas', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->m_kas->getby_id($id);

        if ($row) {
          $data = array(
            'button'     => 'Update',
            'action'     => site_url('kas/kategorikas/update_action'),
            'id'  => set_value('id', $row->id),
            'nama'   => set_value('nama', $row->nama),
            'aktif'      => 'Kategori Kas',
            'menu'       => $this->permit[0],
            'submenu'	   => $this->permit[1],
            'content'    => 'kategorikas_list',
            'judul'      => 'Dashboard',
            'sub_judul'  => 'Kategori kas',
            'display'   => 'inline-block',
            'kategorikas'   => $this->m_kas->get_all()
           );

            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kas/kategorikas'));
        }
    }

    public function update_action()
    {
        $cek = get_permission('Kas', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }

          $data = array(
          'nama' => $this->input->post('nama',TRUE),
          );

            $this->m_kas->update_kas($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kas/kategorikas'));
    }

    public function delete($id)
    {
        $cek = get_permission('Kas', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->m_kas->getby_id($id);

        if ($row) {
            $this->m_kas->delete_kas($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('kas/kategorikas'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kas/kategorikas'));
        }
    }

}
