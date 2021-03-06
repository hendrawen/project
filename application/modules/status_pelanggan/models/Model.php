<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

    var $table = 'wp_pelanggan';
    var $column_order = array(null, 'id_pelanggan','nama_pelanggan','wp_pelanggan.no_telp','nama','kota','kecamatan','kelurahan'); //set column field database for datatable orderable
    var $column_search = array('id_pelanggan','nama_pelanggan','wp_pelanggan.no_telp','nama','kota','kecamatan','kelurahan', 'wp_status_effectif.status'); //set column field database for datatable searchable 
    var $order = array('wp_pelanggan.id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->select('wp_pelanggan.id_pelanggan, wp_pelanggan.nama_pelanggan, wp_pelanggan.no_telp, wp_pelanggan.kota, wp_pelanggan.kecamatan, wp_pelanggan.kelurahan, wp_karyawan.nama, wp_status_effectif.status');
        $this->db->DISTINCT();
        if($this->input->post('kota') !="")
        {
            $this->db->where('kota', $this->input->post('kota'));
        }
        if($this->input->post('kecamatan') !="")
        {
            $this->db->where('kecamatan', $this->input->post('kecamatan'));
        }
        $piutang = $this->input->post('piutang');
        if ($piutang != 'semua') {
            $this->db->where('(wp_detail_transaksi.utang- wp_detail_transaksi.bayar) >', 0);
        }
        if ($this->input->post('marketing') != 'semua') {
            $this->db->where('(wp_pelanggan.wp_karyawan_id_karyawan)', $this->input->post('marketing'));
        }
        $this->db->join('wp_list_effectif', 'wp_pelanggan_id = wp_pelanggan.id', 'left');
        $this->db->join('wp_status_effectif', 'wp_status_effectif.id = wp_list_effectif.wp_status_effectif_id', 'left');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
        $this->db->join('wp_transaksi', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'left');
        $this->db->join('wp_detail_transaksi', 'wp_detail_transaksi.id_transaksi = wp_transaksi.id_transaksi', 'left');
        
        $this->db->where('wp_pelanggan.status', 'Pelanggan');
        
        
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

    function get_month()
    {
        $month = array(
            array ('key' => 1, 'month' => 'Januari'),
            array ('key' => 2, 'month' => 'Februari'),
            array ('key' => 3, 'month' => 'Maret'),
            array ('key' => 4, 'month' => 'April'),
            array ('key' => 5, 'month' => 'Mei'),
            array ('key' => 6, 'month' => 'Juni'),
            array ('key' => 7, 'month' => 'Juli'),
            array ('key' => 8, 'month' => 'Agustus'),
            array ('key' => 9, 'month' => 'September'),
            array ('key' => 10, 'month' => 'Oktober'),
            array ('key' => 11, 'month' => 'November'),
            array ('key' => 12, 'month' => 'Desember'),
        );
        return $month;
    }

    function laporan_pelanggan_utang($id_pelanggan, $tahun)
    {
        $query1 ="SELECT DISTINCT wp_pelanggan.id_pelanggan, nama_pelanggan, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as piutang
        FROM
        wp_detail_transaksi
        INNER JOIN wp_pelanggan
        INNER JOIN wp_transaksi
        ON
        wp_pelanggan.id = wp_transaksi.wp_pelanggan_id AND
        wp_transaksi.id_transaksi = wp_detail_transaksi.id_transaksi AND
        wp_pelanggan.id_pelanggan = '$id_pelanggan'
        AND (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) >0";

        $query2 ="SELECT DISTINCT wp_pelanggan.id_pelanggan, nama_pelanggan, (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) as piutang
        FROM
        wp_detail_transaksi
        INNER JOIN wp_pelanggan
        INNER JOIN wp_transaksi
        ON
        wp_pelanggan.id = wp_transaksi.wp_pelanggan_id AND
        wp_transaksi.id_transaksi = wp_detail_transaksi.id_transaksi AND
        wp_pelanggan.id_pelanggan = '$id_pelanggan'
        AND (wp_detail_transaksi.utang - wp_detail_transaksi.bayar) >0
        AND (YEAR(wp_transaksi.tgl_transaksi) = '$tahun')
        ";
        $data = "";
        if ($tahun == 'semua') {
            $data = $this->db->query($query1)->row();
        } else {
            $data = $this->db->query($query2)->row();
        }
        $hasil = "";
        if ($data) {
        $hasil = $data->piutang;
        } else {
        $hasil = "0";
        }
        return $hasil;
    }

    function laporan_pelanggan_trx($id_pelanggan, $month, $tahun)
    {
        $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
        $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
        
        if ($tahun != 'semua') {
            $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $tahun);
        }

        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
        $data = $this->db->get('wp_transaksi')->num_rows();
        if ($data == 0) {
        return '0';
        } else {
        return $data;
        }
    }

    function laporan_pelanggan_qty($id_pelanggan, $month, $tahun)
    {
        $this->db->select('sum(wp_transaksi.qty) as `qty`');
        $this->db->where('wp_pelanggan.id_pelanggan', $id_pelanggan);
        if ($tahun != 'semua') {
            $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $tahun);
        }
        $this->db->where('MONTH(wp_transaksi.tgl_transaksi)', $month);
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
        $hasil = $this->db->get('wp_transaksi')->row();

        if ($hasil->qty != 0) {
        return $hasil->qty;
        } else {
        return '0';
        }
    }

    function get_laporan_excel($kota, $kecamatan, $marketing, $utang)
    {
        $this->db->select('id_pelanggan, nama_pelanggan, wp_pelanggan.no_telp, kota, kecamatan, kelurahan, wp_karyawan.nama');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_pelanggan.wp_karyawan_id_karyawan', 'inner');
        $this->db->join('wp_transaksi', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'left');
        $this->db->join('wp_detail_transaksi', 'wp_detail_transaksi.id_transaksi = wp_transaksi.id_transaksi', 'left');
        $this->db->where('wp_pelanggan.status', 'Pelanggan');
        if($kota != 'semua')
        {
            $this->db->where('kota', $kota);
        }
        if ($utang!= 'semua') {
            $this->db->where('(wp_detail_transaksi.utang- wp_detail_transaksi.bayar) >', 0);
        }
        if ($marketing != 'semua') {
            $this->db->where('(wp_pelanggan.wp_karyawan_id_karyawan)', $marketing);
        }
        if($kecamatan != 'semua')
        {
            $this->db->where('kecamatan', $kecamatan);
        }
        return $this->db->get($this->table)->result();
    }

    function get_last_transaction($id, $tahun)
    {
        $this->db->select('tgl_transaksi, nama_barang, qty');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
        $this->db->join('wp_barang', 'wp_barang.id = wp_transaksi.wp_barang_id', 'inner');
        $this->db->where('wp_pelanggan.id_pelanggan', $id);
        if ($tahun != 'semua') {
            $this->db->where('YEAR(tgl_transaksi)', $tahun);
        }
        $this->db->order_by('tgl_transaksi', 'desc');
        $this->db->from('wp_transaksi');
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    function get_follow_up($id, $tahun)
    {
        $this->db->select('wp_list_effectif.tanggal, wp_status_effectif.status');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_list_effectif.wp_pelanggan_id', 'inner');
        $this->db->join('wp_status_effectif', 'wp_status_effectif.id = wp_list_effectif.wp_status_effectif_id', 'inner');
        if ($tahun != 'semua') {
            $this->db->where('YEAR(tanggal)', $tahun);
        }
        $this->db->where('wp_pelanggan.id_pelanggan', $id);
        $this->db->order_by('tanggal', 'desc');
        $this->db->from('wp_list_effectif');
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    function get_marketing()
    {
        # code...
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_jabatan.id = wp_karyawan.wp_jabatan_id');
        return $this->db->get();
    }


}

/* End of file Market_model.php */
