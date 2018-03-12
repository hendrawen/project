<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kebutuhan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kebutuhan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kebutuhan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kebutuhan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kebutuhan/index.html';
            $config['first_url'] = base_url() . 'kebutuhan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Model_kebutuhan->total_rows($q);
        $kebutuhan = $this->Model_kebutuhan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kebutuhan_data' => $kebutuhan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('kebutuhan/wp_kebutuhan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Model_kebutuhan->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'wp_pelanggan_id' => $row->wp_pelanggan_id,
		'wp_jkebutuhan_id' => $row->wp_jkebutuhan_id,
		'jumlah' => $row->jumlah,
		'tgl' => $row->tgl,
	    );
            $this->load->view('kebutuhan/wp_kebutuhan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kebutuhan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kebutuhan/create_action'),
	    'id' => set_value('id'),
	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
	    'wp_jkebutuhan_id' => set_value('wp_jkebutuhan_id'),
	    'jumlah' => set_value('jumlah'),
	    'tgl' => set_value('tgl'),
	);
        $this->load->view('kebutuhan/wp_kebutuhan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
		'wp_jkebutuhan_id' => $this->input->post('wp_jkebutuhan_id',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
	    );

            $this->Model_kebutuhan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kebutuhan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_kebutuhan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kebutuhan/update_action'),
		'id' => set_value('id', $row->id),
		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
		'wp_jkebutuhan_id' => set_value('wp_jkebutuhan_id', $row->wp_jkebutuhan_id),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'tgl' => set_value('tgl', $row->tgl),
	    );
            $this->load->view('kebutuhan/wp_kebutuhan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kebutuhan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
		'wp_jkebutuhan_id' => $this->input->post('wp_jkebutuhan_id',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
	    );

            $this->Model_kebutuhan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kebutuhan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_kebutuhan->get_by_id($id);

        if ($row) {
            $this->Model_kebutuhan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kebutuhan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kebutuhan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
	$this->form_validation->set_rules('wp_jkebutuhan_id', 'wp jkebutuhan id', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kebutuhan.php */
/* Location: ./application/controllers/Kebutuhan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-08 11:01:57 */
/* http://harviacode.com */