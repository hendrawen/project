<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_sales extends CI_Controller 
{
    private $permit;
    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Model_produk','produk');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Produk Sales';
        $data['sub_judul']	    ='Produk Sales';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['content']		='main';
        $data['produk']    =$this->produk->get_data();
        $this->load->view('panel/dashboard', $data);
    }

    public function read($id)
    {   
        $row = $this->produk->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_barang' => $row->id_barang,
		'nama_barang' => $row->nama_barang,
		'harga_beli' => $row->harga_beli,
		'harga_jual' => $row->harga_jual,
    'satuan' => $row->satuan,
		'wp_suplier_id' => $row->wp_suplier_id,
    //'wp_gudang_id' => $row->wp_gudang_id,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Barang';
            $data['sub_judul']	='Detail Barang';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $data['content']		='barang_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('barang'));
        }
    }

    public function create()
    {   
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('produk_sales/create_action'),
	    'id' => set_value('id'),
	    'id_produksales' => set_value('id_produksales'),
	    'wp_barang_id' => set_value('wp_barang_id'),
	    'wp_kategori_id_kategori' => set_value('wp_kategori_id_kategori'),
	    'harga_jual' => set_value('harga_jual')
	);
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Produk Sales';
        $data['sub_judul']	    ='Tambah Produk Sales';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['content']		='tambah';
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
          		'id_produksales' => $this->produk->buat_kode(),
          		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
          		'wp_kategori_id_kategori' => $this->input->post('wp_kategori_id_kategori',TRUE),
          		'harga_jual' => $this->input->post('harga_jual',TRUE)
	           );

            $this->produk->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('produk_sales'));
        }
    }

    public function update($id)
    {   
        $row = $this->produk->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk_sales/update_action'),
        		'id' => set_value('id', $row->id),
        		'id_produksales' => set_value('id_produksales', $row->id_produksales),
        		'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
        		'wp_kategori_id_kategori' => set_value('wp_kategori_id_kategori', $row->wp_kategori_id_kategori),
        		'harga_jual' => set_value('harga_jual', $row->harga_jual),
            
        	  );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Produk Sales';
            $data['sub_judul']	    ='Edit Produk Sales';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $data['content']		='tambah';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('produk sales'));
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
                // 'id_produksales' => $this->produk->buat_kode(),
                'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
                'wp_kategori_id_kategori' => $this->input->post('wp_kategori_id_kategori',TRUE),
                'harga_jual' => $this->input->post('harga_jual',TRUE)
      	    );

            $this->produk->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('produk_sales'));
        }
    }

    public function delete($id)
    {   
          $this->produk->delete($id);
          $this->session->set_flashdata('message', 'Delete Data Success');
          redirect(site_url('produk_sales'));
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('wp_barang_id', 'produk', 'trim|required');
    	$this->form_validation->set_rules('wp_kategori_id_kategori', 'kategori', 'trim|required');
    	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required');    
    	//$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $this->load->helper('exportexcel');
        $namaFile = "barang.xls";
        $judul = "barang";
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
      	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
      	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
      	xlsWriteLabel($tablehead, $kolomhead++, "Harga Beli");
      	xlsWriteLabel($tablehead, $kolomhead++, "Harga Jual");
        xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
      	xlsWriteLabel($tablehead, $kolomhead++, "Wp Suplier Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Wp Gudang Id");
      	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
      	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->produk->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->id_barang);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->harga_beli);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->harga_jual);
            xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
      	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_suplier_id);
            //xlsWriteNumber($tablebody, $kolombody++, $data->wp_gudang_id);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
      	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Controllername.php */
