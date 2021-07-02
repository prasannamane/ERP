<!DOCTYPE html>
<html>  
  <head>    
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <title>ERP System | Administration</title>    
    <!-- Tell the browser to be responsive to screen width -->    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">    

    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/css/bootstrap.min.css">    
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/font-awesome/css/font-awesome.min.css">    
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>bower_components/Ionicons/css/ionicons.min.css">    
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.css">    
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/skin-blue.css">    
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles.css"> 
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/styles_new.css">    
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  </head>  

  <body class="hold-transition skin-blue sidebar-mini">      
    <div class="content-wrapper">      
      <section class="content-header">      
        <h1>Event Management </h1>      
        <ol class="breadcrumb">        
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>        
          <li><a href="#">Administration</a></li>        
          <li class="active">Tax </li>      
        </ol>    
      </section>   

      <section class="content">          <!-- TABLE: LATEST ORDERS -->          
        <div class="row">            
          <div class="col-md-12">  

            <div class="box box-info admin_sec titlen_search"> 
              <div class="box-header with-border">                  
                
                <div class="row">                    
                  <div class="col-sm-5 col-md-4">                      
                    <h3 class="uhead1"> Tax  </h3>                    
                  </div>                    
    
                  <div class="col-sm-7 col-md-8">                      
                    <div class="pull-right">                        
                      <ul class="list-inline topul">                          
                        <li><a href="#" class="uhead2"> Main Menu </a></li>                          
                        <li><a href="#" class="uhead2"> Options </a></li>                          
                        <li><button class="btn btn-default" onclick="print();" > <i class="fa fa-print"></i></button> </li>             
                      </ul>                                             
                    </div>                    
                  </div>                  
                </div>  

              </div>
            </div>

            <div class="box box-info firstblock_bg"> 
              <div class="box-body">                  
             	  <div class="table-responsive">                    
           	      <table class="table table-hover no-margin fixed_table mw1000">                      
             	      <thead>                        
                      <tr class="uppercse_block">                          
                        <th class="w90">Tax</th>                          
                        <th class=" ">County</th>                          
                        <th class=" ">City</th>                          
                        <th class=" ">State</th>                          
                        <th class="w60">Zip</th>                          
                        <th class="w90">Date Start</th>                          
                        <th class="w90">Date End</th>                          
                        <th class=" ">Reporting Code</th>                         
                        <th class="w50">Action</th>                         
                      </tr>                      
                    </thead>                      
                    <tbody id="tbl_body">                        
                                          
                    </tbody>                    
                  </table>                  
                </div>                  <!-- /.table-responsive -->                
              </div>                <!-- /.box-body -->              
      	    </div>

          </div>                                                
	      </div>        
	    </section>                        
    </div>      

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	  <script type="text/javascript">
      $(document).ready(function()
      { 
        // load data on page loading
        load_data();
        // -------------------------
        
        
        var cnt = 2
        $("body").on('click','.tr_clone_add', function(rrr) { 
            
            var ttax =  $(this).parents(".tr_clone").find(".ttax").val();
            var tcounty =  $(this).parents(".tr_clone").find(".tcounty").val();
            var tcity =  $(this).parents(".tr_clone").find(".tcity").val();
            var tstate =  $(this).parents(".tr_clone").find(".tstate").val();
            var tzip =  $(this).parents(".tr_clone").find(".tzip").val();
            var tsdate =  $(this).parents(".tr_clone").find(".tsdate").val();
            var tedate =  $(this).parents(".tr_clone").find(".tedate").val();
            var ttaxcode =  $(this).parents(".tr_clone").find(".ttaxcode").val();
            
            rrr.preventDefault();
            
            var tr    = $(this).closest('.tr_clone');
            var clone = tr.clone();
            
            
            clone.find(':text').val('');
            clone.find('.tr_clone_add').siblings('.tr_save_btn').remove();
            
            $(this).removeClass('btn-success tr_clone_add').addClass('btn-danger tr_clone_remove').html('<i class="fa fa-minus"></i>');
            tr.after(clone);
            cnt++;
            
            // add tax entry
            func_add_tax(ttax, tcounty, tcity, tstate, tzip, tsdate, tedate, ttaxcode);
            
            // load data
            load_data();
            
        });
      

        $(document).on('click', '.tr_clone_remove', function()
        {
            var tid =  $(this).parents(".tr_clone").find(".tr_clone_remove").attr("id");
            //alert("tid : "+tid);  
            
            var tr = $(this).closest('.tr_clone');
            
            $(this).closest('table').addClass("currenttable");
            var alltr = $(this).parents("table.currenttable").find('tr');
            var len = alltr.length - 1;
            var clone = tr.remove();
            
            if(cnt>0)
            {
              cnt--;
            }
            
            // delete tax entry
            func_delete_tax(tid);
            
           
        
        });
      
      });
    </script>
    
    <script>
        function load_data()
        {
            //alert("load");
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Fi_tax/load_data')?>',
                // data: {ttax:ttax,tcounty:tcounty,tcity:tcity,tstate:tstate,tzip:tzip,tsdate:tsdate,tedate:tedate,ttaxcode:ttaxcode},
                dataType: 'text',
            
                success: function(data) {
                    //alert(data);
                   
                    $("#tbl_body").html(data);
                }
    
            });
        }
        
        function func_add_tax(ttax, tcounty, tcity, tstate, tzip, tsdate, tedate, ttaxcode)
        {
            if(tsdate!="")
            {
                var arr = tsdate.split("/");
                tsdate = arr[2]+"-"+arr[0]+"-"+arr[1];
            }
            
            if(tedate!="")
            {
                var arr = tedate.split("/");
                tedate = arr[2]+"-"+arr[0]+"-"+arr[1];
            }
            
           // alert("aaaa");
            $.ajax({
                type: 'POST',
                url: '<?=site_url('Fi_tax/add_tax')?>',
                data: {ttax:ttax,tcounty:tcounty,tcity:tcity,tstate:tstate,tzip:tzip,tsdate:tsdate,tedate:tedate,ttaxcode:ttaxcode},
                dataType: 'text',
                success: function(data) {
                    //alert(data);
                }
    
            });
        }
        
        function func_delete_tax(tid)
        {
            //alert("22222");
            if(tid!="undefined")
            {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('Fi_tax/delete_tax')?>',
                    data: {tid:tid},
                    dataType: 'text',
                    success: function(data) {
                       //alert(data);
                    }
                    
        
                });
            }
        }
        
        function update_field(tbl_nm,set_col_nm,set_col_val,whr_col_nm,whr_col_val,field_type, old_val) //  for date field_type="date"
        {
           // alert(tbl_nm+":"+set_col_nm+":"+set_col_val+":"+whr_col_nm+":"+whr_col_val+":"+field_type+":"+old_val);
            if(set_col_val!=old_val)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?=site_url('fi_home/update_field')?>',
                    data: {tbl_nm:tbl_nm,set_col_nm:set_col_nm,set_col_val:set_col_val,whr_col_nm:whr_col_nm,whr_col_val:whr_col_val,field_type:field_type},
                    dataType: 'text',
                    success: function(data) {
                        //alert("data--"+data);
                    }
                });
            }
        }
    </script>
    
    <script>
    $(document).ready(function(){
       $("body").on("keydown", ".common_dt", function(event)
       {
    
           var key = event.keyCode;
           var cls_nm =  $(this).attr("class");
           if(cls_nm.indexOf("tsdate") !== -1)
           {
               var temp_edate =  $(this).parents(".tr_clone").find(".tsdate");
           }
           else
           {
               var temp_edate =  $(this).parents(".tr_clone").find(".tedate");
           }
           
    
           if(key=="107" || key=="187")
           {
               //alert("date+");
               var dtpls;
               if(temp_edate.val()=="")
               {
                   dtpls= new Date();
               }
               else
               {
                   dtpls= new Date(temp_edate.val());
               }
    
               dtpls.setDate( dtpls.getDate() + 1 );
               var mm = dtpls.getMonth() + 1;
               if(mm <10)
               {
                   mm = "0"+mm;
               }
    
               var dd =  dtpls.getDate();
               if(dd <10)
               {
                    dd = "0"+dd;
               }
    
               var yyyy =  dtpls.getFullYear();
               var today = mm + '/' + dd + '/' +  yyyy;
              
               temp_edate.val(today);
               event.preventDefault();
           }
           else if(key=="109" || key=="189")
           {
               //alert("date-");
               var dtmns;
               if(temp_edate.val()=="")
               {
                   dtmns= new Date();
               }else{
                   dtmns= new Date(temp_edate.val());
               }
    
               dtmns.setDate( dtmns.getDate() - 1 );
               var mm = dtmns.getMonth() + 1;
               if(mm <10)
               {
                   mm = "0"+mm;
               }
    
               var dd =  dtmns.getDate();
               if(dd <10)
               {
                   dd = "0"+dd;
               }
    
               var yyyy =  dtmns.getFullYear();
               var today = mm + '/' + dd + '/' +  yyyy;
              
               temp_edate.val(today);
               event.preventDefault();
    
           }
           else if(key=="68")
           {
               today = '<?php echo date("m/d/Y"); ?>';
               temp_edate.val(today);
               event.preventDefault();
           }
           else if(key=="8" || key=="46")
           {
    
           }
           else
           {
               var str = temp_edate.val();
    
    
               if(str.length >= 6 &&  !(str.includes("/")))
               {
                   var mm = str.substring(0,2);
                   var dd = str.substring(2).substring(0,2);
                   var yy = str.substring(2).substring(2).substring(0,2);
                   yy = "20"+yy;
    
                   var month = 12;
                   var day   = 31;
    
                   if(mm=="02")
                   {
                       if(yy % 4 === 0 )
                       {
                           day = 29;
                       }
                       else
                       {
                           day = 28;
                       }
                   }
    
                   if(mm <= month && dd <= day)
                   {
                       var today = mm + '/' + dd + '/' + yy ;
                       temp_edate.val(today);
    
                   }
                   else
                   {
                       alert("Wrong date.");
                       temp_edate.val("");
                       event.preventDefault();
                   }
               }
           }
    
       });
    
    });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function()
        {
          $(".str").keypress(function(event)
          {
            var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122)) && (inputValue != 32 && inputValue != 0)) 
            { 
                event.preventDefault(); 
            }
          });

          $(".str1").keypress(function(event)
          {
            var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!((inputValue >= 65 && inputValue <= 90) || (inputValue >= 97 && inputValue <= 122) || (inputValue >= 48 && inputValue <= 57)) && (inputValue != 32 && inputValue != 0) && inputValue != 44 && inputValue != 46) 
            { 
                event.preventDefault(); 
            }
          });

          $(".num").keypress(function (e) 
          {
            if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
            {
                return false;
            }
          });
          
          
      });
      </script>

	</body>
</html>
