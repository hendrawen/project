<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller {

    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Penarikan_model', 'laporan');
        
    }
    
    function harian()
    {
        # code...
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan/penarikan_harian',
            'month'         => $this->month,
            'debt'          => $this->laporan->get_debt(),
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_penarikan_harian()
    {
        $day = $this->input->post('tgl');
        $debt = $this->input->post('debt');
        $data = $this->laporan->penarikan_harian($debt, $day);
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->total.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_uang.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function bulanan()
    {
        # code...
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan/penarikan_bulanan',
            'month'         => $this->month,
            'debt'          => $this->laporan->get_debt(),
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_penarikan_bulanan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->penarikan_bulanan($from, $to, $tahun);
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->total.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_uang.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function tahunan()
    {
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'penarikan/penarikan_tahunan',
            'month'         => $this->month,
            'debt'          => $this->laporan->get_debt(),
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_penarikan_tahunan()
    {
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->penarikan_tahunan($tahun);
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->total.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_uang.'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function load_penarikan_all()
    {
        $data = $this->laporan->penarikan_bulanan_all();
        $pesan = "";
        $total = 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.$row->total.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.$row->bayar_krat.'</td>
            <td>'.tgl_indo($row->tgl_penarikan).'</td>
            <td>'.number_format($row->bayar_uang).'</td>
            <td>'.$row->jumlah.'</td>
            <td>'.$row->sisa.'</td>
            <td>'.$row->status.'</td>
            </tr>';
            $total += $row->sisa;
        }
        $pesan .= '<tr>
        <td colspan=19 class=text-right><b>total sisa aset</b></td>
        <td colspan=2><b>'.$total.'</b></td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=21>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function isi_dept($pilih)
    {
        $this->load->database();
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan','wp_jabatan.id=wp_karyawan.wp_jabatan_id');
        $this->db->where('wp_jabatan.nama_jabatan','Debt & Delivery');
        $karyawan = $this->db->get()->result();
        $opt = "";
        if ($pilih == "dept") {
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
