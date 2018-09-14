<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'wp_transaksi';
    public $id = 'wp_transaksi.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_transaksi($id)
    {
          $this->db->select('wp_transaksi.*, wp_barang.id_barang, wp_barang.nama_barang, wp_barang.harga_jual, wp_barang.satuan, wp_pelanggan.*, wp_status.*, wp_gudang.*, wp_detail_transaksi.*');
          $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
          $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
          $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
          $this->db->join('wp_gudang', 'wp_gudang.id = wp_transaksi.gudang', 'join');
          $this->db->join('wp_detail_transaksi', 'wp_detail_transaksi.id_transaksi = wp_transaksi.id_transaksi', 'join');
          $this->db->where('wp_transaksi.id_transaksi', $id);
          return $this->db->get('wp_transaksi')->result();
    }
    
    function get_gudang()
    {
        $this->db->select('id, nama_gudang');
        return $this->db->get('wp_gudang');
    }

  public function get_all_product(){
		$result = $this->db->get('wp_barang');
		return $result;
	}

  function cari_pelanggan($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
    $this->db->where('status', 'Pelanggan');
		$this->db->limit(25);
		return $this->db->get('wp_pelanggan')->result();
	}

  public function get_profile(){
		$result = $this->db->get('wp_profile')->result();
		return $result;
	}

  public function get_jenis_pembayaran()
  {
    # code...
    $result = $this->db->get('wp_status')->result();
    return $result;
  }

  function get_data_barang_bykode($kode){
    $hsl=$this->db->query("SELECT * FROM wp_barang WHERE id_barang='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'id' => $data->id,
                'id_barang' => $data->id_barang,
                'nama_barang' => $data->nama_barang,
                'harga_jual' => $data->harga_jual,
      'satuan'  => $data->satuan,
                );
        }
    }
    return $hasil;
}

function get_data_pelanggan_bykode($kode){
    $hsl=$this->db->query("SELECT * FROM wp_pelanggan WHERE id_pelanggan='$kode'");
    if($hsl->num_rows()>0){
        foreach ($hsl->result() as $data) {
            $hasil=array(
                'id' => $data->id,
                'id_pelanggan' => $data->id_pelanggan,
                'nama_pelanggan' => $data->nama_pelanggan,
                'nama_dagang' => $data->nama_dagang,
                'alamat' => $data->alamat,
                'no_telp' => $data->no_telp,
                'kota'    => $data->kota,
                );
        }
    }
    return $hasil;
}

  public function generatekode_invoice() {
    $tahun = date("Y");
    $kode = 'NFBM';
    $query = $this->db->query("SELECT MAX(id_transaksi) as max_id FROM wp_transaksi");
    $row = $query->row_array();
    $max_id = $row['max_id'];
    $max_id1 =(int) substr($max_id,4,5);
    $kode_invoice = $max_id1 +1;
    $maxkode_invoice = $kode.''.sprintf("%05s",$kode_invoice);
    return $maxkode_invoice;
   }

    // get all
    function get_all()
    {
        $this->db->order_by(' wp_transaksi.tgl_transaksi', 'DESC');
        $this->db->select('wp_transaksi.*, wp_pelanggan.id_pelanggan');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
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
        $this->db->like('wp_transaksi.id', $q);
      	$this->db->or_like('id_transaksi', $q);
      	$this->db->or_like('wp_barang_id', $q);
      	$this->db->or_like('harga', $q);
      	$this->db->or_like('qty', $q);
      	//$this->db->or_like('satuan', $q);
      	$this->db->or_like('tgl_transaksi', $q);
      	$this->db->or_like('wp_transaksi.updated_at', $q);
      	$this->db->or_like('wp_pelanggan_id', $q);
      	$this->db->or_like('wp_transaksi.username', $q);
      	$this->db->or_like('wp_status_id', $q);
      	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by(' wp_transaksi.tgl_transaksi', 'DESC');
        $this->db->select('wp_transaksi.*, wp_pelanggan.id_pelanggan');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');

        $this->db->like('wp_transaksi.id', $q);
      	$this->db->or_like('id_transaksi', $q);
      	$this->db->or_like('wp_barang_id', $q);
      	$this->db->or_like('harga', $q);
      	$this->db->or_like('qty', $q);
      	//$this->db->or_like('satuan', $q);
      	$this->db->or_like('tgl_transaksi', $q);
      	$this->db->or_like('wp_transaksi.updated_at', $q);
      	$this->db->or_like('wp_pelanggan_id', $q);
      	$this->db->or_like('wp_transaksi.username', $q);
      	$this->db->or_like('wp_status_id', $q);
      	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        //$this->db->trans_begin();

        $this->db->insert($this->table, $data);

        // if ($this->db->trans_status() == FALSE) {
        //     $this->db->trans_rollback();
        // } else {
        //     $this->db->trans_commit();
        // }
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
        $this->db->where_in('id_transaksi', $id);
        $this->db->delete($this->table);
    }

    function get_data()
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.subtotal, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            b.nama as nama_debt, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
            //SELECT DATE_ADD(tgl_transaksi, INTERVAL 14 day) as jatuh FROM wp_transaksi
        $this->db->from($this->table);
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by(' wp_transaksi.tgl_transaksi', 'DESC');
        //$this->db->where('username');
        $data = $this->db->get();
        return $data->result();
    }

    function buat_kode(){
          $this->db->select('RIGHT(wp_transaksi.id_transaksi, 2) as kode', FALSE);
          $this->db->order_by($this->id, $this->order);
          $this->db->limit(1);
          $query = $this->db->get($this->table, $this->id);      //cek dulu apakah ada sudah ada kode di tabel.
          if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
           $data = $query->row();
           $kode = intval($data->kode) + 1;
          }
          else {
           //jika kode belum ada
           $kode = 1;
          }
          $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 2 menunjukkan jumlah digit angka 0
          $kodejadi = "TR0".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;
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

  function insert_detail($detail)
  {
      if (sizeof($detail) == 0) {
          $this->db->insert('bm_detail_transaksi', $detail);
      } else {
          $this->db->insert_batch('bm_detail_transaksi', $detail);
      }
  }

}

/* End of file Wp_transaksi_model.php */
/* Location: ./application/models/Wp_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-12 05:09:32 */
/* http://harviacode.com */
