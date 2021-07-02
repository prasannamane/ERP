<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="active"><a href="<?php echo site_url('fi_home/');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
<a href="#">
<i class="fa fa-users"></i> <span>Customers</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>

    <ul class="treeview-menu">
                        <li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/cust_search');?>"><i class="fa fa-circle-o"></i> Search</a></li>
                        <li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/generalinfo');?>"><i class="fa fa-circle-o"></i> General Info</a></li>
                        <li><a href="<?php echo site_url('fi_home/custevents');?>"><i class="fa fa-circle-o"></i> Events</a></li>
                      <!--   <li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/custinvoices');?>"><i class="fa fa-circle-o"></i> Invoices</a></li>
                      <li><a onclick="event_data_save()" href="<?php echo site_url('PaymentsCont/c_payment');?>"><i class="fa fa-circle-o"></i> Payments</a></li>
                      <li><a onclick="event_data_save()" href="<?php echo site_url('attachment');?>"><i class="fa fa-circle-o"></i> Attachments</a></li>
                      <li><a onclick="event_data_save()" href="<?php echo site_url('fi_notes/c_notes');?>"><i class="fa fa-circle-o"></i> Notes</a></li> -->
                    </ul>
                </li>
               
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Vendors</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url('fi_home/newVenderGeneralInfo');?>"><i class="fa fa-circle-o"></i> Create New Vendor</a></li>
                       <!--  <li><a href="<?php echo site_url('fi_home/vendor_search');?>"><i class="fa fa-circle-o"></i> Search</a></li>
                        <li><a href="<?php echo site_url('fi_home/vendor_genral_info');?>"><i class="fa fa-circle-o"></i> General Info</a>
                        </li> -->

<!-- <li><a href="vendor-general-info.php"><i class="fa fa-circle-o"></i> General Info</a></li> -->

<!-- <li><a href="<?php echo site_url('fi_home/vendor_events');?>"><i class="fa fa-circle-o"></i> Events</a></li>

<li><a href="vendor-events.php"><i class="fa fa-circle-o"></i> Events</a></li>

<li><a href="<?php echo site_url('fi_home/vendor_pricelist');?>"><i class="fa fa-circle-o"></i> Price List</a></li>

<li><a href="vendor-pricelist.php"><i class="fa fa-circle-o"></i> Price List</a></li>

<li><a href="<?php echo site_url('fi_home/vendor_purchase');?>"><i class="fa fa-circle-o"></i> Purchases</a></li>

<li><a href="vendor-purchases.php"><i class="fa fa-circle-o"></i> Purchases</a></li>


<li><a href="<?php echo site_url('fi_home/vendor_payments');?>"><i class="fa fa-circle-o"></i> Payments</a></li>

<li><a href="vendor-payments.php"><i class="fa fa-circle-o"></i> Payments</a></li>

<li><a href="vendor-notes.php"><i class="fa fa-circle-o"></i> Notes</a></li>

<li><a href="<?php echo site_url('vendor_attachment');?>"><i class="fa fa-circle-o"></i> Attachments</a></li>

<li><a href="vendor-attachments.php"><i class="fa fa-circle-o"></i> Attachments</a></li> -->

</ul>

</li>

 

<li class="treeview">
<a href="#"><i class="fa fa-book"></i> <span>Reports</span>
<span class="pull-right-container">

<i class="fa fa-angle-left pull-right"></i>

</span>
</a>

<ul class="treeview-menu">
<!-- <li><a href="<?php echo site_url('Fi_report/no_crews');?>"><i class="fa fa-circle-o"></i> Unselected Crews</a></li>
<li><a href="<?php echo site_url('Fi_report/sales_tax_details');?>"><i class="fa fa-circle-o"></i> Sales Tax Details</a></li>
<li><a href="<?php echo site_url('Fi_report/upcoming_events_report');?>"><i class="fa fa-circle-o"></i> Upcoming Events</a></li> -->
<li><a href="<?php echo site_url('Fi_report/invoice_pdf');?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
<li><a href="<?php echo site_url('Fi_report/contract_pdf');?>"><i class="fa fa-circle-o"></i> Contract PDF</a></li>

<!-- <li><a href="<?php echo site_url('Fi_report/selected_crews_report');?>"><i class="fa fa-circle-o"></i> Selected Crews </a></li>
<li><a href="<?php echo site_url('Fi_report/expense_detail_report');?>"><i class="fa fa-circle-o"></i> Expense Detail </a></li>
<li><a href="<?php echo site_url('Fi_report/profitrepbyevent_report');?>"><i class="fa fa-circle-o"></i> Profit Report By Event </a></li>
<li><a href="<?php echo site_url('Fi_report/expense_report_by_vendor_report');?>"><i class="fa fa-circle-o"></i> Expense Report byVendor </a></li>
<li><a href="<?php echo site_url('Fi_report/referredby_report');?>"><i class="fa fa-circle-o"></i> Referred By </a></li>
<li><a href="<?php echo site_url('Fi_report/contract_pdf');?>"><i class="fa fa-circle-o"></i> Crews Availability </a></li>
<li><a href="<?php echo site_url('Fi_report/expense_detail_report_by_account_report');?>"><i class="fa fa-circle-o"></i>Expense Detail Report by Account</a></li> -->

</ul>

</li>

<!-- <li><a href="calendar.php"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li> -->

<!-- <li><a href="administration.php"><i class="fa fa-user-plus"></i> <span>Administration</span></a></li> -->



<!-- <li class="treeview">

<a href="#">

<i class="fa fa-users"></i> <span>Administration</span>

<span class="pull-right-container">

<i class="fa fa-angle-left pull-right"></i>

</span>

</a>

<ul class="treeview-menu">

<li><a href="<?php echo site_url('si_home/administration');?>"><i class="fa fa-circle-o"></i> Admin</a></li>

<li><a href="administration.php"><i class="fa fa-circle-o"></i> Admin</a></li>

<li><a href="#"><i class="fa fa-circle-o"></i> Live Update</a></li>

<li><a href="<?php echo site_url('fi_home/admin_item');?>"><i class="fa fa-circle-o"></i> Items</a></li>

<li><a href="administration-items.php"><i class="fa fa-circle-o"></i> Items</a></li>

<li><a href="<?php echo site_url('fi_home/administration_info');?>"><i class="fa fa-circle-o"></i> Company Info</a></li>

<li><a href="administration-info.php"><i class="fa fa-circle-o"></i> Company Info</a></li>

<li><a href="<?php echo site_url('fi_home/administration_package');?>"><i class="fa fa-circle-o"></i> Packages</a></li>

<li><a href="administration-packages.php"><i class="fa fa-circle-o"></i> Packages</a></li>

<li><a href="<?php echo site_url('fi_home/administration_user_rights');?>"><i class="fa fa-circle-o"></i> User Rights</a></li>

<li><a href="administration-user-rights.php"><i class="fa fa-circle-o"></i> User Rights</a></li>

<li><a href="<?php echo site_url('fi_home/administration_locations');?>"><i class="fa fa-circle-o"></i> Locations</a></li>

<li><a href="administration-locations.php"><i class="fa fa-circle-o"></i> Locations</a></li>

<li><a href="<?php echo site_url('fi_home/administration_notes');?>"><i class="fa fa-circle-o"></i> Notes Setup</a></li>

<li><a href="administration-notes.php"><i class="fa fa-circle-o"></i> Notes Setup</a></li>

<li><a href="<?php echo site_url('fi_home/administration_letters');?>"><i class="fa fa-circle-o"></i> Letters</a></li>


<li><a href="<?php echo site_url('fi_home/administration_crewavailability');?>"><i class="fa fa-circle-o"></i> Crew Availability</a></li>

<li><a href="<?php echo site_url('fi_home/administration_terms');?>"><i class="fa fa-circle-o"></i> Terms</a></li>

<li><a href="<?php echo site_url('fi_home/administration_task');?>"><i class="fa fa-circle-o"></i> Task</a></li>

<li><a href="<?php echo site_url('fi_home/admin_taskstatus');?>"><i class="fa fa-circle-o"></i> Task Status</a></li>
<li><a href="<?php echo site_url('fi_home/admin_todotatus');?>"><i class="fa fa-circle-o"></i> To Do Status</a></li>



<li><a href="administration-letters.php"><i class="fa fa-circle-o"></i> Letters</a></li>

<li class="treeview">
<a href="#"><i class="fa fa-circle-o"></i> Create Dropdown <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu">
<li><a href="<?php echo site_url('fi_home/administration');?>"><i class="fa fa-circle-o"></i> Admin</a></li>
</ul>
</li>
<li><a href="<?php echo site_url('fi_home/admin_search');?>"><i class="fa fa-circle-o"></i> Search options</a></li>
<li><a href="<?php echo site_url('fi_tax/administration_tax');?>"><i class="fa fa-circle-o"></i> Tax</a></li>

</ul>

</li>
 -->
<li class="treeview">

<a href="#">

<i class="fa fa-tasks"></i>

<span>Tasks</span>

<span class="pull-right-container">

<i class="fa fa-angle-left pull-right"></i>

</span>

</a>

<ul class="treeview-menu">


<li><a href="<?php echo site_url('fi_task/task_history');?>"><i class="fa fa-circle-o"></i> History</a></li>

<li><a href="<?php echo site_url('fi_notes/view_todo');?>"><i class="fa fa-circle-o"></i> To Do List</a></li>

<!-- <li><a href="to_do_appointment_list.php"><i class="fa fa-circle-o"></i> To Do List</a></li> -->

<li><a href="<?php echo site_url('fi_home/task_alert');?>"><i class="fa fa-circle-o"></i> Alerts</a></li>

<!-- <li><a href="cust-alerts.php"><i class="fa fa-circle-o"></i> Alerts</a></li> -->

</ul>

</li>
<li><a href="<?php echo site_url('fi_calendar');?>"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>

</ul>

<!-- /.sidebar-menu -->

</section>

<!-- /.sidebar -->

</aside>

<script>
var path = window.location;
var pathElements = path.toString().split("/");

var lastFolder = pathElements[pathElements.length - 1];
//alert(lastFolder);


</script>

<script>
    function event_data_save() {
   
var event_session="<?php echo $this->session->userdata('event_page'); ?>";
// $( "#createvent" ).submit();
// alert(event_session);

if(event_session == 1) {
var res=true; // confirm("Do you want to save updated changes..??");
if(res==true)
{
// alert("submit");
$("form[name='createvent_new']").submit();
}
}


}
</script>