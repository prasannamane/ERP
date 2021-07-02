<!-- Main Footer -->
<footer class="main-footer">
	<!-- To the right -->
	<div class="pull-right hidden-xs">
		<!-- Anything you want -->
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; 2016 <a href="#">ERP System </a></strong> All rights reserved.
</footer>
</div>

<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/');?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
var path = window.location;
var pathElements = path.toString().split("/");
if(pathElements[pathElements.length-1] == "")
{
  var lastFolder = pathElements[pathElements.length - 2];
}
else
{
  var lastFolder = pathElements[pathElements.length - 1];
//alert(lastFolder);
}

if(window.location.href.includes('all_upcoming_event/0') || window.location.href.includes('all_upcoming_task/0') || window.location.href.includes('view_todo/0')){

}
else{
  if(  lastFolder != "fi_home"){
 $(".sidebar").find('a[href *="/'+lastFolder+'"]').parents(".treeview-menu").css({"display":"block"});

 $(".sidebar").find('a[href *="/'+lastFolder+'"]').parents(".treeview").addClass("menu-open");

 $(".sidebar").find('a[href *="/'+lastFolder+'"]').addClass('sub-active');
 //var theColorIs = $('a').css("backgroundColor");
 //alert(theColorIs);
 //$("#uppertab .box").css({"background":})

 //alert(lastFolder);
}

}



</script>



<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/');?>dist/js/adminlte.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('body').on('keydown','#q',function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
   if(keycode == 13)
    {
      //alert('You pressed a "enter" key in somewhere');

          var geturisegmnt= '<?php echo $this->uri->segment(2);?>';
          //alert("geturisegmnt--"+geturisegmnt);
          if(geturisegmnt=="cust_search")
          {//alert("m in srch page..!");
              fnsearchcustomer_mainserach();

          }else{//alert("m not in srch page..!");

               var srchstring= $('#q').val();
               //alert("srchstring--"+srchstring);
               localStorage.setItem("srchstring", srchstring);

             window.location.href="<?=base_url('fi_home/cust_search');?>";
             //fnheadrmainserach(srchstring);
          }

          event.preventDefault();
           return false;
     }
});
});
</script>


<script type="text/javascript">
//function fnheadrmainserach(srchstring)
$(document).ready(function()
{//alert("1");
  var srchstring = localStorage.getItem("srchstring");
  if(srchstring==null || srchstring=="")
   {//alert("localStorage Null");

   }else{

       localStorage.setItem("pckId", "");
      // localStorage.removeItem('pckId');

        var q = srchstring; //$('#q').val();
        if(q!="")
          {
              $.ajax({
              type: "POST",
              url: "<?=site_url('fi_home/search_cust_mainsearch')?>",
              data: {q:q},
              dataType:"html",
              beforeSend: function() {
                  // setting a timeout
                  $('.fadeMe').show();
                 // alert("searchstring--"+q);
                  localStorage.setItem("pckId", "");
                  //localStorage.removeItem('pckId');
                  $('#searc option:selected').removeAttr("selected");
              },
              success: function(data)
              {
                 // alert("data---"+data);
                  $('#searc option:selected').removeAttr("selected");

                  //localStorage.getItem("pckId");
                  localStorage.setItem("pckId", "");
                  //localStorage.removeItem('pckId');

                  if(data!="")
                  {//alert("datatt--"_data);

                   $('#divfiltercust').html(data);
                   $('.fadeMe').hide();
                   localStorage.removeItem("srchstring");

                }else{
                    $('#divfiltercust').html(data);
                    $('.fadeMe').hide();
                    localStorage.removeItem("srchstring");

                     localStorage.setItem("pckId", "");
                     //localStorage.removeItem('pckId');
                }
              }
            });
         }
   }


});
</script>

<script type="text/javascript">
$(window).on('load',function(){
    // var y = "3.33";
    // alert(y.length);
    setTimeout(function(){
      $('.glyphicon-usd').parents("td").find(".input-group").css({"float":"right"});
      $('.glyphicon-usd').parent('.input-group-addon').css({"position": "absolute", "right":"40px", "left": "inherit", "margin": 0});
      $('.glyphicon-usd').parent('.input-group-addon').next('input').addClass("t-right");
      var crntval= $('.glyphicon-usd').parent('.input-group-addon').next('input');
      //alert(crntval.length);

       $(crntval).each(function(){
              var x= $(this).val();

              if(x.length==2 )
              { $(this).prev().css("right","33px");
              }else if(x.length==3 )
              { $(this).prev().css("right","37px");
              }else if(x.length==5 )
              {//alert("if");
                $(this).prev().css("right","48px");
              }else if(x.length==6){
                 $(this).prev().css("right","56px");
              }else if(x.length==7){
                 $(this).prev().css("right","64px");
              }else if(x.length==8){
                 $(this).prev().css("right","72px");
              }else if(x.length==9){
                 $(this).prev().css("right","80px");
              }else if(x.length==10){
                 $(this).prev().css("right","88px");
              }else if(x.length==11){
                 $(this).prev().css("right","96px");
              }else if(x.length==12){
                 $(this).prev().css("right","104px");
              }else if(x.length==13){
                 $(this).prev().css("right","112px");
              }
       });

    },2000);


});
</script>



<script type="text/javascript">
$(window).on('load',function(){
    // var y = "3.33";
    // alert(y.length);
    setInterval(function(){
      $('.glyphicon-usd').parents("td").find(".input-group").css({"float":"right"});
      $('.glyphicon-usd').parent('.input-group-addon').css({"position": "absolute", "right":"39px", "left": "inherit", "margin": 0, "top":"3.1px"});
      $('.glyphicon-usd').parent('.input-group-addon').next('input').addClass("t-right");
      var crntval= $('.glyphicon-usd').parent('.input-group-addon').next('input');
      //alert(crntval.length);

       $(crntval).each(function(){
              var x= $(this).val();
            if(x.length==2 )
              { $(this).prev().css("right","30px");
              }else if(x.length==3 )
              { $(this).prev().css("right","34px");
              }else if(x.length==5 )
              {//alert("if");
                $(this).prev().css("right","45px");
              }else if(x.length==6){
                 $(this).prev().css("right","53px");
              }else if(x.length==7){
                 $(this).prev().css("right","59px");
              }else if(x.length==8){
                 $(this).prev().css("right","69px");
              }else if(x.length==9){
                 $(this).prev().css("right","77px");
              }else if(x.length==10){
                 $(this).prev().css("right","85px");
              }else if(x.length==11){
                 $(this).prev().css("right","93px");
              }else if(x.length==12){
                 $(this).prev().css("right","101px");
              }else if(x.length==13){
                 $(this).prev().css("right","109px");
              }
       });

    },500);


});
</script>

<script>

$(document).ready(function(){
  // alert("hi");
  sendRequest();
  function sendRequest(){
      $.ajax({
        url: "<?=site_url('fi_home/get_reminder_data')?>",
        success:
          function(data){
            // console.log(data);
						if (data > 0) {
							// alert("hi");
							$("#reminder_count").text(data);

						}else {
							data=0;
							$("#reminder_count").text(data);
						}
           // $('#listposts').html(data); //insert text of test.php into your div
					 // console.log("refresh new");
        },
        complete: function() {
       // Schedule the next request when the current one's complete
     }
    });
  }
});
// setInterval(sendRequest, 50000); // The interval set to 5 seconds

</script>


<script>

$(document).ready(function(){

var startint = setInterval(function(){

	// $(".dropdown-alerts").load(".dropdown-alerts > *","");
	$("#reminder_notification").load(location.href+" #reminder_notification>*","");
	// console.log("refresh");
	// $("#reminder_count").load(location.href+" #reminder_count>*","");
	// console.log("refresh");


}, 50000);

$(".count-info").click(function(){
	// alert("stop");
	clearInterval(startint);
});




 //count-info

});
</script>

<script>
function function_dissmiss() {
// alert("hi");
var reminder_id = $('#reminder_ids').val();
var reminder_count = $('#reminder_count').text();
var final_count=parseInt(reminder_count)-1;
// alert(final_count);

$.ajax({
type: 'POST',
url: '<?=site_url('fi_notes/dissmiss_reminder')?>',
data: {reminderid:reminder_id},
dataType: 'text',
beforeSend: function() {

	 $('.fadeMe').show();


},
success: function(data) {
	// alert(data);
	 if(data=="success")
	 {
			 $('.fadeMe').hide();
			 // $("#reminder_count").load(" #reminder_count");

		$("#reminder_count").text(final_count);
			 // alert("Reminder Set");
			 //fngetinvoicedetails(invoiceid);
			// $('.fadeMe').hide();
				 // window.location.href='<?=site_url('fi_notes/c_notes')?>';


	 }else if(data=="error"){

			 $('.fadeMe').hide();
			 //alert("Something went wrong..!");
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
<script>
function function_snooze(time) {
// alert("hi");
var reminder_id = $('#reminder_ids').val();
var reminder_count = $('#reminder_count').text();
var final_count=parseInt(reminder_count)-1;
// alert(final_count);
var snooze_time=time;
// alert(snooze_time);
// var x = new Date();
// var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getYear();
// x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
// alert(x1);

$.ajax({
type: 'POST',
url: '<?=site_url('fi_notes/snooze_reminder')?>',
data: {reminderid:reminder_id,snooze_time:snooze_time},
dataType: 'text',
beforeSend: function() {

	 $('.fadeMe').show();


},
success: function(data) {
	// alert(data);
	 if(data=="success")
	 {
			 $('.fadeMe').hide();
			 // $("#reminder_count").load(" #reminder_count");

		$("#reminder_count").text(final_count);
			 alert("Snooze successfully Set");
			 //fngetinvoicedetails(invoiceid);
			// $('.fadeMe').hide();
				 // window.location.href='<?=site_url('fi_notes/c_notes')?>';


	 }else if(data=="error"){

			 $('.fadeMe').hide();
			 //alert("Something went wrong..!");
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


<script type="text/javascript">

  $(document).ready(function(){


    $(".count-info").on("click", function (event) {
      event.stopPropagation();
      var target = event.currentTarget;
      $(target).siblings('ul').slideToggle("fast");
    });

  });
</script>




<script type="text/javascript">
  $(document).ready(function(){  //alert(111);

    $("body").on("keyup","#amt1", function(ee){
			ee.preventDefault();
      var tempval = $(this).val();

      if(tempval > 0 ){
          $(this).parent(".input-group").next("a").removeClass("disabled");
      }else{
          $(this).parent(".input-group").next("a").addClass("disabled");
      }
      //alert("pmat"+tempval);
    });
  });

</script>

<script type="text/javascript">
  $(document).ready(function(){  //alert(111);

    $(document).on("keyup",".invapplyamt", function(ee){
			ee.preventDefault();
      var tempval = $(this).val();
			var maxx =""; parseFloat($(this).closest("tr").find('input[name="invoice_payment"]').val());
			var remaning_amt=parseFloat($('#custrmnamt').val());
			// alert(remaning_amt);
      if(tempval > 0 && tempval<= remaning_amt){
          $(this).parent("td").prev("td").find(".apply_btn").removeClass("disabled");
      }else{
           $(this).parent("td").prev("td").find(".apply_btn").addClass("disabled");
      }
			// $('#invautoapply').removeClass("disabled");
      //alert("pmat"+tempval);
				// tab_click funaction


    });
  });

</script>

<script type="text/javascript">
  $(document).ready(function(){  //alert(111);

    $("body").on("keyup",".invapplyamtSec", function(ee){  ee.preventDefault();
      var tempval = $(this).val();
			var maxx =""; parseFloat($(this).closest("tr").find('input[name="invoice_payment"]').val());
			var remaning_amt=parseFloat($('#custrmnamtSec').val());
			if (Number.isNaN(remaning_amt)) {
				remaning_amt=0;
			}
			// alert(remaning_amt);
      if(tempval > 0 && tempval<= remaning_amt){
          $(this).parent("td").prev("td").find(".apply_btn_sec").removeClass("disabled");
      }else{
           $(this).parent("td").prev("td").find(".apply_btn_sec").addClass("disabled");
      }
			// $('#invautoapply').removeClass("disabled");
      //alert("pmat"+tempval);
    });
  });

</script>

<script type="text/javascript">

$(document).ready(function(eee){
document.addEventListener('keyup', function(event) {
var clickedElem = event.target;
 var nm = $(clickedElem).attr('name');
// alert(nm);
 if(nm == 'invoice_payment'){
// alert(clickedElem);
  if (event.keyCode == 9) {

    var paid = $("#custappamt").val();
    if(paid=="")
    {
      paid = 0;
    }
// custpayamt  custrmnamt
    var paid_amount= $('#custpayamt').val();
    var rem_amt= $('#custrmnamt').val();

    var custpayamt= $('#custpayamt').val();  //custpay.toFixed(0);
    // alert("enter_amt :"+rem_amt);
    var balance_amt= $(clickedElem).parents('.tr_clone').find('.balance_amt').val();
		var paid_last_val= $(clickedElem).parents('.tr_clone').find('.invoice_paid_amt').val();
    // alert("balance_amt :"+balance_amt);
    var fld = $(clickedElem).parents('.tr_clone').find('.balance_amt');
		var flo = $(clickedElem).parents('.tr_clone').find('.invoice_paid_amt');
		// alert(fld);
    var hpaymentId= $('#hpaymentId').val();
    var invId= $(clickedElem).parents('.tr_clone').find('.invce-id').html();
    // alert("invoice_id : "+invId);
    var cus_Id= localStorage.getItem("pckId");
    // var cus_Id= $('#names1 option:selected').val();

    var invapplyamt= $('#invapplyamt'+invId).val();
      // alert("amt :"+invapplyamt);
    var custpayamt=parseFloat(invapplyamt);
		var last_amt=parseFloat(paid_last_val);
    if (custpayamt !="") {


     event.preventDefault();
    if (rem_amt !=0) {
			// alert("rem amt :"+ rem_amt);
			// alert("applay amt :"+ custpayamt);
			if (parseFloat(rem_amt) >= custpayamt) {
			if (parseFloat(balance_amt) >= custpayamt) {

      if (invapplyamt=="") {
        if(parseFloat(rem_amt) >parseFloat(balance_amt))
        {
          custpayamt = parseFloat(balance_amt);
          // alert("amt_greater :"+custpayamt);
        }
        else {
          custpayamt = parseFloat(rem_amt);
          // alert("amt_less :"+custpayamt);
        }
      }

      $.ajax({
      type: 'POST',
      url: '<?=site_url('PaymentsCont/fnappyinvoice')?>',
      data: {invId:invId,custpayamt:custpayamt,hpaymentId:hpaymentId,cus_Id:cus_Id},
      dataType: 'html',
      beforeSend: function() {
          // setting a timeout
          $('.fadeMe').show();
          // alert("invId--"+invId+" custpayamt--"+custpayamt+" hpaymentId--"+hpaymentId+"cus_Id--"+cus_Id);
      },
      success: function(data) {

        // alert("data--"+data);

          if(data!="")
          {
              $('.fadeMe').hide();

               $('#invapplyamt'+invId).val('');
               // $('.apply_btn').addClass("disabled");
               $('#invclose').removeClass("disabled");
               $('#invrmall').removeClass("disabled");
               // $('#invautoapply').addClass("disabled");
              $('#applypaymentinv').html(data);
              // alert("done");
						fld.val(parseFloat(parseFloat(balance_amt)-parseFloat(custpayamt)).toFixed(2));
						flo.val(parseFloat(parseFloat(last_amt)+parseFloat(custpayamt)).toFixed(2));

              var baldueamt= $('#baldue').val();
              var appmnet= $('#appmnet').val();
              var balramins= $('#balramins').val();

             //alert("balramins--"+balramins);

              if(balramins==0)
              {
                 //$('#custappamt').val(appmnet);
                 $('#custappamt').val(parseFloat(paid)  + parseFloat(custpayamt));
                 $('#custrmnamt').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
              }else if(balramins>0){

                if(parseInt(custpayamt)>parseInt(balramins))
                  {//alert("custpayamt > balramins");

                     //$('#custappamt').val(custpayamt-balramins);
                     $('#custappamt').val(parseFloat(paid) + parseFloat(custpayamt));
                     $('#custrmnamt').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
                  }else{//alert("custpayamt < balramins");

                     //$('#custappamt').val(appmnet);
                     $('#custappamt').val(parseFloat(paid) +parseFloat(custpayamt));
                     $('#custrmnamt').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
                  }

              }else{

                // $('#custappamt').val(custpayamt);
                 $('#custappamt').val(parseFloat(paid) +parseFloat(custpayamt));
                 $('#custrmnamt').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
              }

              //getpaymentinfo();

              $('#invclose').attr('onclick', 'fncloseinvoces("'+invId+'")');
              $('#invrmall').attr('onclick', 'fnremoveallinv("'+invId+'")');

          }else{
              $('#applypaymentinv').html("No Applied Invoices Available..!");
              $('.fadeMe').hide();
              $('#custappamt').val("");
              $('#invclose').removeAttr('onclick');
              $('#invrmall').removeAttr('onclick');

          }


      },
      error: function(xhr) { // if error occured
        // $('.fadeMe').hide();
      },
      complete: function() {
       // $('.fadeMe').hide();
      }

  });
}else{
	alert('Enter amount is greater than Balance amount.');
}
}else{
	alert('Enter amount is greater than remaning amount.');
}
}else {
  alert('You dont have Remaining amount');
}
}else {
  alert('Please Enter amount');
}
   }
 }
 else if (nm =='invoice_paymentSec') {
	 if (event.keyCode == 9) {

		 var paid = $("#custappamtSec").val();
		 if(paid=="")
		 {
			 paid = 0;
		 }

		 var paid_amount= $('#custpayamtSec').val();
		 var rem_amt= $('#custrmnamtSec').val();
		 //alert(rem_amt);
		 var custpayamt= $('#custpayamtSec').val();  //custpay.toFixed(0);

		 var hpaymentId= $('#hpaymentId').val();

		 // var main_invid= $(clickedElem).parents('.tr_clone').find('.hdnpayId').val();
		 // alert("main :"+hpaymentId);

		 var invId= $(clickedElem).parents('.tr_clone').find('.invce-id_Sec').html();

		var balance_amt= $(clickedElem).parents('.tr_clone').find('.balance_amtSec').val();
    var paid_last_val= $(clickedElem).parents('.tr_clone').find('.invoice_paid_amtSec').val();

		// alert("balance_amt :"+balance_amt);
    var fld = $(clickedElem).parents('.tr_clone').find('.balance_amtSec');
    var flo = $(clickedElem).parents('.tr_clone').find('.invoice_paid_amtSec');
		 //alert("invoice_id :"+invId);
		 var cus_Id= localStorage.getItem("pckId");
		 // var cus_Id= $('#names1 option:selected').val();

		 var invapplyamt= $('#invapplyamtSec'+invId).val();
       //alert("amt :"+invapplyamt);
     var custpayamt=parseFloat(invapplyamt);

		 var last_amt=parseFloat(paid_last_val);
     if (custpayamt !="") {


      event.preventDefault();
     if (rem_amt !=0) {
 			// alert("rem amt :"+ rem_amt);
 			// alert("applay amt :"+ custpayamt);
 			if (parseFloat(rem_amt) >= custpayamt) {

       if (invapplyamt=="") {
         if(parseFloat(rem_amt) >parseFloat(balance_amt))
         {
           custpayamt = parseFloat(balance_amt);
           // alert("amt_greater :"+custpayamt);
         }
         else {
           custpayamt = parseFloat(rem_amt);
           // alert("amt_less :"+custpayamt);
         }
       }

			 $.ajax({
			 type: 'POST',
			 url: '<?=site_url('PaymentsCont/fnappyinvoiceSec')?>',
			 data: {invId:invId,custpayamt:custpayamt,hpaymentId:hpaymentId,cus_Id:cus_Id},
			 dataType: 'html',
			 beforeSend: function() {
					 // setting a timeout
					 $('.fadeMe').show();
					 // alert("invId--"+invId+" custpayamt--"+custpayamt+" hpaymentId--"+hpaymentId+"cus_Id--"+cus_Id);
			 },
			 success: function(data) {

				 // alert("data--"+data);

					 if(data!="")
					 {
							 $('.fadeMe').hide();

								$('#invapplyamtSec'+invId).val('');
								//$('.apply_btn_sec').addClass("disabled");
								$('#invcloseSec').removeClass("disabled");
								$('#invrmallSec').removeClass("disabled");
								// $('#invautoapply').addClass("disabled");
							 $('#applypaymentinvSec').html(data);

							 fld.val(parseFloat(parseFloat(balance_amt)-parseFloat(custpayamt)).toFixed(2));
	 						flo.val(parseFloat(parseFloat(last_amt)+parseFloat(custpayamt)).toFixed(2));

							 var baldueamt= $('#baldue_Sec').val();
							 var appmnet= $('#appmnet_Sec').val();
							 var balramins= $('#balramins').val();

							//alert("balramins--"+balramins);

							 if(balramins==0)
							 {
									//$('#custappamt').val(appmnet);
									// custpayamt custappamt custrmnamt
									$('#custappamtSec').val(parseFloat(paid)  + parseFloat(custpayamt));
									$('#custrmnamtSec').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
							 }else if(balramins>0){

								 if(parseInt(custpayamt)>parseInt(balramins))
									 {//alert("custpayamt > balramins");

											//$('#custappamt').val(custpayamt-balramins);
											$('#custappamtSec').val(parseFloat(paid) + parseFloat(custpayamt));
											$('#custrmnamtSec').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
									 }else{//alert("custpayamt < balramins");

											//$('#custappamt').val(appmnet);
											$('#custappamtSec').val(parseFloat(paid) +parseFloat(custpayamt));
											$('#custrmnamtSec').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
									 }

							 }else{

								 // $('#custappamt').val(custpayamt);
									$('#custappamtSec').val(parseFloat(paid) +parseFloat(custpayamt));
									$('#custrmnamtSec').val(parseFloat(paid_amount)-(parseFloat(paid) + parseFloat(custpayamt)));
							 }

							 //getpaymentinfo();

							 $('#invclose').attr('onclick', 'fncloseinvoces("'+invId+'")');
							 $('#invrmall').attr('onclick', 'fnremoveallinv("'+invId+'")');
							 $('#close').attr('onclick', 'fndeleteallinv("'+invId+'")');

					 }else{
							 $('#applypaymentinvSec').html("No Applied Invoices Available..!");
							 $('.fadeMe').hide();
							 $('#custappamtSec').val("");
							 $('#invclose').removeAttr('onclick');
							 $('#invrmall').removeAttr('onclick');

					 }


			 },
			 error: function(xhr) { // if error occured
				 // $('.fadeMe').hide();
			 },
			 complete: function() {
				// $('.fadeMe').hide();
			 }

	 });
 }else{
 	alert('Enter amount is greater than remaning amount.');
 }
 }else {
   alert('You dont have Remaining amount');
 }
 }else {
   alert('Please Enter amount');
 }
    }
 }
 // else if (nm=='txtnotes') {
 //   alert("enter");
	//   $(this).parent('div').next('a').trigger('click');
 //   //$('#myModal').modal('show');
 //  // $('#myModal').css('display','block');
 //
 //         // show Modal
 //         $('#myModal').modal('show');
 //
 //
 //
 // }
 // else {
 //
 // }
   });
   });
</script>
<script>
$(document).ready(function(){
	$('body').on('keyup','.newpmt',function(event){
		// alert("blur");
		 var keycode = event.which || event.keyCode;
		// alert(keycode);
		if(event.keyCode == 13){




		// alert(111);
		//$(this).parent('div').next('a').trigger('click');
		$('#myModal').addClass('in');
		$('#myModal').css({"display":"block","background": "rgba(0,0,0,0.7)"});


		  	var name = localStorage.getItem("pckId");
		  	// var name = $('#names1 option:selected').val();
			  var custmname=$('#names1 option:selected').text();
		    var lstpaytype= $(this).parents('.tr_clone').find('.paytype').val();
		    var lsttxtpdate= $(this).parents('.tr_clone').find('.txtpdate').val();
		    var creditamt= $(this).parents('.tr_clone').find('.creditamt').val();
		    var pamt= $(this).parents('.tr_clone').find('.pamt').val();
		    var hdnpayId= $(this).parents('.tr_clone').find('.hdnpayId').val();
		    // alert(name);
		    var type_payment = $('#type_payment').val();
		    // var type_payment_no = $('#type_payment_no').val();
		    // alert(type_payment);
// txtcustdesc
			        $.ajax({
			        type: "POST",
			        url: "<?php echo base_url('PaymentsCont/getCustomerInfo'); ?>",
			        data: {name : name},
			        dataType: 'html',
			        beforeSend: function() {
		                // setting a timeout
		                $('.fadeMe').show();
						        // $('#txtcustname').val('');
		                $('#custpayamt').val('');
		                $('#custrmnamt').val('');
		                $('#txtcustdesc').val('');
		                $('#hpaymentId').val('');
		            },
			        success: function(data)
			        {
			          if(data!="")
			          {
			             $('#inv_table').html(data);
			             //fnupdateinvosts();
		               $('.fadeMe').hide();
		               var totcustpay=Number(creditamt)+Number(pamt);
		               //alert("totcustpay--"+totcustpay);
		               $('#custpayamt').val(totcustpay.toFixed(2));
		               $('#custrmnamt').val(totcustpay.toFixed(2));
		               //$('#txtcustname').val($.trim(custmname));
					         $('#txtcustdesc').val($.trim(lstpaytype));
		               $('#hpaymentId').val(hdnpayId);
		               //var invId= $('.invce-id').val();

		               fninovicepayhistory(hdnpayId);


		            }else{
			             //$('#inv_table').html("No Invoices Available..!");
		               var totcustpay=Number(creditamt)+Number(pamt);
		               //alert("totcustpay--"+totcustpay);
		               $('#custpayamt').val(totcustpay.toFixed(2));
		               $('#custrmnamt').val(totcustpay.toFixed(2));
		               $('.fadeMe').hide();
						       //$('#txtcustname').val($.trim(custmname));
		               $('#txtcustdesc').val($.trim(lstpaytype));
		               $('#hpaymentId').val(hdnpayId);
		               //var invId= $('.invce-id').val();

		               fninovicepayhistory(hdnpayId);

			         }
			        }
			      });

		        $.ajax({
		        type: "POST",
		        url: "<?php echo base_url('PaymentsCont/getCustomeraddress'); ?>",
		        data: {name : name},
		        dataType: 'text',
		        beforeSend: function() {
		              // setting a timeout

		          },
		        success: function(data)
		        {
		          // alert(data);
		          if(data!="0")
		          {

		            $('#txtcustaddress').val($.trim(data));

		          }else{

		            $('#txtcustaddress').val('');
		         }
		        }
		      });

					$.ajax({
					type: "POST",
					url: "<?php echo base_url('PaymentsCont/getCustomerlname'); ?>",
					data: {name : name},
					dataType: 'text',
					beforeSend: function() {
								// setting a timeout
// txtcustname
$('#txtcustname').val('');
						},
					success: function(data)
					{
						// alert(data);
						if(data!="0")
						{

							$('#txtcustname').val($.trim(data));

							 //$('#txtcustname').val($.trim(custmname));

						}else{

							$('#txtcustaddress').val('');
					 }
					}
				});
			}
	});


	$(".modal .close").click(function(){
		$(this).parents(".modal").removeClass("in");
		$(this).parents(".modal").css({"display":"none","background": "none"});
	});
	// if (keycode==27) {
	// 	$(this).parents(".modal").removeClass("in");
	// 	$(this).parents(".modal").css({"display":"none","background": "none"});
	// }
});

</script>
<script>
$(document).ready(function(){
$(document).on("keyup",function(event){
	// alert("close");
var keycode = (event.keyCode ? event.keyCode : event.which);
if (keycode==27) {
	// $(".modal").removeClass("in");
	// $(".modal").css({"display":"none","background": "none"});
}
});
});
</script>





<!-- ----------------- For Dropdown with search ------------------------ -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<script type="text/javascript">
	
$(document).ready(function() {
   
    $("#event_type").select2();
    $(".select_dropdown").select2();

  });

  $(document).ready(function() {
		$("#cus_notes").delay(10000).addClass("aaaa").select2();
		$("#cus_names").select2();

 
	});


</script>


<!-- -------------------------- END ----------------------- -->



    <div class="modal fade" id="modal-note">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> Note&nbsp; <i class="fa fa-pencil-square-o"></i></h4>
          </div>
          <div class="modal-body">
            <textarea class="form-control" rows="6"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save Note</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



  </body>

  </html>
  <script type="text/javascript">
    $(document).on('keydown', function(event) 
    {
        if (event.key == "Escape") 
        {
            window.location.href = "<?=base_url("/fi_home")?>";
        }
    });
</script>   



    <script src='<?=base_url()?>assets/packages/core/main.js'></script>
    <script src='<?=base_url()?>assets/packages/interaction/main.js'></script>
    <script src='<?=base_url()?>assets/packages/daygrid/main.js'></script>
