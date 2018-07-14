<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur2 extends CI_Controller{

  private $permit;
  function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Ion_auth_model');
    $this->permit = $this->Ion_auth_model->permission($this->session->identity);
    $this->load->model('Faktur2_model','faktur2');
  }

  public function index()
  {   
    $cek = get_permission('Super User', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
      $data['aktif']			='Faktur';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Cetak Faktur';
      $data['sub_judul']		='';
      $data['menu']			= $this->permit[0];
      $data['submenu']		= $this->permit[1];
      $data['content']    = 'main';
      $data['profile']= $this->faktur2->get_profile();
      $data['query'] = $this->faktur2->get_data_faktur();
      $data['generate_faktur'] = $this->faktur2->generatekode_faktur();
      $this->load->view('panel/dashboard', $data);
  }

  public function get_detail_transaksi(){
		$kode=$this->input->post('id_transaksi');
		$data=$this->faktur2->get_data_bykode($kode);
		echo json_encode($data);
	}

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->faktur2->cari_pelanggan($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
          'label'			=> $row->id_pelanggan,
          'tgl_transaksi' => tgl_indo($row->tgl_transaksi),
          'id_pelanggan' => $row->id_pelanggan,
          'id_transaksi' => $row->id_transaksi,
					'nama_pelanggan'	=> $row->nama_pelanggan,
          'alamat' => $row->alamat,
          'nama_dagang' => $row->nama_dagang,
          'no_telp' => $row->no_telp,
          'nama'  => $row->nama,
          'kelurahan'  => $row->kelurahan,
          'kecamatan'  => $row->kecamatan,
          'lat'  => $row->lat,
          'long'  => $row->long,
          'jatuh_tempo' => tgl_indo($row->jatuh_tempo)
				);
		     	echo json_encode($arr_result);
		   	}
		}
  }

  public function cari_faktur(){
    $cek = get_permission('Super User', $this->permit[1]);
    if (!$cek) {//cek admin ga?
        redirect('panel','refresh');
    }
    $cari = $this->input->post('judul',TRUE);
     // if ($cari == '') {
     //     echo '<script>(‘#tabel_cari’).hide();</script>';
     // } else {
      $total = 0;
         $query = $this->faktur2->get_faktur($cari);
          foreach ($query as $key) { ?>
            $nama_pelanggan = <?php echo $key->nama_pelanggan ?>
             <tr>
                 <td><?php echo $key->nama_barang ?></td>
                 <td><?php echo number_format($key->harga,2,",",".") ?></td>
                 <td><?php echo $key->qty ?></td>
                      <?php
                          $subtotal = $key->harga*$key->qty;
                          $total += $subtotal;
                      ?>
                 <td><?php echo number_format($subtotal,2,",",".") ?></td>
                 <td><?php echo $key->satuan ?></td>
             <tr>;
         <?php }
         echo '<tr>
         <td colspan="3" style="text-align:right; font-weight:bold;">Total</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($total,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:right; font-weight:bold;">Diskon</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($query[0]->diskon,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:right; font-weight:bold;">Total Akhir</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($total-$query[0]->diskon,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:right; font-weight:bold;">Bayar</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($query[0]->bayar,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:right; font-weight:bold;">Hutang</td>
         <td colspan="2" style="font-weight:bold;">'.number_format(($total-$query[0]->diskon)-$query[0]->bayar,2,",",".").'</td>
         </tr>'
         ;
  }
  
}

?>
