<!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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

    <script src="<?php echo base_url()?>assets/template/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url()?>assets/template/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
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
    <script src="<?php echo base_url()?>assets/template/production/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url()?>assets/template/production/js/pelanggan.js"></script>

    <!-- <script type="text/javascript" src="<?php echo base_url().'assets/jquery.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/bootstrap.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/jquery.dataTables.js'?>"></script> -->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>assets/template/build/js/custom.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            tampil_data_suplier();   //pemanggilan fungsi tampil barang.

            $('#mydata').dataTable();

            //fungsi tampil barang
            function tampil_data_suplier(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?php echo base_url()?>suplier/data_suplier',
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<tr>'+
                                    '<td>'+data[i].id_suplier+'</td>'+
                                    '<td>'+data[i].nama_suplier+'</td>'+
                                    '<td>'+data[i].alamat+'</td>'+
                                    '<td style="text-align:right;">'+
                                      '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id+'">Edit</a>'+' '+
                                      '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].id+'">Hapus</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                    }

                });
            }

        });

    </script>

  </body>
</html>
