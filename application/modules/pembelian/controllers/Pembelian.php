<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller{
  private $permit;
  private $temb_bayar;
  public function __construct()
  {
    $temb_bayar = array();
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    $this->load->model('Pembelian_model', 'pembelian');
  }

  function index()
  { 
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembelian';
    $data['content']		='transaksi2';
    $data['pembelian']    =$this->pembelian->get_data();
    $data['total_transaksi'] = $this->pembelian->total_transaksi();
    $data['transaksi_perbulan'] = $this->pembelian->transaksi_perbulan();
    $data['total_penjualan'] = $this->pembelian->total_penjualan();
    $data['penjualan_bulanan'] = $this->pembelian->penjualan_bulanan();
    $data['total_jadwal'] = $this->pembelian->gettotaljadwal();
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $this->load->view('panel/dashboard',$data);
  }

  public function checkout()
  { 
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembelian';
    $data['tgl_bayar']	=tgl_simpan2($this->input->post('tgl_bayar'));
    $data['content']		= 'checkout';
    $data['data']=$this->pembelian->get_all_product();
    $data['profile']=$this->pembelian->get_profile();
    $data['gudang'] = $this->pembelian->get_gudang();
    //$data['jenis_pembayaran']=$this->Pesan_model->get_jenis_pembayaran();
		$data['generate_invoice'] = $this->pembelian->generatekode_invoice();
    $data['get_total'] = $this->get_total();
    $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      
      
    $this->load->view('panel/dashboard', $data);
  }

  function piutang()
  { 
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Piutang';
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']		='content';
    $data['jadwal'] = $this->pembelian->getbydriver();
    $this->load->view('panel/dashboard',$data);
  }
  public function jadwal()
  {
    # code...
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Jadwal';
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']		='jadwal';
    $data['jadwal'] = $this->pembelian->getbydriver();
    $this->load->view('panel/dashboard',$data);
  }

  function list_pembelian()
  { 
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='List';
    $data['sub_judul']	='Transaksi';
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']		='list';
    $data['list'] = $this->pembelian->gettransaksiharian();
    $this->load->view('panel/dashboard',$data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->pembelian->cari_suplier($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_suplier,
					'nama_suplier'	=> $row->nama_suplier,
          'alamat' => $row->alamat,
          'id_suplier' => $row->id_suplier,
          'id' => $row->id,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  function get_auto(){
		if (isset($_GET['term'])) {
		  	$result = $this->Pembelian->cek_piutang($_GET['term']);
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
		  	$result = $this->Pembelian->update_piutang($_GET['term']);
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
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']		='detail';
    $data['detail'] = $this->pembelian->getdetail($id);
    $this->load->view('panel/dashboard',$data);
  }

  public function barang()
  { 
    $data = array(
            'button' => 'Simpan',
            'action' => site_url('pembelian/create_action'),
	    'id' => set_value('id'),
	    'id_transaksi' => set_value('id_transaksi'),
	    'wp_barang_id' => set_value('wp_barang_id'),
	    'tgl_transaksi' => set_value('tgl_transaksi'),
	    'qty' => set_value('qty'),
      'satuan' => set_value('satuan'),
	    'harga' => set_value('harga'),
      'subtotal' => set_value('subtotal'),
	    'updated_at' => set_value('updated_at'),
	   );

    $data['aktif']			='Kebutuhan';
    $data['title']			='Pembelian';
    $data['judul']			='Form';
    $data['sub_judul']		='Pembelian';
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']			= 'transaksi';
    $data['generate_invoice'] = $this->pembelian->generatekode_invoice();
    $this->load->view('panel/dashboard', $data);
  }

  function get_barang(){
		$kode=$this->input->post('id_barang');
		$data=$this->pembelian->get_data_barang_bykode($kode);
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
			'price' => $this->input->post('harga'),
			'qty' => $this->input->post('qty'),
      'wp_barang_id' => $this->input->post('id'),
      'wp_suplier_id' => $this->input->post('wp_suplier_id'),
      'subtotal' => $this->input->post('subtotal'),
      'satuan' => $this->input->post('satuan2'),
      //'id_transaksi' => $this->input->post('id_transaksi'),
		);
		$this->cart->insert($data);
		echo $this->show_cart();
	}

  function get_total()
	{
		# code...
		$total = 0;
		if ($this->cart->contents()) {
			foreach ($this->cart->contents() as $items) {
				$subtotal = $items['price'] * $items['qty'];
				$total += $subtotal;
			}
		}
		return $total;
	}

    function checkout_action() {
      $this->form_validation->set_rules('qty[]', 'qty', 'required|trim');
      $this->form_validation->set_rules('wp_barang_id[]', 'wp_barang_id', 'required|trim');
      $this->form_validation->set_rules('harga[]', 'harga', 'required|trim');
      $this->form_validation->set_rules('subtotal[]', 'subtotal', 'required|trim');
      $this->form_validation->set_rules('id', '	wp_suplier_id', 'required|trim');

      if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('message','Data belum lengkap !');
        $this->checkout(); // tampilkan apabila ada error
      }else{
          $id_transaksi = $this->pembelian->generatekode_invoice();
  				$wp_suplier_id = $this->input->post('id', true);

          $status = 'Belum Bayar';
          $tg = date('Y-m-d H-i-s');
          $tg2 = date('Y-m-d');

          $tgl_bayar = $this->input->post('tgl_bayar', true);
  				$result = array();
         foreach ($this->cart->contents() as $items) {
  					$result[] = array(
  						"id_transaksi" 		=> $id_transaksi,
  						"qty"          		=> $items['qty'],
  						"wp_barang_id"    => $items['wp_barang_id'],
  						"harga"       		=> $items['price'],
  						//"subtotal"       	=> $items['subtotal'][$key],
              "tgl_transaksi"   => $tgl_bayar,
  						"wp_suplier_id" 				=> $wp_suplier_id,
  						"satuan"				  => $items['satuan'],
              "subtotal"        => $items['subtotal'],
              //"status"        => $status,
              "username"        => $this->session->identity,
              "gudang"          => $this->input->post('gudang'),
  					);
        }
        $detail = array(
          'id_transaksi' => $id_transaksi,
          'utang' => $this->get_total(),
          'created_at' => date('Y-m-d'),

         );
         $pembayaran = array(
           'id_suplier' => $wp_suplier_id,
           'id_transaksi' => $id_transaksi,
           'tgl_bayar'  => $tgl_bayar,
           'username'   => $this->session->identity,
         );
          $this->db->insert('wp_pembayaranbarang', $pembayaran);
          $this->db->insert('wp_detail_transaksistok', $detail);
  				$res = $this->db->insert_batch('wp_transaksistok', $result); // fungsi dari codeigniter untuk menyimpan multi array
  				if($res){ $this->cart->destroy();
  					$this->session->set_flashdata('message','Transaksi berhasil !');
  					redirect('pembelian');
  				}else{
  					$this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
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
    $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
    $data['content']			= 'invoice';
    $data['profile']=$this->pesan->get_profile();
    $data['jenis_pembayaran']=$this->pesan->get_jenis_pembayaran();
    $data['cetak_invoice'] = $this->Pembelian->cetakinvoice($id);
    $data['idinvoice'] = $this->Pembelian->idinvoice($id);
    $data['total_invoice'] = $this->Pembelian->total_invoice($id);
    $data['status'] = $this->Pembelian->status($id);
    $this->load->view('Pembelian/dashboard', $data);
  }

  public function cek()
  {
    // # code...
    // echo $this->session->userdata('total_belanja');
    // echo '<br />';
    // echo $this->session->userdata('diskon');
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
      $row = $this->Pembelian->get_by_id($id);

      if ($row) {
          $this->Pembelian->delete($id);
          $this->session->set_flashdata('message', 'Hapus Data Success');
          redirect(site_url('pembelian/list'));
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('Pembelian/list'));
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
    $this->Pembelian->update($this->input->post('id', TRUE), $data);
    $this->session->set_flashdata('message', 'Pembayaran berhasil !!!');
    redirect(site_url('Pembelian'));
  }

  public function track_transaksi(){
      $cari = $this->input->post('judul');
      $this->session->unset_userdata('id_transaksi');
      $total = 0;
      $i = 0;
         $query = $this->Pembelian->get_track($cari);
         $sum = $this->Pembelian->sum_get_track($cari);
         $query2 = $this->Pembelian->get_min_track($cari);
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
    // print_r($list);
    // echo '<br />';
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
          $this->Pembelian->insert_pembayaran($data);
          $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
          // echo 'utang lunas, sisa : '.$jumlah_bayar;
          //update transaksi $list[$i]['id_transaksi'];
      } else {
        //$sisa = $list[$i]['sisa'] - $jumlah_bayar;
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'id_pelanggan' => $list[$i]['id_pelanggan'],
          'username' => $this->session->identity,
        );
        $this->Pembelian->insert_pembayaran($data);
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
        //
      }
      redirect(site_url('Pembelian/piutang'));

    }
  }

  public function delete($id)
     {  
       $row = $this->pembelian->get_by_id($id);

       if ($row) {
           $this->pembelian->delete($id);
           $this->session->set_flashdata('message', 'Hapus Data Sukses');
           redirect(site_url('pembelian'));
       } else {
           $this->session->set_flashdata('message', 'Record Tidak Ada');
           redirect(site_url('pembelian'));
       }
     }


}
