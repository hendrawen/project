<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kategori/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kategori/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kategori/index.html';
            $config['first_url'] = base_url() . 'kategori/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kategori_model->total_rows($q);
        $kategori = $this->Kategori_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        /*
        
        $data['jabatan']   = $this->jabatan_model->get_all();
        
        */
        $data = array(
            'kategori_data' => $kategori,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'aktif' => 'Setup',
            'title'	=> 'Brajamarketindo',
            'judul'	=> 'Kategori',
            'sub_judul'	=> 'Kategori',
            'content'	=> 'kategori/wp_kategori_list',
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setup/kategori/create_action'),
      	    'id_kategori' => set_value('id_kategori'),
      	    'nama_kategori' => set_value('nama_kategori'),
            'aktif' => 'Setup',
            'title'	=> 'Brajamarketindo',
            'judul'	=> 'Kategori',
            'sub_judul'	=> 'Kategori',
            'content'	=> 'kategori/wp_kategori_form',
      	);
        $this->load->view('panel/dashboard', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		            'nama_kategori' => $this->input->post('nama_kategori',TRUE),
            );

            $this->Kategori_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Create Record Success</div>');
            redirect(site_url('setup/kategori'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setup/kategori/update_action'),
              		'id_kategori' => set_value('id_kategori', $row->id_kategori),
              		'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),
                  'aktif' => 'Setup',
                  'title'	=> 'Brajamarketindo',
                  'judul'	=> 'Kategori',
                  'sub_judul'	=> 'Kategori',
                  'content'	=> 'kategori/wp_kategori_form',
        	    );
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Record Not Found</div>');
            redirect(site_url('setup/kategori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
	    );

            $this->Kategori_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Update Record Success</div>');
            redirect(site_url('setup/kategori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $this->Kategori_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Delete Record Success</div>');
            redirect(site_url('setup/kategori'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Record Not Found</div>');
            redirect(site_url('setup/kategori'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kategori', 'nama kategori', 'trim|required');

	$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-16 04:27:35 */
/* http://harviacode.com */