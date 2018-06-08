<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaranbarang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }else{
            if (!$this->ion_auth->in_group('admin') AND !$this->ion_auth->in_group('members')) {//cek admin ga?
                redirect('login','refresh');
            }
        }
    $this->load->model('Pembayaranbarang_model', 'pembayaran');
    $this->load->model('dep/Dep_model', 'dep');

  }

  function index()
  {
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembayaran';
    $data['content']		='main';
    $data['pembayaran'] =$this->pembayaran->get_data();
    $this->load->view('panel/dashboard', $data);
  }

  function barang()
  {
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Pembayaran';
    $data['content']		='piutang';
    $this->load->view('panel/dashboard',$data);
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
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pembayaran';
    $data['sub_judul']	='Form';
    $data['content']		='form';
    $this->load->view('panel/dashboard', $data);
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
    redirect(site_url('dep'));
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
              $this->temb_bayar[$i]['total']= $key->total;
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
                 <td><?php echo $key->id_transaksi ?></td>
                 <td><?php echo $key->nama_barang ?></td>
                 <td><?php echo $key->satuan ?></td>
                 <td>Rp. <?php echo number_format($key->harga,2,",",".") ?></td>
                 <td><?php echo $key->qty ?></td>
                  <td>Rp. <?php echo number_format($key->subtotal,2,",",".") ?></td>
                 <!-- <td>Rp. <?php echo number_format($key->bayar,2,",",".") ?></td> -->
             <tr>;
               <input type="hidden" id="id_track_suplier" class="form-control" value="<?php echo $key->wp_suplier_id?>" name="id_track_suplier" required="">
         <?php }
         ;
         foreach ($sum as $key) { ?>
            <tr>
             <th colspan="8">Total</th>
                <th colspan="1">Rp. <?php echo number_format($key->total,2,",",".") ?> </th>
            </tr>
            <?php }
  }

  public function cek()
  {
    print_r ($this->session->userdata('id_transaksi'));

  }

  public function track_pembayaran2()
  {
    $list = $this->session->userdata('id_transaksi');
    $id = $this->session->userdata('id');
    print_r($list);
    echo '<br />';
    $jumlah_bayar = str_replace(".","", $this->input->post('bayar'));
    $sisa = '';
    for ($i=0; $i < sizeof($list); $i++) {
      if ($jumlah_bayar > $list[$i]['total']) {
          $kembali = $jumlah_bayar-$list[$i]['total'];
          $data = array(
            'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
            'bayar' => $jumlah_bayar,
            'kembali' => $kembali,
            'id_transaksi' => $list[$i]['id_transaksi'],
            'id_suplier' => $list[$i]['id_suplier'],
            'username' => $this->session->identity,
          );
          $this->pembayaran->insert_pembayaran($data);
          $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
          //echo 'utang lunas, sisa : '.$jumlah_bayar;
          //update transaksi $list[$i]['id_transaksi'];
      } else if($jumlah_bayar < $list[$i]['total']) {
        $sisa = $jumlah_bayar-$list[$i]['total'];
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'sisa'  => $sisa,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'id_suplier' => $list[$i]['id_suplier'],
          'username' => $this->session->identity,
        );
        $this->pembayaran->insert_pembayaran($data);
        $jumlah_bayar ='';
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
      } else if($jumlah_bayar = $list[$i]['total']) {
        //$status = $this->pembayaran->status($list);
        //$this->db->query("UPDATE wp_transaksistok set status='' WHERE id_transaksi='$list'");
        $data = array(
          'tgl_bayar' => date('Y-m-d', strtotime($this->input->post('tgl_bayar'))),
          'bayar' => $jumlah_bayar,
          'id_transaksi' => $list[$i]['id_transaksi'] ,
          'id_suplier' => $list[$i]['id_suplier'],
          'username' => $this->session->identity,
        );
        $this->pembayaran->insert_pembayaran($data);
        $jumlah_bayar ='';
        $this->session->set_flashdata('message', 'Pembayaran Berhasil !!!');
      }
    }
    $this->session->unset_userdata('id_transaksi');
    redirect(site_url('pembayaranbarang/barang'));
  }

}