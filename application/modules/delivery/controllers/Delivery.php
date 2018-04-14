<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Aset_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $aset = $this->Aset_model->get_all();
        $data = array(
            'aset_data' => $aset,
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Delivery',
            'content'		=>'list',
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('delivery/create_action'),
      	    'id' => set_value('id'),
      	    'tanggal' => set_value('tanggal'),
      	    'jam' => set_value('jam'),
      	    'turun_krat' => set_value('turun_krat'),
      	    'turun_btl' => set_value('turun_btl'),
      	    'naik_krat' => set_value('naik_krat'),
      	    'naik_btl' => set_value('naik_btl'),
      	    'aset_krat' => set_value('aset_krat'),
      	    'aset_btl' => set_value('aset_btl'),
      	    'bayar' => set_value('bayar'),
      	    'keterangan' => set_value('keterangan'),
      	    'username' => set_value('username'),
      	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
            'aktif'			=>'aset',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Aset',
            'content'		=>'form',
            'pelanggan_list' => $this->Aset_model->get_pelanggan(),
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
          		'tanggal' => date('y-m-d'),
          		'jam' => date('h:i:s'),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'turun_btl' => $this->input->post('turun_btl',TRUE),
          		'naik_krat' => $this->input->post('naik_krat',TRUE),
          		'naik_btl' => $this->input->post('naik_btl',TRUE),
          		'aset_krat' => $this->input->post('aset_krat',TRUE),
          		'aset_btl' => $this->input->post('aset_btl',TRUE),
          		'bayar' => $this->input->post('bayar',TRUE),
          		'keterangan' => $this->input->post('keterangan',TRUE),
          		'username' => $this->session->identity,
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('delivery'));
        }
    }

    public function update($id)
    {
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('delivery/update_action'),
            		'id' => set_value('id', $row->id),
                'tanggal' => set_value('id', 'tanggal'),
            		'jam' => set_value('id', 'jam'),
            		'turun_krat' => set_value('turun_krat', $row->turun_krat),
            		'turun_btl' => set_value('turun_btl', $row->turun_btl),
            		'naik_krat' => set_value('naik_krat', $row->naik_krat),
            		'naik_btl' => set_value('naik_btl', $row->naik_btl),
            		'aset_krat' => set_value('aset_krat', $row->aset_krat),
            		'aset_btl' => set_value('aset_btl', $row->aset_btl),
            		'bayar' => set_value('bayar', $row->bayar),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'username' => set_value('username', $row->username),
            		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
                'aktif'			=>'aset',
                'title'			=>'Brajamarketindo',
                'judul'			=>'Dashboard',
                'sub_judul'	=>'Aset',
                'content'		=>'form',
                'pelanggan_list' => $this->Aset_model->get_pelanggan(),
        	    );
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
              'tanggal' => date('y-m-d'),
              'jam' => date('h:i:s'),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'turun_btl' => $this->input->post('turun_btl',TRUE),
          		'naik_krat' => $this->input->post('naik_krat',TRUE),
          		'naik_btl' => $this->input->post('naik_btl',TRUE),
          		'aset_krat' => $this->input->post('aset_krat',TRUE),
          		'aset_btl' => $this->input->post('aset_btl',TRUE),
          		'bayar' => $this->input->post('bayar',TRUE),
          		'keterangan' => $this->input->post('keterangan',TRUE),
          		'username' => $this->input->post('username',TRUE),
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('delivery'));
        }
    }

    public function delete($id)
    {
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $this->Aset_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('delivery'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('turun_krat', 'turun krat', 'trim|required');
    	$this->form_validation->set_rules('turun_btl', 'turun btl', 'trim|required');
    	$this->form_validation->set_rules('naik_krat', 'naik krat', 'trim|required');
    	$this->form_validation->set_rules('naik_btl', 'naik btl', 'trim|required');
    	$this->form_validation->set_rules('aset_krat', 'aset krat', 'trim|required');
    	$this->form_validation->set_rules('aset_btl', 'aset btl', 'trim|required');
    	$this->form_validation->set_rules('bayar', 'bayar', 'trim|required');
    	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wp_asis_debt.xls";
        $judul = "wp_asis_debt";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam");
	xlsWriteLabel($tablehead, $kolomhead++, "Turun Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Turun Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Naik Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Naik Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Aset Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Aset Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Pelanggan Id");

	foreach ($this->Aset_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turun_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turun_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->naik_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->naik_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->aset_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->aset_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_pelanggan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 04:37:16 */
/* http://harviacode.com */
