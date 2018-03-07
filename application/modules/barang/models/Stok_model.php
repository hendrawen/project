<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok_model extends CI_Model
{

    public $table = 'wp_stok';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
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
        $this->db->like('id', $q);
	$this->db->or_like('wp_barang_id', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('wp_barang_id', $q);
	$this->db->or_like('stok', $q);
	$this->db->or_like('updated_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

    function get_data(){
        $this->db->select("wp_stok.id, wp_stok.wp_barang_id, wp_stok.stok, wp_stok.updated_at, wp_barang.nama_barang, wp_barang.id_barang");
        $this->db->from($this->table);
        $this->db->join('wp_barang', 'wp_barang.id = wp_stok.wp_barang_id');
        $this->db->order_by('id', $this->order);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
          return FALSE;
        }
    }

}

/* End of file Wp_stok_model.php */
/* Location: ./application/models/Wp_stok_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-07 08:36:35 */
/* http://harviacode.com */
