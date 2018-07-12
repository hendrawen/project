<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function get_all()
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

  function laporan_harian($day)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    if ($day != 'semua') {
      $this->db->where('wp_transaksi.tgl_transaksi', $day);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_bulanan($from, $to, $year)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    if ($from != 'semua'){
      $this->db->where('month(wp_transaksi.tgl_transaksi)', $from);
    }
    if ($to != 'semua'){
      $this->db->where('month(wp_transaksi.tgl_transaksi)', $to);
    }
    if ($from != 'semua' && $to != 'semua') {
      $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $from);
      $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $to);
    }
    if ($year != 'semua') {
      $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_tahunan($year)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    if ($year != 'semua') {
      $this->db->where('year(wp_transaksi.tgl_transaksi)', $year);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }


  /*
    PRODUK
  */
  function laporan_produk($year, $id_barang)
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
    $this->db->where('wp_barang.id', $id_barang);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_produk_bulanan($from, $to, $year, $id_barang)
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
    $this->db->where('wp_barang.id', $id_barang);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_produk_harian($day, $id_barang)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    $this->db->where('wp_transaksi.tgl_transaksi', $day);
    $this->db->where('wp_barang.id', $id_barang);
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  /*
    END PRODUK
  */

  function laporan_area($year, $area, $berdasarkan)
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
    if ($berdasarkan) {
      $this->db->where('wp_pelanggan.'.$berdasarkan, $area);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_area_bulanan($from, $to, $year, $area, $berdasarkan)
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
    if ($berdasarkan) {
      $this->db->where('wp_pelanggan.'.$berdasarkan, $area);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_area_harian($day, $area, $berdasarkan)
  {
    $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
    $this->db->from('wp_transaksi');
    if($day !== 'semua'){
    $this->db->where('wp_transaksi.tgl_transaksi', $day);
    }
    if ($berdasarkan) {
      $this->db->where('wp_pelanggan.'.$berdasarkan, $area);
    }
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
    $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
    $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
    $data = $this->db->get();
    return $data->result();
  }

  function laporan_marketing($year, $nama)
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

  function laporan_pelanggan_utang($id_pelanggan, $from, $to, $year)
  {
    $query ="SELECT DISTINCT wp_pelanggan.id_pelanggan, nama_pelanggan, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as piutang
      FROM
      wp_detail_transaksi
      INNER JOIN wp_pelanggan
      INNER JOIN wp_transaksi
      ON
      wp_pelanggan.id = wp_transaksi.wp_pelanggan_id AND
      wp_transaksi.id_transaksi = wp_detail_transaksi.id_transaksi AND
      wp_pelanggan.id_pelanggan = '$id_pelanggan'
      AND (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) >0
      and MONTH(`wp_transaksi`.`tgl_transaksi`) between '$from' and '$to'
      and YEAR(`wp_transaksi`.`tgl_transaksi`) = '$year'
      ";
    $data = $this->db->query($query)->row();
    $hasil = "";
    if ($data) {
      $hasil = $data->piutang;
    } else {
      $hasil = "0";
    }
    return $hasil;
  }

  function laporan_pelanggan($from, $to, $year)
  {
    $query = "SELECT * FROM `brajamarketindo`.`wp_pelanggan`
          inner join wp_karyawan on `wp_karyawan`.`id_karyawan` = `wp_pelanggan`.`wp_karyawan_id_karyawan`
          where exists
          (select * from wp_transaksi
          where `wp_transaksi`.`wp_pelanggan_id` = `wp_pelanggan`.`id`
          and (MONTH(`wp_transaksi`.`tgl_transaksi`) between '$from' and '$to')
          and (YEAR(`wp_transaksi`.`tgl_transaksi`) = '$year'))
          ";
    return $this->db->query($query)->result();
  }

  function laporan_pelanggan_trx($id_pelanggan, $month, $year)
  {
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $data = $this->db->get('wp_transaksi')->num_rows();
    if ($data == 0) {
      return '-';
    } else {
      return $data;
    }
  }

  function laporan_pelanggan_qty($id_pelanggan, $month, $year)
  {
    $this->db->select('sum(wp_transaksi.qty) as `qty`');
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $year);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $hasil = $this->db->get('wp_transaksi')->row();

    if ($hasil->qty != 0) {
      return $hasil->qty;
    } else {
      return '-';
    }
  }

  // get all
  function laporan_pelanggan_all()
  {
    $query = "SELECT * FROM `brajamarketindo`.`wp_pelanggan`
          inner join wp_karyawan on `wp_karyawan`.`id_karyawan` = `wp_pelanggan`.`wp_karyawan_id_karyawan`
          where exists
          (select * from wp_transaksi
          where `wp_transaksi`.`wp_pelanggan_id` = `wp_pelanggan`.`id`)";
    return $this->db->query($query)->result();
  }

  function laporan_pelanggan_utang_all($id_pelanggan)
  {
    $query ="SELECT DISTINCT wp_pelanggan.id_pelanggan, nama_pelanggan, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as piutang
      FROM
      wp_detail_transaksi
      INNER JOIN wp_pelanggan
      INNER JOIN wp_transaksi
      ON
      wp_pelanggan.id = wp_transaksi.wp_pelanggan_id AND
      wp_transaksi.id_transaksi = wp_detail_transaksi.id_transaksi AND
      wp_pelanggan.id_pelanggan = '$id_pelanggan'
      AND (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) >0
      ";
    $data = $this->db->query($query)->row();
    $hasil = "";
    if ($data) {
      $hasil = $data->piutang;
    } else {
      $hasil = "0";
    }
    return $hasil;
  }

  function laporan_pelanggan_trx_all($id_pelanggan, $month)
  {
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $data = $this->db->get('wp_transaksi')->num_rows();
    if ($data == 0) {
      return '-';
    } else {
      return $data;
    }
  }

  function laporan_pelanggan_qty_all($id_pelanggan, $month)
  {
    $this->db->select('sum(wp_transaksi.qty) as `qty`');
    $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
    $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $hasil = $this->db->get('wp_transaksi')->row();

    if ($hasil->qty != 0) {
      return $hasil->qty;
    } else {
      return '-';
    }
  }

}
