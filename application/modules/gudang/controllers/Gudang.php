<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gudang extends CI_Controller
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
        $this->load->model('gudang_model');
        $this->load->library('form_validation');
    }

    public function index()
    { 
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('gudang/create_action'),
      'id' => set_value('id'),
      'nama_gudang' => set_value('nama_gudang'),
      'alamat' => set_value('alamat'),
      );

      $data['aktif']			='Master';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Gudang';
      $data['sub_judul']	='Gudang';
      $data['content']		='gudang_list';
      $data['menu']			= $this->permit[0];
	  $data['submenu']		= $this->permit[1];
      $data['gudang']   = $this->gudang_model->get_all();
      $this->load->view('panel/dashboard', $data);

    }

    public function read($id)
    {   
        $row = $this->gudang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_gudang' => $row->nama_gudang,
		'alamat' => $row->alamat,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Gudang';
            $data['sub_judul']	    ='Detail Gudang';
            $data['content']		='gudang_read';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('gudang'));
        }
    }

    public function create_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            //$this->create();
        } else {
            $data = array(
                'nama_gudang' => $this->input->post('nama_gudang',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'username' => $this->session->identity,
        	    );

            $cek = $this->gudang_model->cek_gudang($data['nama_gudang']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Gudang ini Sudah Ada');
              redirect(site_url('gudang'));
            } else {
            $this->gudang_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('gudang'));
            }
        }
    }

    public function update($id)
    {   
        $row = $this->gudang_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gudang/update_action'),
		'id' => set_value('id', $row->id),
        'nama_gudang' => set_value('nama_gudang', $row->nama_gudang),
        'alamat' => set_value('alamat', $row->alamat),
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Gudang';
            $data['sub_judul']	    ='Edit gudang';
            $data['content']		='gudang_list';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $data['gudang']   = $this->gudang_model->get_all();
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('gudang'));
        }
    }

    public function update_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                  'nama_gudang' => $this->input->post('nama_gudang',TRUE),
                  'alamat' => $this->input->post('alamat',TRUE),
            );

            $this->gudang_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('gudang'));
        }
    }

    public function delete($id)
    {   
        $row = $this->gudang_model->get_by_id($id);

        if ($row) {
            $this->gudang_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('gudang'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('gudang'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_gudang', 'nama_gudang', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $this->load->helper('exportexcel');
        $namaFile = "gudang.xls";
        $judul = "gudang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Gudang");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

	foreach ($this->gudang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_gudang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {   
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=gudang.doc");

        $data = array(
            'gudang_data' => $this->gudang_model->get_all(),
            'start' => 0
        );

        $this->load->view('gudang/gudang_doc',$data);
    }

}

/* End of file gudang.php */
/* Location: ./application/controllers/gudang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-09 07:12:23 */
/* http://harviacode.com */
