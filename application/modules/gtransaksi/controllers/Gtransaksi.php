<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gtransaksi extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Model_gtransaksi', 'gtransaksi');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    }
    

    public function index()
    {   
        $data = array(
            'aktif'			=>'gtransaksi',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Growth Transaksi',
            'content'		=>'main',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);   
    }

    function get_all()
    {
        $pesan = "";
        $jumlah_transaksi = 0;
        $jumlah_qty = 0;
        $jumlah_customer = 0;
        $new_customer = 0;
        $pesan .= ' <tr> 
                        <td><b>Transaksi</b></td> 
                        ';
                        for ($i=1; $i <= 12; $i++) { 
                        $pesan .= '<td>'.$this->gtransaksi->count_transaksi($i).'</td>
                        ';
                        $jumlah_transaksi += $this->gtransaksi->count_transaksi($i);
                        }
                        $pesan .= '<td>'.$jumlah_transaksi.'</td>';
                    
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Qty</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_qty($i).'</td>';
                            $jumlah_qty += $this->gtransaksi->count_qty($i);
                        }
                        $pesan .= '<td>'.$jumlah_qty.'</td>';
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Customer Aktif</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_customer($i).'</td>';
                            $jumlah_customer += $this->gtransaksi->count_customer($i);
                        }
                        $pesan .= '<td>'.$jumlah_customer.'</td>';
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>New Customer</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_newcustomer($i).'</td>';
                            $new_customer += $this->gtransaksi->count_newcustomer($i);
                        }
                        $pesan .= '<td>'.$new_customer.'</td>';
                        ';
                    </tr>
        ';
        echo $pesan;
    }

    function load_growth_transaksi()
    {
        # code...
        $tahun = $this->input->post('tahun');
        $pesan = "";
        $jumlah_transaksi = 0;
        $jumlah_qty = 0;
        $jumlah_customer = 0;
        $new_customer = 0;
        $pesan .= ' <tr> 
                        <td><b>Transaksi</b></td> 
                        ';
                        for ($i=1; $i <= 12; $i++) { 
                        $pesan .= '<td>'.$this->gtransaksi->count_transaksi_tahun($i, $tahun).'</td>'
                        ;
                        $jumlah_transaksi += $this->gtransaksi->count_transaksi_tahun($i, $tahun);
                        }
                        $pesan .= '<td>'.$jumlah_transaksi.'</td>';
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Qty</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_qty_tahun($i, $tahun).'</td>'
                        ;
                        $jumlah_qty += $this->gtransaksi->count_qty_tahun($i, $tahun);
                    }
                    $pesan .= '<td>'.$jumlah_qty.'</td>';
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>Customer Aktif</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_customer_tahun($i, $tahun).'</td>'
                        ;
                        $jumlah_customer += $this->gtransaksi->count_customer_tahun($i, $tahun);
                    }
                    $pesan .='<td>'.$jumlah_customer.'</td>';
                    $pesan .='
                    </tr>
                    <tr>
                        <td><b>New Customer</b></td>';
                        for ($i=1; $i <= 12; $i++) { 
                            $pesan .= '<td>'.$this->gtransaksi->count_newcustomer_tahun($i, $tahun).'</td>'
                        ;
                        $new_customer += $this->gtransaksi->count_newcustomer_tahun($i, $tahun);
                        }
                        $pesan .='<td>'.$new_customer.'</td>';
                        ';
                    </tr>
        ';
        echo $pesan;

    }

    function excelg($tahun)
    {
        $this->load->helper('exportexcel');
        $namaFile = "growth_transaksi.xls";
        $judul = "Growth_Transaksi";
        $tablehead = 3;
        $tablebody = 4;
        $jumlah_transaksi = 0;
        $jumlah_qty = 0;
        $jumlah_customer = 0;
        $new_customer = 0;
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
        xlsWriteLabel(0, 0, "Laporan Growth Transaksi");
        xlsWriteLabel(1, 0, "Tahun");
        xlsWriteLabel(1, 1, $tahun);
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "");
        xlsWriteLabel($tablehead, $kolomhead++, "Januari");
        xlsWriteLabel($tablehead, $kolomhead++, "Februari");
        xlsWriteLabel($tablehead, $kolomhead++, "Maret");
        xlsWriteLabel($tablehead, $kolomhead++, "Apri");
        xlsWriteLabel($tablehead, $kolomhead++, "Mei");
        xlsWriteLabel($tablehead, $kolomhead++, "Juni");
        xlsWriteLabel($tablehead, $kolomhead++, "Juli");
        xlsWriteLabel($tablehead, $kolomhead++, "Agustus");
        xlsWriteLabel($tablehead, $kolomhead++, "September");
        xlsWriteLabel($tablehead, $kolomhead++, "Oktober");
        xlsWriteLabel($tablehead, $kolomhead++, "November");
        xlsWriteLabel($tablehead, $kolomhead++, "Desember");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

            # code...
            $kolombody = 0;
            xlsWriteLabel($tablebody, $kolombody++, 'Transaksi');
            for ($i=1; $i <= 12; $i++) { 
                # code...
                xlsWriteNumber($tablebody, $kolombody++, $this->gtransaksi->count_transaksi_tahun($i, $tahun));
                $jumlah_transaksi += $this->gtransaksi->count_transaksi_tahun($i, $tahun);
            }
            xlsWriteNumber($tablebody, $kolombody++, $jumlah_transaksi);
            $tablebody++;
            $kolombody = 0;
            xlsWriteLabel($tablebody, $kolombody++, 'Qty');
            for ($i=1; $i <= 12; $i++) { 
                # code...
                xlsWriteNumber($tablebody, $kolombody++, $this->gtransaksi->count_qty_tahun($i, $tahun));
                $jumlah_qty += $this->gtransaksi->count_qty_tahun($i, $tahun);
            }
            xlsWriteNumber($tablebody, $kolombody++, $jumlah_qty);
            $tablebody++;
            $kolombody = 0;
            xlsWriteLabel($tablebody, $kolombody++, 'Customer Aktif');
            for ($i=1; $i <= 12; $i++) { 
                # code...
                xlsWriteNumber($tablebody, $kolombody++, $this->gtransaksi->count_customer_tahun($i, $tahun));
                $jumlah_customer += $this->gtransaksi->count_customer_tahun($i, $tahun);
            }
            xlsWriteNumber($tablebody, $kolombody++, $jumlah_customer);
            $tablebody++;
            $kolombody = 0;
            xlsWriteLabel($tablebody, $kolombody++, 'New Customer');
            for ($i=1; $i <= 12; $i++) { 
                # code...
                xlsWriteNumber($tablebody, $kolombody++, $this->gtransaksi->count_newcustomer_tahun($i, $tahun));
                $new_customer += $this->gtransaksi->count_newcustomer_tahun($i, $tahun);
            }
            xlsWriteNumber($tablebody, $kolombody++, $new_customer);
            $tablebody++;
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
    
}

/* End of file Gtransaksi.php */
