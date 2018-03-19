<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/pendaftaran/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/pendaftaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/pendaftaran/index.html';
            $config['first_url'] = base_url() . 'users/pendaftaran/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pendaftaran_model->total_rows($q);
        $pendaftaran = $this->Pendaftaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pendaftaran_data' => $pendaftaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pendaftaran/pendaftaran_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pendaftaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pendaftaran' => $row->id_pendaftaran,
		'nama_lengkap' => $row->nama_lengkap,
		'email' => $row->email,
		'no_telp' => $row->no_telp,
		'nama_subdomain' => $row->nama_subdomain,
		'paket_layanan' => $row->paket_layanan,
		'kota' => $row->kota,
		'tgl_entry' => $row->tgl_entry,
	    );
            $this->load->view('pendaftaran/pendaftaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users/pendaftaran'));
        }
    }

    
    public function update($id) 
    {
        $row = $this->Pendaftaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/pendaftaran/update_action'),
        		'id_pendaftaran' => set_value('id_pendaftaran', $row->id_pendaftaran),
        		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
        		'email' => set_value('email', $row->email),
        		'no_telp' => set_value('no_telp', $row->no_telp),
        		'nama_subdomain' => set_value('nama_subdomain', $row->nama_subdomain),
        		'paket_layanan' => set_value('paket_layanan', $row->paket_layanan),
        		'kota' => set_value('kota', $row->kota),
        		'tgl_entry' => set_value('tgl_entry', $row->tgl_entry),
	    );
            $this->load->view('pendaftaran/pendaftaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users/pendaftaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pendaftaran', TRUE));
        } else {
            $data = array(
    		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
    		'email' => $this->input->post('email',TRUE),
    		'no_telp' => $this->input->post('no_telp',TRUE),
    		'nama_subdomain' => $this->input->post('nama_subdomain',TRUE),
    		'paket_layanan' => $this->input->post('paket_layanan',TRUE),
    		'kota' => $this->input->post('kota',TRUE),
    		'tgl_entry' => $this->input->post('tgl_entry',TRUE),
	    );

            $this->Pendaftaran_model->update($this->input->post('id_pendaftaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users/pendaftaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pendaftaran_model->get_by_id($id);

        if ($row) {
            $this->Pendaftaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users/pendaftaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users/pendaftaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('nama_subdomain', 'nama subdomain', 'trim|required');
	$this->form_validation->set_rules('paket_layanan', 'paket layanan', 'trim|required');
	$this->form_validation->set_rules('kota', 'kota', 'trim|required');

	$this->form_validation->set_rules('id_pendaftaran', 'id_pendaftaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/Pendaftaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-12 06:07:38 */
/* http://harviacode.com */