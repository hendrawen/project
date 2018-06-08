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
    xlsWriteLabel($tablehead, $kolomhead++, "C(Target)");
    xlsWriteLabel($tablehead, $kolomhead++, "C(Aktual)");
    xlsWriteLabel($tablehead, $kolomhead++, "C(Aktif)");
    xlsWriteLabel($tablehead, $kolomhead++, "C(Persen)");
    xlsWriteLabel($tablehead, $kolomhead++, "R(Target)");
    xlsWriteLabel($tablehead, $kolomhead++, "R(Aktual)");
    xlsWriteLabel($tablehead, $kolomhead++, "R(Persen)");
    xlsWriteLabel($tablehead, $kolomhead++, "Q(Target)");
    xlsWriteLabel($tablehead, $kolomhead++, "Q(Aktual)");
    xlsWriteLabel($tablehead, $kolomhead++, "Q(Persen)");
    $record = $this->mLap->laporan_tahunan($year);
    $total = 0;
    foreach ($record as $data) {
        // $aktual = $this->mLap->lap_pelanggan_all($record->kelurahan);

        $custTarget = 20;

        $kolombody = 0;
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->kota);
        xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
        xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
        xlsWriteLabel($tablebody, $kolombody++, $custTarget);
        // xlsWriteLabel($tablebody, $kolombody++, $aktual);
        // xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
        // xlsWriteNumber($tablebody, $kolombody++, $data->qty);
        // xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
        // xlsWriteLabel($tablebody, $kolombody++, $data->kota);
        // xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
        // xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
        // xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
        // xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
        // xlsWriteLabel($tablebody, $kolombody++, $data->username);
        // xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
        $tablebody++;
        $nourut++;
        $total += $data->subtotal;
    }
    xlsWriteLabel($tablebody+2, 0, 'Note :');
    xlsWriteLabel($tablebody+3, 0, 'C = Customers');
    xlsWriteLabel($tablebody+4, 0, 'R = Respondent');
    xlsWriteLabel($tablebody+5, 0, 'Q = Quantity');
    xlsEOF();
    exit();
}

}
