<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aset_model extends CI_Model
{

    public $table = 'wp_asis_debt';
    public $id = 'wp_asis_debt.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function get_gudang()
    {
        $this->db->select('id, nama_gudang');
        return $this->db->get('wp_gudang');
    }

    // get all
    function get_all()
    {
        $this->db->select('wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_transaksi.qty) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS jumlah, wp_penarikan.tgl_penarikan, wp_asis_debt.bayar_krat, wp_penarikan.tgl_penarikan, wp_asis_debt.bayar_uang');
        $this->db->from('wp_asis_debt');
        $this->db->join('wp_penarikan', 'wp_asis_debt.id = wp_penarikan.wp_asis_debt_id', 'left');
        $this->db->join('wp_transaksi', 'wp_asis_debt.id_transaksi = wp_transaksi.id', 'left');
        $this->db->join('wp_pelanggan', 'wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id', 'left');
        $this->db->join('wp_barang', 'wp_asis_debt.wp_barang_id = wp_barang.id', 'left');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan', 'left');
        $this->db->group_by('wp_asis_debt.wp_pelanggan_id');
        return $this->db->get()->result();
     
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->select('wp_asis_debt.*, wp_pelanggan.id as `id_pel`, wp_pelanggan.nama_pelanggan');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_asis_debt.wp_pelanggan_id', 'inner');
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

    // get data Pelanggan
    function get_pelanggan()
    {
      return $this->db->get('wp_pelanggan')->result();
    }

    function get_track($cari){
        $this->db->where('id_pelanggan', $cari);
        $hsl = $this->db->get('v_detail');
        if($hsl->num_rows() == 0){
            echo '<tr><td colspan="6"><center><div class="alert alert-danger" role="alert">Pelanggan Dengan No. ID : '.$cari.' Tidak Ada ASET</div></center></td></tr>';
        } else {
            return $hsl->result();
        }
    }
    
    function sum_get_track($cari){
        $this->db->select('sum(sisa) as sisa');
        $this->db->where('id_pelanggan', $cari);
        $hsl = $this->db->get('v_detail');
        return $hsl->result();
    }
    
    function get_min_track($cari){
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->select('id_transaksi, sisa, id_pelanggan');
        $this->db->where('id_pelanggan', $cari);
        $hsl = $this->db->get('v_detail');
        return $hsl->result();
    }

    function get_penarikan($id_pelanggan)
    {
        $this->db->select('wp_asis_debt.id, wp_asis_debt.turun_krat, wp_asis_debt.piutang, 
            wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_asis_debt.tanggal as tgl_penarikan, wp_asis_debt.bayar_krat, wp_asis_debt.bayar_uang');
        $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
        $this->db->where("wp_asis_debt.piutang <> wp_asis_debt.turun_krat");

        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_asis_debt.wp_pelanggan_id', 'inner');
        $this->db->join('wp_penarikan', 'wp_penarikan.wp_asis_debt_id = wp_asis_debt.id', 'left');
        $this->db->group_by('wp_asis_debt.id');
        $this->db->order_by('wp_asis_debt.id', 'asc');
        
        $record = $this->db->get('wp_asis_debt');
        
        return $record->result();
    }

    function get_id_pelanggan($id_pelanggan)
    {
        $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
        return $this->db->get('wp_pelanggan',1)->row();
        
    }

    function insert_penarikan($data, $data2)
    {
        $respon = 'F';
        $this->db->trans_begin();
        $this->db->insert_batch('wp_penarikan', $data);
        $this->update_debt($data2);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $respon = 'F';
        } else {
            $this->db->trans_commit();
            $respon = 'T';
        }
        return $respon;
    }

    function update_debt($data)
    {
        $this->db->update_batch('wp_asis_debt', $data, 'id');
    }

    function get_harga_krat()
    {
        $this->db->where('id', '1');
        $record = $this->db->get('wp_krat_kosong')->row();
        return $record->harga;
    }

}

/* End of file Aset_model.php */
/* Location: ./application/models/Aset_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 04:37:16 */
/* http://harviacode.com */
