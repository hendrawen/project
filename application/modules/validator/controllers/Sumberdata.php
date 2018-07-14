<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sumberdata extends CI_Controller {
    private $permit;
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('Validator')) {//cek admin ga?
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
        $data['content']		='effective/sumber';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['barang']         = $this->call->get_barang();
        $data['count_barang']   = $this->call->count_barang();
        $data['month']          = $this->month;
        $this->load->view('dashboard', $data);
    }

    function load_all()
    {
        # code...
        $pesan = "";
        $total_act_due = 0;  
        $total_prc_due = 0;
        $total_act_biru = 0;  
        $total_prc_biru = 0;
        $total_act_kuning = 0;  
        $total_prc_kuning = 0; 
        $total_act_orange = 0;  
        $total_prc_orange = 0;    
        $total_act_ijo = 0;  
        $total_prc_ijo = 0;
        $total_act_pink = 0;  
        $total_prc_pink = 0;
        $total_act_jumlah = 0;  
        $total_prc_jumlah = 0;
        $bulan = $this->input->post('bulan');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $cek = get_list_day(date("n"), date("Y"));
        foreach ($cek as $key) {
            # code...
            $pesan .= '<tr>
            <td class="text-center"><b>'.tgl_indo($key).'</b></td>
            <td>absen</td>
            <td class="text-center"><b>'.$this->call->get_target('Due Date').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Due Date', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Due Date', 'semua')/$this->call->get_target('Due Date')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Biru').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Biru', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Biru', 'semua')/$this->call->get_target('Biru')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Kuning').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Kuning', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Kuning', 'semua')/$this->call->get_target('Kuning')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Orange').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Orange', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Orange', 'semua')/$this->call->get_target('Orange')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Ijo').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Ijo', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Ijo', 'semua')/$this->call->get_target('Ijo')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Pink').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Pink', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Pink', 'semua')/$this->call->get_target('Pink')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Jumlah Dalam Percent').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'semua', 'semua').'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'semua', 'semua')/$this->call->get_target('Jumlah Dalam Percent')),3).'%</b></td>
            </tr>';
            //due date
            $total_act_due += $this->call->get_act($key, 'Due Date', 'semua');
            $total_prc_due += number_format(($this->call->get_act($key, 'Due Date', 'semua')/$this->call->get_target('Due Date')),3);
            //biru
            $total_act_biru += $this->call->get_act($key, 'Biru', 'semua');
            $total_prc_biru += number_format(($this->call->get_act($key, 'Biru', 'semua')/$this->call->get_target('Biru')),3);
            //kuning
            $total_act_kuning += $this->call->get_act($key, 'Kuning', 'semua');
            $total_prc_kuning += number_format(($this->call->get_act($key, 'Kuning', 'semua')/$this->call->get_target('Kuning')),3);
            //orange
            $total_act_orange += $this->call->get_act($key, 'Orange', 'semua');
            $total_prc_orange += number_format(($this->call->get_act($key, 'Orange', 'semua')/$this->call->get_target('Orange')),3);
            //ijo
            $total_act_ijo += $this->call->get_act($key, 'Ijo', 'semua');
            $total_prc_ijo += number_format(($this->call->get_act($key, 'Ijo', 'semua')/$this->call->get_target('Ijo')),3);
            //pink
            $total_act_pink += $this->call->get_act($key, 'Pink', 'semua');
            $total_prc_pink += number_format(($this->call->get_act($key, 'Pink', 'semua')/$this->call->get_target('Pink')),3);
            //jumlah
            $total_act_jumlah += $this->call->get_act($key, 'semua', 'semua');
            $total_prc_jumlah += number_format(($this->call->get_act($key, 'semua', 'semua')/$this->call->get_target('Jumlah Dalam Percent')),3);
        } 
        $pesan .= 
        '
        <tr>
        <td colspan=2 class=text-center><b>Jumlah</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Due Date').'</b></td>
        <td class="text-center"><b>'.$total_act_due.'</b></td>
        <td class="text-center"><b>'.$total_prc_due.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Biru').'</b></td>
        <td class="text-center"><b>'.$total_act_biru.'</b></td>
        <td class="text-center"><b>'.$total_prc_biru.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Kuning').'</b></td>
        <td class="text-center"><b>'.$total_act_kuning.'</b></td>
        <td class="text-center"><b>'.$total_prc_kuning.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Orange').'</b></td>
        <td class="text-center"><b>'.$total_act_orange.'</b></td>
        <td class="text-center"><b>'.$total_prc_orange.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Ijo').'</b></td>
        <td class="text-center"><b>'.$total_act_ijo.'</b></td>
        <td class="text-center"><b>'.$total_prc_ijo.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Pink').'</b></td>
        <td class="text-center"><b>'.$total_act_pink.'</b></td>
        <td class="text-center"><b>'.$total_prc_pink.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Jumlah Dalam Percent').'</b></td>
        <td class="text-center"><b>'.$total_act_jumlah.'</b></td>
        <td class="text-center"><b>'.$total_prc_jumlah.'%</b></td>
        </tr>
        ';
        echo $pesan;

    }

    function load_filter()
    {
        # code...
        $pesan = "";
        $total_act_due = 0;  
        $total_prc_due = 0;
        $total_act_biru = 0;  
        $total_prc_biru = 0;
        $total_act_kuning = 0;  
        $total_prc_kuning = 0; 
        $total_act_orange = 0;  
        $total_prc_orange = 0;    
        $total_act_ijo = 0;  
        $total_prc_ijo = 0;
        $total_act_pink = 0;  
        $total_prc_pink = 0;
        $total_act_jumlah = 0;  
        $total_prc_jumlah = 0;
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
            <td class="text-center"><b>'.$this->call->get_target('Due Date').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Due Date', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Due Date', $nama)/$this->call->get_target('Due Date')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Biru').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Biru', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Biru', $nama)/$this->call->get_target('Biru')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Kuning').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Kuning', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Kuning', $nama)/$this->call->get_target('Kuning')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Orange').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Orange', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Orange', $nama)/$this->call->get_target('Orange')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Ijo').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Ijo', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Ijo', $nama)/$this->call->get_target('Ijo')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Pink').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'Pink', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'Pink', $nama)/$this->call->get_target('Pink')),3).'%</b></td>

            <td class="text-center"><b>'.$this->call->get_target('Jumlah Dalam Percent').'</b></td>
            <td class="text-center"><b>'.$this->call->get_act($key, 'semua', $nama).'</b></td>
            <td class="text-center"><b>'.number_format(($this->call->get_act($key, 'semua', $nama)/$this->call->get_target('Jumlah Dalam Percent')),3).'%</b></td>
            </tr>';
            //due date
            $total_act_due += $this->call->get_act($key, 'Due Date', $nama);
            $total_prc_due += number_format(($this->call->get_act($key, 'Due Date', $nama)/$this->call->get_target('Due Date')),3);
            //biru
            $total_act_biru += $this->call->get_act($key, 'Biru', $nama);
            $total_prc_biru += number_format(($this->call->get_act($key, 'Biru', $nama)/$this->call->get_target('Biru')),3);
            //kuning
            $total_act_kuning += $this->call->get_act($key, 'Kuning', $nama);
            $total_prc_kuning += number_format(($this->call->get_act($key, 'Kuning', $nama)/$this->call->get_target('Kuning')),3);
            //orange
            $total_act_orange += $this->call->get_act($key, 'Orange', $nama);
            $total_prc_orange += number_format(($this->call->get_act($key, 'Orange', $nama)/$this->call->get_target('Orange')),3);
            //ijo
            $total_act_ijo += $this->call->get_act($key, 'Ijo', $nama);
            $total_prc_ijo += number_format(($this->call->get_act($key, 'Ijo', $nama)/$this->call->get_target('Ijo')),3);
            //pink
            $total_act_pink += $this->call->get_act($key, 'Pink', $nama);
            $total_prc_pink += number_format(($this->call->get_act($key, 'Pink', $nama)/$this->call->get_target('Pink')),3);
            //jumlah
            $total_act_jumlah += $this->call->get_act($key, 'semua', $nama);
            $total_prc_jumlah += number_format(($this->call->get_act($key, 'semua', $nama)/$this->call->get_target('Jumlah Dalam Percent')),3);
        } 
        $pesan .= 
        '
        <tr>
        <td colspan=2 class=text-center><b>Jumlah</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Due Date').'</b></td>
        <td class="text-center"><b>'.$total_act_due.'</b></td>
        <td class="text-center"><b>'.$total_prc_due.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Biru').'</b></td>
        <td class="text-center"><b>'.$total_act_biru.'</b></td>
        <td class="text-center"><b>'.$total_prc_biru.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Kuning').'</b></td>
        <td class="text-center"><b>'.$total_act_kuning.'</b></td>
        <td class="text-center"><b>'.$total_prc_kuning.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Orange').'</b></td>
        <td class="text-center"><b>'.$total_act_orange.'</b></td>
        <td class="text-center"><b>'.$total_prc_orange.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Ijo').'</b></td>
        <td class="text-center"><b>'.$total_act_ijo.'</b></td>
        <td class="text-center"><b>'.$total_prc_ijo.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Pink').'</b></td>
        <td class="text-center"><b>'.$total_act_pink.'</b></td>
        <td class="text-center"><b>'.$total_prc_pink.'%</b></td>
        <td class="text-center"><b>'.$this->call->get_target('Jumlah Dalam Percent').'</b></td>
        <td class="text-center"><b>'.$total_act_jumlah.'</b></td>
        <td class="text-center"><b>'.$total_prc_jumlah.'%</b></td>
        </tr>
        ';
        echo $pesan;

    }

}

/* End of file Sumberdata.php */
