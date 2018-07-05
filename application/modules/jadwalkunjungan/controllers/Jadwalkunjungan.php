<?php
    defined('BASEPATH') OR exit('No direct access script allowed');

    class Jadwalkunjungan extends CI_Controller {

        private $permit;
        public function __construct()
        {
            parent::__construct();
            //Codeigniter : Write Less Do More
            $this->load->model('Ion_auth_model');
            $this->permit = $this->Ion_auth_model->permission($this->session->identity);
            $this->load->model('M_jadwalkunjungan', 'm_jadwal');

            if (!$this->ion_auth->logged_in()) {//cek login ga?
                redirect('login','refresh');
            }
        }

        function test(){
          echo $this->m_jadwal->get_per_validator();
        }

        function index(){

          $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
          if (!$cek) {
              redirect('panel','refresh');
          }
            $data = array(
                'aktif'      => 'Jadwal Kunjungan',
                'menu'       => $this->permit[0],
                'submenu'	   => $this->permit[1],
                'content'    => 'list_jadwal',
                'judul'      => 'Dashboard',
                'sub_judul'  => 'Jadwal Kunjungan'
            );
            if($this->session->identity == 'administrator'){
              $data['jadwal'] = $this->m_jadwal->getall();
            }else {
              $data['jadwal'] = $this->m_jadwal->get_per_validator();
            }



            $this->load->view('panel/dashboard', $data);
        }

        public function create()
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $data = array(
              'button'     => 'Tambah',
              'action'     => site_url('jadwalkunjungan/create_action'),
        	    'id_jadwal'  => set_value('id_jadwal'),
        	    'nama_pel'   => set_value('nama_pel'),
        	    'validator'  => set_value('validator'),
        	    'tanggal'    => set_value('tanggal'),
                'sumber_data'  => set_value('sumber_data'),
                'ket'        => set_value('ket'),
              'aktif'      => 'Jadwal Kunjungan',
              'menu'       => $this->permit[0],
              'submenu'	   => $this->permit[1],
              'content'    => 'form_jadwal',
              'judul'      => 'Dashboard',
              'sub_judul'  => 'Jadwal Kunjungan',
              'pelanggan'  => $this->m_jadwal->get_data_pelanggan(),
              'm_validator'  => $this->m_jadwal->get_data_validator()
    	       );

            $this->load->view('panel/dashboard', $data);
        }

        public function create_action()
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {

                $data = array(
            		'id_pelanggan' => $this->input->post('nama_pel',TRUE),
            		'id_karyawan' => $this->input->post('validator',TRUE),
                    'tanggal_kunjungan' => $this->input->post('tanggal',TRUE),
                    'sumber_data' => $this->input->post('sumber_data',TRUE),
            		'keterangan' => $this->input->post('ket',TRUE),
            	  );

                $this->m_jadwal->insert($data);
                $this->session->set_flashdata('message', 'Simpan Data Success');
                redirect(site_url('jadwalkunjungan'));
            }
        }

        public function update($id)
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $row = $this->m_jadwal->get_by_id($id);

            if ($row) {
              $data = array(
                'button'     => 'Update',
                'action'     => site_url('jadwalkunjungan/update_action'),
          	    'id_jadwal'  => set_value('id_jadwal', $row->id_jadwal),
          	    'nama_pel'   => set_value('nama_pel', $row->id_pelanggan),
          	    'validator'  => set_value('validator', $row->id_karyawan),
                  'tanggal'    => set_value('tanggal', $row->tanggal_kunjungan),
                  'sumber_data'    => set_value('sumber_data', $row->sumber_data),
          	    'ket'        => set_value('ket', $row->keterangan),
                'aktif'      => 'Jadwal Kunjungan',
                'menu'       => $this->permit[0],
                'submenu'	   => $this->permit[1],
                'content'    => 'form_jadwal',
                'judul'      => 'Dashboard',
                'sub_judul'  => 'Jadwal Kunjungan',
                'pelanggan'  => $this->m_jadwal->get_data_pelanggan(),
                'm_validator'  => $this->m_jadwal->get_data_validator()
      	       );

                $this->load->view('panel/dashboard', $data);
            } else {
                $this->session->set_flashdata('msg', 'Data Tidak Ada');
                redirect(site_url('jadwalkunjungan'));
            }
        }


        public function update_action()
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_jadwal', TRUE));
            } else {
              $data = array(
              'id_pelanggan' => $this->input->post('nama_pel',TRUE),
              'id_karyawan' => $this->input->post('validator',TRUE),
              'tanggal_kunjungan' => $this->input->post('tanggal',TRUE),
              'sumber_data' => $this->input->post('sumber_data',TRUE),
              'keterangan' => $this->input->post('ket',TRUE),
              );

                $this->m_jadwal->update($this->input->post('id_jadwal', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('jadwalkunjungan'));
            }
        }

        public function delete($id)
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $row = $this->m_jadwal->get_by_id($id);

            if ($row) {
                $this->m_jadwal->delete($id);
                $this->session->set_flashdata('message', 'Hapus Data Success');
                redirect(site_url('jadwalkunjungan'));
            } else {
                $this->session->set_flashdata('msg', 'Data Tidak Ada');
                redirect(site_url('jadwalkunjungan'));
            }
        }

        public function _rules()
        {
        	$this->form_validation->set_rules('nama_pel', 'nama pelanggan', 'trim|required');
        	$this->form_validation->set_rules('validator', 'validator', 'trim|required');
            $this->form_validation->set_rules('sumber_data', 'sumber_data', 'trim|required');
        	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        	$this->form_validation->set_rules('ket', 'ket', 'trim');
        	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }

        public function excel()
        {
            $cek = get_permission('Jadwal Kunjungan', $this->permit[1]);
            if (!$cek) {//cek admin ga?
                redirect('panel','refresh');
            }
            $this->load->helper('exportexcel');
            $namaFile = "Jadwal_kunjungan.xls";
            $judul = "Jadwal Kunjungan";
            $tablehead = 3;
            $tablebody = 4;
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

            xlsWriteLabel(0, 0, "Data");
            xlsWriteLabel(0, 1, ": ".$judul);
            xlsWriteLabel(1, 0, "Tanggal");
            xlsWriteLabel(1, 1, ": ".date('Y-m-d'));

            $kolomhead = 0;
            xlsWriteLabel($tablehead, $kolomhead++, "No");
          	xlsWriteLabel($tablehead, $kolomhead++, "Id jadwal");
          	xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
          	xlsWriteLabel($tablehead, $kolomhead++, "Validator");
          	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kunjungan");
          	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

    	      foreach ($this->m_jadwal->getall() as $data) {
                $kolombody = 0;
                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
          	    xlsWriteLabel($tablebody, $kolombody++, $data->id_jadwal);
          	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
          	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
          	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_kunjungan);
          	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

    	          $tablebody++;
                $nourut++;
            }

            xlsEOF();
            exit();
        }


    }
