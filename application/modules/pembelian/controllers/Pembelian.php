<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin') AND !$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Pembelian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembelian/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembelian/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembelian/index.html';
            $config['first_url'] = base_url() . 'pembelian/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembelian_model->total_rows($q);
        $Pembelian = $this->Pembelian_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            //'pembelian_data' => $pembelian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['aktif']			='transaksi';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Pembelian';
        $data['content']		='transaksi';
        $data['pembelian']    =$this->Pembelian_model->get_data();
        $this->load->view('panel/dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->Pembelian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_transaksi' => $row->id_transaksi,
		'wp_barang_id' => $row->wp_barang_id,
		'harga' => $row->harga,
		'qty' => $row->qty,
    'satuan' => $row->satuan,
		'wp_suplier_id' => $row->wp_suplier_id,
    //'wp_gudang_id' => $row->wp_gudang_id,
		//'created_at' => $row->created_at,
		//'updated_at' => $row->updated_at,
	    );
            $data['aktif']			='transaksi';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail Pembelian';
            $data['content']		='Pembelian_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('pembelian'));
        }
    }

    public function create()
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
        $data['aktif']			='transaksi';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Tambah Pembelian';
        $data['content']		='transaksi_form';
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
          		'id_transaksi' => $this->Pembelian_model->buat_kode(),
          		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
          		'qty' => $this->input->post('qty',TRUE),
          		'harga' => $this->input->post('harga',TRUE),
              'satuan' => $this->input->post('satuan',TRUE),
          		'subtotal' => $this->input->post('subtotal',TRUE),
          		'tgl_transaksi' => date('Y-m-d H:i:s'),
              'username' => $this->session->identity,
          		//'updated_at' => $this->input->post('updated_at',TRUE),
              //'created_at' => mdate($datestring, $time),
	           );
            $this->Pembelian_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('panel'));
        }
    }

    public function update($id)
    {
        $row = $this->Pembelian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembelian/update_action'),
        		'id' => set_value('id', $row->id),
        		'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
        		'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
        		'qty' => set_value('qty', $row->qty),
        		'harga' => set_value('harga', $row->harga),
            'satuan' => set_value('satuan', $row->satuan),
        		'subtotal' => set_value('subtotal', $row->subtotal),
            //'wp_gudang_id' => set_value('wp_gudang_id', $row->wp_gudang_id),
        		//'created_at' => set_value('created_at', $row->created_at),
        		//'updated_at' => set_value('updated_at', $row->updated_at),
        	  );
            $data['aktif']			='transaksi';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit Pembelian';
            $data['content']		='transaksi_form';
            //$data['query']      =$this->Pembelian_model->get_coba();
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('pembelian'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        $datestring = '%Y-%m-%d %h:%i:%s';
        $time = time();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
          		//'id_Pembelian' => $this->input->post('id_Pembelian',TRUE),
          		'qty' => $this->input->post('qty',TRUE),
          		'harga' => $this->input->post('harga',TRUE),
          		'subtotal' => $this->input->post('subtotal',TRUE),
              'satuan' => $this->input->post('satuan',TRUE),
          		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE)
              //'username' => $this->session->identity,
              //'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
              //'updated_at' => date('Y-m-d H:i:s'),
          		//'created_at' => $this->input->post('created_at',TRUE),
          		//'updated_at' => mdate($datestring, $time),
      	    );

            $this->Pembelian_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('pembelian'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pembelian_model->get_by_id($id);
        // $row = $this->Pembelian_model->cek_kode_stok($id);
        // if ($row) {
        //     $this->session->set_flashdata('msg', 'Maaf, Data Pembelian Ini Masih Ada Stok, Mohon Hapus Stoknya Dulu!!!');
        //     redirect(site_url('pembelian'));
        // } else {
          $this->Pembelian_model->delete($id);
          $this->session->set_flashdata('message', 'Delete Data Success');
          redirect(site_url('pembelian'));
        //}
    }

    public function _rules()
    {
    	//$this->form_validation->set_rules('id_Pembelian', 'id Pembelian', 'trim|required');

    	$this->form_validation->set_rules('wp_barang_id', 'nama barang', 'trim|required');
    	//$this->form_validation->set_rules('tgl_transaksi', 'tgl transaksi', 'trim|required');
    	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
      $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
    	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
      $this->form_validation->set_rules('subtotal', 'jumlah', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
      $this->load->helper('exportexcel');
      $namaFile = "pembelian.xls";
      $judul = "pembelian";
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
      xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
      xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
      xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      xlsWriteLabel($tablehead, $kolomhead++, "qty");
      xlsWriteLabel($tablehead, $kolomhead++, "harga");
      xlsWriteLabel($tablehead, $kolomhead++, "satuan");
      xlsWriteLabel($tablehead, $kolomhead++, "subtotal");
      xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Update");
      xlsWriteLabel($tablehead, $kolomhead++, "Username");
      $query = $this->Pembelian_model->get_data();
foreach ($query as $data) {
          $kolombody = 0;
          //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
          xlsWriteNumber($tablebody, $kolombody++, $nourut);
          xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
          xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
          xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
          xlsWriteLabel($tablebody, $kolombody++, $data->qty);
          xlsWriteLabel($tablebody, $kolombody++, $data->harga);
          xlsWriteNumber($tablebody, $kolombody++, $data->satuan);
          xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
          xlsWriteNumber($tablebody, $kolombody++, $data->updated_at);
          xlsWriteNumber($tablebody, $kolombody++, $data->username);

    $tablebody++;
          $nourut++;
      }

      xlsEOF();
      exit();
  //       $this->load->helper('exportexcel');
  //       $namaFile = "Pembelian.xls";
  //       $judul = "Pembelian Barang";
  //       $tablehead = 0;
  //       $tablebody = 1;
  //       $nourut = 1;
  //       //penulisan header
  //       header("Pragma: public");
  //       header("Expires: 0");
  //       header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  //       header("Content-Type: application/force-download");
  //       header("Content-Type: application/octet-stream");
  //       header("Content-Type: application/download");
  //       header("Content-Disposition: attachment;filename=" . $namaFile . "");
  //       header("Content-Transfer-Encoding: binary ");
  //
  //       xlsBOF();
  //
  //       $kolomhead = 0;
  //       xlsWriteLabel($tablehead, $kolomhead++, "No");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
  //       xlsWriteLabel($tablehead, $kolomhead++, "Qty");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
  //       xlsWriteLabel($tablehead, $kolomhead++, "Harga");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
  //     	xlsWriteLabel($tablehead, $kolomhead++, "History Update");
  //       xlsWriteLabel($tablehead, $kolomhead++, "Username");
  //
	// foreach ($this->Pembelian_model->get_all() as $data) {
  //           $kolombody = 0;
  //
  //           //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
  //           xlsWriteNumber($tablebody, $kolombody++, $nourut);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->id_barang);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
  //           xlsWriteLabel($tablebody, $kolombody++, $data->qty);
  //     	    xlsWriteNumber($tablebody, $kolombody++, $data->satuan);
  //           xlsWriteNumber($tablebody, $kolombody++, $data->harga);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
  //     	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);
  //           xlsWriteLabel($tablebody, $kolombody++, $data->username);
  //
	//     $tablebody++;
  //           $nourut++;
  //       }
  //
  //       xlsEOF();
  //       exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pembelian.doc");

        $data = array(
            'pembelian_data' => $this->Pembelian_model->get_data(),
            'start' => 0
        );

        $this->load->view('pembelian/pembelian_doc',$data);
    }

}

/* End of file Pembelian.php */
/* Location: ./application/controllers/Pembelian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-06 08:15:05 */
/* http://harviacode.com */
