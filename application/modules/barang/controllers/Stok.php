<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok extends CI_Controller
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
        $this->load->model('stok_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $stok = $this->stok_model->get_all();

        $data = array(
            'stok_data' => $stok,
            'start' => 1,
        );
				$data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Stok Barang';
        $data['content']		='stok_list';
        $data['stok']    		= $this->stok_model->get_data();
        $this->load->view('panel/dashboard', $data);
    }

    public function read($id)
    {   
        $row = $this->stok_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'wp_barang_id' => $row->wp_barang_id,
    'wp_gudang_id' => $row->wp_gudang_id,
		'stok' => $row->stok,
		'updated_at' => $row->updated_at,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail Stok Barang';
            $data['content']		='stok_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('stok'));
        }
    }

    public function create()
    {   
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('barang/stok/create_action'),
	    'id' => set_value('id'),
	    'wp_barang_id' => set_value('wp_barang_id'),
      'wp_gudang_id' => set_value('wp_gudang_id'),
	    'stok' => set_value('stok'),
	    'updated_at' => set_value('updated_at'),
	);
				$data['aktif']			='Master';
				$data['title']			='Brajamarketindo';
				$data['judul']			='Dashboard';
                $data['sub_judul']	='Stok Barang';
				$data['content']		='stok_form';
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
							'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
              'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
							'stok' => $this->input->post('stok',TRUE),
							//'updated_at' => mdate($datestring, $time),
	    			);

            $this->stok_model->insert($data);
            $this->session->set_flashdata('message', 'Data Success Disimpan');
            redirect(site_url('barang/stok'));
        }
    }

    public function update($id)
    {   
        $row = $this->stok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/stok/update_action'),
		'id' => set_value('id', $row->id),
		'wp_barang_id' => set_value('wp_barang_id', $row->wp_barang_id),
    'wp_gudang_id' => set_value('wp_gudang_id', $row->wp_gudang_id),
		'stok' => set_value('stok', $row->stok),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
						$data['aktif']			='Master';
						$data['title']			='Brajamarketindo';
						$data['judul']			='Dashboard';
                        $data['sub_judul']	='Edit Stok Barang';
						$data['content']		='stok_form';
						$this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('barang/stok'));
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
		'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
    'wp_gudang_id' => $this->input->post('wp_gudang_id',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'updated_at' => mdate($datestring, $time),
	    );

            $this->stok_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('barang/stok'));
        }
    }

    public function delete($id)
    {   
        $row = $this->stok_model->get_by_id($id);

        if ($row) {
            $this->stok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Data Success');
            redirect(site_url('barang/stok'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('barang/stok'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('wp_barang_id', 'wp barang id', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('wp_gudang_id', 'gudang', 'trim|required');

	//$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $this->load->helper('exportexcel');
        $namaFile = "stok.xls";
        $judul = "stok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Barang Id");
  xlsWriteLabel($tablehead, $kolomhead++, "Wp Gudang Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->stok_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_barang_id);
      xlsWriteNumber($tablebody, $kolombody++, $data->wp_gudang_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
    public function word()
    {   
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=wp_stok.doc");

        $data = array(
            'wp_stok_data' => $this->stok_model->get_all(),
            'start' => 0
        );

        $this->load->view('barang/stok/stok_doc',$data);
    }


}

/* End of file stok.php */
/* Location: ./application/controllers/stok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-07 08:36:35 */
/* http://harviacode.com */
