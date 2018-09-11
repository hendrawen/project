<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller{

  private $permit = false;
  public function __construct()
  { 
    parent::__construct();
    //Codeigniter : Write Less Do More
    if (!$this->ion_auth->logged_in()) {//cek login ga?
        redirect('login','refresh');
        }else{
                if (!$this->ion_auth->in_group('Super User')) {//cek admin ga?
                        redirect('login','refresh');
                }
    }
    $this->load->model('Penarikan_model', 'model');
    $this->load->model('dep/Dep_model', 'dep');
    $this->load->model('delivery/Aset_model');
    $this->load->library('ion_auth');
  }

  function index()
  { 
    $data['aktif']			='Penarikan';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Penarikan';
    $data['content']		='main';
    $this->load->view('panel/dashboard', $data);
  }

  function piutang()
  { 
    $data['aktif']			='Dashboard';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Dashboard';
    $data['sub_judul']	='Penarikan';
    $data['content']		='piutang';
    $this->load->view('panel/dashboard',$data);
  }

  public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $key) {
            $row = array();
            $row[] = $key->id_transaksi;
            $row[] = tgl_indo($key->tgl_transaksi);
            $row[] = tgl_indo($key->jatuh_tempo);
            $row[] = $key->id_pelanggan;
            $row[] = $key->nama_pelanggan;
            $row[] = $key->nama_barang;
            $row[] = $key->qty;
            $row[] = $key->satuan;
            $row[] = $key->kelurahan;
            $row[] = $key->kecamatan;
            $row[] = $key->no_telp;
            $row[] = $key->nama;
            $row[] = $key->nama_debt;
            $row[] = number_format($key->total,2,",",".");
            $row[] = (($key->bayar_krat > 0 )? tgl_indo($key->tgl_penarikan):'');
            $row[] = number_format($key->bayar_krat,2,",",".");
            $row[] = (($key->bayar_uang > 0 )? tgl_indo($key->tgl_penarikan):'');
            $row[] = number_format($key->bayar_uang,2,",",".");
            $row[] = number_format($key->jumlah,2,",",".");
            $row[] = $key->sisa;
            $row[] = $key->status;
            $edit = '
            <button type="button" onClick=edit("'.$key->id.'") class="btn btn-primary btn-xs">Edit</button>
            <button type="button" onClick=hapus("'.$key->id.'") class="btn btn-danger btn-xs">Hapus</button>
            ';
            $hapus = '
            <button type="button" onClick=hapus("'.$key->id.'") class="btn btn-danger btn-xs">Hapus</button>
            ';
            if ($key->satuan == 'Krat' || $key->satuan == 'Botol') {
              $row[] = $edit;
            } else {
              $row[] = $hapus;
            }
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

  function transaksi()
  { 
    $data['aktif']			='aset';
    $data['title']			='Brajamarketindo';
    $data['judul']			='Pembayaran';
    $data['sub_judul']	='Form';
    $data['content']		='form';
    $data['menu']			= $this->permit[0];
    $data['submenu']		= $this->permit[1];
    $this->load->view('panel/dashboard', $data);
  }

  function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->model->cari_pelanggan($_GET['term']);
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
    $this->model->update($this->input->post('id', TRUE), $data);
    $this->session->set_flashdata('message', 'Pembayaran berhasil !!!');
    redirect(site_url('dep'));
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
          foreach ($query as $key) { ?> < tr > <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
<td><?php echo $key->id_pelanggan ?></td>
<td><?php echo $key->nama_pelanggan ?></td>
<td>
    <a
        class="btn btn-success btn-xs"
        href="<?php echo base_url('track_pembayaran/')?><?php echo $key->id_transaksi ?>"><?php echo $key->id_transaksi ?></a>
</td>
<td>Rp.
    <?php echo number_format($key->utang,2,",",".") ?></td>
<td><?php echo ($key->bayar > 0)? tgl_indo($key->tgl_bayar):'' ?></td>
<td>Rp.
    <?php echo number_format($key->bayar,2,",",".") ?></td>
<td>Rp.
    <?php echo number_format($key->sisa,2,",",".") ?></td>

<tr>;
    <input
        type="hidden"
        id="id_track_admin"
        class="form-control"
        value="<?php echo $key->id_pelanggan ?>"
        name="id_track_admin"
        required="">
        <?php }
         ;
         foreach ($sum as $key) { ?>
        <tr>
            <th colspan="7">Total Hutang</th>
            <th colspan="1">Rp.
                <?php echo number_format($key->sisa,2,",",".") ?>
            </th>

        </tr>
    <?php }
  }

  public function track_pembayaran()
  { 
    $list = $this->session->userdata('id_transaksi');
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
    redirect(site_url('pembayaran/piutang'));
  }

  function get_faktur()
  {
    $faktur = $this->input->post('faktur');
    $result = $this->model->get_faktur($faktur);
    if ($result) {
      echo json_encode($result);
    } else {
      echo json_encode((bool)false);
    }
  }

  function cek_password()
  {
    $password = $this->input->post('password');
    $username = $this->session->identity;
    $faktur = $this->input->post('faktur');
    
    if ($this->ion_auth->login($username, $password, 0)){
      $this->model->hapus_pembayaran($faktur);
      echo json_encode((bool)true);
    } else {
      echo json_encode((bool)false);
    }
  }

  function cek_password_edit()
  {
    $password = $this->input->post('password');
    $username = $this->session->identity;
    $faktur = $this->input->post('faktur');
    if ($this->ion_auth->login($username, $password, 0)){
      $this->permit = true;
      echo json_encode((bool)true);
    } else {
      echo json_encode((bool)false);
    }
  }

  public function update($faktur)
    {
      // if ($this->permit == false) {
      //   redirect('penarikan','refresh');
      // } else {
        $aset = $this->Aset_model->get_all();
        $data = array(
            'aset_data' => $aset,
            'aktif'			=>'delivery',
            'title'			=>'Brajamarketindo',
            'judul'			=>'Dashboard',
            'sub_judul'	=>'Penarikan',
            'content'		=>'ubah',
            'gudang'    => $this->Aset_model->get_gudang(),
            'detail'    => $this->model->get_by_id($faktur),
        );
        $this->load->view('panel/dashboard', $data);
      // }
    }

}
