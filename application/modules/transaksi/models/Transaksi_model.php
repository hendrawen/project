<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'wp_transaksi';
    public $id = 'wp_transaksi.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
      $this->db->order_by($this->id, $this->order);
        $this->db->select('wp_transaksi.*, wp_pelanggan.id_pelanggan');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
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
        $this->db->like('wp_transaksi.id', $q);
      	$this->db->or_like('id_transaksi', $q);
      	$this->db->or_like('wp_barang_id', $q);
      	$this->db->or_like('harga', $q);
      	$this->db->or_like('qty', $q);
      	//$this->db->or_like('satuan', $q);
      	$this->db->or_like('tgl_transaksi', $q);
      	$this->db->or_like('wp_transaksi.updated_at', $q);
      	$this->db->or_like('wp_pelanggan_id', $q);
      	$this->db->or_like('wp_transaksi.username', $q);
      	$this->db->or_like('wp_status_id', $q);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('wp_transaksi.*, wp_pelanggan.id_pelanggan');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');

        $this->db->like('wp_transaksi.id', $q);
      	$this->db->or_like('id_transaksi', $q);
      	$this->db->or_like('wp_barang_id', $q);
      	$this->db->or_like('harga', $q);
      	$this->db->or_like('qty', $q);
      	//$this->db->or_like('satuan', $q);
      	$this->db->or_like('tgl_transaksi', $q);
      	$this->db->or_like('wp_transaksi.updated_at', $q);
      	$this->db->or_like('wp_pelanggan_id', $q);
      	$this->db->or_like('wp_transaksi.username', $q);
      	$this->db->or_like('wp_status_id', $q);
      	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        //$this->db->trans_begin();

        $this->db->insert($this->table, $data);

        // if ($this->db->trans_status() == FALSE) {
        //     $this->db->trans_rollback();
        // } else {
        //     $this->db->trans_commit();
        // }
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

    function get_data()
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`');
        $this->db->from($this->table);
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by($this->id, $this->order);
        //$this->db->where('username');
        $data = $this->db->get();
        return $data->result();
    }

    function buat_kode(){
          $this->db->select('RIGHT(wp_transaksi.id_transaksi, 2) as kode', FALSE);
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
          $kodejadi = "TR0".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;
    }

}

/* End of file Wp_transaksi_model.php */
/* Location: ./application/models/Wp_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-12 05:09:32 */
/* http://harviacode.com */
