<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stockofname extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Muat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Muat',
            'barang'   => $this->Muat_model->get_barang(),
            'satuan'   => $this->Muat_model->get_satuanbarang(),
            'content'		=>'muat/wp_debt_stock',
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function ajax_list()
    {
        $list = $this->Muat_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lists) {
            $row = array();
            $row[] = tgl_indo($lists->tanggal);
            // $row[] = $lists->nama_gudang;
            // $row[] = $lists->nama_debt;
            $row[] = $lists->nama_barang;
            $row[] = $lists->muat;
            $row[] = $lists->satuan;
            $row[] = $lists->terkirim;
            $row[] = $lists->satuan_terkirim;
            $row[] = $lists->kembali;
            $row[] = $lists->satuan_kembali;
            $row[] = $lists->return;
            $row[] = $lists->satuan_return;
            $row[] = $lists->rusak;
            $row[] = $lists->satuan_rusak;
            $row[] = $lists->aset_krat;
            $row[] = $lists->aset_btl;
            $row[] = $lists->keterangan;
            $row[] = $lists->nama;
            $row[] = '
            <a href="'.base_url('delivery/muat/update/'.$lists->id).'" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <a type="button" href="javascript:void(0)" title="Hapus" onclick="delete_call('."'".$lists->id."'".')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                     ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Muat_model->count_all(),
                        "recordsFiltered" => $this->Muat_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('delivery/muat/create_action'),
      	    'id' => set_value('id'),
      	    'muat' => set_value('muat',0),
      	    'terkirim' => set_value('terkirim',0),
      	    'return' => set_value('return',0),
      	    'rusak' => set_value('rusak',0),
      	    'aset_krat' => set_value('aset_krat',0),
      	    'aset_botol' => set_value('aset_botol',0),
      	    'keterangan' => set_value('keterangan'),
      	    'created_at' => set_value('created_at'),
      	    'username' => set_value('username'),
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Muat',
            'content'		=>'muat/wp_debt_muat_form',
            'barang_list' => $this->Muat_model->get_barang(),
            'gudang_list' => $this->Muat_model->get_gudang(),
            'karyawan'    => $this->Muat_model->get_karyawan(),
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
                'tanggal' => $this->input->post('tanggal'),
        		'muat' => $this->input->post('muat',TRUE),
        		'terkirim' => $this->input->post('terkirim',TRUE),
        		'satuan_terkirim' => $this->input->post('satuan_kirim',TRUE),
        		'kembali' => $this->input->post('kembali',TRUE),
        		'satuan_kembali' => $this->input->post('satuan_kembali',TRUE),
        		'return' => $this->input->post('return',TRUE),
        		'satuan_return' => $this->input->post('satuan_return',TRUE),
        		'rusak' => $this->input->post('rusak',TRUE),
        		'satuan_rusak' => $this->input->post('satuan_rusak',TRUE),
        		'aset_krat' => $this->input->post('aset_krat',TRUE),
        		'aset_btl' => $this->input->post('aset_botol',TRUE),
        		'keterangan' => $this->input->post('keterangan',TRUE),
        		'username' => $this->session->identity,
        		'wp_barang_id' => $this->input->post('barang',TRUE),
                'wp_gudang_id' => $this->input->post('gudang',TRUE),
                'id_karyawan' => $this->input->post('debt',TRUE),
                'username' => $this->session->identity,
    	    );
            $this->Muat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('delivery/muat'));
        }
    }

    public function update($id)
    {
        $row = $this->Muat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('delivery/muat/update_action'),
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
                'aktif'			=>'delivery',
                'title'			=>'Brajamarketindo',
                'judul'			=>'Dashboard',
                'sub_judul'	=>'Muat',
                'content'		=>'muat/wp_debt_muat_form',
                'barang_list' => $this->Muat_model->get_barang(),
                'gudang_list' => $this->Muat_model->get_gudang(),
        	    );
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery/muat'));
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

            $this->Muat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('delivery/muat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Muat_model->get_by_id($id);

        if ($row) {
            $this->Muat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('delivery/muat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery/muat'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
    	$this->form_validation->set_rules('muat', 'muat dust', 'trim|required');
    	$this->form_validation->set_rules('barang', 'wp barang id', 'trim|required');
    	$this->form_validation->set_rules('gudang', 'wp gudang id', 'trim|required');

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

	foreach ($this->Muat_model->get_all() as $data) {
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

    function cek()
    {      
      $barang = $this->Muat_model->get_namabarang();
      
      $temp = array();
      $j = 0;
      for ($i=0; $i < sizeof($barang); $i++) { 
        if ($i == 0) {
          $temp[$j]['nama_barang'] = $barang[$i]->nama_barang;
          $temp[$j][$barang[$i]->satuan] = $barang[$i]->satuan;
        } else if ($i > 0){
          if ($temp[$j]['nama_barang'] == $barang[$i]->nama_barang){
            $temp[$j][$barang[$i]->satuan] = $barang[$i]->satuan;
          } else {
            $temp[$j]['nama_barang'] = $barang[$i]->nama_barang;
            $temp[$j][$barang[$i]->satuan] = $barang[$i]->satuan;
          }
        }
        $j++;
      }
      
      echo "<pre>";
      print_r ($temp);
      echo "</pre>";
    }

}

/* End of file Muat.php */
/* Location: ./application/controllers/Muat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 08:06:03 */
/* http://harviacode.com */
