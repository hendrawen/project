<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('Models_laporan', 'laporan');
        $this->load->model('som/Model_laporan', 'mLap');
        $this->load->model('som/Model_dep', 'dep');
        $this->load->library('table');
        
    }

    function tracking()
    {   
        $cek = get_permission('Report Transaksi', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $to = date('n');
        $from = $to - 1 ;
        $year = date('Y');

        // $record = $this->mLap->laporan_pelanggan($from, $to, $year);
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Tracking Pelanggan',
            'content'		=>'som/transaksi/laporan_pelanggan',
            'month'     => $this->month,
            // 'record'    => $record,
            'from'  => set_value('from', $from),
            'to'  => set_value('to', $to),
            'year'  => set_value('year', $year)
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

  function load_pelanggan()
  { 
    $cek = get_permission('Report Transaksi', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $data = $this->dep->laporan_pelanggan($from, $to, $tahun);
    $no = 1;
    $total = 0;
    $pesan = "";
    if ($data) {
      foreach ($data as $row) {
        $utang = $this->dep->laporan_pelanggan_utang($row->id_pelanggan, $from, $to, $tahun);

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
            $jumlah_trx = $this->dep->laporan_pelanggan_trx($row->id_pelanggan, $month, $tahun);
            $jumlah_qty = $this->dep->laporan_pelanggan_qty($row->id_pelanggan, $month, $tahun);
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

  function load_pelanggan_all()
  { 
    $cek = get_permission('Report Transaksi', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
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

/* End of file Controllername.php */
