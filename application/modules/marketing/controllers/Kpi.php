<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('Marketing')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Kpi_model','kpi');
    }
    
    public function index()
    {
        $this->load->model('karyawan/karyawan_model','mkar');
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'KPI Marketing',
            'content'		=>'kpi/main',
            'list_bulan'    => get_list_month(),
            'list_karyawan' => $this->mkar->get_all(),
        );
        $this->load->view('panel/dashboard', $data);
    }

    function list()
    {
        $bulan = $this->input->post('month');
        $tahun = $this->input->post('year');
        $id_karyawan = $this->input->post('id_karyawan');
        
        $data = array(
            'days' => get_list_day($bulan, $tahun),
        );
        $this->load->view('kpi/view', $data);
    }

}

/* End of file Kpi.php */
