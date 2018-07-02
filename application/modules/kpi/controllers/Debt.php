<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Debt extends CI_Controller {
    private $permit;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('Debt_model','model');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
		}
        
    }
    
    public function index()
    {
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'KPI Debt & Delivery',
            'content'		=>'debt/main',
            'list_bulan'    => $this->model->get_month(),
            'menu'			=> $this->permit[0],
            'submenu'		=> $this->permit[1],
        );
        // print_r($data['bulan']);
        // exit();
        $this->load->view('panel/dashboard', $data);
    }

    function list()
    {
        $bulan = $this->input->post('month');
        $tahun = $this->input->post('year');
        $days = get_list_day($bulan, $tahun);
        $result = '';
        for ($i=0; $i < sizeof($days); $i++) { 
            $cust_jadwal = $this->model->get_customer_jadwal($days[$i]);
            $cust_actual = $this->model->get_customer_actual($days[$i]);
            $cust_persen = 0;
            if ($cust_jadwal > 0) {
                $cust_persen = ($cust_actual / $cust_jadwal)*100;
            }
            // $cust_persen = 0;
            $result .= 
            "<tr>
                <td>".tgl_indo($days[$i])."</td>
                <td>".angka($cust_jadwal)."</td>
                <td>".angka($cust_actual)."</td>
                <td>".persen($cust_persen)."</td>
            </tr>";
        }
        echo $result;
    }


}

/* End of file Debt.php */
