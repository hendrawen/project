<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
	}
	
	function get_by_id($id)
	{		
			$this->db->select('wp_transaksi.*, wp_barang.id, wp_barang.id_barang, wp_barang.nama_barang');
			$this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'join');
			$this->db->where('wp_transaksi.id', $id);
			return $this->db->get('wp_transaksi')->row();
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

}
