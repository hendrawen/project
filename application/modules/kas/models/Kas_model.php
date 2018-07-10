<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_model extends CI_Model {

    var $table = 'wp_kas';
    var $column_order = array(null, 'tanggal','nama_gudang','wp_kas.username','wp_karyawan.nama','wp_kategori.nama_kategori','pendapatan','pengeluaran'); //set column field database for datatable orderable
    var $column_search = array('tanggal','nama_gudang','wp_kas.username','wp_karyawan.nama','wp_kategori.nama_kategori','pendapatan','pengeluaran'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function laporan_kas_harian($day, $id_kantor)
    {
      $this->db->select('*');
      $this->db->from('wp_kas');
      $this->db->where('wp_kas.tanggal', $day);
      $this->db->where('wp_kas.id_kantor', $id_kantor);
      $this->db->join('wp_gudang', 'wp_gudang.id = wp_kas.id_kantor');
      $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_kas.id_karyawan');
      $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_kas.id_kategori');
      $this->db->order_by('wp_kas.id_kas', 'DESC');
      $data = $this->db->get();
      return $data->result();
    }

    function laporan_kas_bulanan($from, $to, $year, $id_kantor)
    {
      $this->db->select('*');
      $this->db->from('wp_kas');
      $this->db->where('month(wp_kas.tanggal) >=', $from);
      $this->db->where('month(wp_kas.tanggal) <=', $to);
      $this->db->where('year(wp_kas.tanggal)', $year);
      $this->db->where('wp_kas.id_kantor', $id_kantor);
      $this->db->join('wp_gudang', 'wp_gudang.id = wp_kas.id_kantor');
      $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_kas.id_karyawan');
      $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_kas.id_kategori');
      $this->db->order_by('wp_kas.id_kas', 'DESC');
      $data = $this->db->get();
      return $data->result();
    }

    function laporan_kas_tahunan($year, $id_kantor)
    {
      $this->db->select('*');
      $this->db->from('wp_kas');
      $this->db->where('year(wp_kas.tanggal)', $year);
      $this->db->where('wp_kas.id_kantor', $id_kantor);
      $this->db->join('wp_gudang', 'wp_gudang.id = wp_kas.id_kantor');
      $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_kas.id_karyawan');
      $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_kas.id_kategori');
      $this->db->order_by('wp_kas.id_kas', 'DESC');
      $data = $this->db->get();
      return $data->result();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $this->db->join('wp_gudang', 'wp_gudang.id = wp_kas.id_kantor', 'inner');
        $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = wp_kas.id_karyawan', 'inner');
        $this->db->join('wp_kategori', 'wp_kategori.id_kategori = wp_kas.id_kategori', 'inner');

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
        $this->db->select('id_kategori, nama_kategori');
        return $this->db->get('wp_kategori')->result();
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
