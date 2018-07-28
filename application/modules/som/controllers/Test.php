
<?php

class Test extends CI_Controller {
  function index(){

      $data = array(
          'aktif'      => 'Jadwal',
          'content'    => 'som/test',
          'judul'      => 'Dashboard',
          'sub_judul'  => 'Jadwal'
      );
      $this->load->view('dashboard', $data);
  }

  function test1(){
    $data1 = $this->input->post('data');
    
    print_r($data1);
  }

}
?>
