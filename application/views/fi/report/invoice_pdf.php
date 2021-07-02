<!DOCTYPE html>

<!-- <html>

  <head> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Administration</title>
    <!-- Tell the browser to be responsive to screen width -->
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
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/cotract_invoice_pdf.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


<style type="text/css">

  .loader {
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

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.fadeMe {
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


 <!-- <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap');
      /*font-family: 'Roboto', sans-serif;*/
      .c_sidebar {
    background: #ccc;
    padding: 70px 30px;
      }

      .c_box { font-family: 'Roboto', sans-serif;
          padding: 30px 0;
          border-bottom: 1px solid #807e7e;
      }

      .c_box p { font-size: 12px; 
          color: #000;
          font-weight: 500;
      }
      .c_box p a {  color: #000; font-weight: 400; }

      .c_box .table>tbody>tr>td, .c_box .table>tbody>tr>th{ border-top:none; padding: 2px;}
      .noborder{ border:none !important; }
      .c_main {  padding: 70px 0; font-family: 'Roboto', sans-serif;}
      .c_main h1 {
        font-size: 24px;
        text-align: right;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0 0 40px;
      }
      .pr0{ padding-right: 0 ; }
      .pl0{ padding-left: 0 ; }
      .w100{ width: 100px; display: inline-block; }
      .c_main h3 {
          font-size: 18px;
          font-weight: 700;
          margin: 0 0 15px 10px;
      } 
      .c_mytable tr:last-child { border-bottom: 1px solid #ddd; }
      .c_bortb {  border: 1px solid transparent; border-top-color:#ccc; border-bottom-color:#ccc; padding:10px 0 10px 10px; font-size:13px; }

      .c_details p{ text-align: right; }  
      .c_details p span {
          float: left;
          font-weight: 500;
      } 

      .c_details p span:first-child {
          width: 75%;
          text-align: left;
      }

      .c_desc{ padding: 0 15px; margin: 21px 0; }

      .c_main h4 {float: right; font-size: 21px; font-weight: 600;
      }

      .c_main h4 span { display: inline-block; min-width: 210px;
          border-bottom: 1px solid #ccc;
      }

      .conlogo {width: 240px; display: inline-block;
      }

      .pdfpage_wrap{ padding: 15px; border: 2px solid #ccc; margin: 15px; }

      </style> -->



  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <!-- <div class="wrapper">

      <?php  ?> -->

      <!-- Left side column. contains the logo and sidebar -->

      <!-- <?php  ?> -->

      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

      <section class="content-header">

      <h1>Event Management </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="#">Administration</a></li>

        <li class="active">Items</li>

      </ol>

    </section>
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

        <section class="content search_options">

          <!-- TABLE: LATEST ORDERS -->

          <div class="row">

            <div class="col-md-12">

              <div class="box box-default">
                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-sm-5 col-md-5">
                      <h3 class="uhead1"> Invoice  </h3>
                    </div>
                    <div class="col-sm-7 col-md-7">
                      <div class="pull-right">
                        <ul class="list-inline topul">
                          <!-- <li><a href="#" class="uhead2"> Main Menu </a></li> -->
                          <li><a href="#" class="uhead2"> Options </a></li>
                          <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>
                        </ul>
                        <!-- <a href="#" class="btn btn-md btn-info btn-flat">New Customer</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              






           
      <div class="pdfpage_wrap">


      <div class="header_inv">
      <div class=" "> 
        <div class="row mb20"> 
          <div class="col-sm-6"> <a href="#" class="logo_inv"><img src="<?php echo base_url('assets/dist/img/');?>/logo.png" alt="logo" class="img-responsive"></a>
          <p> <span> QUOTE</span> 483527  </p>
          <p> <span> ISSUED</span> February 14, 2016  </p>
          <p> <span> VALID UNTIL</span> February 21, 2016 </p>
          </div>  
          <div class="col-sm-6 mt20"> 
           <div class="pull-right"> 
            <p> 
              <span> FROM</span>  
              <span>Ell Tee Photo LLC.
              <br>882 BROOKLYN EVE
              <br>Brooklyn, NY 11203</span>
            </p>  

            <p> <span> To</span>  Mrs Fox</p>
           </div>   

          </div>  
        </div>    
      </div>    
    </div>

    <div class="main_inv">
      <div class=" "> 
        <div class="table-responsive"> 
          <table class="table fixed_table"> 
            <tbody><tr> 
              <th>ITEM</th>   
              <th class="w120">QUANTITY</th>    
              <th class="w120">PRICE</th>   
              <th class="w120">TOTAL</th>   
            </tr>

            <tr> 
              <td> 
               <h3>Wedding Package CVF</h3>
               <p>Description of Wedding Package CVF will be here. <br>Description of Wedding Package CVF will be here.</p>

               </td>    
              <td>1</td>    
              <td>$4,150.00</td>    
              <td><strong>$4,150.00</strong></td>   
            </tr>

            <tr> 
              <td> 
               <h3>Wedding Package CVF</h3>
               <p>Description of Wedding Package CVF will be here. <br>Description of Wedding Package CVF will be here.</p>

               </td>    
              <td>1</td>    
              <td>$4,150.00</td>    
              <td><strong>$4,150.00</strong></td>   
            </tr>

            <tr> 
              <td> 
               <h3>Wedding Package CVF</h3>
               <p>Description of Wedding Package CVF will be here. <br>Description of Wedding Package CVF will be here.</p>

               </td>    
              <td>1</td>    
              <td>$4,150.00</td>    
              <td><strong>$4,150.00</strong></td>   
            </tr>

            <tr> 
              <td> 
               <h3>Wedding Package CVF</h3>
               <p>Description of Wedding Package CVF will be here. <br>Description of Wedding Package CVF will be here.</p>

               </td>    
              <td>1</td>    
              <td>$4,150.00</td>    
              <td><strong>$4,150.00</strong></td>   
            </tr>


            <tr> 
              <td colspan="3"> 
                <p class="text-right">Subtotal: 
                  <br> Tax:</p> 

              </td>                   
              <td>
                <strong>$4,150.00</strong>
                <br><strong>$0.00</strong>
             </td>   
            </tr>

            <tr> 
              <td colspan="3"> <h3 class="text-right">Total</h3>  </td>                   
              <td><strong>$4,150.00</strong></td>   
            </tr>




          </tbody></table>  
        </div>  


        <!-- <h2>Additional Options</h2>

        <div class="table-responsive"> 
          <table class="table fixed_table"> 
            <tr> 
              <th>Please select any of the following options: </th>   
              <th class="w120">QUANTITY</th>    
              <th class="w120">PRICE</th>   
              <th class="w120">TOTAL</th>   
            </tr>

            <tr>
              <td> <p><input type="checkbox" name=""> Leather Cover "Parent's Album" - 10x12.5 </p>
                <br>This leather covered album includes a custom design, with thick pages, personalized
                embossed cover and color print in a neat box for safe keeping.
                <br><br>Average 20 page spreads (85 images)
                <br><br>Stylized for the best visual experience.
              </td>

              <td> <input type="number" name="qty" class="form-control"> </td>

              <td>$550.00</td>
               <td><strong>$550.00</strong></td>  
            </tr>
          </table>
        </div>   -->

      </div>    
    </div>


      <!--<d iv class="row">
      <div class="col-sm-4 pr0">
        <div class="c_sidebar">
          <a href="" class="conlogo"> <img src="<?php echo base_url('assets/dist/img/');?>contract_logo.jpg" class="img-responsive"> </a>
            <div class="c_box">
              <p>Photography By Levi Corp.
                 <br>334 Crown Street 
                 <br>Brooklyn, NY 11225
                 <br>Phone: <a href="tel:(718) 774 - 7777">  (718) 774 - 7777 </a>
                 <br>Fax: (718) 841 - 7400  
                 <br>Email: <a href="mailto:office@photobylevi.com"> office@photobylevi.com </a>
                 <br>Web: <a href="http://www.photobylevi.com"> www.photobylevi.com </a>
              </p>                
            </div>


            <div class="c_box">
                  <p>Invoice Nr. : 4491                  
                 <br>Invoice Date: 5/23/2019
                 <br>Event Date: 11/6/2019
                 <br>Event Name: Horowitz - Mermelst 
                 <br>Client Number: 1777
                 <br>Sales Rep: Levi             
              </p>                
            </div>

            <div class="c_box">
              <p>Bill To: 
                 <br>Mrs. Horowitz
                 <br>Cong. Erste Lutowiska Machzik 
Hadas         
                 <br>Mobile: <a href="tel:(917) 600-2982"> (917) 600-2982 </a>             
                 <br>Email: <a href="mailto:delatyn@gmail.com"> delatyn@gmail.com </a>             
                 <br>Email: <a href="mailto:lutowisker@gmail.com"> lutowisker@gmail.com </a>             
              </p>                
            </div>  

            <div class="c_box">
               <p>Payment History :</p>
               <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr> 

                   <tr>
                    <td>11/7/2019</td>
                    <td>H</td>
                    <td>$2,375.00</td>
                  </tr>

                   <tr>
                    <td>11/7/2019</td>
                    <td>Check# 1517 M</td>
                    <td>$3,375.00</td>
                  </tr>

                </table>
               </div>
            </div> 

            <div class="c_box noborder">
               <p>Payment Terms :</p>
               <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Time</th> 
                    <th>Amount</th>
                  </tr>
                  <tr>
                    <td>11/6/2019</td> 
                    <td>$4,563.50</td>
                  </tr>
                  <tr>
                    <td>Album Order</td> 
                    <td>$600.00</td>
                  </tr>
                  <tr>
                    <td>Overtime $150 @ Hour / Crew</td> 
                    <td></td>
                  </tr>
                  <tr>
                    <td>Contract Signing</td> 
                    <td>$1000.00</td>
                  </tr>

                </table>
               </div>
            </div>  


           
        </div>
      </div>

      <div class="col-sm-8 pl0">
        <div class="c_main">
          <h1>Invoice</h1>
          <h3>Invoice Detail</h3>

          <div class="table-responsive">
                <table class="table c_mytable">
                  <tr>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Total</th> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>Wedding Package CVF</td>                     
                    <td>$4,150.00</td>
                    <td>$4,150.00</td>
                  </tr>

                  <tr>
                    <td>6</td>
                    <td>Hours of Labor w/ 1 set of proofs</td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>Fush (No Border) Album 8x10 w/ 50 Images</td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>2</td>
                    <td>Fush (No Border) Album 5x7 w/ 24 Images</td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>11x14 Print</td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>2</td>
                    <td>8x10 Print</td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>Fully edited Video for Wedding Including 6 Hours
of Labor - 3 DVD Copies   </td>                     
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>2nd Photography Crew including 3 Hours of Labor</td>                     
                    <td>$4,150.00</td>
                    <td>$4,150.00</td>
                  </tr>

                  <tr>
                    <td>6.25</td>
                    <td>Additional Hours of Video</td>                     
                    <td>$150.00</td>
                    <td>$937.50</td>
                  </tr>

                   

                </table>
               </div>
  


               <div class="row">
                 <div class="col-sm-6 col-sm-offset-6">
                    <div class="c_details">
                    <p><span>Sub Total</span> <span>:</span> $5,737.00</p>
                    <p><span>Sales Tax Amount 8.875% </span> <span>:</span> $426.00</p>
                    <p><span>Invoice Total</span> <span>:</span> $6,163.50</p>
                    <p><span>Total Payments</span> <span>:</span> $5,750.00</p>
                    <p><span>Balance Due(This Invoice)</span> <span>:</span> $413.50</p>
                    <p><span>Balance Due(This Invoice)</span> <span>:</span> $426.00</p>
                  </div>

                 </div>
               </div>

                <h3>Notes</h3>
               <p class="c_bortb">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem 
                <br>Ipsum has been the industry's standard dummy.
               </p> 

        </div>
      </div>

      </div> -->
 
 <!-- ******************************* image pdf **************************************** -->
     <!--   <div class="img_wrap">
            <img src="<?php echo base_url('assets/dist/img/');?>invoice_pdf.png" alt="img" class="img-responsive" >
          </div>  --> 




            </div>

                <!-- /.box-header -->

          </div>

        </section>

        <!-- /.content -->

      </div>

      <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>

  <script type="text/javascript">

    function fnupdatesearch(columname,columnvalue)
     {
        //alert("columname--"+columname+" columnvalue--"+columnvalue);

        $.ajax({
            type: 'POST',
            url: '<?=site_url('fi_home/fnupdatesearchinfo')?>',
            data: {columname:columname,columnvalue:columnvalue},
            dataType: 'text',
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data) {

                if(data=="success")
                {
                  //$("#divfiltercust").load(location.href + " #divfiltercust");
                  $("#divfiltercust").load(location.href+" #divfiltercust>*","");
                  $('.fadeMe').hide();

                }else if(data=="error"){

                    $('.fadeMe').hide();
                }
            },
            error: function(xhr) { // if error occured
              // $('.fadeMe').hide();
            },
            complete: function() {
             // $('.fadeMe').hide();
             }

        });
     }

  </script>
