<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wp_karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wp_karyawan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'wp_karyawan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'wp_karyawan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'wp_karyawan/index.html';
            $config['first_url'] = base_url() . 'wp_karyawan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Wp_karyawan_model->total_rows($q);
        $wp_karyawan = $this->Wp_karyawan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'wp_karyawan_data' => $wp_karyawan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('wp_karyawan/wp_karyawan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Wp_karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_karyawan' => $row->id_karyawan,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'photo' => $row->photo,
		'status' => $row->status,
		'wp_jabatan_id' => $row->wp_jabatan_id,
	    );
            $this->load->view('wp_karyawan/wp_karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_karyawan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('wp_karyawan/create_action'),
	    'id_karyawan' => set_value('id_karyawan'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'photo' => set_value('photo'),
	    'status' => set_value('status'),
	    'wp_jabatan_id' => set_value('wp_jabatan_id'),
	);
        $this->load->view('wp_karyawan/wp_karyawan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'photo' => $this->input->post('photo',TRUE),
		'status' => $this->input->post('status',TRUE),
		'wp_jabatan_id' => $this->input->post('wp_jabatan_id',TRUE),
	    );

            $this->Wp_karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('wp_karyawan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Wp_karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('wp_karyawan/update_action'),
		'id_karyawan' => set_value('id_karyawan', $row->id_karyawan),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'photo' => set_value('photo', $row->photo),
		'status' => set_value('status', $row->status),
		'wp_jabatan_id' => set_value('wp_jabatan_id', $row->wp_jabatan_id),
	    );
            $this->load->view('wp_karyawan/wp_karyawan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_karyawan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_karyawan', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'photo' => $this->input->post('photo',TRUE),
		'status' => $this->input->post('status',TRUE),
		'wp_jabatan_id' => $this->input->post('wp_jabatan_id',TRUE),
	    );

            $this->Wp_karyawan_model->update($this->input->post('id_karyawan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('wp_karyawan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Wp_karyawan_model->get_by_id($id);

        if ($row) {
            $this->Wp_karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wp_karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wp_karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('photo', 'photo', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('wp_jabatan_id', 'wp jabatan id', 'trim|required');

	$this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wp_karyawan.xls";
        $judul = "wp_karyawan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Jabatan Id");

	foreach ($this->Wp_karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_jabatan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=wp_karyawan.doc");

        $data = array(
            'wp_karyawan_data' => $this->Wp_karyawan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('wp_karyawan/wp_karyawan_doc',$data);
    }

}

/* End of file Wp_karyawan.php */
/* Location: ./application/controllers/Wp_karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-09 07:12:23 */
/* http://harviacode.com */