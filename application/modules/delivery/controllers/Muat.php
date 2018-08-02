<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Muat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Muat_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    }

    public function index()
    {
        $data = array(
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Muat',
            'content'		=>'muat/wp_debt_muat_list',
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
            $row[] = $lists->nama_gudang;
            $row[] = $lists->nama_debt;
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
      	    'satuan' => set_value('satuan'),
      	    'satuan_kirim' => set_value('satuan_terkirim'),
      	    'satuan_kembali' => set_value('satuan_kembali'),
      	    'satuan_return' => set_value('satuan_return'),
      	    'satuan_rusak' => set_value('satuan_rusak'),
            'username' => set_value('username'),
            'tanggal'    => set_value('tanggal'),
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
        		'satuan' => $this->input->post('satuan',TRUE),
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
                    'tanggal' => set_value('tanggal', $row->tanggal),
            		'muat' => set_value('muat', $row->muat),
            		'terkirim' => set_value('muat_dust', $row->terkirim),
            		'kembali' => set_value('kembali', $row->kembali),
            		'return' => set_value('return', $row->return),
            		'satuan_kirim' => set_value('satuan_kirim', $row->satuan_terkirim),
            		'satuan' => set_value('satuan', $row->satuan),
            		'satuan_kembali' => set_value('satuan_kembali', $row->satuan_kembali),
            		'satuan_return' => set_value('satuan_return', $row->satuan_return),
            		'rusak' => set_value('rusak', $row->rusak),
            		'satuan_rusak' => set_value('satuan_rusak', $row->satuan_rusak),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'aset_krat' => set_value('aset_krat', $row->aset_krat),
            		'aset_botol' => set_value('aset_botol', $row->aset_btl),
                    'wp_gudang_id' => set_value('gudang', $row->wp_gudang_id),
                    'wp_barang_id' => set_value('barang', $row->wp_barang_id),
                    'id_karyawan' => set_value('debt', $row->id_karyawan),
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
        		'tanggal' => $this->input->post('tanggal'),
        		'muat' => $this->input->post('muat',TRUE),
        		'satuan' => $this->input->post('satuan',TRUE),
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

            $this->Muat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('delivery/muat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Muat_model->delete($id);
        echo json_encode(array("status" => TRUE));
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

}

/* End of file Muat.php */
/* Location: ./application/controllers/Muat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 08:06:03 */
/* http://harviacode.com */
