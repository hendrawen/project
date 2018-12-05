<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produku extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produku_model', 'produk');
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
        $data['aktif']			='produk-sales';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Produk Sales Rekapitulation';
        $data['sub_judul']	    ='Data Produk Sales Rekapitulatio';
        $data['content']		='main';
        $this->load->view('panel/dashboard', $data);
    }

    public function ajax_list()
    {
        $list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $produks) {
            $row = array();
            $row[] = $produks->nama_kategori;
            $row[] = $produks->nama_barang;
            $row[] = $produks->qty;
            $row[] = number_format($produks->harga_beli,2,",",".");
            $row[] = number_format($produks->harga_jual,2,",",".");
            $row[] = number_format($produks->harga_jual-$produks->harga_beli,2,",",".");
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->produk->count_all(),
                        "recordsFiltered" => $this->produk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file Stok_opname.php */
