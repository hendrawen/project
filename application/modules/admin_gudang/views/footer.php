<!-- footer content -->
        <footer>
          <div class="pull-right">
            Page rendered in :
            <?php echo $this->benchmark->elapsed_time();?> seconds
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/template/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>assets/template/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->

    <script src="<?php echo base_url()?>assets/template/production/js/jquery-ui.js" type="text/javascript"></script>

    <script src="<?php echo base_url()?>assets/template/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url()?>assets/template/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url()?>assets/template/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url()?>assets/template/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url()?>assets/template/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url()?>assets/template/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->

    <script src="<?php echo base_url()?>assets/template/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url()?>assets/template/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url()?>assets/template/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>


    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

    <script src="<?php echo base_url()?>assets/template/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/dataTables.rowsGroup.js"></script>

    <script src="<?php echo base_url()?>assets/template/production/js/jquery.cookie.js"></script>
    <?php
      $uri1 = $this->uri->segment(1);
      $uri2 = $this->uri->segment(2);
    ?>

    <?php if ($uri1 == 'admin_gudang' && ($uri2 == 'pembelian' || $uri2 == 'pembayaran_barang')): ?>
    <script src="<?= base_url('assets/template/production/js/admin_gudang/pembelian.js')?>"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) == 'muat' && $this->uri->segment(1) == 'admin_gudang'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/admin_gudang/muat.js"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'stok_opname' && $this->uri->segment(1) == 'admin_gudang'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/admin_gudang/stok_opname.js"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'pembayaran_aset' && $this->uri->segment(1) == 'admin_gudang'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/admin_gudang/pembayaranaset.js"></script>
    <?php endif; ?>

    <script src="<?= base_url('assets/template/production/js/admin_gudang/custom.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/build/js/custom.min.js"></script>
    <script>
      function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
      }
    </script>
  </body>
</html>
