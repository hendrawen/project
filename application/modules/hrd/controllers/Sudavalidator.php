<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sudavalidator extends CI_Controller {
    private $permit;
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('HRD')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        //Do your magic here
        $this->load->model('Validator_model', 'call');

    }

    function index()
    {
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='KPI KEEP PERFORM INDICATOR VALIDATOR';
        $data['content']		='validator/sumber';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['barang']         = $this->call->get_barang();
        $data['count_barang']   = $this->call->count_barang();
        $data['month']          = $this->month;
        $this->load->view('dashboard', $data);
    }

    function load_all()
    {
        $pesan = "";
        $total_act_kunjungan = 0;
        $total_prc_kunjungan = 0;
        $total_act_quantity = 0;
        $total_prc_quantity = 0;
        $total_act_jml = 0;
        $total_prc_jml = 0;
        $bulan = $this->input->post('bulan');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $cek = get_list_day(date("n"), date("Y"));
        foreach ($cek as $key) {
            # code...
            $pesan .= '<tr>
            <td class="text-center"><b>'.tgl_indo($key).'</b></td>
            <td>absen</td>
            <td class="text-center"><b>'.$this->call->get_target('kunjungan').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'kunjungan', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'kunjungan', 'semua')/$this->call->get_target('kunjungan')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('quantity').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'quantity', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'quantity', 'semua')/$this->call->get_target('quantity')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('jumlah dalam percent validator').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'kunjungan', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'kunjungan', 'semua')/$this->call->get_target('jumlah dalam percent validator')),3).'%</b></td>
            </tr>';
            //due date
            $total_act_kunjungan += $this->call->get_act($key, 'kunjungan', 'semua');
            $total_prc_kunjungan += number_format(($this->call->get_act($key, 'kunjungan', 'semua')/$this->call->get_target('kunjungan')),3);
            //hijau
            $total_act_quantity += $this->call->get_act($key, 'quantity', 'semua');
            $total_prc_quantity += number_format(($this->call->get_act($key, 'quantity', 'semua')/$this->call->get_target('quantity')),3);
            //biru
            $total_act_jml += $this->call->get_act($key, 'kunjungan', 'semua');
            $total_prc_jml += number_format(($this->call->get_act($key, 'kunjungan', 'semua')/$this->call->get_target('jumlah dalam percent validator')),3);

            }
        $pesan .=
        '
        <tr>
        <td colspan=2 class=text-center><b>Jumlah</b></td>
        <td class="text-center"><b>'.$this->call->get_target('kunjungan').'</b></td>
        <td class="text-center"><b>'.$total_act_kunjungan.'</b></td>
        <td class="text-center"><b>'.$total_prc_kunjungan.'%</b></td>

        <td class="text-center"><b>'.$this->call->get_target('quantity').'</b></td>
        <td class="text-center"><b>'.$total_act_quantity.'</b></td>
        <td class="text-center"><b>'.$total_prc_quantity.'%</b></td>

        <td class="text-center"><b>'.$this->call->get_target('jumlah dalam percent validator').'</b></td>
        <td class="text-center"><b>'.$total_act_jml.'</b></td>
        <td class="text-center"><b>'.$total_prc_jml.'%</b></td>
        </tr>
        ';
        echo $pesan;

    }

    function load_filter()
    {
        $pesan = "";
        $total_act_kunjungan = 0;
        $total_prc_kunjungan = 0;
        $total_act_quantity = 0;
        $total_prc_quantity = 0;
        $total_act_jml = 0;
        $total_prc_jml = 0;
        $bulan = $this->input->post('bulan');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
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
            <td>absen</td>
            <td class="text-center"><b>'.$this->call->get_target('kunjungan').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'kunjungan', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'kunjungan', $nama)/$this->call->get_target('kunjungan')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('quantity').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'quantity', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'quantity', $nama)/$this->call->get_target('quantity')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('jumlah dalam percent validator').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'kunjungan', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'kunjungan', $nama)/$this->call->get_target('jumlah dalam percent validator')),3).'%</b></td>

            </tr>';

            $total_act_kunjungan += $this->call->get_act($key, 'kunjungan', $nama);
            $total_prc_kunjungan += number_format(($this->call->get_act($key, 'kunjungan', $nama)/$this->call->get_target('kunjungan')),3);
            //hijau
            $total_act_quantity += $this->call->get_act($key, 'quantity', $nama);
            $total_prc_quantity += number_format(($this->call->get_act($key, 'quantity', $nama)/$this->call->get_target('quantity')),3);
            //biru
            $total_act_jml += $this->call->get_act($key, 'kunjungan', $nama);
            $total_prc_jml += number_format(($this->call->get_act($key, 'kunjungan', $nama)/$this->call->get_target('jumlah dalam percent validator')),3);

          }
        $pesan .=
        '
        <tr>
        <td colspan=2 class=text-center><b>Jumlah</b></td>
        <td class="text-center"><b>'.$this->call->get_target('kunjungan').'</b></td>
        <td class="text-center"><b>'.$total_act_kunjungan.'</b></td>
        <td class="text-center"><b>'.$total_prc_kunjungan.'%</b></td>

        <td class="text-center"><b>'.$this->call->get_target('quantity').'</b></td>
        <td class="text-center"><b>'.$total_act_quantity.'</b></td>
        <td class="text-center"><b>'.$total_prc_quantity.'%</b></td>

        <td class="text-center"><b>'.$this->call->get_target('jumlah dalam percent validator').'</b></td>
        <td class="text-center"><b>'.$total_act_jml.'</b></td>
        <td class="text-center"><b>'.$total_prc_jml.'%</b></td>
        </tr>
        ';
        echo $pesan;

    }

}

/* End of file Sumberdata.php */
