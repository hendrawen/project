<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaranaset extends CI_Controller
{
    private $permit;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Aset_model');
        $this->load->model('dep/Dep_model', 'dep');
        if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
					if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
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
            'sub_judul' 	=>'Delivery',
            'content'		=>'list',
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    public function penarikan()
    {
        $aset = $this->Aset_model->get_all();
        $data = array(
            'aset_data' => $aset,
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	    =>'Pembayaran Aset',
            'content'		=>'tarik_aset',
            'gudang'    => $this->Aset_model->get_gudang()
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
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
                   <td><?php echo ($key->bayar > 0)? tgl_indo($key->tgl_bayar):'' ?></td>
                   <td>Rp. <?php echo number_format($key->bayar,2,",",".") ?></td>
                   <td>Rp. <?php echo number_format($key->sisa,2,",",".") ?></td>

               <tr>;
                 <input type="hidden" id="id_track_admin" class="form-control" value="<?php echo $key->id_pelanggan ?>" name="id_track_admin" required="">
           <?php }
           ;
           foreach ($sum as $key) { ?>
              <tr>
               <th colspan="7">Total Hutang</th>
                  <th colspan="1">Rp. <?php echo number_format($key->sisa,2,",",".") ?> </th>

              </tr>
              <?php }
    }

    public function cek()
    {
      # code...
    //   print_r ($this->session->userdata('id_transaksi'));

    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('delivery/create_action'),
      	    'id' => set_value('id'),
      	    'tanggal' => set_value('tanggal'),
      	    'jam' => set_value('jam'),
      	    'turun_krat' => set_value('turun_krat'),
      	    'turun_btl' => set_value('turun_btl'),
      	    'naik_krat' => set_value('naik_krat'),
      	    'naik_btl' => set_value('naik_btl'),
      	    'aset_krat' => set_value('aset_krat'),
      	    'aset_btl' => set_value('aset_btl'),
      	    'bayar' => set_value('bayar'),
      	    'keterangan' => set_value('keterangan'),
      	    'username' => set_value('username'),
      	    'wp_pelanggan_id' => set_value('wp_pelanggan_id'),
            'aktif'			=>'aset',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Aset',
            'content'		=>'form',
            'pelanggan_list' => $this->Aset_model->get_pelanggan(),
        );
        $data['menu']			= $this->permit[0];
		$data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
          		'tanggal' => date('y-m-d'),
          		'jam' => date('h:i:s'),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'turun_btl' => $this->input->post('turun_btl',TRUE),
          		'naik_krat' => $this->input->post('naik_krat',TRUE),
          		'naik_btl' => $this->input->post('naik_btl',TRUE),
          		'aset_krat' => $this->input->post('aset_krat',TRUE),
          		'aset_btl' => $this->input->post('aset_btl',TRUE),
          		'bayar' => $this->input->post('bayar',TRUE),
          		'keterangan' => $this->input->post('keterangan',TRUE),
          		'username' => $this->session->identity,
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('delivery'));
        }
    }

    public function update($id)
    {
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('delivery/update_action'),
            		'id' => set_value('id', $row->id),
                'tanggal' => set_value('id', 'tanggal'),
            		'jam' => set_value('id', 'jam'),
            		'turun_krat' => set_value('turun_krat', $row->turun_krat),
            		'turun_btl' => set_value('turun_btl', $row->turun_btl),
            		'naik_krat' => set_value('naik_krat', $row->naik_krat),
            		'naik_btl' => set_value('naik_btl', $row->naik_btl),
            		'aset_krat' => set_value('aset_krat', $row->aset_krat),
            		'aset_btl' => set_value('aset_btl', $row->aset_btl),
            		'bayar' => set_value('bayar', $row->bayar),
            		'keterangan' => set_value('keterangan', $row->keterangan),
            		'username' => set_value('username', $row->username),
            		'wp_pelanggan_id' => set_value('wp_pelanggan_id', $row->wp_pelanggan_id),
                'aktif'			=>'aset',
                'title'			=>'Brajamarketindo',
                'judul'			=>'Dashboard',
                'sub_judul'	=>'Aset',
                'content'		=>'form',
                'pelanggan_list' => $this->Aset_model->get_pelanggan(),
                );
            $data['menu']			= $this->permit[0];
		    $data['submenu']		= $this->permit[1];
            $this->load->view('panel/dashboard', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
              'tanggal' => date('y-m-d'),
              'jam' => date('h:i:s'),
          		'turun_krat' => $this->input->post('turun_krat',TRUE),
          		'turun_btl' => $this->input->post('turun_btl',TRUE),
          		'naik_krat' => $this->input->post('naik_krat',TRUE),
          		'naik_btl' => $this->input->post('naik_btl',TRUE),
          		'aset_krat' => $this->input->post('aset_krat',TRUE),
          		'aset_btl' => $this->input->post('aset_btl',TRUE),
          		'bayar' => $this->input->post('bayar',TRUE),
          		'keterangan' => $this->input->post('keterangan',TRUE),
          		'username' => $this->input->post('username',TRUE),
          		'wp_pelanggan_id' => $this->input->post('wp_pelanggan_id',TRUE),
      	    );

            $this->Aset_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('delivery'));
        }
    }

    public function delete($id)
    {
        $row = $this->Aset_model->get_by_id($id);

        if ($row) {
            $this->Aset_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('delivery'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('delivery'));
        }
    }

    public function _rules()
    {
    	$this->form_validation->set_rules('turun_krat', 'turun krat', 'trim|required');
    	$this->form_validation->set_rules('turun_btl', 'turun btl', 'trim|required');
    	$this->form_validation->set_rules('naik_krat', 'naik krat', 'trim|required');
    	$this->form_validation->set_rules('naik_btl', 'naik btl', 'trim|required');
    	$this->form_validation->set_rules('aset_krat', 'aset krat', 'trim|required');
    	$this->form_validation->set_rules('aset_btl', 'aset btl', 'trim|required');
    	$this->form_validation->set_rules('bayar', 'bayar', 'trim|required');
    	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    	$this->form_validation->set_rules('wp_pelanggan_id', 'wp pelanggan id', 'trim|required');
    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "wp_asis_debt.xls";
        $judul = "wp_asis_debt";
        $tablehead = 0;
        $tablebody = 1;
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

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam");
	xlsWriteLabel($tablehead, $kolomhead++, "Turun Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Turun Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Naik Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Naik Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Aset Krat");
	xlsWriteLabel($tablehead, $kolomhead++, "Aset Btl");
	xlsWriteLabel($tablehead, $kolomhead++, "Bayar");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Wp Pelanggan Id");

	foreach ($this->Aset_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turun_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->turun_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->naik_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->naik_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->aset_krat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->aset_btl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bayar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteNumber($tablebody, $kolombody++, $data->wp_pelanggan_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function cek_data()
    {
        $id_supplier = $this->input->post('idSupplier');
        $record = $this->Aset_model->get_penarikan($id_supplier);
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

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-12 04:37:16 */
/* http://harviacode.com */
