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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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
    <script src="<?php echo base_url()?>assets/template/production/js/kebutuhan.js"></script>

    <script src="<?php echo base_url()?>assets/template/production/js/suplier.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/transaksi.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/pembelian.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/transaksi_admin.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/piutang.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/dept.js"></script>

    <script src="<?php echo base_url()?>assets/template/production/js/jadwal.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/pembayaran.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/custom.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/jquery.PrintArea.js"></script>

    <script src="<?php echo base_url()?>assets/template/vendors/validator/validator.js"></script>
    <?php
	    if ($this->uri->segment(1) == 'pelanggan') {?>
    <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php
	  } ?>
    <?php
	    if ($this->uri->segment(1) == 'effectifcall') {?>
    <script src="<?php echo base_url()?>assets/template/production/js/effectifcall.js"></script>
    <?php
	  } ?>
    <?php if ($this->uri->segment(1) == 'som'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if($this->uri->segment(1) == 'delivery'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/delivery.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(1) == 'market'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/market.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'tracking'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/tracking.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) == 'pembayaran'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_pembayaran.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'marketing'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_marketing.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'produk'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_produk.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'penjualan'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_penjualan.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'area'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_area.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(1) == 'produk'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/produkshare.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'penarikan'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_penarikan.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/laporan_penarikan_debt.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(1) == 'gtransaksi'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/gtransaksi.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'sumberdata'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/sumberdata.js" charset="utf-8"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'effectivecall'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/kpieffectifecall.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'harian'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/hariandebt.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'kpi' && $this->uri->segment(2) == 'debt'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/kpi-debt.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'kpi' && $this->uri->segment(2) == 'marketing'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/kpi-marketing.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'kas'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/kas.js" charset="utf-8"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'status_pelanggan'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/status_pelanggan.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'tracking_aset'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/tracking_aset.js" charset="utf-8"></script>
      <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) == 'sudavalidator'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/sudavalidator/sudavalidator.js"></script>
    <?php endif; ?>
    <?php if ($this->uri->segment(2) == 'validator'): ?>
      <script src="<?php echo base_url()?>assets/template/production/js/sudavalidator/kpivalidator.js"></script>
    <?php endif; ?>
    
    <script src="<?php echo base_url()?>assets/template/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo base_url()?>assets/template/build/js/custom.min.js"></script>
    <script>
      function formatNumber (num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
      }
    </script>
  </body>
</html>
