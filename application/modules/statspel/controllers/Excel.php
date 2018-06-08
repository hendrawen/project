<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    $this->load->model('Model_laporan', 'mLap');

  }

  /* ------------
    year
  --------------*/

  function tahunan($year)
  {
    $this->load->helper('exportexcel');
    $namaFile = "transaksi_tahunan.xls";
    $judul = "Transaksi";
    $tablehead = 3;
    $tablebody = 4;
    $nourut = 1;
    // if(!$year){
    //     $year = 'semua';
    // }
    //penulisan header
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();
    xlsWriteLabel(0, 0, "Laporan");
    xlsWriteLabel(1, 0, "Tahun");
    xlsWriteLabel(0, 1, "Statistik Pelanggan");
    xlsWriteLabel(1, 1, $year);
    $kolomhead = 0;
    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "Kota");
    xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
    xlsWriteLabel(2, 4, "Customers");
    xlsWriteLabel(2, 5, "Customers");
    xlsWriteLabel(2, 6, "Customers");
    xlsWriteLabel(2, 7, "Customers");
    xlsWriteLabel($tablehead, $kolomhead++, "Target");
    xlsWriteLabel($tablehead, $kolomhead++, "Aktual");
    xlsWriteLabel($tablehead, $kolomhead++, "Aktif");
    xlsWriteLabel($tablehead, $kolomhead++, "Persen");
    xlsWriteLabel(2, 8, "Respondent");
    xlsWriteLabel(2, 9, "Respondent");
    xlsWriteLabel(2, 10, "Respondent");
    xlsWriteLabel($tablehead, $kolomhead++, "Target");
    xlsWriteLabel($tablehead, $kolomhead++, "Aktual");
    xlsWriteLabel($tablehead, $kolomhead++, "Persen");
    xlsWriteLabel(2, 11, "Qty");
    xlsWriteLabel(2, 12, "Qty");
    xlsWriteLabel(2, 13, "Qty");
    xlsWriteLabel($tablehead, $kolomhead++, "Target");
    xlsWriteLabel($tablehead, $kolomhead++, "Aktual");
    xlsWriteLabel($tablehead, $kolomhead++, "Persen");
    $record = $this->mLap->laporan_tahunan($year);
    $total = 0;
    $custTarget = 20;
    $respTarget = 30;
    $qtyTarget = 40;

    $jum_tar_c = 0;
    $jum_c_act = 0;
    $jum_c_akt = 0;
    $jum_c_pers = 0;

    $jum_tar_r = 0;
    $jum_r_act = 0;
    $jum_r_pers = 0;
    
    $jum_tar_q = 0;
    $jum_q_act = 0;
    $jum_q_pers = 0; 

    foreach ($record as $data) {
        $custAktual = $this->mLap->lap_pelanggan_all($data->kelurahan);
        $custAktif = $this->mLap->lap_pel_all($data->kelurahan);
        $qtyAkt = $this->mLap->lap_pel($data->kelurahan);


        // $c_pers = $custAktual / $custTarget;
        // $r_pers = number_format($custAktual / $respTarget, 3);
        // $q_pers = number_format($qtyAkt / $qtyTarget, 3);

        $jum_tar_c += $custTarget;
        $jum_c_act += $custAktual;
        $jum_c_akt += $custAktif;
        $jum_c_pers += $custAktual / $custTarget;

        $jum_tar_r += $respTarget;
        $jum_r_act += $custAktual;
        $jum_r_pers += $custAktual / $respTarget;
        
        $jum_tar_q += $qtyTarget;
        $jum_q_act += $qtyAkt;
        $jum_q_pers += $qtyAkt / $qtyTarget;

        $kolombody = 0;
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->kota);
        xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
        xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
        xlsWriteLabel($tablebody, $kolombody++, $custTarget);
        xlsWriteLabel($tablebody, $kolombody++, $custAktual);
        xlsWriteLabel($tablebody, $kolombody++, $custAktif);
        xlsWriteNumber($tablebody, $kolombody++, $custAktual / $custTarget);
        xlsWriteLabel($tablebody, $kolombody++, $respTarget);
        xlsWriteLabel($tablebody, $kolombody++, $custAktual);
        xlsWriteLabel($tablebody, $kolombody++, $custAktual / $respTarget);
        xlsWriteLabel($tablebody, $kolombody++, $qtyTarget);
        xlsWriteLabel($tablebody, $kolombody++, $qtyAkt);
        xlsWriteLabel($tablebody, $kolombody++, $qtyAkt / $qtyTarget);
        $tablebody++;
        $nourut++;
        
    }
    xlsWriteLabel($tablebody, 0, 'Jumlah');
    xlsWriteLabel($tablebody, 4, $jum_tar_c);
    xlsWriteLabel($tablebody, 5, $jum_c_act);
    xlsWriteLabel($tablebody, 6, $jum_c_akt);
    xlsWriteLabel($tablebody, 7, $jum_c_pers);
    xlsWriteLabel($tablebody, 8, $jum_tar_r);
    xlsWriteLabel($tablebody, 9, $jum_r_act);
    xlsWriteLabel($tablebody, 10, $jum_r_pers);
    xlsWriteLabel($tablebody, 11, $jum_tar_q);
    xlsWriteLabel($tablebody, 12, $jum_q_act);
    xlsWriteLabel($tablebody, 13, $jum_q_pers);
    
    xlsEOF();
    exit();
}

}
