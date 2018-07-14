<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Effective_model extends CI_Model {

    
    function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_barang()
    {
        # code...
        return $this->db->get('wp_barang')->result();
    }
    
    function count($status, $sumber, $tgl, $nama)
    {
        # code...
        $this->db->select('count(wp_list_effectif.tanggal) as jumlah');
        $this->db->from('wp_list_effectif');
        $this->db->where('wp_status_effectif.status', $status);
        $this->db->where('wp_list_effectif.sumber_data', $sumber);
        $this->db->where('wp_list_effectif.tanggal', $tgl);
        if ($nama = !'semua') {
            # code...
            $this->db->where('wp_list_effectif.username', $nama);
        }
        $this->db->join('wp_status_effectif', 'wp_status_effectif.id = wp_list_effectif.wp_status_effectif_id');
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_fiter($status, $sumber, $tgl, $nama)
    {
        # code...
        $this->db->select('count(wp_list_effectif.tanggal) as jumlah');
        $this->db->from('wp_list_effectif');
        $this->db->where('wp_status_effectif.status', $status);
        $this->db->where('wp_list_effectif.sumber_data', $sumber);
        $this->db->where('wp_list_effectif.tanggal', $tgl);
        if ($nama !== 'semua') {
            # code...
            $this->db->where('wp_list_effectif.username', $nama);
        }
        $this->db->join('wp_status_effectif', 'wp_status_effectif.id = wp_list_effectif.wp_status_effectif_id');
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }
    //count barang

    function sum_barang($tgl, $id, $nama)
    {
        # code...
        $this->db->select('sum(wp_list_effectif.qty) as jumlah');
        $this->db->from('wp_list_effectif');
        $this->db->where('wp_list_effectif.tanggal', $tgl);
        $this->db->where('wp_list_effectif.barang', $id);
        if ($nama !== 'semua') {
            # code...
            $this->db->where('wp_list_effectif.username', $nama);
        }
        $this->db->join('wp_barang', 'wp_barang.nama_barang = wp_list_effectif.barang');
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function sum_all_barang($tgl, $nama)
    {
        # code...
        $this->db->select('sum(wp_list_effectif.qty) as jumlah');
        $this->db->from('wp_list_effectif');
        $this->db->where('wp_list_effectif.tanggal', $tgl);
        if ($nama !== 'semua') {
            # code...
            $this->db->where('wp_list_effectif.username', $nama);
        }
        $this->db->join('wp_barang', 'wp_barang.nama_barang = wp_list_effectif.barang');
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function count_barang()
    {
        # code...
        $this->db->select('count(id) as jumlah');
        $this->db->from('wp_barang');
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }   
    }

    function get_karyawan()
    {
        # code...
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_karyawan.wp_jabatan_id = wp_jabatan.id', 'inner');
        $this->db->where('wp_jabatan.nama_jabatan', 'Customer Service'); 
        return $this->db->get()->result();
    }

    //start sumber data

    function get_target($tar)
    {
        # code...
        $this->db->select('target as jumlah');
        $this->db->from('wp_target');
        $this->db->where('nama', $tar);
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }     
    }

    function get_act($tgl, $sumber, $nama)
    {
        # code...
        $this->db->select('count(*) as jumlah');
        $this->db->from('wp_list_effectif');
        $this->db->where('tanggal', $tgl);
        if ($sumber !== 'semua') {
            # code...
            $this->db->where('sumber_data', $sumber);            
        }
        if ($nama !== 'semua') {
            # code...
            $this->db->where('username', $nama);
        } 
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }    

}

/* End of file Effective_model.php */
