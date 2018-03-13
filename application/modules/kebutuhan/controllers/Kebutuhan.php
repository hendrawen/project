<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebutuhan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Model_kebutuhan','kebutuhan');
  }

  function index()
  {
    $data['aktif']			='Kebutuhan';
		$data['title']			='Kebuthan Pelanggan';
		$data['judul']			='Data Kebutuhan Pelanggan';
		$data['sub_judul']		='';
    $data['content']			= 'kebutuhan';
    $data['kebutuhan'] = $this->kebutuhan->show_kebutuhan();
    $this->load->view('panel/dashboard', $data);
  }

  public function ajax_list()
    {
        $list = $this->kebutuhan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kebutuhans) {
            $row = array();
            $row[] = $kebutuhans->id_pelanggan;
            $row[] = $kebutuhans->nama_pelanggan;
            $row[] = $kebutuhans->no_telp;
            $row[] = $kebutuhans->jenis;
            $row[] = $kebutuhans->jumlah;
            $row[] = tgl_indo($kebutuhans->tgl);

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kebutuhan->count_all(),
                        "recordsFiltered" => $this->kebutuhan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function tambah()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('kebutuhan/create_action'),
      	    'id' => set_value('id'),
      	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
      	    'wp_jkebutuhan_id' => set_value('wp_jkebutuhan_id'),
      	    'jumlah' => set_value('jumlah'),
      	    'tgl' => set_value('tgl'),
	      );
        $data['aktif']			='Kebutuhan';
        $data['title']			='Data Kebutuhan';
        $data['judul']			='Kebutuhan';
        $data['sub_judul']		='';
        $data['content']			= 'form';
        $this->load->view('panel/dashboard', $data);
    }

    public function presentasi()
    {
      # code...
      $data['aktif']			='Kebutuhan/presentasi';
      $data['title']			='Data Kebutuhan';
      $data['judul']			='Report Kebutuhan';
      $data['sub_judul']		='';
      $data['content']			= 'presentasi';
      $this->load->view('panel/dashboard', $data);

    }

    public function proses_laporan()
    {
      # code...
       $date1 = $this->input->post('awal');
       $date2 = $this->input->post('akhir');
       $date3 = $this->input->post('tahun');
       $data = array(
         'date1' => $date1,
         'date2' => $date2,
         'date3' => $date3
       );
       if ($date1 == "" || $date2 == "" || $date3 == "" ) {
       $data['date_range_error_message'] = "Both date fields are required";
       } else {
       $result = $this->kebutuhan->show_data_by_date($data);
       $result2 = $this->kebutuhan->show_progres($data);
       if ($result != false) {
       $data['result_display'] = $result;
       $data['result_display2'] = $result2;
       } else {
       $data['result_display'] = "No record found !";
       $data['result_display2'] = "No record found !";
       }
       }
       $data['aktif']			='Kebutuhan/presentasi';
       $data['title']			='Data Kebutuhan';
       $data['judul']			='Report Kebutuhan';
       $data['sub_judul']		='';
       $data['content']			= 'presentasi';
       // $data['pesanan'] = $this->Pesanan_model->total_baru();
       // $data['data']=$this->Report_model->get_all();
       // $data['record']		= $this->Report_model->get_produk();
       // $sum = $this->Report_model->sum2($data);
       // $data['sum'] = $sum;
       $data['show_table'] = $this->view_table();
       $this->load->view('panel/dashboard', $data);
    }

    public function view_table(){
        $result = $this->kebutuhan->show_all_data();
        if ($result != false) {
        return $result;
        } else {
        return 'Database is empty !';
        }
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
          		'wp_jkebutuhan_id' => $this->input->post('wp_jkebutuhan_id',TRUE),
          		'jumlah' => $this->input->post('jumlah',TRUE),
          		'tgl' => date('Y-m-d H:i:s'),
	           );

            $this->kebutuhan->save($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kebutuhan'));
        }
    }

    public function update($id)
    {
        $row = $this->Model_kebutuhan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kebutuhan/update_action'),
            		'id' => set_value('id', $row->id),
            		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
            		'wp_jkebutuhan_id' => set_value('wp_jkebutuhan_id', $row->wp_jkebutuhan_id),
            		'jumlah' => set_value('jumlah', $row->jumlah),
            		'tgl' => set_value('tgl', $row->tgl),
	    );
            $this->load->view('kebutuhan/wp_kebutuhan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kebutuhan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
            		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
            		'wp_jkebutuhan_id' => $this->input->post('wp_jkebutuhan_id',TRUE),
            		'jumlah' => $this->input->post('jumlah',TRUE),
            		'tgl' => $this->input->post('tgl',TRUE),
        	    );

            $this->Model_kebutuhan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kebutuhan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Model_kebutuhan->get_by_id($id);

        if ($row) {
            $this->Model_kebutuhan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kebutuhan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kebutuhan'));
        }
    }

    public function _rules()
    {
      	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
      	$this->form_validation->set_rules('wp_jkebutuhan_id', 'wp jkebutuhan id', 'trim|required');
      	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

      	$this->form_validation->set_rules('id', 'id', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
