<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Hei extends CI_Controller {

    public function index()
    {
        $barang = $this->get_barang();
        
        $temp = array();
        $index = 0;
        foreach ($barang as $row) {
            $temp[$index]['nama_barang'] = $row->nama_barang;
            $list_satuan = $this->num_rows($row->nama_barang);
            foreach ($list_satuan as $st) {
                $temp[$index]['satuan'][] = $st->satuan;
            }
            $index++;
        }

        $data['aktif']			='Pelanggan';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
          $data['sub_judul']		='Pelanggan';
          $data['content']			= 'view_hei';
          $data['barang'] = $temp;
          $data['barangall'] = $this->get_barang_all();
          $this->load->view('panel/dashboard', $data);
        
    }

    function get_barang()
    {
        $this->db->select('distinct(id),nama_barang, satuan');
        $this->db->group_by('nama_barang');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result();   
    }

    function get_barang_all()
    {
        $this->db->select('id,nama_barang, satuan');
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('wp_barang')->result();   
    }

    function num_rows($value)
    {
        $this->db->select('satuan');
        $this->db->where('nama_barang', $value);
        return $this->db->get('wp_barang')->result();
    }

}

/* End of file Hei.php */
