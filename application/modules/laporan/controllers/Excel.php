<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Models_laporan');
        
    }
    

    function bulanan($from, $to, $year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "pembayaran_bulanan.xls";
        $judul = "pembayaran";
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
        xlsWriteLabel(1, 0, "Periode");
        xlsWriteLabel(0, 1, "Bulanan");
        xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
        xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
        xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "QTY");
        xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
        xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
        xlsWriteLabel($tablehead, $kolomhead++, "Debt");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Piutang");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->laporan_bulanan($from, $to, $year);
        $total = 0;
        foreach ($record as $data) {
            $kolombody = 0;
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
            xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->qty);
            xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->subtotal);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_bayar);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa_hutang);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_status);
            $tablebody++;
            $nourut++;
            $total += $data->bayar;
        }
        xlsWriteLabel($tablebody, 15, 'Total');
        xlsWriteNumber($tablebody, 16, $total);
        xlsEOF();
        exit();
    }

    function Penarikan_bulanan($from, $to, $year)
    {
        $this->load->helper('exportexcel');
        $namaFile = "penarikan_bulanan.xls";
        $judul = "penarikan";
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
        xlsWriteLabel(1, 0, "Periode");
        xlsWriteLabel(0, 1, "Bulanan");
        xlsWriteLabel(1, 1, $this->get_month($from).' - '.$this->get_month($to).' '.$year);
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "No Faktur");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Kirim");
        xlsWriteLabel($tablehead, $kolomhead++, "Jatuh Tempo");
        xlsWriteLabel($tablehead, $kolomhead++, "ID Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pelanggan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "QTY");
        xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");
        xlsWriteLabel($tablehead, $kolomhead++, "Surveyor");
        xlsWriteLabel($tablehead, $kolomhead++, "Debt");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Penarikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Penarikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa ASET");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        
        $record = $this->Models_laporan->penarikan_bulanan($from, $to, $year);
        $total = 0;
        foreach ($record as $data) {
            $kolombody = 0;
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_transaksi);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_transaksi);
            xlsWriteLabel($tablebody, $kolombody++, $data->jatuh_tempo);
            xlsWriteLabel($tablebody, $kolombody++, $data->id_pelanggan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_pelanggan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
            xlsWriteNumber($tablebody, $kolombody++, $data->qty);
            xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar_krat);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_penarikan);
            xlsWriteNumber($tablebody, $kolombody++, $data->bayar_uang);
            xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
            xlsWriteNumber($tablebody, $kolombody++, $data->sisa);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            $tablebody++;
            $nourut++;
            $total += $data->sisa;
        }
        xlsWriteLabel($tablebody, 19, 'Total sisa aset');
        xlsWriteNumber($tablebody, 20, $total);
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

    function get_nama_barang($id_barang)
    {
        $this->db->where('id', $id_barang);
        $record = $this->db->get('wp_barang')->row();
        return $record->nama_barang;
    }


}

/* End of file Excel.php */
