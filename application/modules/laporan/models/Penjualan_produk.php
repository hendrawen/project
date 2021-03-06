<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_produk extends CI_Model {

    var $table = 'wp_transaksi';
    var $column_order = array(null, 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.nama_pelanggan', 'wp_transaksi.harga',
            'wp_transaksi.qty', 'wp_transaksi.tgl_transaksi', 'wp_transaksi.updated_at',
            'wp_transaksi.username', 'wp_barang.nama_barang', 'wp_pelanggan.nama_pelanggan',
            'wp_status.nama_status', 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.kota',
            'wp_pelanggan.kecamatan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.no_telp',
            'wp_barang.satuan', 'wp_transaksi.subtotal'); //set column field database for datatable orderable
    var $column_search = array('wp_transaksi.id', 'wp_transaksi.id_transaksi', 'wp_transaksi.harga',
            'wp_transaksi.qty', 'wp_transaksi.tgl_transaksi', 'wp_transaksi.updated_at',
            'wp_transaksi.username', 'wp_barang.nama_barang', 'wp_pelanggan.nama_pelanggan',
            'wp_pelanggan.kota',
            'wp_pelanggan.kecamatan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.no_telp'); //set column field database for datatable searchable 
    var $order = array('wp_transaksi.id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
        wp_transaksi.qty, wp_transaksi.tgl_transaksi, wp_transaksi.updated_at,
        wp_transaksi.username, wp_barang.id, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
        wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
        wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp,
        wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, b.nama as nama_debt, wp_transaksi.subtotal,
        DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $this->db->from($this->table);

        if ($this->input->post('tanggal')) {
            $this->db->where('date(wp_transaksi.tgl_transaksi)', $this->input->post('tanggal'));
        }
        if ($this->input->post('dari') && !$this->input->post('ke')) {
            $this->db->where('month(wp_transaksi.tgl_transaksi)', $this->input->post('dari'));
        }
        if ($this->input->post('ke') && !$this->input->post('dari')) {
            $this->db->where('month(wp_transaksi.tgl_transaksi)', $this->input->post('ke'));
        }
        if ($this->input->post('ke') && $this->input->post('dari')) {
            $this->db->where('month(wp_transaksi.tgl_transaksi) >=', $this->input->post('dari'));
            $this->db->where('month(wp_transaksi.tgl_transaksi) <=', $this->input->post('ke'));
        }
        if ($this->input->post('tahun')) {
            $this->db->where('year(wp_transaksi.tgl_transaksi)', $this->input->post('tahun'));
        }
        if ($this->input->post('tahun2')) {
            $this->db->where('year(wp_transaksi.tgl_transaksi)', $this->input->post('tahun2'));
        }

        if ($this->input->post('barang1')) {
            $this->db->where('wp_barang.id', $this->input->post('barang1'));
        }
        if ($this->input->post('barang2')) {
            $this->db->where('wp_barang.id', $this->input->post('barang2'));
        }
        if ($this->input->post('barang3')) {
            $this->db->where('wp_barang.id', $this->input->post('barang3'));
        }

        if ($this->input->post('status')) {
            $this->db->where('wp_status_id', $this->input->post('status'));
        }
        if ($this->input->post('status2')) {
            $this->db->where('wp_status_id', $this->input->post('status2'));
        }
        if ($this->input->post('status3')) {
            $this->db->where('wp_status_id', $this->input->post('status3'));
        }
        
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('kota, kecamatan, kelurahan');
        $query = $this->db->get();

        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->select('kota, kecamatan, kelurahan');
        return $this->db->count_all_results();
    }

    public function get_produk()
    {
        return $this->db->get('wp_barang');
        
    }

}

/* End of file Penjualan_produk.php */
