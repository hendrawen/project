<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{
  private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

  private $permit;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_laporan', 'mLap');
    $this->load->model('Model_dep', 'dep');
    $this->load->library('table');
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
  }

  function pelanggan()
  { 
    $to = date('n');
    $from = $to - 1 ;
    $year = date('Y');

    $data = array(
        'aktif'			=>'som',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Statistik Pelanggan',
        'content'		=>'transaksi/laporan_pelanggan',
        'month'     => $this->month,
        'year'  => set_value('year', $year)
    );
    $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
    $this->load->view('panel/dashboard', $data);
  }

  function load_pelanggan()
  {
    $tahun = $this->input->post('tahun');
    $data = $this->mLap->laporan_tahunan($tahun);
    $no = 1;
    $total = 0;
    $pesan = "";
    $jum_tar_c = $jum_c_act = $jum_c_akt = $jum_c_pers = 0;
    $jum_tar_r = $jum_r_act  = $jum_r_pers = 0;
    $jum_tar_q = $jum_q_act  = $jum_q_pers = 0;
    if ($data) {
      foreach ($data as $row) {
        $custAktual = $this->mLap->lap_pelanggan_all($row->kelurahan);
        $custAktif = $this->mLap->lap_pel_all($row->kelurahan);
        $qtyAkt = $this->mLap->lap_pel($row->kelurahan);

        $custTarget = 20;
        $respTarget = 30;
        $qtyTarget = 40;

        $c_pers = number_format($custAktual / $custTarget, 3);
        $r_pers = number_format($custAktual / $respTarget, 3);
        $q_pers = number_format($qtyAkt / $qtyTarget, 3);

        $jum_tar_c += $custTarget; 
        $jum_c_act += $custAktual;
        $jum_c_akt += $custAktif;
        $jum_c_pers += $c_pers;

        $jum_tar_r += $respTarget;
        $jum_r_act += $custAktual;
        $jum_r_pers += $r_pers;
        
        $jum_tar_q += $qtyTarget;
        $jum_q_act += $qtyAkt;
        $jum_q_pers += $q_pers;

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$custTarget.'</td>
          <td>'.$custAktual.'</td>
          <td>'.$custAktif.'</td>
          <td>'.$c_pers.' %</td>
          <td>'.$respTarget.'</td>
          <td>'.$custAktual.'</td>
          <td>'.$r_pers.' %</td>
          <td>'.$qtyTarget.'</td>
          <td>'.$qtyAkt.'</td>
          <td>'.$q_pers.' %</td>
        </tr>';
      }
      $pesan .= '
        <td colspan=4> Jumlah </td>
        <td>'.$jum_tar_c.'</td>
        <td>'.$jum_c_act.'</td>
        <td>'.$jum_c_akt.'</td>
        <td>'.$jum_c_pers.' %</td>
        <td>'.$jum_tar_r.'</td>
        <td>'.$jum_r_act.'</td>
        <td>'.$jum_r_pers.' %</td>
        <td>'.$jum_tar_q.'</td>
        <td>'.$jum_q_act.'</td>
        <td>'.$jum_q_pers.' %</td>';

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
    $jum_tar_c = $jum_c_act = $jum_c_akt = $jum_c_pers = 0;
    $jum_tar_r = $jum_r_act  = $jum_r_pers = 0;
    $jum_tar_q = $jum_q_act  = $jum_q_pers = 0;
    if ($data) {
      foreach ($data as $row) {
        $custAktual = $this->mLap->lap_pelanggan_all($row->kelurahan);
        $custAktif = $this->mLap->lap_pel_all($row->kelurahan);
        $qtyAkt = $this->mLap->lap_pel($row->kelurahan);

        $custTarget = 20;
        $respTarget = 30;
        $qtyTarget = 40;

        $c_pers = number_format($custAktual / $custTarget, 3);
        $r_pers = number_format($custAktual / $respTarget, 3);
        $q_pers = number_format($qtyAkt / $qtyTarget, 3);

        $jum_tar_c += $custTarget; 
        $jum_c_act += $custAktual;
        $jum_c_akt += $custAktif;
        $jum_c_pers += $c_pers;

        $jum_tar_r += $respTarget;
        $jum_r_act += $custAktual;
        $jum_r_pers += $r_pers;
        
        $jum_tar_q += $qtyTarget;
        $jum_q_act += $qtyAkt;
        $jum_q_pers += $q_pers;

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->kota.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$custTarget.'</td>
          <td>'.$custAktual.'</td>
          <td>'.$custAktif.'</td>
          <td>'.$c_pers.' %</td>
          <td>'.$respTarget.'</td>
          <td>'.$custAktual.'</td>
          <td>'.$r_pers.' %</td>
          <td>'.$qtyTarget.'</td>
          <td>'.$qtyAkt.'</td>
          <td>'.$q_pers.' %</td>
        </tr>';
      }
      $pesan .= '
        <td colspan=4> Jumlah </td>
        <td>'.$jum_tar_c.'</td>
        <td>'.$jum_c_act.'</td>
        <td>'.$jum_c_akt.'</td>
        <td>'.$jum_c_pers.' %</td>
        <td>'.$jum_tar_r.'</td>
        <td>'.$jum_r_act.'</td>
        <td>'.$jum_r_pers.' %</td>
        <td>'.$jum_tar_q.'</td>
        <td>'.$jum_q_act.'</td>
        <td>'.$jum_q_pers.' %</td>';

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
