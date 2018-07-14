<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  public $table = 'wp_transaksistok';
  public $id   = 'id';
  public $order = 'DESC';


  function total_penjualan()
  {
    # code...
    $this->db->select('sum(subtotal) as total');
    $this->db->from('wp_transaksi');
    $this->db->where('username', $this->session->identity);
    return $this->db->get()->result();
  }

  function penjualan_bulanan()
  {
    # code...
    $condition = "MONTH(NOW()) = MONTH(tgl_transaksi)";
    $this->db->select('sum(subtotal) as total');
    $this->db->from('wp_transaksi');
    $this->db->where($condition);
    $this->db->where('username', $this->session->identity);
    return $this->db->get()->result();
  }

  public function gettotaljadwal()
  {
    # code...
    $condition = "curdate() = wp_jadwal.start";
    $this->db->order_by('id_pelanggan');
    $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.alamat, wp_pelanggan.lat, wp_pelanggan.long, wp_pelanggan.no_telp, wp_barang.nama_barang, wp_jadwal.qty, wp_jadwal.start, wp_jadwal.title, wp_jadwal.description');
    $this->db->from('wp_jadwal');
    $this->db->join('wp_pelanggan', 'wp_jadwal.wp_pelanggan_id = wp_pelanggan.id', 'inner');
    $this->db->join('wp_barang', 'wp_jadwal.wp_barang_id = wp_barang.id', 'inner');
    // $this->db->where('wp_jadwal.wp_karyawan_id_karyawan', $this->session->identity);
    $this->db->where($condition);
    return $this->db->count_all_results();
  }

  function total_transaksi() {
      $this->db->from('wp_transaksi');
      $this->db->where('username', $this->session->identity);
      return $this->db->count_all_results();
  }

  function transaksi_perbulan() {
      $condition = "MONTH(NOW()) = MONTH(tgl_transaksi)";
      $this->db->from('wp_transaksi');
      $this->db->where($condition);
      $this->db->where('username', $this->session->identity);
      return $this->db->count_all_results();
  }

  public function getbydriver()
  {
    # code...
    $condition = "curdate() = wp_jadwal.start";
    $this->db->order_by('id_pelanggan');
    $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.alamat, wp_pelanggan.lat, wp_pelanggan.long, wp_pelanggan.no_telp, wp_barang.nama_barang, wp_jadwal.qty, wp_jadwal.start, wp_jadwal.title, wp_jadwal.description');
    $this->db->from('wp_jadwal');
    $this->db->join('wp_pelanggan', 'wp_jadwal.wp_pelanggan_id = wp_pelanggan.id', 'inner');
    $this->db->join('wp_barang', 'wp_jadwal.wp_barang_id = wp_barang.id', 'inner');
    $this->db->where('wp_jadwal.wp_karyawan_id_karyawan', $this->session->identity);
    $this->db->where($condition);
    return $this->db->get()->result();
  }

  public function gettransaksiharian()
  {
    # code...
    $condition = "curdate() = wp_transaksi.tgl_transaksi";
    $this->db->order_by('id_transaksi', 'DESC');
    $this->db->select('wp_transaksi.id, wp_barang.nama_barang, wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.nama_dagang, wp_transaksi.id_transaksi, wp_transaksi.qty, wp_transaksi.harga, wp_transaksi.subtotal, wp_status.nama_status');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where($condition);
    return $this->db->get()->result();
  }

  public function cetakinvoice($id)
  {
    # code...
    $this->db->order_by('id_transaksi', 'DESC');
    $this->db->select('wp_transaksi.id, wp_barang.nama_barang, wp_barang.satuan, wp_transaksi.tgl_transaksi, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.nama_dagang, wp_transaksi.id_transaksi, wp_transaksi.qty, wp_transaksi.harga, wp_transaksi.subtotal, wp_status.nama_status');
    $this->db->from('wp_transaksi');
    $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
    $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id', 'inner');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where('wp_transaksi.id_transaksi', $id);
    return $this->db->get()->result();
  }

  public function idinvoice($id)
  {
    # code...
    $this->db->DISTINCT();
    $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.kelurahan, wp_pelanggan.alamat, wp_pelanggan.no_telp, wp_pelanggan.nama_dagang, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi');
    $this->db->from('wp_pelanggan');
    $this->db->join('wp_transaksi', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where('wp_transaksi.id_transaksi', $id);
    return $this->db->get()->result();
  }

  public function status($id)
  {
    # code...
    $this->db->DISTINCT();
    $this->db->select('nama_status');
    $this->db->from('wp_status');
    $this->db->join('wp_transaksi', 'wp_transaksi.wp_status_id = wp_status.id', 'inner');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where('wp_transaksi.id_transaksi', $id);
    return $this->db->get()->result();
  }

  public function total_invoice($id)
  {
    # code...
    $this->db->select('sum(subtotal) as total');
    $this->db->from('wp_transaksi');
    $this->db->where('wp_transaksi.username', $this->session->identity);
    $this->db->where('wp_transaksi.id_transaksi', $id);
    return $this->db->get()->result();

  }

  function cari_pelanggan($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
    $this->db->where('status', 'Pelanggan');
		$this->db->limit(10);
		return $this->db->get('wp_pelanggan')->result();
	}

  function cek_piutang($idpelanggan){
		$this->db->like('id_pelanggan', $idpelanggan , 'both');
		$this->db->order_by('id_pelanggan', 'ASC');
		$this->db->limit(10);
		return $this->db->get('wp_pelanggan')->result();
	}

  function update_piutang($idpelanggan){
		$this->db->like('id_transaksi', $idpelanggan , 'both');
		$this->db->order_by('id_transaksi', 'ASC');
    $this->db->where('utang <=', 'bayar');
		$this->db->limit(10);
		return $this->db->get('v_detail')->result();
	}

  function get_track($cari){
    $this->db->where('id_pelanggan', $cari);
    $hsl = $this->db->get('v_detail');
    if($hsl->num_rows() == 0){
        echo '<tr><td colspan="9"><center><div class="alert alert-danger" role="alert">Pelanggan Dengan No. ID : '.$cari.' Tidak Memiliki Utang</div></center></td></tr>';
    } else {
      return $hsl->result();
    }
  }

  function sum_get_track($cari){
    $this->db->select('sum(sisa) as sisa');
    $this->db->where('id_pelanggan', $cari);
    $hsl = $this->db->get('v_detail');
    return $hsl->result();
  }

  function get_min_track($cari){
    $this->db->select('id_transaksi, sisa, id_pelanggan');
    $this->db->where('id_pelanggan', $cari);
    $this->db->order_by('id_transaksi', 'ASC');
    $hsl = $this->db->get('v_detail');
    return $hsl->result();
  }

  // get data by id
  function get_by_id($id)
  {
      $this->db->where('id', $id);
      return $this->db->get('wp_transaksistok')->row();
  }

  function delete($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('wp_transaksistok');
  }

  public function getdetail($id)
  {
    # code...
    $this->db->select('nama_barang, qty, nama_pelanggan, id_pelanggan');
    $this->db->where('id_pelanggan', $id);
    return $this->db->get('v_event')->result();
  }

  function update($id, $data)
  {
      $this->db->where('id', $id);
      return $this->db->update('wp_detail_transaksi', $data);

  }


  function insert_pembayaran($data)
  {
    // code...
    $this->db->insert('wp_pembayaran', $data);
  }

  function get_data(){
        $this->db->select('wp_transaksistok.id, id_transaksi, tgl_transaksi, wp_barang.id_barang, wp_barang.nama_barang, harga, qty, wp_transaksistok.satuan, subtotal, wp_transaksistok.updated_at, wp_transaksistok.username, wp_suplier.id_suplier, wp_suplier.nama_suplier');
        $this->db->from($this->table);
        $this->db->join('wp_suplier', 'wp_suplier.id = wp_transaksistok.wp_suplier_id');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksistok.wp_barang_id');
        $this->db->order_by('id_transaksi', $this->order);
        return $this->db->get()->result();
    }

    function get_data_barang_bykode($kode){
  		$hsl=$this->db->query("SELECT * FROM wp_barang WHERE id_barang='$kode'");
  		if($hsl->num_rows()>0){
  			foreach ($hsl->result() as $data) {
  				$hasil=array(
  					'id' => $data->id,
  					'id_barang' => $data->id_barang,
  					'nama_barang' => $data->nama_barang,
  					//'satuan'  => $data->satuan,
  					);
  			}
  		}
  		return $hasil;
  	}

    function generatekode_invoice(){
          $this->db->select('RIGHT(wp_transaksistok.id_transaksi, 2) as kode', FALSE);
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
          $kodejadi = "NP".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;
    }

    public function get_all_product(){
  		$result = $this->db->get('wp_barang');
  		return $result;
  	}

    public function get_profile(){
  		$result = $this->db->get('wp_profile')->result();
  		return $result;
  	}

    function cari_suplier($idsuplier){
  		$this->db->like('id_suplier', $idsuplier , 'both');
  		$this->db->order_by('id_suplier', 'ASC');
  		$this->db->limit(25);
  		return $this->db->get('wp_suplier')->result();
  	}

}
