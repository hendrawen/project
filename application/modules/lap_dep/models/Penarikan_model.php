<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan_model extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_debt()
    {
        $this->load->database();
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan','wp_jabatan.id=wp_karyawan.wp_jabatan_id');
        $this->db->where('wp_jabatan.nama_jabatan','Debt & Delivery');
        return $this->db->get()->result();
    }


    function penarikan_harian($username, $day)
    {
        $query = $this->db->query("SELECT wp_penarikan.username, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat,  wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status
        FROM
        wp_asis_debt
        LEFT JOIN
        wp_transaksi ON
        wp_asis_debt.id_transaksi = wp_transaksi.id
        LEFT JOIN
        wp_pelanggan ON
        wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id
        LEFT JOIN
        wp_barang ON
        wp_asis_debt.wp_barang_id = wp_barang.id
        LEFT JOIN
        wp_karyawan ON
        wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan
        LEFT JOIN
        wp_penarikan ON
        wp_asis_debt.id = wp_penarikan.wp_asis_debt_id
        JOIN
        wp_krat_kosong
        where
        wp_penarikan.username = '$username' and
        date(wp_asis_debt.tanggal) = '$day'
        GROUP BY wp_asis_debt.wp_pelanggan_id
        ");
        return $query->result();
        // $data = $this->db->get();
        // return $data->result();
    }

    function penarikan_bulanan($username, $from, $to, $year)
    {
        $query = $this->db->query("SELECT wp_penarikan.username, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat,  wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status
        FROM
        wp_asis_debt
        LEFT JOIN
        wp_transaksi ON
        wp_asis_debt.id_transaksi = wp_transaksi.id
        LEFT JOIN
        wp_pelanggan ON
        wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id
        LEFT JOIN
        wp_barang ON
        wp_asis_debt.wp_barang_id = wp_barang.id
        LEFT JOIN
        wp_karyawan ON
        wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan
        LEFT JOIN
        wp_penarikan ON
        wp_asis_debt.id = wp_penarikan.wp_asis_debt_id
        JOIN
        wp_krat_kosong
        where 
        wp_penarikan.username = '$username' and
        month(wp_asis_debt.tanggal) >= '$from' and
        month(wp_asis_debt.tanggal) <= '$to' and
        year(wp_asis_debt.tanggal) = '$year'
        GROUP BY wp_asis_debt.wp_pelanggan_id
        ");
        return $query->result();
        // $data = $this->db->get();
        // return $data->result();
    }
    function penarikan_tahunan($username, $year)
    {
        $query = $this->db->query("SELECT wp_penarikan.username, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat,  wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status
        FROM
        wp_asis_debt
        LEFT JOIN
        wp_transaksi ON
        wp_asis_debt.id_transaksi = wp_transaksi.id
        LEFT JOIN
        wp_pelanggan ON
        wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id
        LEFT JOIN
        wp_barang ON
        wp_asis_debt.wp_barang_id = wp_barang.id
        LEFT JOIN
        wp_karyawan ON
        wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan
        LEFT JOIN
        wp_penarikan ON
        wp_asis_debt.id = wp_penarikan.wp_asis_debt_id
        JOIN
        wp_krat_kosong
        where
        wp_penarikan.username = '$username' and
        year(wp_asis_debt.tanggal) = '$year'
        GROUP BY wp_asis_debt.wp_pelanggan_id
        ");
        return $query->result();
    }

    function penarikan_bulanan_all()
    {
        $query = $this->db->query("SELECT wp_penarikan.username, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat,  wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status
        FROM
        wp_asis_debt
        LEFT JOIN
        wp_transaksi ON
        wp_asis_debt.id_transaksi = wp_transaksi.id
        LEFT JOIN
        wp_pelanggan ON
        wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id
        LEFT JOIN
        wp_barang ON
        wp_asis_debt.wp_barang_id = wp_barang.id
        LEFT JOIN
        wp_karyawan ON
        wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan
        LEFT JOIN
        wp_penarikan ON
        wp_asis_debt.id = wp_penarikan.wp_asis_debt_id
        JOIN
        wp_krat_kosong
        GROUP BY wp_asis_debt.wp_pelanggan_id
        ");
        return $query->result();
        // $data = $this->db->get();
        // return $data->result();
    }
    

}

/* End of file Penarikan_model.php */
