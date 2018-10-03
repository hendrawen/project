<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_wilayah extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan/Daerah_model','daerah');
		if (!$this->ion_auth->logged_in()) {//cek login ga?
			redirect('login','refresh');
		}
	}
	

	function get_kecamatan($kota)
    {
      $kecamatan = $this->daerah->get_kecamatan($kota);
      $pesan = "";
      $pesan .= '<option value="">--Pilih Kecamatan-- </option>';
  	  foreach($kecamatan as $k){
  	    $pesan.= "<option id_kecamatan='{$k->id_kec}' value='{$k->nama}'>{$k->nama}</option>";
  	  }
      echo $pesan;
    }

    function get_kelurahan($kecamatan)
    {
      $kelurahan = $this->daerah->get_kelurahan($kecamatan);
      $pesan = "";
      $pesan .= '<option value="">--Pilih Kelurahan-- </option>';
      foreach($kelurahan as $k){
  	    $pesan .= "<option value='{$k->nama}'>{$k->nama}</option>";
  	  }
      echo $pesan;
    }
}

/* End of file Controllername.php */
