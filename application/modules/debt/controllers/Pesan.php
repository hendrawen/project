<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller{

  public function __construct()
  {
		parent::__construct();
		$this->load->model('Ion_auth_model');
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
        if (!$this->ion_auth->in_group('Debt')) {//cek admin ga?
          redirect('login','refresh');
        }
		}
    $this->load->model('Pesan_model');
  }

  public function index()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form Transaksi';
		$data['sub_judul']		='';
    $data['content']			= 'transaksi/main';
    $data['data']=$this->Pesan_model->get_all_product();
    $data['profile']=$this->Pesan_model->get_profile();
    $data['generate_invoice'] = $this->Pesan_model->generatekode_invoice();
    $this->load->view('dashboard', $data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->Pesan_model->cari_pelanggan($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
					'nama_pelanggan'	=> $row->nama_pelanggan,
          'alamat' => $row->alamat,
          'nama_dagang' => $row->nama_dagang,
          'no_telp' => $row->no_telp,
          'id' => $row->id,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  public function checkout()
  {	
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form Transaksi';
		$data['sub_judul']		='';
    $data['content']			= 'transaksi/checkout';
    $data['data']=$this->Pesan_model->get_all_product();
    $data['profile']=$this->Pesan_model->get_profile();
    $data['jenis_pembayaran']=$this->Pesan_model->get_jenis_pembayaran();
		$data['generate_invoice'] = $this->Pesan_model->generatekode_invoice();
		$data['get_total'] = $this->get_total();
    $this->load->view('dashboard', $data);
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
		if ($this->input->post('diskon') <= 0) {
				$harga = $this->input->post('harga_jual');
				$diskon = str_replace(".","", $this->input->post('diskon'));
				$data = array(
					'id' => $this->input->post('id_barang'),
					'name' => $this->input->post('nama_barang'),
					'price' => $this->input->post('harga_jual'),
					'qty' => $this->input->post('qty'),
					'diskon' => 0,
					'wp_barang_id' => $this->input->post('id'),
					'id_transaksi' => $this->input->post('id_transaksi'),
					'satuan' => $this->input->post('satuan'),
				);
		} else {
				$harga = $this->input->post('harga_jual');
				$diskon = str_replace(".","", $this->input->post('diskon'));
				$hasil = $harga - $diskon;
				$data = array(
					'id' => $this->input->post('id_barang'),
					'name' => $this->input->post('nama_barang'),
					'price' => $this->input->post('harga_jual'),
					'qty' => $this->input->post('qty'),
					'diskon' => $this->input->post('diskon'),
					'wp_barang_id' => $this->input->post('id'),
					'id_transaksi' => $this->input->post('id_transaksi'),
					'satuan' => $this->input->post('satuan'),
				);
		$newdata = array(
			'diskon'     =>  str_replace(".","", $this->input->post('diskon')),
		);
		$sesi = $this->session->set_userdata($newdata);
		}
		$this->cart->insert($data);
		echo $this->show_cart();
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
					$tg3 = $this->input->post('tgltransaksi', true);
  				$result = array();
  				foreach($kp AS $key => $val){
  					$result[] = array(
  						"id_transaksi" 		=> $_POST['id_transaksi'][$key],
  						"qty"          		=> $_POST['qty'][$key],
  						"wp_barang_id"    => $_POST['wp_barang_id'][$key],
  						"harga"       		=> $_POST['harga'][$key],
  						"subtotal"       	=> $_POST['subtotal'][$key],
              "wp_pelanggan_id" => $wp_pelanggan_id,
  						"tgl_transaksi" 				=> tgl_simpan2($tg3),
  						"wp_status_id"				=> $wp_status_id,
							"diskon"        => $this->input->post('diskon'),
              "username"      => $this->session->identity
  					);
					}
					$detail = array(
            'id_transaksi' => $this->input->post('id_transaksi_hutang', TRUE),
            'utang' => $this->input->post('hutang',TRUE),
            'bayar' => $this->input->post('bayar', TRUE),
            'created_at' => date('Y-m-d'),
            //'updated_at' => $this->input->post('updated_at',TRUE),
            //'created_at' => mdate($datestring, $time),
					 );
					$pembayaran = array(
						'id_transaksi' => $this->input->post('id_transaksi_hutang', true),
						'id_pelanggan' => $wp_pelanggan_id,
						'bayar' => $this->get_total(),
						'tgl_bayar' => tgl_simpan2($tg3),
						'username' => $this->session->identity
					);
					$this->db->insert('wp_detail_transaksi', $detail);
					$this->db->insert('wp_pembayaran', $pembayaran);
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('message','sukses !');
  					redirect('transaksi');
  				}else{
  					$this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
  				}
				}
				//status hutang
        else {
          $kp = $this->input->post('idpesan', true);
  				$wp_pelanggan_id = $this->input->post('id', true);
  				$wp_status_id = $this->input->post('wp_status_id', true);
  				$tg = date('Y-m-d H-i-s');
					$tg2 = date('Y-m-d');
					$tg3 = $this->input->post('tgltransaksi', true);
  				$result = array();
  				foreach($kp AS $key => $val){
  					$result[] = array(
  						"id_transaksi" 		=> $_POST['id_transaksi'][$key],
  						"qty"          		=> $_POST['qty'][$key],
  						"wp_barang_id"    => $_POST['wp_barang_id'][$key],
  						"harga"       		=> $_POST['harga'][$key],
  						"subtotal"       	=> $_POST['subtotal'][$key],
              "wp_pelanggan_id" => $wp_pelanggan_id,
  						"tgl_transaksi" 				=> tgl_simpan2($tg3),
  						"wp_status_id"				=> $wp_status_id,
              "diskon"        => $this->input->post('diskon'),
              "username"    => $this->session->identity
  					);
          }
          $data = array(
            'id_transaksi' => $this->input->post('id_transaksi_hutang', TRUE),
            'utang' => $this->input->post('hutang',TRUE),
            'bayar' => $this->input->post('bayar', TRUE),
            'created_at' => date('Y-m-d'),
            //'updated_at' => $this->input->post('updated_at',TRUE),
            //'created_at' => mdate($datestring, $time),
					 );
					$pembayaran = array(
						'id_transaksi' => $this->input->post('id_transaksi_hutang', true),
						'id_pelanggan' => $wp_pelanggan_id,
						'bayar' => $this->input->post('bayar', true),
						'tgl_bayar' => tgl_simpan2($tg3),
						'username' => $this->session->identity
					);
					$this->db->insert('wp_detail_transaksi', $data);
					$this->db->insert('wp_pembayaran', $pembayaran);
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('message','sukses !');
  					redirect('transaksi');
  				}else{
  					$this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
  				}
        }


  			}
  }

  public function cek()
  {
    # code...
    // $cart = $this->cart->contents();
		// print_r($cart);
		foreach($this->cart->contents() as $items) {
			if ($items['satuan'] == 'Krat') {
				echo $items['wp_barang_id'] ;  echo '&nbsp; : &nbsp;'; echo $items['qty']; echo '</br>';
			} else{
				echo "gagal";
			}

		}
  }

	function show_cart(){
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$qty = ($items['price'] - str_replace(".","",$items['diskon']));
			$total = ($qty * $items['qty']);
			$output .='
				<tr>
					<td>'.$items['id'].'</td>
					<td>'.$items['name'].'</td>
          <td>'.number_format($items['price'],2,",",".").'</td>
					<td><input type="text" name="qty[]" size="1" value="'.$items['qty'].'" style="border:0px;background:none;"></td>
					<td>'.$items['satuan'].'</td>
					<td>'.$items['diskon'].'</td>
					<td>'.number_format($total,2,",",".").'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart_admin btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
          <th colspan="6">Total</th>
          <th colspan="2">'.'Rp '.number_format($this->get_total(),2,",",".").'</th>
			</tr>
		';
		return $output;
	}

	function get_total()
	{
		# code...
		$total = 0;
		if ($this->cart->contents()) {
			foreach ($this->cart->contents() as $items) {
				$subtotal = $items['subtotal'] - (str_replace(".","",$items['diskon']) * $items['qty']);
				$total += $subtotal;
			}
		}
		return $total;
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

  function hapus_cart(){
    $this->cart->destroy();
    echo $this->show_cart();
  }

}
