<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  // public function get_events($start, $end)
  // {
  //   return $this->db
  //         ->where("start >=", $start)
  //         ->where("end <=", $end)
  //         ->get("wp_jadwal");
  // }
  Public function getEvents()
	{

	$sql = "SELECT * FROM v_event WHERE v_event.start BETWEEN ? AND ? ORDER BY v_event.start ASC";
	return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();

	}

  Public function addEvent()
	{

	$sql = "INSERT INTO wp_jadwal (title,wp_jadwal.start,wp_jadwal.end,description, color, wp_pelanggan_id, wp_barang_id, qty, wp_karyawan_id_karyawan) VALUES (?,?,?,?,?,?,?,?,?)";
	$this->db->query($sql, array($_POST['title'], $_POST['start'], $_POST['end'], $_POST['description'], $_POST['color'], $_POST['wp_pelanggan_id'], $_POST['wp_barang_id'], $_POST['qty'], $_POST['wp_karyawan_id_karyawan']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function updateEvent()
	{

	$sql = "UPDATE wp_jadwal SET title = ?, description = ?, color = ?, wp_pelanggan_id = ?, wp_barang_id = ?, qty = ?, wp_karyawan_id_karyawan = ? WHERE id = ?";
	$this->db->query($sql, array($_POST['title'], $_POST['description'], $_POST['color'], $_POST['wp_pelanggan_id'], $_POST['wp_barang_id'], $_POST['qty'], $_POST['id'], $_POST['wp_karyawan_id_karyawan']));
		return ($this->db->affected_rows()!=1)?false:true;
	}


	/*Delete event */

	Public function deleteEvent()
	{

	$sql = "DELETE FROM wp_jadwal WHERE id = ?";
	$this->db->query($sql, array($_GET['id']));
		return ($this->db->affected_rows()!=1)?false:true;
	}

	/*Update  event */

	Public function dragUpdateEvent()
	{
			//$date=date('Y-m-d h:i:s',strtotime($_POST['date']));

			$sql = "UPDATE wp_jadwal SET  wp_jadwal.start = ? ,wp_jadwal.end = ?  WHERE id = ?";
			$this->db->query($sql, array($_POST['start'],$_POST['end'], $_POST['id']));
		return ($this->db->affected_rows()!=1)?false:true;


	}

}
