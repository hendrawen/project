<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_main extends CI_Model {


    function get_barang()
    {
        # code...
        $this->db->select('distinct(id),nama_barang, satuan');
        $this->db->group_by('nama_barang');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result(); 
    }

    function get_barang_all()
    {
        # code...
        $this->db->select('id,nama_barang, satuan');
        $this->db->order_by('nama_barang', 'asc');
		return $this->db->get('wp_barang')->result();
    }

    function get_satuan()
    {
        # code...
        $this->db->select('*');
        return $this->db->get('wp_debt_muat')->result();
    }

    function count_satuan_rusak()
    {
        # code...
        $this->db->select('count(satuan_rusak) as jumlah');
        $result =  $this->db->get('wp_debt_muat')->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function num_rows($value)
    {
        # code...
        $this->db->select('satuan');
        $this->db->where('nama_barang', $value);
        return $this->db->get('wp_barang')->result();
    }

    function get_data()
    {
        # code...
		$this->db->select('id, nama_gudang');
		$this->db->where('wp_gudang.cabang', $this->session->penempatan);
        return $this->db->get('wp_gudang');
    }

    function get_stok($gudang, $barang)
    {
        # code...
        $this->db->select('stok as jumlah');
        $this->db->from('wp_stok');
        $this->db->where('wp_gudang_id', $gudang);
        $this->db->where('wp_barang_id', $barang);
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }

    }

    function get_rusak($gudang, $barang)
    {
        # code...
        $this->db->select('rusak as jumlah');
        $this->db->from('wp_debt_muat');
        $this->db->where('wp_gudang_id', $gudang);
        $this->db->where('wp_barang_id', $barang);
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function get_aset_krat($gudang)
    {
        # code...
        $this->db->select('aset_krat as jumlah');
        $this->db->from('wp_aset');
        $this->db->where('gudang', $gudang);
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    function get_aset_btl($gudang)
    {
        # code...
        $this->db->select('aset_btl as jumlah');
        $this->db->from('wp_aset');
        $this->db->where('gudang', $gudang);
        $result =  $this->db->get()->row();
        if ($result) {
            return $result->jumlah;
        } else {
            return 0;
        }
    }

    // function get_rusak($gudang, $barang)
    // {
    //     # code...
    //     $this->db->select('field1, field2');
        
    // }
    

}

/* End of file Model_main.php */
