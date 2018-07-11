<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    
    private $permit;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('Models_laporan', 'laporan');
        $this->load->library('table');
    }
    

    function pembayaran_harian()
    {
        # code...
        $cek = get_permission('Pembayaran Harian', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_harian',
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_pembayaran_harian()
    {
        $day = $this->input->post('tgl');
        $data = $this->laporan->laporan_pembayaran_harian($day);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function load_pembayaran_all()
    {
        $data = $this->laporan->laporan_pembayaran_all();
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function pembayaran_bulanan()
    {
        # code...
        $cek = get_permission('Pembayaran Bulanan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_bulanan',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_pembayaran_bulanan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->laporan_bulanan($from, $to, $tahun);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function pembayaran_tahunan()
    {
        # code...
        $cek = get_permission('Pembayaran Tahunan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_tahunan',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_pembayaran_tahunan()
    {
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->laporan_tahunan($tahun);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }


    function template_table()
    {
        $template = array(
            'table_open'            => ' <table id="datatable" class="table table-striped table-bordered">',
            // 'table_open'            => '<table id="example" class="table table-striped jambo_table table-bordered dt-responsive nowrap">',
            'thead_open'            => '<thead>',
            'thead_close'           => '</thead>',
            'heading_row_start'     => '<tr>',
            'heading_row_end'       => '</tr>',
            'heading_cell_start'    => '<th>',
            'heading_cell_end'      => '</th>',
            'tbody_open'            => '<tbody>',
            'tbody_close'           => '</tbody>',
            'row_start'             => '<tr>',
            'row_end'               => '</tr>',
            'cell_start'            => '<td>',
            'cell_end'              => '</td>',
            'row_alt_start'         => '<tr>',
            'row_alt_end'           => '</tr>',
            'cell_alt_start'        => '<td>',
            'cell_alt_end'          => '</td>',
            'table_close'           => '</table>'
        );
        $this->table->set_template($template);
    }

    function debt_harian()
    {
        # code...
        $cek = get_permission('Pembayaran Harian', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_debtharian',
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_debt_harian()
    {
        $day = $this->input->post('tgl');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $data = $this->laporan->laporan_debtharian($day, $nama);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }


    function debt_bulanan()
    {
        # code...
        $cek = get_permission('Pembayaran Bulanan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_debtbulanan',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_debt_bulanan()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $nama = $this->input->post('nama');
        $berdasarkan = $this->input->post('berdasarkan');
        $data = $this->laporan->laporan_debtbulanan($from, $to, $tahun, $nama);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function debt_tahunan()
    {
        # code...
        $cek = get_permission('Pembayaran Tahunan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran',
            'content'		=>'pembayaran_debtahunan',
            'month'         => $this->month,
        );
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function load_debt_tahunan()
    {   
        $nama = $this->input->post('nama');
        $berdasarkan = $this->input->post('berdasarkan');
        $tahun = $this->input->post('tahun');
        $data = $this->laporan->laporan_debtahunan($tahun, $nama);
        $pesan = "";
        $total = 0;
        $total_bayar = 0;
        $total_sisa= 0;
        if ($data) {
        foreach ($data as $row) {
            $pesan .= '<tr>
            <td>'.$row->id_transaksi.'</td>
            <td>'.tgl_indo($row->tgl_transaksi).'</td>
            <td>'.tgl_indo($row->jatuh_tempo).'</td>
            <td>'.$row->id_pelanggan.'</td>
            <td>'.$row->nama_pelanggan.'</td>
            <td>'.$row->nama_barang.'</td>
            <td>'.$row->qty.'</td>
            <td>'.$row->satuan.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->username.'</td>
            <td>'.number_format($row->subtotal,2,',','.').'</td>
            <td>'.tgl_indo($row->tgl_bayar).'</td></td>
            <td>'.number_format($row->bayar,2,',','.').'</td></td>
            <td>'.number_format($row->jumlah_bayar,2,',','.').'</td></td>
            <td>'.number_format($row->sisa_hutang,2,',','.').'</td></td>
            <td>'.$row->nama_status.'</td></td>
            </tr>';
            $total += $row->subtotal;
            $total_bayar += $row->jumlah_bayar;
            $total_sisa += $row->sisa_hutang;
        }
        $pesan .= 
        '
        <tr>
        <td colspan=17 class=text-left><b>Total Transaksi</b></td>
        <td colspan=2><b>'.number_format($total,2,',','.').'</b></td>
        </tr>
        
        <tr>
        <td colspan=17 class=text-left><b>Total Bayar</b></td>
        <td colspan=2><b>'.number_format($total_bayar,2,',','.').'</b></td>
        </tr>

        <tr>
        <td colspan=17 class=text-left><b>Total Sisa Hutang</b></td>
        <td colspan=2><b>'.number_format($total_sisa,2,',','.').'</b></td>
        </tr>
        ';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function isi_dept($pilih)
        {
            $this->load->database();
            $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
            $this->db->from('wp_karyawan');
            $this->db->join('wp_jabatan','wp_jabatan.id=wp_karyawan.wp_jabatan_id');
            $this->db->where('wp_jabatan.nama_jabatan','Debt');
            $karyawan = $this->db->get()->result();
            $opt = "";
            if ($pilih == "dept") {
            foreach ($karyawan as $row) {
                $opt .= '
                <option value="'.$row->id_karyawan.'">'.$row->nama.'</option>
                ';
            }
            } else {
                $opt = '
                <option value="semua">Semua</option>
                ';
            }
            echo $opt;
        }

}

/* End of file Pembayaran.php */
