<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Muat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
                if (!$this->ion_auth->in_group('Admin Gudang')) {//cek admin ga?
                        redirect('login','refresh');
                }
		}
        $this->load->model('Muat_model','model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $muat = $this->model->get_all();

        $data = array(
            'muat_data' => $muat,
            'aktif' => 'muat',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Muat',
            'content'		=>'muat/wp_debt_muat_list',
        );
        $this->load->view('dashboard', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin_gudang/muat/create_action'),
      	    'id' => set_value('id'),
      	    'muat_krat' => set_value('muat_krat',0),
      	    'muat_dust' => set_value('muat_dust',0),
      	    'terkirim_krat' => set_value('terkirim_krat',0),
      	    'terkirim_btl' => set_value('terkirim_btl',0),
      	    'kembali_krat' => set_value('kembali_krat',0),
      	    'kembali_btl' => set_value('kembali_btl',0),
      	    'retur_krat' => set_value('retur_krat',0),
      	    'keterangan' => set_value('keterangan'),
      	    'created_at' => set_value('created_at'),
      	    'username' => set_value('username'),
      	    'wp_barang_id' => set_value('wp_barang_id'),
      	    'wp_gudang_id' => set_value('wp_gudang_id'),
            'aktif' => 'muat',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Muat',
            'content'		=>'muat/wp_debt_muat_form',
            'barang_list' => $this->model->get_barang(),
            'gudang_list' => $this->model->get_gudang(),
      	);
        $this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'muat_krat' => $this->input->post('muat_krat',TRUE),
        		'muat_dust' => $this->input->post('muat_dust',TRUE),
        		'terkirim_krat' => $this->input->post('terkirim_krat',TRUE),
        		'terkirim_btl' => $this->input->post('terkirim_btl',TRUE),
        		'kembali_krat' => $this->input->post('kembali_krat',TRUE),
        		'kembali_btl' => $this->input->post('kembali_btl',TRUE),
        		'retur_krat' => $this->input->post('retur_krat',TRUE),
        		'keterangan' => $this->input->post('keterangan',TRUE),
        		'username' => $this->session->identity,
        		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
            'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
    	    );

            $this->model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin_gudang/muat'));
        }
    }

    public function update($id)
    {
        $row = $this->model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin_gudang/muat/update_action'),
            		'id' => set_value('id', $row->id),
            		'muat_krat' => set_value('muat_krat', $row->muat_krat),
            		'muat_dust' => set_value('muat_dust', $row->muat_dust),
            		'terkirim_krat' => set_value('terkirim_krat', $row->terkirim_krat),
            		'terkirim_btl' => set_value('terkirim_btl', $row->terkirim_btl),
            		'kembali_krat' => set_value('kembali_krat', $row->kembali_krat),
            		'kembali_btl' => set_value('kembali_btl', $row->kembali_btl),
            		'retur_krat' => set_value('retur_krat', $row->retur_krat),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'created_at' => set_value('created_at', $row->created_at),
            		'username' => set_value('username', $row->username),
            		'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
                'wp_gudang_id' => set_value('wp_gudang_id', $row->wp_gudang_id),
                'aktif' => 'muat',
                'title'			=>'Brajamarketindo',
                'judul'			=>'Dashboard',
                'sub_judul'	=>'Muat',
                'content'		=>'muat/wp_debt_muat_form',
                'barang_list' => $this->model->get_barang(),
                'gudang_list' => $this->model->get_gudang(),
        	    );
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_gudang/muat'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        		'muat_krat' => $this->input->post('muat_krat',TRUE),
        		'muat_dust' => $this->input->post('muat_dust',TRUE),
        		'terkirim_krat' => $this->input->post('terkirim_krat',TRUE),
        		'terkirim_btl' => $this->input->post('terkirim_btl',TRUE),
        		'kembali_krat' => $this->input->post('kembali_krat',TRUE),
        		'kembali_btl' => $this->input->post('kembali_btl',TRUE),
        		'retur_krat' => $this->input->post('retur_krat',TRUE),
        		'keterangan' => $this->input->post('keterangan',TRUE),
        		'username' => $this->session->identity,
        		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
        		'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
	         );

            $this->model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin_gudang/muat'));
        }
    }

    public function delete($id)
    {
        $row = $this->model->get_by_id($id);

        if ($row) {
            $this->model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin_gudang/muat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin_gudang/muat'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('muat_krat', 'muat krat', 'trim|required');
    	$this->form_validation->set_rules('muat_dust', 'muat dust', 'trim|required');
    	$this->form_validation->set_rules('terkirim_krat', 'terkirim krat', 'trim|required');
    	$this->form_validation->set_rules('terkirim_btl', 'terkirim btl', 'trim|required');
    	$this->form_validation->set_rules('kembali_krat', 'kembali krat', 'trim|required');
    	$this->form_validation->set_rules('kembali_btl', 'kembali btl', 'trim|required');
    	$this->form_validation->set_rules('retur_krat', 'retur krat', 'trim|required');
    	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    	$this->form_validation->set_rules('wp_barang_id', 'wp barang id', 'trim|required');
    	$this->form_validation->set_rules('wp_gudang_id', 'wp gudang id', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wp_debt_muat.xls";
        $judul = "wp_debt_muat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Muat Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Muat Dust");
	xlsWriteLabel($tablehead, $kolomhead++, "Terkirim Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Terkirim Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Kembali Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Kembali Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Retur Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Barang Id");

	foreach ($this->model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->muat_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->muat_dust);
	    xlsWriteNumber($tablebody, $kolombody++, $data->terkirim_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->terkirim_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kembali_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kembali_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->retur_krat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_barang_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Muat.php */
/* Location: ./application/controllers/Muat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 08:06:03 */
/* http://harviacode.com */
