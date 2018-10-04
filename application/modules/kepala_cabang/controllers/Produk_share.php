<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_share extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Models_share', 'produk');
        $this->load->model('pelanggan/Daerah_model','daerah');
        
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Kepala Cabang')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    }
    
    public function index()
    {   
        $to = date('n');
        $from = $to - 1 ;
        $year = date('Y');

        // $record = $this->mLap->laporan_pelanggan($from, $to, $year);
        $data = array(
            'aktif'			=>'produk',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Produk',
            'content'		=>'produk/main_share',
            'month'         => $this->month,
            // 'record'    => $record,
            'from'  => set_value('from', $from),
            'to'  => set_value('to', $to),
            'year'  => set_value('year', $year)
        );
        $data['list_kota'] = $this->daerah->get_kota();
        // $data['kelurahan'] = $this->produk->kelurahan_all();
        $data['barang']    = $this->produk->get_barang();
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('dashboard', $data);
    }

    function load_kota()
    {
        # code...
        $kelurahan = $this->produk->get_kelurahan();
        $id_barang = $this->produk->get_id_barang();
        $data = $this->produk->kelurahan_all();
        $total = 0;
        $pesan = "";
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '
            <tr>
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>';
            foreach ($id_barang as $key) {
                # code...
            $pesan .= '
            <td>'.$this->produk->count_produk($row->kelurahan, $key->id).'</td>';
            }
            $pesan .= '
            </tr>';
        }

        } else {
        $pesan = '
        <td colspan=16>Record not found</td>
        ';

        }
        echo $pesan;
    }

    function load_filter()
    {
        # code...
        $kelurahan = $this->produk->get_kelurahan();
        $id_barang = $this->produk->get_id_barang();
        $kota = $this->input->post('kota');
        $kecamatan = $this->input->post('kecamatan');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $year = $this->input->post('year');
        $data = $this->produk->kelurahan_filter($kota, $kecamatan, $from, $to, $year);
        $total = 0;
        $pesan = "";
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '
            <tr>
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>';
            foreach ($id_barang as $key) {
                # code...
            $pesan .= '
            <td>'.$this->produk->count_produk($row->kelurahan, $key->id).'</td>';
            }
            $pesan .= '
            </tr>';
        }

        } else {
        $pesan = '
        <td colspan=16>Record not found</td>
        ';

        }
        echo $pesan;
    }

    function excel_produk_share($kota, $kecamatan, $from, $to, $year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "produk_share.xls";
        $judul = "Produk Share";
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
        xlsWriteLabel(0, 0, "Laporan");
        xlsWriteLabel(1, 0, "Tahun");
        xlsWriteLabel(0, 1, "Kota : ".$kota ."Kecamatan : " .$kecamatan);
        xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);

        $barang = $this->produk->get_barang();
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kota");
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        foreach ($barang as $key) {
            # code...
            xlsWriteLabel($tablehead, $kolomhead++, $key->nama_barang);
        }
        $record = $this->produk->kelurahan_filter_excel($kota, $kecamatan, $from, $to, $year);
        $id_barang = $this->produk->get_id_barang();
        foreach ($record as $data) {
            $kolombody = 0;
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kota);
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            foreach ($id_barang as $row) {
                # code...
                xlsWriteNumber($tablebody, $kolombody++, $this->produk->count_produk($data->kecamatan, $row->id));                
            }
            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function get_month($value)
    {
        $res;
        $month = array('Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember');
        for ($i=0; $i < sizeOf($month); $i++) {
        if ($value == $i) {
            $res = $month[$i-1];
            break;
        }
        }
        return $res;
    }


    function cek()
    {
        # code...
        // print_r($this->produk->get_id_barang());
        print_r($this->produk->count_produk('pagesangan barat'));
    }

}

/* End of file Produk.php */
