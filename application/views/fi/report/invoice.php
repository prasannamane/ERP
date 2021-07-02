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


.htmlhide{ display: none; }



  .header_inv p {
    font-size: 12px;
    margin: 0 0 5px 10px;
    line-height: 1.2;
    text-align: left;
}

.heading_sign { font-size: 15px; }

@media print {

   .hidebaba{
    display: none;
  }
  
.htmlhide{
    display:block;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}

.header_inv .table>tbody>tr>td {
    border: none;
    text-align: left;
}
 

</style>
</head>

  <body class="hold-transition skin-blue sidebar-mini">

 

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



<div class="header_inv htmlhide">
 <table class="table fixed_table"> 
  <tr>
    <td>     <div class="col-sm-6"> <a href="#" class="logo_inv" style="background: #000;"><img src="<?php echo base_url('assets/');?>/logo2.png" alt="logo" class="img-responsive" style="background: #000;"></a>
          <p> <span> QUOTE</span> 483527  </p>
          <p> <span> ISSUED</span> February 14, 2016  </p>
          <p> <span> VALID UNTIL</span> February 21, 2016 </p>
          </div> 
    </td>
    <td>          <div class="pull-right"> 
            <p> 
              <span> FROM</span>  
              <span>Ell Tee Photo LLC.
              <br>882 BROOKLYN EVE
              <br>Brooklyn, NY 11203</span>
            </p>  

            <p> <span> To</span>  Mrs Fox</p>
           </div>  </td>

  </tr>
  </table>
</div>
<!--              <div class="header_inv ">
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
    </div> -->

      <div class="box box-info firstblock_bg ">
          <table class="table fixed_table"> 
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Action</th>



            </tr> <?php  
            $all_packs = $this->db->query("SELECT `package_id`, `package_name`, `package_desc`, `package_price`, `package_taxable`, `package_create_date` FROM `admin_package` WHERE 1");

            foreach($all_packs->result() as $items){

            ?>
            <tr>
              <td><?=$items->package_name?></td>
              <td><?=$items->package_price?></td>
              <td><input type="checkbox" onchange="handleChange(this, '<?=$items->package_id?>')"></td>
            </tr>
            <?php


          } ?>


        </table>
       </div>   













        



          <div class="main_inv ">
            <div class="box box-info secondblock_bg "> 
              <div class="table-responsive"> 
                <table class="table fixed_table"> 
                  <tbody><tr> 
                     <th class="w120">PRODUCT/ SERVICE</th>    
                    <th class="w120">QUANTITY</th>    
                    <th class="w120">PRICE</th>   
                  
                    <th class="w120">TOTAL</th>   
                  </tr>
                  
                  


               </tbody>
<tbody  class="append_me"></tbody>

<tbody > <tr>
             <td></td>
              <td>Total Quantity<input type="number" value="" class="final_qty" readonly></td>
              <td></td>
               
                <td>Total Amount<input type="number" value="" class="final_total" readonly></td>
           
            </tr></tbody>

             </table>  
             </div>  

             <button class="btn btn-default hidebaba" onclick="print();"> Print Here</button>
             <h4 class="heading_sign">Customer's Signature : <span></span></h4>

           </div>    
         </div>
       </div>
     </div>
   </section>

<script type="text/javascript">
  
  function handleChange(checkbox, id) {

   // console.log(checkbox);

    if(checkbox.checked == true){

     //  console.log(checkbox);
        //document.getElementById("submit").removeAttribute("disabled");

         $.ajax({
            type: 'POST',
            url: '<?=site_url('Fi_report/save_data_invoce')?>',
            data: {id:id},
            dataType: 'text',
          
            success: function(data) {

              console.log(id);

               $(".append_me").append(data);


                    var input = $('.count-me');
  var row = input.closest('tr');
  var sum = 0;

  row.find(".count-me").each(function() {
    sum += parseFloat(this.value) || 0;
  });



     var input2 = $('.count-here');
  var row2 = input2.closest('tr');
  var sum2 = 0;

  row2.find(".count-here").each(function() {
    sum2 += parseFloat(this.value) || 0;
  });


$(".final_qty").val(sum);
$(".final_total").val(sum2);
            }
            

        });
    }else{
       $("."+id).remove();

            var input = $('.count-me');
  var row = input.closest('tr');
  var sum = 0;

  row.find(".count-me").each(function() {
    sum += parseFloat(this.value) || 0;
  });



     var input2 = $('.count-here');
  var row2 = input2.closest('tr');
  var sum2 = 0;

  row2.find(".count-here").each(function() {
    sum2 += parseFloat(this.value) || 0;
  });


$(".final_qty").val(sum);
$(".final_total").val(sum2);
   }
}
</script>


<script type="text/javascript">
  
  function quty_change(id) { 

    console.log(id);

    var qty = $(".qty"+id).val();
    var price = $(".price"+id).val(); 
    $(".total"+id).val(qty*price);

     var input = $('.count-me');
  var row = input.closest('tr');
  var sum = 0;

  row.find(".count-me").each(function() {
    sum += parseFloat(this.value) || 0;
  });



     var input2 = $('.count-here');
  var row2 = input2.closest('tr');
  var sum2 = 0;

  row2.find(".count-here").each(function() {
    sum2 += parseFloat(this.value) || 0;
  });

$(".final_qty").val(sum);
$(".final_total").val(sum2);


}
</script>