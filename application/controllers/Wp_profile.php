<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wp_profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wp_profile_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wp_profile/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wp_profile/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wp_profile/index.html';
            $config['first_url'] = base_url() . 'wp_profile/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Wp_profile_model->total_rows($q);
        $wp_profile = $this->Wp_profile_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wp_profile_data' => $wp_profile,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('wp_profile/wp_profile_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Wp_profile_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_perusahaan' => $row->nama_perusahaan,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'email' => $row->email,
		'website' => $row->website,
	    );
            $this->load->view('wp_profile/wp_profile_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_profile'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wp_profile/create_action'),
	    'id' => set_value('id'),
	    'nama_perusahaan' => set_value('nama_perusahaan'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'email' => set_value('email'),
	    'website' => set_value('website'),
	);
        $this->load->view('wp_profile/wp_profile_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'email' => $this->input->post('email',TRUE),
		'website' => $this->input->post('website',TRUE),
	    );

            $this->Wp_profile_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wp_profile'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Wp_profile_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wp_profile/update_action'),
		'id' => set_value('id', $row->id),
		'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'email' => set_value('email', $row->email),
		'website' => set_value('website', $row->website),
	    );
            $this->load->view('wp_profile/wp_profile_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_profile'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'email' => $this->input->post('email',TRUE),
		'website' => $this->input->post('website',TRUE),
	    );

            $this->Wp_profile_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wp_profile'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wp_profile_model->get_by_id($id);

        if ($row) {
            $this->Wp_profile_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wp_profile'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_profile'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('website', 'website', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Wp_profile.php */
/* Location: ./application/controllers/Wp_profile.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-01 06:59:07 */
/* http://harviacode.com */