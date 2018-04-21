<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dep_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getbydriver()
  {
    # code...
    $condition = "curdate() = wp_jadwal.start";
    $this->db->order_by('id_pelanggan');
    $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.alamat, wp_pelanggan.lat, wp_pelanggan.long, wp_pelanggan.no_telp, wp_barang.nama_barang, wp_jadwal.qty, wp_jadwal.start, wp_jadwal.title, wp_jadwal.description');
    $this->db->from('wp_jadwal');
    $this->db->join('wp_pelanggan', 'wp_jadwal.wp_pelanggan_id = wp_pelanggan.id', 'inner');
    $this->db->join('wp_barang', 'wp_jadwal.wp_barang_id = wp_barang.id', 'inner');
    // $this->db->where('wp_jadwal.wp_karyawan_id_karyawan', $this->session->identity);
    $this->db->where($condition);
    return $this->db->get()->result();
  }

  public function gettransaksiharian()
  {
    # code...
    $condition = "curdate() = wp_transaksi.tgl_transaksi";
    $this->db->order_by('id_transaksi', 'DESC');
    $this->db->select('wp_transaksi.id, wp_barang.nama_barang, wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.nama_dagang, wp_transaksi.id_transaksi, wp_transaksi.qty, wp_transaksi.harga, wp_transaksi.subtotal, wp_status.nama_status');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where($condition);
    return $this->db->get()->result();
  }

  function cari_pelanggan($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
    $this->db->where('status', 'Pelanggan');
		$this->db->limit(10);
		return $this->db->get('wp_pelanggan')->result();
	}

  // get data by id
  function get_by_id($id)
  {
      $this->db->where('id', $id);
      return $this->db->get('wp_transaksi')->row();
  }

  function delete($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('wp_transaksi');
  }

  public function getdetail($id)
  {
    # code...
    $this->db->select('nama_barang, qty, nama_pelanggan, id_pelanggan');
    $this->db->where('id_pelanggan', $id);
    return $this->db->get('v_event')->result();
  }

}
