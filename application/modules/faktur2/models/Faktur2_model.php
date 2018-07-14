<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur2_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data_faktur()
  {
    $this->db->select('DISTINCT(wp_detail_transaksi.id_transaksi),wp_pelanggan.nama_pelanggan,wp_detail_transaksi.utang');
    $this->db->from('wp_detail_transaksi');
    $this->db->join('wp_transaksi','wp_transaksi.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->join('wp_pelanggan','wp_pelanggan.id=wp_transaksi.wp_pelanggan_id','left');
    $this->db->where('wp_pelanggan.status','pelanggan');
    $this->db->order_by('id_transaksi','DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
       return $query->result();
    } else return FALSE;
  }

  function get_data_bykode($kode){
		$this->db->select('DISTINCT(wp_detail_transaksi.id), wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.no_telp, wp_pelanggan.nama_dagang, wp_pelanggan.alamat, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_pelanggan.lat, wp_pelanggan.long, v_detail.jatuh_tempo, wp_karyawan.nama');
    $this->db->from('wp_detail_transaksi');
    $this->db->join('wp_transaksi','wp_transaksi.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->join('wp_pelanggan','wp_pelanggan.id=wp_transaksi.wp_pelanggan_id','left');
    $this->db->join('wp_karyawan','wp_karyawan.id_karyawan=wp_pelanggan.wp_karyawan_id_karyawan','left');
    $this->db->join('v_detail','v_detail.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->where('wp_detail_transaksi.id_transaksi', $kode);
    $hsl = $this->db->get();
    if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'id' => $data->id,
					'id_transaksi' => $data->id_transaksi,
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

  public function get_profile(){
		$result = $this->db->get('wp_profile')->result();
		return $result;
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

  public function get_faktur($search)
  {
    $this->db->select('wp_transaksi.id_transaksi, wp_transaksi.harga, wp_transaksi.qty, wp_transaksi.subtotal, wp_transaksi.tgl_transaksi, wp_transaksi.diskon, wp_detail_transaksi.bayar, wp_pelanggan.nama_pelanggan, wp_pelanggan.nama_dagang, wp_pelanggan.alamat, wp_pelanggan.no_telp, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_pelanggan.lat, wp_pelanggan.long, wp_barang.nama_barang, wp_barang.satuan, wp_karyawan.nama, v_detail.jatuh_tempo, v_detail.sisa');
    $this->db->from('wp_detail_transaksi');
    $this->db->join('wp_transaksi','wp_transaksi.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->join('wp_pelanggan','wp_pelanggan.id=wp_transaksi.wp_pelanggan_id','left');
    $this->db->join('wp_karyawan','wp_karyawan.id_karyawan=wp_pelanggan.wp_karyawan_id_karyawan','left');
    $this->db->join('wp_barang','wp_barang.id=wp_transaksi.wp_barang_id','left');
    $this->db->join('v_detail','v_detail.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->like('wp_transaksi.id_transaksi', $search);
    $this->db->or_like('wp_pelanggan.nama_pelanggan', $search);
    $this->db->order_by('wp_detail_transaksi.id_transaksi','DESC');
    $hsl = $this->db->get();
    if($hsl->num_rows() == 0){
        echo '<tr><td colspan="7"><center><div class="alert alert-danger" role="alert">Id Transaksi/ Nama Pelanggan "'.$search.'" Tidak Ditemukan</div></center></td></tr>';
    } else {
      return $hsl->result();
    }
  }

  function cari_transaksi($idtransaksi){
    $kosong = 0;
    $where = "wp_detail_transaksi.utang <> wp_detail_transaksi.bayar";
		$this->db->like('wp_detail_transaksi.id_pelanggan', $idtransaksi, 'both');
    $this->db->select('DISTINCT(wp_detail_transaksi.id_transaksi), wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.no_telp, nama_dagang, wp_pelanggan.alamat, kecamatan, kelurahan, lat, wp_pelanggan.long, v_detail.jatuh_tempo, wp_karyawan.nama');
    $this->db->join('wp_transaksi','wp_transaksi.wp_pelanggan_id=wp_pelanggan.id','left');
    $this->db->join('wp_transaksi','wp_transaksi.id_transaksi=wp_detail_transaksi.id_transaksi','left');
    $this->db->join('wp_karyawan','wp_karyawan.id_karyawan=wp_pelanggan.wp_karyawan_id_karyawan','left');
    $this->db->join('v_detail','v_detail.id_pelanggan=wp_pelanggan.id_pelanggan','left');
		$this->db->order_by('wp_detail_transaksi.id_transaksi', 'DESC');
    $this->db->where($where);
		return $this->db->get('wp_detail_transaksi')->result();
	}

  function cari_pelanggan($idpelanggan){
    // $where = "wp_detail_transaksi.utang <> wp_detail_transaksi.bayar";
    // $this->db->select('DISTINCT(wp_detail_transaksi.id_transaksi), wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan,wp_pelanggan.nama_pelanggan, wp_pelanggan.no_telp, nama_dagang, wp_pelanggan.alamat, kecamatan, kelurahan, lat, wp_pelanggan.long, v_detail.jatuh_tempo, wp_karyawan.nama');
    // $this->db->join('wp_transaksi','wp_transaksi.wp_pelanggan_id=wp_pelanggan.id','left');
    // $this->db->join('wp_detail_transaksi','wp_detail_transaksi.id_transaksi=wp_transaksi.id_transaksi','left');
    // $this->db->join('wp_karyawan','wp_karyawan.id_karyawan=wp_pelanggan.wp_karyawan_id_karyawan','left');
    // $this->db->join('v_detail','v_detail.id_pelanggan=wp_pelanggan.id_pelanggan','left');
    // $this->db->order_by('wp_detail_transaksi.id_transaksi', 'DESC');
    // $this->db->like('wp_pelanggan.id_pelanggan', $idpelanggan , 'both');
    // $this->db->where($where);
    // $this->db->limit(25);
    
		return $this->db->get('wp_pelanggan')->result();
	}
  
}
