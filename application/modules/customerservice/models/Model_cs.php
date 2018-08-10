<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cs extends CI_Model {
    public $id = 'id';
  var $table = 'v_activecall';
  var $table2 = 'wp_list_effectif';
  var $column_order = array('v_activecall.tanggal','v_activecall.id_pelanggan','v_activecall.nama_pelanggan','v_activecall.barang','v_activecall.qty','v_activecall.satuan','v_activecall.tgl_kirim','v_activecall.status', 'v_activecall.sumber_data', 'v_activecall.keterangan', null); //set column field database for datatable orderable
  var $column_search = array('v_activecall.tanggal','v_activecall.id_pelanggan','v_activecall.nama_pelanggan','v_activecall.status','v_activecall.tgl_kirim'); //set column field database for datatable searchable
  var $order = array('v_activecall.tanggal' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  private function _get_datatables_query()
 {
     //filter table_call
     if($this->input->post('status')!=="")
     {
        $this->db->like('v_activecall.status', $this->input->post('status'));
     }
     if($this->input->post('tanggal')!=="semua")
     {
         $this->db->like('month(v_activecall.tanggal)', $this->input->post('tanggal'));
     }
     if($this->input->post('tahun')!=="semua")
     {
         $this->db->like('year(v_activecall.tanggal)', $this->input->post('tahun'));
     }
     if($this->input->post('sumber_data')!=="semua")
     {
         $this->db->like('v_activecall.sumber_data', $this->input->post('sumber_data'));
     }
     if($this->input->post('melalui')!=="semua")
     {
         $this->db->like('v_activecall.by_status', $this->input->post('melalui'));
     }
     $this->db->select('v_activecall.id, v_activecall.tanggal, v_activecall.id_pelanggan, v_activecall.nama_pelanggan, v_activecall.barang, v_activecall.qty, v_activecall.satuan, v_activecall.tgl_kirim, v_activecall.status, v_activecall.by_status, v_activecall.sumber_data, v_activecall.keterangan, v_activecall.username, b.nama as creator');
     
     $this->db->join('wp_karyawan as b', 'b.id_karyawan = v_activecall.username', 'left');
     $this->db->where('v_activecall.username',  $this->session->identity);
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

/* End of file Model_cs.php */
