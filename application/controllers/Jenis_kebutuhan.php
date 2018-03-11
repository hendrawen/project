<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_kebutuhan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_jkebutuhan');
        $this->load->library('form_validation');
    }

    public function index()
    {
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
        $this->load->view('jenis_kebutuhan/wp_jkebutuhan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Model_jkebutuhan->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'jenis' => $row->jenis,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->load->view('jenis_kebutuhan/wp_jkebutuhan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_kebutuhan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_kebutuhan/create_action'),
	    'id' => set_value('id'),
	    'jenis' => set_value('jenis'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->load->view('jenis_kebutuhan/wp_jkebutuhan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jenis' => $this->input->post('jenis',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Model_jkebutuhan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_kebutuhan'));
        }
    }
    
    public function update($id) 
    {
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
            $this->load->view('jenis_kebutuhan/wp_jkebutuhan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_kebutuhan'));
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
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->Model_jkebutuhan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_kebutuhan'));
        }
    }
    
    public function delete($id) 
    {
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
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_kebutuhan.php */
/* Location: ./application/controllers/Jenis_kebutuhan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-08 10:56:41 */
/* http://harviacode.com */