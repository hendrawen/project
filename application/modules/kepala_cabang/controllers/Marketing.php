<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller {
    private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Kepala Cabang')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->model('Marketing_model', 'marketing');
        $this->load->library('table');
        //Do your magic here
    }

    function index()
    {
        $data = array(
            'aktif'			=>'laporan',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Aset',
            'content'		=>'marketing/index',
            'month'         => $this->month,
        );
        $this->load->view('dashboard', $data);
    }

    function ajax_list()
    {
        $list = $this->marketing->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lap) {
            $no++;
            $row = array();
            $row[] = $lap->id_transaksi;
            $row[] = tgl_indo($lap->tgl_transaksi);
            $row[] = tgl_indo($lap->jatuh_tempo);
            $row[] = $lap->id_pelanggan;
            $row[] = $lap->nama_pelanggan;
            $row[] = $lap->nama_barang;
            $row[] = $lap->qty;
            $row[] = $lap->satuan;
            $row[] = $lap->kota;
            $row[] = $lap->kecamatan;
            $row[] = $lap->kelurahan;
            $row[] = $lap->no_telp;
            $row[] = $lap->nama_karyawan;
            $row[] = $lap->nama_debt;
            $row[] = $lap->subtotal;
            $data[] = $row;
        }

        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->marketing->count_all(),
          "recordsFiltered" => $this->marketing->count_filtered(),
          "data" => $data,
          );
        //output to json format
        echo json_encode($output);
    }

    function harian_marketing()
    {
        $data = array(
            'aktif'			=>'Transaksi',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Report Harian Marketing',
            'content'		=>'laporan/marketing_harian',
        );
        $this->load->view('dashboard', $data);
    }

    function load_harian_marketing()
    {
        $day = $this->input->post('tgl');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $data = $this->laporan->laporan_harian_marketing($day, $nama);
        $pesan = "";
        $total = 0;
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
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama_karyawan.'</td>
            <td>'.$row->nama_debt.'</td>
            <td>'.number_format($row->subtotal).'</td>
            </tr>';
            $total += $row->subtotal;
        }
        $pesan .= '<tr>
        <td colspan=14 class=text-right>Total</td>
        <td colspan=1>'.number_format($total).'</td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function bulanan_marketing()
    {
        $data = array(
            'aktif'			=>'Transaksi',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Report Bulanan Marketing',
            'content'		=>'laporan/marketing_bulanan',
            'month'         => $this->month,
        );
        $this->load->view('dashboard', $data);
    }

    function load_bulanan_marketing()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $tahun = $this->input->post('tahun');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $data = $this->laporan->laporan_bulanan_marketing($from, $to, $tahun, $nama);
        $pesan = "";
        $total = 0;
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
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama_karyawan.'</td>
            <td>'.$row->nama_debt.'</td>
            <td>'.number_format($row->subtotal).'</td>
            </tr>';
            $total += $row->subtotal;
        }
        $pesan .= '<tr>
        <td colspan=14 class=text-right>Total</td>
        <td colspan=1>'.number_format($total).'</td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function tahunan_marketing()
    {
        $data = array(
            'aktif'			=>'Transaksi',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Report Tahunan Marketing',
            'content'		=>'laporan/marketing_tahunan',
        );
        $this->load->view('dashboard', $data);
    }

    function load_tahunan_marketing()
    {
        $tahun = $this->input->post('tahun');
        $berdasarkan = $this->input->post('berdasarkan');
        $nama = $this->input->post('nama');
        $data = $this->laporan->laporan_tahunan_marketing($tahun, $nama);
        $pesan = "";
        $total = 0;
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
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama_karyawan.'</td>
            <td>'.$row->nama_debt.'</td>
            <td>'.number_format($row->subtotal).'</td>
            </tr>';
            $total += $row->subtotal;
        }
        $pesan .= '<tr>
        <td colspan=14 class=text-right>Total</td>
        <td colspan=1>'.number_format($total).'</td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function load_marketing_all()
    {
        $data = $this->laporan->laporan_marketing_all();
        $pesan = "";
        $total = 0;
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
            <td>'.$row->kota.'</td>
            <td>'.$row->kecamatan.'</td>
            <td>'.$row->kelurahan.'</td>
            <td>'.$row->no_telp.'</td>
            <td>'.$row->nama_karyawan.'</td>
            <td>'.$row->nama_debt.'</td>
            <td>'.number_format($row->subtotal).'</td>
            </tr>';
            $total += $row->subtotal;
        }
        $pesan .= '<tr>
        <td colspan=14 class=text-right>Total</td>
        <td colspan=1>'.number_format($total).'</td>
        </tr>';
        } else {
        $pesan .= '<tr>
            <td colspan=16>Record not found</td>
        </tr>';
        }
        echo $pesan;
    }

    function isi_marketing($pilih)
    {
        $this->load->database();
        $this->db->select('wp_karyawan.id_karyawan, wp_karyawan.nama');
        $this->db->from('wp_karyawan');
        $this->db->join('wp_jabatan', 'wp_karyawan.wp_jabatan_id = wp_jabatan.id', 'inner');
        $this->db->where('wp_jabatan.nama_jabatan', 'Marketing');
        $karyawan = $this->db->get()->result();
        $opt = "";
        if ($pilih == "marketing") {
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



}

/* End of file Marketing.php */
