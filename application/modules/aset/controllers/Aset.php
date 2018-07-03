<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aset extends CI_Controller
{
    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Aset_model');
        $this->load->library('form_validation');
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        if (!$this->ion_auth->logged_in()) {//cek login ga?
                redirect('login','refresh');
        }
    }

    public function index()
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'aset/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'aset/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'aset/index.html';
            $config['first_url'] = base_url() . 'aset/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Aset_model->total_rows($q);
        $aset = $this->Aset_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'aset_data' => $aset,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'aktif'			=>'aset',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Aset',
            'content'		=>'list',
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    public function create()
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $data = array(
            'button' => 'Create',
            'action' => site_url('aset/create_action'),
              'id' => set_value('id'),
              'id_transaksi' => set_value('id_transaksi'),
      	    'tanggal' => set_value('tanggal'),
      	    'jam' => set_value('jam'),
      	    'turun_krat' => set_value('turun_krat'),
            'bayar_krat' => set_value('bayar_krat'),
            'bayar_uang' => set_value('bayar_uang'),
            'piutang' => set_value('piutang'),
            'wp_barang_id' => set_value('wp_barang_id'),
      	    'username' => set_value('username'),
      	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
            'aktif'			=>'aset',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Aset',
            'content'		=>'form',
            'pelanggan_list' => $this->Aset_model->get_pelanggan(),
            'barang_list' => $this->Aset_model->get_barang(),
          );
          $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
          		'tanggal' => date('y-m-d'),
                  'jam' => date('h:i:s'),
                  'id_transaksi' => $this->Aset_model->buat_kode(),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'bayar_krat' => $this->input->post('bayar_krat',TRUE),
          		'bayar_uang' => $this->input->post('bayar_uang',TRUE),
                 'piutang' => $this->input->post('piutang',TRUE),
                'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
          		'username' => $this->session->identity,
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('aset'));
        }
    }

    public function update($id)
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('aset/update_action'),
                'id' => set_value('id', $row->id),
                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'tanggal' => set_value('tanggal', 'tanggal'),
            		'jam' => set_value('jam', 'jam'),
            		'turun_krat' => set_value('turun_krat', $row->turun_krat),
            		'bayar_krat' => set_value('bayar_krat', $row->bayar_krat),
                    'bayar_uang' => set_value('bayar_uang', $row->bayar_uang),
                    'piutang' => set_value('piutang', $row->piutang),
                    'username' => set_value('username', $row->username),
                    'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
                    'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
                    'username' => $this->session->identity,
                'aktif' =>'aset',
                'title'	=>'Brajamarketindo',
                'judul'	=>'Dashboard',
                'sub_judul'	=>'Aset',
                'content'		=>'form',
                'pelanggan_list' => $this->Aset_model->get_pelanggan(),
                );
                $data['menu']			= $this->permit[0];
                $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('aset'));
        }
    }

    public function update_action()
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
              'tanggal' => date('y-m-d'),
              'jam' => date('h:i:s'),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'bayar_krat' => $this->input->post('bayar_krat',TRUE),
                  'bayar_uang' => $this->input->post('bayar_uang',TRUE),
                  'piutang' => $this->input->post('piutang',TRUE),
          		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
          		'username' => $this->input->post('username',TRUE),
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('aset'));
        }
    }

    public function delete($id)
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $this->Aset_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('aset'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('aset'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('turun_krat', 'turun krat', 'trim|required');
    	$this->form_validation->set_rules('bayar_krat', 'bayar krat', 'trim|required');
    	$this->form_validation->set_rules('bayar_uang', 'bayar uang', 'trim|required');
    	$this->form_validation->set_rules('piutang', 'piutang', 'trim|required');
    	$this->form_validation->set_rules('wp_barang_id', 'wp_barang_id', 'trim|required');
    	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
    	//$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $cek = get_permission('Aset', $this->permit[1]);
          if (!$cek) {//cek admin ga?
              redirect('panel','refresh');
        }
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
        xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam");
	xlsWriteLabel($tablehead, $kolomhead++, "Turun Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Bayar Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Bayar Uang");
	xlsWriteLabel($tablehead, $kolomhead++, "Piutang");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "Id Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Username");

	foreach ($this->Aset_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turun_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bayar_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bayar_uang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->piutang);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
        xlsWriteNumber($tablebody, $kolombody++, $data->nama_barang);
        xlsWriteNumber($tablebody, $kolombody++, $data->id_pelanggan);
        xlsWriteNumber($tablebody, $kolombody++, $data->nama_pelanggan);
        xlsWriteLabel($tablebody, $kolombody++, $data->username);

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
