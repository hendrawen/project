<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function laporan_harian($day)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('wp_transaksi.tgl_transaksi', $day);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_bulanan($from, $to, $year)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
    $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_tahunan($year)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_produk($year, $id_barang)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->where('wp_barang.id', $id_barang);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_area($year, $area, $berdasarkan)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->where('wp_pelanggan.'.$berdasarkan, $area);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_marketing($year, $nama)
  {
    $this->db->select('id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
    if ($nama !== 'semua') {
      $this->db->where('wp_karyawan.id_karyawan', $nama);
    }
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_pelanggan($from, $to, $year)
  {
    $this->db->distinct();
    $this->db->select('wp_transaksi.id_transaksi, wp_barang.nama_barang,
      harga, qty, subtotal, tgl_transaksi, wp_pelanggan.id_pelanggan,wp_pelanggan.no_telp, wp_pelanggan.kelurahan,wp_pelanggan.kecamatan,
      wp_pelanggan.nama_pelanggan, wp_status.nama_status, wp_karyawan.nama, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `piutang`');
    $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
    $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    $this->db->join('wp_detail_transaksi', 'wp_detail_transaksi.id_transaksi = wp_transaksi.id_transaksi', 'inner');
    return $this->db->get('wp_transaksi')->result();
  }

  function laporan_pelanggan_trx($id_pelanggan, $month, $year)
  {
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    return $this->db->get('wp_transaksi')->num_rows();
  }

  function laporan_pelanggan_qty($id_pelanggan, $month, $year)
  {
    $this->db->select('sum(wp_transaksi.qty) as `qty`');
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $hasil = $this->db->get('wp_transaksi')->row();
    return $hasil->qty;
  }

}
