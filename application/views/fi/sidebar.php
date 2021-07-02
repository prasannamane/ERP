<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<li class="active"><a href="<?php echo site_url('fi_home/'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Customers</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a onclick="event_data_save()" href="<?= base_url('fi_home/search') ?>"> <i class="fa fa-circle-o"></i> Search</a></li>
					<li><a onclick="event_data_save()" href="<?= base_url('fi_home/generalinfo') ?>"> <i class="fa fa-circle-o"></i> General Info</a></li>
					<li><a onclick="event_data_save()" href="<?= base_url('fi_home/search_new_cus') ?>"><i class="fa fa-circle-o"></i> Events</a></li>
					<!--<li><a onclick="event_data_save()"  href="<?php echo site_url('fi_home/custinvoices'); ?>">  <i class="fa fa-circle-o"></i> Invoices</a></li> -->
					<li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/CustomerInvoice'); ?>"> <i class="fa fa-circle-o"></i> Invoices </a></li>
					<li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/c_payment'); ?>"> <i class="fa fa-circle-o"></i> Payments</a></li>
					<li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/attachment'); ?>"> <i class="fa fa-circle-o"></i> Attachments</a></li>
					<!-- <li><a onclick="event_data_save()"  href="<?php echo site_url('fi_notes/c_notes'); ?>">      <i class="fa fa-circle-o"></i> Notes</a></li> -->
					<li><a onclick="event_data_save()" href="<?php echo site_url('fi_home/c_notes'); ?>"> <i class="fa fa-circle-o"></i> Notes</a></li>
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

					<li><a href="<?= site_url('Vendor/find') ?>"> <i class="fa fa-circle-o"></i> Search</a></li>

					<li><a href="<?= site_url('Vendor/genral_info') ?>"> <i class="fa fa-circle-o"></i> General Info</a></li>
					<li><a href="<?= site_url('Vendor/events') ?>"> <i class="fa fa-circle-o"></i> Events</a></li>
					<li><a href="<?= site_url('Vendor/pricelist') ?>"> <i class="fa fa-circle-o"></i> Price List</a></li>
					<li><a href="<?= site_url('Vendor/purchase') ?>"> <i class="fa fa-circle-o"></i> Purchases</a></li>
					<li><a href="<?= site_url('Vendor/payments') ?>"> <i class="fa fa-circle-o"></i> Payments</a></li>
					<li><a href="<?= site_url('vendor/enclosure') ?>"> <i class="fa fa-circle-o"></i> Attachments</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Banking</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('fi_banking/selectreceivables/0'); ?>"><i class="fa fa-circle-o"></i> Select Receivables</a></li>
					<li><a href="<?php echo site_url('fi_banking/deposit'); ?>"><i class="fa fa-circle-o"></i> Deposits</a></li>
					<li><a href="<?php echo site_url('fi_banking/enterpayables'); ?>"><i class="fa fa-circle-o"></i> Enter Payables</a></li>
					<li><a href="<?php echo site_url('fi_banking/transfer_payment'); ?>"><i class="fa fa-circle-o"></i> Transfer Payments </a></li>
					<li><a href="<?php echo site_url('fi_banking/viewbalances'); ?>"><i class="fa fa-circle-o"></i> View Balances</a></li>
					<li><a href="<?php echo site_url('fi_banking/reconcile'); ?>"><i class="fa fa-circle-o"></i> Reconcile</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#"><i class="fa fa-book"></i> <span>Reports</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('Fi_report/no_crews'); ?>"><i class="fa fa-circle-o"></i> Unselected Crews</a></li>
					<li><a href="<?php echo site_url('Fi_report/sales_tax_details'); ?>"><i class="fa fa-circle-o"></i> Sales Tax Details</a></li>
					<li><a href="<?php echo site_url('Fi_report/upcoming_events_report'); ?>"><i class="fa fa-circle-o"></i> Upcoming Events</a></li>
					<!-- <li><a href="<?php echo site_url('Fi_report/invoice_pdf'); ?>"><i class="fa fa-circle-o"></i> Invoice</a></li> -->
					<!--<li><a href="<?php echo site_url('Fi_report/contract_pdf'); ?>"><i class="fa fa-circle-o"></i> Contract PDF</a></li> -->
					<li><a href="<?php echo site_url('Fi_report/selected_crews_report'); ?>"><i class="fa fa-circle-o"></i> Selected Crews </a></li>
					<li><a href="<?php echo site_url('Fi_report/expense_detail_report'); ?>"><i class="fa fa-circle-o"></i> Expense Detail </a></li>
					<li><a href="<?php echo site_url('Fi_report/profitrepbyevent_report'); ?>"><i class="fa fa-circle-o"></i> Profit Report By Event </a></li>
					<li><a href="<?php echo site_url('Fi_report/expense_report_by_vendor_report'); ?>"><i class="fa fa-circle-o"></i> <!-- Expense Report by  -->Vendor </a></li>
					<li><a href="<?php echo site_url('Fi_report/referredby_report'); ?>"><i class="fa fa-circle-o"></i> Referred By </a></li>
					<!-- <li><a href="<?php echo site_url('Fi_report/contract_pdf'); ?>"><i class="fa fa-circle-o"></i> Crews Availability </a></li> -->
					<li><a href="<?php echo site_url('Fi_report/expense_detail_report_by_account_report'); ?>"><i class="fa fa-circle-o"></i><!--  Expense Detail Report by --> Account</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-users"></i> <span>Administration</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					
						<li><a href="<?= base_url('Administration') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
				
					<li><a href="<?php echo site_url('Administration/administration_package'); ?>"><i class="fa fa-circle-o"></i> Packages</a></li>
					<li><a href="<?php echo site_url('Administration/admin_item'); ?>"><i class="fa fa-circle-o"></i> Items</a></li>
					<li><a href="<?php echo site_url('Administration/administration_info'); ?>"><i class="fa fa-circle-o"></i> Company Info</a></li>
					<li><a href="<?php echo site_url('Administration/administration_user_rights'); ?>"><i class="fa fa-circle-o"></i> User Rights</a></li>
					<?php if ($this->session->fi_session['id'] == 1) { ?>
						<li><a href="<?php echo site_url('Administration/new_company'); ?>"><i class="fa fa-circle-o"></i> New Company</a></li>
					<?php } ?>
					<li><a href="<?php echo site_url('Administration/administration_locations'); ?>"><i class="fa fa-circle-o"></i> Locations</a></li>
					<li><a href="<?php echo site_url('Administration/administration_notes'); ?>"><i class="fa fa-circle-o"></i> Notes Setup</a></li>
					<li><a href="<?php echo site_url('Administration/administration_letters'); ?>"><i class="fa fa-circle-o"></i> Letters</a></li>
					<li><a href="<?php echo site_url('Administration/administration_crewavailability'); ?>"><i class="fa fa-circle-o"></i> Crew Availability</a></li>
					<li><a href="<?php echo site_url('Administration/administration_terms'); ?>"><i class="fa fa-circle-o"></i> Terms</a></li>
					<li><a href="<?php echo site_url('Administration/administration_task'); ?>"><i class="fa fa-circle-o"></i> Task</a></li>
					<li><a href="<?php echo site_url('Administration/admin_taskstatus'); ?>"><i class="fa fa-circle-o"></i> Task Status</a></li>
					<li><a href="<?php echo site_url('Administration/admin_todotatus'); ?>"><i class="fa fa-circle-o"></i> To Do Status</a></li>
					<li><a href="<?php echo site_url('Administration/admin_search'); ?>"><i class="fa fa-circle-o"></i> Search options</a></li>
					<li><a href="<?php echo site_url('Administration/administration_tax'); ?>"><i class="fa fa-circle-o"></i> Tax</a></li>
				</ul>
			</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-tasks"></i>
					<span>Tasks</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li><a href="<?php echo site_url('fi_task/task_history'); ?>"><i class="fa fa-circle-o"></i> History</a></li>
					<li><a href="<?php echo site_url('fi_notes/view_todo'); ?>"><i class="fa fa-circle-o"></i> To Do List</a></li>
					<li><a href="<?php echo site_url('fi_home/task_alert'); ?>"><i class="fa fa-circle-o"></i> Alerts</a></li>
				</ul>
			</li>
			<li><a href="<?php echo site_url('fi_calendar'); ?>"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
		</ul>
	</section>
</aside>

<script>
	var path = window.location;
	var pathElements = path.toString().split("/");
	var lastFolder = pathElements[pathElements.length - 1];
</script>

<script>
	function event_data_save() {
		var event_session = "<?php echo $this->session->userdata('event_page'); ?>";
		if (event_session == 1) {
			var res = confirm("Do you want to save updated changes..??");
			if (res == true) {
				$("form[name='createvent_new']").submit();
			}
		}

		if ('<?php echo $this->router->fetch_method() ?>' == 'custinvoices') {

			var res = confirm("Do you want to save updated changes..??");
			if (res == true) {
				$("form[name='cust_invoice_form']").submit();
			}
		}
	}
</script>