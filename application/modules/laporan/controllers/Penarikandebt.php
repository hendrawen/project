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

  function excel_tanggal($tanggal, $debt,$status)
  {
    $this->load->helper('exportexcel');
    $namaFile = "transaksi_debt_harian.xls";
    $judul = "Transaksi Debt";
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
    xlsWriteLabel(0, 1, "Harian");
    xlsWriteLabel(1, 0, "Tanggal");
    xlsWriteLabel(1, 1, tgl_indo($tanggal));
    xlsWriteLabel(2, 0, "Nama Debt");
    xlsWriteLabel(2, 1, $this->mLap->get_debt_id($debt));
    xlsWriteLabel(3, 0, "Status");
    xlsWriteLabel(3, 1, $this->mLap->get_status_id($status));
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
    xlsWriteLabel($tablehead, $kolomhead++, "Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

    $record = $this->mLap->laporan_tanggal($tanggal, $debt, $status);
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
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
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

  function excel_bulan($dari, $ke, $tahun, $debt, $status)
  {
    $this->load->helper('exportexcel');
    $namaFile = "transaksi_debt_bulan.xls";
    $judul = "Transaksi Debt";
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

    xlsWriteLabel(5, 0, "Status");
    xlsWriteLabel(5, 1, $this->mLap->get_status_id($status));

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
    xlsWriteLabel($tablehead, $kolomhead++, "Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

    $record = $this->mLap->laporan_bulan($dari, $ke, $tahun, $debt, $status);
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
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
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

  function excel_tahun($tahun, $debt, $status)
  {
    $this->load->helper('exportexcel');
    $namaFile = "transaksi_debt_tahun.xls";
    $judul = "Transaksi Debt";
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
    xlsWriteLabel(3, 0, "Status");
    xlsWriteLabel(3, 1, $this->mLap->get_status_id($status));
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
    xlsWriteLabel($tablehead, $kolomhead++, "Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

    $record = $this->mLap->laporan_tahun($tahun, $debt, $status);
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
          xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
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

  function tes()
  {
    $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get()->result();
        
        echo "<pre>";
        print_r ($data);
        echo "</pre>";
        
  }


}

/* End of file Penjualan.php */