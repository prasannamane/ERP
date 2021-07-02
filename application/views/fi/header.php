<html>
    <head>
    <meta http-equiv="refresh" content="3600;url=<?=base_url('fi_home/logout')?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Dashboard</title>

    <link rel="icon" href="<?php echo base_url('assets/');?>fevicon.png" type="image/gif" sizes="16x16">
 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">


   
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .loaders {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border: 16px solid #fff;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin: 15% auto;
        opacity: 1;
    }

    div#reminder_notification {
        min-width: 280px;
        padding: 10px;
        box-shadow: 0 0 10px #8c70b3;
        border-radius: 5px;
    }

    .note_btns {
        padding: 10px 0;
    }

    div#reminder_notification hr {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    
    .fadeMes {
        opacity: 1;
        width: 100%;
        height: 100%;
        z-index: 10;
        top: 0;
        background: rgba(0,0,0,0.5);
        left: 0;
        position: fixed;
        text-align: center;
        display: none;
    }
    </style>
</head>
    <?php 
    if(!isset($this->session->fi_session['id']))
    {
        redirect(site_url('fi_home/logout')); 
    } ?> 

    <!-- Main Header -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">ERP</span>
                        <!-- logo for regular state and mobile devices -->
                        <div class="logo-lg">
                            <img src="<?php echo base_url('assets/');?>dist/img/logo.png" alt="logo" class="img-responsive">
                        </div>
                </a>
                
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <!-- search form (Optional) -->

      <form method="POST" id="main_search_form" class="sidebar-form top-sbar">
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control Search" placeholder="Search..." onclick="redirect_here()">
          <span class="input-group-btn">

            <!-- onclick="fnsearchcustomer_mainserach()" -->
          <button type="button" name="search" onclick="fnsearchcustomer_header()"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
          </span>
        </div>
      </form>

      <div id="carousel-example-generic" class="carousel slide dateslider" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        
        <!-- Wrapper for slides -->
        <?php 
            $daily = array();
            
            $dt = date("Y-m-d");
            $time = date("H");
            
            
            if($time > 0 && $time < 3)
            {
                $t = "00:00:00";
            }
            else if($time >= 3 && $time < 6)
            {
                $t = "03:00:00";
            }
            else if($time >= 6 && $time < 9)
            {
                $t = "06:00:00";
            }
            else if($time >= 9 && $time < 12)
            {
                $t = "09:00:00";
            }
            else if($time >= 12 && $time < 15)
            {
                $t = "12:00:00";
            }
            else if($time >= 15 && $time < 18)
            {
                $t = "15:00:00";
            }
            else if($time >= 18 && $time < 21)
            {
                $t = "18:00:00";
            }
            else if($time >= 21)
            {
                $t = "21:00:00";
            }
            
            $cdt = $this->db->query("SELECT * FROM daily_forecast WHERE dt = '".$dt."' AND time = '".$t."'")->row_array();
            if(empty($cdt))
            {
                 $cdt = $this->db->query("SELECT * FROM daily_forecast WHERE dt = '".$dt."'")->row_array();
            }
            
            $daily[] = $cdt;
            
            for($i=1;$i<5;$i++)
            {
                $dt1 = date("Y-m-d", strtotime($dt." +".$i." day"));
                
                $res = $this->db->query("SELECT * FROM daily_forecast WHERE dt = '".$dt1."'")->row_array();
                $daily[] = $res;
            }
            
           
        ?>
        
        <!-- <div class="carousel-inner" role="listbox">
            <?php 
            $i = 1;
            foreach($daily as $d)
            {
               
                ?>
                <div class="item <?php echo ($i==1)? "active" : ""; ?>">
                    <div class="datentime">
                      <p><span> <?php echo date("l, F d, Y", strtotime($d['dt'])); ?></span><span>9:03 AM  </span>  </p>
                      <div class="card top">
                        <div class="card-block">
                          <p><?php echo $d['weather']; ?> <small><span class="grey-text">· Wind <?php echo $d['wind']."mps"; ?> · Humidity: <?php echo $d['humidity']; ?>%</span></small></p>
                          <div class=" today text-xs-center amber-text"><i class="fa fa-sun-o" aria-hidden="true"></i></div>
                          <div class=" today text-xs-center"><?php echo $d['temp']; ?>°F</div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                
                $i = $i + 1;
            }
            ?>
          
        </div> -->
        
        <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">-->
        <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <!--<span class="sr-only">Previous</span>-->
        <!--</a>-->
        <!--<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">-->
        <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
        <!--<span class="sr-only">Next</span>-->
        <!--</a>-->
        <a href="https://www.accuweather.com/" target="_Blank">
        <div class="table-responsive">
          <table class="table table-bordered wheather_table w400 fixed_table" >
            <tr>
              <th class="w200"><?php /*commented by suchita echo date("D d, F , Y", strtotime($daily["0"]['dt']));*/ echo date('l, F d, Y', strtotime($daily["0"]['dt']));?><!--  <span style="margin-left: 70px;">  <?php echo date("F, Y", strtotime($daily["0"]['dt'])); ?> </span><span style="margin-left: 50px;"><?php echo date("D  d", strtotime($daily["0"]['dt'])); ?></span> --></th>
              <th class="w70"><?php echo date("D j", strtotime($daily["1"]['dt'])); ?> </th>
              <th class="w70"><?php echo date("D j", strtotime($daily["2"]['dt'])); ?></th>
              <th class="w70"><?php echo date("D j", strtotime($daily["3"]['dt'])); ?></th>
            </tr>

            <tr>
              <td><img src="https://openweathermap.org/img/w/<?php echo $daily["0"]['icon']; ?>.png" alt="wheather"> <?php echo $daily["0"]['weather']; ?>  <?php echo $daily["0"]['temp']; ?>°F</td>
              <td><img src="https://openweathermap.org/img/w/<?php echo $daily["1"]['icon']; ?>.png" alt="wheather"> <?php echo $daily["1"]['temp']; ?>°F</td>
              <td><img src="https://openweathermap.org/img/w/<?php echo $daily["2"]['icon']; ?>.png" alt="wheather"> <?php echo $daily["2"]['temp']; ?>°F</td>
              <td><img src="https://openweathermap.org/img/w/<?php echo $daily["3"]['icon']; ?>.png" alt="wheather"> <?php echo $daily["3"]['temp']; ?>°F</td>
               
            </tr>

           <!--  <tr>
             <td><?php echo $daily["0"]['temp']; ?>°F</td>
             <td><?php echo $daily["1"]['temp']; ?>°F</td>
             <td><?php echo $daily["2"]['temp']; ?>°F</td>
             <td><?php echo $daily["3"]['temp']; ?>°F</td>
           </tr> -->
          </table>
        </div>
      </a>

        
       
       
      </div>
      <div class="task">
        Tasks: <span><?php $count_ = $this->db->query("SELECT count(*) as count_ FROM `invoice_task`")->row_array();  print_r($count_['count_'] ); ?></span>
      </div>
      <!-- /.search form -->
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?php echo base_url();?><?=$this->session->fi_session['profile_img']?>" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <h4>Welcome !</h4>
            <br>
            <span class="hidden-xs"><?=$this->session->fi_session['name']?> <?=$this->session->fi_session['last_name']?> </span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="<?php echo base_url();?><?=$this->session->fi_session['profile_img']?>" class="img-circle" alt="User Image">
              <p>
                User
                <small>ERP System</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-info btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <!--<a href="<?php echo site_url('fi_home/logout');?>"  class="btn btn-info btn-flat">Sign out</a>-->
                <a href="javascript:logoutFunction()" class="btn btn-info btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->

      <li class="dropdown ptop-10">

                      <?php


                      ?>
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fa fa-bell"></i>
                        <span id="reminder_count" class="label label-primary">
                      </span>
                    </a>

                    <ul class="dropdown-menu dropdown-alerts" id="dropdown-alerts_new">
                        <li>
                            <div id="reminder_notification">
                              <?php
                              $current_date=date("Y-m-d H:i:s");
                              $sql_uery="SELECT r.*,c.app_desc,rc.cus_lname FROM `reminder_entry` r join customer_appointment c on r.reminder_id=c.id join register_customer rc on c.cus_id=rc.cus_id WHERE r.reminder_datetime <='$current_date' AND r.reminder_status=0";
                          		// echo $sql_uery;
                          			$notification_data 	  = $this->db->query($sql_uery)->result_array();
                                //print_r($notification_data);
                              // $notification_count=count($notification_data);
                              if (count($notification_data) > 0) {
                              foreach ($notification_data as $key) { ?>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> <?php print_r($key['cus_lname']);echo " "; print_r($key['app_desc']);echo " "; print_r($key['note_time']) ?>

                                    </div>
                                </a>

                                <div class="note_btns">
                                  <!-- <a onclick="function_snooze()" class="btn btn-xs btn-info"> Snooze</a> -->

                                  <label>Snooze Time </label>
                                  <div class="row">
                                    <div class="col-xs-6">
                                      <select class="form-control" onchange="function_snooze(this.value)">
                                        <option value="">Select</option>
                                        <option value="05">5 sec</option>
                                        <option value="10">10 sec</option>
                                        <option value="15">15 sec</option>
                                        <option value="20">20 sec</option>
                                        <option value="25">25 sec</option>
                                      </select>
                                    </div>
                                    <div class="col-xs-6">
                                      <input type="hidden" id="reminder_ids" value="<?=$key['id']  ?>">
                                      <a onclick="function_dissmiss()" class="btn btn-xs btn-info pull-right">Dismiss</a>
                                    </div>
                                  </div>


                                  <div class="clearfix"></div>
                                  <span class="divider"></span>
                                </div>
                                <hr>


                            <?php  }}
                               ?>



                            <div class="text-center link-block">
                                <a href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                            </div>
                        </li>


                    </ul>

                </li>
                </ul>
    </div>
    <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>
  </nav>


<style>
ptop-10 { width: 40px !important; }


</style>

  <script>
      function logoutFunction()
      {
          localStorage.clear();
          var path = '<?php echo site_url('fi_home/logout');?>';
          window.location.href=path;
      }
  </script>




</header>

<script type="text/javascript">
function redirect_here(){

 // alert();

  if("<?=base_url('fi_home/cust_search')?>" != window.location.href){
    location.href = 'cust_search';
  }
  

}

  
function fnsearchcustomer_header() {

  console.log(1);
    // alert("hi");
    var fname     = $('.Search').val();
    var lname     = $('.Search').val();
    var cname     = ""; //$('.Search').val();
    var adr1      = ""; //$('.Search').val();
    var adr2      = ""; //$('.Search').val();
    var cities    = ""; //$('.Search').val();
    var states    = ""; //$('.Search').val();
    var zname     = ""; //$('.Search').val();
    var areas     = ""; //$('.Search').val();
    var mname     = ""; //$('.Search').val();
    var accno     = ""; //$('.Search').val();
    var acctype   = ""; //$('.Search').val();
    var vendorname= ""; //$('.Search').val();
    var evfdate   = ""; //$('.Search').val();
    var evtdate   = ""; //$('.Search').val();
    var evtype    = ""; //$('.Search').val();
    var evtlocn   = ""; //$('.Search').val();
    var evtinv_no = ""; //$('.Search').val();
    var evtreff_by= ""; //$('.Search').val();
    var bal_as_of = ""; //$('.Search').val(); 

        console.log(fname+"-"
      +lname+"-"
      +cname+"-"
      +adr1+"-"
      +adr2+"-"
      +cities+"-"
      +states+"-"
      +zname+"-"
      +areas+"-"
      +mname+"-"
      +accno+"-"
      +acctype+"-"
      +vendorname+"-"
      +evfdate+"-"
      +evtdate+"-"
      +evtype+"-"
      +evtlocn+"-"
      +evtinv_no+"-"
      +evtreff_by+"-"
      +bal_as_of);

    // alert("acctype "+acctype);
   if(fname != "" || lname != "" || cname != "" || adr1 !="" || adr2!="" || cities!="" || states!="" || zname!="" || areas!="" || mname!="" || accno!="" || acctype!="" || vendorname!="" || 
    evfdate!="" || 
    evtdate!="" || evtype!="" ||
    evtlocn!="" || evtinv_no!="" || evtreff_by!="" || bal_as_of!="") {

     // alert("if");
    var searchcust=$('#frmsearchcust').serialize();
    //alert("searchcust--"+searchcust);

     $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_cust_serch')?>",
            data: {fname:fname, lname:lname},
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                // $('.fadeMe').show();

            },
            success: function(data)
            {
             // alert(data);
                if(data!="")
                {
                  console.log(data);

                 //$('#tab_data tbody').html(data);
                 $('#divfiltercust').html(data);
                 // $('.fadeMe').hide();




               }else{
                   //$('#tab_data tbody').html(data);
                   $('#divfiltercust').html(data);
                    $('.fadeMe').hide();
               }
            }
        });

     }else{
       // alert("else");
        // alert("Please enter atleast one field to search record..!");


            $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_allcust')?>",
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                // $('.fadeMe').show();

            },
            success: function(data)
            {
              //alert(data);
              if(data!="")
               {

                   $('#divfiltercust').html(data);
                   // $('.fadeMe').hide();


                }else{

                   $('#divfiltercust').html(data);
                   $('.fadeMe').hide();
               }
            }
         });

     }

  }

  </script>