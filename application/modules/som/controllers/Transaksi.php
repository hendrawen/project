<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{   
    private $permit;
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('SOM')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Transaksi_model');
        $this->load->library('form_validation');
    }

    // function tes()
    // {
    //   print_r($this->Transaksi_model->get_all());

    // }
    public function index()
    {   
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Transaksi';
        $data['content']		='transaksi/transaksi_list';
        $data['list_status'] =$this->Transaksi_model->get_status();
        $this->load->view('dashboard', $data);

    }

    public function ajax_list()
    {
        $list = $this->Transaksi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lists) {
            $row = array();
            $row[] = $lists->id_transaksi;
            $row[] = tgl_indo($lists->tgl_transaksi);
            $row[] = $lists->jatuh_tempo;
            $row[] = $lists->id_pelanggan;
            $row[] = $lists->nama_pelanggan;
            $row[] = $lists->nama_barang;
            $row[] = $lists->qty;
            $row[] = $lists->satuan;
            $row[] = $lists->kota;
            $row[] = $lists->kecamatan;
            $row[] = $lists->kelurahan;
            $row[] = $lists->no_telp;
            $row[] = $lists->nama_karyawan;
            $row[] = $lists->nama_debt;
            $row[] = $lists->nama_status;
            $row[] = $lists->subtotal;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Transaksi_model->count_all(),
                        "recordsFiltered" => $this->Transaksi_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    
    function excel($dari, $ke, $status)
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_pelanggan.xls";
        $judul = "Transaksi";
        $tablehead = 5;
        $tablebody = 6;
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
        xlsWriteLabel(0, 0, "Laporan");
        xlsWriteLabel(0, 1, "Transaksi Pelanggan");
        xlsWriteLabel(1, 0, "Dari Tanggal");
        xlsWriteLabel(1, 1, tgl_indo($dari));
        xlsWriteLabel(2, 0, "Ke Tanggal");
        xlsWriteLabel(2, 1, tgl_indo($ke));
        xlsWriteLabel(3, 0, "Status");
        xlsWriteLabel(3, 1, $this->Transaksi_model->get_status_id($status));
        $kolomhead = 0;

        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
        xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
        xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "QTY");
        xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kota");
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
        xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
        xlsWriteLabel($tablehead, $kolomhead++, "Debt");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

        $record = $this->Transaksi_model->get_data($dari, $ke, $status);
        $total = 0;
        if ($record){
            foreach ($record as $data) {
                $kolombody = 0;
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
                xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
                xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
                xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
                xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
                xlsWriteNumber($tablebody, $kolombody++, $data->qty);
                xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
                xlsWriteLabel($tablebody, $kolombody++, $data->kota);
                xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
                xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
                xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
                xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
                $tablebody++;
                $nourut++;
                $total += $data->subtotal;
            }
        }
        xlsWriteLabel($tablebody, 14, 'Total');
        xlsWriteNumber($tablebody, 15, $total);
        xlsEOF();
        exit();
    }

    public function word()
    {   
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=transaksi.doc");

        $data = array(
            'transaksi_data' => $this->Transaksi_model->get_all(),
            'start' => 0
        );

        $this->load->view('transaksi/transaksi_doc',$data);
    }

}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-12 05:09:32 */
/* http://harviacode.com */
