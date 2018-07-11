<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
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
        // else{
        //     if (!$this->ion_auth->in_group('admin') AND !$this->ion_auth->in_group('members')) {//cek admin ga?
        //         redirect('login','refresh');
        //     }
        // }
        $this->load->model('karyawan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'karyawan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'karyawan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'karyawan/index.html';
            $config['first_url'] = base_url() . 'karyawan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->karyawan_model->total_rows($q);
        $karyawan = $this->karyawan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'karyawan_data' => $karyawan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['aktif']			='Karyawan';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Karyawan';
        $data['content']		='karyawan_list';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['karya']   = $this->karyawan_model->get_data();
        $this->load->view('panel/dashboard', $data);
    }

    public function read($id)
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_karyawan' => $row->id_karyawan,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_telp' => $row->no_telp,
		'photo' => $row->photo,
		'status' => $row->status,
		'wp_jabatan_id' => $row->wp_jabatan_id,
	    );
            $data['aktif']			='Karyawan';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Detail Karyawan';
            $data['menu']			= $this->permit[0];
	        $data['submenu']		= $this->permit[1];
            $data['content']		='karyawan_read';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('karyawan'));
        }
    }

    public function create()
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('karyawan/create_action'),
	    'id_karyawan' => set_value('id_karyawan'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'photo' => set_value('photo'),
	    'status' => set_value('status'),
	    'wp_jabatan_id' => set_value('wp_jabatan_id'),
	);
        $data['aktif']			='Karyawan';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Tambah Karyawan';
        $data['menu']			= $this->permit[0];
	    $data['submenu']		= $this->permit[1];
        $data['content']		='karyawan_form';
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
          // setting konfigurasi upload
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 50000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('photo');

        $result = $this->upload->data();
        //compress image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets/uploads/'.$result['file_name'];
        $config['create_thumb']     = false;
        $config['maintain_ratio']   = false;
        $config['width']            = 100;
        $config['height']           = 100;
        $config['new_image']        = './assets/uploads/'.$result['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $photo = $result['file_name'];

            $data = array(
                'id_karyawan' => $this->input->post('id_karyawan',TRUE),
        		'nama' => $this->input->post('nama',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'no_telp' => $this->input->post('no_telp',TRUE),
        		'photo' => $photo,
        		'status' => $this->input->post('status',TRUE),
        		'wp_jabatan_id' => $this->input->post('wp_jabatan_id',TRUE),
        	    );

            $this->karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('karyawan'));
        }
    }

    public function update($id)
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
		'id_karyawan' => set_value('id_karyawan', $row->id_karyawan),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'photo' => set_value('photo', $row->photo),
		'status' => set_value('status', $row->status),
		'wp_jabatan_id' => set_value('wp_jabatan_id', $row->wp_jabatan_id),
	    );
            $data['aktif']			='Karyawan';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit Karyawan';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $data['content']		='karyawan_form_edit';
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('karyawan'));
        }
    }

    public function update_action()
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_karyawan', TRUE));
        } else {
          // setting konfigurasi upload
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']      = 50000;
        // load library upload
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('photo');

        $result = $this->upload->data();
        //compress image
        $config['image_library']    ='gd2';
        $config['source_image']     ='./assets/uploads/'.$result['file_name'];
        $config['create_thumb']     = false;
        $config['maintain_ratio']   = false;
        $config['width']            = 100;
        $config['height']           = 100;
        $config['new_image']        = './assets/uploads/'.$result['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $photo = $result['file_name'];

        if ($photo != '') {
               $id_karyawan = $this->input->post('id_karyawan',TRUE);

               $query = $this->db->query("SELECT * FROM wp_karyawan WHERE id_karyawan= '{$id_karyawan}'");
                   foreach ($query->result() as $key) {
                   unlink('./assets/uploads/'.$key->photo);
               }

            $data = array(
        		'nama' => $this->input->post('nama',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'no_telp' => $this->input->post('no_telp',TRUE),
        		'photo' => $photo,
        		'status' => $this->input->post('status',TRUE),
        		'wp_jabatan_id' => $this->input->post('wp_jabatan_id',TRUE),
        	    );

            } elseif ($photo == '') {
              $data = array(
                'nama' => $this->input->post('nama',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                //'photo' => $photo,
                'status' => $this->input->post('status',TRUE),
                'wp_jabatan_id' => $this->input->post('wp_jabatan_id',TRUE),
                    );
            }

            $this->karyawan_model->update($this->input->post('id_karyawan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function delete($id)
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $row = $this->karyawan_model->get_by_id($id);

        if ($row) {
            $this->karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	//$this->form_validation->set_rules('photo', 'photo', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('wp_jabatan_id', 'wp jabatan id', 'trim|required');

	$this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {   
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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

	foreach ($this->karyawan_model->get_all() as $data) {
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
        $cek = get_permission('Karyawan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=karyawan.doc");

        $data = array(
            'karyawan_data' => $this->karyawan_model->get_all(),
            'start' => 0
        );

        $this->load->view('karyawan/karyawan_doc',$data);
    }

}

/* End of file karyawan.php */
/* Location: ./application/controllers/karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-09 07:12:23 */
/* http://harviacode.com */
