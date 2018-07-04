<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Debt extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ion_auth_model');
        $this->permit = $this->Ion_auth_model->permission($this->session->identity);

        if (!$this->ion_auth->logged_in()) {//cek login ga?
            redirect('login','refresh');
        }
        $this->load->model('Model_debt', 'debt');
        
    }
    

    function index()
    {
        $cek = get_permission('Effectif Call', $this->permit[1]);
        if (!$cek) {//cek admin ga?
            redirect('panel','refresh');
        }
        $data['aktif']			='Master';
        $data['title']			='Brajamarketindo';
        $data['judul']			='Dashboard';
        $data['sub_judul']	    ='Report Harian Debt';
        $data['content']		='main';
        $data['menu']			= $this->permit[0];
        $data['submenu']		= $this->permit[1];
        $this->load->view('panel/dashboard', $data);
    }

    function get_autocomplete(){
		if (isset($_GET['term'])) {
            $result = $this->debt->cari_pelanggan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'			=> $row->id_pelanggan,
                    );
                    echo json_encode($arr_result);
            }
        }
    }
    
    function track_faktur()
    {
      $cari = $this->input->post('judul');
      $total = 0;
      $i = 0;
         $query = $this->debt->get_track($cari);
          foreach ($query as $key) {
            $data = array(
                  'id'              => $key->id_transaksi,
                  'id_pelanggan'    => $key->id_pelanggan,
                  'name'            => $key->nama_pelanggan,
                  'nama_barang'     => $key->nama_barang,
                  'qty'             => $key->qty,
                  'satuan'          => $key->satuan,
                  'nama'            => $key->nama,
                  'price'        => $key->subtotal,
            ); 
            $list_faktur =  $this->cart->insert($data);
            ?>
         <?php }
            foreach ($this->cart->contents() as $row) {?>
                <tr>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->id_pelanggan ?></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->nama_barang ?></td>
                    <td><?php echo $row->qty ?></td>
                    <td><?php echo $row->satuan ?></td>
                    <td><?php echo $row->nama ?></td>
                    <td><?php echo $row->price ?></td>
                    <td></td>
                    <td></td>
                <tr>;
            <input type="hidden" id="autofakturdebt" class="form-control" value="<?php echo $key->id_pelanggan ?>" name="autofakturdebt" required="">
         <?php }
         ;
    }

    function cek()
    {
        # code...
        print_r($this->cart->contents());
    }

}

/* End of file Debt.php */
