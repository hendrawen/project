<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kebutuhan extends CI_Controller{
  
  private $permit;
  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
        redirect('login','refresh');
        }else{
                if (!$this->ion_auth->in_group('Validator')) {//cek admin ga?
                        redirect('login','refresh');
                }
    }
    $this->load->model('validator/Model_jkebutuhan');
    //Codeigniter : Write Less Do More
  }

  public function index()
  {   
      $jenis_kebutuhan = $this->Model_jkebutuhan->get_all();

      $data = array(
          'jenis_kebutuhan_data' => $jenis_kebutuhan,
      );
      $data['aktif']			='Pelanggan';
  		$data['title']			='Kebutuhan Pelanggan';
  		$data['judul']			='Kebutuhan Pelanggan';
          $data['sub_judul']		='Jenis Kebutuhan Pelanggan';
      $data['content']			= 'jenis_kebutuhan/jenis';
      $this->load->view('dashboard', $data);
  }

  public function tambah()
  {   
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('validator/jenis_kebutuhan/create_action'),
          'id' => set_value('id'),
          'jenis' => set_value('jenis'),
          'created_at' => set_value('created_at'),
          'updated_at' => set_value('updated_at'),
          );
          $data['aktif']			='Master';
          $data['title']			='Kebuthan Pelanggan';
          $data['judul']			='Data Kebutuhan Pelanggan';
          $data['sub_judul']		='';
          $data['content']			= 'jenis_kebutuhan/form';
          $this->load->view('dashboard', $data);
  }

  public function create_action()
  {   
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->tambah();
      } else {
          $data = array(
          'jenis' => $this->input->post('jenis',TRUE),
          'created_at' => date('Y-m-d H:i:s'),
            );
          $this->Model_jkebutuhan->insert($data);
          $this->session->set_flashdata('message', 'Create Record Success');
          redirect(site_url('validator/jenis_kebutuhan'));
          }
  }

  public function update($id)
  {   
      $row = $this->Model_jkebutuhan->get_by_id($id);

      if ($row) {
          $data = array(
              'button' => 'Update',
              'action' => site_url('validator/jenis_kebutuhan/update_action'),
              'id' => set_value('id', $row->id),
              'jenis' => set_value('jenis', $row->jenis),
              'created_at' => set_value('created_at', $row->created_at),
              'updated_at' => set_value('updated_at', $row->updated_at),
            );
            $data['aktif']			='Master';
            $data['title']			='Kebuthan Pelanggan';
            $data['judul']			='Data Kebutuhan Pelanggan';
            $data['sub_judul']		='';
            $data['content']			= 'jenis_kebutuhan/form';
            $this->load->view('dashboard', $data);
          } else {
              $this->session->set_flashdata('message', 'Record Not Found');
              redirect(site_url('validator/jenis_kebutuhan'));
          }
  }

  public function update_action()
  {   
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->update($this->input->post('id', TRUE));
      } else {
          $data = array(
          'jenis' => $this->input->post('jenis',TRUE),
          'updated_at' => date('Y-m-d H:i:s'),
          );

          $this->Model_jkebutuhan->update($this->input->post('id', TRUE), $data);
          $this->session->set_flashdata('message', 'Update Record Success');
          redirect(site_url('validator/jenis_kebutuhan'));
      }
  }

  public function delete($id)
  {   
      $row = $this->Model_jkebutuhan->get_by_id($id);

      if ($row) {
          $this->Model_jkebutuhan->delete($id);
          $this->session->set_flashdata('message', 'Delete Record Success');
          redirect(site_url('validator/jenis_kebutuhan'));
      } else {
          $this->session->set_flashdata('message', 'Record Not Found');
          redirect(site_url('validator/jenis_kebutuhan'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}
