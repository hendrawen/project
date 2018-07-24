<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_dep extends CI_Controller{
  private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

  private $permit;
  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
    $this->load->model('Model_dep', 'dep');
    $this->load->library('table');
  }

  function index()
  {

  }

  function harian()
  {   
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_harian',
          'harian'    =>$this->dep->get_harian(),
      );
      $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_harian()
  {
    $day = $this->input->post('tgl');
    $berdasarkan = $this->input->post('berdasarkan');
    $nama = $this->input->post('nama');
    $data = $this->dep->laporan_harian($day, $nama);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_transaksi.'</td>
          <td>'.$row->tgl_transaksi.'</td>
          <td>'.$row->jatuh_tempo.'</td>
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
          <td>'.$row->username.'</td>
          <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function bulanan()
  {   
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_bulanan',
          'month'     => $this->month,
          'bulanan'    =>$this->dep->get_harian(),
      );
      $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_bulanan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $nama = $this->input->post('nama');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->dep->laporan_bulanan($from, $to, $tahun, $nama);
    $pesan = "";
    $no = 1;
    $total = 0;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
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
        <td>'.$row->username.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function tahunan()
  {   
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_tahunan',
          'tahunan'    =>$this->dep->get_harian(),
      );
      $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_tahunan()
  {
    $tahun = $this->input->post('tahun');
    $nama = $this->input->post('nama');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->dep->laporan_tahunan($tahun, $nama);
    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
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
        <td>'.$row->username.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=15 class=text-right>Total</td>
      <td>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function produk()
  { 
    $this->load->model('barang/Barang_model');
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_per_produk',
          'list_barang' => $this->Barang_model->get_all(),
      );
      $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_produk()
  {
    $tahun = $this->input->post('tahun');
    $id_barang = $this->input->post('id_barang');
    $data = $this->dep->laporan_produk($tahun, $id_barang);

    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
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
        <td>'.$row->username.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=14 class=text-right>Total</td>
      <td colspan=2>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;
  }

  function area()
  {   
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_area',
      );
      $data['menu']			= $this->permit[0];
		  $data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_area()
  {
    $tahun = $this->input->post('tahun');
    $area = $this->input->post('area');
    $berdasarkan = $this->input->post('berdasarkan');
    $data = $this->dep->laporan_area($tahun, $area, $berdasarkan);
    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
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
        <td>'.$row->username.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=14 class=text-right>Total</td>
      <td colspan=2>'.number_format($total).'</td>
      </tr>';
    } else {
      $pesan .= '<tr>
        <td colspan=16>Record not found</td>
      </tr>';
    }
    echo $pesan;

  }

  function isi_area($pilih)
  {
    $this->load->database();
    $this->db->select("DISTINCT($pilih)");
    $pelanggan = $this->db->get('wp_pelanggan')->result();
    $opt = "";
    foreach ($pelanggan as $row) {
      $opt .= '
      <option value="'.$row->$pilih.'">'.$row->$pilih.'</option>
      ';
    }
    echo $opt;
  }

  function marketing()
  {   
      
      $data = array(
          'aktif'			=>'som',
          'title'			=>'Brajamarketindo',
          'judul'			=>'Dashboard',
          'sub_judul'	=>'Debt & Delivery',
          'content'		=>'dep/laporan_marketing',
      );
      $data['menu']			= $this->permit[0];
  		$data['submenu']		= $this->permit[1];
      $this->load->view('panel/dashboard', $data);
  }

  function load_marketing()
  {
    $tahun = $this->input->post('tahun');
    $berdasarkan = $this->input->post('berdasarkan');
    $nama = $this->input->post('nama');
    $data = $this->dep->laporan_marketing($tahun, $nama);
    $pesan = "";
    $total = 0;
    $no = 1;
    if ($data) {
      foreach ($data as $row) {
        $pesan .= '<tr>
        <td>'.$no++.'</td>
        <td>'.$row->id_transaksi.'</td>
        <td>'.$row->tgl_transaksi.'</td>
        <td>'.$row->jatuh_tempo.'</td>
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
        <td>'.$row->username.'</td>
        <td>'.number_format($row->subtotal).'</td>
        </tr>';
        $total += $row->subtotal;
      }
      $pesan .= '<tr>
      <td colspan=14 class=text-right>Total</td>
      <td colspan=2>'.number_format($total).'</td>
      </tr>';
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
    $this->db->where('wp_jabatan.nama_jabatan','Debt & Delivery');
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

  /*
    pelanggan
  */

  function pelanggan()
  {   
    $to = date('n');
    $from = $to - 1 ;
    $year = date('Y');

    // $record = $this->dep->laporan_pelanggan($from, $to, $year);
    $data = array(
        'aktif'			=>'som',
        'title'			=>'Brajamarketindo',
        'judul'			=>'Dashboard',
        'sub_judul'	=>'Debt & Delivery',
        'content'		=>'dep/laporan_pelanggan',
        'month'     => $this->month,
        // 'record'    => $record,
        'from'  => set_value('from', $from),
        'to'  => set_value('to', $to),
        'year'  => set_value('year', $year)
    );
    $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
    $this->load->view('panel/dashboard', $data);
  }

  function load_pelanggan()
  {
    $from = $this->input->post('from');
    $to = $this->input->post('to');
    $tahun = $this->input->post('tahun');
    $data = $this->dep->laporan_pelanggan($from, $to, $tahun);
    $no = 1;
    $total = 0;
    $pesan = "";
    if ($data) {
      foreach ($data as $row) {
        $utang = $this->dep->laporan_pelanggan_utang($row->id_pelanggan, $from, $to, $tahun);

        $pesan .= '
        <tr>
          <td>'.$no++.'</td>
          <td>'.$row->id_pelanggan.'</td>
          <td>'.$row->nama_pelanggan.'</td>
          <td>'.$row->no_telp.'</td>
          <td>'.$row->kelurahan.'</td>
          <td>'.$row->kecamatan.'</td>
          <td>'.$row->nama.'</td>
          <td>'.number_format($utang).'</td>';
          for ($month=1; $month <=12 ; $month++) {
            $jumlah_trx = $this->dep->laporan_pelanggan_trx($row->id_pelanggan, $month, $tahun);
            $jumlah_qty = $this->dep->laporan_pelanggan_qty($row->id_pelanggan, $month, $tahun);
            $pesan  .= '<td>'.$jumlah_trx.'</td>
            <td>'.$jumlah_qty.'</td>';
          }
        '</tr>';
      }

    } else {
      $pesan = '
      <td colspan=16>Record not found</td>
      ';

    }
    echo $pesan;
  }

  function template_table()
  {
    $template = array(
        'table_open'            => '<table border=1px id="datatable-buttons_wrapper" class="table table-striped jambo_table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" role="grid" aria-describedby="datatable_info" >',
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

  function tes()
  {
    $tes = $this->dep->laporan_pelanggan_utang('CBM0001', 1, 4, 2018);

    print_r($tes);
  }

}
