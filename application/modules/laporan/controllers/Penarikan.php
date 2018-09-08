<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    private $permit;
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        //Do your magic here
        $this->load->model('Penarikan_model', 'penarikan');
        
        $this->load->library('table');
    }

    function index()
    {
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan/laporan',
            'month'         => $this->month,
        );
        $this->load->view('panel/dashboard', $data);
    }

    function ajax_list()
    {

        $list = $this->penarikan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lap) {
            $no++;
            $row = array();
            $row[] = $lap->id_transaksi;
            $row[] = tgl_indo($lap->tgl_transaksi);
            $row[] = tgl_indo($lap->jatuh_tempo);
            $row[] = $lap->id_pelanggan;
            $row[] = $lap->nama_pelanggan;
            $row[] = $lap->nama_barang;
            $row[] = $lap->qty;
            $row[] = $lap->satuan;
            $row[] = $lap->kota;
            $row[] = $lap->kecamatan;
            $row[] = $lap->kelurahan;
            $row[] = $lap->no_telp;
            $row[] = $lap->nama;
            $row[] = $lap->nama_debt;
            $row[] = $lap->total;
            $row[] = (($lap->bayar_krat > 0 )? tgl_indo($lap->tgl_penarikan):'');
            $row[] = $lap->bayar_krat;
            $row[] = (($lap->bayar_uang > 0 )? tgl_indo($lap->tgl_penarikan):'');
            $row[] = $lap->bayar_uang;
            $row[] = $lap->jumlah;
            $row[] = $lap->sisa;
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->penarikan->count_all(),
                        "recordsFiltered" => $this->penarikan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file Penarikan.php */
