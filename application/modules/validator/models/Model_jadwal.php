<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jadwal extends CI_Model {

    function get_by_validator()
    {
        # code...
        $this->db->order_by('id_pelanggan');
        $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.alamat, wp_pelanggan.lat, wp_pelanggan.long, wp_pelanggan.no_telp, jadwal_kunjungan.tanggal_kunjungan, jadwal_kunjungan.keterangan');
        $this->db->from('jadwal_kunjungan');
        $this->db->join('wp_pelanggan', 'jadwal_kunjungan.id_pelanggan = wp_pelanggan.id', 'inner');
        $this->db->where('jadwal_kunjungan.id_karyawan', $this->session->identity);
        return $this->db->get()->result();
    }

}

/* End of file Model_jadwal.php */
