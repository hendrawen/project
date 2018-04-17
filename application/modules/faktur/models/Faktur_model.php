<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_all_product(){
		$result = $this->db->get('wp_detail_transaksi');
		return $result;
	}

  public function get_profile(){
		$result = $this->db->get('wp_profile')->result();
		return $result;
	}
  
  // public function get_jenis_pembayaran()
  // {
  //   # code...
  //   $result = $this->db->get('wp_status')->result();
  //   return $result;
  // }

  // function get_data_transaksi_bykode($kode){
	// 	$hsl=$this->db->query("SELECT * FROM wp_detail_transaksi WHERE id_transaksi='$kode'");
	// 	if($hsl->num_rows()>0){
	// 		foreach ($hsl->result() as $data) {
	// 			$hasil=array(
	// 				'id' => $data->id,
	// 				'id_transaksi' => $data->id_transaksi,
	// 				'bayar' => $data->bayar,
	// 				'utang' => $data->utang,
	// 				);
	// 		}
	// 	}
	// 	return $hasil;
	// }

  // function get_data_pelanggan_bykode($kode){
	// 	$hsl=$this->db->query("SELECT * FROM wp_pelanggan WHERE id_pelanggan='$kode'");
	// 	if($hsl->num_rows()>0){
	// 		foreach ($hsl->result() as $data) {
	// 			$hasil=array(
	// 				'id' => $data->id,
	// 				'id_pelanggan' => $data->id_pelanggan,
	// 				'nama_pelanggan' => $data->nama_pelanggan,
  //         'nama_dagang' => $data->nama_dagang,
	// 				'alamat' => $data->alamat,
  //         'no_telp' => $data->no_telp,
  //         'kota'    => $data->kota,
	// 				);
	// 		}
	// 	}
	// 	return $hasil;
	// }

  function get_transaksi()
  {
      $this->db->select('DISTINCT(wp_detail_transaksi.id_transaksi),wp_pelanggan.nama_pelanggan,wp_detail_transaksi.utang');
      $this->db->from('wp_detail_transaksi');
      $this->db->join('wp_transaksi','wp_transaksi.id_transaksi=wp_detail_transaksi.id_transaksi','left');
      $this->db->join('wp_pelanggan','wp_pelanggan.id=wp_transaksi.wp_pelanggan_id','left');
      $this->db->order_by('id_transaksi','DESC');
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
         return $query->result();
      } else return FALSE;
  }

  function get_data_bykode($kode){
		$this->db->select('wp_detail_transaksi.id, wp_detail_transaksi.utang, wp_detail_transaksi.bayar, wp_transaksi.id_transaksi, wp_transaksi.harga, wp_transaksi.qty, wp_transaksi.subtotal, wp_transaksi.tgl_transaksi, wp_barang.nama_barang, wp_barang.satuan, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.no_telp, wp_pelanggan.nama_dagang, wp_pelanggan.alamat, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_pelanggan.lat, wp_pelanggan.long, v_detail_utang.jatuh_tempo, wp_karyawan.nama');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_detail_transaksi','wp_detail_transaksi.id_transaksi=wp_transaksi.id_transaksi','left');
    $this->db->join('wp_pelanggan','wp_pelanggan.id=wp_transaksi.wp_pelanggan_id','left');
    $this->db->join('wp_karyawan','wp_karyawan.id_karyawan=wp_pelanggan.wp_karyawan_id_karyawan','left');
    $this->db->join('wp_barang','wp_barang.id=wp_transaksi.wp_barang_id','left');
    $this->db->join('v_detail_utang','v_detail_utang.id_pelanggan=wp_pelanggan.id_pelanggan','left');
    $this->db->where('wp_transaksi.id_transaksi', $kode);
    $hsl = $this->db->get();
    if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id' => $data->id,
					'id_transaksi' => $data->id_transaksi,
					'bayar' => $data->bayar,
					'utang' => $data->utang,
          'nama_barang' => $data->nama_barang,
          'harga' => $data->harga,
          'qty' => $data->qty,
          'satuan' => $data->satuan,
          'id_pelanggan' => $data->id_pelanggan,
					'nama_pelanggan' => $data->nama_pelanggan,
          'nama_dagang' => $data->nama_dagang,
          'alamat' => $data->alamat,
					'no_telp' => $data->no_telp,
          'kelurahan' => $data->kelurahan,
          'kecamatan' => $data->kecamatan,
          'lat' => $data->lat,
          'long' => $data->long,
          'jatuh_tempo' => $data->jatuh_tempo,
          'tgl_transaksi' => $data->tgl_transaksi,
          'nama' => $data->nama,
					);
			}
		}
		return $hasil;
	}

  public function generatekode_faktur() {
   $tahun = date("Y");
   $kode = 'BMF';
   $query = $this->db->query("SELECT MAX(no_faktur) as max_id FROM wp_faktur");
   $row = $query->row_array();
   $max_id = $row['max_id'];
   $max_id1 =(int) substr($max_id,9,5);
   $kode_invoice = $max_id1 +1;
   $maxkode_invoice = $kode.'-'.$tahun.'-'.sprintf("%04s",$kode_invoice);
   return $maxkode_invoice;
  }

}
