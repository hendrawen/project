<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan_model extends CI_Model{

  public $id = 'wp_transaksi.id_transaksi';
  var $table = 'wp_asis_debt';
  var $column_order = array('wp_transaksi.id_transaksi', 'wp_transaksi.tgl_transaksi', 
  'wp_pelanggan.id_pelanggan', 'wp_pelanggan.nama_pelanggan', 'wp_barang.nama_barang', 'SUM(wp_asis_debt.turun_krat) as qty', 'wp_barang.satuan', 'wp_pelanggan.kelurahan', 'wp_asis_debt.tanggal as tgl_penarikan', 'wp_pelanggan.kecamatan', 'wp_pelanggan.no_telp', 'wp_karyawan.nama', 'wp_transaksi.username', 'SUM(wp_asis_debt.turun_krat) AS total', 'SUM(wp_asis_debt.bayar_krat) as bayar_krat', 'b.nama as nama_debt', 'wp_asis_debt.bayar_uang'); //set column field database for datatable orderable
  var $column_search = array('wp_transaksi.id_transaksi', 'wp_transaksi.tgl_transaksi', 
  'wp_pelanggan.id_pelanggan', 'wp_pelanggan.nama_pelanggan', 'wp_barang.nama_barang', 'SUM(wp_asis_debt.turun_krat) as qty', 'wp_barang.satuan', 'wp_pelanggan.kelurahan', 'wp_asis_debt.tanggal as tgl_penarikan', 'wp_pelanggan.kecamatan', 'wp_pelanggan.no_telp', 'wp_karyawan.nama', 'wp_transaksi.username', 'SUM(wp_asis_debt.turun_krat) AS total', 'SUM(wp_asis_debt.bayar_krat) as bayar_krat', 'b.nama as nama_debt', 'wp_asis_debt.bayar_uang'); //set column field database for datatable searchable
  var $order = array('wp_transaksi.id_transaksi' => 'DESC'); // default order

  public function __construct()
  {
      parent::__construct();
  }

  private function _get_datatables_query()
  {

    //add custom filter here
    $this->db->select("wp_asis_debt.id,wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, wp_transaksi.username, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat, b.nama as nama_debt, wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat + (wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as `status`");
    $this->db->from('wp_asis_debt,wp_krat_kosong');
    $this->db->join('wp_transaksi', 'wp_asis_debt.id_transaksi = wp_transaksi.id', 'left');
    $this->db->join('wp_pelanggan', 'wp_asis_debt.wp_pelanggan_id = wp_pelanggan.id', 'left');
    $this->db->join('wp_barang', 'wp_asis_debt.wp_barang_id = wp_barang.id', 'left');
    $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
    $this->db->group_by('wp_transaksi.id_transaksi');
    
    $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username');

    // $this->db->from($this->table);
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

 public function get_by_id($no_faktur)
 {
    $this->db->select('wp_asis_debt.id, wp_asis_debt.turun_krat, wp_asis_debt.piutang, 
    wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_asis_debt.tanggal as tgl_penarikan, wp_asis_debt.bayar_krat, wp_asis_debt.bayar_uang');
    $this->db->where("wp_asis_debt.piutang <> wp_asis_debt.turun_krat");

    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_asis_debt.wp_pelanggan_id', 'inner');
    $this->db->join('wp_penarikan', 'wp_penarikan.wp_asis_debt_id = wp_asis_debt.id', 'left');
    $this->db->join('wp_transaksi', 'wp_transaksi.id = wp_asis_debt.id_transaksi', 'inner');
    
    $this->db->where('wp_transaksi.id_transaksi', $no_faktur);
    
    $this->db->group_by('wp_asis_debt.id');

    $this->db->order_by('wp_asis_debt.id', 'asc');

    $record = $this->db->get('wp_asis_debt');

    return $record->result();
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
      // wp_asis_debt, wp_penarikan
      $this->db->select('wp_asis_debt.id, wp_transaksi.id_transaksi as faktur, nama_pelanggan');
      $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_asis_debt.wp_pelanggan_id', 'inner');
      $this->db->join('wp_transaksi', 'wp_transaksi.id = wp_asis_debt.id_transaksi', 'inner');
      
      
      $this->db->where('wp_asis_debt.id', $faktur);
      return $this->db->get('wp_asis_debt')->row();
  }

  function hapus_pembayaran($faktur)
  {
      
      $this->db->where('wp_penarikan.wp_asis_debt_id', $faktur);
      $this->db->delete('wp_penarikan');
      
      $this->db->where('wp_asis_debt.id', $faktur);
      $this->db->delete('wp_asis_debt');
  }

}
