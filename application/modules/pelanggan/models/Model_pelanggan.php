<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pelanggan extends CI_Model{

     public $id = 'id';
     var $table = 'wp_vpelanggan';
     var $table2 = 'wp_pelanggan';
     var $column_order = array('id_pelanggan','nama_pelanggan','no_telp','nama_dagang','nama_kategori','alamat','photo_toko','kota','kelurahan','kecamatan','lat','long','status','nama','created_at', null); //set column field database for datatable orderable
     var $column_search = array('id_pelanggan','nama_pelanggan','nama_dagang','nama_kategori','alamat','kota','kelurahan','kecamatan','status','nama'); //set column field database for datatable searchable
     var $order = array('id_pelanggan' => 'DESC'); // default order

     public function __construct()
     {
         parent::__construct();
     }

     private function _get_datatables_query()
     {

        //add custom filter here
        if($this->input->post('kota'))
        {
            $this->db->where('kota', $this->input->post('kota'));
        }
        if($this->input->post('status'))
        {
            $this->db->like('status', $this->input->post('status'));
        }
        if($this->input->post('kelurahan'))
        {
            $this->db->like('kelurahan', $this->input->post('kelurahan'));
        }
        if($this->input->post('kecamatan'))
        {
            $this->db->like('kecamatan', $this->input->post('kecamatan'));
        }
        if($this->input->post('nama'))
        {
            $this->db->like('nama', $this->input->post('nama'));
        }
        if($this->input->post('nama_kategori'))
        {
            $this->db->like('nama_kategori', $this->input->post('nama_kategori'));
        }
        if($this->input->post('created_at'))
        {
            $this->db->like('month(created_at)', $this->input->post('created_at'));
        }
        if($this->input->post('tahun'))
        {
            $this->db->like('year(created_at)', $this->input->post('tahun'));
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

    public function get_by_id($id)
    {
        $this->db->from($this->table2);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        return $this->db->update($this->table2, $data);

    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table2);
    }

    public function get_list_kota()
    {
        $this->db->select('kota');
        $this->db->from($this->table);
        $this->db->order_by('kota','asc');
        $query = $this->db->get();
        $result = $query->result();

        $kota = array();
        foreach ($result as $row)
        {
            $kota[] = $row->kota;
        }
        return $kota;
    }

    public function get_list_status()
    {
        $this->db->select('status');
        $this->db->from($this->table);
        $this->db->order_by('status','asc');
        $query = $this->db->get();
        $result = $query->result();

        $status = array();
        foreach ($result as $row)
        {
            $status[] = $row->status;
        }
        return $status;
    }

    public function get_list_kelurahan()
    {
        $this->db->select('kelurahan');
        $this->db->from($this->table);
        $this->db->order_by('kelurahan','asc');
        $query = $this->db->get();
        $result = $query->result();

        $kelurahan = array();
        foreach ($result as $row)
        {
            $kelurahan[] = $row->kelurahan;
        }
        return $kelurahan;
    }

    public function get_list_kecamatan()
    {
        $this->db->select('kecamatan');
        $this->db->from($this->table);
        $this->db->order_by('kecamatan','asc');
        $query = $this->db->get();
        $result = $query->result();

        $kecamatan = array();
        foreach ($result as $row)
        {
            $kecamatan[] = $row->kecamatan;
        }
        return $kecamatan;
    }

    public function get_list_surveyor()
    {
        $this->db->select('nama');
        $this->db->from($this->table);
        $this->db->order_by('nama','asc');
        $query = $this->db->get();
        $result = $query->result();

        $surveyor = array();
        foreach ($result as $row)
        {
            $surveyor[] = $row->nama;
        }
        return $surveyor;
    }

    public function get_list_bulan()
    {
        $this->db->select('Month(created_at) as bulan');
        $this->db->from($this->table);
        $query = $this->db->get();
        $result = $query->result();

        $bulan = array();
        foreach ($result as $row)
        {
            $bulan[] = getBulan('1');
            $bulan[] = getBulan('2');
            $bulan[] = getBulan('3');
            $bulan[] = getBulan('4');
            $bulan[] = getBulan('5');
            $bulan[] = getBulan('6');
            $bulan[] = getBulan('7');
            $bulan[] = getBulan('8');
            $bulan[] = getBulan('9');
            $bulan[] = getBulan('10');
            $bulan[] = getBulan('11');
            $bulan[] = getBulan('12');
        }
        return $bulan;
    }

    function get_kebutuhan($id_pelanggan)
    {
      $this->db->from('wp_kebutuhan');
      $this->db->where('wp_kebutuhan.wp_pelanggan_id',$id_pelanggan);
      $this->db->join('wp_jkebutuhan', 'wp_jkebutuhan.id = wp_kebutuhan.wp_jkebutuhan_id', 'inner');
      $query = $this->db->get();
      return $query->result();
    }

    //BUAT MODEL MAX_KODE_MAHASISWA
   public function get_kode_pelanggan() {
    $tahun = date("Y");
    $kode = 'CBM';
    $query = $this->db->query("SELECT MAX(id_pelanggan) as max_id FROM wp_pelanggan");
    $row = $query->row_array();
    $max_id = $row['max_id'];
    $max_id1 =(int) substr($max_id,3,5);
    $kode_pelanggan = $max_id1 +1;
    $maxkode_pelanggan = $kode.''.sprintf("%04s",$kode_pelanggan);
    return $maxkode_pelanggan;
   }

   function get_kategori()
   {
     return $this->db->get('wp_kategori')->result();
   }

}
