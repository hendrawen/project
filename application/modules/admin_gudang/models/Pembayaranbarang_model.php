<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaranbarang_model extends CI_Model{

  public $table = 'wp_transaksistok';
  public $id = 'id';
  public $order = 'DESC';

  //public $id = 'id_transaksi';
  //var $table = 'vdetail_pembayaran';
  //var $column_order = array('id_transaksi', 'tgl_kirim', 'jatuh_tempo', 'id_pelanggan','nama_pelanggan', 'nama_barang', 'qty', 'satuan', 'kelurahan', 'kecamatan', 'no_telp', 'nama', 'username', 'subtotal', 'tgl_bayar', 'bayar'); //set column field database for datatable orderable
  //var $column_search = array('id_pelanggan','nama_pelanggan','id_transaksi', 'jatuh_tempo'); //set column field database for datatable searchable
  //var $order = array('id_transaksi' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  private function _get_datatables_query()
  {

     //add custom filter here
     $this->db->from($this->table);
     $this->db->where('wp_transaksistok.username', $this->session->identity);
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

  function cari_suplier($idsuplier){
		$this->db->like('id_suplier', $idsuplier , 'both');
		$this->db->order_by('id_suplier', 'ASC');
    $this->db->where('utang <=', 'bayar');
		$this->db->limit(10);
		return $this->db->get('wp_detail_transaksistok')->result();
	}

  function update($id, $data)
  {
      $this->db->where($this->id2, $id);
      return $this->db->update($this->table2, $data);

  }

  function get_data(){
        $this->db->select('wp_transaksistok.id, id_transaksi, tgl_transaksi, wp_barang.id_barang, wp_barang.nama_barang, harga, qty, wp_transaksistok.satuan, subtotal, wp_transaksistok.updated_at, wp_transaksistok.username, wp_suplier.id_suplier, wp_suplier.nama_suplier');
        $this->db->from($this->table);
        $this->db->join('wp_suplier', 'wp_suplier.id = wp_transaksistok.wp_suplier_id');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksistok.wp_barang_id');
        $this->db->where('wp_transaksistok.username', $this->session->identity);
        $this->db->order_by('id_transaksi', $this->order);
        return $this->db->get()->result();
    }

    function cek_bayar($idsuplier){
		$this->db->like('id_suplier', $idsuplier , 'both');
		$this->db->order_by('id_suplier', 'ASC');
		$this->db->limit(10);
		return $this->db->get('wp_suplier')->result();
    }
    
    function get_track($cari){
        $this->db->where('id_suplier', $cari);
        $hsl = $this->db->get('v_detail_bayar');
        if($hsl->num_rows() == 0){
            echo '<tr><td colspan="9"><center><div class="alert alert-danger" role="alert">Suplier Dengan No. ID : '.$cari.' Tidak Memiliki Utang</div></center></td></tr>';
        } else {
          return $hsl->result();
        }
      }
    
      function sum_get_track($cari){
        $this->db->select('sum(sisa) as sisa');
        $this->db->where('id_suplier', $cari);
        $hsl = $this->db->get('v_detail_bayar');
        return $hsl->result();
      }
    
      function get_min_track($cari){
        $this->db->order_by('id_transaksi', 'ASC');
        $this->db->select('id_transaksi, sisa, id_suplier');
        $this->db->where('id_suplier', $cari);
        $hsl = $this->db->get('v_detail_bayar');
        return $hsl->result();
      }
//   function get_track($cari){
//     $this->db->select('wp_transaksistok.id, id_transaksi, tgl_transaksi, wp_barang.id_barang, wp_barang.nama_barang, harga, qty, wp_transaksistok.satuan, subtotal, wp_suplier.id_suplier, wp_suplier.nama_suplier');
//     $this->db->from($this->table);
//     $this->db->join('wp_suplier', 'wp_suplier.id = wp_transaksistok.wp_suplier_id');
//     $this->db->join('wp_barang', 'wp_barang.id = wp_transaksistok.wp_barang_id');
//     $this->db->where('wp_suplier.id_suplier', $cari);
//     $hsl = $this->db->get();
//     if($hsl->num_rows() == 0){
//         echo '<tr><td colspan="9"><center><div class="alert alert-danger" role="alert">Suplier Dengan No. ID : '.$cari.' Tidak Memiliki Transaki</div></center></td></tr>';
//     } else {
//       return $hsl->result();
//     }
//   }

//   function sum_get_track($cari){
//     $this->db->select('wp_transaksistok.id, id_transaksi, tgl_transaksi, wp_barang.id_barang, wp_barang.nama_barang, harga, qty, wp_transaksistok.satuan, sum(subtotal) as total, wp_suplier.id_suplier, wp_suplier.nama_suplier');
//     $this->db->from($this->table);
//     $this->db->join('wp_suplier', 'wp_suplier.id = wp_transaksistok.wp_suplier_id');
//     $this->db->join('wp_barang', 'wp_barang.id = wp_transaksistok.wp_barang_id');
//     $this->db->where('wp_suplier.id_suplier', $cari);
//     $hsl = $this->db->get();
//     return $hsl->result();
//   }

//   function get_min_track($cari){
//     $this->db->order_by('id_transaksi', 'ASC');
//     $this->db->select('wp_transaksistok.id, id_transaksi, tgl_transaksi, harga, qty, wp_transaksistok.satuan, sum(subtotal) as total, wp_barang.nama_barang, wp_suplier.id_suplier, wp_suplier.nama_suplier');
//     $this->db->from($this->table);
//     $this->db->join('wp_suplier', 'wp_suplier.id = wp_transaksistok.wp_suplier_id');
//     $this->db->join('wp_barang', 'wp_barang.id = wp_transaksistok.wp_barang_id');
//     $this->db->where('wp_suplier.id_suplier', $cari);
//     $hsl = $this->db->get();
//     return $hsl->result();
//   }

  function insert_pembayaran($data)
  {
    // code...
    $this->db->insert('wp_pembayaranbarang', $data);
  }

}
