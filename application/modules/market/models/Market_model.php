<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Market_model extends CI_Model {

    var $table = 'wp_pelanggan';
    var $column_order = array(null, 'kota','kecamatan','kelurahan'); //set column field database for datatable orderable
    var $column_search = array('kota','kecamatan','kelurahan'); //set column field database for datatable searchable 
    var $order = array('wp_pelanggan.id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
         
        $this->db->select('kota, kecamatan, kelurahan');
        $this->db->join('wp_transaksi', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'inner');
        
        $this->db->group_by('kelurahan');
        if($this->input->post('kota'))
        {
            $this->db->where('kota', $this->input->post('kota'));
        }
        if($this->input->post('kecamatan'))
        {
            $this->db->where('kecamatan', $this->input->post('kecamatan'));
        }
        if($this->input->post('tahun'))
        {
            $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $this->input->post('tahun'));
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
        $this->db->group_by('kelurahan');
        $query = $this->db->get();

        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->select('kota, kecamatan, kelurahan');
        $this->db->group_by('kelurahan');
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

    function count_customer($value)
    {
        $this->db->select('count(kelurahan) as `jumlah`');
        $this->db->where('kelurahan', $value);
        
        $result =  $this->db->get($this->table)->row();
        return $result->jumlah;
    }

    function count_active($kelurahan, $month)
    {
        $query = " SELECT count(kelurahan) as `jumlah` FROM `wp_pelanggan` 
            WHERE EXISTS (SELECT * from wp_transaksi WHERE wp_transaksi.wp_pelanggan_id = wp_pelanggan.id AND month(wp_transaksi.tgl_transaksi) = $month)
            and `wp_pelanggan`.`kelurahan` = '$kelurahan'";
        
        // $this->db->join('wp_transaksi', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'inner');
        // $this->db->where('wp_pelanggan.kelurahan', $kelurahan);
        // $this->db->where('month(wp_transaksi.tgl_transaksi)', $month);
        $result =  $this->db->query($query)->row();
        return $result->jumlah;
    }

    function count_qty($kelurahan, $month)
    {
        $this->db->select('count(wp_transaksi.id) as `jumlah`');
        $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
        $this->db->where('wp_pelanggan.kelurahan', $kelurahan);
        $this->db->where('month(wp_transaksi.tgl_transaksi)', $month);
        $result =  $this->db->get('wp_transaksi')->row();
        return $result->jumlah;
    }

    function get_laporan($tahun, $kota, $kecamatan)
    {
        $this->db->select('kota, kecamatan, kelurahan');
        $this->db->join('wp_transaksi', 'wp_transaksi.wp_pelanggan_id = wp_pelanggan.id', 'inner');
        $this->db->group_by('kelurahan');
        if($kota != 'all')
        {
            $this->db->where('kota', $kota);
        }
        if($kecamatan != 'all')
        {
            $this->db->where('kecamatan', $kecamatan);
        }
        if($tahun != 'all')
        {
            $this->db->where('YEAR(wp_transaksi.tgl_transaksi)', $tahun);
        }
        $this->db->from($this->table);
        return $this->db->get()->result();
        
    }

    

}

/* End of file Market_model.php */
