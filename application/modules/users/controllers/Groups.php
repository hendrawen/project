<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller
{
    private $permit;
   public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('modelgroup','group');
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
    }

    public function index()
    {
        $data['aktif']		  ='setting';
    		$data['judul']      ='Group';
    		$data['sub_judul']	='List';
        $data['groups']      = $this->group->get_all();
        $data['content']    = 'group/groups';
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard',$data);
    }

    public function create()
    {
      $data = array(
          'button' => 'Save',
          'action' => site_url('users/groups/create_action'),
    'id' => set_value('id'),
    'name' => set_value('name'),
    'description' => set_value('description'),
    );
        $data['aktif']		  ='setting';
    		$data['judul']      ='Group';
    		$data['sub_judul']	='Tambah';
        $data['content']    ='group/table_group_form';
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard',$data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
                $data = array(
              		'name' => $this->input->post('name',TRUE),
              		'description' => $this->input->post('description',TRUE),
	             );

            $this->group->insert($data);
            $this->session->set_flashdata('message', 'Data Success Disimpan');
            redirect(site_url('users/groups'));
        }
    }

    public function update($id)
    {
        $row = $this->group->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/groups/update_action'),
    		'id' => set_value('id', $row->id),
    		'name' => set_value('name', $row->name),
    		'description' => set_value('description', $row->description),
    	    );
            $data['aktif']		  ='setting';
            $data['judul']      ='Group';
            $data['sub_judul']	='Edit';
            $data['content']    ='group/table_group_form';
            $this->load->view('panel/dashboard',$data);
        } else {
            $this->session->set_flashdata('message', 'Tidak Ada Data');
            redirect(site_url('users/groups'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
          		// 'id_suplier' => $this->input->post('id_suplier',TRUE),
          		'name' => $this->input->post('name',TRUE),
          		'description' => $this->input->post('description',TRUE),
        	    );

            $this->group->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('users/groups'));
        }
    }

    public function delete($id)
    {
        $row = $this->group->get_by_id($id);
        //$row = $this->suplier_model->cek_kode_suplier($id);
        if ($row) {
          $this->group->delete($id);
          $this->session->set_flashdata('message', 'Delete Data Success');
          redirect(site_url('users/groups'));
        } else {
          $this->session->set_flashdata('message', 'Delete Data Gagal');
          redirect(site_url('users/groups'));
        }
    }

    public function _rules()
    {
	//$this->form_validation->set_rules('id_suplier', 'id suplier', 'trim|required');
	$this->form_validation->set_rules('name', 'Nama Group', 'trim|required');
	$this->form_validation->set_rules('description', 'Deskripsi', 'trim|required');

	//$this->form_validation->set_rules('id', 'id', 'trim');
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
