<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
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
      $this->load->model('som/Model_laporan', 'mLap');
      $this->load->model('Penjualan_model');
      $this->load->library('table');
  }

  function index()
  {
    
    redirect('laporan/penjualan/baru','refresh');
    
  }
  
  function baru()
  {
    $data = array(
      'aktif'			=>'laporan',
      'title'			=>'Brajamarketindo',
      'judul'			=>'Dashboard',
      'sub_judul'	=>'Laporan',
      'content'		=>'transaksi/laporan',
      'list_status'		=>$this->Penjualan_model->get_status(),
      'month' => $this->month,
  );
  $this->load->view('panel/dashboard', $data);
  }

  function harian()
  {   
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_harian',
      );
      $this->load->view('panel/dashboard', $data);
  }

  function get_all()
  {
    $data = $this->mLap->get_all();
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.tgl_indo($row->tgl_transaksi).'</td>
          <td>'.tgl_indo($row->jatuh_tempo).'</td>
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

  function load_harian()
  {
    $day = $this->input->post('tgl');
    $data = $this->mLap->laporan_harian($day);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.tgl_indo($row->tgl_transaksi).'</td>
          <td>'.tgl_indo($row->jatuh_tempo).'</td>
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
          'content'		=>'som/transaksi/laporan_bulanan',
          'month'     => $this->month,
      );
      $this->load->view('panel/dashboard', $data);
  }

  function load_bulanan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_bulanan($from, $to, $tahun);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.tgl_indo($row->tgl_transaksi).'</td>
        <td>'.tgl_indo($row->jatuh_tempo).'</td>
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

  function tahunan()
  {   
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/transaksi/laporan_tahunan',
      );
      $this->load->view('panel/dashboard', $data);
  }

  function load_tahunan()
  {
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_tahunan($tahun);
    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.tgl_indo($row->tgl_transaksi).'</td>
        <td>'.tgl_indo($row->jatuh_tempo).'</td>
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
  

  function load_pelanggan_all()
  {
    $data = $this->mLap->laporan_pelanggan_all();
    $no = 1;
    $total = 0;
    $pesan = "";
    if ($data) {
      foreach ($data as $row) {
        $utang = $this->mLap->laporan_pelanggan_utang_all($row->id_pelanggan);

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_pelanggan.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->no_telp.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$row->nama.'</td>
          <td>'.number_format($utang).'</td>';
          for ($month=1; $month <=12 ; $month++) {
            $jumlah_trx = $this->mLap->laporan_pelanggan_trx_all($row->id_pelanggan, $month);
            $jumlah_qty = $this->mLap->laporan_pelanggan_qty_all($row->id_pelanggan, $month);
            $pesan  .= '<td>'.$jumlah_trx.'</td>
            <td>'.$jumlah_qty.'</td>';
          }
        '</tr>';
      }

    } else {
      $pesan = '
      <td colspan=16>Record not found</td>
      ';

    }
    echo $pesan;
  }

  function template_table()
  {
    $template = array(
        'table_open'            => '<table border=1px id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" >',
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

/* End of file Penjualan.php */
