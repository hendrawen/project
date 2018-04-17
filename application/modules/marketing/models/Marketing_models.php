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
      return $this->db->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id)
  {
      $this->db->where($this->id, $id);
      return $this->db->get($this->table)->row();
  }

  // get total rows
  function total_rows($q = NULL) {
      $this->db->like('id', $q);
      $this->db->or_like('id_pelanggan', $q);
      $this->db->or_like('nama_pelanggan', $q);
      $this->db->or_like('nama_dagang', $q);
      $this->db->from($this->table);
      return $this->db->count_all_results();
  }

  function total_pelanggan() {
      $this->db->from($this->table);
      $this->db->where('status', 'Pelanggan');
      return $this->db->count_all_results();
  }

  function total_responden() {
      $this->db->from($this->table);
      $this->db->where('status', 'Responden');
      return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
      $this->db->order_by($this->id, $this->order);
      $this->db->like('id', $q);
      $this->db->or_like('id_pelanggan', $q);
      $this->db->or_like('nama_pelanggan', $q);
      $this->db->or_like('nama_dagang', $q);
      $this->db->limit($limit, $start);
      return $this->db->get($this->table)->result();
  }

 public function save($data)
 {
     $this->db->insert($this->table2, $data);
     return $this->db->insert_id();
 }

 function update($id, $data)
 {
     $this->db->where($this->id, $id);
     return $this->db->update($this->table2, $data);

 }

 public function delete_by_id($id)
 {
     $this->db->where('id', $id);
     $this->db->delete($this->table2);
 }

 public function get_list_kota()
 {
     $this->db->select('kota');
     $this->db->from($this->table);
     $this->db->order_by('kota','asc');
     $query = $this->db->get();
     $result = $query->result();

     $kota = array();
     foreach ($result as $row)
     {
         $kota[] = $row->kota;
     }
     return $kota;
 }

 public function get_list_status()
 {
     $this->db->select('status');
     $this->db->from($this->table);
     $this->db->order_by('status','asc');
     $query = $this->db->get();
     $result = $query->result();

     $status = array();
     foreach ($result as $row)
     {
         $status[] = $row->status;
     }
     return $status;
 }

 public function get_list_kelurahan()
 {
     $this->db->select('kelurahan');
     $this->db->from($this->table);
     $this->db->order_by('kelurahan','asc');
     $query = $this->db->get();
     $result = $query->result();

     $kelurahan = array();
     foreach ($result as $row)
     {
         $kelurahan[] = $row->kelurahan;
     }
     return $kelurahan;
 }

 public function get_list_kecamatan()
 {
     $this->db->select('kecamatan');
     $this->db->from($this->table);
     $this->db->order_by('kecamatan','asc');
     $query = $this->db->get();
     $result = $query->result();

     $kecamatan = array();
     foreach ($result as $row)
     {
         $kecamatan[] = $row->kecamatan;
     }
     return $kecamatan;
 }

 public function get_list_surveyor()
 {
     $this->db->select('nama');
     $this->db->from($this->table);
     $this->db->order_by('nama','asc');
     $query = $this->db->get();
     $result = $query->result();

     $surveyor = array();
     foreach ($result as $row)
     {
         $surveyor[] = $row->nama;
     }
     return $surveyor;
 }

 public function get_list_bulan()
 {
     $this->db->select('Month(created_at) as bulan');
     $this->db->from($this->table);
     $query = $this->db->get();
     $result = $query->result();

     $bulan = array();
     foreach ($result as $row)
     {
         $bulan[] = getBulan('1');
         $bulan[] = getBulan('2');
         $bulan[] = getBulan('3');
         $bulan[] = getBulan('4');
         $bulan[] = getBulan('5');
         $bulan[] = getBulan('6');
         $bulan[] = getBulan('7');
         $bulan[] = getBulan('8');
         $bulan[] = getBulan('9');
         $bulan[] = getBulan('10');
         $bulan[] = getBulan('11');
         $bulan[] = getBulan('12');
     }
     return $bulan;
 }

 //BUAT MODEL MAX_KODE_MAHASISWA
public function get_kode_pelanggan() {
 $tahun = date("Y");
 $kode = 'PL';
 $query = $this->db->query("SELECT MAX(id_pelanggan) as max_id FROM wp_pelanggan");
 $row = $query->row_array();
 $max_id = $row['max_id'];
 $max_id1 =(int) substr($max_id,9,5);
 $kode_pelanggan = $max_id1 +1;
 $maxkode_pelanggan = $kode.'-'.$tahun.'-'.sprintf("%04s",$kode_pelanggan);
 return $maxkode_pelanggan;
}

}
