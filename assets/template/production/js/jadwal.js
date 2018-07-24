$(function(){
    get_all_jadwal();
    var currentDate; // Holds the day clicked when adding a new event
    var currentEvent; // Holds the event object when editing an event

    function get_all_jadwal() {
        $("#loading").show();
        $.ajax({
          url: base_url+'jadwal/jadwal_all/',
          type: 'POST',
          dataType: 'html',
          success : function (data) {
            $("#loading").hide();
            $("#tbody-jadwal").html(data);
          }
        })
      }
    
      $("#btn-jadwal-harian").click(function() {
        tgl = $("#tgl").val();
        $("#loading").show();
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.ajax({
          url: base_url+'jadwal/load_jadwal_harian/',
          type: 'POST',
          dataType: 'html',
          data: {tgl: tgl},
          success : function (data) {
            $("#loading").hide();
            $("#tbody-jadwal").html(data);
    
          }
        })
      });

      $("#btn-refresh-jadwal").click(function() {
        get_all_jadwal();
      });

    // Fullcalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev, next, today',
            center: 'title',
             right: 'month, basicWeek, basicDay, listWeek'
        },
        // Get all events stored in database
        eventLimit: true, // allow "more" link when too many events
        events: (base_url+'jadwal/getEvents'),
        selectable: true,
        selectHelper: true,
        editable: true, // Make the event resizable true
            select: function(start, end) {

                $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                 // Open modal to add event
            modal({
                // Available buttons when adding
                buttons: {
                    add: {
                        id: 'add-event', // Buttons id
                        css: 'btn-success', // Buttons class
                        label: 'Simpan' // Buttons label
                    }
                },
                title: 'Tambah Jadwal' // Modal title
            });
            },

         eventDrop: function(event, delta, revertFunc,start,end) {

            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }
                $.ajaxSetup({
                    data: {
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    }
                });
               $.post(base_url+'jadwal/dragUpdateEvent',{
                id:event.id,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                hide_notify();


            });



          },
          eventResize: function(event,dayDelta,minuteDelta,revertFunc) {

                start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }
                $.ajaxSetup({
                    data: {
                        csrf_test_name: $.cookie('csrf_cookie_name')
                    }
                });
               $.post(base_url+'jadwal/dragUpdateEvent',{
                id:event.id,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                hide_notify();

            });
            },

        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view){

            var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },
        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            // Set currentEvent variable according to the event clicked in the calendar
            currentEvent = calEvent;

            // Open modal to edit or delete event
            modal({
                // Available buttons when editing
                buttons: {
                    delete: {
                        id: 'delete-event',
                        css: 'btn-danger',
                        label: 'Hapus'
                    },
                    update: {
                        id: 'update-event',
                        css: 'btn-success',
                        label: 'Ubah'
                    }
                },
                title: 'Edit Jadwal "' + calEvent.title + '"',
                event: calEvent
            });
        }

    });

    // Prepares the modal window according to data passed
    function modal(data) {
        $('#wp_pelanggan_id').select2();
        // Set modal title
        $('.modal-title').html(data.title);
        // Clear buttons except Cancel
        $('.modal-footer button:not(".btn-default")').remove();
        // Set input values
        $('#wp_pelanggan_id').val(data.event ? data.event.wp_pelanggan_id : '');
        $('#wp_barang_id').val(data.event ? data.event.wp_barang_id : '');
        $('#title').val(data.event ? data.event.title : '');
        $('#qty').val(data.event ? data.event.qty : '');
        $('#description').val(data.event ? data.event.description : '');
        $('#color').val(data.event ? data.event.color : '#3a87ad');
        $('#wp_karyawan_id_karyawan').val(data.event ? data.event.wp_karyawan_id_karyawan : '');
        // Create Butttons
        $.each(data.buttons, function(index, button){
            $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
        })
        //Show Modal
        $('.modal').modal('show');
    }

    // Handle Click on Add Button
    $('.modal').on('click', '#add-event',  function(e){
        if(validator(['title', 'description'])) {
            $.ajaxSetup({
                data: {
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            $.post(base_url+'jadwal/addEvent', {
                title: $('#title').val(),
                description: $('#description').val(),
                wp_pelanggan_id: $('#wp_pelanggan_id').val(),
                wp_barang_id: $('#wp_barang_id').val(),
                qty: $('#qty').val(),
                color: $('#color').val(),
                start: $('#start').val(),
                end: $('#end').val(),
                wp_karyawan_id_karyawan: $('#wp_karyawan_id_karyawan').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('Event added successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
        }
    });


    // Handle click on Update Button
    $('.modal').on('click', '#update-event',  function(e){
        if(validator(['title', 'description'])) {
            $.ajaxSetup({
                data: {
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            $.post(base_url+'jadwal/updateEvent', {
                id: currentEvent._id,
                title: $('#title').val(),
                description: $('#description').val(),
                wp_pelanggan_id: $('#wp_pelanggan_id').val(),
                wp_barang_id: $('#wp_barang_id').val(),
                qty: $('#qty').val(),
                color: $('#color').val(),
                wp_karyawan_id_karyawan: $('wp_karyawan_id_karyawan').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('Event updated successfuly');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();

            });
        }
    });
    


    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
        $.ajaxSetup({
            data: {
                csrf_test_name: $.cookie('csrf_cookie_name')
            }
        });
        $.get(base_url+'jadwal/deleteEvent?id=' + currentEvent._id, function(result){
            $('.alert').addClass('alert-success').text('Event deleted successfully !');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();
        });
    });

    function hide_notify()
    {
        setTimeout(function() {
                    $('.alert').removeClass('alert-success').text('');
                }, 2000);
    }


    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Please insert title and description');
            return false;
        }
        return true;
    }
});
