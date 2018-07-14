<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_pelanggan extends CI_Controller {

    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model','model');
        $this->load->model('pelanggan/Daerah_model','daerah');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    }

    function index()
    {
        $data = array(
            'aktif'			=>'Status Pelanggan',
            'title'			=>'Status Pelanggan',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Status Pelanggan',
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
            $last_transaction = $this->model->get_last_transaction($record->id_pelanggan, $tahun);
            $last_followup = $this->model->get_follow_up($record->id_pelanggan, $tahun);
            if ($last_transaction) {
                
                $row[8] = tgl_indo($last_transaction->tgl_transaksi);//terakhir trx
                $row[9] = $last_transaction->nama_barang; // barang
                $row[10] = angka($last_transaction->qty); // qty
            } else {
                $row[8] = "-";//terakhir trx
                $row[9] = "-"; // barang
                $row[10] = "-"; // qty
            }
            
            $row[11] = angka($utang);
            if ($last_followup) {
                $row[12] = tgl_indo($last_followup->tanggal); // tgl folow up
                $row[13] = $last_followup->status; // status
            } else {
                $row[12] = "-"; // tgl folow up
                $row[13] = "-"; // status
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
        $namaFile = "status_pelanggan.xls";
        $judul = "StatusPelanggan";
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
        xlsWriteLabel(0, 1, "Status Pelanggan");

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
        xlsWriteLabel($tablehead, $kolomhead++, "TRANSAKSI TERAKHIR");
        xlsWriteLabel($tablehead, $kolomhead++, "NAMA BARANG");
        xlsWriteLabel($tablehead, $kolomhead++, "QTY");
        xlsWriteLabel($tablehead, $kolomhead++, "PIUTANG");
        xlsWriteLabel($tablehead, $kolomhead++, "TGL FOLLOWUP");
        xlsWriteLabel($tablehead, $kolomhead++, "STATUS");
        
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
                $last_transaction = $this->model->get_last_transaction($data->id_pelanggan, $year);
                $last_followup = $this->model->get_follow_up($data->id_pelanggan, $year);
                if ($last_transaction) {
                    
                    xlsWriteLabel($tablebody, $kolombody++, $last_transaction->tgl_transaksi);
                    xlsWriteLabel($tablebody, $kolombody++, $last_transaction->nama_barang);
                    xlsWriteNumber($tablebody, $kolombody++, $last_transaction->qty);
                } else {
                    xlsWriteLabel($tablebody, $kolombody++, '-');
                    xlsWriteLabel($tablebody, $kolombody++, '-');
                    xlsWriteNumber($tablebody, $kolombody++, '-');
                }
                
                $row[11] = angka($utang);
                if ($last_followup) {
                    xlsWriteLabel($tablebody, $kolombody++, $last_followup->tanggal);
                    xlsWriteLabel($tablebody, $kolombody++, $last_followup->status);
                } else {
                    xlsWriteLabel($tablebody, $kolombody++, '-');
                    xlsWriteLabel($tablebody, $kolombody++, '-');
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
        print_r($this->model->get_last_transaction(4));
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
