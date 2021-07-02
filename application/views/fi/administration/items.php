<!DOCTYPE html>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP System | Administration</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">
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

        <section class="content">

          <!-- TABLE: LATEST ORDERS -->

          <div class="row">

            <div class="col-md-12">

              <div class="box box-info">

                <div class="box-header with-border">

                  <div class="row">

                    <div class="col-sm-5 col-md-4">

                      <h3 class="uhead1">

                        Add Items

                      </h3>

                    </div>

                    <div class="col-sm-7 col-md-8">

                      <div class="pull-right">

                        <ul class="list-inline topul">

                         

                          <li><a href="#" class="uhead2"> Options </a></li>

                          <li><button class="btn btn-default" > <i class="fa fa-print"></i></button> </li>

                        </ul>

                       

                      </div>

                    </div>

                  </div>

                </div>
              </div>

              <div class="box box-info">
                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table   table-hover no-margin">

                          <form action="<?=site_url('fi_home/additemadmin')?>" method="POST" name="aform" id="aform">
                      <thead>
                        <tr class="uppercse_block">

                          <th>#</th>

                          <th>Item Name</th>

                          <th>Description</th>

                          <th>Price</th>

                          <th>Taxable</th>

                          <th>Pickup Required</th>
                           <th>Action</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr class="tr_clone price">

                          <td>1</td>

                          <td>
                            <input type="text" class="form-control" name="item_nane" id="id" required />
                          </td>

                          <td> <input type="text" class="form-control" name="item_desc" id="id" required/>   </td>

                          <td> <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                  <input type="number" min="0" class="form-control zeros" name="item_price" id="zeroid" required/>
                                </div>
                              </div>
                          </td>

                          <td> <div class="checkbox">
                                <label><input type="checkbox" name="taxcheck"></label>
                              </div> </td>

                          <td><div class="checkbox">
                                <label><input type="checkbox" name="pickcheck"></label>
                              </div> </td>

                             <td>
                             
                                <button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                              
                             </td>

                        </tr>

                      </tbody>
                      </form>
                    </table>
                  </div>


                </div>

              </div>

              <div class="box box-info">

              
                <div class="box-header">
                <h3 class="uhead2">View Items</h3>
                </div>
                
                <div class="box-body">
                    
                  <div class="form-horizontal custsearch">
                     <form method="post" name="frmsearchcust" id="frmsearchcust" >
                     <div class="row">
                       <div class="col-sm-2">
                         <input class="form-control" type="text" id="itemname" name="itemname" placeholder="Item name">
                       </div>
                       <div class="col-sm-2">
                         <input class="form-control" type="text" id="itemdesc" name="itemdesc" placeholder="Description">

                       </div>

                       <div class="col-sm-2">
                      
                         <input class="form-control contact_no" type="text" id="itemprice" name="itemprice" placeholder="Price">

                       </div>
  

                       <div class="col-sm-2">

                          <input class="btn btn-xs btn-primary btn-flat" type="button" name="submit" id="submit" value="Search" onclick="fnsearchcustomer()">
                         

                       </div>

                     </div>

                     </form>

                   </div>
                    
                    
                    

                  <div class="table-responsive">

                    <table class="table   table-hover no-margin">

                      <thead>

                          <tr>

                          <th>#</th>

                          <th>Item Name</th>

                          <th>Description</th>

                          <th>Price</th>

                          <th>Taxable</th>

                          <th>Pickup Required</th>
                           <th>Action</th>

                        </tr>

                      </thead>

                      <tbody id="divfiltercust">

                        <tr class="tr_clone price1">
                          <?php
                          $i=1;
                          foreach ($item as $key) { ?>
                            <form action="<?=site_url('fi_home/edititemadmin')?>" method="POST" name="eeform" id="eeform">
                            <td><?=$i++; ?></td>

                            <td>
                              <input type="hidden" value="<?php print_r($key['item_id']);?>" name="item_id">
                              <input type="text" class="form-control" name="edit_item_names" value="<?php print_r($key['item_name']); ?>" id="id"/>
                            </td>

                            <td> <input type="text" class="form-control" name="edit_item_desc" value="<?php print_r($key['item_desc']); ?>" id="id"/>   </td>

                            <td> <div class="form-group">
                                  <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                    <input type="number" class="form-control zeros1" name="edit_item_price" value="<?php print_r($key['item_price']); ?>" id="id"/>  </td>
                                  </div>
                                </div>
                            <td> <div class="checkbox">
                              <?php
                              if ($key['iteam_texable']==1) {  ?>
                                <label><input type="checkbox" name="edit_taxcheck" checked></label>
                            <?php  }
                            else { ?>
                              <label><input type="checkbox" name="edit_taxcheck"></label>
                          <?php  }
                               ?>

                                </div> </td>

                            <td><div class="checkbox">
                              <?php
                              if ($key['item_pickup_req']==1) {  ?>
                                <label><input type="checkbox" name="edit_item_pickupcheck" checked></label>
                            <?php  }
                            else { ?>
                              <label><input type="checkbox" name="edit_item_pickupcheck"></label>
                          <?php  }
                               ?>
                                </div> </td>

                               <td>
                                
                                  <button class="btn btn-xs btn-success tr_clone_save 1" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                
                                  <a href="<?=site_url('fi_home/delete_item/'.$key['item_id'])?>" onclick="return confirm('Are you sure want to Delete..??')" class ="btn btn-xs btn-warning tr_clone_edit"><i class="fa fa-trash"></i></a>
                               </td>


                               </form>
                        </tr>

                      <?php   }

                    ?>
                      </tbody>

                    </table>
                  </div>

                  <!-- /.table-responsive -->

                </div>

              </div>

            </div>

                <!-- /.box-header -->

          </div>
        </div>

        </section>

        <!-- /.content -->

      </div>


      <div  class="fadeMe" > <div id="loader" class="loader"></div> </div>




   <script type="text/javascript">
  //ERP tr added
  	var cnt = 2

    $(document).on('click', '.tr_clone_add', function(rrr) {

	rrr.preventDefault();

    var $tr    = $(this).closest('.tr_clone');

    var $clone = $tr.clone();

    $clone.find(':text').val('');
	 $clone.find('td:first-child').text(cnt);

    $clone.find('.tr_clone_add').siblings('.tr_save_btn').remove()

    //$clone.find('.tr_clone_add').removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
	$(this).removeClass('btn-primary tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');

   //$tr.after($clone);

	$tr.parent("tbody").append($clone);

	cnt++;

});





$(document).on('click', '.tr_clone_remove', function(){

     // Your Code

    var $tr    = $(this).closest('.tr_clone');

	$(this).closest('table').addClass("currenttable");
	var alltr = $(this).parents("table.currenttable").find('tr');
	var len = alltr.length - 1;

	//$(alltr).each(function(){ $(this).find("td:first-child").text(i)});


	//alert(len);

    var $clone = $tr.remove();
	if(cnt>0)
	{
	cnt--;


	}

});



  </script>
  <script>
  $(document).ready(function(){
  $(".price").on("change",".zeros", function(){
    var num = $(this).val();
    var n = Number(num).toFixed(2);
    // alert(n);

    document.getElementById('zeroid').value = n;
    });
  });
  </script>
  <script>
  // $(document).ready(function(){
  // $("tr.price1").on("click",".zeros1", function(){
  //   var num1 = $(this).val();
  //   var n1 = Number(num1).toFixed(2);
  //   alert(n1);
  //   // document.getElementById('zeroid').innerHTML = n;
  //   });
  // });
  </script>


<script type="text/javascript">

function fnsearchcustomer()
  {

    var itemname=$('#itemname').val();
    var itemdesc=$('#itemdesc').val();
    var itemprice=$('#itemprice').val();
  


   if(itemname!="" || itemdesc!="" || itemprice!="")
   {

    var searchcust=$('#frmsearchcust').serialize();
    //alert("searchcust--"+searchcust);

     $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_items')?>",
            data: searchcust,
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
             // alert(data);
                if(data!="")
                {
                  // console.log(data);

                 //$('#tab_data tbody').html(data);
                 $('#divfiltercust').html(data);
                 $('.fadeMe').hide();


               }else{
                   //$('#tab_data tbody').html(data);
                   $('#divfiltercust').html(data);
                    $('.fadeMe').hide();
               }
            }
        });

     }else{

         //alert("Please enter atleast one field to search record..!");

          $.ajax({
            type: "POST",
            url: "<?=site_url('fi_home/search_allitems')?>",
            dataType:"html",
            beforeSend: function() {
                // setting a timeout
                $('.fadeMe').show();

            },
            success: function(data)
            {
              //alert(data);
              if(data!="")
               {
                 
                   $('#divfiltercust').html(data);
                   $('.fadeMe').hide();


                }else{
                   
                   $('#divfiltercust').html(data);
                   $('.fadeMe').hide();
               }
            }
         });



     }

  }
</script>
