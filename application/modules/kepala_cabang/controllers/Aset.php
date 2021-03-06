<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aset extends CI_Controller
{
    private $permit;
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Kepala Cabang')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Model_aset', 'aset');
        $this->load->library('form_validation');
    }

    public function index()
    {
		$data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Aset Awal';
        $data['content']		='aset/list';
        $data['aset_data']    		= $this->aset->get_all();
        $this->load->view('dashboard', $data);
    }



    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('kepala_cabang/aset/create_action'),
            'id' => set_value('id'),
            'gudang' => set_value('gudang'),
            'aset_krat' => set_value('aset_krat'),
            'aset_btl' => set_value('aset_btl'),
            'updated_at' => set_value('updated_at'),
            'updated_by' => set_value('updated_by'),
	        );
				$data['aktif']			='Master';
				$data['title']			='Brajamarketindo';
				$data['judul']			='Dashboard';
                $data['sub_judul']	    ='Aset Awal';
				$data['content']		='aset/form';
				$this->load->view('dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
						'gudang' => $this->input->post('gudang',TRUE),
                        'aset_krat' => $this->input->post('aset_krat',TRUE),
                        'aset_btl' => $this->input->post('aset_btl',TRUE),
                        'updated_at' => date("Y-m-d"),
                        'updated_by'    => $this->session->identity,
	    			);

            $this->aset->insert($data);
            $this->session->set_flashdata('message', 'Data Success Disimpan');
            redirect(site_url('kepala_cabang/aset'));
        }
    }

    public function update($id)
    {
        $row = $this->aset->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kepala_cabang/aset/update_action'),
                'id' => set_value('id', $row->id),
                'gudang' => set_value('gudang', $row->gudang),
                'aset_krat' => set_value('aset_krat', $row->aset_krat),
                'aset_btl' => set_value('aset_btl', $row->aset_btl),
	        );
			$data['aktif']			='Master';
			$data['title']			='Brajamarketindo';
			$data['judul']			='Dashboard';
            $data['sub_judul']	    ='Edit Aset Awal';
			$data['content']		='aset/form';
			$this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kepala_cabang/aset'));
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
                'gudang' => $this->input->post('gudang',TRUE),
                'aset_krat' => $this->input->post('aset_krat',TRUE),
                'aset_btl' => $this->input->post('aset_btl',TRUE),
                'updated_at' => date("Y-m-d"),
                'updated_by'    => $this->session->identity,
	        );
            $this->aset->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('kepala_cabang/aset'));
        }
    }

    public function delete($id)
    {
        $row = $this->aset->get_by_id($id);

        if ($row) {
            $this->aset->delete($id);
            $this->session->set_flashdata('message', 'Delete Data Success');
            redirect(site_url('kepala_cabang/aset'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('kepala_cabang/aset'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('gudang', 'gudang tidak boleh kosong', 'trim|required');
	$this->form_validation->set_rules('aset_krat', 'aset awal tidak boleh kosong', 'trim|required');
	$this->form_validation->set_rules('aset_btl', 'aset awal tidak boleh kosong', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 04:37:16 */
/* http://harviacode.com */
