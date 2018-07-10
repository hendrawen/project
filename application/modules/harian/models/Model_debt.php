<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_debt extends CI_Model {

    
    function __construct()
    {
        parent::__construct();  
    }

    function cari_pelanggan($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
        $this->db->where('status', 'Pelanggan');
		$this->db->limit(25);
		return $this->db->get('wp_pelanggan')->result();
    }
    function cari_driver($nama_driver){
        $this->db->select('*');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_jabatan.id = wp_karyawan.wp_jabatan_id');        
		$this->db->like('wp_karyawan.nama', $nama_driver , 'both');
		$this->db->order_by('wp_karyawan.nama', 'ASC');
        $this->db->where('wp_jabatan.nama_jabatan', 'Driver');
		$this->db->limit(25);
		return $this->db->get()->result();
    }

    function cari_debt($nama_debt){
        $this->db->select('wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_jabatan.id = wp_karyawan.wp_jabatan_id');        
		$this->db->like('wp_karyawan.nama', $nama_debt , 'both');
        $this->db->where('wp_jabatan.nama_jabatan', 'Debt');
		$this->db->order_by('wp_karyawan.nama', 'ASC');
		$this->db->limit(25);
		return $this->db->get()->result();
    }
    
    function get_track($cari){
        $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_transaksi.id_transaksi, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_karyawan.nama, wp_transaksi.subtotal, wp_detail_transaksi.bayar, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as jumlah');
        $this->db->from('wp_detail_transaksi');
        $this->db->join('wp_transaksi', 'wp_detail_transaksi.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_transaksi.username = wp_karyawan.id_karyawan');
        $this->db->where('wp_pelanggan.id_pelanggan', $cari);
        $this->db->where('(wp_detail_transaksi.utang - wp_detail_transaksi.bayar) >', '0');
        return $this->db->get();
    }

    function get_barang()
    {
        # code...
        $this->db->select('nama_barang');
        return $this->db->get('wp_barang');
    }
    
    

}

/* End of file Model_debt.php */
