<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $id = 'id';
    var $table = 'wp_transaksi';
    var $column_order = array(null, 'wp_transaksi.id', 'wp_transaksi.id_transaksi', 'wp_transaksi.harga',
            'wp_transaksi.qty', 'wp_transaksi.subtotal', 'wp_transaksi.tgl_transaksi', 'wp_transaksi.updated_at', 'wp_barang.nama_barang', 'wp_pelanggan.nama_pelanggan',
            'wp_status.nama_status', 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.kota',
            'wp_pelanggan.kecamatan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.no_telp',
            'wp_barang.satuan'); //set column field database for datatable orderable
    var $column_search = array('wp_transaksi.id',' wp_transaksi.id_transaksi', 'wp_transaksi.harga',
            'wp_transaksi.qty', 'wp_transaksi.subtotal', 'wp_transaksi.tgl_transaksi', 'wp_transaksi.updated_at', 'wp_barang.nama_barang', 'wp_pelanggan.nama_pelanggan',
            'wp_status.nama_status', 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.kota',
            'wp_pelanggan.kecamatan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.no_telp',
            'wp_barang.satuan'); //set column field database for datatable searchable
    var $order = array('tgl_transaksi' => 'DESC'); // default order

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
      //filter table_call
      $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.subtotal, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            b.nama as nama_debt, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
     $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
     $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
     $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
     $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
     $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
     if($this->input->post('dari'))
     {
        $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) >=' , $this->input->post('dari'));
     }
     if($this->input->post('ke'))
     {
        $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) <=', $this->input->post('ke'));
     }
     if ($this->input->post('status')) {
        $this->db->where('wp_status_id', $this->input->post('status'));
    }
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

    function get_data($dari, $ke, $status)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_transaksi.subtotal, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
            b.nama as nama_debt, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`,
            DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        if ($dari != 'semua' && $ke != 'semua') {
            $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) >=' , $dari);
            $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) <=', $ke);
        }
        if ($dari != 'semua' && $ke == 'semua') {
            $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day)' , $dari);
        }
        if ($dari == 'semua' && $ke != 'semua') {
            $this->db->where('DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day)' , $ke);
        }
        if ($status != 'semua') {
            $this->db->where('wp_status_id', $status);
        }
        $this->db->from($this->table);
            //$this->db->where('username');
        $data = $this->db->get();
        return $data->result();
    }

    function get_status()
    {
        return $this->db->get('wp_status')->result();
    }

    function get_status_id($id)
    {
        if ($id == 'semua') {
            return 'semua';
        } else {
            $this->db->select('nama_status');
            $this->db->where('id', $id);
            $hasil =  $this->db->get('wp_status')->row();
            return $hasil->nama_status;
        }
    }

}

/* End of file Wp_transaksi_model.php */
/* Location: ./application/models/Wp_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-12 05:09:32 */
/* http://harviacode.com */
