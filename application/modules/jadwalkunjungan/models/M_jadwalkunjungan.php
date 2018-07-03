<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_jadwalkunjungan extends CI_Model {

          public $table = 'jadwal_kunjungan';
          public $id = 'id_jadwal';
          public $order = 'DESC';

        function getall(){
            $this->db->select('id_jadwal, nama_pelanggan, nama, tanggal_kunjungan, sumber_data, jadwal_kunjungan.keterangan, wp_pelanggan.id_pelanggan, wp_karyawan.id_karyawan');
            $this->db->from('jadwal_kunjungan');
            $this->db->join('wp_pelanggan', 'wp_pelanggan.id = jadwal_kunjungan.id_pelanggan');
            $this->db->join('wp_karyawan', 'wp_karyawan.id_karyawan = jadwal_kunjungan.id_karyawan');
            $data = $this->db->get();

            return $data->result();
        }

        // get data by id
        function get_by_id($id)
        {
            $this->db->where($this->id, $id);
            return $this->db->get($this->table)->row();
        }

        function get_data_pelanggan(){
          return $this->db->get('wp_pelanggan')->result();
        }

        function get_data_karyawan(){
          return $this->db->get('wp_karyawan')->result();
        }

        // insert data
        function insert($data)
        {
            $this->db->insert($this->table, $data);
        }

        // update data
        function update($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update($this->table, $data);
        }

        // delete data
        function delete($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete($this->table);
        }

    }
