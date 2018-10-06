<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_marketing extends CI_Controller {
    private $permit;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kpimarketing_model', 'model');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Kepala Cabang')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        
    }
    
    public function index()
    {
        $this->load->model('karyawan/karyawan_model','mkar');
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'KPI Marketing',
            'content'		=>'marketing.1/main',
            'list_bulan'    => get_list_month(),
            'list_karyawan' => $this->mkar->get_all(),
            'menu'			=> $this->permit[0],
            'submenu'		=> $this->permit[1],
        );
        $this->load->view('dashboard', $data);
    }

    function list_marketing()
    {
        $bulan = $this->input->post('month');
        $tahun = $this->input->post('year');
        $id_karyawan = $this->input->post('id_karyawan');
        
        $data = array(
            'days' => get_list_day($bulan, $tahun),
            'id_karyawan' => $this->input->post('id_karyawan'),
        );
        $this->load->view('marketing.1/view', $data);
    }

   
}

/* End of file Debt.php */
