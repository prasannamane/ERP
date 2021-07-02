<!DOCTYPE html>

    <link href='<?php echo base_url(); ?>assets/packages/core/main.css' rel='stylesheet' />
    <link href='<?php echo base_url(); ?>assets/packages/daygrid/main.css' rel='stylesheet' />
    <script src='<?php echo base_url(); ?>assets/packages/core/main.js'></script>
    <script src='<?php echo base_url(); ?>assets/packages/interaction/main.js'></script>
    <script src='<?php echo base_url(); ?>assets/packages/daygrid/main.js'></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">

    <style type="text/css">
        .fc-dayGrid-view .fc-body .fc-row { 
          height: 130px !important;
        }

        .fc-scroller.fc-day-grid-container {
            height: initial !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() 
        {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, 
            {
                plugins: [ 'interaction', 'dayGrid' ],
                header: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                defaultDate: '<?php echo date("Y-m-d"); ?>',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events:'<?php echo site_url('fi_calendar/get_event');?>',
               
                dateClick: function (info) 
                {
                    // window.location.assign("http://tech599.com/tech599.com/johnsum/erp_new/fi_home/newGeneralInfo");
                    var dt = info.dateStr;
                    $("table tr td[data-date='"+dt+"']").find("a")[0].click();
                 
                },
                
                eventClick: function (info) 
                {
                    
                    //  var event_id=info.event.id;
                    //   alert(event_id);
                    // window.location.assign("http://tech599.com/tech599.com/johnsum/erp_new/fi_home/calender_search_cus/"+event_id);
                    
                    info.jsEvent.preventDefault(); // don't let the browser navigate
                    if (info.event.url)
                    {
                        window.open(info.event.url);
                    }
    
                },
                eventDrop: function(info,dayDelta,minuteDelta,allDay,revertFunc)
                {
                    var a = info.event.extendedProps.description;
                    if(a == "Event")
                    {
                        var utcDate = info.event.start.toISOString();  // ISO-8601 formatted date returned from server
                        var localDate = new Date(utcDate);
                        var date = info.event.start.getMonth()+1 + "/" + info.event.start.getDate() + "/" + info.event.start.getFullYear();
        
                        var id =  info.event.id;
        
        
                        var r =confirm("Do you want to update the event date..?");
                        if(r==true)
                        {
                            var con = "No";
                            var con1 = "No";
                            var loc_confirm = confirm('Do you want to change location date for this event?');
                            if (loc_confirm == true) {
                              con = "Yes";
                            }
        
                            var loc_confirm1 = confirm('Do you want to change crew avaliability date for this event?');
                            if (loc_confirm1 == true) {
                              con1 = "Yes";
                            }
        
                            $.ajax({
                                url: '<?php echo site_url('fi_calendar/update_event');?>',
                                data: ({
                                event_start_date: date,
                                id: id,
                                loc_confirm: con,
                                loc_confirm1: con1
                                }),
                                type: "POST",
                                success: function (data) {
                                    // alert(data);
                                      // $('#calendar').empty();
                                    // $('#calendar').fullCalendar( 'refetchEvents' );
                                    alert('Event Update..!');
                                    // calendar.fullCalendar('refetchEvents');
                                      calendar.render('refetchEvents');
                                },
                                error: function (xhr, status, error) {
                                    alert("fail");
                                }
                            });
                        }
                        else
                        {
                            window.location=window.location.href;
                        }
                    }
                    else
                    {
                        info.revert();
                    }
                }
            });

            calendar.render();


        });

        $(function() 
        { // document ready

            $('#calendar').fullCalendar({
                dayClick: function(date, allDay, jsEvent, view) 
                {
                    window.location.assign("https://www.google.com/");
                    // change the day's background color just for fun
                    $(this).css('background-color', '#5C5550');

                }

            });
        });

    </script>
    <style>

        .closebtn, .snoozbtn, .snoozbtn:active{ display: inline-block; margin: 0 3px; font-size: 18px; color: #716f6f;  }
        .snoozactive { color: #e67a2e !important; }
        body {
          padding: 0;
          font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
          font-size: 14px;
        }

        #calendar {
          width: 100%;
          max-width: 100%;
          margin: 0 auto;
        }
        
        .content {
            background: #fff;
        }
        
        .fc-widget-header:first-of-type, .fc-widget-content:first-of-type {
            border-left: 1px solid #ddd;
        }
        
        .fc-widget-header:last-of-type, .fc-widget-content:last-of-type {
            border-right: 1px solid #ddd;
        }
        
        
        td.fc-day {
            background: #fcf8e3;
        }
        
        .fc-unthemed td.fc-today {
            background: 	#f5e8a3;
        }
        
        .fc-dayGrid-view .fc-body .fc-row { 
            min-height: 60px;
        }

        .calendar_page .filters {
            box-shadow: none;
            border-bottom: 1px solid #fafafa;
            padding: 10px 20px 10px 16px;
            border-radius: 5px;
            margin: 0 0 15px;
            height: 104px;
        }

        .calendar_page .filters form {
            margin: 0;
        }

        .calendar_page .fc-button { 
            padding: 1px 4px;
            font-size: 12px;
        }

        .calendar_page .fc-left .fc-button { 
            font-size: 11px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .filters .col-md-3 {
            width: 180px;
        }

        .filters .space3.row > .col-md-2 {
            width: 90px;
        }

    </style>
      
    <div class="content-wrapper calendar_page">
        <section class="content">

            <?php if(isset($success)){?>
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong></strong> <?=$success?>
                </div>
            <?php }?>

            <?php if(isset($error)){?>
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?=$error?>
                </div>
            <?php }?>
            
            <div class="filters box box-primary">
                
                <?php
                    // Fetch calendar search form details from session
                    $calendar_session = $this->session->userdata("calendar_search_form");
                    // -------------------------------------------------
                ?>
                
                <form action="<?php echo base_url("fi_calendar/calendar_search"); ?>" method="POST" id="csearch">
                    <div class="row space3">
                        <!-- <h2 class="pull-left box_heading">Calendar </h2> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <!-- <input type="text" readonly="" class="form-control" value="<?=$this->session->fi_session['name']?> <?=$this->session->fi_session['last_name']?>" name="cal_names" id="cal_names"> -->
                              <select class="form-control" name="cal_names" id="cal_names">
                                   <option value=""><?=$this->session->fi_session['name']?> <?=$this->session->fi_session['last_name']?></option>
                                  <option value=""><?=$this->session->fi_session['name']?> <?=$this->session->fi_session['last_name']?> </option>
                                  <option value=""><?=$this->session->fi_session['name']?> <?=$this->session->fi_session['last_name']?></option>
                              </select>
                            </div>
                        </div>

                        <h2 class="pull-left current_month">January 2020</h2>

                        <div class="pull-right">                                                                 
                            <button type="button" class="fc-today-button fc-button fc-button-primary" disabled="">Today</button>                              
                        </div>
                    </div>

                    <div class="row space3 noborder"> 
                        

                        <div class="col-md-2" style="width:90px;">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ven_check" name="ven_check" <?php echo (isset($calendar_session['ven_check']) && $calendar_session['ven_check']=="on")? "checked" : ""; ?> > Vendors </label>
                                </div>
                            </div>
                        </div>

                        <?php 
                        if(isset($calendar_session['ven_check']) && $calendar_session['ven_check']=="on") { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="vendor" name="vendor" Placeholder="Vendor Name" value="<?php echo (isset($calendar_session['vendor']) && $calendar_session['vendor']!="")? $calendar_session['vendor'] : ""; ?>" />
                                <!--<select class="form-control" id="cal_vendors">-->
                                <!--    <option value="">Vendors</option>-->
                                <!--    <option value="">test</option>-->
                                <!--    <option value="">test</option>-->
                                <!--</select>-->
                            </div>
                        </div>
                        <?php  } ?> 
                        
                        <div class="col-md-2" style="width:130px;">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="app_check" name="app_check" <?php echo (isset($calendar_session['app_check']) && $calendar_session['app_check']=="on")? "checked" : ""; ?> > Appointments </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2" style="width:90px;">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="todo_check" name="todo_check" <?php echo (isset($calendar_session['todo_check']) && $calendar_session['todo_check']=="on")? "checked" : ""; ?> > Todo </label>
                                </div>
                            </div>
                        </div>

                       
                         
                         <div class="calendar_btns w220 pull-right">
                            <div class="fc-toolbar fc-header-toolbar">
                                <div class="fc-left">

                                    <div class="fc-button-group">
                                        <button type="button" class="fc-prevYear-button fc-button fc-button-primary" aria-label="prevYear"><span class="fc-icon fc-icon-chevrons-left"></span></button><button type="button" class="fc-prev-button fc-button fc-button-primary" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button><button type="button" class="fc-next-button fc-button fc-button-primary" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button><button type="button" class="fc-nextYear-button fc-button fc-button-primary" aria-label="nextYear"><span class="fc-icon fc-icon-chevrons-right"></span></button>
                                    </div>
                                    <!-- <button type="button" class="fc-today-button fc-button fc-button-primary" disabled="">today</button> -->
                                </div>
                            <div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active">Month</button><button type="button" class="fc-dayGridWeek-button fc-button fc-button-primary">Week</button><button type="button" class="fc-dayGridDay-button fc-button fc-button-primary">Day</button></div></div></div>
                        </div>
                        <div class="d_full pull-right">February 05, 2020</div>
                    </div>
                </form>
            </div>
            <div id='calendar'></div>
        </section>      
    </div>
      
    <!-- Main Footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#ven_check").click(function(){
                $("#csearch").submit();
            });
            
            $("#app_check").click(function(){
                $("#csearch").submit();
            });
            
            $("#todo_check").click(function(){
                $("#csearch").submit();
            });
            
            $("#vendor").blur(function(){
                $("#csearch").submit();
            });
        });
    </script>


    <script>
        $(document).ready(function(){ 

            $(".fc-day-top").each(function(e) {
            
                var dt_new  = $(this).attr("data-date");
                res         = dt_new.split("-");
                var year_   = res[0]; //alert(year_);
                var month_1  = res[1]; //alert(month_1);
                var day_    = res[2]; //alert(year_);
                
                var currenttt = $(this);

                $.ajax({
                    url: 'https://www.hebcal.com/converter/?cfg=json&gy='+year_+'&gm='+month_1+'&gd='+day_+'&g2h=1',
                    type: "GET",
                    success: function (data) {
                         //data = jQuery.parseJSON(data); 
                      var h_year    = data.hy; //year
                      var h_month   = data.hm; //month
                      var h_day     = data.hd; //day
                      monthNames    = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
                      var month_2   = month_1 - 1;
                      //var month_    = monthNames[month_2]; //day
                        //const d = new Date();
                        //alert(d);
                        //document.write("The current month is " + monthNames[d.getMonth()]);

                        
                // $(this).append(h_day+' '+h_month+' '+h_year+', '+month_+' '+day_); +' '+day_

                h_month = h_month.replace(/'/g,"");
                $(currenttt).append('<span class="hd_appended">'+h_day+' '+h_month+' '+h_year+', '+monthNames[month_2]+'</sapn>');
                    }
                });

            });


           
        });
    </script>