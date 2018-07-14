<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategorikas extends CI_Controller {

  private $permit;
  public function __construct()
  {
      parent::__construct();
      //Codeigniter : Write Less Do More
      $this->load->model('Kas_model', 'm_kas');
      if (!$this->ion_auth->logged_in()) {//cek login ga?
        redirect('login','refresh');
        }else{
                if (!$this->ion_auth->in_group('Admin & Finance')) {//cek admin ga?
                        redirect('login','refresh');
                }
    }
  }

    function index(){
        $data = array(
            'aktif'      => 'Kategori Kas',
            'menu'       => $this->permit[0],
            'submenu'	   => $this->permit[1],
            'content'    => 'kas/kategorikas_list',
            'judul'      => 'Dashboard',
            'sub_judul'  => 'Kategori Kas',
            'button'     => 'Tambah',
            'action'     => site_url('admin/kategorikas/create_action'),
            'id'  => set_value('id'),
            'nama'   => set_value('nama'),
            'display' => 'none',
            'kategorikas'   => $this->m_kas->get_all()
        );
        $this->load->view('dashboard', $data);
    }

    public function create()
    {
        $data = array(
          'button'     => 'Tambah',
          'action'     => site_url('admin/kategorikas/create_action'),
          'id'  => set_value('id'),
          'nama'   => set_value('nama'),
          'aktif'      => 'Kategori Kas',
          'menu'       => $this->permit[0],
          'submenu'	   => $this->permit[1],
          'content'    => 'kas/kategorikas_form',
          'judul'      => 'Dashboard',
          'sub_judul'  => 'Kategori kas',
          'kategorikas'   => $this->m_kas->get_all()
         );

        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
            $data = array(
            'nama' => $this->input->post('nama',TRUE),
            );

            $this->m_kas->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('admin/kategorikas'));
    }

    public function update($id)
    {
        $row = $this->m_kas->getby_id($id);

        if ($row) {
          $data = array(
            'button'     => 'Update',
            'action'     => site_url('admin/kategorikas/update_action'),
            'id'  => set_value('id', $row->id),
            'nama'   => set_value('nama', $row->nama),
            'aktif'      => 'Kategori Kas',
            'menu'       => $this->permit[0],
            'submenu'	   => $this->permit[1],
            'content'    => 'kas/kategorikas_list',
            'judul'      => 'Dashboard',
            'sub_judul'  => 'Kategori kas',
            'display'   => 'inline-block',
            'kategorikas'   => $this->m_kas->get_all()
           );

            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('admin/kategorikas'));
        }
    }

    public function update_action()
    {
          $data = array(
          'nama' => $this->input->post('nama',TRUE),
          );

            $this->m_kas->update_kas($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/kategorikas'));
    }

    public function delete($id)
    {
        $row = $this->m_kas->getby_id($id);

        if ($row) {
            $this->m_kas->delete_kas($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('admin/kategorikas'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('admin/kategorikas'));
        }
    }

}
