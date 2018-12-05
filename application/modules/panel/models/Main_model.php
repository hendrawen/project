<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function GetPie(){
        $query = $this->db->query("SELECT wp_pelanggan.wp_karyawan_id_karyawan, wp_karyawan.nama, COUNT(wp_pelanggan.wp_karyawan_id_karyawan) AS prestasi
            FROM wp_karyawan
            LEFT JOIN wp_pelanggan
            ON
            wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan AND
            wp_pelanggan.status='Pelanggan'
            GROUP BY wp_pelanggan.wp_karyawan_id_karyawan, wp_karyawan.nama");
        return $query;
    }

    public function get_chart_penjualan($year, $month)
    {
        $this->db->select('sum(subtotal) as total');
        $this->db->where('year(tgl_transaksi)', $year);
        $this->db->where('month(tgl_transaksi)', $month);
        $hasil = $this->db->get('wp_transaksi')->row();
        if ($hasil) {
            return $hasil->total;
        } else {
            $hasil = 0;
            return $hasil;
        }   
    }

    public function get_top_produk($year)
    {
        
        $this->db->select('wp_barang.nama_barang, sum(wp_transaksi.qty) qtys');
        $this->db->group_by('wp_barang_id');
        $this->db->order_by('qtys', 'desc');
        $this->db->where('year(tgl_transaksi)', $year);
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
        return $this->db->get('wp_transaksi', 5, 0)->result();
    }

    public function get_chart_pembayaran($year, $month)
    {
        $this->db->select('sum(bayar) as total');
        $this->db->where('year(tgl_bayar)', $year);
        $this->db->where('month(tgl_bayar)', $month);
        $hasil = $this->db->get('wp_pembayaran')->row();
        if ($hasil) {
            return $hasil->total;
        } else {
            $hasil = 0;
            return $hasil;
        }   
    }

    public function get_top_area($year)
    {
        $this->db->select('sum(wp_transaksi.subtotal) as total, wp_pelanggan.kecamatan');
        $this->db->group_by('wp_pelanggan.kecamatan');
        $this->db->order_by('total', 'desc');
        $this->db->where('year(tgl_transaksi)', $year);
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
        return $this->db->get('wp_transaksi', 5, 0)->result();
    }

}
