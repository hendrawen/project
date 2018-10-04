<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayarandebt extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

  public function __construct()
  {
      parent::__construct();
      //Do your magic here
      if (!$this->ion_auth->logged_in()) {//cek login ga?
        redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('Kepala Cabang')) {// 
                redirect('login','refresh');
            }
      }
      $this->load->model('PembayaranDebt_model', 'mLap');
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
        $row[] = number_format($lap->subtotal,2,',','.');
        $row[] = (($lap->bayar > 0 )? tgl_indo($lap->tgl_bayar):'');
        $row[] = (($lap->bayar >= $lap->subtotal) ? $lap->subtotal : $lap->bayar);
        $row[] = (($lap->bayar >= $lap->subtotal) ? $lap->subtotal : $lap->jumlah_bayar);
        $row[] = number_format($lap->sisa_hutang,2,',','.');
        $row[] = $lap->nama_status;
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
    $namaFile = "pembayaran_debt_harian.xls";
    $judul = "Pembayaran Debt";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Hutang");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_tanggal($tanggal, $debt);
    $total = array();
    $total['bayar'] = 0;
    $total['jumlah_bayar'] = 0;
    $total['sisa_hutang'] = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, (($data->bayar > 0 )? tgl_indo($data->tgl_bayar):''));
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa_hutang);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total['bayar'] += $data->bayar;
          $total['jumlah_bayar'] += $data->jumlah_bayar;
          $total['sisa_hutang'] += $data->sisa_hutang;
      }
    }
    xlsWriteLabel($tablebody, 15, 'Total');
    xlsWriteNumber($tablebody, 16, $total['bayar']);
    xlsWriteNumber($tablebody, 17, $total['jumlah_bayar']);
    xlsWriteNumber($tablebody, 18, $total['sisa_hutang']);
    xlsEOF();
    exit();
  }

  function excel_bulan($dari, $ke, $tahun, $debt)
  {
    $this->load->helper('exportexcel');
    $namaFile = "pembayaran_debt_bulan.xls";
    $judul = "Pembayaran Debt";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Hutang");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_bulan($dari, $ke, $tahun, $debt);
    $total = array();
    $total['bayar'] = 0;
    $total['jumlah_bayar'] = 0;
    $total['sisa_hutang'] = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, (($data->bayar > 0 )? tgl_indo($data->tgl_bayar):''));
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa_hutang);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total['bayar'] += $data->bayar;
          $total['jumlah_bayar'] += $data->jumlah_bayar;
          $total['sisa_hutang'] += $data->sisa_hutang;
      }
    }
    xlsWriteLabel($tablebody, 15, 'Total');
    xlsWriteNumber($tablebody, 16, $total['bayar']);
    xlsWriteNumber($tablebody, 17, $total['jumlah_bayar']);
    xlsWriteNumber($tablebody, 18, $total['sisa_hutang']);
    xlsEOF();
    exit();
  }

  function excel_tahun($tahun, $debt)
  {
    $this->load->helper('exportexcel');
    $namaFile = "pembayaran_debt_tahun.xls";
    $judul = "Pembayaran Debt";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Sisa Hutang");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    $record = $this->mLap->laporan_tahun($tahun, $debt);
    $total = array();
    $total['bayar'] = 0;
    $total['jumlah_bayar'] = 0;
    $total['sisa_hutang'] = 0;
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
          xlsWriteLabel($tablebody, $kolombody++, $data->subtotal);
          xlsWriteLabel($tablebody, $kolombody++, (($data->bayar > 0 )? tgl_indo($data->tgl_bayar):''));
          xlsWriteLabel($tablebody, $kolombody++, $data->bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_bayar);
          xlsWriteLabel($tablebody, $kolombody++, $data->sisa_hutang);
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
          $tablebody++;
          $nourut++;
          $total['bayar'] += $data->bayar;
          $total['jumlah_bayar'] += $data->jumlah_bayar;
          $total['sisa_hutang'] += $data->sisa_hutang;
      }
    }
    xlsWriteLabel($tablebody, 15, 'Total');
    xlsWriteNumber($tablebody, 16, $total['bayar']);
    xlsWriteNumber($tablebody, 17, $total['jumlah_bayar']);
    xlsWriteNumber($tablebody, 18, $total['sisa_hutang']);
    xlsEOF();
    exit();
  }

  function tes()
  {
   $data = $this->mLap->laporan_tahun('2018', 'semua');

    echo "<pre>";
    print_r ($data);
    echo "</pre>";
  }


}

/* End of file Penjualan.php */
