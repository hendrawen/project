<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->library('table');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
          redirect('login','refresh');
          }else{
              if (!$this->ion_auth->in_group('Kepala Cabang')) {//cek admin ga?
                  redirect('login','refresh');
              }
        }
        $this->load->model('Penjualan_produk', 'produk');

    }

    function index()
    {
      $data = array(
          'aktif'			=>'laporan',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	    =>'Aset',
          'content'		=>'produk/produk',
          'month'         => $this->month,
          'list_barang' => $this->produk->get_produk(),
      );
    $this->load->view('dashboard', $data);
    }

    function ajax_list()
    {

        $list = $this->produk->get_datatables();
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
                        "recordsTotal" => $this->produk->count_all(),
                        "recordsFiltered" => $this->produk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
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

    /* -------------
  ----- Produk ---
  --------------*/
  //harian
  function produk_harian()
  {
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'transaksi',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Laporan',
          'content'		=>'som/produk/harian',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $this->load->view('dashboard', $data);
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

  //bulanan
  function produk_bulanan()
  {
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
      $this->load->view('dashboard', $data);
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

  //tahun
  function produk_tahun()
  {
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'SOM',
          'content'		=>'som/produk/tahun',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $this->load->view('dashboard', $data);
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
