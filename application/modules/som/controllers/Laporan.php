<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_laporan', 'mLap');
    $this->load->library('table');
  }

  function index()
  {

  }

  function harian()
  {
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'transaksi/laporan_harian',
      );
      $this->load->view('som/dashboard', $data);
  }

  function load_harian()
  {
    $day = $this->input->post('tgl');
    $data = $this->mLap->laporan_harian($day);
    $pesan = "";
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->harga.'</td>
          <td>'.$row->qty.'</td>
          <td>'.$row->subtotal.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_status.'</td>
          <td>'.$row->tgl_transaksi.'</td>
        </tr>';
      }
    } else {
      $pesan .= '<tr>
        <td colspan=9></td>
      </tr>';
    }
    echo $pesan;
  }

  function bulanan()
  {
      $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'transaksi/laporan_bulanan',
          'month'     => $month,
      );
      $this->load->view('som/dashboard', $data);
  }

  function load_bulanan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_bulanan($from, $to, $tahun);
    $pesan = "";
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->harga.'</td>
          <td>'.$row->qty.'</td>
          <td>'.$row->subtotal.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_status.'</td>
          <td>'.$row->tgl_transaksi.'</td>
        </tr>';
      }
    } else {
      $pesan .= '<tr>
        <td colspan=9></td>
      </tr>';
    }
    echo $pesan;
  }

  function tahunan()
  {
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'transaksi/laporan_tahunan',
      );
      $this->load->view('som/dashboard', $data);
  }

  function load_tahunan()
  {
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_tahunan($tahun);
    $pesan = "";
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->harga.'</td>
          <td>'.$row->qty.'</td>
          <td>'.$row->subtotal.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_status.'</td>
          <td>'.$row->tgl_transaksi.'</td>
        </tr>';
      }
    } else {
      $pesan .= '<tr>
        <td colspan=9></td>
      </tr>';
    }
    echo $pesan;
  }

  function produk()
  {
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'transaksi/laporan_per_produk',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $this->load->view('som/dashboard', $data);
  }

  function load_produk()
  {
    $tahun = $this->input->post('tahun');
    $id_barang = $this->input->post('id_barang');
    $data = $this->mLap->laporan_produk($tahun, $id_barang);
    $no = 1;
    $this->template_table();
    $this->table->clear();
    $this->table->set_heading('No','ID Transaksi','Nama Barang','Harga','QTY','Subtotal','Nama Pelanggan','Status','Tgl Transaksi');
    if ($data) {
      foreach ($data as $row) {
        $this->table->add_row($no++, $row->id_transaksi, $row->nama_barang, $row->harga, $row->qty, $row->subtotal, $row->nama_pelanggan, $row->nama_status, $row->tgl_transaksi);
      }
    } else {
        $this->table->add_row('','','','','','','','','');
    }
    echo $this->table->generate();
  }

  function area()
  {
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'transaksi/laporan_area',
      );
      $this->load->view('som/dashboard', $data);
  }

  function load_area()
  {
    $tahun = $this->input->post('tahun');
    $area = $this->input->post('area');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->mLap->laporan_area($tahun, $area, $berdasarkan);
    $no = 1;
    $this->template_table();
    $this->table->clear();
    $this->table->set_heading('No','ID Transaksi','Nama Barang','Harga','QTY','Subtotal','Nama Pelanggan','Status','Tgl Transaksi');
    if ($data) {
      foreach ($data as $row) {
        $this->table->add_row($no++, $row->id_transaksi, $row->nama_barang, $row->harga, $row->qty, $row->subtotal, $row->nama_pelanggan, $row->nama_status, $row->tgl_transaksi);
      }
    } else {
        $this->table->add_row('','','','','','','','','');
    }
    echo $this->table->generate();
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
        'table_open'            => '<table id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap">',
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
