<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produk extends CI_Model 
{    
    function get_data(){
        $this->db->select("wp_produksales.id, wp_produksales.id_produksales, wp_produksales.harga_jual, wp_kategori.id_kategori, wp_kategori.nama_kategori, wp_barang.nama_barang");
        $this->db->from('wp_produksales');
        $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_produksales.wp_kategori_id_kategori');
        $this->db->join('wp_barang', 'wp_barang.id = wp_produksales.wp_barang_id');
        $this->db->order_by('wp_kategori_id_kategori', 'ASC');
        return $query = $this->db->get()->result();
    }

    function get_coba(){
        $this->db->select("wp_barang.wp_suplier_id,wp_suplier.nama_suplier");
        $this->db->from($this->table);
        $this->db->join('wp_suplier', 'wp_suplier.id = wp_barang.wp_suplier_id');
        $this->db->order_by('wp_suplier_id', $this->order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return $query->result();
        } else {
          return FALSE;
        }
    }

    function buat_kode(){
        $this->db->select('RIGHT(wp_produksales.id_produksales, 2) as kode', FALSE);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('wp_produksales', 'id');      //cek dulu apakah ada sudah ada kode di tabel.
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
        $kodejadi = "PR0".$kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
  }

  function get_by_id($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("wp_produksales")->row();
    }

  function insert($data)
    {
        $this->db->insert("wp_produksales", $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("wp_produksales", $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("wp_produksales");
    }
}

/* End of file ModelName.php */
