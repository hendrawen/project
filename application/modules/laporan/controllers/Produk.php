<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->library('table');

        if (!$this->ion_auth->logged_in()) {//cek login ga?
          redirect('login','refresh');
        } 
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

    /* -------------
  ----- Produk ---
  --------------*/
  //harian
  function produk_harian()
  { 
    $cek = get_permission('Penjualan Harian Per Produk', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'transaksi',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/produk/harian',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_produk_harian()
  {
    $day = $this->input->post('day');
    $id_barang = $this->input->post('id_barang');
    $data = $this->mLap->laporan_produk_harian($day, $id_barang);
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

  //bulanan
  function produk_bulanan()
  { 
    $cek = get_permission('Penjualan Bulanan Per Produk', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'som/produk/bulanan',
          'list_barang' => $this->Barang_model->get_all(),
          'month'     => $this->month,
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_produk_bulanan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $year = $this->input->post('year');
    $id_barang = $this->input->post('id_barang');
    $data = $this->mLap->laporan_produk_bulanan($from, $to, $year, $id_barang);
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

  //tahun
  function produk_tahun()
  { 
    $cek = get_permission('Penjualan Tahunan Per Produk', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'som/produk/tahun',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_produk_tahun()
  {
    $tahun = $this->input->post('tahun');
    $id_barang = $this->input->post('id_barang');
    $data = $this->mLap->laporan_produk($tahun, $id_barang);
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

/* End of file Produk.php */
