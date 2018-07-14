<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status extends CI_Controller
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
        $this->load->model('status_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('transaksi/status/create_action'),
      'id' => set_value('id'),
      'nama_status' => set_value('nama_status'),
      );

      $data['aktif']			='Master';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Dashboard';
      $data['sub_judul']	='Status';
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      $data['content']		='status_list';
      $data['status']   = $this->status_model->get_all();
      $this->load->view('panel/dashboard', $data);

    }

    public function read($id)
    {   
        $row = $this->status_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_status' => $row->nama_status,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail status';
            $data['menu']			= $this->permit[0];
            $data['submenu']		= $this->permit[1];
            $data['content']		='status_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('status'));
        }
    }

    public function create_action()
    {  
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            //$this->create();
        } else {
            $data = array(
        		'nama_status' => $this->input->post('nama_status',TRUE),
        	    );

            $cek = $this->status_model->cek_status($data['nama_status']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama status ini Sudah Ada');
              redirect(site_url('transaksi/status'));
            } else {
            $this->status_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('transaksi/status'));
            }
        }
    }

    public function update($id)
    {  
      $row = $this->status_model->get_by_id($id);

      if ($row) {
          $data = array(
              'button' => 'Update',
              'action' => site_url('transaksi/status/update_action'),
  'id' => set_value('id', $row->id),
  'nama_status' => set_value('status', $row->nama_status),
    );
          $data['aktif']			='Master';
          $data['title']			='Brajamarketindo';
          $data['judul']			='Dashboard';
          $data['sub_judul']	='Edit Status';
          $data['menu']			= $this->permit[0];
          $data['submenu']		= $this->permit[1];
          $data['content']		='status_list';
          $data['status']   = $this->status_model->get_all();
          $this->load->view('panel/dashboard', $data);
      } else {
          $this->session->set_flashdata('msg', 'Data Tidak Ada');
          redirect(site_url('transaksi/status'));
      }
    }

    public function update_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
          		'nama_status' => $this->input->post('nama_status',TRUE),
            );

            $cek = $this->status_model->cek_status($data['nama_status']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Status ini Sudah Ada');
              redirect(site_url('transaksi/status'));
            } else {
            $this->status_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('transaksi/status'));
            }
        }
    }

    public function delete($id)
    {   
        //$row = $this->status_model->get_by_id($id);
        $row = $this->status_model->cek_id_status($id);
        if ($row) {
            $this->session->set_flashdata('msg', 'Maff, Status Karyawan Masih Melakukan Transaksi');
            redirect(site_url('transaksi/status'));
        } else {
            $this->status_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('transaksi/status'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_status', 'nama_status', 'trim|required');
	//$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $this->load->helper('exportexcel');
        $namaFile = "status.xls";
        $judul = "Status";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->status_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {   
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=status.doc");

        $data = array(
            'status_data' => $this->status_model->get_all(),
            'start' => 0
        );

        $this->load->view('status/status_doc',$data);
    }

}

/* End of file status.php */
/* Location: ./application/controllers/status.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-09 07:12:23 */
/* http://harviacode.com */
