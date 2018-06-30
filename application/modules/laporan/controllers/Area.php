<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->model('Models_laporan', 'area');
        
        $this->load->library('table');
    }

    function tahun()
  {   
    $cek = get_permission('Penjualan Tahunan Per Area', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_area',
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
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
        <td>'.$row->username.'</td>
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
    $cek = get_permission('Penjualan Bulanan Per Area', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_area_bulanan',
          'month'     =>$this->month,
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
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
        <td>'.$row->username.'</td>
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
    $cek = get_permission('Penjualan Harian Per Area', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_area_harian',
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
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
          <td>'.$row->username.'</td>
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
          <td>'.$row->username.'</td>
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

  function template_table()
    {
        $template = array(
            'table_open'            => ' <table id="datatable" class="table table-striped table-bordered">',
            // 'table_open'            => '<table id="example" class="table table-striped jambo_table table-bordered dt-responsive nowrap">',
            'thead_open'            => '<thead>',
            'thead_close'           => '</thead>',
            'heading_row_start'     => '<tr>',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th>',
            'heading_cell_end'      => '</th>',
            'tbody_open'            => '<tbody>',
            'tbody_close'           => '</tbody>',
            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td>',
            'cell_end'              => '</td>',
            'row_alt_start'         => '<tr>',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td>',
            'cell_alt_end'          => '</td>',
            'table_close'           => '</table>'
        );
        $this->table->set_template($template);
    }

}

/* End of file Area.php */
