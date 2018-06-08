<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dep extends CI_Controller{
  private $temb_bayar;
  public function __construct()
  {
    $temb_bayar = array();
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('dev')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    //Codeigniter : Write Less Do More
    $this->load->model('Dep_model', 'dep');
    $this->load->model('pesan/Pesan_model', 'pesan');
  }

  function index()
  {
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Dep';
    $data['content']		='main';
    $data['total_transaksi'] = $this->dep->total_transaksi();
    $data['transaksi_perbulan'] = $this->dep->transaksi_perbulan();
    $data['total_penjualan'] = $this->dep->total_penjualan();
    $data['penjualan_bulanan'] = $this->dep->penjualan_bulanan();
    $data['total_jadwal'] = $this->dep->gettotaljadwal();
    $this->load->view('dep/dashboard',$data);
  }

  function piutang()
  {
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Piutang';
    $data['content']		='content';
    $data['jadwal'] = $this->dep->getbydriver();
    $this->load->view('dep/dashboard',$data);
  }
  public function jadwal()
  {
    # code...
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Jadwal';
    $data['content']		='jadwal';
    $data['jadwal'] = $this->dep->getbydriver();
    $this->load->view('dep/dashboard',$data);
  }

  function list()
  {
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='List';
    $data['sub_judul']	='Transaksi';
    $data['content']		='list';
    $data['list'] = $this->dep->gettransaksiharian();
    $this->load->view('dep/dashboard',$data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->dep->cari_pelanggan($_GET['term']);
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

  function get_auto(){
		if (isset($_GET['term'])) {
		  	$result = $this->dep->cek_piutang($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  function get_auto_transaksi(){
		if (isset($_GET['term'])) {
		  	$result = $this->dep->update_piutang($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_transaksi,
					'utang'	=> $row->sisa,
          'pelanggan' => $row->id_pelanggan,
          'id' => $row->id,
          'sudah' => $row->bayar,
          'jumlah' => $row->utang,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  public function detail()
  {
    # code...
    $id = $this->uri->segment(3);
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Rincian';
    $data['sub_judul']	='Pengiriman';
    $data['content']		='detail';
    $data['detail'] = $this->dep->getdetail($id);
    $this->load->view('dep/dashboard',$data);
  }

  public function transaksi()
  {
    $data['aktif']			='Kebutuhan';
    $data['title']			='Transaksi';
    $data['judul']			='Form';
    $data['sub_judul']		='Transaki';
    $data['content']			= 'transaksi';
    $data['data']=$this->pesan->get_all_product();
    $data['profile']=$this->pesan->get_profile();
    $data['generate_invoice'] = $this->pesan->generatekode_invoice();
    $this->load->view('dep/dashboard', $data);
  }

  public function checkout()
  {
    $data['aktif']			='transaksi';
    $data['title']			='Transaksi';
    $data['judul']			='Transaksi';
    $data['sub_judul']		='Checkout';
    $data['content']			= 'checkout';
    $data['data']=$this->pesan->get_all_product();
    $data['profile']=$this->pesan->get_profile();
    $data['jenis_pembayaran']=$this->pesan->get_jenis_pembayaran();
    $data['generate_invoice'] = $this->pesan->generatekode_invoice();
    $cart = $this->cart->total() -  str_replace(".","", $this->input->post('diskon'));
    $newdata = array(
        'total_belanja'  => $cart,
        'diskon'     =>  str_replace(".","", $this->input->post('diskon')),
    );
    $sesi = $this->session->set_userdata($newdata);
    $this->load->view('dep/dashboard', $data);
  }

  function get_barang(){
		$kode=$this->input->post('id_barang');
		$data=$this->pesan->get_data_barang_bykode($kode);
		echo json_encode($data);
	}

  function get_pelanggan(){
		$kode=$this->input->post('id_pelanggan');
		$data=$this->pesan->get_data_pelanggan_bykode($kode);
		echo json_encode($data);
	}

  function add_to_cart(){
		$data = array(
			'id' => $this->input->post('id_barang'),
			'name' => $this->input->post('nama_barang'),
			'price' => $this->input->post('harga_jual'),
			'qty' => $this->input->post('qty'),
      'wp_barang_id' => $this->input->post('id'),
      'id_transaksi' => $this->input->post('id_transaksi'),
      'satuan' => $this->input->post('satuan'),
		);
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
  						"wp_status_id"				=> $wp_status_id,
              "diskon"        => $this->input->post('diskon'),
              "username"      => $this->session->identity
  					);
          }
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('message','Transaksi berhasil !');
  					redirect('dep/transaksi');
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
          $this->db->insert('wp_detail_transaksi', $data);
  				$res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){$this->cart->destroy();
  					$this->session->set_flashdata('message','Transaki berhasil !');
  					redirect('dep/transaksi');
  				}else{
  					$this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
  				}
        }

  			}
  }

  public function invoice()
  {
    # code...
    $id = $this->uri->segment(3);
    $data['aktif']			='transaksi';
    $data['title']			='Transaksi';
    $data['judul']			='Transaksi';
    $data['sub_judul']		='Invoice';
    $data['content']			= 'invoice';
    $data['profile']=$this->pesan->get_profile();
    $data['jenis_pembayaran']=$this->pesan->get_jenis_pembayaran();
    $data['cetak_invoice'] = $this->dep->cetakinvoice($id);
    $data['idinvoice'] = $this->dep->idinvoice($id);
    $data['total_invoice'] = $this->dep->total_invoice($id);
    $data['status'] = $this->dep->status($id);
    $this->load->view('dep/dashboard', $data);
  }

  public function cek()
  {
    # code...
    print_r($this->session->userdata('id_transaksi'));
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
          <td>'.$items['price'].'</td>
					<td><input type="text" name="qty[]" size="1" value="'.$items['qty'].'" style="border:0px;background:none;"></td>
          <td>'.$items['satuan'].'</td>
					<td>'.number_format($items['subtotal'],2,",",".").'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
          <th colspan="5">Total</th>
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

  function hapus_cart(){
    $this->cart->destroy();
    echo $this->show_cart();
  }

  public function hapus($id)
  {
      $row = $this->dep->get_by_id($id);

      if ($row) {
          $this->dep->delete($id);
          $this->session->set_flashdata('message', 'Hapus Data Success');
          redirect(site_url('dep/list'));
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('dep/list'));
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
    $this->dep->update($this->input->post('id', TRUE), $data);
    $this->session->set_flashdata('message', 'Pembayaran berhasil !!!');
    redirect(site_url('dep'));
  }

  public function track_transaksi(){
      $cari = $this->input->post('judul');
      $this->session->unset_userdata('id_transaksi');
      $total = 0;
      $i = 0;
         $query = $this->dep->get_track($cari);
         $sum = $this->dep->sum_get_track($cari);
         $query2 = $this->dep->get_min_track($cari);
            foreach ($query2 as $key) {
              $this->temb_bayar[$i]['id_transaksi']= $key->id_transaksi;
              $this->temb_bayar[$i]['sisa']= $key->sisa;
              $this->temb_bayar[$i]['id_pelanggan']= $key->id_pelanggan;
              $i++;

            ?>
           min_id_transaksi = <?php echo $this->session->userdata('id_transaksi') ?>
           <?php }
           $data =  $this->session->set_userdata('id_transaksi', $this->temb_bayar);
           ;
          foreach ($query as $key) { ?>
             <tr>
                 <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                 <td><?php echo $key->id_pelanggan ?></td>
                 <td><?php echo $key->nama_pelanggan ?></td>
                 <td><a class="btn btn-success btn-xs" href="<?php echo base_url('track_pembayaran/')?><?php echo $key->id_transaksi ?>"><?php echo $key->id_transaksi ?></a></td>
                 <td>Rp. <?php echo number_format($key->utang,2,",",".") ?></td>
                 <td><?php echo tgl_indo($key->tgl_bayar) ?></td>
                 <td>Rp. <?php echo number_format($key->bayar,2,",",".") ?></td>
                 <td>Rp. <?php echo number_format($key->sisa,2,",",".") ?></td>

             <tr>;
               <input type="hidden" id="id_track" class="form-control" value="<?php echo $key->id_pelanggan ?>" name="id_track" required="">
         <?php }
         ;
         foreach ($sum as $key) { ?>
            <tr>
             <th colspan="7">Total Hutang</th>
                <th colspan="1">Rp. <?php echo number_format($key->sisa,2,",",".") ?> </th>

            </tr>
            <?php }
  }

  public function track_pembayaran()
  {
    $list = $this->session->userdata('id_transaksi');
    print_r($list);
    echo '<br />';
    $jumlah_bayar = str_replace(".","", $this->input->post('bayar'));
    $sisa = 0;
    for ($i=0; $i < sizeof($list); $i++) {
      if ($jumlah_bayar > $list[$i]['sisa']) {
          $jumlah_bayar -= $list[$i]['sisa'];
          $data = array(
            'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
            'bayar' => $list[$i]['sisa'],
            'id_transaksi' => $list[$i]['id_transaksi'],
            'id_pelanggan' => $list[$i]['id_pelanggan'],
            'username' => $this->session->identity,
          );
          $this->dep->insert_pembayaran($data);
          $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
          // echo 'utang lunas, sisa : '.$jumlah_bayar;
          //update transaksi $list[$i]['id_transaksi'];
      } else if($jumlah_bayar <= $list[$i]['sisa']) {
        
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'id_pelanggan' => $list[$i]['id_pelanggan'],
          'username' => $this->session->identity,
        );
        $this->dep->insert_pembayaran($data);
        $jumlah_bayar =0;
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
        //
      }
    }
    $this->session->unset_userdata('id_transaksi');
    redirect(site_url('dep/piutang'));
  }

}
