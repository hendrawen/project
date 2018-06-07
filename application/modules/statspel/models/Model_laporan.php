<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function laporan_pelanggan($year)
  {
    $query = "SELECT * FROM `brajamarketindo`.`wp_pelanggan`, `wp_transaksi` where (YEAR(`wp_transaksi`.`tgl_transaksi`) = $year) group by kelurahan";
    return $this->db->query($query)->result();
  }

  function laporan_pelanggan_trx($id_pelanggan, $month, $year)
  {
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $data = $this->db->get('wp_transaksi')->num_rows();
    if ($data == 0) {
      return '-';
    } else {
      return $data;
    }
  }

  function laporan_pelanggan_qty($id_pelanggan, $month, $year)
  {
    $this->db->select('sum(wp_transaksi.qty) as `qty`');
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $hasil = $this->db->get('wp_transaksi')->row();

    if ($hasil->qty != 0) {
      return $hasil->qty;
    } else {
      return '-';
    }
  }

  // get all
  function laporan_pelanggan_all()
  {
    $query = "SELECT * FROM `brajamarketindo`.`wp_pelanggan` group by kelurahan";
    return $this->db->query($query)->result();
  }
  // ambil cost and resp aktual
  function lap_pelanggan_all($kelurahan)
  {
    $this->db->select('count(id) as jumlah');
    $this->db->from('wp_pelanggan');
    $this->db->where('kelurahan', $kelurahan);
    $result = $this->db->get()->row();
    if ($result) {
      # code...
      return $result->jumlah;
    } else {
      # code...
      return 0;
    }
  }

  // ambil cost and resp aktif
  function lap_pel_all($kelurahan)
  {
    $this->db->select('count(id) as jumlah');
    $this->db->from('wp_pelanggan');
    $this->db->where('kelurahan', $kelurahan);
    $this->db->where('EXISTS(SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id)');
    $result = $this->db->get()->row();
    if ($result) {
      # code...
      return $result->jumlah;
    } else {
      # code...
      return 0;
    }
  }

  // ambil qty aktual
  function lap_pel($kelurahan)
  {
    $this->db->select('sum(wp_transaksi.qty) as jumlah');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->where('wp_pelanggan.kelurahan', $kelurahan);
    // $this->db->where('EXISTS(SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id)');
    $result = $this->db->get()->row();
    if ($result) {
      # code...
      return $result->jumlah;
    } else {
      # code...
      return 0;
    }
  }
  
  function laporan_pelanggan_trx_all($id_pelanggan, $month)
  {
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $data = $this->db->get('wp_transaksi')->num_rows();
    if ($data == 0) {
      return '-';
    } else {
      return $data;
    }
  }

  function laporan_pelanggan_qty_all($id_pelanggan, $month)
  {
    $this->db->select('sum(wp_transaksi.qty) as `qty`');
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $hasil = $this->db->get('wp_transaksi')->row();

    if ($hasil->qty != 0) {
      return $hasil->qty;
    } else {
      return '-';
    }
  }

}
