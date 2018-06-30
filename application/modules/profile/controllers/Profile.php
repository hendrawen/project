<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller
{
    private $permit;
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Ion_auth_model');
        // $permit = $this->Ion_auth_model->permission($this->session->identity);
        // if (!$this->ion_auth->logged_in()) {//cek login ga?
        //     redirect('login','refresh');
        // }else{
        //     if (!$this->ion_auth->in_group($permit)) {//cek admin ga?
        //         redirect('login','refresh');
        //     }
        // }
        $this->load->model('profile_model');
        $this->load->library('form_validation');
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
    }

    public function index()
    {
        
		
		
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'profile/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'profile/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'profile/index.html';
            $config['first_url'] = base_url() . 'profile/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->profile_model->total_rows($q);
        $profile = $this->profile_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'profile_data' => $profile,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
          $data['aktif']			='profile';
      		$data['title']			='Brajamarketindo';
      		$data['judul']			='Dashboard';
      		$data['sub_judul']	='Profile Perusahaan';
            $data['content']		='profile_list';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
          $this->load->view('panel/dashboard', $data);
    }

    public function read($id)
    {
        $row = $this->profile_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama_perusahaan' => $row->nama_perusahaan,
                'alamat' => $row->alamat,
                'no_telp' => $row->no_telp,
                'email' => $row->email,
                'website' => $row->website,
            );
            $data['aktif']			='profile';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	    ='Detail Profile';
            $data['content']		='profile_read';
            $data['menu']			= $this->permit[0];
            $data['submenu']		= $this->permit[1];
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('profile'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('profile/create_action'),
	    'id' => set_value('id'),
	    'nama_perusahaan' => set_value('nama_perusahaan'),
	    'alamat' => set_value('alamat'),
	    'no_telp' => set_value('no_telp'),
	    'email' => set_value('email'),
	    'website' => set_value('website'),
	);
        $data['aktif']			='profile';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	='Add Profile';
        $data['content']		='profile_form';
        $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'no_telp' => $this->input->post('no_telp',TRUE),
        		'email' => $this->input->post('email',TRUE),
        		'website' => $this->input->post('website',TRUE),
            'username' => $this->session->identity,
	    );

            $this->profile_model->insert($data);
            $this->session->set_flashdata('message', 'Simpan Data Success');
            redirect(site_url('profile'));
        }
    }

    public function update($id)
    {
        $row = $this->profile_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('profile/update_action'),
		'id' => set_value('id', $row->id),
		'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
		'alamat' => set_value('alamat', $row->alamat),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'email' => set_value('email', $row->email),
		'website' => set_value('website', $row->website),
	    );
            $data['aktif']			='profile';
            $data['title']			='Brajamarketindo';
            $data['judul']			='Dashboard';
            $data['sub_judul']	='Edit Profile';
            $data['content']		='profile_form';
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('profile'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'email' => $this->input->post('email',TRUE),
		'website' => $this->input->post('website',TRUE),
    'username' => $this->session->identity,
	    );

            $this->profile_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Success');
            redirect(site_url('profile'));
        }
    }

    public function delete($id)
    {
        $row = $this->profile_model->get_by_id($id);

        if ($row) {
            $this->profile_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Success');
            redirect(site_url('profile'));
        } else {
            $this->session->set_flashdata('msg', 'Data Tidak Ada');
            redirect(site_url('profile'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('website', 'website', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-01 04:34:07 */
/* http://harviacode.com */
