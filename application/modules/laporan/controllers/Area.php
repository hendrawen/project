<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
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
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->model('Area_model', 'area');
    }

    function index()
    {
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'area/index',
            'month'         => $this->month,
        );
        $this->load->view('panel/dashboard', $data);
    }

    function ajax_list()
    {
        $list = $this->area->get_datatables();
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
            $row[] = $lap->nama_karyawan;
            $row[] = $lap->nama_debt;
            $row[] = $lap->subtotal;
            $data[] = $row;
        }

        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->area->count_all(),
          "recordsFiltered" => $this->area->count_filtered(),
          "data" => $data,
          );
        //output to json format
        echo json_encode($output);
    }

    function tahun()
    {   
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Laporan',
            'content'		=>'som/transaksi/laporan_area',
        );
        $this->load->view('panel/dashboard', $data);
    }

  function load_area()
  { 
    $tahun = $this->input->post('tahun');
    $area = $this->input->post('area');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->mLap->laporan_area($tahun, $area, $berdasarkan);
    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
        <td>'.$row->id_pelanggan.'</td>
        <td>'.$row->nama_pelanggan.'</td>
        <td>'.$row->nama_barang.'</td>
        <td>'.$row->qty.'</td>
        <td>'.$row->satuan.'</td>
        <td>'.$row->kota.'</td>
        <td>'.$row->kecamatan.'</td>
        <td>'.$row->kelurahan.'</td>
        <td>'.$row->no_telp.'</td>
        <td>'.$row->nama_karyawan.'</td>
        <td>'.$row->nama_debt.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=14 class=text-right>Total</td>
      <td colspan=2>'.number_format($total).'</td>
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
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_area_bulanan',
          'month'     =>$this->month,
      );
      $this->load->view('panel/dashboard', $data);
  }

  function load_area_bulan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $area = $this->input->post('area');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->mLap->laporan_area_bulanan($from, $to, $tahun, $area, $berdasarkan);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
        <td>'.$row->id_pelanggan.'</td>
        <td>'.$row->nama_pelanggan.'</td>
        <td>'.$row->nama_barang.'</td>
        <td>'.$row->qty.'</td>
        <td>'.$row->satuan.'</td>
        <td>'.$row->kota.'</td>
        <td>'.$row->kecamatan.'</td>
        <td>'.$row->kelurahan.'</td>
        <td>'.$row->no_telp.'</td>
        <td>'.$row->nama_karyawan.'</td>
        <td>'.$row->nama_debt.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }//load_area_bulan

  function harian()
  {   
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_area_harian',
      );
      $this->load->view('panel/dashboard', $data);
  }

  function load_area_harian()
  { 
    $day = $this->input->post('tgl');
    $berdasarkan = $this->input->post('berdasarkan');
    $area = $this->input->post('area');
    $data = $this->mLap->laporan_area_harian($day, $area, $berdasarkan);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->tgl_transaksi.'</td>
          <td>'.$row->jatuh_tempo.'</td>
          <td>'.$row->id_pelanggan.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->qty.'</td>
          <td>'.$row->satuan.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->no_telp.'</td>
          <td>'.$row->nama_karyawan.'</td>
          <td>'.$row->nama_debt.'</td>
          <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function load_area_all()
  { 
    $day = $this->input->post('tgl');
    $berdasarkan = $this->input->post('berdasarkan');
    $area = $this->input->post('area');
    $data = $this->area->laporan_area_all();
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->tgl_transaksi.'</td>
          <td>'.$row->jatuh_tempo.'</td>
          <td>'.$row->id_pelanggan.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->qty.'</td>
          <td>'.$row->satuan.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->no_telp.'</td>
          <td>'.$row->nama_karyawan.'</td>
          <td>'.$row->nama_debt.'</td>
          <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function isi_area($pilih)
  {
    $this->load->database();
    $this->db->select("DISTINCT($pilih)");
    $pelanggan = $this->db->get('wp_pelanggan')->result();
    $opt = "";
    foreach ($pelanggan as $row) {
      $opt .= '
      <option value="'.$row->$pilih.'">'.$row->$pilih.'</option>
      ';
    }
    echo $opt;
  }

}

/* End of file Area.php */
