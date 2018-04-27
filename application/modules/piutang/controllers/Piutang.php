<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin') AND !$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    //Codeigniter : Write Less Do More
    $this->load->model('Piutang_model' ,'piutang');
  }

  function index()
  {
    $data['aktif']			='Piutang';
		$data['title']			='Piutang Pelanggan';
		$data['judul']			='Data Piutang Pelanggan';
		$data['sub_judul']		='';
    $data['content']			= 'main';
    $this->load->view('panel/dashboard', $data);
  }

  function pembayaran()
  {
    $data['aktif']			='Piutang';
		$data['title']			='Piutang Pelanggan';
		$data['judul']			='Data Piutang Pelanggan';
		$data['sub_judul']		='';
    $data['content']			= 'form';
    $this->load->view('panel/dashboard', $data);
  }

  public function ajax_list()
    {
        $list = $this->piutang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $piutangs) {
            $row = array();
            $row[] = $piutangs->id_transaksi;
            $row[] = $piutangs->id_pelanggan;
            $row[] = $piutangs->nama_pelanggan;
            $row[] = number_format($piutangs->utang,2,",",".");
            $row[] = number_format($piutangs->bayar,2,",",".");
            $row[] = number_format($piutangs->sisa,2,",",".");
            $row[] = tgl_indo($piutangs->tgl_transaksi);
            $row[] = tgl_indo($piutangs->jatuh_tempo);
            $row[] = $piutangs->selisih;


            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->piutang->count_all(),
                        "recordsFiltered" => $this->piutang->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}
