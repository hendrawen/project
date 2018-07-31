<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('Super User')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    $this->load->model('Model_laporan', 'mLap');

  }

  function harian($day)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_harian.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Tanggal");
      xlsWriteLabel(0, 1, "Harian");
      xlsWriteLabel(1, 1, $day);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

      $record = $this->mLap->laporan_harian($day);
      $total = 0;
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
            xlsWriteLabel($tablebody, $kolombody++, $data->kota);
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
            xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
            $tablebody++;
            $nourut++;
            $total += $data->subtotal;
        }
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  function bulanan($from, $to, $year)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_bulanan.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Periode");
      xlsWriteLabel(0, 1, "Bulanan");
      if ($from == 'semua' || $to == 'semua') {
        xlsWriteLabel(1, 1, 'semua bulan '.$year);
      } else {
        xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);
        }
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_bulanan($from, $to, $year);
      $total = 0;
      if ($record) {
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
              xlsWriteLabel($tablebody, $kolombody++, $data->kota);
              xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
              xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
              xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
              xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
              xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
              xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
              $tablebody++;
              $nourut++;
              $total += $data->subtotal;
          }
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
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
      xlsWriteLabel(0, 1, "Tahunan");
      xlsWriteLabel(1, 1, $year);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_tahunan($year);
      $total = 0;
      if ($record) {
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
              xlsWriteLabel($tablebody, $kolombody++, $data->kota);
              xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
              xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
              xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
              xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
              xlsWriteLabel($tablebody, $kolombody++, $data->nama_debt);
              xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
              $tablebody++;
              $nourut++;
              $total += $data->subtotal;
          }
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  /* --------
    produk
  ----------*/
  //tahunan
  function produk($year, $id_barang)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_produk.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Tahun");
      xlsWriteLabel(0, 1, "Produk : ".$this->get_nama_barang($id_barang));
      xlsWriteLabel(1, 1, $year);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_produk($year, $id_barang);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  //bulanan
  function produk_bulanan($from, $to, $year, $id_barang)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_produk_bulanan.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Periode");
      xlsWriteLabel(2, 0, "Produk");

      xlsWriteLabel(0, 1, 'Produk');
      xlsWriteLabel(1, 1, getBulan($from).' - '.getBulan($to).' '.$year);
      xlsWriteLabel(2, 1, "Produk : ".$this->get_nama_barang($id_barang));
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_produk_bulanan($from, $to, $year, $id_barang);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  //harian
  function produk_harian($day, $id_barang)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_produk_harian.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Tanggal");
      xlsWriteLabel(0, 1, "Produk : ".$this->get_nama_barang($id_barang));
      xlsWriteLabel(1, 1, $day);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_produk_harian($day, $id_barang);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  /* --------
    end produk
  ----------*/

  /* --------
    area
  ----------*/
  function area($tahun, $area, $berdasarkan)
  {
    $area = rawurldecode($area);
    $berdasarkan = rawurldecode($berdasarkan);
      $this->load->helper('exportexcel');
      $namaFile = "trans_area_tahun.xls";
      $judul = "Transaksi";
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
      $area2 = $area;
      $berdasarkan2 = $berdasarkan;
      if ($area == "-") {
        $area = "Semua";
        $area2 = "";
      }
      if ($berdasarkan == "-") {
        $berdasarkan = "Semua";
        $berdasarkan2 = "";
      }

      xlsBOF();
      xlsWriteLabel(0, 0, "Laporan");
      xlsWriteLabel(0, 1, "Per area");
      xlsWriteLabel(1, 0, "Tahun");
      xlsWriteLabel(1, 1, $tahun);
      xlsWriteLabel(2, 0, "Berdasarkan");
      xlsWriteLabel(2, 1, $berdasarkan.' '.$area);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

      $record = $this->mLap->laporan_area($tahun, $area2, $berdasarkan2);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  function area_bulanan($bulanDari, $bulanKe, $tahun, $area, $berdasarkan)
  {
      $this->load->helper('exportexcel');
      $area = rawurldecode($area);
      $berdasarkan = rawurldecode($berdasarkan);
      $namaFile = "trans_area_bulan.xls";
      $judul = "Transaksi";
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
      $area2 = $area;
      $berdasarkan2 = $berdasarkan;
      if ($berdasarkan == "-") {
          $area = '';
        $berdasarkan = "Semua";
        $berdasarkan2 = "";
      }

      xlsBOF();
      xlsWriteLabel(0, 0, "Laporan");
      xlsWriteLabel(0, 1, "Per area");
      xlsWriteLabel(1, 0, "Bulan ke");
      xlsWriteLabel(1, 1, $bulanDari.' - '.$bulanKe.' '.$tahun );
      xlsWriteLabel(2, 0, "Berdasarkan");
      xlsWriteLabel(2, 1, $berdasarkan.' '.$area);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

      $record = $this->mLap->laporan_area_bulanan($bulanDari, $bulanKe, $tahun, $area2, $berdasarkan2);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  function area_harian($tgl, $area, $berdasarkan)
  {
      $area = rawurldecode($area);
      $berdasarkan = rawurldecode($berdasarkan);
      $this->load->helper('exportexcel');
      $namaFile = "trans_area_harian.xls";
      $judul = "Transaksi";
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
      $area2 = $area;
      $berdasarkan2 = $berdasarkan;
      if ($berdasarkan == "-") {
          $area = '';
        $berdasarkan = "Semua";
        $berdasarkan2 = "";
      }

      xlsBOF();
      xlsWriteLabel(0, 0, "Laporan");
      xlsWriteLabel(0, 1, "Per area");
      xlsWriteLabel(1, 0, "Tanggal");
      xlsWriteLabel(1, 1, $tgl );
      xlsWriteLabel(2, 0, "Berdasarkan");
      xlsWriteLabel(2, 1, $berdasarkan.' '.$area);
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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

      $record = $this->mLap->laporan_area_harian($tgl, $area2, $berdasarkan2);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);
      xlsEOF();
      exit();
  }

  /* --------
    end of area
  ----------*/
  



  function marketing($tahun, $nama)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_marketing.xls";
      $judul = "Transaksi";
      $tablehead = 3;
      $tablebody = 4;
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
      xlsWriteLabel(1, 0, "Tahun");
      xlsWriteLabel(0, 1, "Marketing : ".$nama);
      xlsWriteLabel(1, 1, $tahun);

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
      xlsWriteLabel($tablehead, $kolomhead++, "Kota");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Debt");
      xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
      $record = $this->mLap->laporan_marketing($tahun, $nama);
      $total = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->kota);
          xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
          xlsWriteLabel($tablebody, $kolombody++, $data->username);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 14, 'Total');
      xlsWriteNumber($tablebody, 15, $total);

      xlsEOF();
      exit();
  }


  //laporan Pelanggan

  function pelanggan($from, $to, $year)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_pelanggan.xls";
      $judul = "Transaksi";
      $tablehead = 3;
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
      xlsWriteLabel(1, 0, "Periode");
      xlsWriteLabel(0, 1, "Pelanggan");
      xlsWriteLabel(1, 1, getBulan($from).' - '.getBulan($to).' '.$year);
      $kolomhead = 0;
      xlsWriteLabel($tablehead, $kolomhead++, "No");
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Customer");
      xlsWriteLabel($tablehead, $kolomhead++, "Telpon");
      xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
      xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
      xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
      xlsWriteLabel($tablehead, $kolomhead++, "Piutang");
      xlsWriteLabel($tablehead, 8, "Januari");
      xlsWriteLabel($tablehead, 10, "Februari");
      xlsWriteLabel($tablehead, 12, "Maret");
      xlsWriteLabel($tablehead, 14, "April");
      xlsWriteLabel($tablehead, 16, "Mei");
      xlsWriteLabel($tablehead, 18, "Juni");
      xlsWriteLabel($tablehead, 20, "Juli");
      xlsWriteLabel($tablehead, 22, "Agustus");
      xlsWriteLabel($tablehead, 24, "September");
      xlsWriteLabel($tablehead, 26, "Oktober");
      xlsWriteLabel($tablehead, 28, "November");
      xlsWriteLabel($tablehead, 30, "Desember");
      xlsWriteLabel(($tablehead+1), 8, "TRX");
      xlsWriteLabel(($tablehead+1), 9, "QTY");
      xlsWriteLabel(($tablehead+1), 10, "TRX");
      xlsWriteLabel(($tablehead+1), 11, "QTY");
      xlsWriteLabel(($tablehead+1), 12, "TRX");
      xlsWriteLabel(($tablehead+1), 13, "QTY");
      xlsWriteLabel(($tablehead+1), 14, "TRX");
      xlsWriteLabel(($tablehead+1), 15, "QTY");
      xlsWriteLabel(($tablehead+1), 16, "TRX");
      xlsWriteLabel(($tablehead+1), 17, "QTY");
      xlsWriteLabel(($tablehead+1), 18, "TRX");
      xlsWriteLabel(($tablehead+1), 19, "QTY");
      xlsWriteLabel(($tablehead+1), 20, "TRX");
      xlsWriteLabel(($tablehead+1), 21, "QTY");
      xlsWriteLabel(($tablehead+1), 22, "TRX");
      xlsWriteLabel(($tablehead+1), 23, "QTY");
      xlsWriteLabel(($tablehead+1), 24, "TRX");
      xlsWriteLabel(($tablehead+1), 25, "QTY");
      xlsWriteLabel(($tablehead+1), 26, "TRX");
      xlsWriteLabel(($tablehead+1), 27, "QTY");
      xlsWriteLabel(($tablehead+1), 28, "TRX");
      xlsWriteLabel(($tablehead+1), 29, "QTY");
      xlsWriteLabel(($tablehead+1), 30, "TRX");
      xlsWriteLabel(($tablehead+1), 31, "QTY");

      $record = $this->mLap->laporan_pelanggan($from, $to, $year);
      foreach ($record as $row) {
          $utang = $this->mLap->laporan_pelanggan_utang($row->id_pelanggan, $from, $to, $year);
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $row->id_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $row->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $row->no_telp);
          xlsWriteLabel($tablebody, $kolombody++, $row->kelurahan);
          xlsWriteLabel($tablebody, $kolombody++, $row->kecamatan);
          xlsWriteLabel($tablebody, $kolombody++, $row->nama);
          xlsWriteNumber($tablebody, $kolombody++, $utang);
          for ($month=1; $month <=12 ; $month++) {
            $jumlah_trx = $this->mLap->laporan_pelanggan_trx($row->id_pelanggan, $month, $year);
            $jumlah_qty = $this->mLap->laporan_pelanggan_qty($row->id_pelanggan, $month, $year);
            xlsWriteNumber($tablebody, $kolombody++, $jumlah_trx);
            xlsWriteNumber($tablebody, $kolombody++, $jumlah_qty);
          }
          $tablebody++;
          $nourut++;
      }


      xlsEOF();
      exit();
  }

  /* --------
    other function
  ----------*/

  function get_month($value)
  {
    $res = array();
    $month = array('Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember');
    for ($i=0; $i < sizeOf($month); $i++) {
      if ($value == $i) {
        $res = $month[$i-1];
        break;
      }
    }
    return $res;
  }

  function get_nama_barang($id_barang)
  {
    $this->db->where('id', $id_barang);
    $record = $this->db->get('wp_barang')->row();
    return $record->nama_barang;
  }


}
