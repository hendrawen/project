<?php
    $this->load->view('panel/template/header');
    $this->load->view('sidebar');
    $this->load->view('panel/template/navbar');
?>



<!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="title_left">
        <h3><i class="fa fa-angle-right"></i> <a href="<?php echo base_url();?>"><?php echo $judul; ?></a> <i class="fa fa-angle-right"></i> <?php echo $sub_judul; ?></h3>
      </div>

      <?php $this->load->view($content);?>

     </div>
  </div>
  <!-- /page content -->

<?php $this->load->view('panel/template/footer');?>
