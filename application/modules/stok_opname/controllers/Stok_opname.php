<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_opname extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main', 'main');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        
    }
    

    function index()
    {

        $barang = $this->main->get_barang();
        $temp = array();
        $index = 0;
        foreach ($barang as $row) {
            $temp[$index]['nama_barang'] = $row->nama_barang;
            $list_satuan = $this->main->num_rows($row->nama_barang);
            foreach ($list_satuan as $st) {
                $temp[$index]['satuan'][] = $st->satuan;
            }
            $index++;
        }

        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Opname Stok & Aset';
        $data['content']		='main';
        $data['barang'] = $temp;
        $data['satuan'] = $this->main->get_satuan();
        $data['jumlah_satuan'] = $this->main->count_satuan_rusak();
        $data['barangall'] = $this->main->get_barang_all();

        $this->load->view('panel/dashboard', $data);
    }

    function load_all()
    {
        $pesan = "";
        $total = 0;  
        $cek = $this->main->get_data();
        $barang = $this->main->get_barang_all();
        $satuan = $this->main->get_satuan();
        foreach ($cek->result() as $key) {
            # code...
            $pesan .= '<tr>
            <td class="text-center"><b>'.tgl_Indo(date('Y-m-d')).'</b></td>
            <td class="text-center"><b>'.$key->nama_gudang.'</b></td>';
            foreach ($barang as $value) {
                $pesan .= '
                <td class="text-center"><b>'.angka($this->main->get_stok($key->id, $value->id)).'</b></td>
                ';
            }

            foreach ($satuan as $sat) {
               $pesan .= '
               <td class="text-center"><b>'.angka($this->main->get_rusak($sat->wp_barang_id, $key->id)).'</b></td>
               ';
            }
                $pesan .= '
                <td class="text-center"><b>'.angka($this->main->get_aset_krat($key->id)).'</b></td>
                <td class="text-center"><b>'.angka($this->main->get_aset_btl($key->id)).'</b></td>
                ';
        } 
        echo $pesan;

    }

}

/* End of file Stok_opname.php */
