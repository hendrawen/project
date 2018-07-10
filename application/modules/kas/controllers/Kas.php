<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {

  private $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);
        $this->load->model('Kas_model','model');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
		}

    }

    public function index()
    {
        $cek = get_permission('Keuangan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = array(
            'aktif'			=>'Kas',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pendapatan Pengeluaran',
            'content'		=>'main',
            'menu'			=> $this->permit[0],
            'submenu'		=> $this->permit[1],
            'list_kantor' => $this->model->get_kantor(),
            'month'     => $this->month,

        );
        $this->load->view('panel/dashboard', $data);
    }

    function load_kas_harian()
    {
      $day = $this->input->post('day');
      $kantor = $this->input->post('kantor');
      $data = $this->model->laporan_kas_harian($day, $kantor);
      $pesan = "";
      $total = 0;
      $no = 1;
      if ($data) {
        foreach ($data as $row) {
          $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->tanggal.'</td>
          <td>'.$row->nama_gudang.'</td>
          <td>'.$row->username.'</td>
          <td>'.$row->nama.'</td>
          <td>'.$row->nama_kategori.'</td>
          <td>'.$row->pendapatan.'</td>
          <td>'.$row->pengeluaran.'</td>
          <td><a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
          <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
          </td>
          </tr>';
        }
      } else {
        $pesan .= '<tr>
          <td colspan=16>Record not found</td>
        </tr>';
      }
      echo $pesan;
    }

    function load_kas_bulanan()
    {
      $from = $this->input->post('from');
      $to = $this->input->post('to');
      $year = $this->input->post('year');
      $id_barang = $this->input->post('kantor');
      $data = $this->model->laporan_kas_bulanan($from, $to, $year, $id_barang);
      $pesan = "";
      $total = 0;
      $no = 1;
      if ($data) {
        foreach ($data as $row) {
          $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->tanggal.'</td>
          <td>'.$row->nama_gudang.'</td>
          <td>'.$row->username.'</td>
          <td>'.$row->nama.'</td>
          <td>'.$row->nama_kategori.'</td>
          <td>'.$row->pendapatan.'</td>
          <td>'.$row->pengeluaran.'</td>
          <td><a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
          <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
          </td>
          </tr>';
        }
      } else {
        $pesan .= '<tr>
          <td colspan=16>Record not found</td>
        </tr>';
      }
      echo $pesan;
    }

    function load_kas_tahunan()
    {
      $tahun = $this->input->post('tahun');
      $kantor = $this->input->post('kantor');
      $data = $this->model->laporan_kas_tahunan($tahun, $kantor);
      $pesan = "";
      $total = 0;
      $no = 1;
      if ($data) {
        foreach ($data as $row) {
          $pesan .= '<tr>
          <td>'.$no++.'</td>
          <td>'.$row->tanggal.'</td>
          <td>'.$row->nama_gudang.'</td>
          <td>'.$row->username.'</td>
          <td>'.$row->nama.'</td>
          <td>'.$row->nama_kategori.'</td>
          <td>'.$row->pendapatan.'</td>
          <td>'.$row->pengeluaran.'</td>
          <td><a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
          <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->id_kas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
          </td>
          </tr>';
        }
      } else {
        $pesan .= '<tr>
          <td colspan=16>Record not found</td>
        </tr>';
      }
      echo $pesan;
    }

    function get_karyawan()
    {
        $list_karyawan = $this->model->get_karyawan();
        echo json_encode($list_karyawan);
    }

    function get_kantor()
    {
        $list_kantor = $this->model->get_kantor();
        echo json_encode($list_kantor);
    }

    function get_kategori()
    {
        $kategori = $this->model->get_kategori();
        echo json_encode($kategori);
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $bm) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = tgl_indo($bm->tanggal);
            $row[] = $bm->nama_gudang;
            $row[] = $bm->username;
            $row[] = $bm->nama;
            $row[] = $bm->nama_kategori;
            $row[] = angka($bm->pendapatan);
            $row[] = angka($bm->pengeluaran);
            $row[] = '
                <a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="ubah('."'".$bm->id_kas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$bm->id_kas."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model->count_all(),
            "recordsFiltered" => $this->model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $cek = get_permission('Keuangan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data = $this->model->get_by_id($id);
        $data->tanggal = ($data->tanggal == '0000-00-00') ? '' : $data->tanggal; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $cek = get_permission('Keuangan', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $this->_validate();
        $data = array(
            'tanggal' => $this->input->post('tanggal'),
            'id_kantor' => $this->input->post('id_kantor'),
            'id_karyawan' => $this->input->post('id_karyawan'),
            'id_kategori' => $this->input->post('id_kategori'),
            'pendapatan' => hapus_titik($this->input->post('pendapatan')),
            'pengeluaran' => hapus_titik($this->input->post('pengeluaran')),
            'username' => $this->session->identity,
        );
        $insert = $this->model->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'tanggal' => $this->input->post('tanggal'),
            'id_kantor' => $this->input->post('id_kantor'),
            'id_karyawan' => $this->input->post('id_karyawan'),
            'id_kategori' => $this->input->post('id_kategori'),
            'pendapatan' => hapus_titik($this->input->post('pendapatan')),
            'pengeluaran' => hapus_titik($this->input->post('pengeluaran')),
            'username' => $this->session->identity,
        );
        $this->model->update(array('id_kas' => $this->input->post('id_kas')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('tanggal') == '')
        {
            $data['inputerror'][] = 'tanggal';
            $data['error_string'][] = 'Tanggal harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_kantor') == '')
        {
            $data['inputerror'][] = 'id_kantor';
            $data['error_string'][] = 'Pilih Kantor';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_karyawan') == '')
        {
            $data['inputerror'][] = 'id_karyawan';
            $data['error_string'][] = 'Pilih Debt / Delivery';
            $data['status'] = FALSE;
        }

        if($this->input->post('id_kategori') == '')
        {
            $data['inputerror'][] = 'id_kategori';
            $data['error_string'][] = 'Pilih Kategori';
            $data['status'] = FALSE;
        }

        if($this->input->post('pendapatan') == '')
        {
            $data['inputerror'][] = 'pendapatan';
            $data['error_string'][] = 'Pendapatan harus diisi';
            $data['status'] = FALSE;
        }

        if($this->input->post('pengeluaran') == '')
        {
            $data['inputerror'][] = 'pengeluaran';
            $data['error_string'][] = 'Pengeluaran harus diisi';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function get_saldo()
    {
        echo json_encode("Saldo : ".number_format($this->model->get_saldo()));
    }

    function tes()
    {
        echo str_replace(".","","100.000");
    }

}

/* End of file Kas.php */
