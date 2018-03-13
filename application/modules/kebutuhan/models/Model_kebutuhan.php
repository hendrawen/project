<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kebutuhan extends CI_Model{

  var $table = 'vkebutuhan';
  var $table2 = 'kebutuhan';
  public $id = 'id';
  var $column_order = array('id_pelanggan','nama_pelanggan','no_telp','jenis','jumlah','tgl'); //set column field database for datatable orderable
  var $column_search = array('id_pelanggan','nama_pelanggan','jenis'); //set column field database for datatable searchable
  var $order = array('tgl' => 'asc'); // default order

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  private function _get_datatables_query()
  {

     //add custom filter here
     if($this->input->post('kota'))
     {
         $this->db->where('kota', $this->input->post('kota'));
     }
     if($this->input->post('status'))
     {
         $this->db->like('status', $this->input->post('status'));
     }
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

 public function get_by_id($id)
 {
     $this->db->from($this->table2);
     $this->db->where('id',$id);
     $query = $this->db->get();

     return $query->row();
 }

 public function save($data)
 {
     $this->db->insert($this->table2, $data);
     return $this->db->insert_id();
 }

 function update($id, $data)
 {
     $this->db->where($this->id, $id);
     return $this->db->update($this->table2, $data);

 }

 public function show_all_data() {
        $this->db->select('*');
        $this->db->from('wp_vkebutuhan');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
 }

 public function show_data_by_date($data) {
        $condition = "MONTH(tgl) BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('id_pelanggan, nama_pelanggan, jenis , sum(jumlah) as total, tgl');
        $this->db->from('wp_vkebutuhan');
        $this->db->where('year(tgl)', $data['date3']);
        $this->db->where($condition);
        $this->db->group_by('id_pelanggan, nama_pelanggan, jenis, tgl');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
 }

 public function show_progres($data) {
        $condition = "MONTH(b.tgl) BETWEEN " . "'" . $data['date1'] . "'" . " AND " . "'" . $data['date2'] . "'";
        $this->db->select('a.jenis, SUM(b.jumlah) AS total');
        $this->db->from('wp_jkebutuhan AS a');
        $this->db->join('wp_kebutuhan AS b', 'a.id = b.wp_jkebutuhan_id');
        $this->db->where('year(b.tgl)', $data['date3']);
        $this->db->where($condition);
        $this->db->group_by('a.id, b.wp_jkebutuhan_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
 }

 public function show_kebutuhan() {
        $this->db->select('a.jenis, SUM(b.jumlah) AS total');
        $this->db->from('wp_jkebutuhan AS a');
        $this->db->join('wp_kebutuhan AS b', 'a.id = b.wp_jkebutuhan_id');
        $this->db->group_by('a.id, b.wp_jkebutuhan_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
 }

 public function delete_by_id($id)
 {
     $this->db->where('id', $id);
     $this->db->delete($this->table2);
 }

 public function get_list_kota()
 {
     $this->db->select('jenis');
     $this->db->from($this->table);
     $this->db->order_by('jenis','asc');
     $query = $this->db->get();
     $result = $query->result();

     $jenis = array();
     foreach ($result as $row)
     {
         $jenis[] = $row->jenis;
     }
     return $jenis;
 }

 public function get_list_status()
 {
     $this->db->select('status');
     $this->db->from($this->table);
     $this->db->order_by('status','asc');
     $query = $this->db->get();
     $result = $query->result();

     $status = array();
     foreach ($result as $row)
     {
         $status[] = $row->status;
     }
     return $status;
 }

 public function get_list_kelurahan()
 {
     $this->db->select('kelurahan');
     $this->db->from($this->table);
     $this->db->order_by('kelurahan','asc');
     $query = $this->db->get();
     $result = $query->result();

     $kelurahan = array();
     foreach ($result as $row)
     {
         $kelurahan[] = $row->kelurahan;
     }
     return $kelurahan;
 }

 public function get_list_kecamatan()
 {
     $this->db->select('kecamatan');
     $this->db->from($this->table);
     $this->db->order_by('kecamatan','asc');
     $query = $this->db->get();
     $result = $query->result();

     $kecamatan = array();
     foreach ($result as $row)
     {
         $kecamatan[] = $row->kecamatan;
     }
     return $kecamatan;
 }

 public function get_list_surveyor()
 {
     $this->db->select('nama');
     $this->db->from($this->table);
     $this->db->order_by('nama','asc');
     $query = $this->db->get();
     $result = $query->result();

     $surveyor = array();
     foreach ($result as $row)
     {
         $surveyor[] = $row->nama;
     }
     return $surveyor;
 }

}
