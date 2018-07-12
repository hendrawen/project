<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Debt extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
        $this->load->model('Model_debt', 'debt');
        
    }
    

    function index()
    {
        $cek = get_permission('Effectif Call', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Report Harian Debt';
        $data['content']		='main';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['getbarang']         = $this->debt->get_barang();
        $this->load->view('panel/dashboard', $data);
    }

    function get_autocomplete(){
		if (isset($_GET['term'])) {
            $result = $this->debt->cari_pelanggan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'			=> $row->id_pelanggan,
                    );
                    echo json_encode($arr_result);
            }
        }
    }

    function get_autocomplete_driver(){
		if (isset($_GET['term'])) {
            $result = $this->debt->cari_driver($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'			=> $row->nama,
                    );
                    echo json_encode($arr_result);
            }
        }
    }

    function get_autocomplete_debt(){
		if (isset($_GET['term'])) {
            $result = $this->debt->cari_debt($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'			=> $row->nama,
                    );
                    echo json_encode($arr_result);
            }
        }
    }
    
    function track_faktur()
    {
      $cari = $this->input->post('judul');
      $total = 0;
      $pesan = "";
      $i = 0;
         $query = $this->debt->get_track($cari);
         if ($query->num_rows() !== 0) {
             # code...
            foreach ($query->result() as $key) {
                $data = array(
                    'id'              => $key->id_transaksi,
                    'id_pelanggan'    => $key->id_pelanggan,
                    'name'            => $key->nama_pelanggan,
                    'nama_barang'     => $key->nama_barang,
                    'qty'             => $key->qty,
                    'satuan'          => $key->satuan,
                    'nama'            => $key->nama,
                    'price'           => $key->jumlah,
                ); 
                $this->cart->insert($data);
            }
         }
    }

    function get_list()
    {
        $total = 0;
        $pesan = "";
        foreach ($this->cart->contents() as $row) {
            $pesan .='
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['id_pelanggan'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['nama_barang'].'</td>
                <td>'.$row['qty'].'</td>
                <td>'.$row['satuan'].'</td>
                <td>'.$row['nama'].'</td>
                <td>'.$row['price'].'</td>
                <td></td>
                <td></td>
            <tr>
        ';
        $total +=$row['price'];
        }
        $pesan .='
        <tr>
                <td colspan="7"><b>Jumlah</b></td>
                <td>'.$total .'
                </td>
                <td></td>
                <td></td>
        </tr>
        ';
        echo $pesan;
    }

    function get_list_belakang()
    {
        $total = 0;
        $pesan = "";
        foreach ($this->cart->contents() as $row) {
            $pesan .='
            <tr>
                <td>'.$row['id_pelanggan'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['nama_barang'].'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <tr>
        ';
        $total +=$row['price'];
        }
        $pesan .='
        <tr>
                <td colspan="3"><b>Jumlah</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
        </tr>
        ';
        echo $pesan;
    }

    function cek()
    {
        # code...
        print_r($this->cart->contents());
    }

    function hapus()
    {
        # code...
        $this->cart->destroy();
    }

    function belakang()
    {
        # code...
        $cek = get_permission('Effectif Call', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Report Harian Debt';
        $data['content']		='belakang';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

}

/* End of file Debt.php */
