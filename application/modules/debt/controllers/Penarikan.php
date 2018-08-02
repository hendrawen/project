<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Aset_model');
        $this->load->model('dep/Dep_model', 'dep');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Debt')) {//cek admin ga?
							redirect('login','refresh');
					}
		}
        $this->load->library('form_validation');
    }


    public function index()
    {
        $aset = $this->Aset_model->get_all();
        $data = array(
            'aset_data' => $aset,
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Delivery',
            'content'		=>'penarikan/tarik_aset',
            'gudang'         => $this->Aset_model->get_gudang(),
        );
        $this->load->view('dashboard', $data);
    }


    function get_auto(){
		if (isset($_GET['term'])) {
		  	$result = $this->dep->cek_piutang($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
				);
		     	echo json_encode($arr_result);
		   	}
		}
    }
    

    public function track_aset(){
        $cari = $this->input->post('judul');
        $this->session->unset_userdata('id_transaksi');
        $total = 0;
        $i = 0;
           $query = $this->dep->get_track($cari);
           $sum = $this->dep->sum_get_track($cari);
           $query2 = $this->dep->get_min_track($cari);
              foreach ($query2 as $key) {
                $this->temb_bayar[$i]['id_transaksi']= $key->id_transaksi;
                $this->temb_bayar[$i]['sisa']= $key->sisa;
                $this->temb_bayar[$i]['id_pelanggan']= $key->id_pelanggan;
                $i++;
              ?>
             <?php }
             $data =  $this->session->set_userdata('id_transaksi', $this->temb_bayar);
             ;
            foreach ($query as $key) { ?>
               <tr>
                   <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                   <td><?php echo $key->id_pelanggan ?></td>
                   <td><?php echo $key->nama_pelanggan ?></td>
                   <td><a class="btn btn-success btn-xs" href="<?php echo base_url('track_pembayaran/')?><?php echo $key->id_transaksi ?>"><?php echo $key->id_transaksi ?></a></td>
                   <td>Rp. <?php echo number_format($key->utang,2,",",".") ?></td>
                   <td><?php echo tgl_indo($key->tgl_bayar) ?></td>
  
               <tr>;
                 <input type="hidden" id="id_track_aset" class="form-control" value="<?php echo $key->id_pelanggan ?>" name="id_track_aset" required="">
           <?php }
           ;
           foreach ($sum as $key) { ?>
              <tr>
               <th colspan="6">Total ASET</th>
                  <th colspan="1">Rp. <?php echo number_format($key->sisa,2,",",".") ?> </th>
  
              </tr>
              <?php }
    }

    function cek_data()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $record = $this->Aset_model->get_penarikan($id_pelanggan);
        $pesan = '';
        $status = 'T';

        $piutang = 0;
        $bayar = 0;
        $sisa = 0;
        $id = array();
        if ($record) {
            foreach ($record as $row) {
                $piutang += $row->turun_krat;
                $bayar += $row->piutang;
                $id[] = array(
                    'id_pelanggan' => $row->id_pelanggan,
                    'id' => $row->id,
                    'nama_pelanggan' => $row->nama_pelanggan,
                    'turun_krat' => $row->turun_krat,
                    'piutang' => $row->piutang,
                    'tgl_penarikan' => $row->tgl_penarikan,
                    'bayar' => $row->bayar_krat,
                    'bayar' => $row->bayar_uang,
                );
                $tgl = ($row->bayar_krat > 0 ) ? $row->tgl_penarikan: '';
                $pesan .= '
                    <tr>
                        <td>'.$row->id_pelanggan.'</td>
                        <td>'.$row->nama_pelanggan.'</td>
                        <td>'.$row->turun_krat.'</td>
                        <td>'.$tgl.'</td>
                        <td>'.$row->bayar_krat.'</td>
                        <td>'.number_format($row->bayar_uang).'</td>
                    </tr>';
            }
            $sisa = $piutang-$bayar;
            $pesan .= '
            <tr><td colspan="5" class="text-right">Total Piutang</td><td>'.$piutang.'</td></tr>
            <tr><td colspan="5" class="text-right">Total Bayar</td><td>'.$bayar.'</td></tr>
            <tr><td colspan="5" class="text-right">Sisa Piutang</td><td>'.$sisa.'</td></tr>
            ';
            ($sisa > 0)? $status = 'F' : $status = 'T';
        } else {
            $pesan = '<td colspan=5>No result found</td>';
            $status = 'T';
        }
        echo json_encode(array('status' => $status, 'pesan' => $pesan, 'id' => $id));
    }

    function get_idpelanggan($id_pelanggan)
    {
        $id = $this->Aset_model->get_id_pelanggan($id_pelanggan);
        echo json_encode($id->id);
    }

    function bayar_aset()
    {
        $id_pelanggan = $this->input->post('id');
        $record_debt = $this->input->post('record');
        $jenis = $this->input->post('jenis');
        $data = array(
            'wp_asis_debt_id ' => $this->input->post('id_debt'),
            'tgl_penarikan' => $this->input->post('tgl'),
            'jenis' => $jenis,
            'bayar_krat' => $this->input->post('bayar_krat'),
            'bayar_uang' => $this->input->post('bayar_uang'),
            'wp_pelanggan_id' => $id_pelanggan,
            'username' => $this->session->identity,
        );
        $harga_krat = $this->Aset_model->get_harga_krat();
        $jumlah_bayar = 0;
        if ($jenis == 'krat') {
            $jumlah_bayar = $data['bayar_krat'];
            unset($data['bayar_uang']);
        } else {
            $jumlah_bayar = $data['bayar_uang'] / $harga_krat;
            unset($data['bayar_krat']);
        }
        $penarikan = array();
        $asis_debt = array();

        for ($i=0; $i < sizeof($record_debt); $i++) {
            if ($jumlah_bayar >= $record_debt[$i]['turun_krat']) {
                $jumlah_bayar -= $record_debt[$i]['turun_krat'];
                
                $penarikan[$i] = array(
                    'tgl_penarikan' => $data['tgl_penarikan'],
                    'bayar_krat' => $record_debt[$i]['turun_krat'],
                    'bayar_uang' => $record_debt[$i]['turun_krat'] * $harga_krat,
                    'wp_asis_debt_id' => $record_debt[$i]['id'],
                    'wp_pelanggan_id' => $id_pelanggan,
                    'username' => $this->session->identity,
                    'gudang'    => $this->input->post('gud'),
                );
                $asis_debt[$i] = array (
                    'id' => $record_debt[$i]['id'],
                    // 'bayar_krat' => $record_debt[$i]['turun_krat'],
                    'piutang' => $record_debt[$i]['piutang'] + $record_debt[$i]['turun_krat'],
                    // 'bayar_uang' => $record_debt[$i]['turun_krat'] * $harga_krat,
                );
                if ($jenis == 'krat') {
                    unset($penarikan[$i]['bayar_uang']);
                    unset($asis_debt[$i]['bayar_uang']);
                } else {
                    unset($penarikan[$i]['bayar_krat']);
                    unset($asis_debt[$i]['bayar_krat']);
                }
                
            } else {
                $sisa = $record_debt[$i]['turun_krat'] - $jumlah_bayar;
                
                $penarikan[$i] = array(
                    'tgl_penarikan' => $data['tgl_penarikan'],
                    'bayar_krat' => $jumlah_bayar,
                    'bayar_uang' => $jumlah_bayar * $harga_krat,
                    'wp_asis_debt_id' => $record_debt[$i]['id'],
                    'wp_pelanggan_id' => $id_pelanggan,
                    'username' => $this->session->identity,
                    'gudang'    => $this->input->post('gud'),
                );
                $asis_debt[$i] = array (
                    'id' => $record_debt[$i]['id'],
                    // 'bayar_krat' => $jumlah_bayar,
                    'piutang' => $record_debt[$i]['piutang'] + $jumlah_bayar,
                );
                if ($jenis == 'krat') {
                    unset($penarikan[$i]['bayar_uang']);
                    unset($asis_debt[$i]['bayar_uang']);
                } else {
                    unset($penarikan[$i]['bayar_krat']);
                    unset($asis_debt[$i]['bayar_krat']);
                }
                $jumlah_bayar = 0;
            }
        }
        // exit();
        $insert = $this->Aset_model->insert_penarikan($penarikan, $asis_debt);
        if ($insert == 'T') {
            echo json_encode(array('status' => (bool)TRUE, 'message' => 'Data berhasil diproses'));
        } else {
            echo json_encode(array('status' => (bool)FALSE, 'message' => 'Data gagal diproses'));
        }
        
    }

}
