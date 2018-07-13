<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dep extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_harian()
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->from('wp_transaksi');
    //$this->db->where('wp_transaksi.tgl_transaksi', $day);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_harian($day, $nama)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->from('wp_transaksi');
    // $this->db->where('wp_transaksi.tgl_transaksi', $day);
    if ($day !== 'semua') {
      $this->db->where('wp_transaksi.tgl_transaksi', $day);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_bulanan($from, $to, $year, $nama)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
    $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_tahunan($year, $nama)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->from('wp_transaksi');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_produk($year, $id_barang)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->from('wp_transaksi');
    $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    $this->db->where('wp_barang.id', $id_barang);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();

  }

}
