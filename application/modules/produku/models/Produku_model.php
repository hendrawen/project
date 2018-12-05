<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produku_model extends CI_Model {

    public $id = 'id_produksales';
    var $table = 'wp_produksales';
    var $column_order = array('id_produksales', 'nama_barang', 'nama_kategori', 'qty'); 
    var $column_search = array('nama_barang', 'nama_kategori'); 
    var $order = array('id_produksales' => 'DESC');

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('distinct(wp_transaksi.wp_barang_id), sum(wp_transaksi.qty) as qty, wp_barang.nama_barang, wp_barang.harga_beli, wp_kategori.nama_kategori, wp_produksales.harga_jual');
        $this->db->join('wp_barang', 'wp_barang.id = wp_produksales.wp_barang_id');
        $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_produksales.wp_kategori_id_kategori');
        $this->db->join('wp_transaksi', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->group_by('wp_barang.nama_barang');
        $this->db->group_by('wp_kategori.nama_kategori');
        $this->db->order_by('wp_kategori_id_kategori', 'asc');
        $this->db->from($this->table);
        $i = 0;

     foreach ($this->column_search as $item) // loop column
     {
         if($_POST['search']['value']) // if datatable send POST for search
         {

             if($i===0) // first loop
             {
                 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                 $this->db->like($item, $_POST['search']['value']);
             }
             else
             {
                 $this->db->or_like($item, $_POST['search']['value']);
             }

             if(count($this->column_search) - 1 == $i) //last loop
                 $this->db->group_end(); //close bracket
         }
         $i++;
     }

     if(isset($_POST['order'])) // here order processing
     {
         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     }
     else if(isset($this->order))
     {
         $order = $this->order;
         $this->db->order_by(key($order), $order[key($order)]);
     }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }   

}

/* End of file Model_main.php */
