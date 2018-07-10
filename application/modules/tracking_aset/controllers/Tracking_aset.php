<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_aset extends CI_Controller {

    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('Model','model');
        $this->load->model('pelanggan/Daerah_model','daerah');
        
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
		} 
    }

    function index()
    {
        $data = array(
            'aktif'			=>'Tracking',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Tracking Aset',
            'content'		=>'view',
            'bulan' => $this->model->get_month(),
            'list_kota' => $this->daerah->get_kota(),
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
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
                // $count_trx = $this->model->laporan_pelanggan_trx($record->id_pelanggan, $i, $tahun);
                $krat = $this->model->get_krat($record->id_pelanggan, $i, $tahun);
                
                $row[] = angka($krat['bayar_krat']);
                $row[] = angka($krat['bayar_uang']);
                $row[] = angka($krat['turun_krat']);
                $row[] = angka($krat['sisa']);
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
        $namaFile = "tracking_aset.xls";
        $judul = "TrackingAset";
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
        xlsWriteLabel(0, 1, "Tracking Aset");

        xlsWriteLabel(1, 0, "Tahun");
        xlsWriteLabel(1, 1, $year);

        xlsWriteLabel(2, 0, "Kota");
        xlsWriteLabel(2, 1, $kota);

        xlsWriteLabel(3, 0, "Kecamatan");
        xlsWriteLabel(3, 1, $kecamatan);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "ID CUSTOMER");
        xlsWriteLabel($tablehead, $kolomhead++, "NAMA CUSTOMER");
        xlsWriteLabel($tablehead, $kolomhead++, "TELPON");
        xlsWriteLabel($tablehead, $kolomhead++, "KOTA");
        xlsWriteLabel($tablehead, $kolomhead++, "KECAMATAN");
        xlsWriteLabel($tablehead, $kolomhead++, "KELURAHAN");
        xlsWriteLabel($tablehead, $kolomhead++, "SURVEYOUR");
        xlsWriteLabel($tablehead, $kolomhead++, "PIUTANG");
        
        $i = 0;
        $j = 3;

        for ($i == 0; $i < 12 ; $i++) {
            if ($i == 0) {
                xlsWriteLabel($tablehead, ($kolomhead++), $bulan[$i]['month']);
            } else {
                xlsWriteLabel($tablehead, (($kolomhead++) + $j), $bulan[$i]['month']);
                $j+=3;
            }
        }
        $kolomhead = 9;
        
        for ($i = 0; $i < 12; $i++) {
            xlsWriteLabel($tablehead+1, $kolomhead++, 'Naik Krat');
            xlsWriteLabel($tablehead+1, $kolomhead++, 'Naik Bayar');
            xlsWriteLabel($tablehead+1, $kolomhead++, 'Turun');
            xlsWriteLabel($tablehead+1, $kolomhead++, 'Sisa');
        }
            
        $tablebody++;
        $record = $this->model->get_laporan_excel($kota, $kecamatan);
        if ($record){
            foreach ($record as $data) {
                $kolombody = 0;
                $utang = $this->model->laporan_pelanggan_utang($data->id_pelanggan, $year);
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
                xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
                xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
                xlsWriteLabel($tablebody, $kolombody++, $data->kota);
                xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
                xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
                xlsWriteLabel($tablebody, $kolombody++, $data->nama);
                xlsWriteLabel($tablebody, $kolombody++, $utang);
                for ($i=1; $i <= 12; $i++) { 
                    $krat = $this->model->get_krat($data->id_pelanggan, $i, $year);
                
                    xlsWriteNumber($tablebody, $kolombody++, $krat['bayar_krat']);
                    xlsWriteNumber($tablebody, $kolombody++, $krat['bayar_uang']);
                    xlsWriteNumber($tablebody, $kolombody++, $krat['turun_krat']);
                    xlsWriteNumber($tablebody, $kolombody++, floor($krat['sisa']));
                }
                $tablebody++;
                $nourut++;
            }
        }
        xlsEOF();
        exit();
    }

    function tes()
    {

        echo '<pre>';
        print_r($this->model->get_laporan_excel("KOTA BANDA ACEH","all"));
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
                break;$row[1] = $record->id_pelanggan;
                $row[3] = $record->no_telp;
                $row[4] = $record->kota;
                $row[5] = $record->kecamatan;
                $row[6] = $record->kelurahan;
                $row[7] = $record->nama;
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

/* End of file Tracking.php */