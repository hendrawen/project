<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_kategori($date, $id_kategori)
    {
        $this->db->select('count(id) as t');
        if ($id_kategori != 0) {
            $this->db->where('id_kategori', $id_kategori);
        }
        $this->db->where('DATE(created_at)', $date);
        $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
        $cek = $this->db->get('wp_pelanggan')->row();
        return $cek->t;
    }

    function get_count_kategori($date, $id_kategori)
    {
        $this->db->select('count(id) as t');
        $this->db->where('id_kategori', $id_kategori);
        $this->db->where('DATE(created_at)', $date);
        $this->db->where('wp_karyawan_id_karyawan', $this->session->identity);
        $cek = $this->db->get('wp_pelanggan')->row();
        return $cek->t;
    }

    function get_count_qty($date)
    {
        $this->db->select('count(qty) as qty');
        $this->db->where('tanggal', $date);
        $this->db->where('username', $this->session->identity);
        $cek = $this->db->get('wp_list_effectif')->row();
        // if ($cek) {
            return $cek->qty;
        // } else {
        //     return 0;
        // }
    }

    function get_tgl_kirim($date)
    {
        $this->db->select('tgl_kirim, keterangan');
        $this->db->where('tanggal', $date);
        $this->db->where('username', $this->session->identity);
        $cek = $this->db->get('wp_list_effectif')->row();
        $resArray = array();
        if ($cek) {
            $resArray = array(
                'tgl_kirim' => $cek->tgl_kirim,
                'keterangan' => $cek->keterangan,
            );
        } else {
            $resArray = array(
                'tgl_kirim' => null,
                'keterangan' => null,
            );
        }
        return $resArray;
    }

    function get_terkirim($date)
    {
        $this->db->select('min(wp_transaksi.tgl_transaksi)');
        $this->db->from('wp_transaksi');
        $this->db->where('wp_transaksi.tgl_transaksi', $date);
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'left');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'left');
        $this->db->group_by('wp_transaksi.tgl_transaksi');
        $cek = $this->db->count_all_results();
        if ($cek) {
            return $cek;
        } else {
            return null;
        }
    }

}

/* End of file Kpi_model.php */
