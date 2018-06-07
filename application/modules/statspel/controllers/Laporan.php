<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{
  private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

  public function __construct()
  {
    parent::__construct();
    // if (!$this->ion_auth->logged_in()) {//cek login ga?
    //         redirect('login','refresh');
    //     }else{
    //         if (!$this->ion_auth->in_group('som') AND !$this->ion_auth->in_group('admin')) {//cek admin ga?
    //             redirect('login','refresh');
    //         }
    //     }
    $this->load->model('Model_laporan', 'mLap');
    $this->load->model('Model_dep', 'dep');
    $this->load->library('table');
  }

  // function get_all()
  // {
  //   $data = $this->mLap->get_all();
  //   $pesan = "";
  //   $no = 1;
  //   $total = 0;
  //   if ($data) {
  //     foreach ($data as $row) {
  //       $pesan .= '<tr>
  //         <td>'.$no++.'</td>
  //         <td>'.$row->id_transaksi.'</td>
  //         <td>'.$row->tgl_transaksi.'</td>
  //         <td>'.$row->jatuh_tempo.'</td>
  //         <td>'.$row->id_pelanggan.'</td>
  //         <td>'.$row->nama_pelanggan.'</td>
  //         <td>'.$row->nama_barang.'</td>
  //         <td>'.$row->qty.'</td>
  //         <td>'.$row->satuan.'</td>
  //         <td>'.$row->kota.'</td>
  //         <td>'.$row->kecamatan.'</td>
  //         <td>'.$row->kelurahan.'</td>
  //         <td>'.$row->no_telp.'</td>
  //         <td>'.$row->nama_karyawan.'</td>
  //         <td>'.$row->username.'</td>
  //         <td>'.number_format($row->subtotal).'</td>
  //       </tr>';
  //       $total += $row->subtotal;
  //     }
  //     $pesan .= '<tr>
  //     <td colspan=14 class=text-right>Total</td>
  //     <td colspan=2>'.number_format($total).'</td>
  //     </tr>';
  //   } else {
  //     $pesan .= '<tr>
  //       <td colspan=16>Record not found</td>
  //     </tr>';
  //   }
  //   echo $pesan;
  // }

  /*
    pelanggan
  */

  function pelanggan()
  {
    $to = date('n');
    $from = $to - 1 ;
    $year = date('Y');

    // $record = $this->mLap->laporan_pelanggan($from, $to, $year);
    $data = array(
        'aktif'			=>'som',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Statistik Pelanggan',
        'content'		=>'transaksi/laporan_pelanggan',
        'month'     => $this->month,
        'year'  => set_value('year', $year)
    );

    $this->load->view('panel/dashboard', $data);
  }

  function load_pelanggan()
  {
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_pelanggan($tahun);
    $no = 1;
    $total = 0;
    $pesan = "";
    if ($data) {
      foreach ($data as $row) {
        $aktual = $this->mLap->lap_pelanggan_all($row->kelurahan);
        $respAkt = $this->mLap->lap_pel_all($row->kelurahan);
        $qtyAkt = $this->mLap->lap_pel($row->kelurahan);
        $custTarget = 20;
        $respTarget = 30;
        $qtyTarget = 40;

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$custTarget.'</td>
          <td>'.$aktual.'</td>
          <td>'.$respAkt.'</td>
          <td>'.number_format($aktual / $custTarget, 3).'</td>
          <td>'.$respTarget.'</td>
          <td>'.$aktual.'</td>
          <td>'.number_format($respAkt / $respTarget, 3).'</td>
          <td>'.$qtyTarget.'</td>
          <td>'.$qtyAkt.'</td>
          <td>'.number_format($qtyAkt / $qtyTarget, 3).'</td>
        </tr>';
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
    $data = $this->mLap->laporan_pelanggan_all();
    $no = 1;
    $total = 0;
    $pesan = "";
    if ($data) {
      foreach ($data as $row) {
        $aktual = $this->mLap->lap_pelanggan_all($row->kelurahan);
        $respAkt = $this->mLap->lap_pel_all($row->kelurahan);
        $qtyAkt = $this->mLap->lap_pel($row->kelurahan);
        $custTarget = 20;
        $respTarget = 30;
        $qtyTarget = 40;

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$custTarget.'</td>
          <td>'.$aktual.'</td>
          <td>'.$respAkt.'</td>
          <td>'.number_format($aktual / $custTarget, 3).'</td>
          <td>'.$respTarget.'</td>
          <td>'.$aktual.'</td>
          <td>'.number_format($respAkt / $respTarget, 3).'</td>
          <td>'.$qtyTarget.'</td>
          <td>'.$qtyAkt.'</td>
          <td>'.number_format($qtyAkt / $qtyTarget, 3).'</td>
        </tr>';
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
