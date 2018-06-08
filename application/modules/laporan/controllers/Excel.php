<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Models_laporan');
        
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

    function pembayaran_bulanan($from, $to, $year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembayaran_bulanan.xls";
        $judul = "pembayaran";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Piutang");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->laporan_bulanan($from, $to, $year);
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
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
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa_hutang);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
            $tablebody++;
            $nourut++;
            $total += $data->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        xlsWriteLabel($tablebody, 16, 'Total Transaksi');
        xlsWriteNumber($tablebody, 17, $total);
        xlsWriteLabel($tablebody, 16, 'Total Bayar');
        xlsWriteNumber($tablebody, 17, $total_bayar);
        xlsWriteLabel($tablebody, 16, 'Total Sisa Hutang');
        xlsWriteNumber($tablebody, 17, $total_sisa);
        xlsEOF();
        exit();
    }

    function pembayaran_tahunan($year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembayaran_tahunan.xls";
        $judul = "pembayaran";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
        xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
        xlsWriteLabel($tablehead, $kolomhead++, "Debt");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Piutang");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->laporan_tahunan($year);
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
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
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa_hutang);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
            $tablebody++;
            $nourut++;
            $total += $data->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        xlsWriteLabel($tablebody, 16, 'Total Transaksi');
        xlsWriteNumber($tablebody, 17, $total);
        xlsWriteLabel($tablebody, 16, 'Total Bayar');
        xlsWriteNumber($tablebody, 17, $total_bayar);
        xlsWriteLabel($tablebody, 16, 'Total Sisa Hutang');
        xlsWriteNumber($tablebody, 17, $total_sisa);
        xlsEOF();
        exit();
    }

    function pembayaran_harian($day)
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembayaran_harian.xls";
        $judul = "pembayaran";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
        xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
        xlsWriteLabel($tablehead, $kolomhead++, "Debt");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Piutang");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->laporan_pembayaran_harian($day);
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
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
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa_hutang);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
            $tablebody++;
            $nourut++;
            $total += $data->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        xlsWriteLabel($tablebody, 16, 'Total Transaksi');
        xlsWriteNumber($tablebody, 17, $total);
        xlsWriteLabel($tablebody, 16, 'Total Bayar');
        xlsWriteNumber($tablebody, 17, $total_bayar);
        xlsWriteLabel($tablebody, 16, 'Total Sisa Hutang');
        xlsWriteNumber($tablebody, 17, $total_bayar);
        xlsEOF();
        exit();
    }


    function Penarikan_bulanan($from, $to, $year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "penarikan_bulanan.xls";
        $judul = "penarikan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Penarikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa ASET");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->penarikan_bulanan($from, $to, $year);
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
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar_krat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar_uang);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            $tablebody++;
            $nourut++;
            $total += $data->sisa;
        }
        xlsWriteLabel($tablebody, 19, 'Total sisa aset');
        xlsWriteNumber($tablebody, 20, $total);
        xlsEOF();
        exit();
    }

    function marketing_tahunan($tahun, $nama)
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_marketing_tahunan.xls";
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
        $record = $this->Models_laporan->laporan_tahunan_marketing($tahun, $nama);
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

    function marketing_harian($day, $nama)
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_marketing_harian.xls";
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
        $record = $this->Models_laporan->laporan_harian_marketing($day, $nama);
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

    function marketing_bulanan($from, $to, $year, $nama)
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi_marketing_bulanan.xls";
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
        xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);

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
        $record = $this->Models_laporan->laporan_tahunan_marketing($from, $to, $year, $nama);
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

/* End of file Excel.php */
