<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Models_laporan extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function laporan_bulanan($from, $to, $year)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
        $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_pembayaran_all()
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_tahunan($year)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_pembayaran_harian($day)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('wp_transaksi.tgl_transaksi', $day);
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_pembayaran_harian_all()
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->from('wp_pembayaran');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function penarikan_bulanan($from, $to, $year)
    {
        $query = $this->db->query("SELECT wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_transaksi.qty) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS jumlah, wp_penarikan.tgl_penarikan, wp_asis_debt.bayar_krat, wp_penarikan.tgl_penarikan, wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status
        FROM
        wp_asis_debt
        LEFT JOIN
        wp_penarikan
        ON
        wp_asis_debt.id = wp_penarikan.wp_asis_debt_id
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
        JOIN
        wp_krat_kosong
        where month(wp_asis_debt.tanggal) >= '$from' and
        month(wp_asis_debt.tanggal) <= '$to' and
        year(wp_asis_debt.tanggal) = '$year'
        GROUP BY wp_asis_debt.wp_pelanggan_id
        ");
        return $query->result();
        // $data = $this->db->get();
        // return $data->result();
    }

    function laporan_tahunan_marketing($year, $nama)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->from('wp_transaksi');
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
        if ($nama !== 'semua') {
        $this->db->where('wp_karyawan.id_karyawan', $nama);
        }
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_bulanan_marketing($from, $to, $year, $nama)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->from('wp_transaksi');
        $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
        $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
        $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
        if ($nama !== 'semua') {
        $this->db->where('wp_karyawan.id_karyawan', $nama);
        }
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    function laporan_harian_marketing($day, $nama)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->from('wp_transaksi');
        $this->db->where('wp_transaksi.tgl_transaksi', $day);
        if ($nama !== 'semua') {
        $this->db->where('wp_karyawan.id_karyawan', $nama);
        }
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }


    function laporan_marketing_all()
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->from('wp_transaksi');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    

}

/* End of file Models_laporan.php */
