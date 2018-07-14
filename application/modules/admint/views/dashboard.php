<?php
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
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

<?php $this->load->view('template/footer');?>
