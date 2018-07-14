<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Takeorder extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('Marketing')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
        $this->load->model('Takeorder_model', 'takeorder');
        
    }

    public function index()
    {
        # code...
        $data['aktif']			='Active Call';
		$data['title']			='Brajamarketindo';
		$data['judul']			='Dashboard';
        $data['sub_judul']		='Jadwal';
        $data['judul_list']		='Pengiriman';
        $data['content']			= 'takeorder/main';
        $statuse = $this->takeorder->get_list_status();

        $opt = array('' => 'Semua Status');
            foreach ($statuse as $status) {
                $opt[$status] = $status;
        }
        $data['form_status'] = form_dropdown('',$opt,'','id="status" class="form-control"');
        $this->load->view('panel/dashboard', $data);
    }

    public function ajax_list()
    {
        $list = $this->takeorder->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lists) {
            $row = array();
            $row[] = tgl_indo($lists->tanggal);
            $row[] = $lists->id_pelanggan;
            $row[] = $lists->nama_pelanggan;
            $row[] = $lists->barang;
            $row[] = $lists->qty;
            $row[] = $lists->satuan;
            $row[] = tgl_indo($lists->tgl_kirim);
            $row[] = $lists->status;
            $row[] = $lists->sumber_data;
            $row[] = $lists->keterangan;
            $row[] = '
            <a href="'.base_url('effectifcall/update/'.$lists->id).'" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <a type="button" href="javascript:void(0)" title="Hapus" onclick="delete_call('."'".$lists->id."'".')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                     ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->takeorder->count_all(),
                        "recordsFiltered" => $this->takeorder->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function tambah()
    {   
        $data = array(
              'button' => 'Tambah',
              'action' => site_url('marketing/takeorder/aksi_tambah'),
              'id' => set_value('id'),
        	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
        	    'barang' => set_value('barang'),
              'satuan' => set_value('satuan'),
        	    'qty' => set_value('qty'),
        	    'tgl_kirim' => set_value('tgl_kirim'),
        	    'keterangan' => set_value('keterangan'),
        	    'sumber_data' => set_value('sumber_data'),
        	    'by_status' => set_value('by_status'),
        	    'wp_status_effectif_id' => set_value('wp_status_effectif_id'),
        	    'created_at' => set_value('created_at'),
        	    'updated_at' => set_value('updated_at'),
          );
          $data['aktif']			='Active Call';
      	  $data['title']			='Brajamarketindo';
      	  $data['judul']			='Dashboard';
          $data['sub_judul']		='List Effectif Call';
          $data['content']			= 'takeorder/form';
          $this->load->view('dashboard', $data);
    }

    public function aksi_tambah()
    {
      # code...
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
          $this->tambah();
      } else {
          $data = array(
                      //status lunas
                      'tanggal' => date('Y-m-d'),
                      'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id', true),
                      'barang' => $this->input->post('barang', true),
                      'qty' => $this->input->post('qty', true),
                      'satuan'  => $this->input->post('satuan', true),
                      'tgl_kirim' => $this->input->post('tgl_kirim', true),
                      'keterangan' => $this->input->post('keterangan', true),
                      'sumber_data' => $this->input->post('sumber_data', true),
                      'by_status' => $this->input->post('by_status', true),
                      'wp_status_effectif_id' => $this->input->post('wp_status_effectif_id', true),
                      'created_at' => date('Y-m-d H:i:s'),
                      'username' => $this->session->identity,
                    );
          $this->takeorder->save($data);
          $this->session->set_flashdata('message', 'tambah data berhasil');
          redirect(site_url('marketing/takeorder'));
        }
    }

    public function update($id)
    {   
        $row = $this->takeorder->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('takeorder/update_action'),
            		'id' => set_value('id', $row->id),
            		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
            		'barang' => set_value('barang', $row->barang),
            		'qty' => set_value('qty', $row->qty),
            		'satuan' => set_value('satuan', $row->satuan),
            		'tgl_kirim' => set_value('tgl_kirim', $row->tgl_kirim),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'sumber_data' => set_value('sumber_data', $row->sumber_data),
            		'by_status' => set_value('by_status', $row->by_status),
            		'wp_status_effectif_id' => set_value('wp_status_effectif_id', $row->wp_status_effectif_id),
                'username' => $this->session->identity,
	          );
            $data['aktif']			='Active Call';
        	$data['title']			='Brajamarketindo';
        	$data['judul']			='Dashboard';
            $data['sub_judul']		='List Effectif Call';
            $data['content']			= 'takeorder/form';
            $this->load->view('dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('marketing/takeorder'));
        }
    }

    public function update_action()
    {   
        $cek = get_permission('Effectif Call', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
              $data = array(
                'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id', true),
                'barang' => $this->input->post('barang', true),
                'qty' => $this->input->post('qty', true),
                'satuan'  => $this->input->post('satuan', true),
                'tgl_kirim' => $this->input->post('tgl_kirim', true),
                'keterangan' => $this->input->post('keterangan', true),
                'sumber_data' => $this->input->post('sumber_data', true),
                'by_status' => $this->input->post('by_status', true),
                'wp_status_effectif_id' => $this->input->post('wp_status_effectif_id', true),
                'updated_at' => date('Y-m-d H:i:s'),
                'username' => $this->session->identity,
              );
            $this->effectif->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('marketing/takeorder'));
        }
    }

    public function ajax_delete($id)
    {   
        $this->effectif->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function _rules()
    {
      # code...
    	$this->form_validation->set_rules('wp_pelanggan_id', 'ID Pelanggan', 'trim|required');
    	$this->form_validation->set_rules('wp_status_effectif_id', 'Status', 'trim|required');
    	$this->form_validation->set_rules('by_status', 'Status', 'trim|required');
    	$this->form_validation->set_rules('sumber_data', 'sumber_data', 'trim|required');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    

}

/* End of file Take order.php */
