<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{   
    private $permit;
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Transaksi_model');
        $this->load->model('pesan/Pesan_model','pesan');
        $this->load->library('form_validation');
    }

    function tes()
    {
      print_r($this->Transaksi_model->get_all());

    }
    public function index()
    {   
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'transaksi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transaksi/index.html';
            $config['first_url'] = base_url() . 'transaksi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaksi_model->total_rows($q);
        $transaksi = $this->Transaksi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_data' => $transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Transaksi';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['content']		='transaksi_list';
        $data['transaksi']    =$this->Transaksi_model->get_data();

        $this->load->view('panel/dashboard', $data);

    }

    public function read($id)
    {   
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_transaksi' => $row->id_transaksi,
		'wp_barang_id' => $row->wp_barang_id,
		'harga' => $row->harga,
		'qty' => $row->qty,
		//'satuan' => $row->satuan,
		'tgl_transaksi' => $row->tgl_transaksi,
		'updated_at' => $row->updated_at,
		'wp_pelanggan_id' => $row->wp_pelanggan_id,
		'username' => $row->username,
		'wp_status_id' => $row->wp_status_id,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail Transaksi';
            $data['menu']			= $this->permit[0];
            $data['submenu']		= $this->permit[1];
            $data['content']		='transaksi_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('transaksi'));
        }
    }

    public function create()
    {   
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('transaksi/create_action'),
	    'id' => set_value('id'),
	    'id_transaksi' => set_value('id_transaksi'),
	    'wp_barang_id' => set_value('wp_barang_id'),
	    'harga' => set_value('harga'),
	    'qty' => set_value('qty'),
	    //'satuan' => set_value('satuan'),
	    'tgl_transaksi' => set_value('tgl_transaksi'),
	    'updated_at' => set_value('updated_at'),
	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
	    'username' => set_value('username'),
	    'wp_status_id' => set_value('wp_status_id'),
	);
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Tambah Transaksi';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['content']		='transaksi_form';
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'id_transaksi' => $this->Transaksi_model->buat_kode(),
        		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
        		'harga' => $this->input->post('harga',TRUE),
        		'qty' => $this->input->post('qty',TRUE),
        		//'satuan' => $this->input->post('satuan',TRUE),
        		'tgl_transaksi' => date('Y-m-d H:i:s'),
        		//'updated_at' => $this->input->post('updated_at',TRUE),
        		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
        		'username' => $this->session->identity,
        		'wp_status_id' => $this->input->post('wp_status_id',TRUE),
         );
            $this->Transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('transaksi'));
        }
    }

    public function update($id)
    {   
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
            		'id' => set_value('id', $row->id),
            		'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
            		'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
            		'harga' => set_value('harga', $row->harga),
            		'qty' => set_value('qty', $row->qty),
            		//'satuan' => set_value('satuan', $row->satuan),
            		'tgl_transaksi' => set_value('tgl_transaksi', $row->tgl_transaksi),
            		'updated_at' => set_value('updated_at', $row->updated_at),
            		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
            		'username' => $this->session->identity,
            		'wp_status_id' => set_value('wp_status_id', $row->wp_status_id),
        	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit Transaksi';
            $data['menu']			= $this->permit[0];
            $data['submenu']		= $this->permit[1];
            $data['content']		='transaksi_form';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		//'id_transaksi' => $this->input->post('id_transaksi',TRUE),
		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		//'satuan' => $this->input->post('satuan',TRUE),
		//'tgl_transaksi' => $this->input->post('tgl_transaksi',TRUE),
		'updated_at' => date('Y-m-d H:i:s'),
		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
		'username' => $this->input->post('username',TRUE),
		'wp_status_id' => $this->input->post('wp_status_id',TRUE),
	    );

            $this->Transaksi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('transaksi'));
        }
    }

    public function delete($id)
    {   
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('transaksi'));
        }
    }

    function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->Transaksi_model->cari_pelanggan($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
					'id_pelanggan' => $row->id_pelanggan,
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
    
    public function update2($id){
        $this->cart->destroy();
        $data3 = $this->Transaksi_model->get_transaksi($id);
            foreach ($data3 as $key) {
                $data2 = array(
                    'id' => $key->id_barang,
                    'name' => $key->nama_barang,
                    'price' => $key->harga,
                    'qty' => $key->qty,
                    'diskon' => $key->diskon,
                    'wp_barang_id' => $key->id,
                    'satuan' => $key->satuan,
                    );							
                $this->cart->insert($data2);
                }

            foreach ($data3 as $value) {
                $data = array(
                    'id_transaksi' => $value->id_transaksi,
                    'id_pelanggan' => $value->id_pelanggan,
                    'nama_pelanggan' => $value->nama_pelanggan,
                    'nama_dagang' => $value->nama_dagang,
                    'alamat' => $value->alamat,
                    'no_telp' => $value->no_telp,
                    'nama_status' => $value->nama_status,
                    'nama_gudang' => $value->nama_gudang,
                    'bayar' => $value->bayar,
                    'wp_pelanggan_id' => $value->wp_pelanggan_id,
                    
                    );
            }
                $data['aktif']			='Kebutuhan';
                $data['title']			='Transaksi';
                $data['judul']			='Form Transaksi';
                $data['sub_judul']		='';
                $data['menu']			= $this->permit[0];
                $data['submenu']		= $this->permit[1];
                $data['content']	    = 'edit';
                $data['data']           = $this->Transaksi_model->get_all_product();
                $data['profile']        = $this->Transaksi_model->get_profile();
                $data['generate_invoice'] = $this->Transaksi_model->generatekode_invoice();
                $this->load->view('panel/dashboard', $data);            
    }

    public function checkout()
    {	
        $data2 = $this->Transaksi_model->get_transaksi($this->session->userdata('id_transaksi_sess'));
        foreach ($data2 as $value) {
            $data = array(
                'id_transaksi' => $value->id_transaksi,
                'id_pelanggan' => $value->id_pelanggan,
                'nama_pelanggan' => $value->nama_pelanggan,
                'nama_dagang' => $value->nama_dagang,
                'alamat' => $value->alamat,
                'no_telp' => $value->no_telp,
                'nama_status' => $value->nama_status,
                'nama_gudang' => $value->nama_gudang,
                'bayar' => $value->bayar,
                'wp_pelanggan_id' => $value->wp_pelanggan_id,
                );
        }
        
        $data['aktif']			='Kebutuhan';
        $data['title']			='Transaksi';
        $data['judul']			='Form Transaksi';
        $data['sub_judul']		='';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $data['content']		= 'checkout';
        $data['data']=$this->Transaksi_model->get_all_product();
        $data['profile']=$this->Transaksi_model->get_profile();
        $data['gudang']= $this->Transaksi_model->get_gudang();
        $data['jenis_pembayaran']=$this->Transaksi_model->get_jenis_pembayaran();
        $data['generate_invoice'] = $this->Transaksi_model->generatekode_invoice();
        $data['get_total'] = $this->get_total3();
        $this->load->view('panel/dashboard', $data);
    }

    function get_barang(){
		$kode=$this->input->post('id_barang');
		$data=$this->Transaksi_model->get_data_barang_bykode($kode);
		echo json_encode($data);
	}

  function get_pelanggan(){
		$kode=$this->input->post('id_pelanggan');
		$data=$this->Transaksi_model->get_data_pelanggan_bykode($kode);
		echo json_encode($data);
	}

  function add_to_cart(){
		$data = array(
			'id' => $this->input->post('id_barang'),
			'name' => $this->input->post('nama_barang'),
			'price' => $this->input->post('harga_jual'),
            'qty' => $this->input->post('qty'),
            'diskon' => 0,
            'wp_barang_id' => $this->input->post('id'),
            'id_transaksi' => $this->input->post('id_transaksi'),
            'satuan' => $this->input->post('satuan'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id'),
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'alamat' => $this->input->post('alamat'),
            'nama_dagang' => $this->input->post('nama_dagang'),
            'no_telp' => $this->input->post('no_telp'),
            'bayar' => $this->input->post('bayar'),
		);
		$this->cart->insert($data);
		echo $this->show_cart3();
    }
    
    function show_cart3(){
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
        <th colspan="2">'.'Rp '.number_format($this->get_total3(),2,",",".").'</th>
            </tr>
        ';
        return $output;
    }

    function get_total3()
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

    function load_cart3(){
        echo $this->show_cart3();
    }

    function delete_cart(){
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0,
		);
		$this->cart->update($data);
		echo $this->show_cart3();
	}

  function hapus_cart(){
        $this->cart->destroy();
        echo $this->show_cart3();
    }

    function checkout_action() {
        $this->form_validation->set_rules('qty[]', 'qty', 'required|trim');
        $this->form_validation->set_rules('wp_barang_id[]', 'wp_barang_id', 'required|trim');
        $this->form_validation->set_rules('harga[]', 'harga', 'required|trim');
        $this->form_validation->set_rules('subtotal[]', 'subtotal', 'required|trim');
        $this->form_validation->set_rules('id', 'wp_pelanggan_id', 'required|trim');
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
                    "tgl_transaksi" => tgl_simpan2($tg3),
                    "wp_status_id"	=> $wp_status_id,
                    "diskon"        => $this->input->post('diskon'),
                    "username"      => $this->session->identity,
                    "gudang"	=> $this->input->post('gudang'),
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
                  'bayar' => $this->get_total3(),
                  'tgl_bayar' => tgl_simpan2($tg3),
                  'username' => $this->session->identity,
              );
              $this->cart->destroy();
              $this->db->insert('wp_detail_transaksi', $detail);
              $this->db->insert('wp_pembayaran', $pembayaran);
              $res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk 
              if($res)
              {
                $this->cart->destroy();
                $this->session->set_flashdata('message','sukses !');
                redirect('transaksi');
              } else {
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
                      "username"    => $this->session->identity,
                      "gudang"				=> $this->input->post('gudang'),
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
              $this->cart->destroy();
              $this->db->insert('wp_detail_transaksi', $data);
              $this->db->insert('wp_pembayaran', $pembayaran);
            $res = $this->db->insert_batch('wp_transaksi', $result); // fungsi dari codeigniter untuk menyimpan multi array
            if($res)
            {
                $this->cart->destroy();
                $this->session->set_flashdata('message','sukses !');
                redirect('transaksi');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan, mohon periksa kembali pesanan anda !');
            }
          }
        }
    }
    
    public function _rules()
    {
	//$this->form_validation->set_rules('id_transaksi', 'id transaksi', 'trim|required');
	$this->form_validation->set_rules('wp_barang_id', 'wp barang id', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	//$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	//$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
	//$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');
	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('wp_status_id', 'wp status id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $cek = get_permission('Transaksi Penjualan', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
        $this->load->helper('exportexcel');
        $namaFile = "transaksi.xls";
        $judul = "transaksi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Barang Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	//xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Pelanggan Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Status Id");

	foreach ($this->Transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_barang_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga);
	    xlsWriteNumber($tablebody, $kolombody++, $data->qty);
	    //xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_pelanggan_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_status_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {  
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=transaksi.doc");

        $data = array(
            'transaksi_data' => $this->Transaksi_model->get_all(),
            'start' => 0
        );

        $this->load->view('transaksi/transaksi_doc',$data);
    }

    function get_faktur()
    {
      $faktur = $this->input->post('faktur');
      $result = $this->Transaksi_model->get_faktur($faktur);
      if ($result) {
        echo json_encode($result);
      } else {
        echo json_encode((bool)false);
      }
    }
  
    function cek_password()
    {
      $password = $this->input->post('password');
      $username = $this->session->identity;
      $faktur = $this->input->post('faktur');
      
      if ($this->ion_auth->login($username, $password, 0)){
        $this->Transaksi_model->hapus_pembayaran($faktur);
        echo json_encode((bool)true);
      } else {
        echo json_encode((bool)false);
      }
    }

    function cek_password_edit()
    {
        $password = $this->input->post('password');
        $username = $this->session->identity;
        $faktur = $this->input->post('faktur');
        if ($this->ion_auth->login($username, $password, 0)){
        $this->permit = true;
        echo json_encode((bool)true);
        } else {
        echo json_encode((bool)false);
        }
    }

}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-12 05:09:32 */
/* http://harviacode.com */
