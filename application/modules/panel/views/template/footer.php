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
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>assets/template/build/js/custom.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#data").dataTable();
        });
    </script>

    <script>
    var save_method; //for save method string
    var table;
         $(document).ready(function () {
              table = $('#table').dataTable({
               "processing": true, //Feature control the processing indicator.
               "serverSide": true, //Feature control DataTables' server-side processing mode.
               "order": [], //Initial no order.

               // Load data for the table's content from an Ajax source
               "ajax": {
                   "url": "<?php echo base_url('pelanggan/ajax_list')?>",
                   "type": "POST",
                   "data": function ( data ) {
                        data.kota = $('#kota').val();
                        data.status = $('#status').val();
                        data.kelurahan = $('#kelurahan').val();
                        data.kecamatan = $('#kecamatan').val();
                        data.nama = $('#nama').val();
                    }
               },

               //Set column definition initialisation properties.
               "columnDefs": [
               {
                   "targets": [ 13 ], //first column / numbering column
                   "orderable": false, //set not orderable
               },
               ],
             });

             $('#btn-filter').click(function(){ //button filter event click
                 $('#table').DataTable().ajax.reload();//reload datatable ajax   //just reload table
             });
             $('#btn-reset').click(function(){ //button reset event click
                 $('#form-filter')[0].reset();
                 $('#table').DataTable().ajax.reload();//reload datatable ajax
             });
         });

         function add_pelanggan()
          {
              save_method = 'add';
              $('#form')[0].reset(); // reset form on modals
              $('.form-group').removeClass('has-error'); // clear error class
              $('.help-block').empty(); // clear error string
              $('#modal_form').modal('show'); // show bootstrap modal
              $('.modal-title').text('Tambah Pelanggan'); // Set Title to Bootstrap modal title
          }

          function reload_table()
          {
               $('#table').DataTable().ajax.reload(null,false)//reload datatable ajax
          }

          function save()
          {
              $('#btnSave').text('saving...'); //change button text
              $('#btnSave').attr('disabled',true); //set button disable
              var url;

              if(save_method == 'add') {
                  url = "<?php echo site_url('pelanggan/ajax_add')?>";
              } else {
                  url = "<?php echo site_url('pelanggan/ajax_update')?>";
              }

              // ajax adding data to database
              $.ajax({
                  url : url,
                  type: "POST",
                  data: $('#form').serialize(),
                  dataType: "JSON",
                  success: function(data)
                  {

                      if(data.status) //if success close modal and reload ajax table
                      {
                          $('#modal_form').modal('hide');
                          reload_table();
                      }
                      else
                      {
                          for (var i = 0; i < data.inputerror.length; i++)
                          {
                              $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                              $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                          }
                      }
                      $('#btnSave').text('save'); //change button text
                      $('#btnSave').attr('disabled',false); //set button enable


                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error adding / update data');
                      $('#btnSave').text('save'); //change button text
                      $('#btnSave').attr('disabled',false); //set button enable

                  }
              });
          }

          function delete_pelanggan(id)
          {
              if(confirm('Are you sure delete this data?'))
              {
                  // ajax delete data to database
                  $.ajax({
                      url : "<?php echo site_url('pelanggan/ajax_delete')?>/"+id,
                      type: "POST",
                      dataType: "JSON",
                      success: function(data)
                      {
                          //if success reload ajax table
                          $('#modal_form').modal('hide');
                          reload_table();
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error deleting data');
                      }
                  });

              }
          }

    </script>
  </body>
</html>
