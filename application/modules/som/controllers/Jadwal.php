<?php
    defined('BASEPATH') OR exit('No direct access script allowed');

    class Jadwal extends CI_Controller {

        private $permit;
        public $brgQty = [];
        public function __construct()
        {
            parent::__construct();
            //Codeigniter : Write Less Do More
            if (!$this->ion_auth->logged_in()) {//cek login ga?
                redirect('login','refresh');
                }else{
                        if (!$this->ion_auth->in_group('SOM')) {//cek admin ga?
                                redirect('login','refresh');
                        }
            }
            $this->load->model('Model_jadwal', 'jadwal');

        }

        function index(){

            $data = array(
                'aktif'      => 'Jadwal',
                'content'    => 'jadwal/jadwal',
                'judul'      => 'Dashboard',
                'sub_judul'  => 'Jadwal'
            );
            $data['jadwal'] = $this->jadwal->get_all();
            $this->load->view('dashboard', $data);
        }

    function jadwal_all()
    {
    $data = $this->jadwal->get_all();
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_jadwal.'</td>
          <td>'.$row->id_pelanggan.' - '.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->qty.'</td>
          <td>'.tgl_indo($row->start).'</td>
          <td>'.$row->username.'</td>
          <td>'.$row->title.'</td>
          <td>'.$row->color.'</td>
          <td>'.$row->description.'</td>
          <td>'.$row->nama.'</td>
          <td>'.anchor('som/jadwal/update/'.$row->id, 'Edit', 'class="btn btn-primary btn-sm"').' ||
              '.anchor('som/jadwal/delete/'.$row->id, 'Delete', 'class="btn btn-danger btn-sm"').'
          </td>
        </tr>';
        }
    } else {
        $pesan .= '<tr>
            <td colspan=11>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function load_jadwal_harian()
    {
    $day = $this->input->post('tgl');
    $data = $this->jadwal->load_jadwal_harian($day);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_jadwal.'</td>
          <td>'.$row->id_pelanggan.' - '.$row->nama_pelanggan.'</td>
          <td>'.$row->nama_barang.'</td>
          <td>'.$row->qty.'</td>
          <td>'.tgl_indo($row->start).'</td>
          <td>'.$row->username.'</td>
          <td>'.$row->title.'</td>
          <td>'.$row->color.'</td>
          <td>'.$row->description.'</td>
          <td>'.$row->nama.'</td>
          <td>'.anchor('som/jadwal/update/'.$row->id, 'Edit', 'class="btn btn-primary btn-sm"').' ||
              '.anchor('som/jadwal/delete/'.$row->id, 'Delete', 'class="btn btn-danger btn-sm"').'
          </td>
        </tr>';
        }
    } else {
        $pesan .= '<tr>
            <td colspan=11>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

        public function create()
        {
            $data = array(
              'button'     => 'Tambah',
              'action'     => site_url('som/jadwal/create_action'),
        	    'id'  => set_value('id'),
        	    'id_jadwal'   => set_value('id_jadwal'),
        	    'wp_barang_id'  => set_value('wp_barang_id'),
        	    'qty'    => set_value('qty'),
                'start'  => set_value('start'),
                'end'        => set_value('end'),
                'username'        => set_value('username'),
                'title'        => set_value('title'),
                'color'        => set_value('color'),
                'description'        => set_value('description'),
                'wp_pelanggan_id'        => set_value('wp_pelanggan_id'),
                'wp_karyawan_id_karyawan'        => set_value('wp_karyawan_id_karyawan'),
              'aktif'      => 'Jadwal',
              'content'    => 'jadwal/form_jadwal',
              'judul'      => 'Dashboard',
              'sub_judul'  => 'Jadwal'
               );
               $data['colors']		= array(
                '16863D' => 'hijau',
                '006CFF' => 'biru',
                'FFC300' => 'kuning',
                'F0AD4E' => 'orange',
                'E3479B' => 'jingga',
                '0DD428' => 'hijau muda',
                );
            $this->load->view('dashboard', $data);
        }

        function create_action()
        {
            // $this->_rules();

            // if ($this->form_validation->run() == FALSE) {
            //     $this->create();
            // } else {
            $count = count($this->session->userdata('brgQty'))-1;
            $id_jdw = $this->jadwal->buat_kode();
            for ($i=0; $i < $count; $i++) {
              // code...
                $data = array(
            		'id_jadwal' => $id_jdw,
            		'wp_barang_id' => $this->session->userdata('brgQty')[$i]['wp_barang_id'],
                'qty' =>  $this->session->userdata('brgQty')[$i]['qty'],
                'start' => $this->input->post('start',TRUE),
                'end' => date('Y-m-d H:i:s'),
                'username' => $this->session->identity,
                'title' => $this->input->post('title',TRUE),
                'color' => $this->input->post('color',TRUE),
                'description' => $this->input->post('description',TRUE),
                'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
                'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan',TRUE),
            	  );
                $this->jadwal->insert($data);
              }
              // print_r($data);
                $this->session->set_flashdata('message', 'Simpan Data Success');
                redirect(site_url('som/jadwal'));
           // }
        }

        function queue(){
          $this->session->set_userdata('brgQty', $this->input->post('data'));
          print_r($this->session->userdata('brgQty'));

        }

        public function update($id)
        {
            $row = $this->jadwal->get_by_id($id);

            if ($row) {
              $data = array(
                'button'     => 'Update',
                'action'     => site_url('som/jadwal/update_action'),
          	    'id'  => set_value('id', $row->id),
          	    'id_jadwal'   => set_value('id_jadwal', $row->id_jadwal),
          	    'wp_barang_id'  => set_value('wp_barang_id', $row->wp_barang_id),
                  'qty'    => set_value('qty', $row->qty),
                  'start'    => set_value('start', $row->start),
                  'end'        => set_value('end', $row->end),
                  'title'        => set_value('title', $row->title),
                  'color'        => set_value('color', $row->color),
                  'description'        => set_value('description', $row->description),
                  'wp_pelanggan_id'        => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
                  'wp_karyawan_id_karyawan'        => set_value('wp_karyawan_id_karyawan', $row->wp_karyawan_id_karyawan),
                'aktif'      => 'Jadwal',
                'menu'       => $this->permit[0],
                'submenu'	   => $this->permit[1],
                'content'    => 'jadwal/form_jadwal',
                'judul'      => 'Dashboard',
                'sub_judul'  => 'Jadwal'
                );

                $this->load->view('panel/dashboard', $data);
            } else {
                $this->session->set_flashdata('msg', 'Data Tidak Ada');
                redirect(site_url('som/jadwal'));
            }
        }


        public function update_action()
        {
            // $this->_rules();

            // if ($this->form_validation->run() == FALSE) {
            //     $this->update($this->input->post('id_jadwal', TRUE));
            // } else {
            $data = array(
                'wp_barang_id' => $this->input->post('wp_barang_id',TRUE),
                'qty' => $this->input->post('qty',TRUE),
                'start' => $this->input->post('start',TRUE),
                'end' => date('Y-m-d H:i:s'),
                'username' => $this->session->identity,
                'title' => $this->input->post('title',TRUE),
                'color' => $this->input->post('color',TRUE),
                'description' => $this->input->post('description',TRUE),
                'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
                'wp_karyawan_id_karyawan' => $this->input->post('wp_karyawan_id_karyawan',TRUE),
                );

                $this->jadwal->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('som/jadwal'));
            //}
        }

        public function delete($id)
        {
            $row = $this->jadwal->get_by_id($id);

            if ($row) {
                $this->jadwal->delete($id);
                $this->session->set_flashdata('message', 'Hapus Data Success');
                redirect(site_url('som/jadwal'));
            } else {
                $this->session->set_flashdata('msg', 'Data Tidak Ada');
                redirect(site_url('som/jadwal'));
            }
        }

        public function _rules()
        {
        	$this->form_validation->set_rules('wp_barang_id', 'nama barang', 'trim|required');
        	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
            $this->form_validation->set_rules('start', 'start', 'trim|required');
        	$this->form_validation->set_rules('end', 'end', 'trim|required');
        	$this->form_validation->set_rusles('title', 'Judul', 'trim');
            $this->form_validation->set_rules('color', 'Color', 'trim');
            $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
            $this->form_validation->set_rules('wp_pelanggan_id', 'Nama Pelanggan', 'trim');
            $this->form_validation->set_rules('wp_karyawan_id_karyawan', 'Nama Karyawan', 'trim');
        }

        public function excel()
        {
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
