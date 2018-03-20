<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_all_product(){
		$result = $this->db->get('wp_barang');
		return $result;
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
   $kode = 'BM';
   $query = $this->db->query("SELECT MAX(id_transaksi) as max_id FROM wp_transaksi");
   $row = $query->row_array();
   $max_id = $row['max_id'];
   $max_id1 =(int) substr($max_id,9,5);
   $kode_invoice = $max_id1 +1;
   $maxkode_invoice = $kode.'-'.$tahun.'-'.sprintf("%04s",$kode_invoice);
   return $maxkode_invoice;
  }

}
