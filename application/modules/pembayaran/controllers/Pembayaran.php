<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Pembayaran_model', 'pembayaran');
  }

  function index()
  {
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembayaran';
    $data['content']		='main';
    $this->load->view('panel/dashboard', $data);
  }

  public function ajax_list()
    {
        $list = $this->pembayaran->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pembayarans) {
            $row = array();
            $row[] = $pembayarans->id_transaksi;
            $row[] = tgl_indo($pembayarans->tgl_transaksi);
            $row[] = $pembayarans->id_pelanggan;
            $row[] = $pembayarans->nama_pelanggan;
            $row[] = number_format($pembayarans->utang,2,",",".");
            $row[] = number_format($pembayarans->bayar,2,",",".");
            $row[] = tgl_indo($pembayarans->tgl_bayar);
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pembayaran->count_all(),
                        "recordsFiltered" => $this->pembayaran->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
  }

  function transaksi()
  {
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pembayaran';
    $data['sub_judul']	='Form';
    $data['content']		='form';
    $this->load->view('panel/dashboard', $data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->pembayaran->cari_pelanggan($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
					'utang'	=> $row->sisa,
          'transaksi' => $row->id_transaksi,
          'id' => $row->id,
          'sudah' => $row->bayar,
          'jumlah' => $row->utang,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  public function update_action()
  {
    $test = str_replace(".","", $this->input->post('bayar'));
    $test2 = $this->input->post('sudah');
    $hasil = $test+$test2;
    $data = array(
        // 'id_suplier' => $this->input->post('id_suplier',TRUE),
        'bayar' => $hasil,
        'created_at' => date('Y-m-d'),
        );
    $this->pembayaran->update($this->input->post('id', TRUE), $data);
    $this->session->set_flashdata('message', 'Pembayaran berhasil !!!');
    redirect(site_url('dep'));
  }

}
