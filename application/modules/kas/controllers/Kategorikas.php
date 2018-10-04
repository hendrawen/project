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
                if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
                        redirect('login','refresh');
                }
    }
  }

    function index(){
        $data = array(
            'aktif'      => 'data-kas',
            'content'    => 'kategorikas_list',
            'judul'      => 'Kategori Kas',
            'sub_judul'  => 'List',
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
        $data = array(
          'button'     => 'Tambah',
          'action'     => site_url('kas/kategorikas/create_action'),
          'id'  => set_value('id'),
          'nama'   => set_value('nama'),
          'aktif'      => 'data-kas',
          'content'    => 'kategorikas_form',
          'judul'      => 'Kategori Kas',
          'sub_judul'  => 'Tambah',
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
            redirect(site_url('kas/kategorikas'));
    }

    public function update($id)
    {
        $row = $this->m_kas->getby_id($id);

        if ($row) {
          $data = array(
            'button'     => 'Update',
            'action'     => site_url('kas/kategorikas/update_action'),
            'id'  => set_value('id', $row->id),
            'nama'   => set_value('nama', $row->nama),
            'aktif'      => 'data-kas',
            'content'    => 'kategorikas_list',
            'judul'      => 'Kategori Kas',
            'sub_judul'  => 'Ubah',
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
          $data = array(
          'nama' => $this->input->post('nama',TRUE),
          );

            $this->m_kas->update_kas($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kas/kategorikas'));
    }

    public function delete($id)
    {
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
