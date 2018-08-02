<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stockofname extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stockofname_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $barang = $this->get_barang();
        
        $temp = array();
        $index = 0;
        foreach ($barang as $row) {
            $temp[$index]['nama_barang'] = $row->nama_barang;
            $list_satuan = $this->num_rows($row->nama_barang);
            foreach ($list_satuan as $st) {
                $temp[$index]['satuan'][] = $st->satuan;
            }
            $index++;
        }

        $data = array(
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Muat',
            'content'		=>'muat/wp_debt_stock',
        );
        $data['barang'] = $temp;
        $data['barangall'] = $this->get_barang_all();
        $this->load->view('panel/dashboard', $data);
    }

    function get_barang()
    {
        $this->db->select('distinct(id),nama_barang, satuan');
        $this->db->group_by('nama_barang');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result();   
    }

    function get_barang_all()
    {
        $this->db->select('id,nama_barang, satuan');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result();   
    }

    function tes2()
    {
        $this->db->select('distinct(id),nama_barang, satuan');
        $this->db->group_by('nama_barang');
        $this->db->order_by('nama_barang', 'asc');
        $hasil = $this->db->get('wp_barang')->result();   
        
        echo "<pre>";
        print_r ($hasil);
        echo "</pre>";
        
    }

    function tes()
    {
        $this->db->select('wp_barang.id,nama_barang, satuan');
        $this->db->join('wp_stok', 'wp_stok.wp_barang_id = wp_barang.id', 'left');
        $this->db->join('wp_gudang', 'wp_gudang.id = wp_stok.wp_gudang_id', 'inner');
        $this->db->order_by('nama_barang', 'asc');
        $hasil = $this->db->get('wp_barang')->result();   
        
        echo "<pre>";
        print_r ($hasil);
        echo "</pre>";
        

    }

    function num_rows($value)
    {
        $this->db->select('satuan');
        $this->db->where('nama_barang', $value);
        return $this->db->get('wp_barang')->result();
    }

    function get_jumlah_stok($id_barang, $id_gudang =null)
    {
        $this->db->select('sum(stok) as jumlah');
        
        $this->db->where('wp_barang_id', $id_barang);
        // $this->db->where('wp_gudang_id', $id_gudang);
        $hasil = $this->db->get('wp_stok')->row();
        if ($hasil) {
            return $hasil->jumlah;
        } else {
            return 0;
        }

        
        
    }

    public function ajax_list()
    {
        $list = $this->Stockofname_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lists) {
            $row = array();
            $row[] = tgl_indo($lists->tanggal);
            $row[] = $lists->nama_gudang;
            $barang = $this->get_barang();
        
            foreach ($barang as $obj) {
                $list_satuan = $this->num_rows($obj->nama_barang);
                foreach ($list_satuan as $st) {

                    $row[] = $this->get_jumlah_stok($obj->id);
                }
            }
            
            $row[] = "";
            $row[] = "";
            $row[] = "";
            $row[] = "";
            // $row[] = "";
            // $row[] = "";
            // $row[] = "";
            // $row[] = "";
            // $row[] = $lists->stok;
            // $row[] = $lists->rusak;
            // $row[] = $lists->satuan_rusak;
            $row[] = $lists->aset_krat;
            $row[] = $lists->aset_btl;

            $data[] = $row;
        }
        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Stockofname_model->count_all(),
                "recordsFiltered" => $this->Stockofname_model->count_filtered(),
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
            'barang_list' => $this->Stockofname_model->get_barang(),
            'gudang_list' => $this->Stockofname_model->get_gudang(),
            'karyawan'    => $this->Stockofname_model->get_karyawan(),
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
            $this->Stockofname_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('delivery/muat'));
        }
    }

    public function update($id)
    {
        $row = $this->Stockofname_model->get_by_id($id);

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
                'barang_list' => $this->Stockofname_model->get_barang(),
                'gudang_list' => $this->Stockofname_model->get_gudang(),
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

            $this->Stockofname_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('delivery/muat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Stockofname_model->get_by_id($id);

        if ($row) {
            $this->Stockofname_model->delete($id);
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

	foreach ($this->Stockofname_model->get_all() as $data) {
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
