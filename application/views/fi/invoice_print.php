<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <!--<title>ERP System | Administration</title>-->
        <!-- Tell the browser to be responsive to screen width -->
        <!--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
       <!-- <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
        
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">-->
         
        <!-- <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css"> -->
         
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">-->
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">-->
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">-->
        <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/cotract_invoice_pdf.css"> 
        
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

        <style type="text/css">
            .pdfpage_wrap{ width: 99%; }
            .c_sidebar { padding: 21px 20px;}
            .c_box {  padding: 10px 0; }
            .c_box p { line-height: 1.2; }
            .c_box p a { color: #000; font-weight: 400; }
            .mytable tr{ border-top:1px solid #000 !important; }
            .mytable tr td, .mytable tr th{ padding: 2px; font-size: 12px; border-top:1px solid #000;}
            .mytable tr th{ font-weight: bold; }
            .main h1{ font-size: 24px; text-align: right; font-weight: 600; text-transform: uppercase; margin: 0 0 40px; }         
            .main h3 { font-size: 18px; font-weight: 700; margin: 0 0 15px 10px; }
            a{ text-decoration: none; }

        </style>
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="rrow" style="width: 100%; display: block; position: relative;">
            <div class="sidebar" style="display: inline-block; vertical-align: top; width: 30%; background: #ccc; padding: 12px 12px;">
                    <a href="" class="conlogo"> <img src="<?php echo base_url('assets/dist/img/');?>contract_logo.jpg" class="img-responsive" style="width: 100%; display: inline-block; width: 150px ;"> </a>                    
                    <div class="c_box">
                        <p>
                            Photography By Levi Corp.
                            <br>334 Crown Street 
                            <br>Brooklyn, NY 11225
                            <br>Phone: <a href="tel:(718) 774 - 7777">  (718) 774 - 7777 </a>
                            <br>Fax: (718) 841 - 7400  
                            <br>Email: <a href="mailto:office@photobylevi.com"> office@photobylevi.com </a>
                            <br>Web: <a href="http://www.photobylevi.com"> www.photobylevi.com </a>
                        </p>                
                    </div>
            </div>
            <div class="main" style="display: inline-block; vertical-align: top; width: 60%;">
                <h1 >Invoice</h1>
                                        <h3>Invoice Detail</h3>
                                
                                        <div class="table-responsive" style="width: 100%; ">
                                            <table class="mytable" style="width: 110%; table-layout: fixed; border-collapse: collapse; border: none;" cellspacing="0" cellpadding="1">
                                                <tr style="border:1px solid #000 ; "> 
                                                  <th style="width: 12%; font-weight: 700; font-size: 14px; text-stroke:0.5px #000;"><b>Qty</b></th>
                                                  <th style="width: 40%; font-weight: 700; font-size: 14px; text-stroke:0.5px #000;"><b>Description</b></th> 
                                                  <th style="width: 24%; font-weight: 700; font-size: 14px; text-stroke:0.5px #000; "><b>Price</b></th> 
                                                  <th style="width: 24%; font-weight: 700; font-size: 14px; text-stroke:0.5px #000; "><b>Total</b></th>
                                                </tr>
                                               <tr style="border-top:1px solid #000 !important; "> <td>1</td> <td>Wedding Package CVF</td> <td>$4,150.00</td> <td>$4,150.00</td>
                                                </tr>
                                               <tr style="border:1px solid #000 !important; width: 100% !important;  "> <td>6</td> <td>Hours of Labor w/ 1 set of proofs</td> <td> </td> <td> </td></tr>
                               <tr> <td>1</td> <td>Fush (No Border) Album 8x10 w/ 50 Images</td> <td> </td> <td> </td></tr>
                                               <tr> <td>2</td> <td>Fush (No Border) Album 5x7 w/ 24 Images</td> <td> </td> <td> </td></tr>
                               <tr> <td>1</td> <td>11x14 Print</td> <td> </td> <td> </td></tr>
                               <tr> <td>2</td> <td>8x10 Print</td> <td> </td> <td> </td></tr>
                                               <tr> <td>1</td> <td>Fully edited Video for Wedding Including 6 Hours of Labor - 3 DVD Copies   </td> <td> </td> <td> </td></tr>
                               <tr> <td>1</td> <td>2nd Photography Crew including 3 Hours of Labor</td> <td>$4,150.00</td> <td>$4,150.00</td>
                                                </tr>
                               <tr> <td>6.25</td> <td>Additional Hours of Video</td> <td>$150.00</td> <td>$937.50</td>
                                                </tr>
                                            </table>
                                        </div>
            </div>
        </div>


        <div style="clear: both; display: block;"></div>

        <div>
            <section class="content search_options">               
    
                        <div class="pdfpage_wrap">
                            <div class="row" style="width:100% !important; float:left !important; display: block !important;">
                                 
                                <div class="ccol-sm-4 pr0" style="position: relative !important; width: 30% !important; float:left !important;  display:inline-block !important; ">
                                    <div class="c_sidebar">
                                        <a href="" class="conlogo"> 
                                            <img src="<?php echo base_url('assets/dist/img/');?>contract_logo.jpg" class="img-responsive" style="width: 100%; display: inline-block; width: 150px ;"> 
                                        </a>
                                        
                                        <div class="c_box">
                                            <p>
                                                Photography By Levi Corp.
                                                <br>334 Crown Street 
                                                <br>Brooklyn, NY 11225
                                                <br>Phone: <a href="tel:(718) 774 - 7777">  (718) 774 - 7777 </a>
                                                <br>Fax: (718) 841 - 7400  
                                                <br>Email: <a href="mailto:office@photobylevi.com"> office@photobylevi.com </a>
                                                <br>Web: <a href="http://www.photobylevi.com"> www.photobylevi.com </a>
                                            </p>                
                                        </div>


                                        <div class="c_box">
                                            <p>
                                                Invoice Nr. : 4491                  
                                                <br>Invoice Date: 5/23/2019
                                                <br>Event Date: 11/6/2019
                                                <br>Event Name: Horowitz - Mermelst 
                                                <br>Client Number: 1777
                                                <br>Sales Rep: Levi             
                                            </p>                
                                        </div>
                                        
                                        <div class="c_box">
                                            <p>
                                               Bill To: 
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
                                            <div class="table-responsive" style="overflow: hidden;">
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
                                            <div class="table-responsive" style="overflow: hidden;">
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

                                <div class="ccol-sm-8 pl0" style="position: relative !important; width: 60% !important;float:left !important; display: inline-block !important; ">
                                    <div class="c_main">
                                        <h1>Invoice</h1>
                                        <h3>Invoice Detail</h3>
                                
                                        <div class="table-responsive" style="overflow: hidden;">
                                            <table class="table c_mytable" style="width: 60%">
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
                                </div> </div>
                            </div>
                        </div>

               
 
            </section>
        </div>

    </body>
</html>
