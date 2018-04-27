<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_models extends CI_Model{

  public $id = 'id';
  var $table = 'wp_pelanggan';
  public $order = 'DESC';

  function __construct()
  {
      parent::__construct();
  }

  function get_all()
  {
      $this->db->order_by($this->id, $this->order);
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->get()->result();
  }

  // get data by id
  function get_by_id($id)
  {
      $this->db->where($this->id, $id);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->get($this->table)->row();
  }

  function get_by_idpelanggan($id)
  {
      $this->db->where('id_pelanggan', $id);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->get($this->table)->row();
  }

  // get total rows
  function total_rows($q = NULL) {
      $this->db->from($this->table);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->count_all_results();
  }

  function total_pelanggan() {
      $this->db->from($this->table);
      $this->db->where('status', 'Pelanggan');
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->count_all_results();
  }

  function pelanggan_perbulan() {
      $condition = "MONTH(NOW()) = MONTH(created_at)";
      $this->db->from($this->table);
      $this->db->where('status', 'Pelanggan');
      $this->db->where($condition);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->count_all_results();
  }

  function responden_perbulan() {
      $condition = "MONTH(NOW()) = MONTH(created_at)";
      $this->db->from($this->table);
      $this->db->where('status', 'Responden');
      $this->db->where($condition);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->count_all_results();
  }

  function total_transaksi()
  {
    # code...
    $this->db->select('sum(wp_transaksi.subtotal) as sub_total, COUNT(wp_transaksi.id_transaksi) as jmlh_transaksi');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
    $this->db->where('wp_karyawan.id_karyawan', $this->session->identity);
    return $this->db->get()->result();
  }

  function detail_total_transaksi($id)
  {
    # code...
    $this->db->select('sum(wp_transaksi.subtotal) as total, COUNT(wp_transaksi.id_transaksi) as jmlh_transaksi');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
    $this->db->where('wp_karyawan.id_karyawan', $this->session->identity);
    $this->db->where('wp_pelanggan.id_pelanggan', $id);
    return $this->db->get()->result();
  }

  public function transaksi_detail_pelanggan($id)
  {
    # code...
    $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_transaksi.id_transaksi, wp_barang.nama_barang, wp_transaksi.qty, wp_transaksi.subtotal, wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'left');
    $this->db->where('wp_pelanggan.wp_karyawan_id_karyawan', $this->session->identity);
    $this->db->where('wp_pelanggan.id_pelanggan', $id);
    $this->db->limit('10');
    return $this->db->get()->result();
  }

  function total_responden() {
      $this->db->from($this->table);
      $this->db->where('status', 'Responden');
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
      $this->db->order_by($this->id, $this->order);
      $this->db->like('id_pelanggan', $q);
      $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
      $this->db->limit($limit, $start);
      return $this->db->get($this->table)->result();
  }

 public function save($data)
 {
     $this->db->insert($this->table, $data);
     return $this->db->insert_id();
 }

 function update($id, $data)
 {
     $this->db->where($this->id, $id);
     $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
     return $this->db->update($this->table, $data);

 }

 public function delete_by_id($id)
 {
     $this->db->where('id', $id);
     $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
     $this->db->delete($this->table);
 }

 //BUAT MODEL MAX_KODE_MAHASISWA
public function get_kode_pelanggan() {
  $tahun = date("Y");
  $kode = 'CBM';
  $query = $this->db->query("SELECT MAX(id_pelanggan) as max_id FROM wp_pelanggan");
  $row = $query->row_array();
  $max_id = $row['max_id'];
  $max_id1 =(int) substr($max_id,3,5);
  $kode_pelanggan = $max_id1 +1;
  $maxkode_pelanggan = $kode.''.sprintf("%04s",$kode_pelanggan);
  return $maxkode_pelanggan;
}

}
