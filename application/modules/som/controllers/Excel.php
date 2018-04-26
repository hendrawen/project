<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
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
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_harian($day);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


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
      xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);
      $kolomhead = 0;
      xlsWriteLabel($tablehead, $kolomhead++, "No");
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_bulanan($from, $to, $year);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


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
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_tahunan($year);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


      xlsEOF();
      exit();
  }

  /* --------
    produk
  ----------*/
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
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_produk($year, $id_barang);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


      xlsEOF();
      exit();
  }

  /* --------
    area
  ----------*/
  function area($tahun, $area, $berdasarkan)
  {
      $this->load->helper('exportexcel');
      $namaFile = "transaksi_area.xls";
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

      xlsBOF();
      xlsWriteLabel(0, 0, "Laporan");
      xlsWriteLabel(1, 0, "Tahun");
      xlsWriteLabel(2, 0, "Nama");
      xlsWriteLabel(0, 1, $berdasarkan);
      xlsWriteLabel(1, 1, $tahun);
      xlsWriteLabel(2, 1, $area);
      $kolomhead = 0;
      xlsWriteLabel($tablehead, $kolomhead++, "No");
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_area($tahun, $area, $berdasarkan);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


      xlsEOF();
      exit();
  }


  /* --------
    area
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
      xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "Harga");
      xlsWriteLabel($tablehead, $kolomhead++, "QTY");
      xlsWriteLabel($tablehead, $kolomhead++, "Subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Status");
      $record = $this->mLap->laporan_marketing($tahun, $nama);
      $total = 0;
      foreach ($record as $data) {
          $kolombody = 0;
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
          xlsWriteNumber($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->qty);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total += $data->subtotal;
      }
      xlsWriteLabel($tablebody, 6, 'Total');
      xlsWriteNumber($tablebody, 7, $total);


      xlsEOF();
      exit();
  }


  /* --------
    other function
  ----------*/

  function get_month($value)
  {
    $res;
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
