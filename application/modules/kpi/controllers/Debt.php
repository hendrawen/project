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
        $this->load->model('karyawan/karyawan_model','mkar');
        
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'KPI Debt & Delivery',
            'content'		=>'debt/main',
            'list_bulan'    => $this->model->get_month(),
            'list_karyawan' => $this->mkar->get_all(),
            'menu'			=> $this->permit[0],
            'submenu'		=> $this->permit[1],
        );
        $this->load->view('panel/dashboard', $data);
    }

    function list()
    {
        $bulan = $this->input->post('month');
        $tahun = $this->input->post('year');
        $id_karyawan = $this->input->post('id_karyawan');

        $days = get_list_day($bulan, $tahun);
        $result = '';
        $target = $this->model->get_target();
        for ($i=0; $i < sizeof($days); $i++) { 
            $cust_jadwal = $this->model->get_customer_jadwal($days[$i], $id_karyawan);
            $cust_actual = $this->model->get_customer_actual($days[$i], $id_karyawan);
            $barang = $this->model->get_barang($days[$i], $id_karyawan);

            $qty = $this->model->get_qty($days[$i], $id_karyawan);
            $penarikan = $this->model->get_penarikan($days[$i], $id_karyawan);
            // $cust_persen = 0;
            $result .= 
            "<tr>
                <td>".tgl_indo($days[$i])."</td>
                <td>".angka($cust_jadwal)."</td>
                <td>".angka($cust_actual)."</td>
                <td>".$this->persentase($cust_actual, $cust_jadwal)."</td>

                <td>".angka($barang['muat'])."</td>
                <td>".angka($barang['terkirim'])."</td>
                <td>".angka($barang['kembali'])."</td>
                <td>".angka($barang['return'])."</td>
                <td>".angka($barang['rusak'])."</td>

                <td>".angka($target)."</td>
                <td>".angka($qty)."</td>
                <td>".$this->persentase($qty, $target)."</td>

                <td>".angka($penarikan['krat'])."</td>
                <td>".angka($penarikan['botol'])."</td>
                <td>".angka($penarikan['value'])."</td>
            </tr>";
        }
        /*
        

        */
        echo $result;
    }

    private function persentase($a, $b)
    {
        if ($a <= 0 || $b <= 0){
            return angka(0);
        } else {
            $c = $a / $b;
            return persen($c);
        }
    }

    function tes()
    {
        $barang = $this->model->get_barang('2018-04-12','semua');
        
        echo "<pre>";
        print_r ($barang);
        echo "</pre>";
        echo date('N');
    }
}

/* End of file Debt.php */
