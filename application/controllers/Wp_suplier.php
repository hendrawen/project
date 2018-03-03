<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wp_suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wp_suplier_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('wp_suplier/wp_suplier_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Wp_suplier_model->json();
    }

    public function read($id) 
    {
        $row = $this->Wp_suplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_suplier' => $row->id_suplier,
		'nama_suplier' => $row->nama_suplier,
		'alamat' => $row->alamat,
	    );
            $this->load->view('wp_suplier/wp_suplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_suplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wp_suplier/create_action'),
	    'id' => set_value('id'),
	    'id_suplier' => set_value('id_suplier'),
	    'nama_suplier' => set_value('nama_suplier'),
	    'alamat' => set_value('alamat'),
	);
        $this->load->view('wp_suplier/wp_suplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_suplier' => $this->input->post('id_suplier',TRUE),
		'nama_suplier' => $this->input->post('nama_suplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Wp_suplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wp_suplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Wp_suplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wp_suplier/update_action'),
		'id' => set_value('id', $row->id),
		'id_suplier' => set_value('id_suplier', $row->id_suplier),
		'nama_suplier' => set_value('nama_suplier', $row->nama_suplier),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->load->view('wp_suplier/wp_suplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_suplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_suplier' => $this->input->post('id_suplier',TRUE),
		'nama_suplier' => $this->input->post('nama_suplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->Wp_suplier_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wp_suplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wp_suplier_model->get_by_id($id);

        if ($row) {
            $this->Wp_suplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wp_suplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_suplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_suplier', 'id suplier', 'trim|required');
	$this->form_validation->set_rules('nama_suplier', 'nama suplier', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wp_suplier.xls";
        $judul = "wp_suplier";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Suplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Suplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

	foreach ($this->Wp_suplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_suplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_suplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=wp_suplier.doc");

        $data = array(
            'wp_suplier_data' => $this->Wp_suplier_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('wp_suplier/wp_suplier_doc',$data);
    }

}

/* End of file Wp_suplier.php */
/* Location: ./application/controllers/Wp_suplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-03 07:58:46 */
/* http://harviacode.com */