<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Debt_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function get_month()
    {
        $month = array(
            array ('key' => 1, 'month' => 'Januari'),
            array ('key' => 2, 'month' => 'Februari'),
            array ('key' => 3, 'month' => 'Maret'),
            array ('key' => 4, 'month' => 'April'),
            array ('key' => 5, 'month' => 'Mei'),
            array ('key' => 6, 'month' => 'Juni'),
            array ('key' => 7, 'month' => 'Juli'),
            array ('key' => 8, 'month' => 'Agustus'),
            array ('key' => 9, 'month' => 'September'),
            array ('key' => 10, 'month' => 'Oktober'),
            array ('key' => 11, 'month' => 'November'),
            array ('key' => 12, 'month' => 'Desember'),
        );
        return $month;
    }

    function get_customer_jadwal($date, $id_karyawan)
    {
        $this->db->select('count(id) as t');
        $this->db->where('DATE(start)', $date);
        if($id_karyawan != 'semua')
        {
            $this->db->where('wp_karyawan_id_karyawan', $id_karyawan);
        }
        $this->db->from('wp_jadwal');
        $count = $this->db->get()->row();
        return $count->t;
        
    }

    function get_customer_actual($date, $id_karyawan)
    {
        $this->db->select('count(distinct(wp_transaksi.wp_pelanggan_id)) as t');
        if($id_karyawan != 'semua')
        {
            $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
            $this->db->where('wp_pelanggan.wp_karyawan_id_karyawan', $id_karyawan);
        }
        $this->db->where('DATE(wp_transaksi.tgl_transaksi)', $date);
        $this->db->from('wp_transaksi');
        $count = $this->db->get()->row();
        return $count->t;
    }

    function get_muat($date, $id_karyawan)
    {
        $this->db->select('muat, satuan');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->result();
        $pesan = "";
        $size = sizeof($result) -1;
        for ($i=0; $i <= $size; $i++) {
            if ($i < $size) {
                $pesan .= $result[$i]->muat.' '.$result[$i]->satuan.' dan ';
            } else if ($i == $size){
                $pesan .= $result[$i]->muat.' '.$result[$i]->satuan;
            }
        }
        return $pesan;
    }

    function get_terkirim($date, $id_karyawan)
    {
        $this->db->select('terkirim, satuan_terkirim');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->result();
        $pesan = "";
        $size = sizeof($result) -1;
        for ($i=0; $i <= $size; $i++) {
            if ($i < $size) {
                $pesan .= $result[$i]->terkirim.' '.$result[$i]->satuan_terkirim.' dan ';
            } else if ($i == $size){
                $pesan .= $result[$i]->terkirim.' '.$result[$i]->satuan_terkirim;
            }
        }
        return $pesan;
    }

    function get_kembali($date, $id_karyawan)
    {
        $this->db->select('kembali, satuan_kembali');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->result();
        $pesan = "";
        $size = sizeof($result) -1;
        for ($i=0; $i <= $size; $i++) {
            if ($i < $size) {
                $pesan .= $result[$i]->kembali.' '.$result[$i]->satuan_kembali.' dan ';
            } else if ($i == $size){
                $pesan .= $result[$i]->kembali.' '.$result[$i]->satuan_kembali;
            }
        }
        return $pesan;
    }

    function get_return($date, $id_karyawan)
    {
        $this->db->select('return, satuan_return');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->result();
        $pesan = "";
        $size = sizeof($result) -1;
        for ($i=0; $i <= $size; $i++) {
            if ($i < $size) {
                $pesan .= $result[$i]->return.' '.$result[$i]->satuan_return.' dan ';
            } else if ($i == $size){
                $pesan .= $result[$i]->return.' '.$result[$i]->satuan_return;
            }
        }
        return $pesan;
    }

    function get_rusak($date, $id_karyawan)
    {
        $this->db->select('rusak, satuan_rusak');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->result();
        $pesan = "";
        $size = sizeof($result) -1;
        for ($i=0; $i <= $size; $i++) {
            if ($i < $size) {
                $pesan .= $result[$i]->rusak.' '.$result[$i]->satuan_rusak.' dan ';
            } else if ($i == $size){
                $pesan .= $result[$i]->rusak.' '.$result[$i]->satuan_rusak;
            }
        }
        return $pesan;
    }

    function get_barang($date, $id_karyawan)
    {
        $this->db->select('
        muat as muat,
        terkirim as terkirim,
        kembali as kembali, 
        return, 
        keterangan, rusak');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('DATE(tanggal)', $date);
        $result = $this->db->get('wp_debt_muat')->row();
        $resArray = array();
        if ($result) {
            $resArray = array(
                'muat' => $result->muat,
                'terkirim' => $result->terkirim,
                'kembali' => $result->kembali,
                'return' => $result->return,
                'keterangan' => $result->keterangan,
                'rusak' => $result->rusak,
            );
        } else {
            $resArray = array(
                'muat' => 0,
                'terkirim' => 0,
                'kembali' => 0,
                'return' => 0,
                'keterangan' => null,
                'rusak' => 0,
            );
        }
        return $resArray;
    }
    
    function get_target()
    {
        $this->db->select('target');
        $this->db->where('nama', 'Debt');
        $result = $this->db->get('wp_target')->row();
        return $result->target;
    }

    function get_qty($date, $id_karyawan)
    {
        $this->db->select('sum(qty) as t');
        $this->db->where('DATE(tgl_transaksi)', $date);
        if($id_karyawan != 'semua')
        {
            $this->db->join('wp_pelanggan', 'wp_pelanggan.id = wp_transaksi.wp_pelanggan_id', 'inner');
            $this->db->where('wp_pelanggan.wp_karyawan_id_karyawan', $id_karyawan);
        }
        $this->db->from('wp_transaksi');
        $count = $this->db->get()->row();
        return $count->t;
    }

    function get_penarikan($date, $id_karyawan)
    {
        $this->db->select('sum(wp_asis_debt.bayar_krat) as krat, sum(wp_asis_debt.bayar_uang) as value');
        $this->db->where('tanggal', $date);
        if($id_karyawan != 'semua')
        {
            // $this->db->join('wp_asis_debt', 'wp_asis_debt.id = wp_penarikan.wp_asis_debt_id', 'inner');
            $this->db->where('wp_asis_debt.username', $id_karyawan);
        }
        $this->db->group_by('wp_asis_debt.tanggal');
        $this->db->from('wp_asis_debt');
        $result = $this->db->get()->row();
        $resArray = array();
        if ($result) {
            $cek = strpos($result->krat,'.');
            $botol = 0;
            $krat = 0;
            if ($cek) {
                $result->krat -= 0.5;
                $botol = 12;
            }
            $resArray = array(
                'krat' => $result->krat,
                'botol' => $botol,
                'value' => $result->value,
            );
        } else {
            $resArray = array(
                'krat' => 0,
                'botol' => 0,
                'value' => 0,
            );
        }
        return $resArray;
    }

    function get_value($date, $id_karyawan)
    {
        $this->db->select('sum(pendapatan) as debet, sum(pengeluaran) as kredit');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('tanggal', $date);
        $result = $this->db->get('wp_kas')->row();
        $resArray = array();
        if ($result) {
            $resArray = array(
                'debet' => $result->debet,
                'kredit' => $result->kredit,
            );
        } else {
            $resArray = array(
                'debet' => 0,
                'kredit' => 0,
            );
        }
        return $resArray;
    }

    

    // function get total barang
    function get_total_muat($tahun, $bulan, $id_karyawan)
    {
        $this->db->select('muat, satuan');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('year(tanggal)', $tahun);
        $this->db->where('month(tanggal)', $bulan);
        $result = $this->db->get('wp_debt_muat')->result();
        $total_krat = 0; $total_dus = 0;
        foreach ($result as $key) {
            if ($key->satuan == 'Krat') {
                $total_krat += $key->muat;
            } else if ($key->satuan == 'Dus'){
                $total_dus += $key->muat;
            }
        }
        $pesan = $total_krat.' Krat dan '.$total_dus.' Dus';
        return $pesan;
    }

    function get_total_terkirim($tahun, $bulan, $id_karyawan)
    {
        $this->db->select('terkirim, satuan_terkirim');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('year(tanggal)', $tahun);
        $this->db->where('month(tanggal)', $bulan);
        $result = $this->db->get('wp_debt_muat')->result();
        $total_krat = 0; $total_dus = 0;
        foreach ($result as $key) {
            if ($key->satuan_terkirim == 'Krat') {
                $total_krat += $key->terkirim;
            } else if ($key->satuan_terkirim == 'Dus'){
                $total_dus += $key->terkirim;
            }
        }
        $pesan = $total_krat.' Krat dan '.$total_dus.' Dus';
        return $pesan;
    }

    function get_total_kembali($tahun, $bulan, $id_karyawan)
    {
        $this->db->select('kembali, satuan_kembali');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('year(tanggal)', $tahun);
        $this->db->where('month(tanggal)', $bulan);
        $result = $this->db->get('wp_debt_muat')->result();
        $total_krat = 0; $total_dus = 0;
        foreach ($result as $key) {
            if ($key->satuan_kembali == 'Krat') {
                $total_krat += $key->kembali;
            } else if ($key->satuan_kembali == 'Dus'){
                $total_dus += $key->kembali;
            }
        }
        $pesan = $total_krat.' Krat dan '.$total_dus.' Dus';
        return $pesan;
    }

    function get_total_return($tahun, $bulan, $id_karyawan)
    {
        $this->db->select('return, satuan_return');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('year(tanggal)', $tahun);
        $this->db->where('month(tanggal)', $bulan);
        $result = $this->db->get('wp_debt_muat')->result();
        $total_krat = 0; $total_dus = 0;
        foreach ($result as $key) {
            if ($key->satuan_return == 'Krat') {
                $total_krat += $key->return;
            } else if ($key->satuan_return == 'Dus'){
                $total_dus += $key->return;
            }
        }
        $pesan = $total_krat.' Krat dan '.$total_dus.' Dus';
        return $pesan;
    }

    function get_total_rusak($tahun, $bulan, $id_karyawan)
    {
        $this->db->select('rusak, satuan_rusak');
        if($id_karyawan != 'semua')
        {
            $this->db->where('username', $id_karyawan);
        }
        $this->db->where('year(tanggal)', $tahun);
        $this->db->where('month(tanggal)', $bulan);
        $result = $this->db->get('wp_debt_muat')->result();
        $total_krat = 0; $total_dus = 0;
        foreach ($result as $key) {
            if ($key->satuan_rusak == 'Krat') {
                $total_krat += $key->rusak;
            } else if ($key->satuan_rusak == 'Dus'){
                $total_dus += $key->rusak;
            }
        }
        $pesan = $total_krat.' Krat dan '.$total_dus.' Dus';
        return $pesan;
    }
}

/* End of file Debt_model.php */
