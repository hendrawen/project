<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model{

  public $table2 = 'wp_detail_transaksi';
  public $id2 = 'id';
  public $order2 = 'DESC';

  public $id = 'id_transaksi';
  var $table = 'vdetail_pembayaran';
  var $column_order = array('id_transaksi', 'tgl_kirim', 'jatuh_tempo', 'id_pelanggan','nama_pelanggan', 'nama_barang', 'qty', 'satuan', 'kelurahan', 'kecamatan', 'no_telp', 'nama', 'b.nama', 'jumlah_bayar', 'tgl_bayar', 'sisa_hutang'); //set column field database for datatable orderable
  var $column_search = array('id_pelanggan','nama_pelanggan','id_transaksi', 'jatuh_tempo'); //set column field database for datatable searchable
  var $order = array('id_transaksi' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  function get_pembayaran($id)
    {
        $this->db->select('v_detail.id_pelanggan, v_detail.nama_pelanggan, v_detail.utang, v_detail.bayar, v_detail.id_transaksi, v_detail.tgl_transaksi, v_detail.jatuh_tempo, sum(v_detail.sisa) as sisa, v_detail.selisih, v_detail.tgl_bayar');
        $this->db->where('id_transaksi', $id);
        $data = $this->db->get('v_detail');
        return $data->result();
    }

    function get_track($id){
        $this->db->select('*');
        $this->db->where('id_transaksi', $id);
        $hsl = $this->db->get('v_detail');
        if($hsl->num_rows() == 0){
            // echo '<tr><td colspan="9"><center><div class="alert alert-danger" role="alert">Pelanggan Dengan No. ID : '.$id.' Tidak Memiliki Utang</div></center></td></tr>';
            return FALSE;
        } else {
          return $hsl->result();
        }
      }

      function update_pembayaran($id, $data)
      {
          $this->db->where('id_transaksi', $id);
          return $this->db->update('wp_pembayaran', $data);
      }

  private function _get_datatables_query()
  {
     $this->db->select('vdetail_pembayaran.id_transaksi, vdetail_pembayaran.tgl_transaksi, vdetail_pembayaran.jatuh_tempo, vdetail_pembayaran.id_pelanggan, vdetail_pembayaran.nama_pelanggan, vdetail_pembayaran.nama_barang, vdetail_pembayaran.qty, vdetail_pembayaran.satuan, vdetail_pembayaran.kelurahan, vdetail_pembayaran.kecamatan, vdetail_pembayaran.no_telp, vdetail_pembayaran.nama, b.nama as nama_debt, vdetail_pembayaran.subtotal, vdetail_pembayaran.tgl_bayar, sum(vdetail_pembayaran.bayar) as bayar, sum(vdetail_pembayaran.jumlah_bayar) as jumlah_bayar, vdetail_pembayaran.sisa_hutang, `vdetail_pembayaran.nama_status`');
     //$this->db->join('v_detail as c', 'c.id_transaksi = vdetail_pembayaran.id_transaksi', 'inner');
     $this->db->join('wp_karyawan as b', 'b.id_karyawan = vdetail_pembayaran.username', 'left');
     $this->db->group_by('id_transaksi, nama_barang');
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

  function get_faktur($faktur)
  {
      $this->db->select('id_transaksi as faktur, nama_pelanggan');
      $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
      $this->db->where('id_transaksi', $faktur);
      return $this->db->get('wp_transaksi')->row();
  }

  function hapus_pembayaran($faktur)
  {
    $this->db->where('id_transaksi', $faktur);
    $this->db->delete('wp_transaksi');
    
    $this->db->where('id_transaksi', $faktur);
    $this->db->delete('wp_detail_transaksi');
    
    $this->db->where('id_transaksi', $faktur);
    $this->db->delete('wp_pembayaran');

  }

}
