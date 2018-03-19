<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Pesan_model');
  }

  public function index()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form Transaksi';
    $data['sub_judul']		='';
    $data['content']			= 'main';
    $data['data']=$this->Pesan_model->get_all_product();
    $data['profile']=$this->Pesan_model->get_profile();
    $data['generate_invoice'] = $this->Pesan_model->generatekode_invoice();
    $this->load->view('panel/dashboard', $data);
  }

  public function checkout()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form Transaksi';
    $data['sub_judul']		='';
    $data['content']			= 'checkout';
    $data['data']=$this->Pesan_model->get_all_product();
    $data['profile']=$this->Pesan_model->get_profile();
    $data['generate_invoice'] = $this->Pesan_model->generatekode_invoice();
    $this->load->view('panel/dashboard', $data);
  }

  function get_barang(){
		$kode=$this->input->post('id_barang');
		$data=$this->Pesan_model->get_data_barang_bykode($kode);
		echo json_encode($data);
	}

  function get_pelanggan(){
		$kode=$this->input->post('id_pelanggan');
		$data=$this->Pesan_model->get_data_pelanggan_bykode($kode);
		echo json_encode($data);
	}

  function add_to_cart(){
		$data = array(
			'id' => $this->input->post('id_barang'),
			'name' => $this->input->post('nama_barang'),
			'price' => $this->input->post('harga_jual'),
			'qty' => $this->input->post('qty'),
		);
		$this->cart->insert($data);
		echo $this->show_cart();
	}

	function show_cart(){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$items['id'].'</td>
					<td>'.$items['name'].'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal'],2,",",".").'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-xs">Cancel</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
          <th colspan="3">Total</th>
          <th colspan="2">'.'Rp '.number_format($this->cart->total(),2,",",".").'</th>
			</tr>
		';
		return $output;
	}

	function load_cart(){
		echo $this->show_cart();
	}

  function input_cart(){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td><input type="hidden" name="wp_barang_id[]" readonly value='.$items['id'].'></td>
				</tr>
			';
		}
		return $output;
	}

  function load_input()
  {
    # code...
    echo $this->input_cart();
  }

	function delete_cart(){
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0,
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

}
