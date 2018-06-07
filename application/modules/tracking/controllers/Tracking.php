<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model','model');
        $this->load->model('pelanggan/Daerah_model','daerah');
        
    }

    function index()
    {
        $data = array(
            'aktif'			=>'Market',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Market Share',
            'content'		=>'view',
            'bulan' => $this->model->get_month(),
            'list_kota' => $this->daerah->get_kota(),
        );
        $this->load->view('panel/dashboard', $data);
    }

    public function ajax_list()
    {
        $tahun = 'semua';
        if($this->input->post('tahun')){
            $tahun = $this->input->post('tahun');
        }
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $this_month = date('n');
        foreach ($list as $record) {
            $utang = $this->model->laporan_pelanggan_utang($record->id_pelanggan, $tahun);
            $no++;
            $row = array();
            $row[0] = $no;
            $temp = 0;
            
            $cek = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $this_month, $tahun);
            if ($cek > 0) {
                $row[2] = $this->warna('hijau',$record->nama_pelanggan);
            } else {
                $cek = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $this_month-1, $tahun);
                if ($cek > 0) {
                    $row[2] = $this->warna('biru',$record->nama_pelanggan);
                } else {
                    $cek = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $this_month-2, $tahun);
                    if ($cek > 0) {
                        $row[2] = $this->warna('kuning',$record->nama_pelanggan);
                    } else {
                        $cek = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $this_month-3, $tahun);
                        if ($cek > 0) {
                            $row[2] = $this->warna('orange',$record->nama_pelanggan);
                        } else {
                            $cek = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $this_month-4, $tahun);
                            if ($cek > 0) {
                                $row[2] = $this->warna('jingga',$record->nama_pelanggan);
                            } else {
                                
                                    $row[2] = $this->warna('hijau-muda',$record->nama_pelanggan);
                                
                            }
                        }
                    }
                }
                
            }
                
                        
            
            
            $row[1] = $record->id_pelanggan;
            $row[3] = $record->no_telp;
            $row[4] = $record->kota;
            $row[5] = $record->kecamatan;
            $row[6] = $record->kelurahan;
            $row[7] = $record->nama;
            $row[8] = angka($utang);

            for ($i=1; $i <= 12; $i++) { 
                $count_trx = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $i, $tahun);
                $count_qty = $this->model->laporan_pelanggan_qty($record->id_pelanggan, $i, $tahun);
                $row[] = angka($count_trx);
                $row[] = angka($count_qty);
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all(),
                        "recordsFiltered" => $this->model->count_filtered(),
                        "data" => $data
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
            xlsWriteLabel($tablehead, (($kolomhead++) + $j), $bulan[$i]['month']);
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

        exit();
        echo '<pre>';
        print_r($this->model->get_laporan('all','all','all'));
        echo '</pre>';
    }
    
    function warna($color, $value)
    {
        $result = "";
        switch ($color) {
            case 'biru':
                $result = '<span class="label label-biru">'.$value.'</span>';
                break;
            case 'merah' :
                $result = '<span class="label label-merah">'.$value.'</span>';
                break;
            case 'hijau' :
                $result = '<span class="label label-hijau">'.$value.'</span>';
                break;
            case 'kuning' :
                $result = '<span class="label label-kuning">'.$value.'</span>';
                break;
            case 'jingga' :
                $result = '<span class="label label-jingga">'.$value.'</span>';
                break;
            case 'hijau-muda' :
                $result = '<span class="label label-hijau-muda">'.$value.'</span>';
                break;
            case 'orange' :
                $result = '<span class="label label-warning">'.$value.'</span>';
                break;
            default:
                $result = '<span class="label label-default">'.$value.'</span>';
                break;
        }
        return $result;
    }

}

/* End of file Market.php */
