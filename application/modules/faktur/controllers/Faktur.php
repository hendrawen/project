<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Faktur_model');
  }

  public function index()
  {
    $data['aktif']			='Faktur';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Cetak Faktur';
    $data['sub_judul']		='';
    $data['content']			= 'main';
    $data['query'] =$this->Faktur_model->get_transaksi();
    $data['data']=$this->Faktur_model->get_all_product();
    $data['profile']=$this->Faktur_model->get_profile();
    $data['generate_faktur'] = $this->Faktur_model->generatekode_faktur();
    $this->load->view('panel/dashboard', $data);
  }

  public function checkout()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form Transaksi';
    $data['sub_judul']	='';
    $data['content']		= 'checkout';
    $data['data']=$this->Faktur_model->get_all_product();
    $data['profile']=$this->Faktur_model->get_profile();
    $data['jenis_pembayaran']=$this->Faktur_model->get_jenis_pembayaran();
    $data['generate_invoice'] = $this->Faktur_model->generatekode_invoice();
    $this->load->view('panel/dashboard', $data);
  }

  function get_detail_transaksi(){
		$kode=$this->input->post('id_transaksi');
		$data=$this->Faktur_model->get_data_bykode($kode);
		echo json_encode($data);
	}

  function get_pelanggan(){
		$kode=$this->input->post('id_transaksi');
		$data=$this->Faktur_model->coba_lagi($kode);
		echo json_encode($data);
	}

  function add_to_cart(){
    $this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'required|trim');
    if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('message','Pilih Id Transaksi Dulu !');
      redirect('faktur'); // tampilkan apabila ada error
    }else{
    $input_utang = $this->input->post('utang');
    $input_bayar = $this->input->post('bayar');
    $hasil = $input_utang-$input_bayar;
		$data = array(
      'id'  => $this->input->post('id_transaksi'),
      'name' => $this->input->post('nama_barang'),
      'harga' => $this->input->post('harga'),
      'qty' => $this->input->post('qty'),
      'satuan' => $this->input->post('satuan'),
			'price' => $this->input->post('bayar'),
      'utang' => $this->input->post('utang'),
      'selisih' => $hasil,
      'wp_detail_transaksi_id' => $this->input->post('id'),
      'no_faktur' => $this->input->post('no_faktur'),
		);
		  $this->cart->insert($data);
		  echo $this->show_cart();
    }
  }

   function simpan_faktur()
    {
        $kp = $this->input->post('idfaktur',true);
        //$jatuh_tempo = $this->input->post('jatuh_tempo',true);
        $tg = date('Y-m-d H-i-s');
        $result = array();

          foreach((array) $kp as $key){
            $result[] = array(
              "wp_detail_transaksi_id" 	=> $_POST['wp_detail_transaksi_id'][$key],
              "no_faktur" 				=> $_POST['no_faktur'][$key],
              //'jatuh_tempo' 				=> $jatuh_tempo,
              "tgl_faktur"			=> $tg,
              'username' => $this->session->identity,
            );
            $res = $this->db->insert_batch('wp_faktur', $result); // fungsi dari codeigniter untuk menyimpan multi array
            if($res){
              $this->session->set_flashdata('message','sukses !');
              redirect('faktur');
            }else{
              $this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
            }
          }

    }
      function checkout_action() {
  			$this->form_validation->set_rules('qty[]', 'qty', 'required|trim');
  			$this->form_validation->set_rules('wp_barang_id[]', 'wp_barang_id', 'required|trim');
  			$this->form_validation->set_rules('harga[]', 'harga', 'required|trim');
  			$this->form_validation->set_rules('subtotal[]', 'subtotal', 'required|trim');
  			$this->form_validation->set_rules('id', '	wp_pelanggan_id', 'required|trim');
  			$this->form_validation->set_rules('wp_status_id', 'wp_status_id', 'required|trim');

  			if ($this->form_validation->run() == FALSE){
          $this->session->set_flashdata('message','Data belum lengkap !');
  				$this->checkout(); // tampilkan apabila ada error
  			}else{
          $status = $this->input->post('wp_status_id');
          //status lunas
          if ($status=="1")
          {
          $kp = $this->input->post('idpesan', true);
  				$wp_pelanggan_id = $this->input->post('id', true);
  				$wp_status_id = $this->input->post('wp_status_id', true);
  				$tg = date('Y-m-d H-i-s');
  				$tg2 = date('Y-m-d');
  				$result = array();
  				foreach($kp AS $key => $val){
  					$result[] = array(
  						"id_transaksi" 		=> $_POST['id_transaksi'][$key],
  						"qty"          		=> $_POST['qty'][$key],
  						"wp_barang_id"    => $_POST['wp_barang_id'][$key],
  						"harga"       		=> $_POST['harga'][$key],
  						"subtotal"       	=> $_POST['subtotal'][$key],
              "wp_pelanggan_id" => $wp_pelanggan_id,
  						"tgl_transaksi" 				=> $tg,
  						"wp_status_id"				=> $wp_status_id
  					);
          }
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('msg','sukses !');
  					redirect('transaksi');
  				}else{
  					$this->session->set_flashdata('msg','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
  				}
        }
        //status hutang
        else {
          $kp = $this->input->post('idpesan', true);
  				$wp_pelanggan_id = $this->input->post('id', true);
  				$wp_status_id = $this->input->post('wp_status_id', true);
  				$tg = date('Y-m-d H-i-s');
  				$tg2 = date('Y-m-d');
  				$result = array();
  				foreach($kp AS $key => $val){
  					$result[] = array(
  						"id_transaksi" 		=> $_POST['id_transaksi'][$key],
  						"qty"          		=> $_POST['qty'][$key],
  						"wp_barang_id"    => $_POST['wp_barang_id'][$key],
  						"harga"       		=> $_POST['harga'][$key],
  						"subtotal"       	=> $_POST['subtotal'][$key],
              "wp_pelanggan_id" => $wp_pelanggan_id,
  						"tgl_transaksi" 				=> $tg,
  						"wp_status_id"				=> $wp_status_id
  					);
          }
          $data = array(
            'id_transaksi' => $this->input->post('id_transaksi_hutang', TRUE),
            'utang' => $this->input->post('hutang',TRUE),
            'created_at' => date('Y-m-d'),
            //'updated_at' => $this->input->post('updated_at',TRUE),
            //'created_at' => mdate($datestring, $time),
           );
          $this->db->insert('wp_detail_transaksi', $data);
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('msg','sukses !');
  					redirect('transaksi');
  				}else{
  					$this->session->set_flashdata('msg','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
  				}
        }
      }

  }

  public function cek()
  {
    $cart = $this->cart->contents();
    print_r($cart);
  }

	function show_cart(){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
          <td>'.$items['name'].'</td>
          <td>'.number_format($items['harga'],2,",",".").'</td>
          <td>'.$items['qty'].'</td>
          <td>'.$items['satuan'].'</td>
          <td>'.number_format($items['utang'],2,",",".").'</td>
					<td>'.number_format($items['price'],2,",",".").'</td>
          <td>'.number_format($items['selisih'],2,",",".").'</td>
					<td class="action"><a id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-xs"><i class="fa fa-times"></i></a></td>
				</tr>
			';
		}
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
					<td><input type="hidden" name="wp_detail_transaksi_id[]" readonly value='.$items['id'].'></td>
				</tr>
			';
		}
		return $output;
	}

  function load_input()
  {
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

  function hapus_cart(){
    $this->cart->destroy();
    echo $this->show_cart();
  }

}
