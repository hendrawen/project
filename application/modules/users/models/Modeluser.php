<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modeluser extends CI_Model
{
    public $table = 'users';
    public $id = 'id';
    public $order = 'ASC';

   /* var $table = 'users';
    var $column_order = array(null,'first_name','last_name','username','company','email','status',null); //set column field database for datatable orderable
    var $column_search = array('username','company','first_name','email'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order */

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

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

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function total_rows($q = NULL) {
        $this->db->like('id', $q);
    $this->db->or_like('first_name', $q);
    $this->db->or_like('last_name', $q);
    $this->db->or_like('username', $q);
    $this->db->or_like('company', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('phone', $q);
    $this->db->or_like('active', $q);
    /*$this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);*/
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('id', $q);
    $this->db->or_like('first_name', $q);
    $this->db->or_like('last_name', $q);
    $this->db->or_like('username', $q);
    $this->db->or_like('company', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('phone', $q);
    $this->db->or_like('active', $q);
    /*$this->db->or_like('created_at', $q);
    $this->db->or_like('updated_at', $q);*/
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function get(){
        return $this->db->get("users");
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}
