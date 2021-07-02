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
                      <h3 class="uhead1">Contract </h3>
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
          <div class="col-sm-6"> <a href="#" class="logo_inv"><img src="http://tech599.com/tech599.com/johnsum/erp_new/assets/dist/img//logo.png" alt="logo" class="img-responsive"></a>
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



        <p class="c_desc text-justify">
                Contract will only be deemed valid when returned with the required deposit, within 5 days of the date below. In the 
                event of a postponement or cancellation of this contract, the deposits will be retained as liquidated damages. The 
                Studio reserves the right to assign any sub-contractor to cover the affair. Photography By Levi Corp. will be providing 
                all photo &amp; video services exclusively. Violating this contract will be subject to a penalty of up to $1000. The 
                photographer may insist to remove anyone with photo/video equipment, from the areas he is operating. The studio 
                assumes no responsibility for any shots ruined by any outside interference from these people. Album selection must 
                be returned within 90 days of picking up the proofs or CD. Order placed later are subject to a surcharge and to 
                prevailing prices at the time the order is placed. The studio offers shipping for a fee, Otherwise, all order are to be 
                picked up from the Studio. The studio takes utmost care with respect to the exposure, developing and delivery of 
                photographs or videos. However, in the event we don't comply with the terms of this agreement, due to any act beyond 
                our control, our responsibility will be limited to 35% of the fees charged for that specific service. The Studio is not 
                responsible for orders left after 90 days from the completion of orders. The undersigned agrees that in the event that 
                certain photographs are missing, that the liability of the Studio will be a pro rated amount of consideration paid to this 
                contract. All originals, photo or video remain the sole property of the studio. The studio does not release any original
                photographs or video footage. Video corrections - for errors only, must be submitted within 30 days of receipt of video. 
                The studio reserves the right to use reproductions for display, publication and/ or other purposes. Copyright: It is 
                illegal to reproduce/copy photographs or video footage elsewhere without the studio's permission. Partial payments 
                do not entitle the customer to part of the order, even if payments were supposed to be split between parties. This is 
                the only agreement between the studio and the client and cannot be changed verbally or otherwise unless agreed to 
                in writing by all parties. Copy of this contract will be valid for all legal purposes.
               </p>


               <h4 class="heading_sign">Customer's Signature : <span></span></h4>
 
               <div class="clearfix"></div>
               
      </div>    
    </div>






















      <!--<div class="row">
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
              <p>Photo & Video Contract                 
                 <br>Contract No: 4491
                 <br>Invoice Date: 12/3/2019
                 <br>Client Number: 1855
                 <br>Representative: Levi
                 <br>Event Date: 1/8/2020                
              </p>                
            </div>

            <div class="c_box">
              <p>Bill To: 
                 <br>Mrs. Ellen Pollack             
                 <br>Email: <a href="mailto:Espollack@gmail.com"> Espollack@gmail.com </a>             
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
                    <td>1/8/2020</td> 
                    <td>$4,388.13</td>
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
          <h1>Contract</h1>
          <h3>Crews</h3>

          <div class="table-responsive">
                <table class="table c_mytable">
                  <tr>
                    <th>Type</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Ended</th>
                    <th><span class="w100">Overtime Rate</span></th>
                    <th>Location</th>
                  </tr>

                  <tr>
                    <td>Photographer Liberaw, Levi</td>
                    <td>Wed 1/8/2020  <br>12:00 A</td>
                    <td>Check  w/ Customer</td>
                    <td>1/8/2020  <br>12:00 A</td>
                    <td>$150.00/Hr</td>
                    <td>Ateres Charna</td>
                  </tr>

                  <tr>
                    <td>Videographer</td>
                    <td>Wed 1/8/2020  <br>12:00 A</td>
                    <td>Check  w/ Customer</td>
                    <td>1/8/2020  <br>12:00 A</td>
                    <td>$150.00/Hr</td>
                    <td>Ateres Charna</td>
                  </tr>

                  <tr>
                    <td>Photographer </td>
                    <td>Wed 1/8/2020  <br>12:00 A</td>
                    <td>Check  w/ Customer</td>
                    <td>1/8/2020  <br>12:00 A</td>
                    <td>$150.00/Hr</td>
                    <td>Ateres Charna</td>
                  </tr>

                  <tr>
                    <td>Videographer</td>
                    <td>Wed 1/8/2020  <br>12:00 A</td>
                    <td>Check  w/ Customer</td>
                    <td>1/8/2020  <br>12:00 A</td>
                    <td>$150.00/Hr</td>
                    <td>Ateres Charna</td>
                  </tr>

                </table>
               </div>


               <h3>Notes</h3>

               <p class="c_bortb">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem 
                <br>Ipsum has been the industry's standard dummy.
               </p>



              <h3>Contract Details</h3>

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
                    <td>Wedding Deluxe Package B</td>
                    <td>$5,500.00</td>
                    <td>$5,500.00</td> 
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
                    <td>11X14 Print</td>
                    <td> </td>
                    <td> </td> 
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>8X10 Print</td>
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>Fully edited Video for Wedding Including 6 Hours of Labor - 3 DVD Copies</td>
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>2nd Photography Crew including 3 Hours of Labor</td>
                    <td> </td>
                    <td> </td> 
                  </tr>

                  <tr>
                    <td>1</td>
                    <td>2nd Video Crew including up to 3 Hrs. of Labor</td>
                    <td> </td>
                    <td> </td> 
                  </tr>

                 

                </table>
               </div>



               <div class="row">
                 <div class="col-sm-6 col-sm-offset-6">
                    <div class="c_details">
                    <p><span>Sub Total</span> <span>:</span> $5,500.00</p>
                    <p><span>Sales Tax Amount 8.875% </span> <span>:</span> $488.13</p>
                    <p><span>Invoice Total</span> <span>:</span> $5,988.13</p>
                    <p><span>Total Payments</span> <span>:</span> $0.00</p>
                    <p><span>Balance Due(This Invoice)</span> <span>:</span> $5,988.13</p>
                  </div>

                 </div>
               </div>

               <p class="c_desc">
                Contract will only be deemed valid when returned with the required deposit, within 5 days of the date below. In the 
                event of a postponement or cancellation of this contract, the deposits will be retained as liquidated damages. The 
                Studio reserves the right to assign any sub-contractor to cover the affair. Photography By Levi Corp. will be providing 
                all photo & video services exclusively. Violating this contract will be subject to a penalty of up to $1000. The 
                photographer may insist to remove anyone with photo/video equipment, from the areas he is operating. The studio 
                assumes no responsibility for any shots ruined by any outside interference from these people. Album selection must 
                be returned within 90 days of picking up the proofs or CD. Order placed later are subject to a surcharge and to 
                prevailing prices at the time the order is placed. The studio offers shipping for a fee, Otherwise, all order are to be 
                picked up from the Studio. The studio takes utmost care with respect to the exposure, developing and delivery of 
                photographs or videos. However, in the event we don't comply with the terms of this agreement, due to any act beyond 
                our control, our responsibility will be limited to 35% of the fees charged for that specific service. The Studio is not 
                responsible for orders left after 90 days from the completion of orders. The undersigned agrees that in the event that 
                certain photographs are missing, that the liability of the Studio will be a pro rated amount of consideration paid to this 
                contract. All originals, photo or video remain the sole property of the studio. The studio does not release any original
                photographs or video footage. Video corrections - for errors only, must be submitted within 30 days of receipt of video. 
                The studio reserves the right to use reproductions for display, publication and/ or other purposes. Copyright: It is 
                illegal to reproduce/copy photographs or video footage elsewhere without the studio's permission. Partial payments 
                do not entitle the customer to part of the order, even if payments were supposed to be split between parties. This is 
                the only agreement between the studio and the client and cannot be changed verbally or otherwise unless agreed to 
                in writing by all parties. Copy of this contract will be valid for all legal purposes.
               </p>

               <h4>Customer's Signature : <span></span></h4>



        </div>
      </div>

      </div> -->
 





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
