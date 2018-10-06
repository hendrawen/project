<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranDebt_model extends CI_Model {

    var $table = 'wp_pembayaran';
    var $column_order = array(null, 'wp_pembayaran.id_transaksi', 'wp_pembayaran.tgl_bayar', 'wp_pelanggan.id_pelanggan', 'wp_pelanggan.nama_pelanggan', 'wp_barang.nama_barang', 'wp_transaksi.qty', 'wp_barang.satuan', 'wp_pelanggan.kelurahan', 'wp_pelanggan.kecamatan', 'wp_pelanggan.no_telp', 'wp_karyawan.nama', 'b.nama as nama_debt', 'wp_transaksi.subtotal', 'wp_pembayaran.tgl_bayar', 'wp_pembayaran.bayar', 'wp_detail_transaksi.bayar as `jumlah_bayar`', 'wp_status.nama_status'); //set column field database for datatable orderable
    var $column_search = array(''); //set column field database for datatable searchable 
    var $order = array('wp_pembayaran.id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');

        if ($this->input->post('tanggal')) {
            $this->db->where('date(wp_pembayaran.tgl_bayar)', $this->input->post('tanggal'));
        }
        if ($this->input->post('dari') && !$this->input->post('ke')) {
            $this->db->where('month(wp_pembayaran.tgl_bayar)', $this->input->post('dari'));
        }
        if ($this->input->post('ke') && !$this->input->post('dari')) {
            $this->db->where('month(wp_pembayaran.tgl_bayar)', $this->input->post('ke'));
        }
        if ($this->input->post('ke') && $this->input->post('dari')) {
            $this->db->where('month(wp_pembayaran.tgl_bayar) >=', $this->input->post('dari'));
            $this->db->where('month(wp_pembayaran.tgl_bayar) <=', $this->input->post('ke'));
        }
        if ($this->input->post('tahun')) {
            $this->db->where('year(wp_pembayaran.tgl_bayar)', $this->input->post('tahun'));
        }
        if ($this->input->post('tahun2')) {
            $this->db->where('year(wp_pembayaran.tgl_bayar)', $this->input->post('tahun2'));
        }

        if ($this->input->post('debt')) {
            $this->db->where('wp_pembayaran.username', $this->input->post('debt'));
        }
        if ($this->input->post('debt2')) {
            $this->db->where('wp_pembayaran.username', $this->input->post('debt2'));
        }
        if ($this->input->post('debt3')) {
            $this->db->where('wp_pembayaran.username', $this->input->post('debt3'));
        }
		$this->db->join('wp_karyawan as c', 'pembayaran.username = c.id_karyawan', 'inner');
		$this->db->where('c.penempatan', $this->session->penempatan);
        $this->db->order_by('wp_pembayaran.id_transaksi', 'DESC');
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
		$this->db->where('wp_karyawan.penempatan', $this->session->penempatan);
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

    function laporan_tanggal($tanggal, $debt)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');

        if ($tanggal != 'semua') {
            $this->db->where('date(wp_pembayaran.tgl_bayar)', $tanggal);
        }
        // if ($dari != 'semua' && $ke != 'semua') {
        //     $this->db->where('month(wp_pembayaran.tgl_bayar)', $dari != 'semua');
        // }
        // if ($ke != 'semua' && $dari != 'semua') {
        //     $this->db->where('month(wp_pembayaran.tgl_bayar)', $ke != 'semua');
        // }
        // if ($ke != 'semua' && $dari != 'semua') {
        //     $this->db->where('month(wp_pembayaran.tgl_bayar) >=', $dari != 'semua');
        //     $this->db->where('month(wp_pembayaran.tgl_bayar) <=', $ke != 'semua');
        // }
        // if ($tahun != 'semua') {
        //     $this->db->where('year(wp_pembayaran.tgl_bayar)', $tahun != 'semua');
        // }
        if ($debt != 'semua') {
            $this->db->where('wp_pembayaran.username', $debt);
        }

        $this->db->order_by('wp_pembayaran.id_transaksi', 'DESC');
        return $this->db->get($this->table)->result();
        
    }
    function laporan_bulan($dari, $ke, $tahun, $debt)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');

        if ($dari != 'semua' && $ke == 'semua') {
            $this->db->where('month(wp_pembayaran.tgl_bayar)', $dari);
        }
        if ($ke != 'semua' && $dari == 'semua') {
            $this->db->where('month(wp_pembayaran.tgl_bayar)', $ke);
        }
        if ($ke != 'semua' && $dari != 'semua') {
            $this->db->where('month(wp_pembayaran.tgl_bayar) >=', $dari);
            $this->db->where('month(wp_pembayaran.tgl_bayar) <=', $ke);
        }
        if ($tahun != 'semua') {
            $this->db->where('year(wp_pembayaran.tgl_bayar)', $tahun);
        }
        if ($debt != 'semua') {
            $this->db->where('wp_pembayaran.username', $debt);
        }

        $this->db->order_by('wp_pembayaran.id_transaksi', 'DESC');
        return $this->db->get($this->table)->result();
        
    }
    function laporan_tahun($tahun, $debt)
    {
        $this->db->select('wp_pembayaran.id_transaksi, wp_transaksi.tgl_transaksi, DATE_ADD(wp_transaksi.tgl_transaksi, INTERVAL 14 DAY) as `jatuh_tempo`, wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_barang.nama_barang, wp_transaksi.qty, wp_barang.satuan, wp_pelanggan.kelurahan, wp_pelanggan.kecamatan, wp_pelanggan.no_telp, wp_karyawan.nama, b.nama as nama_debt, wp_transaksi.subtotal, wp_pembayaran.tgl_bayar, wp_pembayaran.bayar, wp_detail_transaksi.bayar as `jumlah_bayar`, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as `sisa_hutang`, wp_status.nama_status');
        $this->db->where('wp_pembayaran.bayar >=', 0);
        $this->db->join('wp_transaksi', 'wp_pembayaran.id_transaksi = wp_transaksi.id_transaksi');
        $this->db->join('wp_pelanggan', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id');
        $this->db->join('wp_barang', 'wp_transaksi.wp_barang_id = wp_barang.id');
        $this->db->join('wp_karyawan', 'wp_pelanggan.wp_karyawan_id_karyawan = wp_karyawan.id_karyawan');
        $this->db->join('wp_detail_transaksi', 'wp_pembayaran.id_transaksi = wp_detail_transaksi.id_transaksi');
        $this->db->join('wp_karyawan as b', 'b.id_karyawan = wp_transaksi.username', 'left');
        $this->db->join('wp_status', 'wp_status.id = wp_transaksi.wp_status_id');
        $this->db->order_by('wp_transaksi.id_transaksi', 'DESC');

        if ($tahun != 'semua') {
            $this->db->where('year(wp_pembayaran.tgl_bayar)', $tahun);
        }
        if ($debt != 'semua') {
            $this->db->where('wp_pembayaran.username', $debt);
        }

        $this->db->order_by('wp_pembayaran.id_transaksi', 'DESC');
        return $this->db->get($this->table)->result();
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
