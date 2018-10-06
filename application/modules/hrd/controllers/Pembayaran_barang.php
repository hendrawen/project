<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_barang extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Ion_auth_model');
    if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
			}else{
                if (!$this->ion_auth->in_group('HRD')) {//cek admin ga?
                        redirect('login','refresh');
                }
		}
    $this->load->model('Pembayaranbarang_model', 'pembayaran');
  }

  function index()
  { 
    $data['aktif']			='pembayaran_barang';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembayaran';
    $data['content']		='pembayaran_barang/main';
    $data['pembayaran'] =$this->pembayaran->get_data();
    $this->load->view('dashboard', $data);
  }

  function barang()
  { 
    $data['aktif']			='pembayaran_barang';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembayaran';
    $data['content']		='pembayaran_barang/piutang';
    $this->load->view('dashboard',$data);
  }

  public function ajax_list()
    {
        $list = $this->pembayaran->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pembayarans) {
            $row = array();
            $row[] = $pembayarans->id_transaksi;
            $row[] = tgl_indo($pembayarans->tgl_transaksi);
            $row[] = tgl_indo($pembayarans->jatuh_tempo);
            $row[] = $pembayarans->id_pelanggan;
            $row[] = $pembayarans->nama_pelanggan;
            $row[] = $pembayarans->nama_barang;
            $row[] = $pembayarans->qty;
            $row[] = $pembayarans->satuan;
            $row[] = $pembayarans->kelurahan;
            $row[] = $pembayarans->kecamatan;
            $row[] = $pembayarans->no_telp;
            $row[] = $pembayarans->nama;
            $row[] = $pembayarans->username;
            $row[] = number_format($pembayarans->subtotal,2,",",".");
            $row[] = tgl_indo($pembayarans->tgl_bayar);
            $row[] = number_format($pembayarans->bayar,2,",",".");
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pembayaran->count_all(),
                        "recordsFiltered" => $this->pembayaran->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
  }

  function transaksi()
  { 
    $data['aktif']			='pembayaran_barang';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pembayaran';
    $data['sub_judul']	='Form';
    $data['content']		='pembayaran_barang/form';
    $this->load->view('dashboard', $data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->pembayaran->cari_pelanggan($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_pelanggan,
					'utang'	=> $row->sisa,
          'transaksi' => $row->id_transaksi,
          'id' => $row->id,
          'sudah' => $row->bayar,
          'jumlah' => $row->utang,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  public function update_action()
  { 
    $test = str_replace(".","", $this->input->post('bayar'));
    $test2 = $this->input->post('sudah');
    $hasil = $test+$test2;
    $data = array(
        // 'id_suplier' => $this->input->post('id_suplier',TRUE),
        'bayar' => $hasil,
        'created_at' => date('Y-m-d'),
        );
    $this->pembayaran->update($this->input->post('id', TRUE), $data);
    $this->session->set_flashdata('message', 'Pembayaran berhasil !!!');
    redirect(site_url('bendahara/pembayaran_barang'));
  }

  function get_auto(){
		if (isset($_GET['term'])) {
		  	$result = $this->pembayaran->cek_bayar($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->id_suplier,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

  public function track_pembayaran(){
      $cari = $this->input->post('judul');
      $this->session->unset_userdata('id_transaksi');
      $total = 0;
      $i = 0;
         $query = $this->pembayaran->get_track($cari);
         $sum = $this->pembayaran->sum_get_track($cari);
         $query2 = $this->pembayaran->get_min_track($cari);
            foreach ($query2 as $key) {
              $this->temb_bayar[$i]['id_transaksi']= $key->id_transaksi;
              $this->temb_bayar[$i]['sisa']= $key->sisa;
              $this->temb_bayar[$i]['id_suplier']= $key->id_suplier;
              $i++;
            ?>
           <?php }
           $data =  $this->session->set_userdata('id_transaksi', $this->temb_bayar);
           ;
          foreach ($query as $key) { ?>
             <tr>
             <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                 <td><?php echo $key->id_suplier ?></td>
                 <td><?php echo $key->nama_suplier ?></td>
                 <td><a class="btn btn-success btn-xs" href="<?php echo base_url('track_pembayaran/')?><?php echo $key->id_transaksi ?>"><?php echo $key->id_transaksi ?></a></td>
                 <td>Rp. <?php echo number_format($key->utang,2,",",".") ?></td>
                 <td><?php echo ($key->bayar > 0)? tgl_indo($key->tgl_bayar):'' ?></td>
                 <td>Rp. <?php echo number_format($key->bayar,2,",",".") ?></td>
                 <td>Rp. <?php echo number_format($key->sisa,2,",",".") ?></td>
             <tr>;
               <input type="hidden" id="id_track_suplier" class="form-control" value="<?php echo $key->wp_suplier_id?>" name="id_track_suplier" required="">
         <?php }
         ;
         foreach ($sum as $key) { ?>
            <tr>
             <th colspan="7">Total</th>
                <th colspan="1">Rp. <?php echo number_format($key->sisa,2,",",".") ?> </th>
            </tr>
            <?php }
  }

  public function cek()
  {
    print_r ($this->session->userdata('id_transaksi'));

  }

  public function track_pembayaran2()
  { 
    $status = 'lunas';
    $status2 = 'belum lunas';
    $list = $this->session->userdata('id_transaksi');
    $id = $this->session->userdata('id');
    print_r($list);
    echo '<br />';
    $jumlah_bayar = str_replace(".","", $this->input->post('bayar'));
    $sisa = '';
    for ($i=0; $i < sizeof($list); $i++) {
      if ($jumlah_bayar > $list[$i]['sisa']) {
          $kembali = $jumlah_bayar-$list[$i]['sisa'];
          $data = array(
            'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
            'bayar' => $jumlah_bayar,
            'kembali' => $kembali,
            'id_transaksi' => $list[$i]['id_transaksi'],
            'status'  => $status,
            'id_suplier' => $list[$i]['id_suplier'],
            'username' => $this->session->identity,
          );
          $this->pembayaran->insert_pembayaran($data);
          $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
      } else if($jumlah_bayar < $list[$i]['sisa']) {
        $sisa = $jumlah_bayar-$list[$i]['sisa'];
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'sisa'  => $sisa,
          'id_transaksi' => $list[$i]['id_transaksi'],
          'status'  => $status2,
          'id_suplier' => $list[$i]['id_suplier'],
          'username' => $this->session->identity,
        );
        $this->pembayaran->insert_pembayaran($data);
        $jumlah_bayar ='';
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
      } else if($jumlah_bayar = $list[$i]['sisa']) {
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'status' => $status,
          'id_suplier' => $list[$i]['id_suplier'],
          'username' => $this->session->identity,
        );
        $this->pembayaran->insert_pembayaran($data);
        $jumlah_bayar ='';
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
      }
    }
    $this->session->unset_userdata('id_transaksi');
    redirect(site_url('bendahara/pembayaran_barang/barang'));
  }

}
