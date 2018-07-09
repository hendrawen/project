<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{   
    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
        $this->load->model('kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    { 
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
      $data = array(
          'button' => 'Tambah',
          'action' => site_url('kategori/create_action'),
      'id_kategori' => set_value('id_kategori'),
      'nama_kategori' => set_value('nama_kategori'),
      );

      $data['aktif']			='Master';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Dashboard';
      $data['sub_judul']	='Kategori';
      $data['content']		='kategori_list';
      $data['menu']			= $this->permit[0];
	  $data['submenu']		= $this->permit[1];
      $data['kategori']   = $this->kategori_model->get_all();
      $this->load->view('panel/dashboard', $data);

    }

    public function read($id)
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kategori' => $row->id_kategori,
		'nama_kategori' => $row->nama_kategori,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail Kategori';
            $data['content']		='kategori_read';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kategori'));
        }
    }

    public function create_action()
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            //$this->create();
        } else {
            $data = array(
        		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
        	    );

            $cek = $this->kategori_model->cek_kategori($data['nama_kategori']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Kategori ini Sudah Ada');
              redirect(site_url('kategori'));
            } else {
            $this->kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('kategori'));
            }
        }
    }

    public function update($id)
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->kategori_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategori/update_action'),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'nama_kategori' => set_value('nama_kategori', $row->nama_kategori),
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit Kategori';
            $data['content']		='kategori_list';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $data['kategori']   = $this->kategori_model->get_all();
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kategori'));
        }
    }

    public function update_action()
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
          		'nama_kategori' => $this->input->post('nama_kategori',TRUE),
            );

            $cek = $this->kategori_model->cek_kategori($data['nama_kategori']);
            if ($cek) {
              $this->session->set_flashdata('msg', 'Nama Kategori ini Sudah Ada');
              redirect(site_url('kategori'));
            } else {
            $this->kategori_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('kategori'));
            }
        }
    }

    public function delete($id)
    {   
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->kategori_model->get_by_id($id);

        if ($row) {
            $this->kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('kategori'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kategori'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'trim|required');
	//$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
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
        $cek = get_permission('Jabatan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
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
