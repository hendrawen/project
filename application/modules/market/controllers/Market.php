<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Market extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Market_model','model');
        
    }

    function index()
    {
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Market Share',
            'content'		=>'market_view',
            'bulan' => $this->model->get_month(),
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $record) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $record->kota;
            $row[] = $record->kecamatan;
            $row[] = $record->kelurahan;
            for ($i=1; $i <= 12; $i++) { 
                $row[] = $this->model->count_customer($record->kelurahan);
                $row[] = $this->model->count_active($record->kelurahan, $i);
                $row[] = $this->model->count_qty($record->kelurahan, $i);
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all(),
                        "recordsFiltered" => $this->model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    function get_jumlah_customer($month, $year)
    {
        $this->db->where('', $Value);
        
    }

}

/* End of file Market.php */
