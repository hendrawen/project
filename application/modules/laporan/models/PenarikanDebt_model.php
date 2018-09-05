<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PenarikanDebt_model extends CI_Model {

    var $table = 'wp_asis_debt';
    var $column_order = array(null, 'wp_pembayaran.id_transaksi', 'wp_pembayaran.tgl_bayar', 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.nama_pelanggan', 'wp_barang.nama_barang', 'wp_transaksi.qty', 'wp_barang.satuan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.kecamatan', 'wp_pelanggan.no_telp', 'wp_karyawan.nama', 'b.nama as nama_debt', 'wp_transaksi.subtotal', 'wp_pembayaran.tgl_bayar', 'wp_pembayaran.bayar', 'wp_detail_transaksi.bayar as `jumlah_bayar`', 'wp_status.nama_status'); //set column field database for datatable orderable
    var $column_search = array(''); //set column field database for datatable searchable 
    var $order = array('wp_asis_debt.wp_pelanggan_id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->select("wp_penarikan.username, wp_transaksi.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as jatuh_tempo, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, SUM(wp_asis_debt.turun_krat) as qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_asis_debt.tanggal as tgl_penarikan, wp_pelanggan.kecamatan,wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, SUM(wp_asis_debt.turun_krat) AS total, SUM(wp_asis_debt.bayar_krat) as bayar_krat,  wp_asis_debt.bayar_uang, sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga)) as jumlah, (sum(wp_asis_debt.turun_krat) - sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))) as sisa, IF (sum(wp_asis_debt.turun_krat) > (sum(wp_asis_debt.bayar_krat+(wp_asis_debt.bayar_uang/wp_krat_kosong.harga))), 'Masih ada ASET', 'Tidak ada ASET') as status");
        

        $this->db->join('wp_transaksi', 'wp_transaksi.id = wp_asis_debt.id_transaksi', 'left');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_asis_debt.wp_pelanggan_id', 'left');
        $this->db->join('wp_barang', 'wp_barang.id = wp_asis_debt.wp_barang_id', 'left');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'left');
        $this->db->join('wp_penarikan', 'wp_penarikan.wp_asis_debt_id = wp_asis_debt.id', 'left');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');


        /*
        wp_penarikan.username = '$username' and
        date(wp_asis_debt.tanggal) = '$day'
         */
        if ($this->input->post('tanggal')) {
            $this->db->where('date(wp_asis_debt.tanggal)', $this->input->post('tanggal'));
        }
        if ($this->input->post('dari') && !$this->input->post('ke')) {
            $this->db->where('month(wp_asis_debt.tanggal)', $this->input->post('dari'));
        }
        if ($this->input->post('ke') && !$this->input->post('dari')) {
            $this->db->where('month(wp_asis_debt.tanggal)', $this->input->post('ke'));
        }
        if ($this->input->post('ke') && $this->input->post('dari')) {
            $this->db->where('month(wp_asis_debt.tanggal) >=', $this->input->post('dari'));
            $this->db->where('month(wp_asis_debt.tanggal) <=', $this->input->post('ke'));
        }
        if ($this->input->post('tahun')) {
            $this->db->where('year(wp_asis_debt.tanggal)', $this->input->post('tahun'));
        }
        if ($this->input->post('tahun2')) {
            $this->db->where('year(wp_asis_debt.tanggal)', $this->input->post('tahun2'));
        }

        if ($this->input->post('debt')) {
            $this->db->where('wp_penarikan.username', $this->input->post('debt'));
        }
        if ($this->input->post('debt2')) {
            $this->db->where('wp_penarikan.username', $this->input->post('debt2'));
        }
        if ($this->input->post('debt3')) {
            $this->db->where('wp_penarikan.username', $this->input->post('debt3'));
        }
        
        $this->db->order_by('wp_asis_debt.wp_pelanggan_id', 'DESC');
        $this->db->from('wp_asis_debt, wp_krat_kosong');
        
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

    function get_debt()
    {
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->join('wp_jabatan','wp_jabatan.id=wp_karyawan.wp_jabatan_id');
        $this->db->where('wp_jabatan.nama_jabatan','Debt & Delivery');
        $this->db->select('id_karyawan, nama');
        return $this->db->get('wp_karyawan')->result();
    }

    function get_debt_id($id)
    {
        if ($id == 'semua') {
            return 'semua';
        } else {
            $this->db->select('nama');
            $this->db->where('id_karyawan', $id);
            $hasil =  $this->db->get('wp_karyawan')->row();
            return $hasil->nama;
        }
    }

    function laporan_tanggal($tanggal, $debt, $status)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_pembayaran.tgl_bayar, wp_transaksi.updated_at,
            wp_pembayaran.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp, nama_status,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, b.nama as nama_debt, wp_transaksi.subtotal,
            DATE_ADD(wp_asis_debt.tanggal, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_pembayaran.username', 'left');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        if ($tanggal != 'semua') {
            $this->db->where('date(wp_asis_debt.tanggal)', $tanggal);
        }
        if ($debt != 'semua') {
            $this->db->where('wp_penarikan.username', $debt);
        }

        if ($status != 'semua') {
            $this->db->where('wp_status_id', $status);
        }
        
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        return $this->db->get($this->table)->result();
        
    }
    function laporan_bulan($dari, $ke, $tahun, $debt, $status)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_pembayaran.tgl_bayar, wp_transaksi.updated_at,
            wp_pembayaran.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp, nama_status,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, b.nama as nama_debt, wp_transaksi.subtotal,
            DATE_ADD(wp_asis_debt.tanggal, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_pembayaran.username', 'left');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        
        if ($ke != 'semua' && $dari != 'semua') {
            $this->db->where('month(wp_asis_debt.tanggal) >=', $dari);
            $this->db->where('month(wp_asis_debt.tanggal) <=', $ke);
        }
        if ($tahun != 'semua') {
            $this->db->where('year(wp_asis_debt.tanggal)', $tahun);
        }
        if ($debt != 'semua') {
            $this->db->where('wp_penarikan.username', $debt);
        }
        if ($status != 'semua') {
            $this->db->where('wp_status_id', $status);
        }
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $this->db->from($this->table);
        return $this->db->get()->result();
        
    }
    function laporan_tahun($tahun, $debt, $status)
    {
        $this->db->select('wp_transaksi.id, wp_transaksi.id_transaksi, wp_transaksi.harga,
            wp_transaksi.qty, wp_pembayaran.tgl_bayar, wp_transaksi.updated_at,
            wp_pembayaran.username, wp_barang.nama_barang, wp_pelanggan.nama_pelanggan,
            wp_status.nama_status, wp_pelanggan.id_pelanggan, wp_pelanggan.kota,
            wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, , wp_pelanggan.no_telp, nama_status,
            wp_barang.satuan, wp_karyawan.nama as `nama_karyawan`, b.nama as nama_debt, wp_transaksi.subtotal,
            DATE_ADD(wp_asis_debt.tanggal, INTERVAL 14 day) as `jatuh_tempo`');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_pembayaran.username', 'left');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        
        if ($tahun != 'semua') {
            $this->db->where('year(wp_asis_debt.tanggal)', $tahun);
        }
        if ($debt != 'semua') {
            $this->db->where('wp_penarikan.username', $debt);
        }
        if ($status != 'semua') {
            $this->db->where('wp_status_id', $status);
        }
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');
        $this->db->from($this->table);
        return $this->db->get()->result();
        
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

/* End of file Models_laporan.php */
