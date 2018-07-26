<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_model extends CI_Model {

    var $table = 'wp_kas';
    var $column_order = array(null, 'wp_kas.tanggal','wp_gudang.nama_gudang','wp_kas.username','wp_karyawan.nama','wp_kategori_kas.nama as nama_kategori','wp_kas.pendapatan','wp_kas.pengeluaran'); //set column field database for datatable orderable
    var $column_search = array('wp_kas.tanggal','nama_gudang','wp_kas.username','wp_karyawan.nama','wp_kategori_kas.nama as nama_kategori','pendapatan','pengeluaran'); //set column field database for datatable searchable
    var $order = array('wp_kas.id_kas' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $hari = $this->input->post('hari');
        $bulan1 = $this->input->post('bulan1');
        $bulan2 = $this->input->post('bulan2');
        $tahun = $this->input->post('tahun');
        $kantor = $this->input->post('kantor');
        
        if ($this->input->post('hari')) {
            $this->db->where('date(wp_kas.tanggal)', $this->input->post('hari'));
        }

        if ($bulan1 && !$bulan2) {
            $this->db->where('month(wp_kas.tanggal)', $bulan1);
        }

        if ($bulan2 && !$bulan1) {
            $this->db->where('month(wp_kas.tanggal)', $bulan2);
        }

        if ($bulan1 && $bulan2) {
            $this->db->where('month(wp_kas.tanggal) >=', $bulan1);
            $this->db->where('month(wp_kas.tanggal) <=', $bulan2);
        }

        if ($tahun) {
            $this->db->where('year(wp_kas.tanggal)', $tahun);
        }

        if ($kantor) {
            $this->db->where('wp_gudang.id', $kantor);
        }
        
        $this->db->select('wp_kas.*, wp_karyawan.nama, wp_kategori_kas.nama as nama_kategori, wp_gudang.nama_gudang');
        $this->db->join('wp_gudang', 'wp_gudang.id = wp_kas.id_kantor', 'inner');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_kas.id_karyawan', 'inner');
        $this->db->join('wp_kategori_kas', 'wp_kategori_kas.id = wp_kas.id_kategori', 'inner');
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
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id_kas', $id);
        $this->db->delete($this->table);
    }

    function get_karyawan()
    {
        $this->db->select('id_karyawan, nama');
        return $this->db->get('wp_karyawan')->result();
    }

    function get_kantor()
    {
        $this->db->select('id, nama_gudang');
        return $this->db->get('wp_gudang')->result();
    }

    function get_kategori()
    {
        $this->db->select('id as id_kategori,nama as nama_kategori');
        return $this->db->get('wp_kategori_kas')->result();
    }

    function get_by_id($id)
    {
        $this->db->where('id_kas', $id);
        return $this->db->get($this->table)->row();
    }

    function get_saldo()
    {
        $this->db->select('sum(pendapatan) - sum(pengeluaran) as saldo');
        $result = $this->db->get('wp_kas')->row();
        return $result->saldo;
    }


    function get_all(){
      return $this->db->get('wp_kategori_kas')->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert('wp_kategori_kas', $data);
    }

    // get data by id
    function getby_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('wp_kategori_kas')->row();
    }

    // update data
    function update_kas($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('wp_kategori_kas', $data);
    }

    public function delete_kas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wp_kategori_kas');
    }


}

/* End of file Kas_model.php */
