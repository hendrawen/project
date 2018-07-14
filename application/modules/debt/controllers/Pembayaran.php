<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller{

  public function __construct()
  { 
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Ion_auth_model');
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
    $this->load->model('Pembayaran_model', 'pembayaran');
    $this->load->model('dep/Dep_model', 'dep');
    
  }

  function index()
  { 
      $data['aktif']			='Dashboard';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Dashboard';
      $data['sub_judul'] = 'Pembayaran';
      $data['content']		='pembayaran/piutang';
      $this->load->view('dashboard',$data);
}

  function transaksi()
  { 
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pembayaran';
    $data['sub_judul'] = 'Pembayaran';
    $data['content']		='pembayaran/form';
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
    redirect(site_url('debt'));
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

  public function track_transaksi(){
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
                 <td><a class="btn btn-success btn-xs" href="<?php echo base_url('debt/track_pembayaran/')?><?php echo $key->id_transaksi ?>"><?php echo $key->id_transaksi ?></a></td>
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
    print_r ($this->session->userdata('id_transaksi'));
    
  }

  public function track_pembayaran()
  { 
    $list = $this->session->userdata('id_transaksi');
    print_r($list);
    echo '<br />';
    $jumlah_bayar = str_replace(".","", $this->input->post('bayar'));
    $sisa = '';
    for ($i=0; $i < sizeof($list); $i++) {
      if ($jumlah_bayar > $list[$i]['sisa']) {
          $jumlah_bayar -= $list[$i]['sisa'];
          $data = array(
            'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
            'bayar' => $list[$i]['sisa'],
            'id_transaksi' => $list[$i]['id_transaksi'],
            'id_pelanggan' => $list[$i]['id_pelanggan'],
            'username' => $this->session->identity,
          );
          $this->dep->insert_pembayaran($data);
          $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
          // echo 'utang lunas, sisa : '.$jumlah_bayar;
          //update transaksi $list[$i]['id_transaksi'];
      } else if($jumlah_bayar <= $list[$i]['sisa']) {
        
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'id_pelanggan' => $list[$i]['id_pelanggan'],
          'username' => $this->session->identity,
        );
        $this->dep->insert_pembayaran($data);
        $jumlah_bayar ='';
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
        //
      }
    }
    $this->session->unset_userdata('id_transaksi');
    redirect(site_url('debt/pembayaran'));
  }

}
