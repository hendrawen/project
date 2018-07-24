<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public $table = 'wp_jadwal';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct() {
        
    }

   function get_all()
    {
        $this->db->select('wp_jadwal.*, wp_barang.id_barang, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan, wp_karyawan.nama');
        $this->db->join('wp_barang', 'wp_barang.id = wp_jadwal.wp_barang_id', 'inner');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_jadwal.wp_pelanggan_id', 'inner');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_jadwal.wp_karyawan_id_karyawan', 'inner');
        $this->db->order_by('wp_jadwal.id', 'desc');
        return $this->db->get('wp_jadwal')->result();                               
    }

    function load_jadwal_harian($day)
    {
        $this->db->select('wp_jadwal.*, wp_barang.id_barang, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan, wp_karyawan.nama');
        $this->db->join('wp_barang', 'wp_barang.id = wp_jadwal.wp_barang_id', 'inner');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_jadwal.wp_pelanggan_id', 'inner');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_jadwal.wp_karyawan_id_karyawan', 'inner');
        if ($day != 'semua') {
            $this->db->where('DATE(wp_jadwal.start)', $day);
            }
        $this->db->order_by('wp_jadwal.id', 'desc');
        return $this->db->get('wp_jadwal')->result(); 
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function buat_kode(){
        $this->db->select('RIGHT(wp_jadwal.id_jadwal, 2) as kode', FALSE);
        $this->db->order_by($this->id, $this->order);
        $this->db->limit(1);
        $query = $this->db->get($this->table, $this->id);      //cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
         //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
        }
        else {
         //jika kode belum ada
         $kode = 1;
        }
        $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 2 menunjukkan jumlah digit angka 0
        $kodejadi = "JD0".$kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
  }

}

/* End of file Model_jadwal.php */
