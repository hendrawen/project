<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {
	private $permit;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model','model');
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
		$data['aktif']			='Dashboard';
		$data['title']			='Brajamarketindo';
		$data['judul']			='Dashboard';
		$data['sub_judul']		='';
		$data['content']		='content';
		$data['pie_data']=$this->model->GetPie();
		$this->load->view('dashboard',$data);
	}

	public function chart_penjualan()
	{
		$month = get_list_month();
		$value = array();
		foreach ($month as $row) {
			$value[] = $this->model->get_chart_penjualan($this->input->post('tahun'), $row['key']);
			$bulan[] = $row['month'];
		}
		$hasil = array(
			'bulan' => $bulan,
			'value' => $value,
		);
		echo json_encode($hasil);
	}

	public function chart_produk()
	{
		$backColor = array("#BDC3C7","#9B59B6","#E74C3C","#26B99A","#3498DB");
		$hoverColor = array("#CFD4D8","#B370CF","#E95E4F","#36CAAB","#49A9EA");
		$fs = array("aero", "purple", "red", "green", "blue");
		$barang = $this->model->get_top_produk($this->input->post('tahun'));
		$result = array();
		$i = 0;
		$tabel = "";
		if ($barang) {
			foreach ($barang as $key) {
				$result['bc'][] = $backColor[$i];
				$result['hc'][] = $hoverColor[$i];
				$result['label'][] = $key->nama_barang;
				$result['value'][] = $key->qtys;

				$tabel .= '<tr>
				<td>
				<p>
				<i class="fa fa-square '.$fs[$i].'"></i>'.$key->nama_barang.'
				</p>
				</td>
				<td>'.$key->qtys.'</td>
				</tr>';
				$i++;
			}
			$result['tabel'] = $tabel;
		} else {
			$result['bc'][] = "#BDC3C7";
			$result['hc'][] = '#CFD4D8';
			$result['label'][] = 'null';
			$result['value'][] = 0;

			$tabel .= '<tr>
			<td>Tidak Ada Data</td>
			<td></td>
			</tr>';
			$result['tabel'] = $tabel;
		}
		echo json_encode($result);
	}
<<<<<<< HEAD
}
=======

	public function chart_pembayaran()
	{
		$month = get_list_month();
		$value = array();
		foreach ($month as $row) {
			$value[] = $this->model->get_chart_pembayaran($this->input->post('tahun'), $row['key']);
			$bulan[] = $row['month'];
		}
		$hasil = array(
			'bulan' => $bulan,
			'value' => $value,
		);
		echo json_encode($hasil);
	}

	public function chart_area()
	{
		$color = array("#455C73", "#9B59B6", "#BDC3C7", "#26B99A", "#3498DB");
		$area = $this->model->get_top_area($this->input->post('tahun'));
		$result = array();
		$i = 0;
		$tabel = "";
		if ($area) {
			foreach ($area as $key) {
				$result['color'][] = $color[$i];
				$result['label'][] = $key->kecamatan;
				$result['value'][] = $key->total;
				$i++;
			}
		} else {
			$result['color'][] = "#BDC3C7";
			$result['label'][] = 'null';
			$result['value'][] = 0;
		}
		echo json_encode($result);
		
		
		
	}
}
>>>>>>> a369fb0f8d7b9021bafb218bc3f73c4a766547b4
