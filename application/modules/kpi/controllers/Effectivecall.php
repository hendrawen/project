<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Effectivecall extends CI_Controller {

    private $permit;
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Effective_model', 'call');
        
    }
    

    function index()
    {
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='KPIKEEP PERFORM INDICATOR EFFECTIFE CALL';
        $data['content']		='effective/main';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['barang']         = $this->call->get_barang();
        $data['count_barang']   = $this->call->count_barang();
        $data['month']          = $this->month;
        $this->load->view('panel/dashboard', $data);
    }

    function load_all()
    {
        $pesan = "";
        $total = 0;
        $barang = $this->call->get_barang();        
        $cek = get_list_day(date("n"), date("Y"));
        foreach ($cek as $key) {
            # code...
            $pesan .= '<tr>
            <td class="text-center"><b>'.tgl_indo($key).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Due Date', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Due Date', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Due Date', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Biru', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Biru', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Biru', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Kuning', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Kuning', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Kuning', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Orange', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Orange', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Orange', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Ijo', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Ijo', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Ijo', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Take Order', 'Pink', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Stock', 'Pink', $key, 'semua')).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count('Follow Up', 'Pink', $key, 'semua')).'</b></td>';
            foreach ($barang as $value) {
            $pesan .= '
                <td class="text-center"><b>'.$this->call->sum_barang($key, $value->nama_barang, 'semua').'</b></td>';
            }
            $pesan .= '
                <td class="text-center"><b>'.$this->call->sum_all_barang($key, 'semua').'</b></td>
            </tr>';
        } 
        echo $pesan;

    }

    function load_filter()
    {
        $bulan = $this->input->post('bulan');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $pesan = "";
        $total = 0;
        $barang = $this->call->get_barang(); 
        if ($bulan == 'semua') {
            # code...
            $cek = get_list_day(date("n"), date("Y"));
        } else {
            # code...
            $cek = get_list_day($bulan, date("Y"));
        }     
        foreach ($cek as $key) {
            # code...
            $pesan .= '<tr>
            <td class="text-center"><b>'.tgl_indo($key).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Due Date', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Due Date', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Due Date', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Biru', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Biru', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Biru', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Kuning', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Kuning', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Kuning', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Orange', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Orange', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Orange', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Ijo', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Ijo', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Ijo', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Take Order', 'Pink', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Stock', 'Pink', $key, $nama)).'</b></td>
            <td class="text-center"><b>'.angka($this->call->count_fiter('Follow Up', 'Pink', $key, $nama)).'</b></td>';
            foreach ($barang as $value) {
            $pesan .= '
                <td class="text-center"><b>'.$this->call->sum_barang($key, $value->nama_barang, $nama).'</b></td>';
            }
            $pesan .= '
                <td class="text-center"><b>'.$this->call->sum_all_barang($key, $nama).'</b></td>
            </tr>';
        } 
        echo $pesan;

    }

    function isi_karyawan($pilih)
    {
        $karyawan = $this->call->get_karyawan();
        $opt = "";
        if ($pilih == "karyawan") {
        foreach ($karyawan as $row) {
            $opt .= '
            <option value="'.$row->id_karyawan.'">'.$row->nama.'</option>
            ';
        }
        } else {
            $opt = '
            <option value="semua">Semua</option>
            ';
        }
        echo $opt;
    }

}

/* End of file Effectivecall.php */
