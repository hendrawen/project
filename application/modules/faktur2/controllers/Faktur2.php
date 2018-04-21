<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur2 extends CI_Controller{

  function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('Faktur2_model','faktur2');
  }

  public function index()
  {
      $data['aktif']			='Faktur';
      $data['title']			='Brajamarketindo';
      $data['judul']			='Cetak Faktur';
      $data['sub_judul']		='';
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

  public function cari_faktur(){
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
                 <td><?php echo number_format($key->subtotal,2,",",".") ?></td>
                 <td><?php echo $key->satuan ?></td>

             <tr>;
         <?php }
         echo '<tr>
         <td colspan="3" style="text-align:center; font-weight:bold;">Total</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($query[0]->subtotal+$query[1]->subtotal,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:center; font-weight:bold;">Bayar</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($query[0]->bayar,2,",",".").'</td>
         </tr>
         <tr>
         <td colspan="3" style="text-align:center; font-weight:bold;">Hutang</td>
         <td colspan="2" style="font-weight:bold;">'.number_format($query[0]->sisa,2,",",".").'</td>
         </tr>'
         ;
  }
}

?>
