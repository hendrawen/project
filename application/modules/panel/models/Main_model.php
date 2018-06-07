<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function GetPie(){
  // $this->db->select('wp_pelanggan.wp_karyawan_id_karyawan, wp_karyawan.nama, COUNT(wp_pelanggan.wp_karyawan_id_karyawan) AS prestasi');
  // $this->db->from('wp_karyawan');
  // $this->db->join('wp_pelanggan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan', 'left');
  // $this->db->where('wp_pelanggan.status', 'Pelanggan');
  // $this->db->group_by('wp_pelanggan.wp_karyawan_id_karyawan, nama');
  // $query = $this->db->get('');
  $query=$this->db->query("SELECT wp_pelanggan.wp_karyawan_id_karyawan, wp_karyawan.nama, COUNT(wp_pelanggan.wp_karyawan_id_karyawan) AS prestasi
        FROM wp_karyawan
        LEFT JOIN wp_pelanggan
        ON
        wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan AND
        wp_pelanggan.status='Pelanggan'
        GROUP BY wp_pelanggan.wp_karyawan_id_karyawan, wp_karyawan.nama");
  return $query;
  }

}
