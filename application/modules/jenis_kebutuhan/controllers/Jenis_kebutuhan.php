<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kebutuhan extends CI_Controller{
  
  private $permit;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ion_auth_model');
    $this->permit = $this->Ion_auth_model->permission($this->session->identity);
    $this->load->model('Model_jkebutuhan');
    //Codeigniter : Write Less Do More
  }

  public function index()
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $q = urldecode($this->input->get('q', TRUE));
      $start = intval($this->input->get('start'));

      if ($q <> '') {
          $config['base_url'] = base_url() . 'jenis_kebutuhan/index.html?q=' . urlencode($q);
          $config['first_url'] = base_url() . 'jenis_kebutuhan/index.html?q=' . urlencode($q);
      } else {
          $config['base_url'] = base_url() . 'jenis_kebutuhan/index.html';
          $config['first_url'] = base_url() . 'jenis_kebutuhan/index.html';
      }

      $config['per_page'] = 10;
      $config['page_query_string'] = TRUE;
      $config['total_rows'] = $this->Model_jkebutuhan->total_rows($q);
      $jenis_kebutuhan = $this->Model_jkebutuhan->get_limit_data($config['per_page'], $start, $q);

      $this->load->library('pagination');
      $this->pagination->initialize($config);

      $data = array(
          'jenis_kebutuhan_data' => $jenis_kebutuhan,
          'q' => $q,
          'pagination' => $this->pagination->create_links(),
          'total_rows' => $config['total_rows'],
          'start' => $start,
      );
      $data['aktif']			='Master';
  		$data['title']			='Kebuthan Pelanggan';
  		$data['judul']			='Data Kebutuhan Pelanggan';
          $data['sub_judul']		='';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
      $data['content']			= 'jenis';
      $this->load->view('panel/dashboard', $data);
  }

  public function tambah()
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('jenis_kebutuhan/create_action'),
          'id' => set_value('id'),
          'jenis' => set_value('jenis'),
          'created_at' => set_value('created_at'),
          'updated_at' => set_value('updated_at'),
          );
          $data['aktif']			='Master';
          $data['title']			='Kebuthan Pelanggan';
          $data['judul']			='Data Kebutuhan Pelanggan';
          $data['sub_judul']		='';
          $data['menu']			= $this->permit[0];
          $data['submenu']		= $this->permit[1];
          $data['content']			= 'form';
          $this->load->view('panel/dashboard', $data);
  }

  public function create_action()
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->tambah();
      } else {
          $data = array(
          'jenis' => $this->input->post('jenis',TRUE),
          'created_at' => date('Y-m-d H:i:s'),
            );
            $data['menu']			= $this->permit[0];
            $data['submenu']		= $this->permit[1];
          $this->Model_jkebutuhan->insert($data);
          $this->session->set_flashdata('message', 'Create Record Success');
          redirect(site_url('jenis_kebutuhan'));
          }
  }

  public function update($id)
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $row = $this->Model_jkebutuhan->get_by_id($id);

      if ($row) {
          $data = array(
              'button' => 'Update',
              'action' => site_url('jenis_kebutuhan/update_action'),
              'id' => set_value('id', $row->id),
              'jenis' => set_value('jenis', $row->jenis),
              'created_at' => set_value('created_at', $row->created_at),
              'updated_at' => set_value('updated_at', $row->updated_at),
            );
            $data['aktif']			='Master';
            $data['title']			='Kebuthan Pelanggan';
            $data['judul']			='Data Kebutuhan Pelanggan';
            $data['sub_judul']		='';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $data['content']			= 'form';
            $this->load->view('panel/dashboard', $data);
          } else {
              $this->session->set_flashdata('message', 'Record Not Found');
              redirect(site_url('jenis_kebutuhan'));
          }
  }

  public function update_action()
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
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
          redirect(site_url('jenis_kebutuhan'));
      }
  }

  public function delete($id)
  {   
    $cek = get_permission('Jenis Kebutuhan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $row = $this->Model_jkebutuhan->get_by_id($id);

      if ($row) {
          $this->Model_jkebutuhan->delete($id);
          $this->session->set_flashdata('message', 'Delete Record Success');
          redirect(site_url('jenis_kebutuhan'));
      } else {
          $this->session->set_flashdata('message', 'Record Not Found');
          redirect(site_url('jenis_kebutuhan'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}
