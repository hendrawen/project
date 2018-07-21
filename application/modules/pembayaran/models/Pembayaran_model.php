<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model{

  public $table2 = 'wp_detail_transaksi';
  public $id2 = 'id';
  public $order2 = 'DESC';

  public $id = 'id_transaksi';
  var $table = 'vdetail_pembayaran';
  var $column_order = array('id_transaksi', 'tgl_kirim', 'jatuh_tempo', 'id_pelanggan','nama_pelanggan', 'nama_barang', 'qty', 'satuan', 'kelurahan', 'kecamatan', 'no_telp', 'nama', 'username', 'subtotal', 'tgl_bayar', 'bayar'); //set column field database for datatable orderable
  var $column_search = array('id_pelanggan','nama_pelanggan','id_transaksi', 'jatuh_tempo'); //set column field database for datatable searchable
  var $order = array('id_transaksi' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  private function _get_datatables_query()
  {

     //add custom filter here
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

  function cari_pelanggan($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
        $this->db->where('utang <=', 'bayar');
		$this->db->limit(10);
		return $this->db->get('v_detail_utang')->result();
	}

  function update($id, $data)
  {
      $this->db->where($this->id2, $id);
      return $this->db->update($this->table2, $data);

  }

}
