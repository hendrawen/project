<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('suplier_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
          $data['aktif']			='Master';
          $data['title']			='Brajamarketindo';
          $data['judul']			='Dashboard';
          $data['sub_judul']	='Suplier';
          $data['content']		='suplier_list';
          $data['suplier']    =$this->suplier_model->get_all();
          $this->load->view('panel/dashboard', $data);
    }

    public function simpan()
    {
      $kode = set_value('id_suplier');
      $data = array(
        'id_suplier' => $this->suplier_model->buat_kode(),
        'nama_suplier' => $this->input->post('nama_suplier',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        );
        $insert = $this->suplier_model->insert($data);
			  echo json_encode(array("status" => TRUE));
    }

    //edit data
    function get_suplier(){
        $id=$this->input->get('id');
        $data=$this->suplier_model->get_by_id($id);
        echo json_encode($data);
    }

    function update_suplier(){
      $id = $this->input->post('id',TRUE);
      $dataku = array(
        'nama_suplier' => $this->input->post('nama_suplier',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        );
        $data = $this->suplier_model->update($id, $dataku);
        echo json_encode($data);
    }

    function hapus(){
        $idku=$this->input->post('id');
        $data=$this->suplier_model->delete($idku);
        echo json_encode($data);
    }


    //************************************************************//
    public function read($id)
    {
        $row = $this->suplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_suplier' => $row->id_suplier,
		'nama_suplier' => $row->nama_suplier,
		'alamat' => $row->alamat,
	    );
            $data['aktif']			='Master';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Suplier';
            $data['content']		='suplier_list';
            $this->load->view('suplier/suplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplier'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('suplier/create_action'),
	    'id' => set_value('id'),
	    'id_suplier' => set_value('id_suplier'),
	    'nama_suplier' => set_value('nama_suplier'),
	    'alamat' => set_value('alamat'),
	);
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Tambah Suplier';
        $data['content']		='suplier_form';
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
                $data = array(
              		'id_suplier' => $this->suplier_model->buat_kode(),
              		'nama_suplier' => $this->input->post('nama_suplier',TRUE),
              		'alamat' => $this->input->post('alamat',TRUE),
	             );

            $this->suplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('suplier'));
        }
    }

    public function update($id)
    {
        $row = $this->suplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('suplier/update_action'),
		'id' => set_value('id', $row->id),
		'id_suplier' => set_value('id_suplier', $row->id_suplier),
		'nama_suplier' => set_value('nama_suplier', $row->nama_suplier),
		'alamat' => set_value('alamat', $row->alamat),
	    );
            $this->load->view('suplier/suplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplier'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_suplier' => $this->input->post('id_suplier',TRUE),
		'nama_suplier' => $this->input->post('nama_suplier',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
	    );

            $this->suplier_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('suplier'));
        }
    }

    public function delete($id)
    {
        $row = $this->suplier_model->get_by_id($id);

        if ($row) {
            $this->suplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('suplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suplier'));
        }
    }

    public function _rules()
    {
	//$this->form_validation->set_rules('id_suplier', 'id suplier', 'trim|required');
	$this->form_validation->set_rules('nama_suplier', 'nama suplier', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "suplier.xls";
        $judul = "suplier";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Suplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Suplier");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

	foreach ($this->suplier_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_suplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_suplier);
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
        header("Content-Disposition: attachment;Filename=suplier.doc");

        $data = array(
            'suplier_data' => $this->suplier_model->get_all(),
            'start' => 0
        );

        $this->load->view('suplier/suplier_doc',$data);
    }

}

/* End of file suplier.php */
/* Location: ./application/controllers/suplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-01 07:14:31 */
/* http://harviacode.com */
