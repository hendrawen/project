<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Takeorder_model extends CI_Model {

  public $id = 'id';
  var $table = 'v_activecall';
  var $table2 = 'wp_list_effectif';
  var $column_order = array('tanggal','id_pelanggan','nama_pelanggan','barang','qty','satuan','tgl_kirim','status', 'sumber_data', 'keterangan', null); //set column field database for datatable orderable
  var $column_search = array('tanggal','id_pelanggan','nama_pelanggan','status','tgl_kirim'); //set column field database for datatable searchable
  var $order = array('tanggal' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  private function _get_datatables_query()
 {
      //filter table_call
     //filter table_call
     if($this->input->post('status')!=="")
     {
        $this->db->like('status', $this->input->post('status'));
     }
     if($this->input->post('tanggal')!=="semua")
     {
         $this->db->like('month(tanggal)', $this->input->post('tanggal'));
     }
     if($this->input->post('tahun')!=="semua")
     {
         $this->db->like('year(tanggal)', $this->input->post('tahun'));
     }
     if($this->input->post('sumber_data')!=="semua")
     {
         $this->db->like('sumber_data', $this->input->post('sumber_data'));
     }
     if($this->input->post('melalui')!=="semua")
     {
         $this->db->like('by_status', $this->input->post('melalui'));
     }
     $this->db->where('username',  $this->session->identity);
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

 public function delete_by_id($id)
 {
     $this->db->where('id', $id);
     $this->db->delete($this->table2);
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

 public function get_list_bulan()
 {
     $this->db->select('Month(tanggal) as bulan');
     $this->db->from($this->table);
     $query = $this->db->get();
     $result = $query->result();

     $bulan = array();
     foreach ($result as $row)
     {
         $bulan[] = getBulan('1');
         $bulan[] = getBulan('2');
         $bulan[] = getBulan('3');
         $bulan[] = getBulan('4');
         $bulan[] = getBulan('5');
         $bulan[] = getBulan('6');
         $bulan[] = getBulan('7');
         $bulan[] = getBulan('8');
         $bulan[] = getBulan('9');
         $bulan[] = getBulan('10');
         $bulan[] = getBulan('11');
         $bulan[] = getBulan('12');
     }
     return $bulan;
 }

 //BUAT MODEL MAX_KODE_MAHASISWA
public function get_kode_pelanggan() {
 $tahun = date("Y");
 $kode = 'PL';
 $query = $this->db->query("SELECT MAX(id_pelanggan) as max_id FROM wp_pelanggan");
 $row = $query->row_array();
 $max_id = $row['max_id'];
 $max_id1 =(int) substr($max_id,9,5);
 $kode_pelanggan = $max_id1 +1;
 $maxkode_pelanggan = $kode.'-'.$tahun.'-'.sprintf("%04s",$kode_pelanggan);
 return $maxkode_pelanggan;
}

}

/* End of file Takeorder_model.php */
