<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Market extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Market_model','model');
        $this->load->model('pelanggan/Daerah_model','daerah');
        
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
            'list_kota' => $this->daerah->get_kota(),
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
        echo json_encode($output);
    }

    function get_jumlah_customer($month, $year)
    {
        $this->db->where('', $Value);
        
    }

    // excel
    function download_excel($year, $kota, $kecamatan)
    {
        $kota =str_ireplace("%20"," ",$kota);
        $kecamatan =str_ireplace("%20"," ",$kecamatan);
        $this->load->helper('exportexcel');
        $namaFile = "market_share.xls";
        $judul = "MarketShare";
        $tablehead = 5;
        $tablebody = 6;
        $nourut = 1;
        $bulan = $this->model->get_month();
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
        xlsWriteLabel(0, 0, "Laporan");
        xlsWriteLabel(0, 1, "Market Share");

        xlsWriteLabel(1, 0, "Tahun");
        xlsWriteLabel(1, 1, $year);

        xlsWriteLabel(2, 0, "Kota");
        xlsWriteLabel(2, 1, $kota);

        xlsWriteLabel(3, 0, "Kecamatan");
        xlsWriteLabel(3, 1, $kecamatan);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "KOTA");
        xlsWriteLabel($tablehead, $kolomhead++, "KECAMATAN");
        xlsWriteLabel($tablehead, $kolomhead++, "KELURAHAN");
        $i = 0;
        $j = 2;

        for ($i == 0; $i < 12 ; $i++) {
            if ($i == 0) {
                xlsWriteLabel($tablehead, ($kolomhead++), $bulan[$i]['month']);
            } else {
                xlsWriteLabel($tablehead, (($kolomhead++) + $j), $bulan[$i]['month']);
                $j+=2;
            }
        }
        $kolomhead = 4;
        
        for ($i = 0; $i < 12; $i++) {
            xlsWriteLabel($tablehead+1, $kolomhead++, 'CST');
            xlsWriteLabel($tablehead+1, $kolomhead++, 'AKT');
            xlsWriteLabel($tablehead+1, $kolomhead++, 'QTY');
        }
            
        $tablebody++;
        $record = $this->model->get_laporan($year, $kota, $kecamatan);
        foreach ($record as $data) {
            $kolombody = 0;
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kota);
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            for ($i=1; $i <= 12; $i++) { 
                xlsWriteNumber($tablebody, $kolombody++, $this->model->count_customer($data->kelurahan));
                xlsWriteNumber($tablebody, $kolombody++, $this->model->count_active($data->kelurahan, $i));
                xlsWriteNumber($tablebody, $kolombody++, $this->model->count_qty($data->kelurahan, $i));
            }
            $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    function tes()
    {
        echo '<pre>';
        print_r($this->model->get_laporan('all','all','all'));
        echo '</pre>';
    }

}

/* End of file Market.php */
