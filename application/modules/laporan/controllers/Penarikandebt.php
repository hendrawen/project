<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikandebt extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
  
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
      $this->load->model('PenarikanDebt_model', 'mLap');
      $this->load->library('table');
  }
  

  function ajax_list()
  {
    $list = $this->mLap->get_datatables();
    $data = array();
      $no = $_POST['start'];
      foreach ($list as $lap) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $lap->id_transaksi;
        $row[] = tgl_indo($lap->tgl_transaksi);
        $row[] = tgl_indo($lap->jatuh_tempo);
        $row[] = $lap->id_pelanggan;
        $row[] = $lap->nama_pelanggan;
        $row[] = $lap->nama_barang;
        $row[] = $lap->qty;
        $row[] = $lap->satuan;
        $row[] = $lap->kecamatan;
        $row[] = $lap->kelurahan;
        $row[] = $lap->no_telp;
        $row[] = $lap->nama;
        $row[] = $lap->nama_debt;
        $row[] = $lap->total;
        $row[] = tgl_indo($lap->tgl_penarikan);
        $row[] = $lap->bayar_krat;
        $row[] = tgl_indo($lap->tgl_penarikan);
        $row[] = $lap->bayar_uang;
        $row[] = $lap->jumlah;
        $row[] = $lap->sisa;
        $row[] = $lap->status;
        $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->mLap->count_all(),
                      "recordsFiltered" => $this->mLap->count_filtered(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);
  }

  function excel_tanggal($tanggal, $debt)
  {
    $this->load->helper('exportexcel');
    $namaFile = "penarikan_debt_harian.xls";
    $judul = "Penarikan Debt";
    $tablehead = 4;
    $tablebody = 5;
    $nourut = 1;
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
    xlsWriteLabel(0, 1, "Harian");
    xlsWriteLabel(1, 0, "Tanggal");
    xlsWriteLabel(1, 1, tgl_indo($tanggal));
    xlsWriteLabel(2, 0, "Nama Debt");
    xlsWriteLabel(2, 1, $this->mLap->get_debt_id($debt));
    $kolomhead = 0;
    
    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
    xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
    xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "QTY");
    xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
    xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
    xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
    xlsWriteLabel($tablehead, $kolomhead++, "Debt");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar (Rp.)");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Aset");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_tanggal($tanggal, $debt);
    $total = array();
    $total['total'] = 0;
    $total['bayar_krat'] = 0;
    $total['bayar_uang'] = 0;
    $total['jumlah'] = 0;
    $total['sisa'] = 0;
    if ($record){
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
          xlsWriteLabel($tablebody, $kolombody++, $data->total);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_krat);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_uang);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa);
          xlsWriteLabel($tablebody, $kolombody++, $data->status);
          $tablebody++;
          $nourut++;
          $total['total'] += $data->total;
          $total['bayar_krat'] += $data->bayar_krat;
          $total['bayar_uang'] += $data->bayar_uang;
          $total['jumlah'] += $data->jumlah;
          $total['sisa'] += $data->sisa;
      }
    }
    xlsWriteLabel($tablebody, 13, 'Total');
    xlsWriteNumber($tablebody, 14, $total['total']);
    xlsWriteNumber($tablebody, 16, $total['bayar_krat']);
    xlsWriteNumber($tablebody, 18, $total['bayar_uang']);
    xlsWriteNumber($tablebody, 19, $total['jumlah']);
    xlsWriteNumber($tablebody, 20, $total['sisa']);
    xlsEOF();
    exit();
  }

  function excel_bulan($dari, $ke, $tahun, $debt)
  {
    $this->load->helper('exportexcel');
    $namaFile = "penarikan_debt_bulan.xls";
    $judul = "Penarikan Debt";
    $tablehead = 7;
    $tablebody = 8;
    $nourut = 1;
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
    xlsWriteLabel(0, 1, "Bulan");

    xlsWriteLabel(1, 0, "Dari");
    xlsWriteLabel(1, 1, getBulan($dari));

    xlsWriteLabel(2, 0, "Ke");
    xlsWriteLabel(2, 1, getBulan($ke));

    xlsWriteLabel(3, 0, "Tahun");
    xlsWriteLabel(3, 1, $tahun);

    xlsWriteLabel(4, 0, "Status");
    xlsWriteLabel(4, 1, $this->mLap->get_debt_id($debt));

    $kolomhead = 0;

    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
    xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
    xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "QTY");
    xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
    xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
    xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
    xlsWriteLabel($tablehead, $kolomhead++, "Debt");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar (Rp.)");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Aset");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_bulan($dari, $ke, $tahun, $debt);
    $total = array();
    $total['total'] = 0;
    $total['bayar_krat'] = 0;
    $total['bayar_uang'] = 0;
    $total['jumlah'] = 0;
    $total['sisa'] = 0;
    if ($record){
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
          xlsWriteLabel($tablebody, $kolombody++, $data->total);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_krat);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_uang);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa);
          xlsWriteLabel($tablebody, $kolombody++, $data->status);
          $tablebody++;
          $nourut++;
          $total['total'] += $data->total;
          $total['bayar_krat'] += $data->bayar_krat;
          $total['bayar_uang'] += $data->bayar_uang;
          $total['jumlah'] += $data->jumlah;
          $total['sisa'] += $data->sisa;
      }
    }
    xlsWriteLabel($tablebody, 13, 'Total');
    xlsWriteNumber($tablebody, 14, $total['total']);
    xlsWriteNumber($tablebody, 16, $total['bayar_krat']);
    xlsWriteNumber($tablebody, 18, $total['bayar_uang']);
    xlsWriteNumber($tablebody, 19, $total['jumlah']);
    xlsWriteNumber($tablebody, 20, $total['sisa']);
    xlsEOF();
    exit();
  }

  function excel_tahun($tahun, $debt)
  {
    $this->load->helper('exportexcel');
    $namaFile = "penarikan_debt_tahun.xls";
    $judul = "Penarikan Debt";
    $tablehead = 5;
    $tablebody = 6;
    $nourut = 1;
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
    xlsWriteLabel(0, 1, "Tahun");
    xlsWriteLabel(1, 0, "Tahun");
    xlsWriteLabel(1, 1, $tahun);
    xlsWriteLabel(2, 0, "Nama Debt");
    xlsWriteLabel(2, 1, $this->mLap->get_debt_id($debt));
    $kolomhead = 0;

    xlsWriteLabel($tablehead, $kolomhead++, "No");
    xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
    xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
    xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "QTY");
    xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
    xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
    xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
    xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
    xlsWriteLabel($tablehead, $kolomhead++, "Debt");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar (Rp.)");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Aset");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_tahun($tahun, $debt);
    $total = array();
    $total['total'] = 0;
    $total['bayar_krat'] = 0;
    $total['bayar_uang'] = 0;
    $total['jumlah'] = 0;
    $total['sisa'] = 0;
    if ($record){
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
          xlsWriteLabel($tablebody, $kolombody++, $data->total);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_krat);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar_uang);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa);
          xlsWriteLabel($tablebody, $kolombody++, $data->status);
          $tablebody++;
          $nourut++;
          $total['total'] += $data->total;
          $total['bayar_krat'] += $data->bayar_krat;
          $total['bayar_uang'] += $data->bayar_uang;
          $total['jumlah'] += $data->jumlah;
          $total['sisa'] += $data->sisa;
      }
    }
    xlsWriteLabel($tablebody, 13, 'Total');
    xlsWriteNumber($tablebody, 14, $total['total']);
    xlsWriteNumber($tablebody, 16, $total['bayar_krat']);
    xlsWriteNumber($tablebody, 18, $total['bayar_uang']);
    xlsWriteNumber($tablebody, 19, $total['jumlah']);
    xlsWriteNumber($tablebody, 20, $total['sisa']);
    xlsEOF();
    exit();
  }

  function tes()
  {
    
    $data = $this->mLap->laporan_tanggal('semua','semua');
    
        echo "<pre>";
        print_r ($data);
        echo "</pre>";
  }


}

/* End of file Penjualan.php */