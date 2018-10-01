<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Debt extends CI_Controller {
    private $permit;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Debt_model','model');
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

    function list_debt()
    {
        $bulan = $this->input->post('month');
        $tahun = $this->input->post('year');
        $id_karyawan = $this->input->post('id_karyawan');

        $days = get_list_day($bulan, $tahun);
        $result = '';
        $target = $this->model->get_target();
        $count['jadwal'] = 0; $count['actual'] = 0;
        $count['muat'] = 0; $count['terkirim'] = 0; $count['kembali'] = 0; $count['return'] = 0; $count['rusak'] = 0;
        $count['target'] = 0; $count['qty'] = 0;
        $count['krat'] = 0; $count['botol'] = 0;$count['value'] = 0;
        $count['debet'] = 0; $count['kredit'] = 0;
        for ($i=0; $i < sizeof($days); $i++) { 
            $cust_jadwal = $this->model->get_customer_jadwal($days[$i], $id_karyawan);
            $cust_actual = $this->model->get_customer_actual($days[$i], $id_karyawan);
            $barang = $this->model->get_barang($days[$i], $id_karyawan);

            $qty = $this->model->get_qty($days[$i], $id_karyawan);
            $penarikan = $this->model->get_penarikan($days[$i], $id_karyawan);

            $kas = $this->model->get_value($days[$i], $id_karyawan);
            
            $count['jadwal'] += $cust_jadwal; $count['actual'] += $cust_actual;
            
            $count['muat'] += $barang['muat']; $count['terkirim'] += $barang['terkirim'];
            $count['kembali'] += $barang['kembali']; 
            $count['return'] += $barang['return']; 
            $count['rusak'] += $barang['rusak'];

            $count['target'] += $target; $count['qty'] += $qty;
            $count['krat'] += $penarikan['krat']; 
            $count['botol'] += $penarikan['botol'];
            $count['value'] += $penarikan['value'];
            $count['debet'] += $kas['debet'];
            $count['kredit'] += $kas['kredit'];
            

            $barang_muat = $this->model->get_muat($days[$i],$id_karyawan);
            $barang_terkirim = $this->model->get_terkirim($days[$i],$id_karyawan);
            $barang_kembali = $this->model->get_kembali($days[$i],$id_karyawan);
            $barang_return = $this->model->get_return($days[$i],$id_karyawan);
            $barang_rusak = $this->model->get_rusak($days[$i],$id_karyawan);

            $total_muat = $this->model->get_total_muat($tahun, $bulan, $id_karyawan);
            $total_terkirim = $this->model->get_total_terkirim($tahun, $bulan, $id_karyawan);
            $total_kembali = $this->model->get_total_kembali($tahun, $bulan, $id_karyawan);
            $total_return = $this->model->get_total_return($tahun, $bulan, $id_karyawan);
            $total_rusak = $this->model->get_total_rusak($tahun, $bulan, $id_karyawan);
            $result .= 
            "<tr>
                <td>".tgl_indo($days[$i])."</td>
                <td>".angka($cust_jadwal)."</td>
                <td>".angka($cust_actual)."</td>
                <td>".$this->persentase($cust_actual, $cust_jadwal)."</td>

                <td>".$barang_muat."</td>
                <td>".$barang_terkirim."</td>
                <td>".$barang_kembali."</td>
                <td>".$barang_return."</td>
                <td>".$barang_rusak."</td>

                <td>".angka($target)."</td>
                <td>".angka($qty)."</td>
                <td>".$this->persentase($qty, $target)."</td>

                <td>".angka($penarikan['krat'])."</td>
                <td>".angka($penarikan['botol'])."</td>
                <td>".angka($penarikan['value'])."</td>

                <td>".angka($kas['debet'])."</td>
                <td>".angka($kas['kredit'])."</td>
                <td>".$barang['keterangan']."</td>
            </tr>
            ";
        }
        $result .= "
            <tr>
                <th>JUMLAH</th>
                <th>".angka($count['jadwal'])."</th>
                <th>".angka($count['actual'])."</th>
                <th>".$this->persentase($count['actual'], $count['jadwal'])."</th>
                <th>".$total_muat."</th>
                <th>".$total_terkirim."</th>
                <th>".$total_kembali."</th>
                <th>".$total_return."</th>
                <th>".$total_rusak."</th>

                <th>".angka($count['target'])."</th>
                <th>".angka($count['qty'])."</th>
                <th>".$this->persentase($count['qty'], $count['target'])."</th>
                <th>".angka($count['krat'])."</th>
                <th>".angka($count['botol'])."</th>
                <th>".angka($count['value'])."</th>
                <th>".angka($count['debet'])."</th>
                <th>".angka($count['kredit'])."</th>
            </tr>
        ";
        /*

        */
        echo $result;
    }

    private function persentase($a, $b)
    {
        if ($a <= 0 || $b <= 0){
            return angka(0);
        } else {
            $c = ($a / $b) * 100;
            return persen($c);
        }
    }

    function tes()
    {
        $total_muat = $this->model->get_total_muat('2018','08','semua');
        
        echo $total_muat;
        
    }
}

/* End of file Debt.php */
