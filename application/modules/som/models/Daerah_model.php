<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daerah_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

	public function get_kota()
	{
    $query = $this->db->get('kabupaten');
    return $query->result();
	}

	public function get_kecamatan($id_kab)
	{
    $this->db->where('id_kab', $id_kab);
	  $query = $this->db->get('kecamatan');
    return $query->result();
	}

	public function get_kelurahan($id_kec)
	{
    $this->db->where('id_kec', $id_kec);
    $query = $this->db->get('kelurahan');
    return $query->result();
	}
}
