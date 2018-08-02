<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stockofname_model extends CI_Model
{

    public $id = 'id';
    var $table = 'wp_debt_muat';
    var $column_order = array('tanggal','nama_gudang','nama_barang','username', null); //set column field database for datatable orderable
    var $column_search = array('tanggal','nama_gudang','nama_barang','username'); //set column field database for datatable searchable
    var $order = array('tanggal' => 'DESC'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        //filter table_call
        $this->db->select('wp_debt_muat.id, wp_debt_muat.wp_barang_id, wp_debt_muat.wp_gudang_id, wp_debt_muat.tanggal, wp_gudang.id as gudang, wp_gudang.nama_gudang, wp_barang.id as barang, wp_barang.nama_barang, wp_stok.id, wp_stok.wp_gudang_id, wp_stok.wp_barang_id, wp_stok.stok, wp_debt_muat.rusak, wp_debt_muat.satuan_rusak, wp_aset.aset_krat, wp_aset.aset_btl');
        $this->db->join('wp_barang', 'wp_barang.id = wp_debt_muat.wp_barang_id', 'inner');
        $this->db->join('wp_gudang', 'wp_gudang.id = wp_debt_muat.wp_gudang_id', 'inner');
        $this->db->join('wp_stok', 'wp_stok.wp_gudang_id = wp_gudang.id', 'inner');
        $this->db->join('wp_aset', 'wp_aset.gudang = wp_gudang.id', 'inner');
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where('wp_debt_muat.id', $id);
        $this->db->select('wp_debt_muat.*, wp_barang.id_barang, wp_barang.nama_barang, wp_gudang.nama_gudang');
        $this->db->join('wp_barang', 'wp_barang.id = wp_debt_muat.wp_barang_id', 'inner');
        $this->db->join('wp_gudang', 'wp_gudang.id = wp_debt_muat.wp_gudang_id', 'inner');
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

    function get_barang()
    {
      return $this->db->get('wp_barang')->result();
    }

    function get_gudang()
    { 
      return $this->db->get('wp_gudang')->result();
    }

    function get_karyawan()
    {
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_karyawan.wp_jabatan_id = wp_jabatan.id');
        $this->db->where('wp_jabatan.nama_jabatan', 'Debt & Delivery');
        return $this->db->get();   
    }


    function get_satuanbarang()
    {
        //$this->db->distinct();
        $this->db->select('satuan');
        $this->db->order_by('nama_barang', 'desc');
        return $this->db->get('wp_barang')->result();
    }

    function get_namabarang()
    {
        $this->db->distinct();
        $this->db->select('nama_barang, satuan');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result();
    }
    
}

/* End of file Muat_model.php */
/* Location: ./application/models/Muat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 08:06:03 */
/* http://harviacode.com */
