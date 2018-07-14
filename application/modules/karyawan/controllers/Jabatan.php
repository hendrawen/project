<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
        $this->load->model('jabatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    { 
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('karyawan/jabatan/create_action'),
      'id' => set_value('id'),
      'nama_jabatan' => set_value('nama_jabatan'),
      );

      $data['aktif']			='Master';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Dashboard';
      $data['sub_judul']	='Jabatan';
      $data['content']		='jabatan_list';
      $data['jabatan']   = $this->jabatan_model->get_all();
      $this->load->view('panel/dashboard', $data);

    }

    public function read($id)
    {   
        $row = $this->jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jabatan' => $row->id_jabatan,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'photo' => $row->photo,
		'status' => $row->status,
		'wp_jabatan_id' => $row->wp_jabatan_id,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail jabatan';
            $data['content']		='jabatan_read';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('jabatan'));
        }
    }

    public function create_action()
    {   
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            //$this->create();
        } else {
            $data = array(
        		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
        	    );

            $cek = $this->jabatan_model->cek_jabatan($data['nama_jabatan']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Jabatan ini Sudah Ada');
              redirect(site_url('karyawan/jabatan'));
            } else {
            $this->jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('karyawan/jabatan'));
            }
        }
    }

    public function update($id)
    {   
        $row = $this->jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/jabatan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit jabatan';
            $data['content']		='jabatan_list';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $data['jabatan']   = $this->jabatan_model->get_all();
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('karyawan/jabatan'));
        }
    }

    public function update_action()
    {  
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
          		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
            );

            $cek = $this->jabatan_model->cek_jabatan($data['nama_jabatan']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Jabatan ini Sudah Ada');
              redirect(site_url('karyawan/jabatan'));
            } else {
            $this->jabatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('karyawan/jabatan'));
            }
        }
    }

    public function delete($id)
    {   
        $row = $this->jabatan_model->get_by_id($id);

        if ($row) {
            $this->jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('karyawan/jabatan'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('Karyawan/jabatan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_jabatan', 'nama_jabatan', 'trim|required');
	//$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->load->helper('exportexcel');
        $namaFile = "jabatan.xls";
        $judul = "jabatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Jabatan Id");

	foreach ($this->jabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->no_telp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_jabatan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {   
        
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jabatan.doc");

        $data = array(
            'jabatan_data' => $this->jabatan_model->get_all(),
            'start' => 0
        );

        $this->load->view('jabatan/jabatan_doc',$data);
    }

}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-09 07:12:23 */
/* http://harviacode.com */
