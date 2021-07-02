<?php

class AdminModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		//initialise the autoload things for this class
	}

	public function isChkExistPackage($pckname)
	{
		$user = $this->session->fi_session['id'];
		$chkpcksql = $this->db->query("SELECT * FROM admin_package WHERE user = $user AND package_name='$pckname'");
		$chkpcksql_nrow = $chkpcksql->num_rows();
		if ($chkpcksql_nrow > 0) {
			return "IsExists";
		} else {
			return "Not Exists";
		}
	}

	public  function inserttsksinfo_dtls()
	{
		$user = $this->session->fi_session['id'];
		$chkistaskclr = $this->db->query("SELECT * FROM adm_task_status WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "' ");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_task_type WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "' ");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {

				$insertskarr = array(
					"user" => $user,
					"name"  => $this->input->post('taskname'),
					"color"  => $this->input->post('taskcolor')
				);
				if ($this->db->insert('adm_task_type', $insertskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}

	public function loadsubtaskinfo_dtls()
	{
		$hdntaskid = "";
		if ($this->input->post('hdntaskid')) {
			$hdntaskid = $this->input->post('hdntaskid');
		}
		$subtsksql = $this->db->query("SELECT * FROM adm_subtask_type WHERE task_id='" . $hdntaskid . "' ORDER BY id ASC");
		$i = 1;
		foreach ($subtsksql->result() as $subtsksql_dtls) {

?>
			<tr class="tr_clone auto-index 5">
				<td class="increment">
					<?= $i ?>
					<input type="hidden" class="hdnsbtaskid" name="hdnsbtaskid" id="hdnsbtaskid" value="<?= $subtsksql_dtls->task_id ?>">
				</td>
				<td>
					<input type="text" class="form-control subtaskname" name="subtaskname" id="subtaskname" value="<?= $subtsksql_dtls->name ?>" onchange="fnupdatesubtaskinfo(this.value,'<?= $subtsksql_dtls->id ?>','name','<?= $subtsksql_dtls->task_id ?>')">
				</td>
				<td>
					<input type="number" class="form-control subduedt" name="subduedt" id="subduedt" value="<?= $subtsksql_dtls->due_date ?>" onchange="fnupdatesubtaskinfo(this.value,'<?= $subtsksql_dtls->id ?>','due_date','<?= $subtsksql_dtls->task_id ?>')">
				</td>
				<td>
					<a class="btn btn-xs btn-danger" onclick="fndelsubtasks('<?= $subtsksql_dtls->id ?>')"><i class="fa fa-minus"></i></a>
				</td>
			</tr>
		<?php $i++;
		} ?>
		<tr class="tr_clone auto-index 6">
			<td class="increment"><?= $i ?></td>
			<td>
				<input type="text" class="form-control lstsubtaskname" name="lstsubtaskname" id="lstsubtaskname">
			</td>
			<td>
				<input type="number" class="form-control lstsubduedt" name="lstsubduedt" id="lstsubduedt">
			</td>
			<td></td>

		</tr>

		<?php
	}

	public function inserttskstatusinfo_dtls()
	{
		$user = $this->session->fi_session['id'];
		$chkistaskclr = $this->db->query("SELECT * FROM adm_task_type WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "' ");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_task_status WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "' ");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {

				$insertskarr = array(
					"user" => $user,
					"name"  => $this->input->post('taskname'),
					"color"  => $this->input->post('taskcolor')
				);
				if ($this->db->insert('adm_task_status', $insertskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}

	public function updtatskstatusinfo_dtls()
	{
		$updtskarr = array(
			"name"  => $this->input->post('taskname')
		);
		$this->db->where('id', $this->input->post('hdntaskid'));
		if ($this->db->update('adm_task_status', $updtskarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function inserttodostatusinfo_dtls()
	{
		$user = $this->session->fi_session['id'];
		$chkistaskclr = $this->db->query("SELECT * FROM adm_todo_status WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "'");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_todo_status WHERE color='" . $_POST['taskcolor'] . "' AND user = '" . $user . "' ");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {
				$insertskarr = array(
					"user" => $user,
					"name"  => $this->input->post('taskname'),
					"color"  => $this->input->post('taskcolor')
				);
				if ($this->db->insert('adm_todo_status', $insertskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}

	public function fncntrcttrms_dtls()
	{
		$user = $this->session->fi_session['id'];
		$terms = $this->db->query("SELECT * FROM sub_categories WHERE cat_id='39'")->result_array();
		$pckitmsql = $this->db->query("SELECT * FROM adm_terms AS i,sub_categories AS p 
            WHERE i.subcat_id=p.sub_id AND i.subcat_id='" . $_POST['pckId'] . "' AND p.sub_id='" . $_POST['pckId'] . "' AND  i.user = '" . $user . "'
            ORDER BY id ASC");

		// check last row
		$chkitmsql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $_POST['pckId'] . "' ORDER BY id DESC LIMIT 1");
		$isitmsrow = $chkitmsql->row();

		if ($pckitmsql->num_rows() > 0) {
			$srno = 1;
			foreach ($pckitmsql->result() as $pckitmsql_dtls) {
				$itmId = $pckitmsql_dtls->id;
				$lstinvoiceid = "fa-minus";
				$lstinvoicecls = "btn-danger";
				$fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
		?>

				<tr class="tr_clone auto-index 3">
					<td class="increment">
						<?= $srno; ?>
					</td>
					<td>



						<select name="i_name" id="item_name" required onchange="fnupdatetrmsinfo(this.value,'<?= $pckitmsql_dtls->id ?>','name')">
							<option value="">Choose</option>
							<?php
							foreach ($terms as $term) {
							?>
								<option value="<?php echo $term['sub_name']; ?>" <?php echo ($term['sub_name'] == $pckitmsql_dtls->name) ? "selected" : ""; ?>><?php echo $term['sub_name']; ?></option>
							<?php
							}
							?>
						</select>
						<!--<input type="text" class="form-control" name="i_name" id="item_name" required value="<?= $pckitmsql_dtls->name ?>" onchange="fnupdatetrmsinfo(this.value,'<?= $pckitmsql_dtls->id ?>','name')">-->

					</td>

					<td>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"></span>
								<input type="text" class="form-control" name="itmdesc" id="itmdesc1" value="<?= $pckitmsql_dtls->amount ?>" <?php echo ($pckitmsql_dtls->amount == "Remaining Balance" || $pckitmsql_dtls->amount == "Date" || $pckitmsql_dtls->amount == "Installment Date Amount") ? "readonly" : ""; ?> onchange="fnupdatetrmsinfo(this.value,'<?= $pckitmsql_dtls->id ?>','amount')">
							</div>
						</div>
					</td>

					<td>
						<button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> "><i class="fa <?= $lstinvoiceid ?>"></i></button>
					</td>
					<td>
						<input type="hidden" class="5" name="pcktot" id="pcktot" value="<?= $pckitmsql_dtls->amount ?>">
					</td>
				</tr>

		<?php $srno++;
			}
		}
		// else { 
		?>
		<tr class="tr_clone auto-index 4">
			<td class="increment">
				#
			</td>


			<td>

				<select name="i_name" id="item_name" required onchange="fninseartrmsinfo(this.value,'<?= $_POST['pckId'] ?>','name')">
					<option value="">Choose</option>
					<?php
					foreach ($terms as $term) {
					?>
						<option value="<?php echo $term['sub_name']; ?>"><?php echo $term['sub_name']; ?></option>
					<?php
					}
					?>
				</select>
				<!--<input type="text" class="form-control" name="i_name" id="item_name" required value="" onchange="fninseartrmsinfo(this.value,'<?= $_POST['pckId'] ?>','name')">-->

			</td>

			<td>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"></span>
						<input type="text" class="form-control" name="itmdesc" id="itmdesc1" value="" onchange="fninseartrmsinfo(this.value,'<?= $_POST['pckId'] ?>','amount')">
					</div>
				</div>
			</td>

			<td>
				<button onclick="fncrpitem('<?= $_POST['pckId'] ?>')" class="btn btn-xs btn-success "><i class="fa fa-plus"></i></button>
			</td>
			<td>
				<input type="hidden" class="6" name="pcktot" id="pcktot" value="">
			</td>
		</tr>
	<?php
		//   }
	}

	public function addappointmentdata($data)
	{
		$query = $this->db->insert('customer_appointment', $data);
		return $query;
	}

	public function insertinvnotes_dtls($cus_id)
	{
		$this->db->select('*');
		$this->db->from('invoices_create');
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		$query = $this->db->get();
		$re = $query->result_array();

		$invoice_type = $re[0]['invoice_type'];

		$feildname = $this->input->post('fieldnm');
		$insrtvarr = array(
			$feildname  => $this->input->post('inptxtval'),
			"inv_id"  => $this->input->post('invoiceid'),
			"user" => $this->session->userdata['fi_session']['id'],
			"cus_id" => $cus_id,
			"event_name" => $invoice_type
		);

		if ($this->db->insert('customer_invoice_notes', $insrtvarr)) {
			$note_id = $this->db->insert_id();
			$sumofpckgsql = $this->db->query("SELECT * FROM customer_invoice_notes WHERE  id='" . $note_id . "'");
			$getsumpckrow = $sumofpckgsql->row();
			if ($sumofpckgsql->date != "") {
				echo "success";
			} else {
				$get_time = $this->input->post('timenotes');
				$update_note_date = array(
					$feildname  => $this->input->post('inptxtval'),
					"date"  => date('Y-m-d'),
					"time" => $get_time
				);

				$this->db->where("id", $note_id);
				if ($this->db->update('customer_invoice_notes', $update_note_date)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		} else {
			echo "error";
		}
	}

	public function updateinvnotes_dtls()
	{
		$feildname = $this->input->post('fieldnm');
		if ($this->input->post('timenotes') != '') {
			$updateinvarr = array(
				$feildname  => $this->input->post('inptxtval'),
				"time" => $this->input->post('timenotes')

			);
		} else {
			$updateinvarr = array(
				$feildname  => $this->input->post('inptxtval')

			);
		}

		$this->db->where("id", $this->input->post('noteid'));
		if ($this->db->update('customer_invoice_notes', $updateinvarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function fnupdtejobdtlsinfo_dtls()
	{
		$feildname = $this->input->post('fieldnm');

		$updatejobarr = array(
			$feildname  => $this->input->post('txtinptval'),
			'jobs_start_time' => $this->input->post('start_time')
		);

		$this->db->where('id', $this->input->post('jbdId'));
		if ($this->db->update('event_jobs_dtls', $updatejobarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function updtpickupinfo_dtls()
	{
		$feildname = $this->input->post('fieldnm');
		$updatepckupdarr = array(
			$feildname  => $this->input->post('inptxtval')
		);
		$this->db->where('pid', $this->input->post('pckrcid'));
		if ($this->db->update('customers_pickup_items', $updatepckupdarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function fnloadevntjobinfo_dtls()
	{
		$eventId = $this->session->userdata('eventId');
	?>
		<div class="table-responsive">
			<table class="table table-hover no-margin">
				<thead>
				<tbody>
					<tr>
						<th style="display: none;">#</th>
						<th width="14%">Type</th>
						<th>First Name </th>
						<th>Spouse</th>
						<th width="6%">Children</th>
						<th><span class="inblock w90">Crew Member</th>
						<th>Start Time</th>
						<th width="25%">Note</th>
						<th>Phone </th>
						<th>Action</th>
					</tr>
				</tbody>
				<?php
				$event_jobs_dtls = "SELECT * FROM event_jobs_dtls WHERE event_id='" . $eventId . "' AND job_id='" . $_POST['jbId'] . "' ORDER BY id ASC";
				$jobinfodtls_data = $this->db->query($event_jobs_dtls);
				if ($jobinfodtls_data->num_rows() > 0) {
					foreach ($jobinfodtls_data->result() as $jobinfodtls_info) {
				?>
						<tbody id="myjobdetils" class="newwwww">
							<tr class="tr_clone myTableRow<?= $jobinfodtls_info->id ?>">
								<td style="display: none;">
									<input type="text" name="hdnjobId" class="form-control hdnjobId" value="<?= $_POST['jbId'] ?>">
									<input type="text" name="hdntbljobId" class="form-control hdntbljobId" value="<?= $jobinfodtls_info->id ?>">
								</td>
								<td>
									<select tabindex="-1" class="form-control" class="form-control" name="job_type" onchange="fnupdtejobdtls(this.value,'jobs_type','<?= $jobinfodtls_info->id ?>')">
										<option> Choose </option>
										<?php
										$getjbdtlssubcatlist = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=34");
										foreach ($getjbdtlssubcatlist->result() as $getjbdtlssubcatlist_dtls) {
											if ($jobinfodtls_info->jobs_type == $getjbdtlssubcatlist_dtls->sub_name) {
												$selsbcat = "selected";
											} else {
												$selsbcat = "";
											}
										?>
											<option <?= $selsbcat ?> value="<?= $getjbdtlssubcatlist_dtls->sub_name ?>"><?= $getjbdtlssubcatlist_dtls->sub_name ?></option>
										<?php
										} ?>
									</select>
								</td>
								<td>
									<input type="text" name="jfname" class="form-control fcap" value="<?= $jobinfodtls_info->jobs_fname ?>" onchange="fnupdtejobdtls(this.value,'jobs_fname','<?= $jobinfodtls_info->id ?>')">
								</td>
								<td>
									<input type="text" name="spouse" class="form-control fcap" value="<?= $jobinfodtls_info->jobs_spouse ?>" onchange="fnupdtejobdtls(this.value,'jobs_spouse','<?= $jobinfodtls_info->id ?>')">
								</td>
								<td>
									<input type="text" name="children" class="form-control fcap" value="<?= $jobinfodtls_info->jobs_children ?>" onchange="fnupdtejobdtls(this.value,'jobs_children','<?= $jobinfodtls_info->id ?>')">
								</td>
								<td>
									<select class="form-control" name="jbcrmemventype" onchange="fnupdtejobdtls(this.value,'jobs_crew_number','<?= $jobinfodtls_info->id ?>')">
										<option>Choose</option>
										<?php
										$event_crewsQuery   = "SELECT rv.cus_fname, rv.cus_id, ec.crews_vendor, ec.event_id FROM event_crews as ec LEFT JOIN register_vendor as rv ON rv.cus_id = ec.crews_vendor WHERE ec.event_id='" . $eventId . "'";
										$crvendor_sql       = $this->db->query($event_crewsQuery);
										$eventCrewsRes      = $crvendor_sql->result();

										foreach ($eventCrewsRes as $crvendorsql_dtls) {
											if (($crvendorsql_dtls->crews_vendor == $jobinfodtls_info->jobs_crew_number) && ($jobinfodtls_info->jobs_crew_number != '')) {
												$selcrewsvendr = "selected";
											} else {
												$selcrewsvendr = "";
											}
										?>
											<option <?= $crvendorsql_dtls->crews_vendor ?> <?= $selcrewsvendr ?> value="<?= $crvendorsql_dtls->crews_vendor ?>"><?= $crvendorsql_dtls->cus_fname ?></option>
										<?
										}
										?>
									</select>
								</td>
								<td><input type="text" placeholder="HH:MM" name="" class="form-control my_Time_CREWSF<?= $jobinfodtls_info->id ?>" onblur="my_Time_CREWSF(<?= $jobinfodtls_info->id ?>)" value="<?= date("h:i:sa", strtotime($jobinfodtls_info->jobs_start_time)) ?>"></td>
								<td><input type="text" name="jbnote" class="form-control fcap" value="<?= $jobinfodtls_info->jobs_note ?>" onchange="fnupdtejobdtls(this.value,'jobs_note','<?= $jobinfodtls_info->id ?>')"></td>
								<td><input type="text" name="jbphone" class="form-control contact_no" value="<?= $jobinfodtls_info->jobs_phone ?>" onchange="fnupdtejobdtls(this.value,'jobs_phone','<?= $jobinfodtls_info->id ?>')"></td>
								<td><a onclick="deletejobsub(<?= $jobinfodtls_info->id ?>)" class="btn btn-xs btn-danger"><i class="fa fa-minus "></i></a></td>
							</tr>
						</tbody>
				<?php
					}
				} ?>
				<tr class="tr_clone">
					<td style="display: none;">
						<input tabindex="-1" type="text" name="hdnjobId" class="form-control hdnjobId" value="<?= $_POST['jbId'] ?>">
						<input tabindex="-1" type="text" name="hdnevntId" class="form-control hdnevntId" value="<?= $eventId ?>">
					</td>
					<td>
						<select tabindex="-1" class="form-control lstjobtypedtls" name="job_type" id="job_type">
							<option> Choose </option>
							<?php
							$getjbdtlssubcatlist = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=34");
							foreach ($getjbdtlssubcatlist->result() as $getjbdtlssubcatlist_dtls) {
							?>
								<option value="<?= $getjbdtlssubcatlist_dtls->sub_name ?>"><?= $getjbdtlssubcatlist_dtls->sub_name ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input tabindex="-1" type="text" name="jfname[]" class="form-control fcap">
					</td>
					<td>
						<input tabindex="-1" type="text" name="spouse[]" class="form-control fcap">
					</td>
					<td>
						<input tabindex="-1" type="text" name="children[]" class="form-control fcap">
					</td>
					<td>
						<select tabindex="-1" class="form-control" name="jbcrmemventype[]">
							<option> Choose </option>
							<?php
							$crvendor_sql = $this->db->query("SELECT * FROM event_crews WHERE event_id='" . $eventId . "'");
							foreach ($crvendor_sql->result() as $crvendorsql_dtls) {
							?>
								<option value="<?= $crvendorsql_dtls->crews_vendor ?>"><?= $crvendorsql_dtls->crews_vendor ?></option>
							<?
							}
							?>
						</select>
					</td>
					<td>
						<input placeholder="HH:MM" tabindex="-1" type="text" name="jbstart_time[]" id="jbstart_time" class="form-control jbstart_time my_Time_CREWSF123" value="<?= $_POST['seteventstartdate'] ?>" onblur="my_Time_CREWSF(123)">
						<script type="text/javascript">
							function my_Time_CREWSF(my) {
								var my_Time = $('.my_Time_CREWSF' + my).val();
								var my_Time_count = my_Time.toString().length;
								var arr = ["00", "00"];
								if (my_Time_count == 4) {
									if (my_Time > 0 && my_Time < 1300) {
										arr = my_Time.match(/.{1,2}/g);
										var res = arr[0] + ":" + arr[1] + " PM";
										$('.my_Time_CREWSF' + my).val(res);
									} else {
										var num = my_Time - 1200;
										my_Time = num.toString();
										var my_Time_count = my_Time.toString().length;

										if (my_Time_count == 3) {
											my_Time = '0'.concat(my_Time);
										}
										if (my_Time > 0 && my_Time < 1300) {
											arr = my_Time.match(/.{1,2}/g);
											var res = arr[0] + ":" + arr[1] + " PM";
											$('.my_Time_CREWSF' + my).val(res);
										} else {
											alert("Time is not correct")
										}
									}
								} else if (my_Time_count > 4) {

									// alert("Value should be 4 digit");
								} else if (my_Time_count > 0) {
									//alert("Value should be 4 digit");
								}
							}
						</script>
					</td>
					<td><input tabindex="-1" type="text" name="jbnote[]" class="form-control fcap"></td>
					<td><input tabindex="-1" type="text" name="jbphone[]" class="form-control contact_no"></td>
					<td>

					</td>
				</tr>
				</thead>
			</table>
		</div>
		<?
	}

	public function updtinvtermsinfo_dtls()
	{
		$amt = $this->input->post('trmamt');
		if ($amt == "Installment Date Amount") {
			$amt = "";
		}

		$updateinvtermsarr = array(
			"name"      => $this->input->post('trmtype'),
			"amount"    => $amt,
			"totsts"    => $this->input->post('totsts')
		);

		$this->db->where('id', $this->input->post('trmid'));
		if ($this->db->update('tbl_invoice_terms', $updateinvtermsarr)) {
			$event_detail = $this->db->query("SELECT event_date FROM events_register WHERE inv_id='" . $_POST['invoiceid'] . "'")->row_array();
			$terminvsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'");
			$terminvsql_row = $terminvsql->row();
			$trminvsubtot = $terminvsql_row->invoice_amount;
			$terminvstotal_sql = $this->db->query("SELECT SUM(amount) AS amount FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' AND name!='Date' AND name!='Event Date'");
			$terminvstotalsql_row = $terminvstotal_sql->row();
			$trminvtotamount = $terminvstotalsql_row->amount;

			if ($trminvsubtot > $trminvtotamount) {
				$trmsum = $trminvsubtot - $trminvtotamount;
			} else {
				$trmsum = "0";
			}

			$invotermsql = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY id ASC");
			$chkinvtrmsql = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY id DESC LIMIT 1");
			$isinvtermsrow = $chkinvtrmsql->row();

			foreach ($invotermsql->result() as $invotermsql_dtls) {

				$invtrmsId = $invotermsql_dtls->id;

				if ($isinvtermsrow->id == $invtrmsId) {
					$lstinvtrmid = "fa-plus";
					$lstinvtrmcls = "btn-success";
					$fninvterms = "fncrterms('" . $invtrmsId . "','" . $_POST['invoiceid'] . "')";
				} else {

					$lstinvtrmid = "fa-minus";
					$lstinvtrmcls = "btn-danger";
					$fninvterms = "fndelterms('" . $invtrmsId . "','" . $_POST['invoiceid'] . "')";
				}

				if ($invotermsql_dtls->totsts == 1) {
					if ($isinvtermsrow->id == $invtrmsId) {
						$setamount = $trmsum;
						$disp = "display:block;";
						$rdonly = "disabled";
					} else {
						$setamount = $trmsum;
						$disp = "display:none;";
						$rdonly = "disabled";
					}
				} else {
					$setamount = $invotermsql_dtls->amount;
					$disp = "display:block;";
					$rdonly = "";
				}



		?>

				<tr class="tr_clone">
					<td>
						<input class="crntrmsid" type="hidden" name="crntrmsid" id="crntrmsid" value="<?= $invtrmsId ?>">
						<input class="trmsubtot" type="hidden" name="trmsubtot" id="trmsubtot" value="<?= $trminvsubtot ?>">
						<input class="trminvid" type="hidden" name="trminvid" id="trminvid" value="<?= $_POST['invoiceid'] ?>">
						<select class="form-control txttermstype 3" id="txttermstype" name="txttermstype">
							<option>Choose </option>
							<?php

							$admtermssql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $invotermsql_dtls->subcat_id . "' ORDER BY id ASC");

							foreach ($admtermssql->result() as $admtermssql_dtls) {
								if ($admtermssql_dtls->name == $invotermsql_dtls->name) {

									$selectitmtyp = "selected";
								} else {

									$selectitmtyp = "";
								}

							?>
								<option <?= $selectitmtyp ?> value="<?= $admtermssql_dtls->subcat_id ?>"><?= $admtermssql_dtls->name ?></option>

							<?php } ?>
						</select>
					</td>


					<?php
					if ($invotermsql_dtls->name == "Event Date") {
					?>
						<td>
							<date>
						</td>
						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>" disabled>
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $trmsum ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else if ($invotermsql_dtls->name == "Date") {
					?>
						<td></td>
						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $setamount ?>">
						</td>

						<td>
							<?php
							if ($event_detail['event_date'] != "" && $event_detail['event_date'] != "1970-01-01") {
								if ($setamount != "") {
									$aks = date('m/d/Y', strtotime($event_detail['event_date'] . ' ' . $setamount . ' days'));
								} else {
									$aks = date("m/d/Y", strtotime($event_detail['event_date']));
								}
							} else {
								$aks = "";
							}
							?>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $aks; ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else if ($invotermsql_dtls->name == "Installment Date Amount") {
						$dt = "";
						if ($invotermsql_dtls->dt != "0000-00-00" && $invotermsql_dtls->dt != "1970-01-01") {
							$dt = date("m/d/Y", strtotime($invotermsql_dtls->dt));
						}
					?>
						<td><input type="text" class="form-control aksdt d<?php echo $invotermsql_dtls->id; ?>" placeholder="mm/dd/yyyy" value="<?php echo $dt; ?>" onblur="update_field('tbl_invoice_terms','dt',this.value,'id',<?php echo $invotermsql_dtls->id; ?>,'date')" /></td>

						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>">
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $setamount ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else {
					?>
						<td></td>
						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>">
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $setamount ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					}
					?>
				</tr>
		<?php }
		}
	}

	//Prasanna 2020-11-05
	public function getvendorlist_dtls()
	{

		$apsubcat   = $this->input->post('apsubcat');
		$crewsID    = $this->input->post('crewsID');
		$cond       = array('crews_id' => $crewsID);
		$array_data = array('crews_type' => $apsubcat);
		$tbl        = "event_crews";
		$this->db->where($cond);
		$res        = $this->db->update($tbl, $array_data);

		$this->db->select('rv.cus_id, rv.cus_fname, rv.cus_lname');
		$this->db->from('vendor_rating as vr');
		$this->db->join('register_vendor as rv', 'rv.cus_id = vr.vendor_id');
		$this->db->where(array('vr.aptype' => $apsubcat));
		$this->db->order_by("vr.rating", "desc");
		$this->db->group_by("rv.cus_id");
		$query      = $this->db->get();
		$vendorsql  = $query->result_array();


		?>
		<option>Choose Vendor</option>
		<?php
		foreach ($vendorsql as $vendorsql_dtls) {
		?>
			<option value="<?= $vendorsql_dtls['cus_id'] ?>"> <?= $vendorsql_dtls['cus_fname'] ?> <?= $vendorsql_dtls['cus_lname'] ?></option>
			<?php
		}
	}

	//Prasanna 2020-12-17
	public function get_event_data_id($id)
	{
		$query = $this->db->select('*')
			->from('events_register')
			->where(array("cus_id" => $id))
			->order_by("event_date")
			->order_by("event_id desc")
			->get();
		return $query->result_array();
	}

	public function get_event_data_id_count($id)
	{
		if ($id != 0) {
			$query = $this->db->select('*')
				->from('events_register')
				->where(array("cus_id" => $id))
				->get();
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function get_locationt_data_id($id)
	{
		$query = $this->db->select('*')
			->from('event_location')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}

	public function get_crews_data_id($id)
	{
		$query = $this->db->select('*')
			->from('event_crews')
			->where(array("event_id" => $id))
			->get();
		return $query->result_array();
	}

	public function addvendor_dtls($item)
	{
		$query = $this->db->insert('register_vendor', $item);
		return $this->db->insert_id();
	}

	public function insertvendorlocation($location)
	{
		return $this->db->insert('vendor_event_location', $location);
	}

	public function insertvendorevent($data)
	{
		$query = $this->db->insert('vendor_events_register', $data);
		return $this->db->insert_id();
	}

	public function get_vend_event_data_id($id)
	{
		$query = $this->db->select('*')
			->from('vendor_events_register')
			->where(array("cus_id" => $id))
			->get();
		return $query->result_array();
	}

	public function insertaddlocation($item)
	{
		$query = $this->db->insert('add_location_event', $item);
		return $this->db->insert_id();
	}

	public function insertPackage($item)
	{
		$query = $this->db->insert('admin_package', $item);
		return $this->db->insert_id();
	}

	public function insertPackagesub($item)
	{
		$query = $this->db->insert('admin_package_item', $item);
		return $this->db->insert_id();
	}

	public function fnpckitems_dtls()
	{

		if ($this->input->post('$pckId') == '') {
			$pckId = 0;
		} else {
			$pckId = $_POST['pckId'];
		}

		$pckitmsql = $this->db->query("SELECT `i`.`id`, `i`.`item_name`, `i`.`item_quantity`, `i`.`item_price`, `i`.`item_desc`, `p`.`package_price`, `p`.`package_desc` FROM `admin_package_item` AS `i`,`admin_package` AS `p` WHERE `i`.`package_id` = `p`.`package_id` AND `i`.`package_id`='" . $pckId . "' AND `p`.`package_id` ='" . $pckId . "' ORDER BY `item_name` ASC");
		$chkitmsql = $this->db->query("SELECT * FROM admin_package_item WHERE package_id='" . $pckId . "' ORDER BY id DESC LIMIT 1");
		$isitmsrow = $chkitmsql->row();

		if ($pckitmsql->num_rows() > 0) {
			$srno = 1;
			foreach ($pckitmsql->result() as $pckitmsql_dtls) {
				$itmId = $pckitmsql_dtls->id;
				if ($isitmsrow->id == $itmId) {
					$lstinvoiceid = "fa-plus";
					$lstinvoicecls = "btn-success";
					$fninvoce = "fncrpitem('" . $pckitmsql_dtls->id . "')";
				} else {
					$lstinvoiceid = "fa-minus";
					$lstinvoicecls = "btn-danger";
					$fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
				}
			?>
				<tr class="tr_clone auto-index">
					<td class="increment"><?= $srno ?></td>
					<td>
						<select class="form-control 3" name="item_name<?= $itmId ?>" id="i2<?= $itmId ?>" style="width: 80px;" onchange="fnadmitemsinfo(this.value,'<?= $itmId ?>')">
							<option value="">Select</option>
							<?php
							$admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");
							foreach ($admitmsql->result() as $admitmsql_dtls) {
								if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {
									$selectitmtyp = "selected";
								} else {
									$selectitmtyp = "";
								}
							?>
								<option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>
							<?php
							} ?>
						</select>
					</td>

					<td>
						<input type="number" name="item_quantity<?= $itmId ?>" id="i1<?= $itmId ?>" min="1" class="form-control" value="<?= $pckitmsql_dtls->item_quantity ?>" style="width: 40px;" disabled>
					</td>

					<td>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-usd">

									</span>
								</span>
								<input type="text" onchange="fnupdateitemamountp(this.value,'<?= $itmId ?>')" name="item_amount<?= $itmId ?>" id="i4<?= $itmId ?>" class="form-control my_total_focus 2" style="width: 80px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_price) ?>">
							</div>
						</div>
					</td>

					<td>
						<input type="text" onchange="fnupdateitemdescp(this.value,'<?= $itmId ?>')" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control " value="<?= $pckitmsql_dtls->item_desc ?>" style="width: 400px;">
					</td>

					<td>
						<button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> "><i class="fa <?= $lstinvoiceid ?>"></i></button>
					</td>

					<input type="hidden" class="2" name="pcktot" id="pcktot" value="<?= sprintf('%0.2f', $pckitmsql_dtls->package_price) ?>">
					<input type="hidden" name="pckdesc" id="pckdesc" value="<?= $pckitmsql_dtls->package_desc ?>">
				</tr>
		<?php $srno++;
			}
		}
	}

	public function fngetadmpckjson_dtls()
	{
		$pckjson = 0;
		$admpcksql = $this->db->query("SELECT * FROM admin_item WHERE item_id='" . $_POST['admpckId'] . "'");
		foreach ($admpcksql->result() as $admpcksql_dtls) {
			$pckjson['admpackageitem'] = $admpcksql_dtls;
		}
		echo json_encode($pckjson);
	}

	public function newinrtevent_dtls()
	{
		$feildname = $this->input->post('fieldnm');
		$event_name = $this->input->post('evntname');

		if ($event_name == '') {
			$cus_query  = "SELECT * from register_customer where cus_id='" . $_POST['customrId'] . "'";
			$user_info  = $this->db->query($cus_query)->result_array()[0];
			$event_name = $user_info['cus_lname'];
		} else {
			$event_name = $this->input->post('evntname');
		}

		$newinvarr = array(
			"cus_id" => $_POST['customrId'],
			$feildname  => $this->input->post('inptxtval'),
			"event_name" => $event_name,
			"event_date" => "", //date("m/d/Y"),
			"event_end_date" => "", //date("m/d/Y"),
			"user" => $this->session->fi_session['id']
		);

		if ($this->db->insert('events_register', $newinvarr)) {
			$this->session->set_flashdata('success', "Event Created Successfully..!!");
			echo '<input type="hidden" name="nwhdnevntId" id="nwhdnevntId" value="' . $this->db->insert_id() . '" >';
			echo '<input type="hidden" name="responce" id="responce" value="success" >';
		} else {
			echo '<input type="hidden" name="responce" id="responce" value="error" >';
		}
	}

	public function allCustInfo($cName)
	{
		$id = $cName;
		$custs = $this->search_data();
		if ($id != "") {
			$this->db->select('*');
			$this->db->from('user_contact_info');
			$this->db->where('cus_id', $id);
			$this->db->where('default_contact', 1);
			$query = $this->db->get()->result_array()[0];

			$user_cntct = $this->db->query("SELECT * from user_contact_info WHERE cus_id = " . $id . " AND  default_contact = '1' AND conatct_type!='Email'");
			$dfcnt_row = $user_cntct->row();
		}
		?>

		<div class="box-body">
			<div class="row space3">
				<div class="col-md-3 lstpaytype_cus_col">
					<div class="form-group">
						<select class="form-control cust_search cus_notes" id="cus_notes" name="cus_notes" onchange="cust_search()">
							<option value="">Choose</option>
							<?php
							foreach ($custs as $cust) {  ?>
								<option style="font-size:13px;" value="<?= $cust['cus_id'] ?>"><?php print_r($cust['cus_lname'] . ", " . $cust['cus_fname'] . " - " . $cust['cus_company_name'] . " - " . $cust['cus_acc_no']); ?>
								</option>
							<?php
							} ?>
						</select>
					</div>
				</div>

				<div class="loaduppertabcntdtls">
					<div class="col-md-2">
						<div class="form-group">
							<input onchange="loadcustlistbyphone(this.value)" class="form-control fcap contact_no" id="phonenum" name="phonenum" type="text" value="<?= $dfcnt_row->contact_no ?>">
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<input class="form-control fcap" type="text" placeholder="">
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	public function allSearchVendsInfo($cName)
	{
		$id = $cName;
		if ($id != "") {
			$cntinfosql = $this->db->query("SELECT * FROM vender_contact_info WHERE cus_id='" . $id . "' AND default_contact=1 AND conatct_type!='Email'");
			$cntinfosql_row = $cntinfosql->row();

			$this->db->select('*');
			$this->db->from('invoices_create');
			$this->db->where('cust_id', $id);
			$this->db->order_by('invoice_id DESC');
			$this->db->limit(1);
			$singleinvinfo = $this->db->get()->result_array()[0];
			$custregsql = $this->db->query("SELECT * FROM register_vendor WHERE cus_id='" . $id . "'");
			$custregsqlrow = $custregsql->row();
			$balance_count = $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id', $id)->get('invoices_create')->result_array()[0];
		}
	?>
		<div class="col-md-2 contact_no">
			<div class="form-group" id="contact_info">
				<input class="form-control fcap contact_no" onchange="fncustomersearchbyphone(this.value)" type="text" id="topphone" name="topphone" value="<?= $cntinfosql_row->contact_no ?>" placeholder="Contact">
			</div>
		</div>
		<div class="col-md-2 cus_acc_no">
			<div class="form-group" id="lastinvId">
				<input class="form-control" type="text" placeholder="Acc no" value="<?= $custregsqlrow->cus_acc_no ?>">
			</div>
		</div>
		<div class="col-md-2 balance_count">
			<div class="form-group" id="lastinvduebal">
				<input class="form-control" type="text" placeholder="Balance" value="$ <?= sprintf('%0.2f', $balance_count['total']) ?>">
			</div>
		</div>
	<?php
	}

	public function allGeneralInfo($cName)
	{
		$id = $cName;
		if ($id != "") {
			$cust1      = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");
			$get_data   = $cust1->result_array()[0];
			$contact    = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();
			$user_contact       = $this->db->query("SELECT * from `user_contact_info` WHERE cus_id = '$id' and contact_no != 'null' ORDER BY contact_id ASC");
			$get_all_contacts   = $user_contact->result_array();
			$user_ship  = $this->db->query("SELECT * from `ship_address` WHERE `ship_user_id` = '$id'");
			$shipping   = $user_ship->result_array()[0];
		}

	?>
		<div class="col-md-6">
			<div class="box box-primary firstblock_bg">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="box-header with-border mb5">
								<p class="uhead2">Personal Info</p>
							</div>

							<input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
							<div class="form-horizontal">
								<div class="form-group nospacerow">
									<div class="col-sm-2">
										<select class="form-control fcap" name="title" id="title" required>
											<?php if ($get_data['cus_title'] != '') {
											?><option style="background:  grey;" value="<?= $get_data['cus_title'] ?>"><?= $get_data['cus_title'] ?></option>
											<?php
											}

											$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Prefix'");
											$cust_catval   = $cust_cat->result_array()[0];

											$cat_id = $cust_catval['id'];

											$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
											$cust_catval_list   = $cust_catli->result_array();


											?>
											<option value="">Prefix</option>
											<?php
											foreach ($cust_catval_list as $row) { ?>
												<option value="<?= $row['sub_name'] ?>"><?= $row['sub_name'] ?></option>
											<?php
											}


											?>
										</select>

									</div>

									<div class="col-sm-5">
										<input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">
									</div>

									<div class="col-sm-5">
										<input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name" required>
									</div>
								</div>

								<div class="form-group nospacerow">
									<div class="col-sm-12">
										<input class="form-control fcap group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">
									</div>
								</div>

								<div class="form-group nospacerow">
									<div class="col-sm-12">
										<input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">
									</div>
								</div>

								<div class="form-group nospacerow">
									<div class="col-sm-12">
										<input class="form-control fcap" id="cus_address2" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">
									</div>
								</div>

								<div class="form-group nospacerow">
									<div class="col-sm-7">
										<input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly tabindex="-1">
									</div>

									<div class="col-sm-3">
										<input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly tabindex="-1">
									</div>

									<div class="col-sm-2">
										<input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">
									</div>

								</div>


								<div class="form-group nospacerow">
									<div class="col-sm-3">
										<select class="form-control fcap" name="tax_status" tabindex="-1">
											<?php if ($get_data['sub_description'] != '') {
											?>

												<option style="background:  grey;" value="<?= $get_data['sub_description'] ?>"><?= $get_data['cus_title'] ?></option>
											<?php
											}

											$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Tax Status'");
											$cust_catval   = $cust_cat->result_array()[0];

											$cat_id = $cust_catval['id'];

											$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
											$cust_catval_list   = $cust_catli->result_array();
											?>
											<option value="">Tax Status</option>
											<?php
											foreach ($cust_catval_list as $row) { ?>
												<option value="<?= $row['sub_description'] ?>"><?= $row['sub_name'] ?></option>
											<?php
											}
											?>
										</select>


									</div>

									<div class="col-sm-3">
										<input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID" tabindex="-1">
									</div>

									<div class="col-sm-3">
										<input class="form-control" name="custom1" type="text" placeholder="Custom 1" tabindex="-1" value="<?php echo $get_data['custom1'] ?>">
									</div>

									<div class="col-sm-3">
										<input class="form-control" name="custom2" type="text" placeholder="Custom 2" tabindex="-1" value="<?php echo $get_data['custom2'] ?>">
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="col-md-6">

			<div class="box box-primary firstblock_bg ">
				<div class="box-body">
					<div class="row space3">
						<div class="col-md-12">
							<div class="box-header with-border mb5">
								<p class="uhead2 1">Contact Info</p>
							</div>
							<div class="form-horizontal">
								<?php
								$query = "SELECT * from `user_contact_info` WHERE cus_id = '$id' AND conatct_type IN('Home','Office','Mobile') ORDER BY contact_id ASC";
								$user_contact1 = $this->db->query($query);
								$usrcntnrows = $user_contact1->num_rows();
								if ($usrcntnrows == 0) { ?>
									<div class="cnt_clone">
										<div class="form-group">
											<div class="col-sm-3">
												<select name="cus_contact_type[]" class="form-control fcap mailevent" id="cus_contact_type">
													<option> Choose </option>
													<?php
													$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Contact Info'");
													$cust_catval   = $cust_cat->result_array()[0];
													$cat_id = $cust_catval['id'];
													$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
													$cust_catval_list   = $cust_catli->result_array();
													?>

													<?php
													foreach ($cust_catval_list as $row1) { ?>
														<option value="<?= $row1['sub_name'] ?>"><?= $row1['sub_name'] ?></option>
													<?php
													}                                                                       ?>
													?>
												</select>
											</div>
											<div class="col-sm-3">
												<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">
											</div>
											<div class="col-sm-3">
												<input type="text" class="form-control fcap cusnote" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
											</div>
											<div class="col-sm-3">
												<label class="switch">
													<input class="fnchkphoneno" type="checkbox" name="radio_click[]" checked value="on">
													<span class="slider round"></span>
												</label>
												<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
											</div>

										</div>
									</div><?php
										} else {
											foreach ($get_all_contacts as $allContacts) {
												if ($allContacts['default_contact'] == 0) {
											?>

											<div class="cnt_clone">
												<div class="form-group">
													<div class="col-sm-3">
														<select name="cus_contact_type[]" class="form-control fcap mailevent" id="cus_contact_type">
															<option> Choose </option>
															<?php
															$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Contact Info'");
															$cust_catval   = $cust_cat->result_array()[0];

															$cat_id = $cust_catval['id'];

															$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
															$cust_catval_list   = $cust_catli->result_array();
															?>

															<?php
															foreach ($cust_catval_list as $row1) { ?>
																<option value="<?= $row1['sub_name'] ?>"><?= $row1['sub_name'] ?></option>
															<?php
															}                                                                       ?>
															<?php
															foreach ($contact as $cont) {
																if ($allContacts['conatct_type'] == $cont['sub_name']) {
																	$selectedcls = "selected";
																} else {
																	$selectedcls = "";
																}
															?>
																<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php  }

															?>
														</select>
													</div>
													<div class="col-sm-3">
														<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">
													</div>
													<div class="col-sm-3">
														<input type="text" class="form-control cusnote fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
													</div>
													<div class="col-sm-3">
														<label class="switch">
															<input class="fnchkphoneno" type="text" name="radio_click[]" value="off">
															<span class="slider round"></span>
														</label>
														<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
													</div>
												</div>
											</div>
										<?php } else if ($allContacts['default_contact'] == 1) {
										?>
											<div class="cnt_clone">
												<div class="form-group">
													<div class="col-sm-3">
														<select name="cus_contact_type[]" class="form-control fcap mailevent" id="cus_contact_type">
															<option> Choose </option>
															<?php
															foreach ($contact as $cont) {

																if ($allContacts['conatct_type'] == $cont['sub_name']) {
																	$selectedcls = "selected";
																} else {
																	$selectedcls = "";
																}
															?>
																<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php

															} ?>
														</select>
													</div>
													<div class="col-sm-3">
														<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">
													</div>
													<div class="col-sm-3">
														<input type="text" class="form-control fcap cusnote" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">
													</div>
													<div class="col-sm-3">
														<label class="switch">
															<input class="fnchkphoneno" type="radio" name="radio_click[]" <?php if ($allContacts['default_contact'] == 1) echo 'checked'; ?> value="on">

															<span class="slider round"></span>
														</label>
														<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
														<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
													</div>

												</div>
											</div>
								<?php }
											}
										} ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box box-primary firstblock_bg ">
				<div class="box-body">
					<div class="row space3">
						<div class="col-md-12">
							<div class="box-header with-border mb5">
								<p class="uhead2 1">Email Info</p>
							</div>
							<div class="form-horizontal">
								<?php
								$sub_sql =  "SELECT `s`.`sub_name` 
                              FROM `categories` c
                              LEFT JOIN `sub_categories` `s` 
                              ON `c`.`id` = `s`.`cat_id`
                              WHERE `cat_name` = 'Email'";
								$user_contact2 = $this->db->query("SELECT * from `user_contact_info` WHERE cus_id = '$id' AND conatct_type IN($sub_sql) ORDER BY contact_id ASC");
								$usremlcntnrows = $user_contact2->num_rows();
								$cont_emails   = $user_contact2->result_array();
								foreach ($cont_emails as $row) { ?>
									<div class="cnt_clone">
										<div class="form-group">
											<div class="col-sm-3">
												<select name="cuscnt_type_email[]" class="form-control fcap mailevent 5">
													<option style="background:  grey;" value="<?= $row['conatct_type'] ?>"><?= $row['conatct_type'] ?></option>
													<?php
													$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Email'");
													$cust_catval   = $cust_cat->result_array()[0];

													$cat_id = $cust_catval['id'];

													$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
													$cust_catval_list   = $cust_catli->result_array();
													?>
													<option value="">Choose</option>
													<?php
													foreach ($cust_catval_list as $row1) { ?>
														<option value="<?= $row1['sub_name'] ?>"><?= $row1['sub_name'] ?></option>
													<?php
													}                                                                       ?>
												</select>
											</div>

											<div class="col-sm-3">
												<input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?= $row['email'] ?>">
											</div>
											<div class="col-sm-3">
												<a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
											</div>
											<div class="col-sm-3">
												<label class="switch">
													<input class="fnchkemailId" type="checkbox" name="email_radio_click[]" value="<?php if ($row['default_contact'] == 1) {
																																		echo 'on';
																																	} else {
																																		echo 'off';
																																	} ?>" <?php if ($row['default_contact'] == 1) {
																																				echo 'checked';
																																			} else {
																																				echo '';
																																			} ?>>
													<span class="slider round"></span>
												</label>
												<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
											</div>
										</div>
									</div> <?php
										}


										if ($usremlcntnrows == 0) {
											?>
									<div class="cnt_clone">
										<div class="form-group">
											<div class="col-sm-3">
												<select name="cuscnt_type_email[]" class="form-control fcap mailevent 6">

													<?php
													foreach ($contact as $cont) {
														if ($cont['sub_name'] == "Email") {

													?>
															<option selected value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
													<?php  }
													} ?>
													<?php
													$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Email'");
													$cust_catval   = $cust_cat->result_array()[0];

													$cat_id = $cust_catval['id'];

													$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
													$cust_catval_list   = $cust_catli->result_array();
													?>
													<option value="">Choose</option>
													<?php
													foreach ($cust_catval_list as $row1) { ?>
														<option value="<?= $row1['sub_name'] ?>"><?= $row1['sub_name'] ?></option>
													<?php
													}                                                                       ?>
												</select>
											</div>
											<div class="col-sm-3">
												<input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>" onchange="ValidateEmail(this)">
											</div>
											<div class="col-sm-3">
												<a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
											</div>
											<div class="col-sm-3">
												<label class="switch">
													<input class="fnchkemailId" type="checkbox" name="email_radio_click[]" checked value="on">
													<span class="slider round"></span>
												</label>
												<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
											</div>
										</div>
									</div>
								<?php
										} elseif ($allContacts['default_contact'] != 1) {


								?>
									<div class="cnt_clone">
										<div class="form-group">
											<div class="col-sm-3">
												<select name="cuscnt_type_email[]" class="form-control fcap mailevent 7">
													<?php

													$cust_cat      = $this->db->query("SELECT * FROM `categories`WHERE `cat_name`='Email'");
													$cust_catval   = $cust_cat->result_array()[0];

													$cat_id = $cust_catval['id'];

													$cust_catli      = $this->db->query("SELECT `sub_name` FROM `sub_categories` WHERE cat_id='" . $cat_id . "'");
													$cust_catval_list   = $cust_catli->result_array();
													?>
													<option value="">Choose</option>
													<?php
													foreach ($cust_catval_list as $row) { ?>
														<option value="<?= $row['sub_name'] ?>"><?= $row['sub_name'] ?></option>
													<?php
													} ?>
												</select>



											</div>
											<div class="col-sm-3">
												<input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>">
											</div>
											<div class="col-sm-3">
												<a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>
											</div>
											<div class="col-sm-3">
												<label class="switch">
													<input class="fnchkemailId" type="text" name="email_radio_click[]" value="off">
													<span class="slider round"></span>
												</label>
												<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
											</div>
										</div>
									</div>
									<?php }


										foreach ($get_all_contacts as $allContacts) {

											if ($allContacts['conatct_type'] == "Email") {

												if ($allContacts['default_contact'] == 1) {



									?>

											<div class="cnt_clone">

												<div class="form-group">

													<div class="col-sm-3">

														<select name="cuscnt_type_email[]" class="form-control fcap mailevent 8">
															<option> </option>
															<?php

															foreach ($contact as $cont) {
																if ($cont['sub_name'] != "Mobile" &&  $cont['sub_name'] != "Office" &&  $cont['sub_name'] != "Mobile") {

															?>
																	<option selected value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php  }
															} ?>

														</select>

													</div>


													<div class="col-sm-3">

														<input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>" onchange="ValidateEmail(this)">

													</div>

													<div class="col-sm-3">

														<a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>

													</div>

													<div class="col-sm-3">

														<label class="switch">

															<input class="fnchkemailId" type="checkbox" name="email_radio_click[]" checked value="on">

															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
													</div>
												</div>

											</div>
								<?php }
											}
										}

								?>



							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="col-md-6">

			<div class="box box-default collapsed-box firstblock_bg ">

				<div class="box-header with-border">

					<div class="col-md-5">
						<p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
					</div>

					<div class="col-md-5">
						<div class="checkbox uhead2">

							<?php
							if ($shipping['billing_addr_status'] == "1") {
								$chkstatus = "checked";
							} else {
								$chkstatus = "";
							}
							?>
							<label><input <?= $chkstatus ?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()" tabindex="1">Same as billing address</label>
						</div>
					</div>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" tabindex="2"><i class="fa fa-plus"></i>

						</button>

					</div>



				</div>



				<div class="box-body" id="billaddress">
					<div class="form-horizontal">
						<div class="form-group nospacerow">
							<div class="col-sm-4">
								<input class="form-control fcap" name="shipcusname" id="shipcusname" type="text" placeholder="Name" value="<?= $shipping['ship_cusname'] ?>" tabindex="3">
							</div>
							<div class="col-sm-4">
								<input class="form-control fcap" id="cus_ship_address1" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1" tabindex="4">
							</div>
							<div class="col-sm-4">
								<input class="form-control fcap" id="cus_ship_address2" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2" tabindex="5">
							</div>
						</div>
						<div class="form-group nospacerow">
							<div class="col-sm-4">
								<input class="form-control fcap text-center" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">
							</div>
							<div class="col-sm-4">
								<input class="form-control fcap text-center" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">
							</div>
							<div class="col-sm-4">
								<input class="form-control fcap text-center" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()" tabindex="8">
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="clearfix"></div>
		<div class="col-md-12">
			<div class="box box-primary fourthblock_bg">
				<div class="box-body">
					<div class="table-responsive">
						<div class="row mlr0">
							<div class="col-sm-3">
								<p class="uhead2">Additional Contacts Info</p>
							</div>


						</div>
						<br>
						<?php
						$aditional_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $id . "' AND con_type IS NULL ORDER BY id DESC");
						$aditional_nrows = $aditional_sql->num_rows();
						if ($aditional_nrows > 0) {
							$disptbl = "display:block";
						} else {
							$disptbl = "display:block";
						}
						?>
						<div class="additionalcnt" style="<?= $disptbl ?>">

							<table class="table table-hover no-margin fixed_table" cellspacing="10">
								<thead>
									<tr>
										<th class="w100">Type</th>
										<th class="w100">Name</th>
										<th>Address</th>
										<th class="w100">City</th>
										<th class="w100">State</th>
										<th class="w80">Zip</th>
										<th class="w120">Home</th>
										<th class="w120">Mobile</th>
										<th>Work</th>
										<th class="w200">Email</th>
										<th class="w30">#</th>
										<th class=" ">Event</th>
										<th class="w50">Action</th>
									</tr>
								</thead>

								<thead id="divfilteraddicnt">
									<?php
									$addicnt_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $id . "' AND con_type IS NULL ORDER BY id LIMIT 1 ");
									$addicnt_row = $addicnt_sql->row();
									$additional_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $id . "' AND con_type IS NULL ORDER BY id DESC");
									$additional_nrows = $additional_sql->num_rows();
									if (count($additional_nrows) > 0) {
										foreach ($additional_sql->result() as $additionalsql_dtls) {
											$btncls = "btn-danger cnt_clone_remove";
											$icls = "fa-minus";
											$fndel = "onclick=fndeleteaddicnt(" . $additionalsql_dtls->id . ")";
									?>

											<tr class="tr_clone">
												<td>
													<select class="form-control" name="job_type">
														<option value="<?= $additionalsql_dtls->type ?>"><?= $additionalsql_dtls->type ?></option>
														<?php
														$type = $this->db->where('cat_id', 14)->get('sub_categories');
														$type = $type->result();
														foreach ($type as $row) {
															if ($row->sub_name == $additionalsql_dtls->type) {
																$selapcat = "selected";
															} else {
																$selapcat = "";
															}
														?>
															<option <?= $selapcat ?> value="<?= $row->sub_name ?>"><?= $row->sub_name ?></option>
														<?php  } ?>

													</select>
												</td>


												<td><input type="text" name="name[]" class="form-control fcap updwn" value="<?= $additionalsql_dtls->name ?>"></td>
												<td><input type="text" name="address[]" class="form-control fcap updwn" value="<?= $additionalsql_dtls->address ?>"></td>
												<td><input type="text" name="city[]" id="adcity" class="form-control fcap adcity text-center" value="<?= $additionalsql_dtls->city ?>" readonly tabindex="-1"></td>
												<td><input type="text" name="state[]" id="adstate" class="form-control fcap adstate text-center" value="<?= $additionalsql_dtls->state ?>" readonly tabindex="-1"></td>
												<td><input type="text" name="zip[]" id="zip" class="form-control fcap zip updwn text-center" value="<?= $additionalsql_dtls->zip ?>" onkeydown="fnOnlyNUmbers()"></td>
												<td><input type="text" name="home[]" class="form-control fcap contact_no updwn text-center" value="<?= $additionalsql_dtls->home ?>"></td>
												<td><input type="text" name="cel[]" class="form-control fcap contact_no updwn text-center" value="<?= $additionalsql_dtls->cel ?>"></td>
												<td><input type="text" name="work[]" class="form-control fcap contact_no updwn text-center" value="<?= $additionalsql_dtls->work ?>"></td>
												<td><input type="text" name="emailaddr[]" class="form-control updwn text-center email9" value="<?= $additionalsql_dtls->email ?>"></td>
												<td> <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a></td>
												<td>
													<select name="cuscnt_type_event_name[]" class="form-control fcap mailevent">
														<option> </option>
														<?php
														$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $id . "' ORDER BY event_id ASC ")->result();

														foreach ($evntypsql as $cont) {
															$j == 0;
															if ($cont->event_date != "") {
																$con_date = date("m/d/Y", strtotime($cont->event_date));
															} else {
																$con_date = "";
															}

															$eventname = $cont->event_name;
															$eventname = str_replace('-', ' - ', $eventname);

															$eventname = $eventname . " - " . $con_date . " - " . $cont->event_type;


														?>
															<option <?php echo ($additionalsql_dtls->event_name == $eventname) ? "selected" : "";  ?> value="<?php echo $eventname; ?>"><?php echo $eventname; ?></option>
														<?php $j++;
														} ?>

													</select>
												</td>
												<td>

													<a <?= $fndel ?>class="btn btn-xs <?= $btncls ?>"><i class="fa <?= $icls ?>"></i></a>
												</td>
											</tr>
										<?php  } ?>
										<tr class="tr_clone">
											<td>
												<select class="form-control" name="job_type">
													<option value="">Choose</option>
													<?php
													$type = $this->db->where('cat_id', 14)->get('sub_categories');
													$type = $type->result();
													foreach ($type as $row) {
														if ($row->sub_name == $additionalsql_dtls->type) {
															$selapcat = "selected";
														} else {
															$selapcat = "";
														}
													?>
														<option <?= $selapcat ?> value="<?= $row->sub_name ?>"><?= $row->sub_name ?></option>
													<?php  } ?>

												</select>
											</td>
											<td><input type="text" name="name[]" class="form-control fcap updwn"></td>
											<td><input type="text" name="address[]" class="form-control fcap updwn"></td>
											<td><input type="text" name="city[]" id="adcity" class="form-control fcap adcity text-center" readonly tabindex="-1"></td>
											<td><input type="text" name="state[]" id="adstate" class="form-control fcap adstate text-center" readonly tabindex="-1"></td>
											<td><input type="text" name="zip[]" id="zip" class="form-control fcap zip updwn text-center"></td>
											<td><input type="text" name="home[]" class="form-control fcap contact_no updwn text-center"></td>
											<td><input type="text" name="cel[]" class="form-control fcap contact_no updwn text-center"></td>
											<td><input type="text" name="work[]" class="form-control fcap contact_no updwn text-center"></td>
											<td><input type="text" name="emailaddr[]" class="form-control updwn text-center email9"></td>
											<td> <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a></td>
											<td>
												<select name="cuscnt_type_event_name[]" class="form-control fcap mailevent">
													<option> </option>
													<?php
													$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $id . "' ORDER BY event_id ASC ")->result();

													foreach ($evntypsql as $cont) {
														if ($cont->event_date != "") {
															$con_date = date("m/d/Y", strtotime($cont->event_date));
														} else {
															$con_date = "";
														}

														$eventname = $cont->event_name;
														$eventname = str_replace('-', ' - ', $eventname);

														$eventname = $eventname . " - " . $con_date . " - " . $cont->event_type;

													?>
														<option value="<?php echo $eventname; ?>"><?php echo $eventname; ?></option>
													<?php   } ?>

												</select>
											</td>

											<td>

												<button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>

											</td>

										</tr>


									<?php } else {


										$addicnt_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $id . "' ORDER BY id DESC");
										$addicnt_nrows = $addicnt_sql->num_rows();

										if ($addicnt_nrows == 0) {
											$disptbls = "display:table";
										} else {
											$disptbls = "display:table";
										}


									?>

										<tr class="tr_clone additionalcnt-row" style="<?= $disptbls ?>">
											<td>
												<select class="form-control" name="job_type">
													<option value="">Choose</option>
													<?php
													$type = $this->db->where('cat_id', 14)->get('sub_categories');
													$type = $type->result();
													foreach ($type as $row) {
														if ($row->sub_name == $additionalsql_dtls->type) {
															$selapcat = "selected";
														} else {
															$selapcat = "";
														}
													?>
														<option <?= $selapcat ?> value="<?= $row->sub_name ?>"><?= $row->sub_name ?></option>
													<?php  } ?>

												</select>
											</td>
											<td><input type="text" name="name[]" class="form-control fcap updwn"></td>
											<td><input type="text" name="address[]" class="form-control fcap updwn"></td>
											<td><input type="text" name="city[]" id="adcity" class="form-control fcap adcity" readonly tabindex="-1"></td>
											<td><input type="text" name="state[]" id="adstate" class="form-control fcap adstate" readonly tabindex="-1"></td>
											<td><input type="text" name="zip[]" id="zip" class="form-control fcap zip updwn"></td>
											<td><input type="text" name="home[]" class="form-control fcap contact_no updwn"></td>
											<td><input type="text" name="cel[]" class="form-control fcap contact_no updwn"></td>
											<td><input type="text" name="work[]" class="form-control fcap contact_no updwn"></td>
											<td><input type="text" name="emailaddr[]" class="form-control updwn email9"></td>
											<td> <a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a></td>
											<select name="cuscnt_type_event_name[]" class="form-control fcap mailevent">
												<option> </option>
												<?php
												$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $id . "' ORDER BY event_id ASC ")->result();

												foreach ($evntypsql as $cont) {
													if ($cont->event_date != "") {
														$con_date = date("m/d/Y", strtotime($cont->event_date));
													} else {
														$con_date = "";
													}

													$eventname = $cont->event_name;
													$eventname = str_replace('-', ' - ', $eventname);

													$eventname = $eventname . " - " . $con_date . " - " . $cont->event_type;

												?>
													<option value="<?php echo $eventname; ?>"><?php echo $eventname; ?></option>
												<?php   } ?>

											</select>

											<td>
												<button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
											</td>
										</tr>
									<?php
									} ?>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-12 text-center">
			<button style="margin: 0 5px;" name="Save" id="Save" class="btn btn-lg btn-info btn-flat">Save</button>
			<button name="Submit" id="Submit" class="btn btn-lg btn-info btn-flat">Save & Continue</button>
		</div>
	<?php
	}

	public function getVendContactInfo_dtls($cName)
	{
		$id = $cName;
		$venders = $this->vendor_search_data();
		$this->db->select('*');
		$this->db->from('vender_contact_info');
		$this->db->where('cus_id', $id);
		$this->db->where('default_contact', 1);
		$query = $this->db->get()->result_array()[0];
	?>
		<div class="col-md-12">
			<div class="box box-info vendor_sec titlen_search">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<h3 class="uhead1">GENERAL INFO</h3>
						</div>
						<div class="col-sm-7 col-md-8">
							<div class="pull-right">
								<ul class="list-inline topul">

									<li><a href="#" class="uhead2"> Options </a></li>
									<li><button class="btn btn-default"> <i class="fa fa-print"></i></button> </li>
								</ul>
								<a href="<?= site_url('Vendor/GeneralInfo') ?>" class="btn btn-md btn-info btn-flat">New Vendor</a>
							</div>
						</div>
					</div>
				</div>

				<div class="box-body">
					<div class="row space3">
						<div class="col-md-3 lstpaytype_cus_col">
							<div class="form-group">
								<select class="form-control fcap" id="cust_nm" onchange="loadcustlist()">
									<option>Choose Vendor</option>
									<?php foreach ($venders as $cust) {
										if ($_POST['name'] == $cust['cus_id']) {
											$selectedcls = "selected";
										} else {
											$selectedcls = "";
										}
									?>
										<option <?= $selectedcls ?> value="<?php echo $cust['cus_id'] ?>"><?php print_r($cust['cus_lname'] . ", " . $cust['cus_company_name']); ?></option><?php
																																														} ?>
								</select>
							</div>
						</div>
						<div class="col-md-2 contact_no">
							<div class="form-group ">
								<input onchange="loadcustlistbyphone(this.value)" class="form-control fcap contact_no " id="phonenum" name="phonenum" type="text" value="<?php echo $query['contact_no'] ?>" placeholder="Contact">
							</div>
						</div>
						<div class="col-md-2 cus_acc_no">
							<div class="form-group">
								<input class="form-control fcap" type="text" placeholder="Acc no">
							</div>
						</div>
						<div class="col-md-2 balance_count">
							<div class="form-group">
								<input class="form-control fcap text-right" type="text" placeholder="Balance ">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php
	}



	public function updtevent_dtls()
	{
		$feildname    = $this->input->post('fieldnm');
		$event_guest  = $this->input->post('event_guest');
		$dynamic      = $this->input->post('dynamic');
		$dynamic2     = $this->input->post('dynamic2');
		$events_date  = $this->input->post('events_date');



		$updateinvarr = array(
			$feildname          => $this->input->post('inptxtval')
		);

		if ($this->input->post('fieldnm') == 'event_note') {
			$updateinvarr['event_date']     = date('m/d/Y', strtotime($events_date));
		}

		$updateinvarr['event_time']     = $dynamic;
		$updateinvarr['event_end_time'] = $dynamic2;
		$updateinvarr['event_guest']    = $event_guest;

		$this->db->where('event_id', $this->input->post('eventid'));

		if ($this->db->update('events_register', $updateinvarr)) {
			$this->session->set_flashdata('success', "Event Updated Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}



	public function fncrnewevent_dtls()
	{
		$postinvarr = array(
			"cus_id" => $_POST['customrId'],
			"event_type" => "Wedding"
		);
		if ($this->db->insert('events_register', $postinvarr)) {
			$this->session->set_flashdata('success', "Event Created Successfully..!!");
			echo "<input type='hidden' name='responce' id='responce' value='success'>";
		} else {
			echo "<input type='hidden' name='responce' id='responce' value='error'>";
		}
	}

	public function search_customer($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $accno, $acctype, $vendorname, $evfdate, $evtdate, $evtype, $evtlocn, $evtinv_no, $evtreff_by, $bal_as_of)
	{
		$user = $this->session->fi_session['id'];
		$con1 = "o.user = '" . $user . "'";
		if ($fname != "") {
			$con1 = $con1 . " AND " . 'o.cus_fname LIKE "%' . $fname . '%" OR o.cus_lname LIKE "%' . $fname . '%" OR o.cus_company_name LIKE "%' . $fname . '%" OR c.cus_id IN (SELECT Distinct cus_id FROM events_register where event_name LIKE "%' . $fname . '%" OR event_id IN (SELECT event_id FROM `event_jobs` WHERE jb_name LIKE "%' . $fname . '%"))';
		}
		if ($lname != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_lname LIKE "%' . $lname . '%"';
			} else {
				$con1 = 'o.cus_lname LIKE "' . $lname . '%"';
			}
		}
		if ($cname != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_company_name LIKE "%' . $cname . '%"';
			} else {
				$con1 = 'o.cus_company_name LIKE "%' . $cname . '%"';
			}
		}
		if ($zname != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_zip LIKE "%' . $zname . '%"';
			} else {
				$con1 = 'o.cus_zip LIKE "%' . $zname . '%"';
			}
		}
		if ($mname != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'c.contact_no LIKE "%' . $mname . '%"';
			} else {
				$con1 = 'c.contact_no LIKE "%' . $mname . '%" OR c.cus_id IN (SELECT Distinct cus_id FROM customer_additional_contacts where cel LIKE "%' . $mname . '%" OR home LIKE "%' . $mname . '%" OR work LIKE "%' . $mname . '%")';
			}
		}
		if ($adr1 != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_address1 LIKE "%' . $adr1 . '%" OR o.cus_zip LIKE "%' . $adr1 . '%" OR o.cus_address2 LIKE "%' . $adr1 . '%" OR o.cus_city LIKE "%' . $adr1 . '%" OR o.cus_state LIKE "%' . $adr1 . '%"';
			} else {
				$con1 = 'o.cus_address1 LIKE "%' . $adr1 . '%" OR o.cus_zip LIKE "%' . $adr1 . '%" OR o.cus_address2 LIKE "%' . $adr1 . '%" OR o.cus_city LIKE "%' . $adr1 . '%" OR o.cus_state LIKE "%' . $adr1 . '%"';
			}
		}
		if ($adr2 != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			} else {
				$con1 = 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			}
		}
		if ($cities != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_city LIKE "%' . $cities . '%"';
			} else {
				$con1 = 'o.cus_city LIKE "%' . $cities . '%"';
			}
		}
		if ($states != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_state LIKE "%' . $states . '%"';
			} else {
				$con1 = 'o.cus_state LIKE "%' . $states . '%"';
			}
		}
		if ($area != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.custom1 LIKE "%' . $area . '%" OR o.custom2 LIKE "%' . $area . '%"';
			} else {
				$con1 = 'o.custom1 LIKE "%' . $area . '%" OR o.custom2 LIKE "%' . $area . '%"';
			}
		}
		if ($accno != "") {
			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_acc_no LIKE "%' . $accno . '%"';
			} else {
				$con1 = 'o.cus_acc_no LIKE "%' . $accno . '%"';
			}
		}
		if ($acctype != "") {
			if ($con1 != "") {
				if ($acctype == 1) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked = 1)";
				} elseif ($acctype == 2) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_lost = 1)";
				} elseif ($acctype == 0) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked=0 AND event_lost = 0)";
				}
			} else {
				if ($acctype == 1) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked = 1)";
				} elseif ($acctype == 2) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_lost = 1)";
				} elseif ($acctype == 0) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked=0 AND event_lost = 0)";
				}
			}
		}
		if ($vendorname != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN(SELECT event_id FROM event_crews WHERE crews_vendor LIKE '%" . $vendorname . "%' ))";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN(SELECT event_id FROM event_crews WHERE crews_vendor LIKE '%" . $vendorname . "%') )";
			}
		}
		if ($evfdate != "" && $evtdate != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date >='" . $evfdate . "' AND event_end_date <='" . $evtdate . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date >='" . $evfdate . "' AND event_end_date <='" . $evtdate . "')";
			}
		} elseif ($evfdate != "" && $evtdate == "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date ='" . $evfdate . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date ='" . $evfdate . "')";
			}
		} elseif ($evtdate != "" && $evfdate == "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_end_date ='" . $evtdate . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_end_date ='" . $evtdate . "')";
			}
		}
		if ($evtype != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_type ='" . $evtype . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_type ='" . $evtype . "')";
			}
		}
		if ($evtlocn != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN (SELECT event_id FROM event_location WHERE location_type='" . $evtlocn . "' ))";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN (SELECT event_id FROM event_location WHERE location_type='" . $evtlocn . "'))";
			}
		}
		if ($evtinv_no != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cust_id FROM invoices_create WHERE invoice_id='" . $evtinv_no . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cust_id FROM invoices_create WHERE invoice_id='" . $evtinv_no . "')";
			}
		}
		if ($evtreff_by != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_referred_by LIKE '%" . $evtreff_by . "%')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_referred_by LIKE '%" . $evtreff_by . "%')";
			}
		}
		if ($bal_as_of != "") {
			if ($con1 != "") {
				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cust_id FROM invoices_create GROUP BY cust_id HAVING SUM(invoice_balance_due)='" . $bal_as_of . "')";
			} else {
				$con1 = "o.cus_id IN (SELECT Distinct cust_id FROM invoices_create GROUP BY cust_id HAVING SUM(invoice_balance_due)='" . $bal_as_of . "')";
			}
		}

		$sql = "SELECT * from user_contact_info AS c,register_customer AS o WHERE " . $con1 . " AND c.cus_id = o.cus_id  GROUP BY o.cus_id ORDER BY o.cus_lname, o.cus_fname";
		$cust1 = $this->db->query($sql);
		$cust1_dtls = $cust1->result();

		if ($cust1->num_rows() > 0) {
			$srno = 1;
			foreach ($cust1_dtls as $cust1_dtls) {
				$phonarr = array();
				$notesarr = array();
				$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '" . $cust1_dtls->cus_id . "'");
				foreach ($cntinfosql->result() as $cntinfosql) {
					$phonarr[] .= $cntinfosql->contact_no;
					$notesarr[] .= $cntinfosql->user_contact_note;
				}
				$setnotes = implode(",", $notesarr);
				$setphones = implode(",", $phonarr);
				$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$cust1_dtls->cus_id' AND conatct_type!='Email' AND default_contact=1");
				$cntctinfosql_row = $cntctinfosql->row();
				$htmlphone = $cntctinfosql_row->contact_no;
				$htmlnotes = $cntctinfosql_row->user_contact_note;

				//search_customer_opt
				$act_custsql = $this->db->query("SELECT * FROM search_customer_opt where user ='" . $this->session->fi_session['id'] . "'");
				$act_custrow = $act_custsql->row();

				$getfname           = $act_custrow->cus_fname;
				$getlname           = $act_custrow->cus_lname;
				$getcname           = $act_custrow->cus_company_name;
				$getaddr1           = $act_custrow->cus_address1;
				$getaddr2           = $act_custrow->cus_address2;
				$getcity            = $act_custrow->cus_city;
				$getstate           = $act_custrow->cus_state;
				$getzip             = $act_custrow->cus_zip;
				$getarea            = $act_custrow->cus_area;
				$getphno            = $act_custrow->phone_no;
				$getacc_no          = $act_custrow->acc_no;
				$getacc_type        = $act_custrow->acc_type;
				$getvendor_name     = $act_custrow->vendor_name;
				$getevent_from_date = $act_custrow->event_from_date;
				$getevent_to_date   = $act_custrow->event_to_date;
				$getevent_type      = $act_custrow->event_type;
				$getevent_location  = $act_custrow->event_location;
				$getinvoice_no      = $act_custrow->invoice_no;
				$getreferred_by     = $act_custrow->referred_by;
				$note               = $act_custrow->note;

				if ($getfname == 1) {
					$fnmamechksts     = "display: table-cell;";
				} else {
					$fnmamechksts = "display: none";
				}
				//if($getlname == 1) { $lnmamechksts    = "display: table-cell;"; } else { $lnmamechksts = "display: table-cell"; }
				if ($getcname == 1) {
					$cnmamechksts     = "display: table-cell;";
				} else {
					$cnmamechksts = "display: none";
				}
				if ($getaddr1 == 1) {
					$addr1chksts      = "display: table-cell;";
				} else {
					$addr1chksts = "display: none";
				}
				//if($getaddr2 == 1) { $addr2chksts     = "display: table-cell;"; } else { $addr2chksts = "display: table-cell"; }
				if ($getcity == 1) {
					$citychksts       = "display: table-cell;";
				} else {
					$citychksts = "display: none";
				}
				if ($getstate == 1) {
					$statechksts      = "display: table-cell;";
				} else {
					$statechksts = "display: none";
				}
				if ($getzip == 1) {
					$zipchksts        = "display: table-cell;";
				} else {
					$zipchksts = "display: none";
				}
				if ($getarea == 1) {
					$areachksts       = "display: table-cell;";
				} else {
					$areachksts = "display: none";
				}
				if ($getphno == 1) {
					$phnochksts       = "display: table-cell;";
				} else {
					$phnochksts = "display: none";
				}
				if ($note == 1) {
					$note             = "display: table-cell;";
				} else {
					$note = "display: none";
				}
				if ($getacc_no == 1) {
					$getacc_no        = "display: table-cell;";
				} else {
					$getacc_no = "display: none;";
				}
				if ($getacc_type == 1) {
					$getacc_type      = "display: table-cell;";
				} else {
					$getacc_type = "display: none;";
				}
				if ($getvendor_name == 1) {
					$getvendor_name   = "display: table-cell;";
				} else {
					$getvendor_name = "display: none;";
				}
				if ($getevent_from_date == 1) {
					$getevent_from_date = "display: table-cell;";
				} else {
					$getevent_from_date = "display: none;";
				}
				if ($getevent_to_date == 1) {
					$getevent_to_date = "display: table-cell;";
				} else {
					$getevent_to_date = "display: none;";
				}
				if ($getevent_type == 1) {
					$getevent_type    = "display: table-cell;";
				} else {
					$getevent_type = "display: none;";
				}
				if ($getevent_location == 1) {
					$getevent_location = "display: table-cell;";
				} else {
					$getevent_location = "display: none;";
				}
				if ($getinvoice_no == 1) {
					$getinvoice_no    = "display: table-cell;";
				} else {
					$getinvoice_no = "display: none;";
				}
				if ($getreferred_by == 1) {
					$getreferred_by   = "display: table-cell;";
				} else {
					$getreferred_by = "display: none;";
				}
		?>

				<tr ondblclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')">
					<td><a onclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a></td>
					<td><?= $srno ?></td>
					<td><?= $cust1_dtls->cus_title ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->cus_lname ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->cus_fname ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->cus_address1 ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->cus_address2 ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->custom1 ?> | <?= $cust1_dtls->custom2 ?> </td>
					<td style="display: table-cell;"> <?= $htmlphone ?></td>
					<td style="display: table-cell;"> <?= $cust1_dtls->cus_acc_no ?></td>

					<td style="display: table-cell;"><?= $cust1_dtls->cus_company_name ?></td>
					<td style="display: table-cell;"><?= $cust1_dtls->cus_city ?></td>
					<td style="display: table-cell;"><?= $cust1_dtls->cus_state ?></td>
					<td style="display: table-cell;"><?= $cust1_dtls->cus_zip ?></td>





				</tr>
		<?php
				$srno++;
			}
		} else {
			echo "No Customers Found..!";
		}
	}

	public function get_all_by_cond($tbl, $cond)
	{
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->where($cond);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function allSearchInfo($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");
		$get_data = $cust1->result_array()[0];
		$this->db->select('*');
		$this->db->from('user_contact_info');
		$this->db->where('cus_id', $id);

		$query = $this->db->get()->result_array()[0];

		$phonarr = array();
		$notesarr = array();
		$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id'");

		foreach ($cntinfosql->result() as $cntinfosql) {
			$phonarr[] .= $cntinfosql->contact_no;
			$notesarr[] .= $cntinfosql->user_contact_note;
		}

		$setnotes = implode(",", $notesarr);
		$setphones = implode(",", $phonarr);
		$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id' AND conatct_type!='Email' AND default_contact=1");
		$cntctinfosql_row = $cntctinfosql->row();
		$htmlphone = $cntctinfosql_row->contact_no;
		$htmlnotes = $cntctinfosql_row->user_contact_note;

		//search_customer_opt
		$cond = array('user' => $this->session->fi_session['id']);
		$tbl = "search_customer_opt";
		$act_custrows = $this->HomeModel->get_all_by_cond($tbl, $cond);

		foreach ($act_custrows as $act_custrow) {
			$getfname   = $act_custrow['cus_fname'];
			$getlname   = $act_custrow['cus_lname'];
			$getcname   = $act_custrow['cus_company_name'];
			$getaddr1   = $act_custrow['cus_address1'];
			$getaddr2   = $act_custrow['cus_address2'];
			$getcity    = $act_custrow['cus_city'];
			$getstate   = $act_custrow['cus_state'];
			$getzip     = $act_custrow['cus_zip'];
			$getarea    = $act_custrow['cus_area'];
			$getphno    = $act_custrow['phone_no'];
			$acc_no     = $act_custrow['acc_no'];
			$acc_type   = $act_custrow['acc_type'];
			$vendor_name = $act_custrow['vendor_name'];
			$event_from_date = $act_custrow['event_from_date'];
			$event_to_date = $act_custrow['event_to_date'];
			$event_type = $act_custrow['event_type'];
			$event_location = $act_custrow['event_location'];
			$balance_as_of = $act_custrow['balance_as_of'];
			$invoice_no = $act_custrow['invoice_no'];
			$referred_by = $act_custrow['referred_by'];
			$note       = $act_custrow['note'];
			$total_due  = $act_custrow['total_due'];
		}

		if ($getfname == 1) {
			$fnmamechksts = "display: table-cell;";
		} else {
			$fnmamechksts = "display: none;";
		}
		//if($getlname == 1) { $lnmamechksts = "display: table-cell;" ;     } else { $lnmamechksts = "display: none"; }
		if ($getcname == 1) {
			$cnmamechksts = "display: table-cell;";
		} else {
			$cnmamechksts = "display: none";
		}
		if ($getaddr1 == 1) {
			$addr1chksts = "display: table-cell;";
		} else {
			$addr1chksts = "display: none";
		}
		//if($getaddr2 == 1) { $addr2chksts = "display: table-cell;" ;      } else { $addr2chksts = "display: none"; }
		if ($getarea == 1) {
			$areachksts = "display: table-cell;";
		} else {
			$areachksts = "display: none";
		}

		if ($getcity == 1) {
			$citychksts = "display: table-cell;";
		} else {
			$citychksts = "display: none";
		}
		if ($getstate == 1) {
			$statechksts = "display: table-cell;";
		} else {
			$statechksts = "display: none";
		}
		if ($getzip == 1) {
			$zipchksts = "display: table-cell;";
		} else {
			$zipchksts = "display: none";
		}


		if ($getphno == 1) {
			$phnochksts = "display: table-cell;";
		} else {
			$phnochksts = "display: none";
		}
		if ($acc_no == 1) {
			$acc_no = "display: table-cell;";
		} else {
			$acc_no = "display: none";
		}
		if ($acc_type == 1) {
			$acc_type = "display: table-cell;";
		} else {
			$acc_type = "display: none";
		}
		if ($vendor_name == 1) {
			$vendor_name = "display: table-cell;";
		} else {
			$vendor_name = "display: none";
		}
		if ($event_from_date == 1) {
			$event_from_date = "display: table-cell;";
		} else {
			$event_from_date = "display: none";
		}
		if ($event_to_date == 1) {
			$event_to_date = "display: table-cell;";
		} else {
			$event_to_date = "display: none";
		}
		if ($event_type == 1) {
			$event_type = "display: table-cell;";
		} else {
			$event_type = "display: none";
		}
		if ($event_location == 1) {
			$event_location = "display: table-cell;";
		} else {
			$event_location = "display: none";
		}
		if ($balance_as_of == 1) {
			$balance_as_of = "display: table-cell;";
		} else {
			$balance_as_of = "display: none";
		}
		if ($invoice_no == 1) {
			$invoice_no = "display: table-cell;";
		} else {
			$invoice_no = "display: none";
		}
		if ($referred_by == 1) {
			$referred_by = "display: table-cell;";
		} else {
			$referred_by = "display: none";
		}
		if ($note == 1) {
			$note = "display: table-cell;";
		} else {
			$note = "display:none;";
		}
		if ($total_due == 1) {
			$total_due = "display: table-cell;";
		} else {
			$total_due = "display:none;";
		}
		?>
		<tr ondblclick="fnviewcustomer('<?= $get_data['cus_id'] ?>')">
			<td>
				<a onclick="fnviewcustomer('<?= $get_data['cus_id'] ?>')" style="cursor: pointer;">
					<i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
			</td>
			<td>1</td>
			<td><?= $get_data['cus_title'] ?></td>

			<td style="text-transform:capitalize; display:table-cell"><?= $get_data['cus_lname'] ?></td>
			<td style="text-transform:capitalize; display:table-cell"><?= $get_data['cus_fname'] ?></td>

			<td style="display:table-cell"><?= $get_data['cus_address1'] ?></td>
			<td style="display:table-cell"><?= $get_data['cus_address2'] ?></td>
			<td style="display:table-cell"><?= $get_data['custom1'] ?> | <?= $get_data['custom2'] ?> </td>
			<td style="display:table-cell"><?= $setphones ?></td>
			<td style="display:table-cell"><?= $get_data['cus_acc_no'] ?></td>
			<td style="display:table-cell"><?= $get_data['cus_company_name'] ?></td>

			<td style="display:table-cell"><?= $get_data['cus_city'] ?></td>
			<td style="display:table-cell"><?= $get_data['cus_state'] ?></td>
			<td style="display:table-cell"><?= $get_data['cus_zip'] ?></td>







		</tr>
	<?php
	}

	public function fnupdatesearchinfo_dtls()
	{
		$columname = $this->input->post('columname');
		$columnvalue = $this->input->post('columnvalue');
		if ($columnvalue == 1) {
			$colval = "0";
		} else {
			$colval = "1";
		}

		$cus_srchupdate = array(
			$columname => $colval

		);

		$cond = array('user' => $this->session->fi_session['id']);
		$tbl = 'search_customer_opt';
		$res = $this->get_all_by_cond($tbl, $cond);

		if (!$res) {
			$arraydata['user'] = $this->session->fi_session['id'];
			$res = $this->db->insert('search_customer_opt', $arraydata);
		}

		$this->db->where('user', $this->session->fi_session['id']);

		if ($this->db->update('search_customer_opt', $cus_srchupdate)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function user_register($arr)
	{
		$this->db->insert('users', $arr);
		return $this->db->insert_id();
	}

	public function search_data()
	{
		$id = $this->session->fi_session['id'];
		$user_role = $this->session->fi_session['admin_role_id'];

		if ($user_role == '1') {
			$query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,register_customer.cus_acc_no')
				->from('register_customer')
				->where('register_customer.user', $id)
				->order_by("register_customer.cus_id DESC")
				->get();
		} elseif ($user_role == '2') {
			$query = $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,register_customer.cus_acc_no')
				->from('register_customer')
				->where('register_customer.user', $id)
				->order_by("register_customer.cus_id DESC")
				->get();
		} else {
			$query =  $this->db->select('register_customer.cus_id,register_customer.cus_fname,register_customer.cus_lname,register_customer.cus_company_name,register_customer.cus_address1,register_customer.cus_address2,register_customer.cus_city,register_customer.cus_state,register_customer.cus_zip,register_customer.cus_acc_no')
				->from('register_customer')

				->order_by("register_customer.cus_id DESC")
				->get();
		}
		return $query->result_array();
	}

	public function fninsertcrews_dtls()
	{
		$insertlocarr = array(
			'event_id'          => $this->input->post('txtshdneventId'),
			'crews_type'        =>  $this->input->post('crwtype'),
			'crews_start_date'  =>  $this->input->post('temp_st_date'),
			'crews_start_time'  =>   $this->input->post('valuestart'),
			'crews_end_date'    => $this->input->post('temp_en_date'),
			'crews_end_time'    => $this->input->post('valuestop'),
			'crews_location'    => 'Choose',
			'crews_total_hours' =>  $this->input->post('tothrs')
		);

		if ($this->db->insert('event_crews', $insertlocarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function allSearchCustInfo($cName)
	{
		$id = $cName;

		if ($id != "") {
			$sql = "SELECT * FROM user_contact_info WHERE cus_id='" . $id . "' AND default_contact=1 AND conatct_type!='Email'";
			$cntinfosql = $this->db->query($sql);
			$cntinfosql_row = $cntinfosql->row();

			$this->db->select('*');
			$this->db->from('invoices_create');
			$this->db->where('cust_id', $id);
			$this->db->where('cust_id !=', 0);
			$this->db->order_by('invoice_id DESC');
			$this->db->limit(1);
			$singleinvinfo = $this->db->get()->result_array()[0];

			$custregsql = $this->db->query("SELECT * FROM register_customer WHERE cus_id='" . $id . "' AND cus_id!=0 AND cus_id!='0'");
			$custregsqlrow = $custregsql->row();
			$balance_count = $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id', $id)->get('invoices_create')->result_array()[0];
			$invoice_paid_level = $this->db->select('SUM(invoice_paid) as invoice_paid_level')->where('cust_id', $id)->get('invoices_create')->result_array()[0];
			$invoice_paid = $this->db->select('SUM(amount) as amount')->where('cust_id', $id)->get('customer_payment_history')->result_array()[0];
			$invoice_credit = $this->db->select('SUM(credit) as credit')->where('cust_id', $id)->get('customer_payment_history')->result_array()[0];
			$remain = ($balance_count['total'] + $invoice_paid_level['invoice_paid_level']) - $invoice_paid['amount'];
			if ($remain <= 0) {
				$remain = -$invoice_credit['credit'];
			}

			$this->session->set_userdata('bal_amt', $balance_count['total']);
			$credit_count = $this->db->query("SELECT credit FROM customer_payment_history WHERE cust_id='" . $id . "' ORDER BY id ASC")->result_array()[0];
			if (is_null($credit_count['credit'])) {
				$credit_count = 0;
			}
		} ?>

		<div class="col-md-2 contact_no">
			<div class="form-group" id="contact_info">
				<!-- onchange="fncustomersearchbyphone(this.value)" id="topphone" -->
				<input style="background: #e2e2e2 !important" class="form-control fcap contact_no" type="text" name="topphone" value="<?= $cntinfosql_row->contact_no ?>" placeholder="Contact" readonly disabled>
			</div>
		</div>

		<div class="col-md-2 cus_acc_no">
			<div class="form-group">
				<!-- id="lastinvId" -->
				<input style="background: #e2e2e2 !important" class="form-control" type="text" placeholder="Acc no" value="<?= sprintf('%07u', $custregsqlrow->cus_id) ?>" readonly disabled>
			</div>
		</div>

		<div class="col-md-2 balance_count">
			<div class="form-group" id="lastinvduebal">
				<input style="background: #e2e2e2 !important" readonly disabled class="form-control" type="text" placeholder="Balance" value="$<?= sprintf('%0.2f', $remain) ?>">
			</div>
		</div>
		<?php
	}

	public function CREWS_check_date_with_db_dtls()
	{

		$date_ = $this->input->post('date_');
		$cus_id = $this->input->post('cus_id');

		$this->db->select('ew.crews_confirmed_on'); //2020-03-20//2020-03-20
		$this->db->join('events_register er', 'er.event_id=ew.event_id', 'left');
		$this->db->from('event_crews ew');
		$this->db->where('ew.crews_confirmed_on',  date('Y-m-d', strtotime($date_)));
		$this->db->where('er.cus_id !=',  $cus_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return FALSE;
		} else {
			echo "TRUE";
		}
	}

	public function check_date_with_db_dtls()
	{
		$date_ = $this->input->post('date_');
		$cus_id = $this->input->post('cus_id');

		$this->db->select('event_id'); //2020-03-20
		$this->db->from('events_register');
		$this->db->where('event_date',  date('Y-m-d', strtotime($date_)));
		$this->db->where('cus_id !=',  $cus_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {

			return FALSE;
		} else {
			echo "TRUE";
		}
	}

	public function fnpickupreqinfo_dtls()
	{
		$curr_date       = date('Y-m-d');
		$pac_update_qty  = $this->db->query("SELECT * FROM customers_package_items WHERE  id='" . $_POST['hdnpreqid'] . "'");
		$qtyrow_n        = $pac_update_qty->row();

		$update_qty  = $this->db->query("SELECT * FROM customers_pickup_items WHERE  id='" . $_POST['hdnpreqid'] . "' AND pickup_date='" . $curr_date . "'");
		$qtyrow      = $update_qty->row();

		if ($qtyrow != "") {

			$updtrqpckitemsts = array(
				"item_quantity" => $qtyrow->item_quantity + $qtyrow_n->item_quantity,

			);

			$this->db->where('id', $_POST['hdnpreqid']);
			$this->db->update('customers_pickup_items', $updtrqpckitemsts);


			$customers_package_items = array(
				"pickup" => 1
			);

			$this->db->where('id', $_POST['hdnpreqid']);
			$this->db->update('customers_package_items', $customers_package_items);
			echo "success";
		} else {
			if ($this->db->query("INSERT INTO customers_pickup_items(id,cus_id,inv_id,package_id,item_name,item_quantity,item_price,item_desc,assigned_pckid,pickupreq,pickup_date,up_item_qty) SELECT id,cus_id,inv_id,package_id,item_name,item_quantity,item_price,item_desc,assigned_pckid,pickupreq,'" . $curr_date . "' as dt,item_quantity FROM customers_package_items WHERE id='" . $_POST['hdnpreqid'] . "'")) {
				$this->db->where('id', $_POST['hdnpreqid']);
				$this->db->delete('customers_package_items');
				echo "success";
			}
		}
	}

	public function fnitemqtydescountinfo_dtls()
	{
		$itemqtydiscounted_amt = "";
		if ($_POST['itemdiscntyp'] == "1") { // $

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');

			$itemqtydiscounted_amt = $pstqtydisamt - $this->input->post('itemdescount');
		} else if ($_POST['itemdiscntyp'] == "2") { // %

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');
			$itemqtydiscounted_amt = ($this->input->post('itemdescount') / 100) * $pstqtydisamt;
		} else {
			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');
			$itemqtydiscounted_amt = NULL;
		}

		$updtitmqtydiscntamtarr = array(

			"item_discnt_amt" => $this->input->post('itemdescount'),
			"discounted_amt" => $itemqtydiscounted_amt,
			"item_discnt_typ" => $this->input->post('itemdiscntyp'),
			"item_quantity" => $this->input->post('itemwoutqty'),
			"item_tot" => $pstqtydisamt
		);
		$this->db->where('id', $this->input->post('itemid'));
		if ($this->db->update('customers_package_items', $updtitmqtydiscntamtarr)) {


			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND discounted_amt IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;

			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			$customers_package_items_q = "SELECT discounted_amt, item_price, item_tot, item_quantity FROM `customers_package_items` WHERE  inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC";

			$customers_package_items_query = $this->db->query($customers_package_items_q);
			$customers_package_items_res = $customers_package_items_query->result_array();
			$total_cost = 0;

			foreach ($customers_package_items_res as $row) {

				$item_price = $row['item_price'];
				$item_quantity = $row['item_quantity'];
				$discounted_amt = $row['discounted_amt'];

				if ($item_price == '') {
					$item_price = 0;
				}

				if ($item_quantity == '') {
					$item_quantity = 0;
				}

				if ($discounted_amt == '') {
					$discounted_amt = 0;
				}
				$total_cost = $total_cost + (($item_price * $item_quantity) - $discounted_amt);
			}

			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price, SUM(sub_total) as sub_total FROM customer_assigned_packages WHERE pck_discounted_amt IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;
			$sub_total = $getsumpckrow->sub_total;

			$discounted_amt_q = $this->db->query("SELECT discounted_amt FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "' AND cust_id='" . $_POST['custid'] . "'  ");
			$discounted_amt_r = $discounted_amt_q->row();
			$discounted_amt = $discounted_amt_r->discounted_amt;
			$invoicetot = $descountitemstot + $itemstot + $desountpckgstot + $pckgstot;
			$upitemtotal = array(
				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $total_cost  - $discounted_amt
			);
			$this->db->where('invoice_id', $_POST['invoiceid']);
			$this->db->where('cust_id', $_POST['custid']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	public function change_qty1()
	{

		$id = $this->input->post('id');
		$change_qty_ = $this->input->post('change_qty_');

		$data = array('item_quantity' => $change_qty_);
		$this->db->where('id', $id);

		$this->db->update('customers_package_items', $data);
	}

	public function change_qty()
	{
		$id = $this->input->post('id');
		$change_qty_ = $this->input->post('change_qty_');

		$data = array('item_quantity' => $change_qty_);
		$this->db->where('id', $id);

		$this->db->update('customers_package_items', $data);
	}

	public function time_update_dtls($timenotes, $id)
	{
		$data = array('time' => $timenotes);
		$this->db->where('id', $id);

		$this->db->update('customer_invoice_notes', $data);
	}

	public function fnpckgdescountinfo_dtls()
	{

		$rem    = $this->input->post('rem');
		$pckid  = $this->input->post('pckid');
		echo "Aks : " . $this->input->post('pckgdiscntyp');

		$itemdiscounted_amt = "";

		if ($this->input->post('pckgdiscntyp') == "1") {

			$pstqtydisamt = $this->input->post('pckprice');

			$disamt_final = $this->input->post('pckdesamt');
			$itemdiscounted_amt = $this->input->post('pckdesamt');
			echo "*dis----AAAAA" . $itemdiscounted_amt;
			echo "<br>";
		} else if ($this->input->post('pckgdiscntyp') == "2") {

			$pstqtydisamt = $this->input->post('pckprice');
			$disamt_final = ($this->input->post('pckdesamt') / 100) * $pstqtydisamt;
			$itemdiscounted_amt = ($this->input->post('pckdesamt') / 100) * $pstqtydisamt;
			echo "*dis----BBBBB" . $itemdiscounted_amt;
			echo "<br>";
		} else {

			$itemdiscounted_amt = 0;
			echo "CCCCCCCCCCCCcc";
		}

		$query_disss = "SELECT invoice_amount, discount_amt_new, invoice_discount, discounted_amt, invoice_balance_due, small_dis FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";

		// echo $query_dis;die;
		$sumofdescntitemsqlll = $this->db->query($query_disss);
		$getsumdescntrows = $sumofdescntitemsqlll->row();
		$discount_amt_new = $getsumdescntrows->discount_amt_new;

		$customers_package_items_query  = $this->db->query("SELECT sum(item_tot) as item_tot, sum(item_price) as item_price, sum(discounted_amt) as discounted_amt FROM `customers_package_items` WHERE  assigned_pckid = '" . $pckid . "'");
		$customers_package_items_query2 = $customers_package_items_query->row();
		$item_price                     = $customers_package_items_query2->item_price;
		$discounted_amt                 = $customers_package_items_query2->discounted_amt;
		$item_tot                       = $customers_package_items_query2->item_tot;

		print_r($this->db->last_query());

		$updtitmdiscntamtarr = array(

			"pck_discnt_amt"      => $this->input->post('pckdesamt'),
			"pck_discounted_amt"  => $itemdiscounted_amt,
			"pck_discnt_typ"      => $this->input->post('pckgdiscntyp'),
			"sub_total"           => $item_tot - $itemdiscounted_amt
		);




		print_r($updtitmdiscntamtarr);

		$this->db->where('id', $pckid);

		if ($this->db->update('customer_assigned_packages', $updtitmdiscntamtarr)) {

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  
                FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE  inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;


			$invoicetot =  $itemstot + $pckgstot;
			// $invoicetot= $descountitemstot + $itemstot + $pckgstot;
			// $invoicetot= $desountpckgstot -$invoicetot;

			//discount

			$sumpackageprice = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdpackage = $sumpackageprice->row();
			$desountpackageamount = $getsumdpackage->package_price;

			$sumofitmgsql1 = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND discounted_amt IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumitemsrow1 = $sumofitmgsql1->row();
			$itemstot1 = $getsumitemsrow1->item_tot;

			$final_amount = $desountpackageamount + $itemstot1;
			$final_amount = $final_amount - $itemdiscounted_amt;


			$invfinl_amt = $getsumdescntrows->invoice_amount;
			$invfinl_bal_due = $getsumdescntrows->invoice_balance_due;
			$small_dis = $disamt_final + $getsumdescntrows->small_dis;

			$amt_final_price = $invoicetot - $itemdiscounted_amt;

			if ($disamt_final == "0") {
				$disamt_final =  $invfinl_bal_due;
			} else {
				$disamt_final = $invfinl_bal_due - $disamt_final;
			}


			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				// "invoice_balance_due" =>$disamt_final,
				"invoice_balance_due" => $invfinl_amt - ($descountitemstot + $desountpckgstot + $discount_amt_new),
				"small_dis" => $descountitemstot + $desountpckgstot
			);


			$this->db->where('invoice_id', $_POST['invoiceid']);
			$this->db->where('cust_id', $_POST['custid']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	public function fnitemdescountinfo_dtls_pck()
	{

		if ($_POST['change_type'] == 1) {

			$qty = 0;

			$q = array(
				"item_discnt_amt" => "",
				"discounted_amt" => "0"
			);

			$this->db->where('id', $this->input->post('itemid'));
			$this->db->update('customers_package_items', $q);
		} else {

			$qty = $this->input->post('inputxtval');
		}

		$itemdiscounted_amt = "";

		if ($_POST['itemdiscntyp'] == "1") { // $

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');

			$itemdiscounted_amt = $qty;

			$discounted_amt = $this->input->post('itemdescount1');
			$pstqtydisamt = $pstqtydisamt - $this->input->post('itemdescount1');
			// $itemdiscounted_amt= $pstqtydisamt - $this->input->post('inputxtval');

		} else if ($_POST['itemdiscntyp'] == "2") { // %

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');

			$discounted_amt = ($this->input->post('inputxtval') / 100) * $pstqtydisamt;

			$pstqtydisamt = $pstqtydisamt - $discounted_amt;
		} else {

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');
			$itemdiscounted_amt = NULL;
		}

		$updtitmdiscntamtarr = array(

			"item_quantity"   => $this->input->post('itemwoutqty'),
			"item_discnt_amt" => $this->input->post('itemdescount1'),
			"discounted_amt"  => $discounted_amt,
			"item_discnt_typ" => $this->input->post('itemdiscntyp'),
			"item_tot"        => $pstqtydisamt
		);

		//print_r($updtitmdiscntamtarr);

		$this->db->where('id', $this->input->post('itemid'));

		if ($this->db->update('customers_package_items', $updtitmdiscntamtarr)) {


			//customer_assigned_packages

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			$customers_package_items2 = $this->db->query("SELECT id, pck_discounted_amt, sub_total FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$customers_package_items1 = $customers_package_items2->row();
			$id                       = $customers_package_items1->id;
			$pck_discounted_amt       = $customers_package_items1->pck_discounted_amt;
			$sub_total                = $customers_package_items1->sub_total;

			$customers_package_items_query  = $this->db->query("SELECT sum(item_tot) as item_tot, sum(item_price) as item_price, sum(discounted_amt) as discounted_amt FROM `customers_package_items` WHERE  assigned_pckid = '" . $id . "'");
			$customers_package_items_query2 = $customers_package_items_query->row();
			$item_price                     = $customers_package_items_query2->item_price;
			$discounted_amt1                = $customers_package_items_query2->discounted_amt;
			$item_tot                       = $customers_package_items_query2->item_tot;


			$updtitmdiscntamtarr1 = array(

				"package_price"       => $item_price,
				//"pck_discounted_amt"  => $discounted_amt1,
				"sub_total"           => $item_tot
			);


			$this->db->where('id', $id);

			$data_done = $this->db->update('customer_assigned_packages', $updtitmdiscntamtarr1);

			$customers_package_items3 = $this->db->query("SELECT id, pck_discounted_amt, sub_total FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$customers_package_items4 = $customers_package_items3->row();
			$id1                       = $customers_package_items4->id;
			$pck_discounted_amt4       = $customers_package_items4->pck_discounted_amt;
			$sub_total                = $customers_package_items4->sub_total;

			$updtitmdiscntamtarr12 = array(

				"sub_total"           => $sub_total - $pck_discounted_amt4
			);

			$this->db->where('id', $id1);

			$data_done = $this->db->update('customer_assigned_packages', $updtitmdiscntamtarr12);

			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;

			//main invoice discount
			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";
			// echo $query_dis;die;
			$sumofdescntitemsqll = $this->db->query($query_diss);

			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;

			$invoicetot =  $itemstot + $pckgstot;
			// echo "inv_total ".$invoicetot;
			$invoice_balance_due = $invoicetot - ($descountitemstott + $desountpckgstot + $descountitemstot);
			// echo "inv_dis total ".$invoice_balance_due;
			$upitemtotal = array(

				"invoice_amount"      => $invoicetot,
				"invoice_balance_due" => $invoice_balance_due,
				"small_dis"           => $desountpckgstot + $descountitemstot
				// "item_discnt_amt" => $this->input->post('itemdescount1')
			);
			$this->db->where('invoice_id', $_POST['invoiceid']);
			$this->db->where('cust_id', $_POST['custid']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			} else {
				//print_r($this->db->last_query());
			}

			//echo "success";

		} else {
			echo "error";
		}
	}

	public function fnitemdescountinfo_dtls()
	{

		if ($_POST['change_type'] == 1) {
			// code...
			$qty = 0;

			$q = array(

				"item_discnt_amt" => "",
				"discounted_amt" => "0"
			);

			$this->db->where('id', $this->input->post('itemid'));
			$this->db->update('customers_package_items', $q);
		} else {
			// code...
			$qty = $this->input->post('inputxtval');
		}

		$itemdiscounted_amt = "";

		if ($_POST['itemdiscntyp'] == "1") { // $

			//itemdescount itemdiscntyp
			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');

			$itemdiscounted_amt = $qty;
			// $itemdiscounted_amt= $pstqtydisamt - $this->input->post('inputxtval');

		} else if ($_POST['itemdiscntyp'] == "2") { // %

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');

			$itemdiscounted_amt = ($qty / 100) * $pstqtydisamt;
		} else {

			$pstqtydisamt = $this->input->post('witmi4') * $this->input->post('itemwoutqty');
			$itemdiscounted_amt = NULL;
		}





		$updtitmdiscntamtarr = array(

			"item_discnt_amt" => $this->input->post('itemdescount1'),
			"discounted_amt" => $itemdiscounted_amt,
			"item_discnt_typ" => $this->input->post('itemdiscntyp'),
			"item_tot" => $pstqtydisamt
		);

		$this->db->where('id', $this->input->post('itemid'));

		if ($this->db->update('customers_package_items', $updtitmdiscntamtarr)) {

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items 
                    WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items 
                    WHERE package_id IS NULL AND inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE inv_id='" . $_POST['invoiceid'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;

			//main invoice discount
			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";
			// echo $query_dis;die;
			$sumofdescntitemsqll = $this->db->query($query_diss);

			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;

			$invoicetot =  $itemstot + $pckgstot;
			// echo "inv_total ".$invoicetot;
			$invoice_balance_due = $invoicetot - ($descountitemstott + $desountpckgstot + $descountitemstot);
			// echo "inv_dis total ".$invoice_balance_due;
			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $invoice_balance_due,
				"small_dis" => $desountpckgstot + $descountitemstot
				//"item_discnt_amt" => $this->input->post('itemdescount1'),
			);
			$this->db->where('invoice_id', $_POST['invoiceid']);
			$this->db->where('cust_id', $_POST['custid']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	public function fngetsignlepckinfo_dtls()
	{

		error_reporting(0);
		$getpostpckg = $this->db->query("SELECT * FROM admin_package WHERE package_id = '" . $_POST['pckId'] . "'");
		$getadmpckrow = $getpostpckg->row();

		$pckarr = array(
			"cus_id"          => $_POST['custid'],
			"inv_id"          => $_POST['invId'],
			"package_id"      => $_POST['pckId'],
			"package_name"    => $getadmpckrow->package_name,
			"package_price"   => $getadmpckrow->package_price,
			"package_taxable" => $getadmpckrow->package_taxable,
			"sub_total"       => $getadmpckrow->package_price
		);

		if ($this->db->insert('customer_assigned_packages', $pckarr)) {

			$linsertId = $this->db->insert_id();

			$getpostpckgitms = $this->db->query("SELECT * FROM admin_package_item WHERE package_id = '" . $_POST['pckId'] . "'");

			foreach ($getpostpckgitms->result() as $getpostpckgitms_dtls) {

				$itemsarr = array(
					"cus_id"          => $_POST['custid'],
					"inv_id"          => $_POST['invId'],
					"package_id"      => $_POST['pckId'],
					"item_name"       => $getpostpckgitms_dtls->item_name,
					"item_quantity"   => $getpostpckgitms_dtls->item_quantity,
					"item_price"      => $getpostpckgitms_dtls->item_price,
					"item_desc"       => $getpostpckgitms_dtls->item_desc,
					"assigned_pckid"  => $linsertId,
					"item_tot"        => $getpostpckgitms_dtls->item_price
				);

				$this->db->insert('customers_package_items', $itemsarr);
			}

			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages 
            WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;
			echo "dis_amt " . $desountpckgstot;
			echo "<br>";

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages 
            WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;



			/* calculate only discounted items total */
			$query_dis = "SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items 
                WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ";
			// echo $query_dis;die;
			$sumofdescntitemsql = $this->db->query($query_dis);

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;
			echo "itm_dis " . $descountitemstot;
			echo "<br>";




			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items 
            WHERE package_id IS NULL  AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custid'] . "' ORDER BY id ASC ");

			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;

			// $invoicetot=   $pckgstot;
			$invoicetot =  $pckgstot + $itemstot;



			$taxdata = $this->db->query("SELECT tx.ttax FROM register_customer rc JOIN tbl_tax_rate tx ON rc.cus_zip=tx.tzip 
                WHERE rc.cus_id='" . $_POST['custid'] . "'");
			$taxdatarow = $taxdata->row_array();
			$tax_rate = $taxdatarow['ttax'];
			if ($tax_rate == "") {
				$taxdatarow = 0;
			}

			echo "amt" . $invoicetot;
			$disamttotal = $invoicetot - ($desountpckgstot + $descountitemstot + $tax_rate);
			echo "dis_AR amt " . $disamttotal . " " . $desountpckgstot . " " . $descountitemstot;
			echo "<br>";


			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  
                FROM invoices_create WHERE invoice_id='" . $_POST['invId'] . "'";

			$sumofdescntitemsqll = $this->db->query($query_diss);
			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;
			echo "main_dis " . $descountitemstott;
			echo "<br>";

			if ($getsumdescntrows->invoice_discount == "1") // $
			{
				$disamttotall = $getsumdescntrows->discounted_amt;
				$disamttotal = $disamttotal - $getsumdescntrows->discounted_amt;
				echo "dis$---A--" . $disamttotall . "////" . $disamttotal;
			}
			if ($getsumdescntrows->invoice_discount == "2") // %
			{
				$disamttotall = ($invoicetot / 100) * $getsumdescntrows->discounted_amt;
				echo "dis-A--+" . $disamttotall;
				$disamttotal = $disamttotal - $disamttotall;
			}

			$upitemtotal = array(

				"invoice_amount"      => $invoicetot,
				"invoice_balance_due" => $disamttotal,
				"discount_amt_new"    => $disamttotall,
				"invoice_tax_rate"    => $tax_rate
			);
			$this->db->where('invoice_id', $_POST['invId']);
			$this->db->where('cust_id', $_POST['custid']);
			if ($this->db->update('invoices_create', $upitemtotal)) {

				// echo ".$invoicetot;
				echo "success" . $invoicetot;
			}
		}
	}

	public function delassignpackge_dtls()
	{



		$this->db->where('id', $this->input->post('itmId'));


		if ($this->db->delete('customer_assigned_packages')) {

			$this->db->where('assigned_pckid', $this->input->post('itmId'));
			$this->db->delete('customers_package_items');

			$invoiceId = $this->input->post('invoiceId');
			$custId = $this->input->post('custId');

			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $invoiceId . "' AND cus_id='" . $custId . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;
			//echo "dis_amt ".$desountpckgstot;echo "<br>";

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE inv_id='" . $invoiceId . "' AND cus_id='" . $custId . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;

			/* calculate only discounted items total */
			$query_dis = "SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $invoiceId . "' AND cus_id='" . $custId . "' ORDER BY id ASC ";
			// echo $query_dis;die;
			$sumofdescntitemsql = $this->db->query($query_dis);
			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;
			//echo "itm_dis ".$descountitemstot;echo "<br>";

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL  AND inv_id='" . $invoiceId . "' AND cus_id='" . $custId . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;

			// $invoicetot=   $pckgstot;
			$invoicetot = $pckgstot + $itemstot;

			$taxdata = $this->db->query("SELECT tx.ttax FROM register_customer rc JOIN tbl_tax_rate tx ON `rc`.`cus_zip`=`tx`.`tzip` WHERE rc.cus_id='" . $_POST['custid'] . "'");
			$taxdatarow = $taxdata->row_array();
			$tax_rate = $taxdatarow['ttax'];
			if ($tax_rate == "") {
				$taxdatarow = 0;
			}

			//echo "amt".$invoicetot;
			$disamttotal = $invoicetot - ($desountpckgstot + $descountitemstot + $tax_rate);
			//echo "dis_AR amt ".$disamttotal." ".$desountpckgstot." ".$descountitemstot;echo "<br>";

			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis FROM invoices_create WHERE invoice_id='" . $invoiceId . "'";
			$sumofdescntitemsqll = $this->db->query($query_diss);
			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;
			//echo "main_dis ".$descountitemstott;echo "<br>";

			if ($getsumdescntrows->invoice_discount == "1") { // $ 

				$disamttotall = $getsumdescntrows->discounted_amt;
				$disamttotal = $disamttotal - $getsumdescntrows->discounted_amt;
				//echo "dis$---A--".$disamttotall."////".$disamttotal;
			}

			if ($getsumdescntrows->invoice_discount == "2") { // %

				$disamttotall = ($invoicetot / 100) * $getsumdescntrows->discounted_amt;
				//echo "dis-A--+".$disamttotall;
				$disamttotal = $disamttotal - $disamttotall;
			}



			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $disamttotal

			);
			$this->db->where('invoice_id', $invoiceId);
			$this->db->where('cust_id', $custId);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				// echo ".$invoicetot;

				echo "success";
			}
		} else {
			echo "error";
		}
	}


	public function fniteminfojson_dtls()
	{
		$itmjson;
		$itemssql = $this->db->query("SELECT * FROM admin_item WHERE item_id='" . $_POST['itemId'] . "'");

		foreach ($itemssql->result() as $itemssql_dtls) {
			$itmjson['itemlist'] = $itemssql_dtls;
		}

		echo json_encode($itmjson);
	}

	public function Save_Notis()
	{
		$currentTimeinSeconds = time();
		$currentDate = date('Y-m-d', $currentTimeinSeconds);
		$data = array(
			'date'    => date('Y-m-d', $currentTimeinSeconds),
			'time'    =>  date('h:i A', $currentTimeinSeconds),
			'inv_id'  => $this->input->post('id'),
			'note'    => $this->input->post('note_desc1')
		);
		$this->db->insert('customer_invoice_notes', $data);
	}

	public function email_notification()
	{
		$this->db->where('noti_status !=', 2);
		$this->db->from("correspondence");
		return $this->db->count_all_results();
	}

	public function update_email_notification()
	{
		$array = array(
			"noti_status" => 2
		);
		$result = $this->db->update('correspondence', $array);
	}

	public function fninvdescountinfo_dtls2()
	{

		$amt = "";
		$discounted_amt = "";

		if ($_POST['discntyp'] == "1") {

			$discounted_amt = $this->input->post('invoicamount') - $this->input->post('inputxtval');
			$amt = $this->input->post('inputxtval');
		} else if ($_POST['discntyp'] == "2") {

			$discounted_amt = ($this->input->post('inputxtval') / 100) * $this->input->post('invoicamount');
			$amt = $discounted_amt;
			$discounted_amt = $this->input->post('invoicamount') - $discounted_amt;
		}

		$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";
		$sumofdescntitemsqll = $this->db->query($query_diss);
		$getsumdescntrows = $sumofdescntitemsqll->row();
		$small_dis_amt = $getsumdescntrows->small_dis;

		$updtdiscntamtarr = array(
			"discount_amt_new" => $amt
		);
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->update('invoices_create', $updtdiscntamtarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function fninvdescountinfo_dtls()
	{

		$amt = "";
		$discounted_amt = "";

		if ($_POST['discntyp'] == "1") {

			$discounted_amt = $this->input->post('invoicamount') - $this->input->post('inputxtval');
			$amt = $this->input->post('inputxtval');
		} else if ($_POST['discntyp'] == "2") {

			$discounted_amt = ($this->input->post('inputxtval') / 100) * $this->input->post('invoicamount');
			$amt = $discounted_amt;
			$discounted_amt = $this->input->post('invoicamount') - $discounted_amt;
		}

		$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";
		// echo $query_dis;die;
		$sumofdescntitemsqll = $this->db->query($query_diss);

		$getsumdescntrows = $sumofdescntitemsqll->row();
		$small_dis_amt = $getsumdescntrows->small_dis;

		$updtdiscntamtarr = array(
			"discounted_amt" => $this->input->post('inputxtval'),
			// "invoice_sub_total" => $discounted_amt,
			"discount_amt_new" => $amt,
			"invoice_balance_due" => $discounted_amt - $small_dis_amt

		);
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->update('invoices_create', $updtdiscntamtarr)) {

			echo "success";
		} else {
			echo "error";
		}
	}

	public function upditemamt_dtls()
	{

		$id = $this->input->post('txtinpid');

		$this->db->select('item_price, inv_id');
		$this->db->where('id', $id);
		$query = $this->db->get('customers_package_items');
		$result = $query->result_array();
		$data = $result[0];

		$item_price1 = "invoice_amount" -  $data['item_price'];
		$invoice_balance_due1 = "invoice_balance_due" -  $data['item_price'];
		$inv_id = $data['inv_id'];



		$item_price2 = $this->input->post('itemamt');
		$item_price3 = "invoice_amount" + $item_price2;
		$invoice_balance_due1 = "invoice_balance_due" + $item_price2;

		/*admin_package_item*/
		if ($this->db->update('customers_package_items', $updateitemamountarr)) {

			echo "success";
		} else {
			echo "error";
		}
	}




	public function fngetsearhinvoice_dtls()
	{

		error_reporting(0);

		if ($_POST['custid'] != "") {

			$invoicesql     = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['custid'] . "' ORDER BY invoice_id ASC");
			$chkinvsql      = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['custid'] . "' ORDER BY invoice_id DESC LIMIT 1");
			$taxdata        = $this->db->query("SELECT tx.ttax FROM register_customer rc JOIN tbl_tax_rate tx ON rc.cus_zip=tx.tzip WHERE rc.cus_id='" . $_POST['custid'] . "'");
			$evntdatarow1   = $taxdata->row_array();
		}

		$isinvoicerow = $chkinvsql->row();
		$i = 1;
		$j = 2;
		$k = 3;

		foreach ($invoicesql->result() as $invoicesql_dtls) {


			$customers_package_items_q = "SELECT discounted_amt, item_price, item_tot, item_quantity FROM `customers_package_items` WHERE  inv_id='" . $invoicesql_dtls->invoice_id . "' ORDER BY id ASC";

			$customers_package_items_query = $this->db->query($customers_package_items_q);
			$customers_package_items_res = $customers_package_items_query->result_array();

			$total_cost = 0;
			$item_price_tot = 0;

			foreach ($customers_package_items_res as $row) {

				$item_price = $row['item_price'];
				$item_quantity = $row['item_quantity'];
				$discounted_amt = $row['discounted_amt'];

				if ($item_price == '') {
					$item_price = 0;
				}

				if ($item_quantity == '') {
					$item_quantity = 0;
				}

				if ($discounted_amt == '') {
					$discounted_amt = 0;
				}

				$total_cost = $total_cost + (($item_price * $item_quantity) - $discounted_amt);
				$item_price_tot = $item_price_tot + $item_price;
			}

			/* calculate packages total */
			$discounted_amt_q = $this->db->query("SELECT discounted_amt FROM invoices_create WHERE invoice_id='" . $invoicesql_dtls->invoice_id . "' ");
			$discounted_amt_r = $discounted_amt_q->row();
			$invoice_balance_due = $total_cost - $discounted_amt_r->discounted_amt;

			//print_r()


			$tax_rate       = $evntdatarow1['ttax'];
			$invoiceId      = $invoicesql_dtls->invoice_id;
			$invoicedt      = $invoicesql_dtls->invoice_date;
			$invoiceduedt   = $invoicesql_dtls->invoice_due_date;
			$invoicetype    = $invoicesql_dtls->invoice_type;
			$contracttype   = $invoicesql_dtls->invoice_contract_type;
			$invdescnt      = $invoicesql_dtls->invoice_discount;
			// $invsubtot=$invoicesql_dtls->discounted_amt;
			$invsubtot      = $invoicesql_dtls->discount_amt_new;
			$invtax         = $invoicesql_dtls->invoice_tax;
			$invamount      = $invoicesql_dtls->invoice_amount;
			// $invamount=$invoicesql_dtls->invoice_amount-$invoicesql_dtls->discount_amt_new;
			$invpaid        = $invoicesql_dtls->invoice_paid;
			$invbaldue      = $invoicesql_dtls->invoice_balance_due;
			$invtaxrate     = $invoicesql_dtls->invoice_tax_rate;
			$invcntry       = $invoicesql_dtls->invoice_county;
			$invuser        = $invoicesql_dtls->user;
			$invdescount    = $invoicesql_dtls->discounted_amt;
			$invcustId      = $invoicesql_dtls->cust_id;


			if ($invoicedt != "") {
				$invdate = $invoicedt;
			} else {
				$invdate = date('Y-m-d');
			}


			if ($invoiceduedt != "") {
				$invduedate = $invoiceduedt;
			} else {
				$invduedate = "";
			}

			if ($invdescnt != "") {
				$setinvdescnt = $invdescnt;
			} else {
				$setinvdescnt = "";
			}

			if ($invsubtot != "") {
				$setinvsubtot = $invsubtot;
			} else {
				$setinvsubtot = "";
			}

			if ($invtax != "") {
				$setinvtax = $invtax;
			} else {
				$setinvtax = ""; //8.8%
			}

			if ($invamount != "") {
				$setinvamount = $invamount;
			} else {
				$setinvamount = "";
			}

			if ($invpaid != "") {
				$setinvpaid = $invpaid;
			} else {
				$setinvpaid = "";
			}

			if ($invbaldue != "") {
				$setinvbaldue = $invbaldue;
			} else {
				$setinvbaldue = "";
			}

			if ($invtaxrate != "") {

				$setinvtaxrate = $invtaxrate;
			} else {

				$company_tax_rate_q = "SELECT `company_tax_rate` FROM `company_info` WHERE 1";

				$company_tax_rate_query = $this->db->query($company_tax_rate_q);
				$company_tax_rate_res = $company_tax_rate_query->result_array();
				$company_tax_rate = $company_tax_rate_res[0];

				$setinvtaxrate = $company_tax_rate['company_tax_rate'];
			}


			if ($invcntry != "") {
				$setinvcntry = $invcntry;
			} else {
				$setinvcntry = "";
			}


			if ($invuser != "") {
				$setinvuser = $invuser;
			} else {
				$setinvuser = "";
			}

			if ($invdescount != "") {
				$setinvdescount = $invdescount;
				if ($setinvdescount == 0) {
					$setinvdescount = "";
				}
			} else {
				$setinvdescount = "";
			}


			if ($isinvoicerow->invoice_id == $invoiceId) {
				$lstinvoiceid = "fa-plus";
				$lstinvoicecls = "btn-success";
				$fninvoce = "fncrinvoice('" . $invoiceId . "')";
			} else {
				$lstinvoiceid = "fa-minus";
				$lstinvoicecls = "btn-danger";
				$fninvoce = "fndelinvoice('" . $invoiceId . "')";
			}


		?>

			<tr class="tr_clone invrowtb invrowtb<?= $k++ ?> hdninvrowIdtr<?= $j ?>  <?php if ($k == 3) {
																							echo 'active-cust';
																						} ?>" onclick="fngetinvoicedetails('<?= $invoiceId ?>','items','<?= $invcustId ?>')">




				<td>
					<a onclick="fngetinvoicedetails('<?= $invoiceId ?>')" style="cursor: pointer; display: none;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
					<input type="hidden" class="hdninvrowId hdninvrowId<?= $j++ ?> 1" name="hdninvrowId" id="hdninvrowId" value="<?= $invoiceId ?>">
				</td>

				<td>




					<?= $invoicesql_dtls->invoice_id ?></td>

				<td>
					<?php $dt = date("m/d/Y", strtotime($invdate)); ?>
					<input type="text" name="invoice_date<?= $invoiceId ?>" id="invoice_date<?= $invoiceId ?>" class="form-control invcedt w80" placeholder="mm/dd/yyyy" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" onblur="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_date')">

				</td>

				<td>
					<?php $dt = date("m/d/Y", strtotime($invduedate)); ?>
					<input type="text" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" class="form-control invdudate w80" value="<?= ($dt != "01/01/1970") ? $dt : ""; ?>" placeholder="mm/dd/yyyy" onblur="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_due_date')">
				</td>


				<?php if ($invoicetype == '') { ?>

					<td>
						<?php

						$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $isinvoicerow->cust_id . "' ORDER BY event_id ASC ");



						?>

						<select class="form-control" onload="focus()" autofocus onblur="focus0(<?= $i ?>)" readonly name="invoice_event_type<?= $invoiceId ?>" id="invoice_event_type<?= $invoiceId ?>" style="width: 100%; min-width: 200px;" onchange="fnupdateinvoicetypeinfo(this.value,'<?= $invoiceId ?>','invoice_type')">
							<option value="0">Select</option>
							<?php


							foreach ($evntypsql->result() as $evntypsql_dtls) {

								$evntdata     = $this->db->query("SELECT * FROM register_customer WHERE cus_id='" . $isinvoicerow->cust_id . "'");
								$evntdatarow  = $evntdata->row();
								$seteventname = "";
								$chkisjobs    = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $evntypsql_dtls->event_id . "' ORDER BY event_id ASC  LIMIT 2");
								$chknjobsrows = $chkisjobs->num_rows();


								if ($chknjobsrows > 1) {
									foreach ($chkisjobs->result() as $chkisjobs_dtls) {
										$seteventname .= $chkisjobs_dtls->jb_name . "-";
									}
								} else {
									$seteventname = $evntdatarow->cus_lname . " - " . $evntdatarow->cus_company_name;
								}

								if ($evntypsql_dtls->event_id == $invoicetype) {
									$selectedevtyp = "selected";
								} else {
									$selectedevtyp = "";
								}

								if ($evntypsql_dtls->event_date != "") {
									$con_date = date("m/d/Y", strtotime($evntypsql_dtls->event_date));
								} else {
									$con_date = "";
								}

								$eventname = $evntypsql_dtls->event_name;
								$eventname = str_replace('-', ' - ', $eventname);

							?>
								<option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->event_id ?>"><?= $eventname . " - " . $con_date . " - " . $evntypsql_dtls->event_type ?></option>

							<?php } ?>
						</select>
					</td>

				<?php } else {  ?>



					<td>
						<?php

						$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $isinvoicerow->cust_id . "' ORDER BY event_id ASC ");



						?>

						<select class="form-control" onload="focus()" autofocus onblur="focus0(<?= $i ?>)" readonly name="invoice_event_type<?= $invoiceId ?>" id="invoice_event_type<?= $invoiceId ?>" style="width: 100%; min-width: 200px;" onchange="fnupdateinvoicetypeinfo(this.value,'<?= $invoiceId ?>','invoice_type')">

							<?php


							foreach ($evntypsql->result() as $evntypsql_dtls) {

								$evntdata     = $this->db->query("SELECT * FROM register_customer WHERE cus_id='" . $isinvoicerow->cust_id . "'");
								$evntdatarow  = $evntdata->row();
								$seteventname = "";
								$chkisjobs    = $this->db->query("SELECT * FROM event_jobs WHERE event_id='" . $evntypsql_dtls->event_id . "' ORDER BY event_id ASC  LIMIT 2");
								$chknjobsrows = $chkisjobs->num_rows();



								if ($chknjobsrows > 1) {
									foreach ($chkisjobs->result() as $chkisjobs_dtls) {
										$seteventname .= $chkisjobs_dtls->jb_name . "-";
									}
								} else {
									$seteventname = $evntdatarow->cus_lname . " - " . $evntdatarow->cus_company_name;
								}



								if ($evntypsql_dtls->event_date != "") {
									$con_date = date("m/d/Y", strtotime($evntypsql_dtls->event_date));
								} else {
									$con_date = "";
								}

								$eventname = $evntypsql_dtls->event_name;
								$eventname = str_replace('-', ' - ', $eventname);

								if ($evntypsql_dtls->event_id == $invoicetype) {
									$selectedevtyp = "selected";
							?>
									<option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->event_id ?>"><?= $eventname . " - " . $con_date . " - " . $evntypsql_dtls->event_type ?></option>
								<?php
								} else {
									$selectedevtyp = "";
								}

								?>
							<?php } ?>
						</select>
					</td>
				<?php }  ?>
				<?php if ($contracttype == "") { ?>
					<td>

						<select readonly onblur="focus1()" class="form-control focus1<?= $i++ ?>" name="invoice_contract_type<?= $invoiceId ?>" id="invoice_contract_type<?= $invoiceId ?>" style="width: 100%; min-width: 200px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_contract_type')">
							<option value="">Select</option>

							<?php


							$evntypsql = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=35 ORDER BY sub_id ASC");

							foreach ($evntypsql->result() as $evntypsql_dtls) {
								if ($evntypsql_dtls->sub_id == $contracttype) {

									$selectedevtyp = "selected";
								} else {

									$selectedevtyp = "";
								}
							?>
								<option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->sub_id ?>"><?= $evntypsql_dtls->sub_name ?></option>
							<?php } ?>
						</select>
					</td>

				<?php } else { ?>
					<td>

						<select readonly onblur="focus1()" class="form-control focus1<?= $i++ ?>" name="invoice_contract_type<?= $invoiceId ?>" id="invoice_contract_type<?= $invoiceId ?>" style="width: 100%; min-width: 200px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_contract_type')">


							<?php


							$evntypsql = $this->db->query("SELECT * FROM sub_categories WHERE cat_id=35 ORDER BY sub_id ASC");

							foreach ($evntypsql->result() as $evntypsql_dtls) {
								if ($evntypsql_dtls->sub_id == $contracttype) {

									$selectedevtyp = "selected";
							?>
									<option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->sub_id ?>"><?= $evntypsql_dtls->sub_name ?></option>
								<?php
								} else {

									$selectedevtyp = "";
								}
								?>

							<?php } ?>
						</select>
					</td>
				<?php } ?>
				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<!-- <span class="glyphicon glyphicon-usd"></span> -->
							</span>

							<!-- <input type="text" name="invoice_discount<?= $invoiceId ?>" id="invoice_discount<?= $invoiceId ?>" class="form-control updwn" style="width: 40px;" value="<?= $setinvdescnt ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_discount')" > -->

							<select tabindex="-1" name="invoice_discount<?= $invoiceId ?>" id="invoice_discount<?= $invoiceId ?>" class="form-control updwn discntyp" style="width: 42px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_discount')">
								<option value=""> </option>
								<option <?php if ($setinvdescnt == '1') {
											echo "selected";
										} ?> value="1">$</option>
								<option <?php if ($setinvdescnt == '2') {
											echo "selected";
										} ?> value="2">%</option>
							</select>


						</div>
					</div>
				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<input type="text" tabindex="-1" name="invoice_descnt<?= $invoiceId ?>" id="invoice_descnt<?= $invoiceId ?>" class="form-control updwn invdescount" style="width: 60px;" value="<?= $setinvdescount ?>">
						</div>
					</div>
				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<!--$setinvamount-->
							<input type="text" name="invoice_amount" class="form-control invoicamount 2" style="width: 80px;" value="<?= sprintf('%0.2f', $item_price_tot) ?>" disabled>
						</div>
					</div>
				</td>





				<td>
					<input type="text" tabindex="-1" name="invoice_tax<?= $invoiceId ?>" id="invoice_tax<?= $invoiceId ?>" class="form-control updwn" style="width: 60px;" value="<?= $setinvtax ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax')">
				</td>






				<td>

					<input type="text" name="invoice_tax_rate<?= $invoiceId ?>" id="invoice_tax_rate<?= $invoiceId ?>" class="3 form-control updwn 1" value="<?= $setinvtaxrate ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax_rate')" style="width: 90px;" readonly>
				</td>


				<td><?php
					$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  
                  FROM customers_package_items WHERE inv_id='" . $invoiceId . "'");

					$getsumdescntrow = $sumofdescntitemsql->row();
					$descountitemstot = $getsumdescntrow->discounted_amt;

					$pck_discnt_amt = $this->db->query("SELECT SUM(pck_discnt_amt) AS pck_discnt_amt, pck_discnt_typ, package_id  
                  FROM customer_assigned_packages WHERE inv_id='" . $invoiceId . "'");

					$getsumdescntrow1   = $pck_discnt_amt->row();
					$descountitemstot1  = $getsumdescntrow1->pck_discnt_amt;
					$pck_discnt_typ1    = $getsumdescntrow1->pck_discnt_typ;
					$package_id         = $getsumdescntrow1->package_id;


					$customer_assigned_packages_Q = $this->db->query("SELECT pck_discnt_amt, pck_discnt_typ, package_id FROM customer_assigned_packages WHERE inv_id='" . $invoiceId . "'");

					$customer_assigned_packages_R = $customer_assigned_packages_Q->result_array();
					$last_pck_discnt_amt = 0;

					foreach ($customer_assigned_packages_R as $row) {

						$package_id1 = $row['package_id'];
						$pck_discnt_typ = $row['pck_discnt_typ'];
						$pck_discnt_amt = $row['pck_discnt_amt'];
						$admin_package_itemq = $this->db->query("SELECT * FROM admin_package WHERE package_id='" . $package_id1 . "'");
						$admin_package_item   = $admin_package_itemq->row();
						$package_price = $admin_package_item->package_price;
						if ($pck_discnt_typ == 1) {
							$pck_discnt_amt = $pck_discnt_amt;
						} else {
							$pck_discnt_amt = $package_price / 100 * $pck_discnt_amt;
						}
						$last_pck_discnt_amt = $last_pck_discnt_amt + $pck_discnt_amt;
					}

					$bal = $setinvsubtot + $descountitemstot + $last_pck_discnt_amt;

					//print_r($invoice_balance_due);
					?>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_discnt_amt<?= $invoiceId ?>" id="invoice_discnt_amt<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $bal) ?>" disabled>
						</div>
					</div>
				</td>



				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_paid" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvpaid) ?>" disabled>
						</div>
					</div>
				</td>


				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>



							<!--$setinvbaldue-->

							<input type="text" name="invoice_balance_due" class="1 form-control invoice_balance_due" style="width: 80px;" value="<?= sprintf('%0.2f', $invoice_balance_due - $bal) ?>" disabled>
						</div>
					</div>
				</td>


				<td>
					<!-- <input type="text" name="invoice_country<?= $invoiceId ?>" id="invoice_country<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvcntry ?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_county')" > -->

					<input type="text" tabindex="-1" name="invoice_country<?= $invoiceId ?>" list="countylist" id="invoice_country<?= $invoiceId ?>" class="form-control updwn invcountey" value="<?= $setinvcntry ?>" style="width: 80px;">

					<datalist id="countylist">
						<?php
						$getusersql = $this->db->query("SELECT * FROM users WHERE id='" . $this->session->userdata['fi_session']['id'] . "'");
						$getusersqlrow = $getusersql->row();
						$contylist = $this->db->query("SELECT * FROM tbl_counties_list WHERE State='" . $getusersqlrow->state . "' ORDER BY id ASC");
						foreach ($contylist->result() as $contylist_dtls) {

						?><option data-value="<?= $contylist_dtls->State ?>" value="<?= $contylist_dtls->County ?>"><?= $contylist_dtls->County ?></option>

						<?php } ?>

					</datalist>

				</td>

				<!-- User  -->
				<td>
					<input type="text" name="invoice_user" class="form-control" value="Mike" readonly="true" tabindex="-1">
					<!-- <input type="text" name="invoice_user<?= $invoiceId ?>" id="invoice_user<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvuser ?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_user')"> -->
				</td>

				<td>
					<!-- <a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true" ></i></a> -->
					<a tabindex="-1" href="<?= site_url('PaymentsCont/c_payment/') . $invcustId ?>"><i class="fa fa-money" aria-hidden="true"></i></a>
				</td>

				<td>
					<!-- <a tabindex = "-1" href="<?= site_url('Fi_home/print_inv/'); ?>" >P</a> -->
					<button tabindex="-1" onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> tr_clone_add"><i class="fa <?= $lstinvoiceid ?>"></i></button>
				</td>




			</tr>

			<?php
		}
	}

	public function insertcrew($crew)
	{

		return $this->db->insert('event_crews', $crew);
	}

	public function fninsertcrews_dtls1()
	{

		$insertlocarr = array(

			'event_id'          => $this->input->post('txtshdneventId'),
			//'crews_confirmed_on'=>    $this->input->post('confrchk'),
			'crews_type'        =>  $this->input->post('crwtype'),
			'crews_start_date'  =>  $this->input->post('temp_st_date'),
			'crews_start_time'  =>   $this->input->post('valuestart'),
			'crews_end_date'    => $this->input->post('temp_en_date'),
			'crews_end_time'    => $this->input->post('valuestop'),
			'crews_location'    => $this->input->post('crews_location'),
			'crews_total_hours' =>  $this->input->post('tothrs')
			//'location_note'   =>    $this->input->post('note')
		);
		if ($this->db->insert('event_crews', $insertlocarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fncreatenwcrewsinfo_dtls()
	{

		$updatecrew = array(
			"event_id" => $_POST['hdncreventId'],
			"crews_type" => $_POST['temp_atype'],
			"crews_vendor" => $_POST['temp_cavailvend'],
			"crews_start_date" => $_POST['temp_castart_date']
		);

		if ($this->db->insert('event_crews', $updatecrew)) {

			$updtcrsts = array(
				"add_to_crews" => "1"
			);
			$this->db->where('id', $_POST['hdncravlId']);
			//$this->db->where('event_id',$_POST['hdncreventId']);
			$this->db->update('crew_availability', $updtcrsts);

			echo "success";
		}
	}

	public function fncreatenewcrewssinfo_dtls()
	{
		$updatecrew = array(
			"event_id" => $_POST['hdncreventId'],
			"crews_type" => $_POST['temp_atype'],
			"crews_vendor" => $_POST['temp_cavailvend'],
			"crews_start_date" => $_POST['temp_castart_date']
		);
		if ($this->db->insert('event_crews', $updatecrew)) {

			echo "success";
		}
	}

	public function user_contact_info($id)
	{

		$this->db->where('cus_id', $id);
		$this->db->where('email !=', null);
		$this->db->where('email !=', '');
		$query = $this->db->get('user_contact_info');
		return $query->result_array();
	}

	public function user_name($id)
	{

		$this->db->where('cus_id', $id);

		$query = $this->db->get('register_customer');
		return $query->result_array();
	}

	public function search_customer2($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $accno, $acctype, $vendorname, $evfdate, $evtdate, $evtype, $evtlocn, $evtinv_no, $evtreff_by, $bal_as_of)
	{

		error_reporting(0);

		$con1 = "";
		if ($fname != "") {
			$con1 = 'o.cus_fname LIKE "' . $fname . '%" OR o.cus_lname LIKE "%' . $fname . '%" OR o.cus_company_name LIKE "%' . $fname . '%" OR c.cus_id 
          IN (SELECT Distinct cus_id FROM events_register where event_name LIKE "%' . $fname . '%" OR event_id IN (SELECT event_id FROM `event_jobs` WHERE jb_name LIKE "%' . $fname . '%"))';
		}

		if ($lname != "") {

			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_lname LIKE "%' . $lname . '%"';
			} else {
				$con1 = 'o.cus_lname LIKE "' . $lname . '%"';
			}
		}

		if ($cname != "") {

			if ($con1 != "") {
				$con1 = $con1 . " AND " . 'o.cus_company_name LIKE "%' . $cname . '%"';
			} else {
				$con1 = 'o.cus_company_name LIKE "%' . $cname . '%"';
			}
		}

		if ($zname != "") {

			if ($con1 != "") {

				$con1 = $con1 . " AND " . 'o.cus_zip LIKE "%' . $zname . '%"';
			} else {

				$con1 = 'o.cus_zip LIKE "%' . $zname . '%"';
			}
		}

		if ($mname != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'c.contact_no ="'.$mname.'"';
				$con1 = $con1 . " AND " . 'c.contact_no LIKE "%' . $mname . '%"';
			} else {
				//$con1='c.contact_no ="'.$mname.'"';
				$con1 = 'c.contact_no LIKE "%' . $mname . '%" OR c.cus_id IN (SELECT Distinct cus_id FROM customer_additional_contacts where cel LIKE "%' . $mname . '%" OR home LIKE "%' . $mname . '%" OR work LIKE "%' . $mname . '%")';
			}
		}

		if ($adr1 != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_address1 ="'.$adr1.'"';
				// $con1= $con1 ." AND ".'o.cus_address1 LIKE "%'.$adr1.'%"';
				$con1 = $con1 . " AND " . 'o.cus_address1 LIKE "%' . $adr1 . '%" OR o.cus_zip LIKE "%' . $adr1 . '%" OR o.cus_address2 LIKE "%' . $adr1 . '%" OR o.cus_city LIKE "%' . $adr1 . '%" OR o.cus_state LIKE "%' . $adr1 . '%"';
			} else {
				//$con1='o.cus_address1 ="'.$adr1.'"';
				$con1 = 'o.cus_address1 LIKE "%' . $adr1 . '%" OR o.cus_zip LIKE "%' . $adr1 . '%" OR o.cus_address2 LIKE "%' . $adr1 . '%" OR o.cus_city LIKE "%' . $adr1 . '%" OR o.cus_state LIKE "%' . $adr1 . '%"';
			}
		}

		if ($adr2 != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_address2 ="'.$adr2.'"';
				$con1 = $con1 . " AND " . 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			} else {
				//$con1='o.cus_address2 ="'.$adr2.'"';
				$con1 = 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			}
		}

		if ($cities != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_city ="'.$cities.'"';
				$con1 = $con1 . " AND " . 'o.cus_city LIKE "%' . $cities . '%"';
			} else {
				//$con1='o.cus_city ="'.$cities.'"';
				$con1 = 'o.cus_city LIKE "%' . $cities . '%"';
			}
		}

		if ($states != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_state ="'.$states.'"';
				$con1 = $con1 . " AND " . 'o.cus_state LIKE "%' . $states . '%"';
			} else {
				//$con1='o.cus_state ="'.$states.'"';
				$con1 = 'o.cus_state LIKE "%' . $states . '%"';
			}
		}

		if ($area != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
				$con1 = $con1 . " AND " . 'o.cus_area LIKE "%' . $area . '%"';
			} else {
				//$con1='o.cus_area ="'.$area.'"';
				$con1 = 'o.cus_area LIKE "%' . $area . '%"';
			}
		}
		if ($accno != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
				$con1 = $con1 . " AND " . 'o.cus_acc_no LIKE "%' . $accno . '%"';
			} else {
				//$con1='o.cus_area ="'.$area.'"';
				$con1 = 'o.cus_acc_no LIKE "%' . $accno . '%"';
			}
		}

		if ($acctype != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';  customer_payment_history
				if ($acctype == 1) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked = 1)";
				} elseif ($acctype == 2) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_lost = 1)";
				} elseif ($acctype == 0) {
					$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked=0 AND event_lost = 0)";
				}
			} else {

				if ($acctype == 1) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked = 1)";
				} elseif ($acctype == 2) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_lost = 1)";
				} elseif ($acctype == 0) {
					$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_booked=0 AND event_lost = 0)";
				}

				// $con1="o.cus_id IN (SELECT Distinct cust_id FROM customer_payment_history WHERE type LIKE '%".$acctype."%')";
			}
		}
		if ($vendorname != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN(SELECT event_id FROM event_crews WHERE crews_vendor LIKE '%" . $vendorname . "%' ))";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN(SELECT event_id FROM event_crews WHERE crews_vendor LIKE '%" . $vendorname . "%') )";
			}
		}
		if ($evfdate != "" && $evtdate != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date >='" . $evfdate . "' AND event_end_date <='" . $evtdate . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date >='" . $evfdate . "' AND event_end_date <='" . $evtdate . "')";
			}
		} elseif ($evfdate != "" && $evtdate == "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date ='" . $evfdate . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_date ='" . $evfdate . "')";
			}
		} elseif ($evtdate != "" && $evfdate == "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_end_date ='" . $evtdate . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_end_date ='" . $evtdate . "')";
			}
		}
		if ($evtype != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_type ='" . $evtype . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_type ='" . $evtype . "')";
			}
		}
		if ($evtlocn != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN (SELECT event_id FROM event_location WHERE location_type='" . $evtlocn . "' ))";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_id IN (SELECT event_id FROM event_location WHERE location_type='" . $evtlocn . "'))";
			}
		}
		if ($evtinv_no != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cust_id FROM invoices_create WHERE invoice_id='" . $evtinv_no . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cust_id FROM invoices_create WHERE invoice_id='" . $evtinv_no . "')";
			}
		}

		if ($evtreff_by != "") {
			if ($con1 != "") {

				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_referred_by LIKE '%" . $evtreff_by . "%')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cus_id FROM events_register WHERE event_referred_by LIKE '%" . $evtreff_by . "%')";
			}
		}
		if ($bal_as_of != "") {
			if ($con1 != "") {


				$con1 = $con1 . "AND o.cus_id IN (SELECT Distinct cust_id FROM invoices_create GROUP BY cust_id HAVING SUM(invoice_balance_due)='" . $bal_as_of . "')";
			} else {

				$con1 = "o.cus_id IN (SELECT Distinct cust_id FROM invoices_create GROUP BY cust_id HAVING SUM(invoice_balance_due)='" . $bal_as_of . "')";
			}
		}
		//GROUP BY o.cus_id
		$cust1 = $this->db->query("SELECT  `o`.`cus_id`, `o`.`user`, `o`.`cus_title`, `o`.`cus_fname`, `o`.`cus_lname`, `o`.`cus_company_name`, `o`.`cus_address1`, `o`.`cus_address2`, `o`.`cus_city`, `o`.`cus_state`, `o`.`cus_zip`, `o`.`cus_area`, `o`.`cus_tax_status`, `o`.`cus_tax_id`, `o`.`cus_status`, `o`.`cus_acc_no`, `o`.`custom1`, `o`.`custom2`, `o`.`cus_register_date` from user_contact_info AS c,register_customer AS o WHERE " . $con1 . " AND c.cus_id = o.cus_id GROUP BY `o`.`cus_id`  ORDER BY o.cus_lname, o.cus_fname");

		/* `c`.`contact_id`,
            `c`.`cus_id`,
            `c`.`conatct_type`,
            `c`.`contact_no`,
            `c`.`contact_details`,
            `c`.`default_contact`,
            `c`.`user_contact_note`,
            `c`.`email`*/

		// print_r($this->db->last_query());
		// print_r($this->db->last_query());    

		if ($cust1->num_rows() > 0) {
			$srno = 1;
			foreach ($cust1->result() as $cust1_dtls) {
				$phonarr = array();
				$notesarr = array();
				$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '" . $cust1_dtls->cus_id . "'");

				foreach ($cntinfosql->result() as $cntinfosql) {
					$phonarr[] .= $cntinfosql->contact_no;
					$notesarr[] .= $cntinfosql->user_contact_note;
				}

				$setnotes = implode(",", $notesarr);
				$setphones = implode(",", $phonarr);

				$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$cust1_dtls->cus_id' AND conatct_type!='Email' AND default_contact=1");
				$cntctinfosql_row = $cntctinfosql->row();
				$htmlphone = $cntctinfosql_row->contact_no;
				$htmlnotes = $cntctinfosql_row->user_contact_note;

				//search_customer_opt
				$act_custsql = $this->db->query("SELECT * FROM search_customer_opt");
				$act_custrow = $act_custsql->row();
				$getfname       = $act_custrow->cus_fname;
				$getlname       = $act_custrow->cus_lname;
				$getcname       = $act_custrow->cus_company_name;
				$getaddr1       = $act_custrow->cus_address1;
				$getaddr2       = $act_custrow->cus_address2;
				$getcity        = $act_custrow->cus_city;
				$getstate       = $act_custrow->cus_state;
				$getzip         = $act_custrow->cus_zip;
				$getarea        = $act_custrow->cus_area;
				$getphno        = $act_custrow->phone_no;
				$getacc_no      = $act_custrow->acc_no;
				$getacc_type    = $act_custrow->acc_type;
				$getvendor_name = $act_custrow->vendor_name;
				$getevent_from_date = $act_custrow->event_from_date;
				$getevent_to_date = $act_custrow->event_to_date;
				$getevent_type  = $act_custrow->event_type;
				$getevent_location = $act_custrow->event_location;
				$getinvoice_no  = $act_custrow->invoice_no;
				$getreferred_by = $act_custrow->referred_by;

				if ($getfname == 1) {
					$fnmamechksts = "display: table-cell;";
				} else {
					$fnmamechksts = "display: table-cell";
				}

				if ($getlname == 1) {
					$lnmamechksts = "display: table-cell;";
				} else {
					$lnmamechksts = "display: table-cell";
				}


				if ($getcname == 1) {
					$cnmamechksts = "display: table-cell;";
				} else {
					$cnmamechksts = "display: table-cell";
				}


				if ($getaddr1 == 1) {
					$addr1chksts = "display: table-cell;";
				} else {
					$addr1chksts = "display: table-cell";
				}

				if ($getaddr2 == 1) {
					$addr2chksts = "display: table-cell;";
				} else {
					$addr2chksts = "display: table-cell";
				}

				if ($getcity == 1) {
					$citychksts = "display: table-cell;";
				} else {
					$citychksts = "display: table-cell";
				}

				if ($getstate == 1) {
					$statechksts = "display: table-cell;";
				} else {
					$statechksts = "display: table-cell";
				}

				if ($getzip == 1) {
					$zipchksts = "display: table-cell;";
				} else {
					$zipchksts = "display: table-cell";
				}

				if ($getarea == 1) {
					$areachksts = "display: table-cell;";
				} else {
					$areachksts = "display: table-cell";
				}

				if ($getphno == 1) {
					$phnochksts = "display: table-cell;";
				} else {
					$phnochksts = "display: table-cell";
				}



			?>

				<tr ondblclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')">
					<td>
						<a onclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
					</td>

					<td><?= $srno ?></td>
					<td><?= $cust1_dtls->cus_title ?></td>
					<td><?= $cust1_dtls->cus_lname ?></td>
					<td><?= $cust1_dtls->cus_fname ?></td>
					<td><?= $cust1_dtls->cus_company_name ?></td>
					<td><?= $htmlphone ?></td>
					<td><?= $cust1_dtls->cus_address1 ?></td>
					<td><?= $cust1_dtls->cus_address2 ?></td>
					<td><?= $cust1_dtls->cus_city ?></td>
					<td><?= $cust1_dtls->cus_state ?></td>
					<td><?= $cust1_dtls->cus_zip ?></td>
					<td><?= $cust1_dtls->cus_area ?></td>
					<td><?= trim($htmlnotes, ",") ?></td>

				</tr>


		<?php $srno++;
			}
		} else {

			echo "No Customers Found..!";
		}
	}




	public function getSearchInvoiceInfo_dtls()
	{

		error_reporting(0);

		$getinv_sql = $this->db->query("SELECT * FROM events_register WHERE event_id='" . $_POST['eventId'] . "'");
		$getinvsql_row = $getinv_sql->row();
		$invId = $getinvsql_row->inv_id; //$this->input->post('invId');

		$this->db->select('*');
		$this->db->from('invoices_create');
		$this->db->where('invoice_id', $invId);
		$singleinvinfo = $this->db->get()->result_array()[0];
		// echo "SELECT * FROM register_customer WHERE cus_id='".$_POST['cusid']."' AND cus_id !=''";die;
		$custregsql = $this->db->query("SELECT * FROM register_customer WHERE cus_id='" . $_POST['cusid'] . "' AND cus_id !=''");
		$custregsqlrow = $custregsql->row();

		$balance_count = $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id', $_POST['cusid'])->get('invoices_create')->result_array()[0];

		// print_r($custregsqlrow->cus_acc_no);
		?>

		<div class="col-md-2 cus_acc_no">
			<div class="form-group" id="lastinvId">
				<input class="form-control" type="text" placeholder="433" value="<?= $custregsqlrow->cus_acc_no ?>" readonly disabled>
				<!--   <input class="form-control"  type="text" placeholder="433" value="<?php //echo $singleinvinfo['invoice_id'] 
																							?>"> -->
			</div>
		</div>

		<div class="col-md-2 balance_count">
			<div class="form-group" id="lastinvduebal">
				<input class="form-control" type="text" placeholder="$16.33" value="$ <?= sprintf('%0.2f', $balance_count['total']) ?>" readonly disabled>
				<!-- <input class="form-control"  type="text" placeholder="$16.33" value="$ <?= sprintf('%0.2f', $singleinvinfo['invoice_balance_due']) ?>"> -->
			</div>
		</div>
	<?php
	}





	function fndelevntjobinfo_dtls()
	{

		$this->db->where('jb_id', $this->input->post('jbId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('event_jobs')) {
			echo "success";
		} else {
			echo "error";
		}
	}



	public function check_corr($id)
	{

		$this->db->select('id');
		$this->db->from('correspondence');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$singleinvinfo = $this->db->get()->result_array();
		//print_r($this->db->last_query());

		// $query = $this->db->insert('correspondence', $data);
		// print_r($this->db->last_query());   

		return $singleinvinfo;
	}



	public function insert_corr($data)
	{
		$query = $this->db->insert('correspondence', $data);
		// print_r($this->db->last_query());   

		return 1;
	}

	public function update_corr($data, $i)
	{

		$this->db->where('id', $i);
		$query = $this->db->update('correspondence', $data - toggle);



		//print_r($this->db->last_query());   

		return 1;
	}




	public function vendor_search_data()
	{
		$query = $this->db->select('register_vendor.cus_id,register_vendor.cus_fname,register_vendor.cus_lname,register_vendor.cus_company_name,register_vendor.cus_address1,register_vendor.cus_address2,register_vendor.cus_city,register_vendor.cus_state,register_vendor.cus_zip')
			->from('register_vendor')
			->order_by("register_vendor.cus_id DESC")
			->get();
		return $query->result_array();
	}
	public function updateappointment()
	{

		$notestype_user = $this->input->post('notestype_user');
		$feildname      = $this->input->post('fieldnm');
		$invoiceid      = $this->input->post('invoiceid');

		$updateinvarr = array(
			$feildname  => $this->input->post('inptxtval'),
			'for_user'  => $notestype_user
		);

		$this->db->where('id', $invoiceid);

		if ($this->db->update('customer_appointment', $updateinvarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function get_correspondence_list()
	{
		$query = $this->db->get('correspondence');
		return $query->result();
	}

	public function addcorrespondence($data)
	{
		return $this->db->insert('customer_correspondence', $data);
	}

	public function addcoustomer($item)
	{

		$query = $this->db->insert('register_customer', $item);
		$cus_id = $this->db->insert_id();
		$this->session->set_userdata('id', $cus_id);
		return $cus_id;
	}

	public function Event_Name_Update($lname_company, $id)
	{

		$item = array('event_name' => $lname_company);
		$this->db->where('cus_id', $id);
		$abcd = $this->db->update('events_register', $item);

		$this->db->where('cus_id', $id);
		$query = $this->db->get('events_register');
		$esult = $query->result_array();

		foreach ($esult as $row) {

			$item = array('jb_name' => $lname_company);
			$this->db->where('event_id', $row['event_id']);
			$this->db->update('event_jobs', $item);
		}
	}

	public function up_addcoustomer($item, $up_id)
	{

		$id = $up_id;
		$this->db->where('cus_id', $id);
		$this->db->update('register_customer', $item);
		return true;
	}

	//Prasanna 3 Deposite
	public function deposite_ajax($receipt_to, $receipt_from, $date_from, $date_to, $amount, $deposite_num, $check)
	{

		if ($date_from != '' && $date_to != '') {
			$date_from  = date("Y-m-d", strtotime($date_from));
			$date_to    = date("Y-m-d", strtotime($date_to));
		}


		$arr = array('c.do_deposite' => 1, 'c.status' => 1, '`c`.`receipt' => $receipt_from, '`c`.`receipt` <=' => $receipt_to, '`c`.`chk_num`' => $check, '`c`.`deposit`' => $deposite_num, '`c`.`amount`' => $amount, '`c`.`date` >=' => $date_from, '`c`.`date` <=' => $date_to);

		foreach ($arr as $key => $val) {
			if ($val == '')
				unset($arr[$key]);
		}

		print_r($arr);

		$query = $this
			->db
			->select(' `r`.`cus_id`,
                `r`.`cus_title`,
                `r`.`cus_fname`,
                `r`.`cus_lname`,
                `r`.`cus_company_name`,
                `r`.`cus_address1`,
                `r`.`cus_address2`,
                `r`.`cus_city`,
                `r`.`cus_state`,
                `r`.`cus_zip`,
                `r`.`cus_area`,
                `r`.`cus_tax_status`,
                `r`.`cus_tax_id`,
                `r`.`cus_status`,
                `r`.`cus_register_date`,
                `r`.`cus_acc_no`,
                `c`.`id` c_id,
                `c`.`cust_id`,
                `c`.`date`,
                `c`.`receipt`,
                `c`.`type`,
                `c`.`chk_num`,
                `c`.`pdesc`,
                `c`.`amount`,
                `c`.`credit`,
                `u`.`username`,
                `c`.`notes`,
                `c`.`deposit`,
                `c`.`status`,
                `c`.`date_do_deposite`')
			->from('`register_customer` `r`')
			->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
			->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
			->where($arr)
			->order_by("r.cus_id DESC")
			->get();

		//print_r($query) ;
		return $query->result_array();
	}

	//Prasanna 1
	public function max_id()
	{

		$maxid = 0;
		$row = $this->db->query('SELECT MAX(cus_id) AS `max_id` FROM `register_customer`')->row();
		if ($row) {
			$maxid = $row->max_id;
		}

		$cust_inv1 = $this->db->query("SELECT `invoice_name`, `invoice_date`, `invoice_due_date`, `invoice_type`, `invoice_contract_type`, `invoice_discount`, `invoice_sub_total`, `invoice_tax`, `invoice_amount`, `invoice_paid`, `invoice_balance_due`, `invoice_tax_rate` FROM invoices_create WHERE `cust_id` = '$maxid'");
		return $cust_inv1;
	}

	//Prasanna 2
	public function delete_payment_ajax($id)
	{

		$data = array(
			'status' => 0
		);

		$data =  $this->db->update('customer_payment_history', $data, "id = $id");
		return 1;
	}

	//Prasanna 3
	public function selectreceivables_ajax($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to)
	{

		if ($date_from != '' && $date_to != '') {
			$date_from  = date("Y-m-d", strtotime($date_from));
			$date_to    = date("Y-m-d", strtotime($date_to));
		}


		$arr = array('c.do_deposite !=' => 1, 'c.status' => 1, '`c`.`receipt' => $receipt_from, '`c`.`receipt` <=' => $receipt_to, '`c`.`chk_num`' => $check, '`c`.`deposit`' => $deposite_num, '`c`.`amount`' => $amount, '`c`.`date` >=' => $date_from, '`c`.`date` <=' => $date_to);

		foreach ($arr as $key => $val) {
			if ($val == '')
				unset($arr[$key]);
		}



		if ($deposite != "") {

			if ($deposite_in == 1) {

				$arr = ['c.do_deposite !=' => 1, 'c.status' => 1, 'c.deposit >=' => 1, 'c.type' => $deposite];
			} else {

				$arr = ['c.do_deposite !=' => 1, 'c.status' => 1, 'c.type' => $deposite];
			}
		} else {

			if ($deposite_in == 1) {

				$arr = [
					'c.do_deposite !=' => 1,
					'c.status' => 1,
					'c.deposit >=' => 1
				];
			}
		}



		$query = $this
			->db
			->select(' `r`.`cus_id`,
                `r`.`cus_title`,
                `r`.`cus_fname`,
                `r`.`cus_lname`,
                `r`.`cus_company_name`,
                `r`.`cus_address1`,
                `r`.`cus_address2`,
                `r`.`cus_city`,
                `r`.`cus_state`,
                `r`.`cus_zip`,
                `r`.`cus_area`,
                `r`.`cus_tax_status`,
                `r`.`cus_tax_id`,
                `r`.`cus_status`,
                `r`.`cus_register_date`,
                `r`.`cus_acc_no`,
                `c`.`id` c_id,
                `c`.`cust_id`,
                `c`.`date`,
                `c`.`receipt`,
                `c`.`type`,
                `c`.`chk_num`,
                `c`.`pdesc`,
                `c`.`amount`,
                `c`.`credit`,
                `u`.`username`,
                `c`.`notes`,
                `c`.`deposit`,
                `c`.`status`')
			->from('`register_customer` `r`')
			->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
			->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
			->where($arr)
			->order_by("r.cus_id DESC")
			->get();

		//print_r($query) ;
		return $query->result_array();
	}


	//Prasanna 5
	public function selectreceivables_ajax_total($deposite, $deposite_in, $receipt_to, $receipt_from, $check, $deposite_num, $amount, $date_from, $date_to)
	{

		if ($date_from != '' && $date_to != '') {
			$date_from  = date("Y-m-d", strtotime($date_from));
			$date_to    = date("Y-m-d", strtotime($date_to));
		}

		$arr = array('c.do_deposite !=' => 1, 'c.status' => 1, '`c`.`receipt' => $receipt_from, '`c`.`receipt` <=' => $receipt_to, '`c`.`chk_num`' => $check, '`c`.`deposit`' => $deposite_num, '`c`.`amount`' => $amount, '`c`.`date` >=' => $date_from, '`c`.`date` <=' => $date_to);
		foreach ($arr as $key => $val) {
			if ($val == '')
				unset($arr[$key]);
		}



		if ($deposite != "") {

			if ($deposite_in == 1) {

				$arr = ['c.do_deposite !=' => 1, 'c.status' => 1, 'c.deposit >=' => 1, 'c.type' => $deposite];
			} else {

				$arr = ['c.do_deposite !=' => 1, 'c.status' => 1, 'c.type' => $deposite];
			}
		} else {

			if ($deposite_in == 1) {

				$arr = [
					'c.do_deposite !=' => 1,
					'c.status' => 1,
					'c.deposit >=' => 1
				];
			}
		}



		$query = $this
			->db
			->select(' count(`r`.`cus_id`) count_,
               
                `c`.`type` type_,
               
                sum(`c`.`amount`) amount_
                ')
			->from('`register_customer` `r`')
			->join('`customer_payment_history` `c`', '`c`.`cust_id` = `r`.`cus_id`')
			->join('`users` `u`', '`u`.`id` = `c`.`usrename`')
			->where($arr)
			->order_by("r.cus_id DESC")
			->get();

		//print_r($query) ;
		return $query->result_array();
	}

	//Prasanna 4
	public function do_deposite($id)
	{

		$arr = array(
			'do_deposite' => 1,
			'date_do_deposite' => date("Y-m-d h:i:sa")
		);

		$this->db->where('id', $id);
		$this->db->update('customer_payment_history', $arr);
	}

	public function fncreatenewlocation_dtls()
	{

		if ($this->input->post('l_name') != 'Choose') {

			$insertlocarr = array(
				'event_id'  => $this->input->post('txtshdnevntId'),
				'location_type' =>  $this->input->post('l_name'),
				'location_date' =>  $this->input->post('seteventstartdate'),
				'location_time' =>  $this->input->post('evstimee'),
				'location_address' => $this->input->post('location_address'),
				'location_city' =>  $this->input->post('location_city'),
				'location_state' => $this->input->post('location_state'),
				'location_zip' =>   $this->input->post('location_zip'),
				'location_phone' => $this->input->post('location_phone_one'),
				'location_phone2' =>    $this->input->post('location_phone_two')
				//'location_note' =>    $this->input->post('note')
			);

			if ($this->db->insert('event_location', $insertlocarr)) {

				echo "success";
			} else {
				echo "error";
			}
		}
	}

	public function fncreatelocation_dtls()
	{


		if ($this->input->post('l_name') != 'Choose') {
			$insertlocarr = array(
				'event_id'  => $this->input->post('txtshdnevntId'),
				'location_type' =>  $this->input->post('l_name'),
				'location_date' =>  $this->input->post('seteventstartdate'),
				'location_time' =>  $this->input->post('evstimee'),
				'location_address' =>   $this->input->post('location_address'),
				'location_city' =>  $this->input->post('location_city'),
				'location_state' => $this->input->post('location_state'),
				'location_zip' =>   $this->input->post('location_zip')
				//'location_note' =>    $this->input->post('note')
			);
			if ($this->db->insert('event_location', $insertlocarr)) {
				echo "success";
			} else {
				echo "error";
			}
		}
	}



	public function update_event_date()
	{

		$eventdate = date("Y-m-d", strtotime($_POST['event_date']));
		$evdtarr = array(
			'event_date' => $eventdate
		);
		$this->db->where('event_id', $_POST['event_id']);
		if ($this->db->update('events_register', $evdtarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	public function update_field()
	{
		$tbl_nm = $_POST['tbl_nm'];
		$set_col_nm = $_POST['set_col_nm'];
		$set_col_val = $_POST['set_col_val'];
		$whr_col_nm = $_POST['whr_col_nm'];
		$whr_col_val = $_POST['whr_col_val'];
		$field_type = strtolower($_POST['field_type']);

		if ($field_type == "date") {
			$set_col_val = date("Y-m-d", strtotime($set_col_val));
		}

		$qry = "UPDATE " . $tbl_nm . " SET " . $set_col_nm . " = '" . $set_col_val . "' WHERE " . $whr_col_nm . " = '" . $whr_col_val . "'";
		$result = $this->db->query($qry);
		if ($result) {
			echo "success";
		} else {
			echo "error";
		}


		//echo $qry;

	}

	public function update_tbl($tbl_nm, $arr, $cond)
	{
		$result = $this->db->where($cond)->update($tbl_nm, $arr);
		if ($result) {
			return "success";
		} else {
			return "error";
		}
	}


	// Insert Change Request by Flour Manager
	public function insertRequest($data)
	{
		return $this->db->insert('tbl_request', $data);
	}
	public function insertcrew_template($crewAdd)
	{
		return $this->db->insert('adm_crewavailability_info', $crewAdd);
	}
	public function insertfile($data)
	{
		return $this->db->insert('file', $data);
	}
	public function insertdriver($data1)
	{
		return $this->db->insert('driver_registration', $data1);
	}
	public function update_dash($id)
	{
		return $this->db->set('dash_status', 2)->where('dash_id', $id)->update('dashboard');
		// return $query  sdgsd;dsgsdgsfa
	}
	public function dismissall_dash()
	{
		return $this->db->set('dash_status', 2)->update('dashboard');
		// return $query;
	}
	public function snooze_dash($id)
	{
		$currentdate = date('Y-m-d H:i:s');
		// print_r($currentdate);echo "<br>";
		$addtime = strtotime("+15 minutes", strtotime($currentdate));
		//gsdnj
		$add = date('Y-m-d H:i:s', $addtime);
		return $this->db->set('dash_snooze', 1)->set('dash_snooze_time', $add)->where('dash_id', $id)->update('dashboard');
	}
	public function dismissall_snooze()
	{
		$currentdate = date('Y-m-d H:i:s');
		$addtime = strtotime("+15 minutes", strtotime($currentdate));
		$add = date('Y-m-d H:i:s', $addtime);
		return $this->db->set('dash_snooze', 1)->set('dash_snooze_time', $add)->update('dashboard');
	}



	public function insertsubcatvalue($data)
	{
		$query = $this->db->insert('sub_categories', $data);
		return $this->db->insert_id();
	}
	public function insertDropCategories($data)
	{
		$query = $this->db->insert('categories', $data);
		return $this->db->insert_id();
	}



	public function addvendor($data)
	{
		$query = $this->db->insert('register_vendor', $data);
		return $this->db->insert_id();
	}

	public function insertnewinvoice($data)
	{
		$query = $this->db->insert('invoices_create', $data);
		return $this->db->insert_id();
	}
	public function insertinvoiceitem($item)
	{
		return $this->db->insert('invoice_item', $item);
	}
	public function insertadditemadmin($item)
	{
		return $this->db->insert('admin_item', $item);
	}
	public function insertinvoicetask($task)
	{
		return $this->db->insert('invoice_task', $task);
	}
	public function insertinvoicepayment($pay)
	{
		return $this->db->insert('invoice_payment', $pay);
	}
	public function insertpickup_info($pickup)
	{
		return $this->db->insert('invoices_pickup_info', $pickup);
	}
	public function insertpickup_req($pickup_req)
	{
		return $this->db->insert('invoice_pickup_required', $pickup_req);
	}
	public function insertinvoice_note($note)
	{
		return $this->db->insert('invoice_note', $note);
	}
	public function insertinvoice_associated($associated)
	{
		return $this->db->insert('invoice_associated_order', $associated);
	}


	public function insertevent($data)
	{
		$query = $this->db->insert('events_register', $data);
		return $this->db->insert_id();
	}
	public function insertlocation($location)
	{
		return $this->db->insert('event_location', $location);
	}

	public function insertjobs($job_data)
	{
		return $this->db->insert('event_jobs', $job_data);
	}
	public function insertcrew_availability($data_a)
	{
		return $this->db->insert('crew_availability', $data_a);
	}
	public function insertassociated_order($associated)
	{
		return $this->db->insert('event_associated_order', $associated);
	}
	public function insertaffiliated_vendor($affiliated)
	{
		return $this->db->insert('event_affiliated_vendor', $affiliated);
	}
	public function addcontactdata($contact)
	{
		return $this->db->insert('user_contact_info', $contact);
	}
	public function del_addcontactdata($up_id)
	{
		$cusid = $up_id;
		$this->db->where('cus_id', $cusid);
		$this->db->delete('user_contact_info');
	}
	public function up_addcontactdata($contact)
	{

		return $this->db->insert('user_contact_info', $contact);
	}

	public function addshipaddress($address)
	{

		return $this->db->insert('ship_address', $address);
	}

	public function up_addshipaddress($address, $up_id)
	{
		$cusid = $up_id;
		$this->db->where('ship_user_id', $cusid);
		$this->db->update('ship_address', $address);
		return true;
	}
	public function check_event_id($id, $cdt)
	{
		$query = $this->db->select('*')
			->from('events_register')
			->where(array("cus_id" => $id, "event_date" => $cdt))
			->get();

		return $query->num_rows();
	}





	public function get_job_info_data_id($id)
	{
		$query = $this->db->select('*')
			->from('event_jobs')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}
	public function get_crews_avability_data_id($id)
	{
		$query = $this->db->select('*')
			->from('crew_availability')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}
	public function get_associated_data_id($id)
	{
		$query = $this->db->select('*')
			->from('event_associated_order')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}
	public function get_affiliated_vendor_data_id($id)
	{
		$query = $this->db->select('*')
			->from('event_affiliated_vendor')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}
	public function cust_search()
	{
		$query = "SELECT c.*,o.* FROM register_customer o
        JOIN user_contact_info c ON o.cus_id=c.user_conatact_id where c.default_contact=1
        ORDER BY o.cus_register_date DESC";

		return $this->db->query($query)->result_array();
	}



	public function fncustsrchbyph_dtls($phone)
	{
		error_reporting(0);

		//$srchcustjson=array();

		//$con1='c.contact_no ="'.$phone.'"';

		$contactinfosql = $this->db->query("SELECT * from user_contact_info WHERE contact_no = '$phone'");

		if ($contactinfosql->num_rows() > 0) {
			$getcntrow = $contactinfosql->row();
			$id = $getcntrow->cus_id;
			$phonarr = array();
			$notesarr = array();
			$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$id'");
			foreach ($cntinfosql->result() as $cntinfosql) {
				$phonarr[] .= $cntinfosql->contact_no;
				$notesarr[] .= $cntinfosql->user_contact_note;
			}

			$setnotes = implode(",", $notesarr);
			$setphones = implode(",", $phonarr);

			$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$cust1_dtls->cus_id' AND conatct_type!='Email' AND default_contact=1");
			$cntctinfosql_row = $cntctinfosql->row();
			$htmlphone = $cntctinfosql_row->contact_no;
			$htmlnotes = $cntctinfosql_row->user_contact_note;



			//search_customer_opt
			$act_custsql = $this->db->query("SELECT * FROM search_customer_opt");
			$act_custrow = $act_custsql->row();

			$getfname = $act_custrow->cus_fname;
			$getlname = $act_custrow->cus_lname;
			$getcname = $act_custrow->cus_company_name;
			$getaddr1 = $act_custrow->cus_address1;
			$getaddr2 = $act_custrow->cus_address2;
			$getcity = $act_custrow->cus_city;
			$getstate = $act_custrow->cus_state;
			$getzip = $act_custrow->cus_zip;
			$getarea = $act_custrow->cus_area;
			$getphno = $act_custrow->phone_no;


			if ($getfname == 1) {
				$fnmamechksts = "display: table-cell;";
			} else {
				// $fnmamechksts="display: table-cell";
			}

			if ($getlname == 1) {
				$lnmamechksts = "display: table-cell;";
			} else {
				//$lnmamechksts="display:none;";
			}


			if ($getcname == 1) {
				$cnmamechksts = "display: table-cell;";
			} else {
				// $cnmamechksts="display:none;";
			}


			if ($getaddr1 == 1) {
				$addr1chksts = "display: table-cell;";
			} else {
				// $addr1chksts="display:none;";
			}

			if ($getaddr2 == 1) {
				$addr2chksts = "display: table-cell;";
			} else {
				// $addr2chksts="display:none;";
			}

			if ($getcity == 1) {
				$citychksts = "display: table-cell;";
			} else {
				// $citychksts="display:none;";
			}

			if ($getstate == 1) {
				$statechksts = "display: table-cell;";
			} else {
				//$statechksts="display:none;";
			}

			if ($getzip == 1) {
				$zipchksts = "display: table-cell;";
			} else {
				//$zipchksts="display:none;";
			}

			if ($getarea == 1) {
				$areachksts = "display: table-cell;";
			} else {
				// $areachksts="display:none;";
			}

			if ($getphno == 1) {
				$phnochksts = "display: table-cell;";
			} else {
				//$phnochksts="display:none;";
			}
			$cust1 = $this->db->query("SELECT * from user_contact_info AS c,register_customer AS r WHERE c.cus_id = r.cus_id AND c.contact_no = '$phone' GROUP BY c.cus_id");

			foreach ($cust1->result() as $cust1_dtls) {


		?>

				<tr>

					<td>
						<a onclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
					</td>

					<td><?= "1"; ?></td>

					<td><?= $cust1_dtls->cus_title ?></td>


					<td style="text-transform:capitalize; <?= $fnmamechksts ?>"><?= $cust1_dtls->cus_fname ?></td>

					<td style="text-transform:capitalize; <?= $lnmamechksts ?>"><?= $cust1_dtls->cus_lname ?></td>

					<td style="<?= $cnmamechksts ?>"><?= $cust1_dtls->cus_company_name ?></td>

					<td style="<?= $addr1chksts ?>"><?= $cust1_dtls->cus_address1 ?></td>
					<td style="<?= $addr2chksts ?>"><?= $cust1_dtls->cus_address2 ?></td>
					<td style="<?= $citychksts ?>"><?= $cust1_dtls->cus_city ?></td>
					<td style="<?= $statechksts ?>"><?= $cust1_dtls->cus_state ?></td>
					<td style="<?= $zipchksts ?>"><?= $cust1_dtls->cus_zip ?></td>
					<td style="<?= $areachksts ?>"><?= $cust1_dtls->cus_area ?></td>
					<td style="<?= $phnochksts ?>"><?= trim($htmlphone, ",") ?></td>
					<td><?= trim($htmlnotes, ",") ?></td>

				</tr>


			<?php }
		} else {

			echo "No Customers Found..!";
		}
	}


	public function search_vendor($fname, $lname, $cname, $zname)
	{
		$query = "SELECT * FROM register_vendor where vendor_fname ='" . $fname . "' OR vendor_type = '" . $lname . "' OR vendor_cat = '" . $cname . "' OR vendor_sub_cat = '" . $zname . "' ORDER BY vendor_created_at DESC";

		return $this->db->query($query)->result_array();
	}

	public function insertpromocode($data)
	{
		return $this->db->insert('promocodes', $data);
	}
	function updateprofile($data)
	{
		$updatequery = "UPDATE `users` SET `email`='" . $data['email'] . "',`name`='" . $data['name'] . "',`password`='" . $data['password'] . "',`mobile_no`='" . $data['mobile_no'] . "',`profile_img`='" . $data['profile_img'] . "' WHERE id=" . $data['id'] . "";
		// echo $updatequery;die;
		$session_data = array(                  //verified contains all the rows in user table
			'email'       => $data['email'],
			'name'        => $data['name'],
			'id'          => $data['id'],
			'mobile_no'   => $data['mobile_no'],
			'profile_img' => $data['profile_img'],
			'type'        => 1

			//you can add more fields to session from table as well as custom
			//ex- 'logged_in' = 1,
		);
		// print_r($session_data);die;
		$this->session->set_userdata('fi_session', $session_data);
		return  $this->db->query($updatequery);
	}
	function updateprofiledata($data)
	{
		$updatequery = "UPDATE `users` SET `email`='" . $data['email'] . "',`name`='" . $data['name'] . "',`password`='" . $data['password'] . "',`mobile_no`='" . $data['mobile_no'] . "' WHERE id=" . $data['id'] . "";
		// echo $updatequery;die;
		$session_data = array(                  //verified contains all the rows in user table
			'email'       => $data['email'],
			'name'        => $data['name'],
			'id'          => $data['id'],
			'mobile_no'   => $data['mobile_no'],
			'type'        => 1

			//you can add more fields to session from table as well as custom
			//ex- 'logged_in' = 1,
		);
		// print_r($session_data);die;
		$this->session->set_userdata('fi_session', $session_data);
		return  $this->db->query($updatequery);
	}

	function insertcustomer($data)
	{
		return $this->db->insert('customer', $data);
	}




	function insertCashRequest($data)
	{
		// return print_r($data);
		$query = "SELECT pending_amount from balance_order WHERE cus_id=" . $data['cus_id'] . "";
		$amount = $this->db->query($query)->result_array()[0];
		$total = $amount['pending_amount'] - $data['adv_order_cost'];
		// print_r($total);die;
		$updatequery = "UPDATE `balance_order` SET `pending_amount`=" . $total . " WHERE cus_id=" . $data['cus_id'] . "";
		// echo $updatequery;die;
		$this->db->query($updatequery);
		return $this->db->insert('complete_order', $data);
		// return $this->db->insert('customer',$data);
	}
	function insertCraditRequest($data)
	{

		if ($data['creadit_amount'] > 0 && $data['jar_return'] > 0) {
			// echo "string";die;
			$query = "SELECT pending_amount from balance_order WHERE cus_id=" . $data['cus_id'] . "";
			$amount = $this->db->query($query)->result_array()[0];
			$total = $amount['pending_amount'] + $data['creadit_amount'];
			// print_r($total);die;
			$updatequery = "UPDATE `balance_order` SET `pending_amount`=" . $total . " WHERE cus_id=" . $data['cus_id'] . "";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order', $data);
		} elseif ($data['creadit_amount'] > 0) {

			// echo "string2";die;
			$query = "SELECT pending_amount from balance_order WHERE cus_id=" . $data['cus_id'] . "";
			$amount = $this->db->query($query)->result_array()[0];
			$total = $amount['pending_amount'] + $data['creadit_amount'];
			// print_r($total);die;
			$updatequery = "UPDATE `balance_order` SET `pending_amount`=" . $total . " WHERE cus_id=" . $data['cus_id'] . "";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order', $data);
		} else {
			$query = "SELECT jar_quantity from balance_order WHERE cus_id=" . $data['cus_id'] . "";
			$jar_quantity = $this->db->query($query)->result_array()[0];
			$total = $jar_quantity['jar_quantity'] - $data['jar_return'];
			// print_r($total);die;
			$updatequery = "UPDATE `balance_order` SET `jar_quantity`=" . $total . " WHERE cus_id=" . $data['cus_id'] . "";
			// echo $updatequery;die;
			$this->db->query($updatequery);
			return $this->db->insert('complete_order', $data);
		}
		// return $this->db->insert('complete_order',$data);
	}
	function gethistory($id)
	{
		$query = "SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.creadit_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.order_date FROM complete_order o
        JOIN customer c ON o.cus_id=c.cus_id
        JOIN balance_order b ON o.cus_id=b.cus_id
        WHERE o.cus_id=" . $id . "
        ORDER BY o.id DESC";

		return $this->db->query($query)->result_array();
	}
	function getremaning_car_count($id)
	{
		return $this->db->select('jar_quantity')->where('cus_id', $id)->get('balance_order')->result_array()[0];
	}
	function insertjar($data)
	{
		// print_r($data);die;
		return $this->db->insert('jar_quantity', $data);
	}
	function getData($id)
	{
		return $this->db->select('cus_name')->where('cus_id', $id)->get('customer')->result_array()[0];
	}

	function insertorders($data)
	{
		// print_r($data);die;
		return $this->db->insert('adv_booking', $data);
	}

	function getedit($id)
	{
		return $this->db->where('cus_id', $id)->get('customer')->result_array();
	}

	function geteditdriver($id)
	{
		return $this->db->where('driver_id', $id)->get('driver_registration')->result_array();
	}
	function getpromo($id)
	{
		return $this->db->where('promo_id', $id)->get('promocodes')->result_array();
	}







	/*----------------Wallet Report Section Start---------------------*/

	function daywisewalletreport()
	{
		$date = date('Y-m-d');
		$newDate = date("Y-m-d", strtotime($date));
		// $resultforday=$this->db->query('SELECT *  FROM `wallet_history` WHERE `wallet_date` BETWEEN "'.$newDate.'" AND  "'.$date.' 23:59:59.000000" ORDER By wallet_id DESC')->result_array();
		$query = "SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.creadit_amount,o.order_date FROM complete_order o
        JOIN customer c ON o.cus_id=c.cus_id
        JOIN balance_order b ON o.cus_id=b.cus_id
        WHERE c.cus_is_active=1 AND o.order_date BETWEEN '" . $newDate . "' AND  '" . $newDate . "'
        ORDER BY o.id DESC";
		// echo $query;die;
		$resultforday = $this->db->query($query)->result_array();

		return $resultforday;
	}

	function datewisewalletreport($data)
	{
		// print_r($data);die;
		$query = "SELECT c.cus_name,c.cus_mobile_no,o.order_quantity,o.pending_amount,o.jar_return,b.jar_quantity as pending_jar,b.pending_amount AS cradit,o.order_cost,o.adv_order_cost,o.creadit_amount,o.order_date FROM complete_order o
        JOIN customer c ON o.cus_id=c.cus_id
        JOIN balance_order b ON o.cus_id=b.cus_id
        WHERE c.cus_is_active=1 AND o.order_date ='" . $data['from'] . "' ORDER BY o.id DESC";
		// echo $query;die;
		$resultforday = $this->db->query($query)->result_array();

		return $resultforday;
	}
	function getAllOrder()
	{
		$current_date = date('Y-m-d');
		$last_date = date('Y-m-d', strtotime('-4 day', strtotime($current_date)));

		$order_query = "SELECT * FROM `complete_order` WHERE order_date BETWEEN '" . $last_date . "' AND '" . $current_date . "' ORDER BY order_date DESC";
		$res = $this->db->query($order_query)->result_array();

		// $res= $this->db->order_by('order_date', 'DESC')->get('complete_order')->result_array();
		for ($i = 0; $i < count($res); $i++) {
			$res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		}
		// print_r($res);die;
		return $res;
	}
	function getCustNamebyID($id)
	{
		return $this->db->where('cus_id', $id)->get('customer')->result_array()[0]['cus_name'];
	}
	function getdataFromID($id)
	{
		$res = $this->db->where('id', $id)->get('complete_order')->result_array();
		for ($i = 0; $i < count($res); $i++) {
			$res[$i]['cusName'] = $this->getCustNamebyID($res[$i]['cus_id']);
		}
		return $res;
	}

	function getAllExpenses()
	{
		$res = $this->db->order_by('expenses_add_date_time', 'DESC')->get('expenses')->result_array();

		return $res;
	}
	function getAllPendingamt()
	{
		$q = "SELECT b.jar_quantity,b.pending_amount,c.cus_name,c.cus_mobile_no FROM `balance_order` b JOIN customer c ON b.cus_id=c.cus_id WHERE b.pending_amount >0";
		$res = $this->db->query($q)->result_array();

		return $res;
	}
	function getAllDeposite()
	{
		$q = "SELECT cus_name,cus_mobile_no,cus_deposite  FROM `customer` WHERE `cus_deposite` != 0";
		$res = $this->db->query($q)->result_array();
		return $res;
	}
	function getAllPendingcust()
	{
		$current_date = date('Y-m-d');
		$last_date = date('Y-m-d', strtotime('-3 day', strtotime($current_date)));

		$last_forthdate = date('Y-m-d', strtotime('-4 day', strtotime($current_date)));
		$last_month = date('Y-m-d', strtotime('-30 day', strtotime($last_forthdate)));

		$q = "SELECT c.cus_id,c.cus_name,c.cus_mobile_no,co.order_date FROM `customer` c
    JOIN (SELECT * FROM complete_order WHERE order_date NOT BETWEEN '" . $last_date . "' AND '" . $current_date . "' ORDER BY order_date DESC, id DESC)
    AS co ON co.cus_id=c.cus_id
    WHERE c.cus_id NOT IN
    (SELECT cus_id FROM complete_order WHERE order_date BETWEEN '" . $last_date . "' AND '" . $current_date . "') AND co.order_quantity=1  GROUP BY co.cus_id";
		// echo $q;die;
		$res = $this->db->query($q)->result_array();
		// echo $q;die;

		return $res;
	}
	function getAllcusData($id)
	{
		$q = "SELECT jar_quantity FROM balance_order WHERE cus_id=" . $id . "";

		$res = $this->db->query($q)->result_array();

		$q2 = "select jar_id from jar_quantity where jar_status=2 order by rand() limit " . $res[0]['jar_quantity'] . "";

		$qu = $this->db->query($q2)->result_array();


		for ($i = 0; $i < count($qu); $i++) {
			$updateOrderQuantity = array('jar_status' => 1);

			if ($this->db->where('jar_id', $qu[$i]['jar_id'])->update('jar_quantity', $updateOrderQuantity)) {
				continue;
			}
		}
		// print_r($qu);die;

		return true;
	}

	function crnewinvoice_dtls()
	{

		$chkinvsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'");
		//$isinvoicerow=$chkinvsql->row();
		foreach ($chkinvsql->result() as $chkinvsql_dtls) {
			$postinvarr = array(
				//"invoice_id" => $chkinvsql_dtls->invoice_id+1,
				"cust_id" => $_POST['customrId'],
				"invoice_name" => $chkinvsql_dtls->invoice_name,
				"invoice_date" => date('Y-m-d'),
				"invoice_status" => 0,

				"invoice_tax_rate" => $chkinvsql_dtls->invoice_tax_rate


			);

			if ($this->db->insert('invoices_create', $postinvarr)) {
				//echo "success";
				$linvid = $this->db->insert_id();

				$postinvnoarr = array(
					"inv_id" => $linvid,
				);
				$this->db->insert('invoice_terms', $postinvnoarr);

				echo "<input type='hidden' name='hdninvoiceId' id='hdninvoiceId' value='" . $linvid . "'>";
				echo "<input type='hidden' name='responce' id='responce' value='success'>";
			} else {
				//echo "error";
				echo "<input type='hidden' name='responce' id='responce' value='error'>";
			}
		}
	}

	function delinvoice_dtls()
	{
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->delete('invoices_create')) {
			echo "success";
		} else {
			echo "error";
		}
	}
	function delinvoice_seleted_dtls()
	{
		$this->db->where('id', $this->input->post('invoiceid'));
		if ($this->db->delete('customer_invoice_notes')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updtinvoice_dtls()
	{

		$feildname = $this->input->post('fieldnm');

		$updateinvarr = array(

			$feildname  => $this->input->post('inptxtval')
		);

		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->update('invoices_create', $updateinvarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function add_reminder()
	{

		$arr_inseart = array(
			'reminder_id' => $this->input->post('reminderid'),
			'reminder_date' => $this->input->post('reminder_date'),
			'reminder_time' => $this->input->post('reminder_time'),
			'reminder_datetime' => $this->input->post('reminder_date') . " " . $this->input->post('reminder_time')

		);
		if ($this->db->insert('reminder_entry', $arr_inseart)) {
			echo "success";
		} else {
			echo "error";
		}
	}







	function crpitem_dtls()
	{
		if ($_POST['pckId'] == 0) {
			$pckId = NULL;
		} else {
			$pckId = $_POST['pckId'];
		}

		$postitemsarr = array(
			"package_id" => $pckId,
			"cus_id" => $_POST['custnm'],
			"inv_id" => $_POST['invId']
		);

		if ($this->db->insert('customers_package_items', $postitemsarr)) //admin_package_item
		{
			echo "success";
		} else {
			echo "error";
		}
	}

	function delpitem_dtls()
	{
		$this->db->where('id', $this->input->post('itmId'));
		if ($this->db->delete('customers_package_items'))  //admin_package_item
		{
			//echo "success";

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND discounted_amt IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE pck_discounted_amt IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;


			$invoicetot = $descountitemstot + $itemstot + $desountpckgstot + $pckgstot;

			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $invoicetot
			);
			$this->db->where('invoice_id', $_POST['invId']);
			$this->db->where('cust_id', $_POST['custId']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	function updtitems_dtls()
	{

		$fieldname = $this->input->post('fieldnm');

		$updateitmarr = array(

			$fieldname  => $this->input->post('inptxtval')
		);

		$this->db->where('id', $this->input->post('itemsid'));
		if ($this->db->update('admin_package_item', $updateitmarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updinvamt_dtls()
	{

		//echo "pckId--".$this->input->post('pckId');

		if ($this->input->post('pckId') == "") {

			$updateinvamtarr = array(

				"invoice_amount"  => "",
				"invoice_balance_due"  => "",
				"assigned_pckage"  => ""
			);
		} else {

			$invsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $this->input->post('invId') . "'");
			$invsql_rows = $invsql->row();
			$invpaid = $invsql_rows->invoice_paid;
			$setinvamount = $this->input->post('pcktot');

			$updateinvamtarr = array(

				"invoice_amount"  => $setinvamount, //$this->input->post('pcktot'),
				"invoice_balance_due"  => $setinvamount - $invpaid, //$this->input->post('pcktot'),
				"assigned_pckage"  => $this->input->post('pckId'),
				//"invoice_sub_total" => $setinvamount
			);
		}

		$this->db->where('invoice_id', $this->input->post('invId'));
		if ($this->db->update('invoices_create', $updateinvamtarr)) {

			echo "success";
		} else {
			echo "error";
		}
	}


	function updpckinfo_dtls()
	{

		if ($_POST['pckId'] == 0) {
			$pckId = NULL;
		} else {
			$pckId = $_POST['pckId'];
		}

		$updatepckinfoarr = array(

			"package_id"     => $pckId,
			"item_name"      => $this->input->post('admpckId'),
			"item_quantity"  => $this->input->post('qty'),
			"item_price"     => $this->input->post('item_price'),
			"item_desc"      => $this->input->post('item_desc'),
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('customers_package_items', $updatepckinfoarr))/*admin_package_item*/ {
			echo "success";
		} else {
			echo "error";
		}
	}














	function find_city_json($zip)
	{
		$cityjson = array();

		$getcity = $this->db->query("SELECT * FROM tbl_zipcode_list WHERE ZIP_code='" . $zip . "' LIMIT 1");
		if ($getcity->num_rows() > 0) {
			foreach ($getcity->result() as $getcity_dtls) {
				$cityjson['custaddrinfo'][] = $getcity_dtls;
			}
			echo json_encode($cityjson);
		} else {

			$cityjson['custaddrinfo'][] = "";
			echo json_encode($cityjson);
		}
	}

	function fnloadcustlistbyphone_dtls($txtphonenum)
	{

		$user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE contact_no = '$txtphonenum'");

		if ($user_contact->num_rows() > 0) {

			$getrcrow = $user_contact->row();


			$id = $getrcrow->cus_id;



			$cust1 = $this->db->query("SELECT * from register_customer WHERE cus_id = '$id'");

			$get_data = $cust1->result_array()[0];

			$contact = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();

			$user_contact = $this->db->query("SELECT * from `user_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
			$get_all_contacts = $user_contact->result_array();

			$user_ship = $this->db->query("SELECT * from `ship_address` WHERE `ship_user_id` = '$id'");
			$shipping = $user_ship->result_array()[0];


			//      print_r($shipping);die;

			?><div class="col-md-6">

				<div class="box box-primary firstblock_bg">

					<div class="box-body">

						<div class="row">

							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2">Name</p>
								</div>
								<!-- <p class="uhead2">Name</p> -->
								<input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								<div class="form-horizontal">

									<div class="form-group">

										<div class="col-sm-2">

											<select class="form-control fcap" name="title" id="title" autofocus>

												<option value="">Select Title</option>

												<option <?php if ($get_data['cus_title'] == "Dr") {
															echo "selected";
														} ?> value="Dr">Dr.</option>

												<option <?php if ($get_data['cus_title'] == "Mr") {
															echo "selected";
														} ?> value="Mr">Mr.</option>

												<option <?php if ($get_data['cus_title'] == "Mrs") {
															echo "selected";
														} ?> value="Mrs">Mrs.</option>

												<option <?php if ($get_data['cus_title'] == "Ms") {
															echo "selected";
														} ?> value="Ms">Ms.</option>
											</select>

										</div>

										<div class="col-sm-5">

											<input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">

										</div>

										<div class="col-sm-5">

											<input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										</div>

									</div>

									<!--  <div class="form-group">

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

                                         </div>

                                         <div class="col-sm-6">

                                             <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

                                         </div>

                                     </div> -->

									<div class="form-group">

										<div class="col-sm-12">

											<input class="form-control fcap group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										</div>

									</div>

									<div class="form-group">

										<div class="col-sm-12">

											<input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										</div>

									</div>

									<div class="form-group">

										<div class="col-sm-12">

											<input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										</div>

									</div>

									<div class="form-group">

										<div class="col-sm-7">

											<input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										</div>

										<div class="col-sm-3">

											<input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										</div>

										<div class="col-sm-2">

											<input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

										</div>

									</div>


									<div class="form-group">

										<div class="col-sm-6">

											<select class="form-control fcap" name="tax_status" tabindex="-1">

												<option value="">Tax Status</option>

												<option <? if ($get_data['cus_tax_status'] == "1") {
															echo "selected";
														} ?> value="1">Exempt</option>

												<option <? if ($get_data['cus_tax_status'] == "2") {
															echo "selected";
														} ?> value="2">Out of state</option>

												<option <? if ($get_data['cus_tax_status'] == "3") {
															echo "selected";
														} ?> value="3">Resale</option>

										</div>

										<div class="col-sm-6">

											<input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID" tabindex="-1">

										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="col-md-6">

				<div class="box box-primary secondblock_bg ">

					<div class="box-body">

						<div class="row space3">
							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2 3">Contact Info</p>
								</div>

								<div class="form-horizontal">

									<?php foreach ($get_all_contacts as $allContacts) {

									?>
										<div class="cnt_clone">

											<div class="form-group">

												<div class="col-sm-3">

													<select name="cus_contact_type[]" class="form-control fcap mailevent">

														<option> </option>
														<?php

														foreach ($contact as $cont) {
															if ($allContacts['conatct_type'] == $cont['sub_name']) {
																$selectedcls = "selected";
															} else {
																$selectedcls = "";
															}
														?>
															<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
														<?php  }
														?>





													</select>

												</div>




												<div class="col-sm-3">

													<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">

												</div>

												<div class="col-sm-3">

													<input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

												</div>
												<?php if ($allContacts['default_contact'] == 1) { ?>
													<div class="col-sm-3">
														<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
														<!-- <label>Default</label> -->
														<label class="switch">

															<input type="radio" name="radio_click[]" checked>
															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
													</div>
												<?php } else { ?>
													<div class="col-sm-3">
														<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
														<!-- <label>Default</label> -->
														<label class="switch">

															<input type="radio" name="radio_click[]">
															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
													</div>
												<?php } ?>
												<!-- <div class="col-sm-3"> -->
												<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
												<!-- <label>Default</label> -->
												<!-- <label class="switch">

                                                     <input type="checkbox"  name="radio_click[]" checked>
                                                     <span class="slider round"></span>
                                                 </label>

                                                 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                             </div> -->
											</div>

										</div>
									<?php } ?>
								</div>
							</div>
							<!-- /.box-body -->

						</div>

						<!-- /.box -->

					</div>
				</div>

				<div class="box box-primary secondblock_bg ">

					<div class="box-body">

						<div class="row space3">
							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2 4">Contact Info</p>
								</div>

								<div class="form-horizontal">

									<?php foreach ($get_all_contacts as $allContacts) {


										if ($allContacts['conatct_type'] == "Email") {
									?>

											<div class="cnt_clone">

												<div class="form-group">

													<div class="col-sm-4">

														<select name="cuscnt_type_email[]" class="form-control fcap mailevent 2">
															<option> </option>
															<?php

															foreach ($contact as $cont) {
																/*   if($allContacts['conatct_type']==$cont['sub_name'])
                                                     {
                                                         $selectedcls="selected";
                                                     }else{
                                                         $selectedcls="";
                                                     }*/
															?>
																<option selected value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php  }
															?>

														</select>

													</div>


													<div class="col-sm-4">

														<input class="form-control" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>">

													</div>

													<div class="col-sm-3">

														<a href="" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal1">Email</a>

													</div>




													<div class="col-sm-1">


														<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
													</div>


												</div>

											</div>
										<?php
										} elseif ($allContacts['conatct_type'] == "Home" || $allContacts['conatct_type'] == "Office" || $allContacts['conatct_type'] == "Mobile") {

											//echo "else home".$allContacts['contact_no'];
										?>

											<div class="cnt_clone">

												<div class="form-group">

													<div class="col-sm-3">

														<select name="cus_contact_type[]" class="form-control fcap mailevent" required>

															<?php

															foreach ($contact as $cont) {
																if ($allContacts['conatct_type'] == $cont['sub_name']) {
																	$selectedcls = "selected";
																} else {
																	$selectedcls = "";
																}
															?>
																<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php  }
															?>

														</select>

													</div>

													<div class="col-sm-3">

														<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">

													</div>

													<div class="col-sm-3">

														<input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

													</div>
													<?php if ($allContacts['default_contact'] == 1) { ?>
														<div class="col-sm-3">

															<label class="switch">

																<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]" checked>

																<span class="slider round"></span>
															</label>

															<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
														</div>
													<?php } else { ?>
														<div class="col-sm-3">

															<label class="switch">

																<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]" checked>
																<span class="slider round"></span>
															</label>

															<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
														</div>
													<?php } ?>

												</div>

											</div>


									<?php }
									} ?>



								</div>
							</div>
							<!-- /.box-body -->

						</div>

						<!-- /.box -->

					</div>
				</div>


			</div>
			<div class="clearfix"></div>

			<div class="col-md-6">

				<div class="box box-default collapsed-box thirdblock_bg">

					<div class="box-header with-border">

						<div class="col-md-5">
							<p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
						</div>

						<div class="col-md-5">
							<div class="checkbox uhead2">
								<?php
								if ($shipping['billing_addr_status'] == "1") {
									$chkstatus = "checked";
								} else {
									$chkstatus = "";
								}
								?>

								<label><input <?= $chkstatus ?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()">Same as billing address</label>
							</div>
						</div>

						<div class="box-tools pull-right">

							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>

							</button>

						</div>

						<!-- /.box-tools -->

					</div>

					<!-- /.box-header -->

					<div class="box-body" id="billaddress">

						<div class="form-horizontal">

							<div class="form-group">

								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">

								</div>

							</div>

							<div class="form-group">
								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

								</div>

							</div>

						</div>

					</div>

					<!-- /.box-body -->

				</div>

				<!-- /.box -->

			</div>
		<?php


		}
	}

	function fndeleventinfo_dtls()
	{
		$this->db->where('event_id', $this->input->post('eventId'));
		$this->db->where('cus_id', $this->input->post('cusId'));
		if ($this->db->delete('events_register')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fndellocationinfo_dtls()
	{
		$this->db->where('location_id', $this->input->post('locId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('event_location')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fndelcrewsinfo_dtls()
	{
		$this->db->where('crews_id', $this->input->post('crewId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('event_crews')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fngetphonewisrhinv_dtls()
	{

		error_reporting(0);

		$invoicesql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['custid'] . "' ORDER BY invoice_id ASC");
		//$chkinvsql=$this->db->query("SELECT * FROM invoices_create ORDER BY invoice_id DESC LIMIT 1");
		$chkinvsql = $this->db->query("SELECT * FROM invoices_create WHERE cust_id='" . $_POST['custid'] . "' ORDER BY invoice_id DESC LIMIT 1");
		$isinvoicerow = $chkinvsql->row();

		foreach ($invoicesql->result() as $invoicesql_dtls) {

			$invoiceId = $invoicesql_dtls->invoice_id;
			$invoicedt = $invoicesql_dtls->invoice_date;
			$invoiceduedt = $invoicesql_dtls->invoice_due_date;
			$invoicetype = $invoicesql_dtls->invoice_type;
			$contracttype = $invoicesql_dtls->invoice_contract_type;
			$invdescnt = $invoicesql_dtls->invoice_discount;
			$invsubtot = $invoicesql_dtls->invoice_sub_total;
			$invtax = $invoicesql_dtls->invoice_tax;
			$invamount = $invoicesql_dtls->invoice_amount;
			$invpaid = $invoicesql_dtls->invoice_paid;
			$invbaldue = $invoicesql_dtls->invoice_balance_due;
			$invtaxrate = $invoicesql_dtls->invoice_tax_rate;
			$invcntry = $invoicesql_dtls->invoice_county;
			$invuser = $invoicesql_dtls->user;


			if ($invoicedt != "") {

				$invdate = $invoicedt;
			} else {

				$invdate = date('Y-m-d');
			}


			if ($invoiceduedt != "") {

				$invduedate = $invoiceduedt;
			} else {

				$invduedate = "";
			}

			if ($invdescnt != "") {
				$setinvdescnt = $invdescnt;
			} else {

				$setinvdescnt = "";
			}

			if ($invsubtot != "") {
				$setinvsubtot = $invsubtot;
			} else {

				$setinvsubtot = "";
			}

			if ($invsubtot != "") {
				$setinvsubtot = $invsubtot;
			} else {

				$setinvsubtot = "";
			}


			if ($invtax != "") {
				$setinvtax = $invtax;
			} else {

				$setinvtax = ""; //8.8%
			}

			if ($invamount != "") {
				$setinvamount = $invamount;
			} else {

				$setinvamount = "";
			}


			if ($invpaid != "") {
				$setinvpaid = $invpaid;
			} else {

				$setinvpaid = "";
			}


			if ($invbaldue != "") {
				$setinvbaldue = $invbaldue;
			} else {

				$setinvbaldue = "";
			}

			if ($invtaxrate != "") {
				$setinvtaxrate = $invtaxrate;
			} else {

				$setinvtaxrate = "";
			}


			if ($invcntry != "") {
				$setinvcntry = $invcntry;
			} else {

				$setinvcntry = "";
			}


			if ($invuser != "") {
				$setinvuser = $invuser;
			} else {

				$setinvuser = "";
			}



			if ($isinvoicerow->invoice_id == $invoiceId) {
				$lstinvoiceid = "fa-plus";
				$lstinvoicecls = "btn-success";
				$fninvoce = "fncrinvoice('" . $invoiceId . "')";
			} else {

				$lstinvoiceid = "fa-minus";
				$lstinvoicecls = "btn-danger";
				$fninvoce = "fndelinvoice('" . $invoiceId . "')";
			}


			$i = 1;
		?>

			<tr class="tr_clone">

				<!--   <td><?= $i ?></td> -->
				<td>
					<a onclick="fngetinvoicedetails('<?= $invoiceId ?>')" style="cursor: pointer;">
						<i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
					<input type="hidden" class="hdninvrowId hdninvrowId<?= $i++ ?> 2" name="hdninvrowId" id="hdninvrowId" value="<?= $invoiceId ?>">
				</td>
				<td><?= $invoicesql_dtls->invoice_id ?></td>

				<td><input type="date" name="invoice_date<?= $invoiceId ?>" id="invoice_date<?= $invoiceId ?>" class="form-control w95" value="<?= $invdate ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_date')">

				</td>

				<td><input type="date" name="invoice_due_date<?= $invoiceId ?>" id="invoice_due_date<?= $invoiceId ?>" class="form-control w95" value="<?= $invduedate ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_due_date')" onkeydown="dueuniKeyCode(event,'<?= $invoiceId ?>')"></td>

				<td>

					<select class="form-control" name="invoice_event_type<?= $invoiceId ?>" id="invoice_event_type<?= $invoiceId ?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_type')">
						<option value="0">Select</option>
						<?php

						//$evntypsql=$this->db->query("SELECT * FROM invoice_event_type ORDER BY id ASC");

						$evntypsql = $this->db->query("SELECT * FROM events_register WHERE cus_id='" . $isinvoicerow->cust_id . "'  GROUP BY event_type ORDER BY event_id ASC ");


						foreach ($evntypsql->result() as $evntypsql_dtls) {
							/*  if($evntypsql_dtls->name==$invoicetype)
                                       {

                                          $selectedevtyp="selected";
                                       }else{

                                           $selectedevtyp="";
                                       }*/

						?>
							<option value="<?= $evntypsql_dtls->event_type ?>"><?= $evntypsql_dtls->event_type ?></option>

						<?php } ?>


					</select>

				</td>

				<td>

					<select class="form-control" name="invoice_contract_type<?= $invoiceId ?>" id="invoice_contract_type<?= $invoiceId ?>" style="min-width: 90px; width: 100%;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_contract_type')">
						<option value="">Select</option>

						<?php

						$evntypsql = $this->db->query("SELECT * FROM invoice_contract_type ORDER BY id ASC");

						foreach ($evntypsql->result() as $evntypsql_dtls) {
							if ($evntypsql_dtls->name == $contracttype) {

								$selectedevtyp = "selected";
							} else {

								$selectedevtyp = "";
							}

						?>
							<option <?= $selectedevtyp ?> value="<?= $evntypsql_dtls->name ?>"><?= $evntypsql_dtls->name ?></option>

						<?php } ?>


					</select>

				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<!-- <span class="glyphicon glyphicon-usd"></span> -->
							</span>
							<input type="text" name="invoice_discount<?= $invoiceId ?>" id="invoice_discount<?= $invoiceId ?>" class="form-control updwn" style="width: 40px;" value="<?= $setinvdescnt ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_discount')">
						</div>
					</div>
				</td>
				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_sub_total<?= $invoiceId ?>" id="invoice_sub_total<?= $invoiceId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvsubtot) ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_sub_total')">
						</div>
					</div>
				</td>

				<td>
					<input type="text" name="invoice_tax<?= $invoiceId ?>" id="invoice_tax<?= $invoiceId ?>" class="form-control updwn" style="width: 60px;" value="<?= $setinvtax ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax')">
				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_amount" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvamount) ?>" disabled>
						</div>
					</div>
				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_paid" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvpaid) ?>" disabled>
						</div>
					</div>
				</td>

				<td>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
							<input type="text" name="invoice_balance_due" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $setinvbaldue) ?>" disabled>
						</div>
					</div>
				</td>

				<!--  <td><span class="label label-success">Pay</span></td> -->

				<td>
					<input type="text" name="invoice_tax_rate<?= $invoiceId ?>" id="invoice_tax_rate<?= $invoiceId ?>" class="14 form-control updwn 3" value="<?= $setinvtaxrate ?>" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_tax_rate')">
				</td>

				<td><input type="text" name="invoice_country<?= $invoiceId ?>" id="invoice_country<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvcntry ?>" style="width: 80px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_county')"></td>

				<td><input type="text" name="invoice_user<?= $invoiceId ?>" id="invoice_user<?= $invoiceId ?>" class="form-control updwn" value="<?= $setinvuser ?>" style="width: 60px;" onchange="fnupdateinvoiceinfo(this.value,'<?= $invoiceId ?>','invoice_user')"></td>


				<td><a data-toggle="modal" data-target="#myModal"><i class="fa fa-money" aria-hidden="true"></i></a></td>

				<td>

					<button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> tr_clone_add"><i class="fa <?= $lstinvoiceid ?>"></i></button>

				</td>
			</tr>

		<?php  }
	}


	public function chk_contactinfo_id_count($id, $mobile)
	{

		$contactinfosql = $this->db->select('*')
			->from('user_contact_info')
			->where("contact_no", $mobile)
			->where("cus_id", $id)
			->get();

		if ($contactinfosql->num_rows() > 0) {
			$query = $this->db->select('*')
				->from('events_register')
				->where("cus_id", $id)
				->get();

			return $query->num_rows();
		} else {

			return $contactinfosql->num_rows();
		}
	}

	public function serch_get_event_data_id()
	{
		$query = $this->db->select('*')
			->from('events_register')
			->where("cus_id", "0")
			->get();

		//return $query->result_array()[0];
		return $query->result_array();
	}

	public function serch_get_locationt_data_id()
	{
		$query = $this->db->select('*')
			->from('event_location')
			->where("event_id", "0")
			->get();

		return $query->result_array();
	}
	public function serch_get_crews_data_id()
	{
		$query = $this->db->select('*')
			->from('event_crews')
			->where("event_id", "0")
			->get();

		return $query->result_array();
	}



	public function vendaddshipaddress_dtls($address)
	{
		return $this->db->insert('vender_ship_address', $address);
	}

	public function addvendcontactdata_dtls($contact)
	{
		return $this->db->insert('vender_contact_info', $contact);
	}




	public function allVendorGeneralInfo($cName)
	{
		$id = $cName;
		$cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");

		$get_data = $cust1->result_array()[0];

		$contact = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();

		$user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
		$get_all_contacts = $user_contact->result_array();

		$user_ship = $this->db->query("SELECT * from `vender_ship_address` WHERE `ship_user_id` = '$id'");
		$shipping = $user_ship->result_array()[0];


		//      print_r($shipping);die;

		?><div class="col-md-6">

			<div class="box box-primary firstblock_bg">

				<div class="box-body">

					<div class="row">

						<div class="col-md-12">
							<div class="box-header with-border">
								<p class="uhead2">Name</p>
							</div>
							<!-- <p class="uhead2">Name</p> -->
							<input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
							<div class="form-horizontal">
								<div class="form-group">
									<div class="col-sm-2">
										<select class="form-control fcap" name="title" id="title" autofocus>
											<option value="">Select Title</option>
											<option <?php if ($get_data['cus_title'] == "Dr") {
														echo "selected";
													} ?> value="Dr">Dr.</option>
											<option <?php if ($get_data['cus_title'] == "Mr") {
														echo "selected";
													} ?> value="Mr">Mr.</option>
											<option <?php if ($get_data['cus_title'] == "Mrs") {
														echo "selected";
													} ?> value="Mrs">Mrs.</option>
											<option <?php if ($get_data['cus_title'] == "Ms") {
														echo "selected";
													} ?> value="Ms">Ms.</option>
										</select>
									</div>
									<div class="col-sm-5">
										<input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">
									</div>
									<div class="col-sm-5">
										<input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">

									<div class="col-sm-12">

										<input class="form-control fcap group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

									</div>

								</div>

								<div class="form-group">

									<div class="col-sm-12">

										<input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

									</div>

								</div>

								<div class="form-group">

									<div class="col-sm-12">

										<input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

									</div>

								</div>

								<div class="form-group">

									<div class="col-sm-7">

										<input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

									</div>

									<div class="col-sm-3">

										<input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

									</div>

									<div class="col-sm-2">

										<input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

									</div>

								</div>

								<!-- <div class="form-group">

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)"  type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

                                         </div>

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area" tabindex="-1">

                                         </div>

                                     </div> -->

								<div class="form-group">

									<div class="col-sm-6">

										<select class="form-control fcap" name="tax_status" tabindex="-1">

											<option value="">Tax Status</option>

											<option <? if ($get_data['cus_tax_status'] == "1") {
														echo "selected";
													} ?> value="1">Exempt</option>

											<option <? if ($get_data['cus_tax_status'] == "2") {
														echo "selected";
													} ?> value="2">Out of state</option>

											<option <? if ($get_data['cus_tax_status'] == "3") {
														echo "selected";
													} ?> value="3">Resale</option>
										</select>

									</div>

									<div class="col-sm-6">

										<input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID" tabindex="-1">

									</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="col-md-6">

			<div class="box box-primary secondblock_bg ">

				<div class="box-body">

					<div class="row space3">
						<div class="col-md-12">
							<div class="box-header with-border">
								<p class="uhead2 5">Contact Info</p>
							</div>

							<div class="form-horizontal">

								<?php foreach ($get_all_contacts as $allContacts) {


									if ($allContacts['conatct_type'] == "Email") {
								?>

										<div class="cnt_clone">

											<div class="form-group">

												<div class="col-sm-4">

													<select name="cuscnt_type_email[]" class="form-control fcap mailevent 3">
														<option> </option>
														<?php

														foreach ($contact as $cont) {
															/* if($allContacts['conatct_type']==$cont['sub_name'])
                                                     {
                                                         $selectedcls="selected";
                                                     }else{
                                                         $selectedcls="";
                                                     }*/
														?>
															<option selected value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
														<?php  }
														?>

													</select>

												</div>


												<div class="col-sm-4">

													<input class="form-control" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>">

												</div>

												<div class="col-sm-1">

													<a href="" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal1">Email</a>

												</div>




												<div class="col-sm-3">


													<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
												</div>


											</div>

										</div>
									<?php
									} elseif ($allContacts['conatct_type'] == "Home" || $allContacts['conatct_type'] == "Office" || $allContacts['conatct_type'] == "Mobile") {

										//echo "else home".$allContacts['contact_no'];
									?>

										<div class="cnt_clone">

											<div class="form-group">

												<div class="col-sm-3">

													<select name="cus_contact_type[]" class="form-control fcap mailevent" required>

														<?php

														foreach ($contact as $cont) {
															if ($allContacts['conatct_type'] == $cont['sub_name']) {
																$selectedcls = "selected";
															} else {
																$selectedcls = "";
															}
														?>
															<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
														<?php  }
														?>

													</select>

												</div>

												<div class="col-sm-3">

													<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details" autocomplete="off">

												</div>

												<div class="col-sm-3">

													<input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

												</div>
												<?php if ($allContacts['default_contact'] == 1) { ?>
													<div class="col-sm-3">

														<label class="switch">

															<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]" checked>

															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
													</div>
												<?php } else { ?>
													<div class="col-sm-3">

														<label class="switch">

															<input class="fnchkphoneno" type="radio" id="radio_click" name="radio_click[]" checked>
															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
													</div>
												<?php } ?>

											</div>

										</div>


								<?php }
								} ?>



							</div>
						</div>
						<!-- /.box-body -->

					</div>

					<!-- /.box -->

				</div>
			</div>

			<div class="box box-primary secondblock_bg ">
				<div class="box-body">
					<div class="row">

						<div class="col-md-12">
							<!--  <div class="box box-default"> -->
							<div class="box-body">
								<div class="form-horizontal">
									<div class="form-group">
										<div class="col-sm-6">
											<select class="form-control" name="apcate">
												<option value="">AP Category</option>
												<?php
												$ap_cat = $this->db->where('cat_id', 5)->get('sub_categories');
												foreach ($ap_cat->result() as $apcat_info) {

													if ($apcat_info->sub_name == $get_data['ap_cat']) {
														$selapcat = "selected";
													} else {
														$selapcat = "";
													}

												?>
													<option <?= $selapcat ?> value="<?= $apcat_info->sub_name ?>"><?= $apcat_info->sub_name ?></option>

												<?php  } ?>

											</select>
										</div>
										<div class="col-sm-6">
											<select class="form-control" name="apsubcate">
												<option value="">AP Subcategory</option>
												<?php
												$ap_subcat = $this->db->where('cat_id', 4)->get('sub_categories');
												foreach ($ap_subcat->result() as $apsubcat_info) {

													if ($apsubcat_info->sub_name == $get_data['ap_sbcat']) {
														$selapsubcat = "selected";
													} else {
														$selapsubcat = "";
													}


												?>
													<option <?= $selapsubcat ?> value="<?= $apsubcat_info->sub_name ?>"><?= $apsubcat_info->sub_name ?></option>

												<?php  } ?>
											</select>
										</div>
									</div>
								</div>
								<!--
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table   table-hover no-margin">
                                    <thead>
                                      <tr>
                                        <th>Type</th>
                                        <th>Value</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <select class="form-control">
                                            <option>    </option>
                                          </select>
                                        </td>
                                        <td>$3000</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div> -->

							</div>
							<!-- /.box-body -->

							<!--  </div> -->

							<!-- /.box -->
						</div>

					</div>
				</div>
			</div>



		</div>
		<div class="clearfix"></div>

		<div class="col-md-6">

			<div class="box box-default collapsed-box thirdblock_bg">

				<div class="box-header with-border">

					<div class="col-md-5">


						<p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
					</div>

					<div class="col-md-5">
						<div class="checkbox uhead2">

							<?php
							if ($shipping['billing_addr_status'] == "1") {
								$chkstatus = "checked";
							} else {
								$chkstatus = "";
							}
							?>

							<label><input <?= $chkstatus ?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()">Same as billing address</label>
						</div>
					</div>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>

					</div>

					<!-- /.box-tools -->

				</div>

				<!-- /.box-header -->

				<div class="box-body" id="billaddress">

					<div class="form-horizontal">

						<div class="form-group">

							<div class="col-sm-4">

								<input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

							</div>


							<div class="col-sm-4">

								<input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

							</div>


							<div class="col-sm-4">

								<input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">

							</div>

						</div>

						<div class="form-group">
							<div class="col-sm-4">

								<input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">

							</div>


							<div class="col-sm-4">

								<input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

							</div>

						</div>

					</div>

				</div>

				<!-- /.box-body -->

			</div>

			<!-- /.box -->

		</div>
		<?php

	}






	public function fnloadvendlistbyphone_dtls($txtphonenum)
	{

		$user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE contact_no = '$txtphonenum'");

		if ($user_contact->num_rows() > 0) {

			$getrcrow = $user_contact->row();


			$id = $getrcrow->cus_id;



			$cust1 = $this->db->query("SELECT * from register_vendor WHERE cus_id = '$id'");

			$get_data = $cust1->result_array()[0];

			$contact = $this->db->where('cat_id', 1)->get('sub_categories')->result_array();

			$user_contact = $this->db->query("SELECT * from `vender_contact_info` WHERE cus_id = '$id' ORDER BY contact_id DESC");
			$get_all_contacts = $user_contact->result_array();

			$user_ship = $this->db->query("SELECT * from `vender_ship_address` WHERE `ship_user_id` = '$id'");
			$shipping = $user_ship->result_array()[0];


			//      print_r($shipping);die;

		?><div class="col-md-6">

				<div class="box box-primary firstblock_bg">

					<div class="box-body">

						<div class="row">

							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2">Name</p>
								</div>
								<!-- <p class="uhead2">Name</p> -->
								<input type="hidden" name="cus_id" value="<?php echo $get_data['cus_id'] ?>">
								<div class="form-horizontal">

									<div class="form-group nospacerow">

										<div class="col-sm-2">

											<select class="form-control fcap" name="title" id="title" autofocus>

												<option value="">Select Title</option>

												<option <?php if ($get_data['cus_title'] == "Dr") {
															echo "selected";
														} ?> value="Dr">Dr.</option>

												<option <?php if ($get_data['cus_title'] == "Mr") {
															echo "selected";
														} ?> value="Mr">Mr.</option>

												<option <?php if ($get_data['cus_title'] == "Mrs") {
															echo "selected";
														} ?> value="Mrs">Mrs.</option>

												<option <?php if ($get_data['cus_title'] == "Ms") {
															echo "selected";
														} ?> value="Ms">Ms.</option>
											</select>

										</div>

										<div class="col-sm-5">

											<input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text" placeholder="First Name">

										</div>

										<div class="col-sm-5">

											<input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

										</div>

									</div>

									<!-- <div class="form-group">

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_fname" value="<?php echo $get_data['cus_fname'] ?>" id="cus_fname" style="text-transform: uppercase;" type="text"  placeholder="First Name">

                                         </div>

                                         <div class="col-sm-6">

                                             <input class="form-control fcap group" name="cus_lname" value="<?php echo $get_data['cus_lname'] ?>" id="cus_lname" style="text-transform: uppercase;" type="text" placeholder="Last Name">

                                         </div>

                                     </div> -->

									<div class="form-group nospacerow">

										<div class="col-sm-12">

											<input class="form-control fcap group" name="cus_com" value="<?php echo $get_data['cus_company_name'] ?>" id="cus_com" type="text" placeholder="Company">

										</div>

									</div>

									<div class="form-group nospacerow">

										<div class="col-sm-12">

											<input class="form-control fcap" name="cus_address1" value="<?php echo $get_data['cus_address1'] ?>" id="cus_address1" type="text" placeholder="Address1">

										</div>

									</div>

									<div class="form-group nospacerow">

										<div class="col-sm-12">

											<input class="form-control fcap" name="cus_address2" value="<?php echo $get_data['cus_address2'] ?>" type="text" placeholder="Address2">

										</div>

									</div>

									<div class="form-group nospacerow">

										<div class="col-sm-7">

											<input class="form-control fcap" name="cus_city" value="<?php echo $get_data['cus_city'] ?>" id="city" type="text" placeholder="City" readonly>

										</div>

										<div class="col-sm-3">

											<input class="form-control fcap" name="cus_state" value="<?php echo $get_data['cus_state'] ?>" id="state" type="text" placeholder="State" readonly>

										</div>

										<div class="col-sm-2">

											<input class="form-control fcap" name="cus_zip" id="cus_zip" value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

										</div>

									</div>

									<!-- <div class="form-group">

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_zip" id="cus_zip"  value="<?php echo $get_data['cus_zip'] ?>" onchange="loadcityzip(this.value)" type="text" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

                                         </div>

                                         <div class="col-sm-6">

                                             <input class="form-control fcap" name="cus_area" id="cus_area" value="<?php echo $get_data['cus_area'] ?>" type="text" placeholder="Area">

                                         </div>

                                     </div> -->

									<div class="form-group nospacerow">

										<div class="col-sm-6">

											<select class="form-control fcap" name="tax_status">

												<option value="">Tax Status</option>

												<option <? if ($get_data['cus_tax_status'] == "1") {
															echo "selected";
														} ?> value="1">Exempt</option>

												<option <? if ($get_data['cus_tax_status'] == "2") {
															echo "selected";
														} ?> value="2">Out of state</option>

												<option <? if ($get_data['cus_tax_status'] == "3") {
															echo "selected";
														} ?> value="3">Resale</option>

										</div>

										<div class="col-sm-6">

											<input class="form-control fcap" name="cus_tax_id" value="<?php echo $get_data['cus_tax_id'] ?>" type="text" placeholder="Tax ID">

										</div>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-body">
						<div class="row space3">
							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2 3">Email Info</p>
								</div>
								<div class="form-horizontal">
									<?php
									foreach ($get_all_contacts as $allContacts) {
										if ($allContacts['conatct_type'] == "Email") {
									?>
											<div class="cnt_clone">
												<div class="form-group">
													<div class="col-sm-3">
														<select name="cuscnt_type_email[]" class="form-control fcap mailevent 4">
															<option>Choose</option>
															<?php
															foreach ($contact as $cont) {
																if ($cont['sub_name'] == "Email") {
															?>
																	<option selected value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
															<?php
																}
															} ?>
														</select>
													</div>
													<div class="col-sm-3">
														<input class="form-control txtemail" id="txtemail" name="txtemail[]" type="text" placeholder="Email" value="<?php echo $allContacts['email']; ?>" onchange="ValidateEmail(this)">

													</div>

													<div class="col-sm-3">

														<a class="btn btn-xs btn-primary fnpostemail" data-toggle="modal" data-target="#myModal1"><i class="fa fa-envelope"></i></a>

													</div>

													<!-- <div class="col-sm-3">
                                                 <a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
                                             </div> -->


													<?php if ($allContacts['default_contact'] == 1) { ?>
														<div class="col-sm-3">

															<label class="switch">

																<input class="fnchkemailId" type="radio" id="email_radio_click" name="email_radio_click[]" checked>

																<span class="slider round"></span>
															</label>

															<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
														</div>
													<?php } else { ?>
														<div class="col-sm-3">

															<label class="switch">

																<input class="fnchkemailId" type="radio" id="email_radio_click" name="email_radio_click[]" checked>
																<span class="slider round"></span>
															</label>

															<a class="btn btn-xs btn-danger cnt_clone_remove btnnrmove"><i class="fa fa-minus"></i></a>
														</div>
													<?php } ?>

												</div>

											</div>
									<?php }
									} ?>



								</div>
							</div>
							<!-- /.box-body -->

						</div>

						<!-- /.box -->

					</div>
				</div>

				<div class="box box-primary secondblock_bg ">
					<div class="box-body">
						<div class="row space3">
							<div class="col-md-12">
								<div class="box-header with-border mb5">
									<p class="uhead2 6">Contact Info</p>
								</div>

								<div class="form-horizontal">
									<?php foreach ($get_all_contacts as $allContacts) {

									?>
										<div class="cnt_clone">

											<div class="form-group">

												<div class="col-sm-3">

													<select name="cus_contact_type[]" class="form-control fcap mailevent">
														<option> </option>
														<!-- <option selected="<?php //echo $allContacts['conatct_type']; 
																				?>">
                                                     <?php //echo $allContacts['conatct_type']; 
														?>
                                                 </option> -->
														<?php

														foreach ($contact as $cont) {
															if ($allContacts['conatct_type'] == $cont['sub_name']) {
																$selectedcls = "selected";
															} else {
																$selectedcls = "";
															}
														?>
															<option <?php echo $selectedcls; ?> value="<?php echo $cont['sub_name']; ?>"><?php echo $cont['sub_name']; ?></option>
														<?php  }
														?>


														<!-- <option value="Office">Office</option>

                                                 <option value="Mobile">Mobile</option>

                                                 <option value="Summer">Summer</option>

                                                 <option value="Fax">Fax</option> -->


													</select>

												</div>




												<div class="col-sm-3">

													<input class="form-control fcap contact_no" id="contact_no" value="<?php echo $allContacts['contact_no']; ?>" name="cus_contact_no[]" type="text" placeholder="Contact details">

												</div>

												<div class="col-sm-3">

													<input type="text" class="form-control fcap" value="<?php echo $allContacts['user_contact_note']; ?>" name="cus_note[]" placeholder="Note">

												</div>
												<?php if ($allContacts['default_contact'] == 1) { ?>
													<div class="col-sm-3">
														<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
														<!-- <label>Default</label> -->
														<label class="switch">

															<input type="radio" name="radio_click[]" checked>
															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
													</div>
												<?php } else { ?>
													<div class="col-sm-3">
														<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
														<!-- <label>Default</label> -->
														<label class="switch">

															<input type="radio" name="radio_click[]">
															<span class="slider round"></span>
														</label>

														<a class="btn btn-xs btn-danger cnt_clone_remove"><i class="fa fa-minus"></i></a>
													</div>
												<?php } ?>
												<!-- <div class="col-sm-3"> -->
												<!-- <div class="radio">
                                                     <label>Default</label>


                                                 </div> -->
												<!-- <label>Default</label> -->
												<!-- <label class="switch">

                                                     <input type="checkbox"  name="radio_click[]" checked>
                                                     <span class="slider round"></span>
                                                 </label>

                                                 <a class="btn btn-xs btn-success cnt_clone_add"><i class="fa fa-plus"></i></a>
                                             </div> -->
											</div>

										</div>
									<?php } ?>
								</div>
							</div>
							<!-- /.box-body -->

						</div>

						<!-- /.box -->

					</div>
				</div>

				<div class="box box-primary secondblock_bg ">
					<div class="box-body">
						<div class="row">

							<div class="col-md-12">
								<!--  <div class="box box-default"> -->
								<div class="box-body">
									<div class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-6">
												<select class="form-control" name="apcate">
													<option value="">AP Category</option>
													<?php
													$ap_cat = $this->db->where('cat_id', 5)->get('sub_categories');
													foreach ($ap_cat->result() as $apcat_info) {

														if ($apcat_info->sub_name == $get_data['ap_cat']) {
															$selapcat = "selected";
														} else {
															$selapcat = "";
														}

													?>
														<option <?= $selapcat ?> value="<?= $apcat_info->sub_name ?>"><?= $apcat_info->sub_name ?></option>

													<?php  } ?>

												</select>
											</div>
											<div class="col-sm-6">
												<select class="form-control" name="apsubcate">
													<option value="">AP Subcategory</option>
													<?php
													$ap_subcat = $this->db->where('cat_id', 4)->get('sub_categories');
													foreach ($ap_subcat->result() as $apsubcat_info) {

														if ($apsubcat_info->sub_name == $get_data['ap_sbcat']) {
															$selapsubcat = "selected";
														} else {
															$selapsubcat = "";
														}


													?>
														<option <?= $selapsubcat ?> value="<?= $apsubcat_info->sub_name ?>"><?= $apsubcat_info->sub_name ?></option>

													<?php  } ?>
												</select>
											</div>
										</div>
									</div>
									<!--
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table   table-hover no-margin">
                                    <thead>
                                      <tr>
                                        <th>Type</th>
                                        <th>Value</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <select class="form-control">
                                            <option>    </option>
                                          </select>
                                        </td>
                                        <td>$3000</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div> -->

								</div>
								<!-- /.box-body -->

								<!--  </div> -->

								<!-- /.box -->
							</div>

						</div>
					</div>
				</div>




			</div>
			<div class="clearfix"></div>

			<div class="col-md-6">

				<div class="box box-default collapsed-box thirdblock_bg">

					<div class="box-header with-border">

						<div class="col-md-5">
							<p class="uhead2">Ship to Address <span class="text-danger">(Optional)</span></p>
						</div>

						<div class="col-md-5">
							<div class="checkbox uhead2">
								<?php
								if ($shipping['billing_addr_status'] == "1") {
									$chkstatus = "checked";
								} else {
									$chkstatus = "";
								}
								?>

								<label><input <?= $chkstatus ?> type="checkbox" name="billaddr" id="billaddr" value="1" onclick="fnchkbilladdr()">Same as billing address</label>
							</div>
						</div>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
							</button>

						</div>

						<!-- /.box-tools -->

					</div>

					<!-- /.box-header -->

					<div class="box-body" id="billaddress">

						<div class="form-horizontal">

							<div class="form-group">

								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_address1" value="<?php echo $shipping['ship_address1'] ?>" type="text" placeholder="Address1">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_address2" value="<?php echo $shipping['ship_address2'] ?>" type="text" placeholder="Address2">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_city" value="<?php echo $shipping['ship_city'] ?>" id="ship_city" type="text" placeholder="City" readonly tabindex="-1">

								</div>

							</div>

							<div class="form-group">
								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_state" value="<?php echo $shipping['ship_state'] ?>" id="ship_state" type="text" placeholder="State" readonly tabindex="-1">

								</div>


								<div class="col-sm-4">

									<input class="form-control fcap" name="cus_ship_zip" value="<?php echo $shipping['ship_zip'] ?>" id="zip_codes" type="text" onchange="loadstatecity(this.value)" placeholder="Zip" onkeydown="fnOnlyNUmbers()">

								</div>

							</div>

						</div>

					</div>

					<!-- /.box-body -->

				</div>

				<!-- /.box -->

			</div>
			<?php


		}
	}


	public function up_addvendor($item, $up_id)
	{
		$id = $up_id;
		$this->db->where('cus_id', $id);
		$this->db->update('register_vendor', $item);
		return true;
	}

	public function up_addvendshipaddress($address, $up_id)
	{
		$cusid = $up_id;
		$this->db->where('ship_user_id', $cusid);
		$this->db->update('vender_ship_address', $address);
		return true;
	}

	public function del_addvendcontactdata($up_id)
	{
		$cusid = $up_id;
		$this->db->where('cus_id', $cusid);
		$this->db->delete('vender_contact_info');
	}

	public function fnvendersrchbyph_dtls($phone)
	{
		error_reporting(0);

		$contactinfosql = $this->db->query("SELECT * from vender_contact_info WHERE contact_no = '$phone'");
		if ($contactinfosql->num_rows() > 0) {

			$getcntrow = $contactinfosql->row();
			$id = $getcntrow->cus_id;


			$phonarr = array();
			$notesarr = array();
			$cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '$id'");
			foreach ($cntinfosql->result() as $cntinfosql) {
				$phonarr[] .= $cntinfosql->contact_no;
				$notesarr[] .= $cntinfosql->user_contact_note;
			}

			$setnotes = implode(",", $notesarr);

			if (count($setnotes) == 1) {
				$htmlnotes = $setnotes;
			} else {
				$htmlnotes = explode(",", $setnotes);
			}

			$setphones = implode(",", $phonarr);

			if (count($setphones) == 1) {
				$htmlphone = $setphones;
			} else {
				$htmlphone = explode(",", $setphones);
			}


			$cust1 = $this->db->query("SELECT * from vender_contact_info AS c,register_vendor AS r WHERE c.cus_id = r.cus_id AND c.contact_no = '$phone' GROUP BY c.cus_id");

			foreach ($cust1->result() as $cust1_dtls) {


			?>

				<tr>

					<td><?= "1"; ?></td>

					<td><?= $cust1_dtls->cus_title ?></td>

					<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname ?></td>

					<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname ?></td>

					<td><?= $cust1_dtls->cus_company_name ?></td>

					<td><?= $cust1_dtls->cus_address1 ?></td>
					<td><?= $cust1_dtls->cus_address2 ?></td>
					<td><?= $cust1_dtls->cus_city ?></td>
					<td><?= $cust1_dtls->cus_state ?></td>
					<td><?= $cust1_dtls->cus_zip ?></td>
					<td><?= $cust1_dtls->cus_area ?></td>
					<td><?= trim($htmlphone, ",") ?></td>
					<td><?= trim($htmlnotes, ",") ?></td>

				</tr>


			<?php }
		} else {

			echo "No Vendors Found..!";
		}
	}








	public function get_vend_locationt_data_id($id)
	{
		$query = $this->db->select('*')
			->from('vendor_event_location')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}
	public function get_vend_crews_data_id($id)
	{
		$query = $this->db->select('*')
			->from('vendor_event_crews')
			->where(array("event_id" => $id))
			->get();

		return $query->result_array();
	}

	public function check_vend_event_id($id, $cdt)
	{
		$query = $this->db->select('*')
			->from('vendor_events_register')
			->where(array("cus_id" => $id, "event_date" => $cdt))
			->get();

		return $query->num_rows();
	}



	public function insertvendorcrew($crew)
	{
		return $this->db->insert('vendor_event_crews', $crew);
	}

	function fndelvendoreventinfo_dtls()
	{
		$this->db->where('event_id', $this->input->post('eventId'));
		$this->db->where('cus_id', $this->input->post('cusId'));
		if ($this->db->delete('vendor_events_register')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fndelvendorlocationinfo_dtls()
	{
		$this->db->where('location_id', $this->input->post('locId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('vendor_event_location')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fndelvendorcrewsinfo_dtls()
	{
		$this->db->where('crews_id', $this->input->post('crewId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('vendor_event_crews')) {
			echo "success";
		} else {
			echo "error";
		}
	}



	function upditemdesc_dtls()
	{

		$updateitemdescarr = array(

			"item_desc"  => $this->input->post('itemdesc')
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('customers_package_items', $updateitemdescarr))/*admin_package_item*/ {
			echo "success";
		} else {
			echo "error";
		}
	}

	function upditemdescount_dtls()
	{

		$updateitemdescntarr = array(

			"item_descount"  => $this->input->post('itemdescnt')
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('customers_package_items', $updateitemdescntarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}











	function crnewpitem_dtls()
	{


		$postitemsarr = array(
			"package_id" => $_POST['pckId'],
		);

		if ($this->db->insert('admin_package_item', $postitemsarr)) //admin_package_item
		{
			echo "success";
		} else {
			echo "error";
		}
	}

	function delnewpitem_dtls()
	{
		$this->db->where('id', $this->input->post('itmId'));
		if ($this->db->delete('admin_package_item'))  //admin_package_item
		{

			$getadmpcksql = $this->db->query("SELECT SUM(item_price) AS item_price FROM admin_package_item WHERE package_id='" . $this->input->post('pckId') . "'");
			$getpckrow = $getadmpcksql->row();
			$packtot = $getpckrow->item_price;

			$updtpacktot = array(

				"package_price" => $packtot
			);

			$this->db->where('package_id', $this->input->post('pckId'));
			$this->db->update('admin_package', $updtpacktot);


			echo "success";
		} else {
			echo "error";
		}
	}


	function upditemsinfo_dtls()
	{

		$updatepckinfoarr = array(

			"package_id"  => $this->input->post('pckId'),
			"item_name"  => $this->input->post('admpckId'),
			"item_quantity"  => 1,
			"item_price"  => $this->input->post('item_price'),
			"item_desc"  => $this->input->post('item_desc'),
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('admin_package_item', $updatepckinfoarr))/*admin_package_item*/ {

			$getadmpcksql = $this->db->query("SELECT SUM(item_price) AS item_price FROM admin_package_item WHERE package_id='" . $this->input->post('pckId') . "'");
			$getpckrow = $getadmpcksql->row();
			$packtot = $getpckrow->item_price;

			$updtpacktot = array(

				"package_price" => $packtot
			);

			$this->db->where('package_id', $this->input->post('pckId'));
			$this->db->update('admin_package', $updtpacktot);


			echo "success";
		} else {
			echo "error";
		}
	}

	function upditemsamnt_dtls()
	{

		$updateitemamountarr = array(

			"item_price"  => $this->input->post('itemamt')
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('admin_package_item', $updateitemamountarr))/*admin_package_item*/ {

			$getadmpcksql = $this->db->query("SELECT SUM(item_price) AS item_price FROM admin_package_item WHERE package_id='" . $this->input->post('pckId') . "'");
			$getpckrow = $getadmpcksql->row();
			$packtot = $getpckrow->item_price;

			$updtpacktot = array(

				"package_price" => $packtot
			);

			$this->db->where('package_id', $this->input->post('pckId'));
			$this->db->update('admin_package', $updtpacktot);

			echo "success";
		} else {
			echo "error";
		}
	}

	function upditemsdescrp_dtls()
	{

		$updateitemdescarr = array(

			"item_desc"  => $this->input->post('itemdesc')
		);

		$this->db->where('id', $this->input->post('txtinpid'));
		if ($this->db->update('admin_package_item', $updateitemdescarr))/*admin_package_item*/ {
			echo "success";
		} else {
			echo "error";
		}
	}


	function updtpackagetot_dtls()
	{


		$updtpacktot = array(

			"package_price" => $this->input->post('ptot')
		);

		$this->db->where('package_id', $this->input->post('pckId'));
		if ($this->db->update('admin_package', $updtpacktot)) {

			echo "success";
		} else {
			echo "error";
		}
	}
	function updtpackagedesc_dtls()
	{


		$updtpacktot = array(

			"package_desc" => $this->input->post('ptot')
		);

		$this->db->where('package_id', $this->input->post('pckId'));
		if ($this->db->update('admin_package', $updtpacktot)) {

			echo "success";
		} else {
			echo "error";
		}
	}

	function delselpackage_dtls()
	{
		$this->db->where('package_id', $this->input->post('pckId'));
		if ($this->db->delete('admin_package'))  //admin_package_item
		{

			$this->db->where('package_id', $this->input->post('pckId'));
			$this->db->delete('admin_package_item');  //admin_package

			echo "success";
		} else {
			echo "error";
		}
	}


	public function search_allcust_dtls()
	{

		error_reporting(0);

		$cust1 = $this->db->query("SELECT * from user_contact_info AS c,register_customer AS o WHERE c.cus_id = o.cus_id  GROUP BY o.cus_id ORDER BY o.cus_lname, o.cus_fname");
		$srno = 1;

		foreach ($cust1->result() as $cust1_dtls) {

			$phonarr = array();
			$notesarr = array();
			$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '" . $cust1_dtls->cus_id . "'");
			foreach ($cntinfosql->result() as $cntinfosql) {
				$phonarr[] .= $cntinfosql->contact_no;
				$notesarr[] .= $cntinfosql->user_contact_note;
			}

			$setnotes = implode(",", $notesarr);

			/*  if(count($setnotes)==1){
            $htmlnotes=$setnotes;
         }else{
            $htmlnotes=explode(",",$setnotes);
         }*/

			$setphones = implode(",", $phonarr);

			/*if(count($setphones)==1){
            $htmlphone=$setphones;
         }else{
            $htmlphone=explode(",",$setphones);
         } */

			$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$cust1_dtls->cus_id' AND conatct_type!='Email' AND default_contact=1");
			$cntctinfosql_row = $cntctinfosql->row();
			$htmlphone = $cntctinfosql_row->contact_no;
			$htmlnotes = $cntctinfosql_row->user_contact_note;


			//search_customer_opt
			$act_custsql = $this->db->query("SELECT * FROM search_customer_opt");
			$act_custrow = $act_custsql->row();

			$getfname = $act_custrow->cus_fname;
			$getlname = $act_custrow->cus_lname;
			$getcname = $act_custrow->cus_company_name;
			$getaddr1 = $act_custrow->cus_address1;
			$getaddr2 = $act_custrow->cus_address2;
			$getcity = $act_custrow->cus_city;
			$getstate = $act_custrow->cus_state;
			$getzip = $act_custrow->cus_zip;
			$getarea = $act_custrow->cus_area;
			$getphno = $act_custrow->phone_no;


			if ($getfname == 1) {
				$fnmamechksts = "display: table-cell;";
			} else {
				//$fnmamechksts="display: table-cell";
			}

			if ($getlname == 1) {
				$lnmamechksts = "display: table-cell;";
			} else {
				//$lnmamechksts="display:none;";
			}


			if ($getcname == 1) {
				$cnmamechksts = "display: table-cell;";
			} else {
				//$cnmamechksts="display:none;";
			}


			if ($getaddr1 == 1) {
				$addr1chksts = "display: table-cell;";
			} else {
				//$addr1chksts="display:none;";
			}

			if ($getaddr2 == 1) {
				$addr2chksts = "display: table-cell;";
			} else {
				//$addr2chksts="display:none;";
			}

			if ($getcity == 1) {
				$citychksts = "display: table-cell;";
			} else {
				//$citychksts="display:none;";
			}

			if ($getstate == 1) {
				$statechksts = "display: table-cell;";
			} else {
				//$statechksts="display:none;";
			}

			if ($getzip == 1) {
				$zipchksts = "display: table-cell;";
			} else {
				//$zipchksts="display:none;";
			}

			if ($getarea == 1) {
				$areachksts = "display: table-cell;";
			} else {
				//$areachksts="display:none;";
			}

			if ($getphno == 1) {
				$phnochksts = "display: table-cell;";
			} else {
				//$phnochksts="display:none;";
			}

			?>

			<tr ondblclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')">

				<td>
					<a onclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
				</td>

				<td><?= $srno ?></td>

				<td><?= $cust1_dtls->cus_title ?></td>

				<td style="text-transform:capitalize; <?= $fnmamechksts ?>"><?= $cust1_dtls->cus_fname ?></td>

				<td style="text-transform:capitalize; <?= $lnmamechksts ?>"><?= $cust1_dtls->cus_lname ?></td>

				<td style="<?= $cnmamechksts ?>"><?= $cust1_dtls->cus_company_name ?></td>
				<td style=""><?= $htmlphone ?></td>
				<td style="<?= $addr1chksts ?>"><?= $cust1_dtls->cus_address1 ?></td>
				<td style="<?= $addr2chksts ?>"><?= $cust1_dtls->cus_address2 ?></td>
				<td style="<?= $citychksts ?>"><?= $cust1_dtls->cus_city ?></td>
				<td style="<?= $statechksts ?>"><?= $cust1_dtls->cus_state ?></td>
				<td style="<?= $zipchksts ?>"><?= $cust1_dtls->cus_zip ?></td>
				<td style="<?= $areachksts ?>"><?= $cust1_dtls->cus_area ?></td>
				<!-- <td style="<?= $phnochksts ?>"><?= trim($htmlphone, ",") ?></td> -->
				<td><?= trim($htmlnotes, ",") ?></td>
				<!-- <td><? //=trim($htmlnotes,",")
							?></td>     -->
			</tr>


		<?php $srno++;
		}
	}

	function search_allvendor_dtls()
	{
		$cust1 = $this->db->query("SELECT * from vender_contact_info AS c,register_vendor AS o WHERE c.cus_id = o.cus_id  GROUP BY o.cus_id");

		$srno = 1;
		foreach ($cust1->result() as $cust1_dtls) {

			$phonarr = array();
			$notesarr = array();
			$cntinfosql = $this->db->query("SELECT * from vender_contact_info WHERE cus_id = '" . $cust1_dtls->cus_id . "'");
			foreach ($cntinfosql->result() as $cntinfosql) {
				$phonarr[] .= $cntinfosql->contact_no;
				$notesarr[] .= $cntinfosql->user_contact_note;
			}

			$setnotes = implode(",", $notesarr);

			if (count($setnotes) == 1) {
				$htmlnotes = $setnotes;
			} else {
				$htmlnotes = explode(",", $setnotes);
			}

			$setphones = implode(",", $phonarr);

			if (count($setphones) == 1) {
				$htmlphone = $setphones;
			} else {
				$htmlphone = explode(",", $setphones);
			}

		?>

			<tr>

				<td><?= $srno ?></td>

				<td><?= $cust1_dtls->cus_title ?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_fname ?></td>

				<td style="text-transform:capitalize;"><?= $cust1_dtls->cus_lname ?></td>

				<td><?= $cust1_dtls->cus_company_name ?></td>

				<td><?= $cust1_dtls->cus_address1 ?></td>
				<td><?= $cust1_dtls->cus_address2 ?></td>
				<td><?= $cust1_dtls->cus_city ?></td>
				<td><?= $cust1_dtls->cus_state ?></td>
				<td><?= $cust1_dtls->cus_zip ?></td>
				<td><?= $cust1_dtls->cus_area ?></td>
				<td><?= trim($htmlphone, ",") ?></td>
				<td><?= trim($htmlnotes, ",") ?></td>


			</tr>


			<?php $srno++;
		}
	}

	public function search_items_dtls($itemname, $itemdesc, $itemprice)
	{
		error_reporting(0);

		$con1 = "";
		if ($itemname != "") {
			//$con1='o.cus_fname ="'.$fname.'"';
			$con1 = 'o.item_name LIKE "%' . $itemname . '%"';
		}

		if ($itemdesc != "") {
			if ($con1 != "") {

				$con1 = $con1 . " OR " . 'o.item_desc LIKE "%' . $itemdesc . '%"';
			} else {

				$con1 = 'o.item_desc LIKE "%' . $itemdesc . '%"';
			}
		}

		if ($itemprice != "") {
			if ($con1 != "") {

				$con1 = $con1 . " OR " . 'o.item_price LIKE "%' . $itemprice . '%"';
			} else {

				$con1 = 'o.item_price LIKE "%' . $itemprice . '%"';
			}
		}

		$cust1 = $this->db->query("SELECT * from admin_item AS o WHERE " . $con1 . " GROUP BY o.item_id");

		if ($cust1->num_rows() > 0) {

			$srno = 1;
			foreach ($cust1->result() as $key) {

			?>
				<tr class="tr_clone price1">
					<form action="<?= site_url('fi_home/edititemadmin') ?>" method="POST" name="eeform" id="eeform">
						<td><?= $srno ?></td>

						<td>
							<input type="hidden" value="<?= $key->item_id ?>" name="item_id">
							<input type="text" class="form-control" name="edit_item_names" value="<?= $key->item_name ?>" id="id" />
						</td>

						<td> <input type="text" class="form-control" name="edit_item_desc" value="<?= $key->item_desc ?>" id="id" /> </td>

						<td>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
									<input type="number" class="form-control zeros1" name="edit_item_price" value="<?= $key->item_price ?>" id="id" />
						</td>
						</div>
						</div>
						<td>
							<div class="checkbox">
								<?php
								if ($key->iteam_texable == 1) {  ?>
									<label><input type="checkbox" name="edit_taxcheck" checked></label>
								<?php  } else { ?>
									<label><input type="checkbox" name="edit_taxcheck"></label>
								<?php  }
								?>

							</div>
						</td>

						<td>
							<div class="checkbox">
								<?php
								if ($key->item_pickup_req == 1) {  ?>
									<label><input type="checkbox" name="edit_item_pickupcheck" checked></label>
								<?php  } else { ?>
									<label><input type="checkbox" name="edit_item_pickupcheck"></label>
								<?php  }
								?>
							</div>
						</td>

						<td>
							<button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
							<a href="<?= site_url('fi_home/delete_item/' . $key->item_id) ?>" onclick="return confirm('Are you sure want to Delete..??')" class="btn btn-xs btn-warning tr_clone_edit"><i class="fa fa-trash"></i></a>
						</td>


					</form>
				</tr>

			<?php $srno++;
			}
		} else {

			echo "No Items Found..!";
		}
	}


	function search_allitems_dtls()
	{
		$cust1 = $this->db->query("SELECT * from admin_item AS o  GROUP BY o.item_id");
		$srno = 1;
		foreach ($cust1->result() as $key) {

			?>
			<tr class="tr_clone price1">
				<form action="<?= site_url('fi_home/edititemadmin') ?>" method="POST" name="eeform" id="eeform">
					<td><?= $srno ?></td>

					<td>
						<input type="hidden" value="<?= $key->item_id ?>" name="item_id">
						<input type="text" class="form-control" name="edit_item_names" value="<?= $key->item_name ?>" id="id" />
					</td>

					<td> <input type="text" class="form-control" name="edit_item_desc" value="<?= $key->item_desc ?>" id="id" /> </td>

					<td>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
								<input type="number" class="form-control zeros1" name="edit_item_price" value="<?= $key->item_price ?>" id="id" />
					</td>
					</div>
					</div>
					<td>
						<div class="checkbox">
							<?php
							if ($key->iteam_texable == 1) {  ?>
								<label><input type="checkbox" name="edit_taxcheck" checked></label>
							<?php  } else { ?>
								<label><input type="checkbox" name="edit_taxcheck"></label>
							<?php  }
							?>

						</div>
					</td>

					<td>
						<div class="checkbox">
							<?php
							if ($key->item_pickup_req == 1) {  ?>
								<label><input type="checkbox" name="edit_item_pickupcheck" checked></label>
							<?php  } else { ?>
								<label><input type="checkbox" name="edit_item_pickupcheck"></label>
							<?php  }
							?>
						</div>
					</td>

					<td>
						<button class="btn btn-xs btn-success tr_clone_save" title="Save row"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
						<a href="<?= site_url('fi_home/delete_item/' . $key->item_id) ?>" onclick="return confirm('Are you sure want to Delete..??')" class="btn btn-xs btn-warning tr_clone_edit"><i class="fa fa-trash"></i></a>
					</td>


				</form>
			</tr>

			<?php $srno++;
		}
	}


	function search_pckageitems_dtls($itemname, $itemprice)
	{

		error_reporting(0);

		$con1 = "";
		if ($itemname != "") {
			//$con1='i.item_name LIKE "%'.$itemname.'%"';
			$con1 = 'i.item_name= "' . $itemname . '"';
		}

		if ($itemprice != "") {
			if ($con1 != "") {

				//$con1= $con1 ." OR ".'i.item_price LIKE "%'.$itemprice.'%"';
				$con1 = $con1 . " AND " . 'i.item_price LIKE "%' . $itemprice . '%"';
			} else {

				$con1 = 'i.item_price LIKE "%' . $itemprice . '%"';
				//$con1='i.item_price="'.$itemprice.'"';
			}
		}

		// echo "SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM admin_package_item AS i,admin_package AS p WHERE ".$con1." AND i.package_id=p.package_id AND i.package_id='".$_POST['pckId']."' AND p.package_id='".$_POST['pckId']."' ORDER BY id ASC";

		$pckitmsql = $this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM admin_package_item AS i,admin_package AS p WHERE " . $con1 . " AND i.package_id=p.package_id AND i.package_id='" . $_POST['pckId'] . "' AND p.package_id='" . $_POST['pckId'] . "' ORDER BY id ASC");




		$chkitmsql = $this->db->query("SELECT * FROM admin_package_item WHERE package_id='" . $_POST['pckId'] . "' ORDER BY id DESC LIMIT 1");
		$isitmsrow = $chkitmsql->row();

		if ($pckitmsql->num_rows() > 0) {

			$srno = 1;
			foreach ($pckitmsql->result() as $pckitmsql_dtls) {

				$itmId = $pckitmsql_dtls->id;
				if ($isitmsrow->id == $itmId) {
					$lstinvoiceid = "fa-plus";
					$lstinvoicecls = "btn-success";
					$fninvoce = "fncrpitem('" . $pckitmsql_dtls->id . "')";
				} else {

					$lstinvoiceid = "fa-minus";
					$lstinvoicecls = "btn-danger";
					$fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
				}
				//fnupdateitmsinfo
			?>

				<tr class="tr_clone auto-index">
					<td class="increment"><?= $srno ?></td>

					<td>
						<select class="form-control 4" name="item_name<?= $itmId ?>" id="i2<?= $itmId ?>" style="width: 80px;" onchange="fnadmitemsinfo(this.value,'<?= $itmId ?>')">
							<option value="">Select</option>

							<?php

							$admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

							foreach ($admitmsql->result() as $admitmsql_dtls) {
								if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {

									$selectitmtyp = "selected";
								} else {

									$selectitmtyp = "";
								}

							?>
								<option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>

							<?php } ?>

					</td>
					<td><input type="number" name="item_quantity<?= $itmId ?>" id="i1<?= $itmId ?>" min="1" class="form-control" value="<?= $pckitmsql_dtls->item_quantity ?>" style="width: 40px;" disabled>
					</td>

					<td>
						<div class="form-group">
							<div class="input-group"><span class="input-group-addon">
									<span class="glyphicon glyphicon-usd"></span></span><input type="text" onchange="fnupdateitemamountp(this.value,'<?= $itmId ?>')" name="item_amount<?= $itmId ?>" id="i4<?= $itmId ?>" class="form-control 3" style="width: 80px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_price) ?>"></div>
						</div>
					</td>

					<td>
						<input type="text" onchange="fnupdateitemdescp(this.value,'<?= $itmId ?>')" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control 4" value="<?= $pckitmsql_dtls->item_desc ?>" style="width: 400px;">
					</td>

					<td><button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> "><i class="fa <?= $lstinvoiceid ?>"></i></button></td>
					<td>
						<input type="hidden" class="3" name="pcktot" id="pcktot" value="<?= sprintf('%0.2f', $pckitmsql_dtls->package_price) ?>">
					</td>
				</tr>

			<?php $srno++;
			}
		} else {
			echo "No Items Found..!";
		}
	}


	function search_allpckageitems_dtls()
	{
		$pckitmsql = $this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM admin_package_item AS i,admin_package AS p WHERE i.package_id=p.package_id AND i.package_id='" . $_POST['pckId'] . "' AND p.package_id='" . $_POST['pckId'] . "' ORDER BY id ASC");

		$chkitmsql = $this->db->query("SELECT * FROM admin_package_item WHERE package_id='" . $_POST['pckId'] . "' ORDER BY id DESC LIMIT 1");
		$isitmsrow = $chkitmsql->row();


		$srno = 1;
		foreach ($pckitmsql->result() as $pckitmsql_dtls) {

			$itmId = $pckitmsql_dtls->id;
			if ($isitmsrow->id == $itmId) {
				$lstinvoiceid = "fa-plus";
				$lstinvoicecls = "btn-success";
				$fninvoce = "fncrpitem('" . $pckitmsql_dtls->id . "')";
			} else {

				$lstinvoiceid = "fa-minus";
				$lstinvoicecls = "btn-danger";
				$fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
			}
			//fnupdateitmsinfo
			?>

			<tr class="tr_clone auto-index 1">
				<td class="increment"><?= $srno ?></td>

				<td>
					<select class="form-control 5" name="item_name<?= $itmId ?>" id="i2<?= $itmId ?>" style="width: 80px;" onchange="fnadmitemsinfo(this.value,'<?= $itmId ?>')">
						<option value="">Select</option>

						<?php

						$admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

						foreach ($admitmsql->result() as $admitmsql_dtls) {
							if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {

								$selectitmtyp = "selected";
							} else {

								$selectitmtyp = "";
							}

						?>
							<option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>

						<?php } ?>

				</td>
				<td><input type="number" name="item_quantity<?= $itmId ?>" id="i1<?= $itmId ?>" min="1" class="form-control" value="<?= $pckitmsql_dtls->item_quantity ?>" style="width: 40px;" disabled>
				</td>

				<td>
					<div class="form-group">
						<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span>
							</span><input type="text" onchange="fnupdateitemamountp(this.value,'<?= $itmId ?>')" name="item_amount<?= $itmId ?>" id="i4<?= $itmId ?>" class="form-control 4" style="width: 80px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_price) ?>"></div>
					</div>
				</td>

				<td>
					<input type="text" onchange="fnupdateitemdescp(this.value,'<?= $itmId ?>')" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control" value="<?= $pckitmsql_dtls->item_desc ?>" style="width: 400px;">
				</td>

				<td><button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> "><i class="fa <?= $lstinvoiceid ?>"></i></button></td>
				<td>
					<input type="hidden" class="3" name="pcktot" id="pcktot" value="<?= sprintf('%0.2f', $pckitmsql_dtls->package_price) ?>">
				</td>
			</tr>

			<?php $srno++;
		}
	}


	function delgencustomer_dtls()
	{

		//$cusdelarray=array('register_customer','events_register','user_contact_info','customers_package_items','customer_assigned_packages','customer_additional_contacts');

		//$custdelarray=array('cus_attachment','customer_balance_due','customer_credit_amount','invoices_create');

		$cus_sql = $this->db->query("SELECT * FROM register_customer ORDER BY cus_id ASC");
		$cusql_row = $cus_sql->row();


		$this->db->where('cus_id', $this->input->post('cus_id'));
		if ($this->db->delete('register_customer')) {


			$custinfodelarray = array('user_contact_info');
			$this->db->where('cus_id', $this->input->post('cus_id'));
			$this->db->delete($custinfodelarray);

			/*$custdelarray=array('cus_attachment','invoices_create');
        $this->db->where('cust_id',$this->input->post('cus_id'));
        $this->db->delete($custdelarray);*/

			//echo "success";

			echo '<input type="text" name="hdntxtcusId" id="hdntxtcusId" value="' . $cusql_row->cus_id . '">';
			echo '<input type="text" name="responce" id="responce" value="success">';

			$this->session->set_flashdata('success', 'Customer Deleted SuccessFully ..!');
		}
	}



	public function additionalcontactdata($contact2)
	{
		return $this->db->insert('customer_additional_contacts', $contact2);
	}


	public function addfinal_app_todo($data)
	{
		return $this->db->insert('todo_appointment_list', $data);
	}

	public function del_additionalcontactdata($up_id)
	{
		$cusid = $up_id;
		$this->db->where('cus_id', $cusid);
		$this->db->delete('customer_additional_contacts');
	}


	public function fndeleteaddicntinfo_dtls()
	{

		$this->db->where('id', $this->input->post('decntlId'));
		if ($this->db->delete('customer_additional_contacts')) {
			echo "success";
		} else {
			echo "error";
		}
	}






	public function insertjobsdtls($job_dtls)
	{
		return $this->db->insert('event_jobs_dtls', $job_dtls);
	}

	function fndelevntjobs_info_dtls()
	{
		$this->db->where('id', $this->input->post('jbdid'));
		$this->db->where('job_id', $this->input->post('jbId'));
		$this->db->where('event_id', $this->input->post('eventId'));
		if ($this->db->delete('event_jobs_dtls')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function getimpjobinfo_dtls()
	{

		$imprt_name = $this->input->post('imprt_name');
		$locationjson;

		$getjob_sql = $this->db->query("SELECT * from event_jobs WHERE jb_id='" . $imprt_name . "'");
		foreach ($getjob_sql->result() as $getjob_sql_dtls) {
			$locationjson['jobinfolist'][] = $getjob_sql_dtls;
		}
		echo json_encode($locationjson);
	}




	public function fncreatejobinfo_dtls()
	{

		$updatejob = array(
			"event_id" => $_POST['hdneventId'],
			"jb_type" => $_POST['jb_type'],
			"jb_name" => $_POST['jb_name'],
			"jb_notes" => $_POST['jb_notes'],
			"jb_import" => $_POST['jb_import'],
			"user" => $this->session->fi_session['id']
		);
		if ($this->db->insert('event_jobs', $updatejob)) {
			$lastinsertedjob = $this->db->insert_id();
			$jobinfo_sql = $this->db->query("SELECT * from event_jobs WHERE jb_id='" . $_POST['jb_id'] . "' ORDER BY jb_id ASC");
			$jobinfosql_row = $jobinfo_sql->row();
			$getjob_sql = $this->db->query("SELECT * from event_jobs_dtls WHERE event_id='" . $jobinfosql_row->event_id . "' AND job_id='" . $_POST['jb_id'] . "' ORDER BY id ASC"); //DESC LIMIT 1

			if ($getjob_sql->num_rows() > 0) {
				foreach ($getjob_sql->result() as $getjobsqldtls) {

					$updatejobdtls = array(
						"job_id" => $lastinsertedjob,
						"event_id" => $_POST['hdneventId'],
						"jobs_type" => $getjobsqldtls->jobs_type,
						"jobs_fname" => $getjobsqldtls->jobs_fname,
						"jobs_spouse" => $getjobsqldtls->jobs_spouse,
						"jobs_children" => $getjobsqldtls->jobs_children,
						"jobs_crew_number" => $getjobsqldtls->jobs_crew_number,
						"jobs_start_time" => $getjobsqldtls->jobs_start_time,
						"jobs_note" => $getjobsqldtls->jobs_note,
						"jobs_phone" => $getjobsqldtls->jobs_phone

					);
					$this->db->insert('event_jobs_dtls', $updatejobdtls);
				}

				echo "success";
			} else {

				echo "success";
			}
		}
	}

	function fnupdtjobinfo_dtls()
	{
		$updatejob = array(
			"event_id" => $_POST['hdneventId'],
			"jb_type" => $_POST['jb_type'],
			"jb_name" => $_POST['jb_name'],
			"jb_notes" => $_POST['jb_notes'],
			"jb_import" => $_POST['jb_import']
		);
		$this->db->where('jb_id', $_POST['jb_id']);
		if ($this->db->update('event_jobs', $updatejob)) {
			$lastinsertedjob = $_POST['jb_id'];  //$this->db->insert_id();

			//echo "SELECT * from event_jobs WHERE jb_id='".$_POST['jb_id']."' ORDER BY jb_id ASC";

			$jobinfo_sql = $this->db->query("SELECT * from event_jobs WHERE jb_id='" . $_POST['jb_id'] . "' ORDER BY jb_id ASC");
			$jobinfosql_row = $jobinfo_sql->row();

			// echo "SELECT * from event_jobs_dtls WHERE event_id='".$jobinfosql_row->event_id."' AND job_id='".$_POST['jb_id']."' ORDER BY id ASC";

			$getjob_sql = $this->db->query("SELECT * from event_jobs_dtls WHERE event_id='" . $jobinfosql_row->event_id . "' AND job_id='" . $_POST['jb_id'] . "' ORDER BY id ASC"); //DESC LIMIT 1
			//$getjobsql_row=$getjob_sql->row()

			//echo $getjob_sql->num_rows();

			if ($getjob_sql->num_rows() > 0) {
				foreach ($getjob_sql->result() as $getjobsqldtls) {

					$updatejobdtls = array(
						// "job_id" => $lastinsertedjob,
						"event_id" => $_POST['hdneventId'],
						"jobs_type" => $getjobsqldtls->jobs_type,
						"jobs_fname" => $getjobsqldtls->jobs_fname,
						"jobs_spouse" => $getjobsqldtls->jobs_spouse,
						"jobs_children" => $getjobsqldtls->jobs_children,
						"jobs_crew_number" => $getjobsqldtls->jobs_crew_number,
						"jobs_start_time" => $getjobsqldtls->jobs_start_time,
						"jobs_note" => $getjobsqldtls->jobs_note,
						"jobs_phone" => $getjobsqldtls->jobs_phone

					);
					$this->db->where('job_id', $lastinsertedjob);
					$this->db->update('event_jobs_dtls', $updatejobdtls);
				}

				echo "success";
			} else {

				echo "success";
			}
		}
	}








	function fnloadadditionalcntinfo_dtls()
	{


		$addicnt_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $_POST['custnm'] . "' AND con_type='" . $_POST['slectval'] . "' ORDER BY id LIMIT 1 ");

		$addicnt_row = $addicnt_sql->row();

		$additional_sql = $this->db->query("SELECT * FROM customer_additional_contacts WHERE cus_id='" . $_POST['custnm'] . "' AND con_type='" . $_POST['slectval'] . "' ORDER BY id DESC");
		$additional_nrows = $additional_sql->num_rows();

		if ($additional_nrows > 0) {
			foreach ($additional_sql->result() as $additionalsql_dtls) {

				if ($addicnt_row->id == $additionalsql_dtls->id) {
					$btncls = "btn-success tr_clone_add";
					$icls = "fa-plus";
					$fndel = "";
				} else {
					$btncls = "btn-danger cnt_clone_remove";
					$icls = "fa-minus";
					$fndel = "onclick='fndeleteaddicnt(&quot;" . $additionalsql_dtls->id . "&quot;)'";
				}

			?>

				<tr class="tr_clone">


					<td><input type="text" name="name[]" class="form-control fcap updwn" value="<?= $additionalsql_dtls->name ?>"></td>
					<td><input type="text" name="address[]" class="form-control fcap updwn" value="<?= $additionalsql_dtls->address ?>"></td>
					<td><input type="text" name="city[]" id="adcity" class="form-control fcap adcity text-center" value="<?= $additionalsql_dtls->city ?>" readonly tabindex="-1"></td>
					<td><input type="text" name="state[]" id="adstate" class="form-control fcap adstate text-center" value="<?= $additionalsql_dtls->state ?>" readonly tabindex="-1"></td>
					<td><input type="text" name="zip[]" id="zip" class="form-control fcap zip updwn text-center" value="<?= $additionalsql_dtls->zip ?>" onkeydown="fnOnlyNUmbers()"></td>
					<td><input type="text" name="home[]" class="form-control fcap contact_no updwn" value="<?= $additionalsql_dtls->home ?>"></td>
					<td><input type="text" name="cel[]" class="form-control fcap contact_no updwn" value="<?= $additionalsql_dtls->cel ?>"></td>
					<td><input type="text" name="work[]" class="form-control fcap contact_no updwn" value="<?= $additionalsql_dtls->work ?>"></td>
					<td><input type="text" name="emailaddr[]" class="form-control updwn" value="<?= $additionalsql_dtls->email ?>"></td>
					<td>
						<!--  <button class="btn btn-xs <?= $btncls ?>"><i class="fa <?= $icls ?>"></i></button> -->
						<a <?= $fndel ?>class="btn btn-xs <?= $btncls ?>"><i class="fa <?= $icls ?>"></i></a>
					</td>

				</tr>
			<?php  }
		} else {

			?>

			<tr class="tr_clone">


				<td><input type="text" name="name[]" class="form-control fcap updwn"></td>
				<td><input type="text" name="address[]" class="form-control fcap updwn"></td>
				<td><input type="text" name="city[]" id="adcity" class="form-control fcap adcity" readonly tabindex="-1"></td>
				<td><input type="text" name="state[]" id="adstate" class="form-control fcap adstate" readonly tabindex="-1"></td>
				<td><input type="text" name="zip[]" id="zip" class="form-control fcap zip updwn" onkeydown="fnOnlyNUmbers()"></td>
				<td><input type="text" name="home[]" class="form-control fcap contact_no updwn"></td>
				<td><input type="text" name="cel[]" class="form-control fcap contact_no updwn"></td>
				<td><input type="text" name="work[]" class="form-control fcap contact_no updwn"></td>
				<td><input type="text" name="emailaddr[]" class="form-control updwn"></td>
				<td>
					<button class="btn btn-xs btn-success tr_clone_add"><i class="fa fa-plus"></i></button>
				</td>

			</tr>

		<?php }
	}

	function addlettersinfo_dtls()
	{
		/*  $letterarr=array(
            "name" => $this->input->post('txtlettertyp'),
            "desc" => $this->input->post('textletterdetails')
        );

      $getexist_sql=$this->db->where('name',$this->input->post('txtlettertyp'))->get('adm_letters_type');
      $rowCount = $getexist_sql->num_rows();
      if($rowCount==1)
      {
              $this->db->where('name',$this->input->post('txtlettertyp'));
            if($this->db->update('adm_letters_type',$letterarr))
              {
                $this->session->set_flashdata('success',"Letter Updated Successfully..!!");
                redirect('fi_home/administration_letters');
              }
      }else{

          if($this->db->insert('adm_letters_type',$letterarr))
             {
                $this->session->set_flashdata('success',"Letter Inserted Successfully..!!");
                redirect('fi_home/administration_letters');
             }
      }*/
	}

	function getletterinfo_dtls()
	{
		$lettersjson = array();
		$letter_sql = $this->db->query("SELECT * FROM adm_letters_type WHERE id='" . $_POST['ltype'] . "'");
		foreach ($letter_sql->result() as $lettersql_dtls) {
			$lettersjson["lettersinfo"][] = $lettersql_dtls;
		}
		echo json_encode($lettersjson);
	}

	function fndelletterinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_letters_type')) {
			$this->session->set_flashdata('success', "Letter Deleted Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}




	function getcrewavailabilityinfo_dtls()
	{
		$crewavljson = array();
		$crewavl_sql = $this->db->query("SELECT * FROM adm_crewavailability_info WHERE id='" . $_POST['templ_typ'] . "'ORDER BY id ASC");
		foreach ($crewavl_sql->result() as $crewavlsql_dtls) {
			$crewavljson["crewsavlinfo"][] = $crewavlsql_dtls;
		}
		echo json_encode($crewavljson);
	}









	function delinvnote_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('customer_invoice_notes')) {
			echo "success";
		} else {
			echo "error";
		}
	}



	function fnpickupreq_info_update_dtls()
	{
		$curr_date = date('Y-m-d');
		$pac_update_qty = $this->db->query("SELECT * FROM customers_pickup_items WHERE  id='" . $_POST['hdnpreqid'] . "'");
		$qtyrow = $pac_update_qty->row();
		$updatedqty = $qtyrow->up_item_qty;
		// echo "update_qty :".$updatedqty;echo "<br>";
		// echo "qty :".$_POST['qty'];echo "<br>";
		// if ($_POST['qty']==0) {
		//     $total_qty=0;
		// }
		// else {

		$total_qty = $updatedqty - $_POST['qty'];
		//}
		// echo "qty :".$total_qty;

		$sumofpckgsql = $this->db->query("SELECT * FROM customers_package_items WHERE  id='" . $_POST['hdnpreqid'] . "'");
		$getsumpckrow = $sumofpckgsql->row();
		if ($getsumpckrow != "") {
			// echo "Aks: ";
			if ($updatedqty != $_POST['qty']) {
				// code...
				// echo "Aks: 1 ";
				$updtrqpckitemsts = array(
					"item_quantity" => $updatedqty - $_POST['qty'],
				);
				$this->db->where('id', $_POST['hdnpreqid']);
				$this->db->update('customers_package_items', $updtrqpckitemsts);
			} else {
				// echo "Aks: 2 ";
				$this->db->where('id', $_POST['hdnpreqid']);
				$this->db->delete('customers_package_items');
			}
		} else {
			// echo "Sumo: ";
			if ($this->db->query("INSERT INTO customers_package_items(id,cus_id,inv_id,package_id,item_name,item_quantity,item_price,item_desc,assigned_pckid,pickupreq) SELECT id,cus_id,inv_id,package_id,item_name,item_quantity,item_price,item_desc,assigned_pckid,pickupreq FROM customers_pickup_items WHERE id='" . $_POST['hdnpreqid'] . "'")) {
				// echo "Sumo: 1 ";

				if ($updatedqty != $_POST['qty']) {
					// code...
					// echo "S: 1 ";
					$updtrqpckitemsts = array(
						"item_quantity" => $updatedqty - $_POST['qty'],
					);
					$this->db->where('id', $_POST['hdnpreqid']);
					$this->db->update('customers_package_items', $updtrqpckitemsts);
				} else {
					// echo "S: 2 ";
					$this->db->where('id', $_POST['hdnpreqid']);
					$this->db->delete('customers_package_items');
				}
				// $this->db->where('id',$_POST['hdnpreqid']);
				// $this->db->delete('customers_pickup_items');

			}
		}

		if ($_POST['qty'] != 0) {
			// echo "if 1 ";
			$updteqty = array(
				"item_quantity" => $_POST['qty'],
				// "up_item_qty" => $_POST['qty'],
			);
			$this->db->where('id', $_POST['hdnpreqid']);
			$this->db->update('customers_pickup_items', $updteqty);
			echo "success";
		} else {
			// echo "else 1 ";
			$this->db->where('id', $_POST['hdnpreqid']);
			$this->db->delete('customers_pickup_items');
			echo "success";
		}
	}

	function fnupreqtqyinfo_dtls()
	{

		//$chkpckreqqtysql=$this->db->query("SELECT * FROM customers_pickup_items WHERE id='".$_POST['hdnpreqid']."'");
		$chkpckreqqtysql = $this->db->query("SELECT * FROM customers_pickup_items WHERE pid='" . $_POST['hdnpreqpid'] . "'");
		$chkpckreqqtysqlrow = $chkpckreqqtysql->row();
		$chkpreqqty = $chkpckreqqtysqlrow->item_quantity;

		if ($_POST['pckqty'] < $chkpreqqty) {

			$updtrqpckitemsts = array(
				"item_quantity" => $_POST['pckqty']
			);
			$this->db->where('pid', $_POST['hdnpreqpid']);
			if ($this->db->update('customers_pickup_items', $updtrqpckitemsts)) {
				$pickinfoarr = array(
					"id" => $chkpckreqqtysqlrow->id,
					"cus_id" => $chkpckreqqtysqlrow->cus_id,
					"inv_id" => $chkpckreqqtysqlrow->inv_id,
					"package_id" => $chkpckreqqtysqlrow->package_id,
					"item_name" => $chkpckreqqtysqlrow->item_name,
					"item_quantity" => $chkpreqqty - $_POST['pckqty'],
					"item_price" => $chkpckreqqtysqlrow->item_price,
					"item_desc" => $chkpckreqqtysqlrow->item_desc,
					"assigned_pckid" => $chkpckreqqtysqlrow->assigned_pckid,
					"pickupreq" => $chkpckreqqtysqlrow->pickupreq
				);
				if ($this->db->insert('customers_package_items', $pickinfoarr)) {
					echo "success";
				}
			}
		} else {
		}
	}

	function fndelpickupreqinfo_dtls()
	{

		$this->db->where('id', $_POST['hdnpreqid']);
		if ($this->db->delete('customers_pickup_items')) {

			$updtrqpckitemsts = array(
				"pickupreq" => ""
			);
			$this->db->where('id', $_POST['hdnpreqid']);
			$this->db->update('customers_package_items', $updtrqpckitemsts);
			echo "success";
		} else {
			echo "error";
		}
	}





	function updinvpckgamt_dtls()
	{

		$itemdiscounted_amt = "";
		if ($_POST['pckdestyp'] == "1") // $
		{
			$pstqtydisamt = $this->input->post('pckdesamt'); // * $this->input->post('itemwoutqty');

			$itemdiscounted_amt = $pstqtydisamt - $this->input->post('pcktot');
		} else  if ($_POST['pckdestyp'] == "2") // %
		{
			$pstqtydisamt = $this->input->post('pckdesamt'); //* $this->input->post('itemwoutqty');

			$itemdiscounted_amt = ($this->input->post('pcktot') / 100) * $pstqtydisamt;
		} else {
			//$pstqtydisamt= $this->input->post('pcktot'); * $this->input->post('itemwoutqty');
			$itemdiscounted_amt = NULL;
		}

		//pck_discnt_typ, pck_discnt_amt, pck_discounted_amt
		$updateinvpckamtarr = array(
			"package_price"  => $this->input->post('pcktot'),
			"pck_discounted_amt" => $itemdiscounted_amt
		);
		$this->db->where('id', $this->input->post('tbid'));
		if ($this->db->update('customer_assigned_packages', $updateinvpckamtarr)) {

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND discounted_amt IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE pck_discounted_amt IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;


			$invoicetot = $descountitemstot + $itemstot + $desountpckgstot + $pckgstot;

			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $invoicetot
			);
			$this->db->where('invoice_id', $_POST['invId']);
			$this->db->where('cust_id', $_POST['custId']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	public function search_last_invoice()
	{
		$query = $this->db->select('invoices_create.invoice_id,invoices_create.invoice_balance_due')
			->from('invoices_create')
			->order_by("invoices_create.invoice_id DESC")
			->limit(1)
			->get();

		return $query->result_array();
	}




	function updtinvevnttype_dtls()
	{

		$feildname = $this->input->post('fieldnm');

		$updateinvarr = array(

			$feildname  => $this->input->post('inptxtval')
		);

		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->update('invoices_create', $updateinvarr)) {

			$updateinvevntarr = array(
				"inv_id"  => $this->input->post('invoiceid')
			);
			$this->db->where('event_id', $this->input->post('inptxtval'));
			$this->db->update('events_register', $updateinvevntarr);
			echo "success";
		} else {
			echo "error";
		}
	}

	public function getSearchInvInfo_dtls()
	{
		error_reporting(0);
		if ($_POST['custid'] != "") {
			// code...

			$cntinfosql = $this->db->query("SELECT * FROM user_contact_info WHERE cus_id='" . $_POST['custid'] . "' AND default_contact=1 AND conatct_type!='Email'");
			$cntinfosql_row = $cntinfosql->row();

			$this->db->select('*');
			$this->db->from('invoices_create');
			$this->db->where('invoice_id', $_POST['invoiceid']);
			$singleinvinfo = $this->db->get()->result_array()[0];

			$custregsqlq = $this->db->query("SELECT * FROM register_customer WHERE cus_id='" . $_POST['custid'] . "'");
			$custregsqlrows = $custregsqlq->row();

			$balance_count = $this->db->select('SUM(invoice_balance_due) as total')->where('cust_id', $_POST['custid'])->get('invoices_create')->result_array()[0];
			// print_r($_POST['custid']);echo "<br>";
			// print_r($balance_count);
			// $balance_query="SELECT count(*) as count FROM invoices_create WHERE cust_id=$_POST['custid']";
			// echo $balance_query;
		}
		?>

		<!--  <div class="col-md-2">
                     <div class="form-group" id="contact_info">
                         <input class="form-control fcap contact_no" type="text" value="<?= $cntinfosql_row->contact_no ?>" placeholder="(123) 456-7890">
                    </div>
                  </div> -->

		<div class="col-md-2 cus_acc_no">

			<div class="form-group" id="lastinvId">

				<input class="form-control" type="text" placeholder="Acc no" value="<?= $custregsqlrows->cus_acc_no ?>">

				<!--  <input class="form-control"  type="text" placeholder="433" value="<?php //echo $singleinvinfo['invoice_id'] 
																						?>"> -->

			</div>

		</div>

		<div class="col-md-2 balance_count">

			<div class="form-group" id="lastinvduebal">

				<input class="form-control" type="text" placeholder="Balance" value="$ <?= sprintf('%0.2f', $balance_count['total']) ?>">
				<!-- <input class="form-control"  type="text" placeholder="$16.33" value="$ <?= sprintf('%0.2f', $singleinvinfo['invoice_balance_due']) ?>"> -->

			</div>

		</div>

		<?php }

	function fndeltremsinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_terms_type')) {
			$this->session->set_flashdata('success', "Terms Deleted Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}

	function gettermsinfo_dtls()
	{
		$trmsson;
		$admtermsql = $this->db->query("SELECT * FROM adm_terms WHERE name='" . $_POST['temp_txttermstypId'] . "' AND subcat_id='" . $_POST['temp_txttermstype'] . "'");

		foreach ($admtermsql->result() as $admtermsql_dtls) {
			$trmsson['admtermsdata'] = $admtermsql_dtls;
		}

		echo json_encode($trmsson);
	}



	function crnewinvterms_dtls()
	{

		$insertinvtermsarr = array(
			"subcat_id"  => $this->input->post('trmtypeid'),
			"invoice_id"  => $this->input->post('invoiceid')
		);

		if ($this->db->insert('tbl_invoice_terms', $insertinvtermsarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function delterms_dtls()
	{
		$this->db->where('id', $this->input->post('invtrmsId'));
		if ($this->db->delete('tbl_invoice_terms')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updtermamt_dtls()
	{

		$updtinvtermsarr = array(
			"amount"  => $this->input->post('temp_txttotamount'),
		);
		$this->db->where('id', $this->input->post('temp_crntrmsid'));
		if ($this->db->update('tbl_invoice_terms', $updtinvtermsarr)) //invoice_terms
		{
			echo "success";
		} else {
			echo "error";
		}
	}

	function crnwtask_dtls()
	{
		$crtskarr = array(
			"task_completed" => "0"
		);
		if ($this->db->insert('invoice_task', $crtskarr)) {
			$this->session->set_flashdata('success', "Task Created Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}

	function fndeltaskinfo_dtls()
	{
		$this->db->where('task_id', $this->input->post('delId'));
		if ($this->db->delete('invoice_task')) {
			$this->session->set_flashdata('success', "Task Deleted Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}

	function updtask_dtls()
	{

		$feildname = $this->input->post('fieldnm');

		$updateinvarr = array(

			$feildname  => $this->input->post('inptxtval')
		);

		$this->db->where('task_id', $this->input->post('taksId'));
		if ($this->db->update('invoice_task', $updateinvarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function crinvnwtask_dtls()
	{
		$crtskarr = array(
			"invoice_id" => $_POST['invoiceid'],
			"task_completed" => "0"
		);
		if ($this->db->insert('invoice_task', $crtskarr)) {
			//$this->session->set_flashdata('success',"Task Created Successfully..!!");
			//echo "success";

			$tasksql = $this->db->query("SELECT * FROM invoice_task WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY task_id ASC");
			$chktsksql = $this->db->query("SELECT * FROM invoice_task  WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY task_id DESC LIMIT 1");
			$istaskrow = $chktsksql->row();

			if ($tasksql->num_rows() > 0) {

				foreach ($tasksql->result() as $tasksql_dtls) {

					$taskId = $tasksql_dtls->task_id;
					$taskinvId = $tasksql_dtls->invoice_id;
					$taskstrtdt = $tasksql_dtls->task_date_started;
					$tasksktyp = $tasksql_dtls->task_type;
					//$taskusr=$tasksql_dtls->task_user;
					$taskduedate = $tasksql_dtls->task_due_date;
					$taskcompleted = $tasksql_dtls->task_completed;
					$taskcompletedby = $tasksql_dtls->task_completed_by;
					$taskcompleteddate = $tasksql_dtls->task_completed_date;
					$tasknote = $tasksql_dtls->task_note;
					$taskenteredby = $tasksql_dtls->task_entered_by;


					//if($taskcompleted==1)
					$todaysdate = date("m-d-Y");
					$mydate = date('m-d-Y', strtotime($taskduedate));
					if ($todaysdate > $mydate && $mydate != "01-01-1970") {
						$rwcolor = "background-color: #f17b7b;";
					} else {
						$rwcolor = "background-color: #e6e677;";
					}

		?>

					<tr class="tr_clone" style="<?= $rwcolor ?>">
						<td>
							<input type="date" name="task_strtdate" id="task_strtdate" class="form-control taskstrtdate w95" value="<?= $taskstrtdt ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_date_started')">
							<input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $_POST['invoiceid'] ?>">
						</td>

						<td>
							<select class="form-control taskuser" name="task_name" id="task_name" style="width: 100px;" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_type')">
								<option value="">Choose </option>
								<?php
								$invtasktype = $this->db->query("SELECT * FROM invoice_task");
								foreach ($invtasktype->result() as $invtasktype_dtls) {
									if ($taskId == $invtasktype_dtls->task_id) {
										$seltsktyp = "selected";
									} else {
										$seltsktyp = "";
									}

								?>
									<option <?= $seltsktyp ?> value="<?= $invtasktype_dtls->task_type ?>"><?= $invtasktype_dtls->task_type ?></option>
								<?php
								}
								?>
							</select>
						</td>

						<td>

							<select class="form-control" name="task_user" id="task_user" style="width: 130px;" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_user')" disabled>
								<option value=""> Choose</option>
								<?php
								$admloguser = $this->db->query("SELECT * FROM users");
								foreach ($admloguser->result() as $admloguser_dtls) {
									if ($this->session->userdata['fi_session']['id'] == $admloguser_dtls->id) {
										$seluser = "selected";
									} else {
										$seluser = "";
									}

								?>
									<option <?= $seluser ?> value="<?= $admloguser_dtls->id ?>"><?= $admloguser_dtls->name ?></option>
								<?php
								}
								?>
							</select>

						</td>

						<td><input type="date" name="task_due_date" id="task_due_date" class="form-control taskduedate w95" value="<?= $taskduedate ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_due_date')"></td>

						<td>
							<div class="checkbox">
								<label>
									<?php
									if ($taskcompleted == 1) {
										$setval = "checked";
										$setflg = "0";
									} else {
										$setval = "";
										$setflg = "1";
									}
									?>
									<input <?= $setval ?> type="checkbox" value="<?= $setflg ?>" name="task_completed" id="task_completed" class="taskcompleted" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed')"></label>
							</div>
						</td>

						<td>
							<input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="<?= $taskcompletedby ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed_by')">
						</td>

						<td><input type="date" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate text-center" value="<?= $taskcompleteddate ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed_date')"></td>

						<td><input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value="<?= $tasknote ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_note')"></td>

						<td><input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value="<?= $taskenteredby ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_entered_by')"></td>

						<td>
							<a onclick="fndeltasks('<?= $taskId ?>','<?= $taskinvId ?>')" class="btn btn-xs btn-danger "><i class="fa fa-minus"></i></a>
						</td>

					</tr>
			<?php }
			} ?>

			<tr class="tr_clone">
				<td>
					<input type="date" name="task_strtdate" id="task_strtdate" class="form-control taskstrtdate w95" value="">
					<input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $_POST['invoiceid'] ?>">
				</td>

				<td>
					<select class="form-control tasksname" name="task_name" id="task_name" style="width: 100px;">
						<option value="">Choose </option>
						<?php
						$invtasktype = $this->db->query("SELECT * FROM invoice_task");
						foreach ($invtasktype->result() as $invtasktype_dtls) {
						?>
							<option value="<?= $invtasktype_dtls->task_type ?>"><?= $invtasktype_dtls->task_type ?></option>
						<?php
						}
						?>
					</select>
				</td>

				<td>

					<select class="form-control" name="task_user" id="task_user" style="width: 130px;" disabled>
						<option value=""> Choose</option>
						<?php
						$admloguser = $this->db->query("SELECT * FROM users");
						foreach ($admloguser->result() as $admloguser_dtls) {
							if ($this->session->userdata['fi_session']['id'] == $admloguser_dtls->id) {
								$seluser = "selected";
							} else {
								$seluser = "";
							}

						?>
							<option <?= $seluser ?> value="<?= $admloguser_dtls->id ?>"><?= $admloguser_dtls->name ?></option>
						<?php
						}
						?>
					</select>

				</td>

				<td><input type="date" name="task_due_date" id="task_due_date" class="form-control taskduedatlast w95" value=""></td>

				<td>
					<div class="checkbox">
						<label>

							<input type="checkbox" value="" name="task_completed" id="task_completed" class="taskcompleted"></label>
					</div>
				</td>

				<td>
					<input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="">
				</td>

				<td><input type="date" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate text-center" value=""></td>

				<td><input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value=""></td>

				<td><input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value=""></td>

				<td>
					<a onclick="fncrtasks('<?= $_POST['invoiceid'] ?>')" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></a>
				</td>

			</tr>
			<?php

		} else {
			//echo "error";
		}
	}

	function fndelinvtaskinfo_dtls()
	{
		$this->db->where('task_id', $this->input->post('delId'));
		if ($this->db->delete('invoice_task')) {
			//$this->session->set_flashdata('success',"Task Deleted Successfully..!!");
			echo "success";
		} else {
			echo "error";
		}
	}

	function updinvtask_dtls()
	{

		$invtasksql = $this->db->query("SELECT * FROM invoice_task WHERE task_id='" . $_POST['taksId'] . "'");
		$invtaskrow = $invtasksql->row();
		$invoiceid = $invtaskrow->invoice_id;
		$tasksdtstrted = $invtaskrow->task_date_started;
		$taskstyp = $invtaskrow->task_type;
		$taskssbtskstyp = $invtaskrow->sub_task_type;
		$tsksuser = $invtaskrow->task_user;
		$tsksduedt = $invtaskrow->task_due_date;
		$tskstatus = $invtaskrow->task_completed;
		$tskscompdt = $invtaskrow->task_completed_date;
		$tsksenterdby = $invtaskrow->task_entered_by;

		$feildname = $this->input->post('fieldnm');
		if ($feildname == "task_completed") {
			$updateinvarr = array(
				//$feildname  => $this->input->post('inptxtval'),
				"task_completed"  => $this->input->post('inptxtval'),
				"task_completed_date" => date('Y-m-d'),
				"task_completed_by" => $this->session->userdata['fi_session']['id']
			);

			$insrtbckupinvarr = array(
				"task_id" => $_POST['taksId'],
				"invoice_id" => $invoiceid,
				"task_date_started" => $tasksdtstrted,
				"task_type" => $taskstyp,
				"sub_task_type" => $taskssbtskstyp,
				"task_user" => $tsksuser,
				"task_due_date" => $tsksduedt,
				"task_completed"  => $this->input->post('inptxtval'),
				"task_completed_date" => date('Y-m-d'),
				"task_completed_by" => $this->session->userdata['fi_session']['id'],
				"task_entered_by" => $tsksenterdby
			);
			$this->db->insert('invoice_task_bckup', $insrtbckupinvarr);
		} else if ($feildname == "task_user") {
			$updateinvarr = array(
				"task_user"  => $this->input->post('inptxtval')
			);

			$insrtbckupinvarr = array(
				"task_id" => $_POST['taksId'],
				"invoice_id" => $invoiceid,
				"task_date_started" => $tasksdtstrted,
				"task_type" => $taskstyp,
				"sub_task_type" => $taskssbtskstyp,
				"task_user" => $this->input->post('inptxtval'),
				"task_due_date" => $tsksduedt,
				"task_completed"  => $tskstatus,
				"task_completed_date" => date('Y-m-d'),
				"task_completed_by" => $this->session->userdata['fi_session']['id'],
				"task_entered_by" => $tsksenterdby
			);
			$this->db->insert('invoice_task_bckup', $insrtbckupinvarr);
		} else if ($feildname == "task_due_date") {
			$updateinvarr = array(
				"task_due_date"  => date("Y-m-d", strtotime($this->input->post('inptxtval')))
			);

			$insrtbckupinvarr = array(
				"task_id" => $_POST['taksId'],
				"invoice_id" => $invoiceid,
				"task_date_started" => $tasksdtstrted,
				"task_type" => $taskstyp,
				"sub_task_type" => $taskssbtskstyp,
				"task_user" => $tsksuser,
				"task_due_date" => $this->input->post('inptxtval'),
				"task_completed"  => $tskstatus,
				"task_completed_date" => date('Y-m-d'),
				"task_completed_by" => $this->session->userdata['fi_session']['id'],
				"task_entered_by" => $tsksenterdby
			);
			$this->db->insert('invoice_task_bckup', $insrtbckupinvarr);
		} else if ($feildname == "task_completed_date") {
			$updateinvarr = array(
				"task_completed_date"  => date("Y-m-d", strtotime($this->input->post('inptxtval')))
			);

			$insrtbckupinvarr = array(
				"task_id" => $_POST['taksId'],
				"invoice_id" => $invoiceid,
				"task_date_started" => $tasksdtstrted,
				"task_type" => $taskstyp,
				"sub_task_type" => $taskssbtskstyp,
				"task_user" => $tsksuser,
				"task_due_date" => $tsksduedt,
				"task_completed"  => $tskstatus,
				"task_completed_date" => $this->input->post('inptxtval'),
				"task_completed_by" => $this->session->userdata['fi_session']['id'],
				"task_entered_by" => $tsksenterdby
			);
			$this->db->insert('invoice_task_bckup', $insrtbckupinvarr);
		} else if ($feildname == "task_date_started") {

			$updateinvarr = array(
				"task_date_started"  => date("Y-m-d", strtotime($this->input->post('inptxtval')))
			);

			$insrtbckupinvarr = array(
				"task_id" => $_POST['taksId'],
				"invoice_id" => $invoiceid,
				"task_date_started" => date("Y-m-d", strtotime($this->input->post('inptxtval'))),
				"task_type" => $taskstyp,
				"sub_task_type" => $taskssbtskstyp,
				"task_user" => $tsksuser,
				"task_due_date" => $tsksduedt,
				"task_completed"  => $tskstatus,
				"task_completed_date" => $this->input->post('inptxtval'),
				"task_completed_by" => $this->session->userdata['fi_session']['id'],
				"task_entered_by" => $tsksenterdby
			);
			$this->db->insert('invoice_task_bckup', $insrtbckupinvarr);
		}

		/*else{
            $updateinvarr=array(
             $feildname  => $this->input->post('inptxtval')
          );
        }*/
		$this->db->where('task_id', $this->input->post('taksId'));
		if ($this->db->update('invoice_task', $updateinvarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updinvtaskinfo_dtls()
	{

		$invtaskssql = $this->db->query("SELECT * FROM invoice_task WHERE task_type='" . $_POST['taksId'] . "'");
		$invtaskrow = $invtaskssql->row();
		$invid = $invtaskrow->invoice_id;
		$taskdatestarted = $invtaskrow->task_date_started;
		$tasktype = $invtaskrow->task_type;
		$taskuser = $invtaskrow->task_user;
		$taskduedate = $invtaskrow->task_due_date;
		$taskcompleted = $invtaskrow->task_completed;
		$taskcompletedby = $invtaskrow->task_completed_by;
		$taskcompleteddate = $invtaskrow->task_completed_date;
		$tasknote = $invtaskrow->task_note;
		$taskenteredby = $invtaskrow->task_entered_by;


		if ($invid != "") {
			$invoiceid = $invid;
		} else {
			$invoiceid = $_POST['invoiceid'];
		}

		if ($_POST['taskstrtdate'] != "") {
			$setaskdatestarted = date("Y-m-d", strtotime($_POST['taskstrtdate']));
		} else {
			$setaskdatestarted = date("Y-m-d", strtotime($taskdatestarted));
		}

		if ($tasktype != "") {
			$settasktype = $tasktype;
		} else {
			$settasktype = $_POST['taksId'];
		}




		$updateinvtasksarr = array(
			"invoice_id"  => $invoiceid,
			"task_date_started"  => $setaskdatestarted,
			"task_type"  => $settasktype,
			"task_user"  => $taskuser,
			"task_due_date"  => $taskduedate,
			"task_completed"  => $taskcompleted,
			"task_completed_by"  => $taskcompletedby,
			"task_completed_date"  => $taskcompleteddate,
			"task_note"  => $tasknote,
			"task_entered_by"  => $taskenteredby
		);
		if ($this->db->insert('invoice_task', $updateinvtasksarr)) {
			//echo "success";

			$tasksql = $this->db->query("SELECT * FROM invoice_task WHERE invoice_id='" . $invoiceid . "' ORDER BY task_id ASC");
			$chktsksql = $this->db->query("SELECT * FROM invoice_task  WHERE invoice_id='" . $invoiceid . "' ORDER BY task_id DESC LIMIT 1");
			$istaskrow = $chktsksql->row();

			if ($tasksql->num_rows() > 0) {

				foreach ($tasksql->result() as $tasksql_dtls) {

					$taskId = $tasksql_dtls->task_id;
					$taskinvId = $tasksql_dtls->invoice_id;
					$taskstrtdt = $tasksql_dtls->task_date_started;
					$tasksktyp = $tasksql_dtls->task_type;
					//$taskusr=$tasksql_dtls->task_user;
					$taskduedate = $tasksql_dtls->task_due_date;
					$taskcompleted = $tasksql_dtls->task_completed;
					$taskcompletedby = $tasksql_dtls->task_completed_by;
					$taskcompleteddate = $tasksql_dtls->task_completed_date;
					$tasknote = $tasksql_dtls->task_note;
					$taskenteredby = $tasksql_dtls->task_entered_by;


					//if($taskcompleted==1)
					$todaysdate = date("m-d-Y");
					$mydate = date('m-d-Y', strtotime($taskduedate));
					if ($todaysdate > $mydate && $mydate != "01-01-1970") {
						$rwcolor = "background-color: #f17b7b;";
					} else {
						$rwcolor = "background-color: #e6e677;";
					}

			?>

					<tr class="tr_clone" style="<?= $rwcolor ?>">
						<td>
							<?php $dt = date("m/d/Y", strtotime($taskstrtdt)); ?>
							<input type="text" name="task_strtdate" id="task_strtdate" class="form-control taskstrtdate w95" value="<?= ($dt != "01/01/1970") ? $dt : "" ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_date_started')">
							<input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $_POST['invoiceid'] ?>">
						</td>

						<td>
							<select class="form-control taskuser" name="task_name" id="task_name" style="width: 100px;" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_type')">
								<option value="">Choose </option>
								<?php
								$invtasktype = $this->db->query("SELECT * FROM invoice_task");
								foreach ($invtasktype->result() as $invtasktype_dtls) {
									if ($taskId == $invtasktype_dtls->task_id) {
										$seltsktyp = "selected";
									} else {
										$seltsktyp = "";
									}

								?>
									<option <?= $seltsktyp ?> value="<?= $invtasktype_dtls->task_type ?>"><?= $invtasktype_dtls->task_type ?></option>
								<?php
								}
								?>
							</select>
						</td>

						<td>

							<select class="form-control" name="task_user" id="task_user" style="width: 130px;" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_user')" disabled>
								<option value="">Choose </option>
								<?php
								$admloguser = $this->db->query("SELECT * FROM users");
								foreach ($admloguser->result() as $admloguser_dtls) {
									if ($this->session->userdata['fi_session']['id'] == $admloguser_dtls->id) {
										$seluser = "selected";
									} else {
										$seluser = "";
									}

								?>
									<option <?= $seluser ?> value="<?= $admloguser_dtls->id ?>"><?= $admloguser_dtls->name ?></option>
								<?php
								}
								?>
							</select>

						</td>

						<td>
							<?php $dt = date("m/d/Y", strtotime($taskduedate)); ?>
							<input type="text" name="task_due_date" id="task_due_date" class="form-control taskduedate w95" value="<?= ($dt != "01/01/1970") ? $dt : "" ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_due_date')">
						</td>

						<td>
							<div class="checkbox">
								<label>
									<?php
									if ($taskcompleted == 1) {
										$setval = "checked";
										$setflg = "0";
									} else {
										$setval = "";
										$setflg = "1";
									}
									?>
									<input <?= $setval ?> type="checkbox" value="<?= $setflg ?>" name="task_completed" id="task_completed" class="taskcompleted" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed')"></label>
							</div>
						</td>

						<td>
							<input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="<?= $taskcompletedby ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed_by')">
						</td>

						<td>
							<?php $dt = date("m/d/Y", strtotime($taskcompleteddate)); ?>
							<input type="text" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate text-center" value="<?= ($dt != "01/01/1970") ? $dt : "" ?>" onblur="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_completed_date')">
						</td>

						<td><input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value="<?= $tasknote ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_note')"></td>

						<td><input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value="<?= $taskenteredby ?>" onchange="fnupdatetaksinfo(this.value,'<?= $taskId ?>','task_entered_by')"></td>

						<td>
							<a onclick="fndeltasks('<?= $taskId ?>','<?= $taskinvId ?>')" class="btn btn-xs btn-danger "><i class="fa fa-minus"></i></a>
						</td>

					</tr>
			<?php }
			} ?>

			<tr class="tr_clone">
				<td>
					<input type="text" name="task_strtdate" id="task_strtdate" class="form-control taskstrtdate w95" value="">
					<input type="hidden" name="hdntskinvd" class="hdntskinvd" value="<?= $_POST['invoiceid'] ?>">
				</td>

				<td>
					<select class="form-control tasksname" name="task_name" id="task_name" style="width: 100px;">
						<option value="">Choose </option>
						<?php
						$invtasktype = $this->db->query("SELECT * FROM invoice_task");
						foreach ($invtasktype->result() as $invtasktype_dtls) {
						?>
							<option value="<?= $invtasktype_dtls->task_type ?>"><?= $invtasktype_dtls->task_type ?></option>
						<?php
						}
						?>
					</select>
				</td>

				<td>

					<select class="form-control" name="task_user" id="task_user" style="width: 130px;" disabled>
						<option value="">Choose </option>
						<?php
						$admloguser = $this->db->query("SELECT * FROM users");
						foreach ($admloguser->result() as $admloguser_dtls) {
							if ($this->session->userdata['fi_session']['id'] == $admloguser_dtls->id) {
								$seluser = "selected";
							} else {
								$seluser = "";
							}

						?>
							<option <?= $seluser ?> value="<?= $admloguser_dtls->id ?>"><?= $admloguser_dtls->name ?></option>
						<?php
						}
						?>
					</select>

				</td>

				<td><input type="text" name="task_due_date" id="task_due_date" class="form-control taskduedatlast w95" value=""></td>

				<td>
					<div class="checkbox">
						<label>

							<input type="checkbox" value="" name="task_completed" id="task_completed" class="taskcompleted"></label>
					</div>
				</td>

				<td>
					<input type="text" name="task_completed_by" id="task_completed_by" class="form-control taskcompletedby updwn" value="">
				</td>

				<td><input type="date" name="task_completed_date" id="task_completed_date" class="form-control taskcompleteddate text-center" value=""></td>

				<td><input type="text" name="task_note" id="task_note" class="form-control tasknote updwn" value=""></td>

				<td><input type="text" name="task_enter_by" id="task_enter_by" class="form-control taskenterby updwn" value=""></td>

				<td>
					<a onclick="fncrtasks('<?= $invoiceid ?>')" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></a>
				</td>

			</tr>
			<?php
		} else {
			//echo "error";
		}
	}

	public function search_cust_mainsearch_dtls($fname, $lname, $cname, $zname, $mname, $adr1, $adr2, $cities, $states, $area, $phone)
	{
		error_reporting(0);

		//$srchcustjson=array();

		$con1 = "";
		if ($fname != "") {
			//$con1='o.cus_fname ="'.$fname.'"';
			//$con1='o.cus_fname LIKE "%'.$fname.'%"';
			$con1 = 'o.cus_fname LIKE "' . $fname . '%"';
		}

		if ($lname != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_lname = "'.$lname.'"';
				$con1 = $con1 . " OR " . 'o.cus_lname LIKE "%' . $lname . '%"';
			} else {
				//$con1='o.cus_lname = "'.$lname.'"';
				//$con1='o.cus_lname LIKE "%'.$lname.'%"';
				$con1 = 'o.cus_lname LIKE "' . $lname . '%"';
			}
		}

		if ($cname != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_company_name = "'.$cname.'"';
				$con1 = $con1 . " OR " . 'o.cus_company_name LIKE "%' . $cname . '%"';
			} else {
				//$con1='o.cus_company_name = "'.$cname.'"';
				$con1 = 'o.cus_company_name LIKE "%' . $cname . '%"';
			}
		}

		if ($zname != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_zip = "'.$zname.'"';
				$con1 = $con1 . " OR " . 'o.cus_zip LIKE "%' . $zname . '%"';
			} else {
				//$con1='o.cus_zip = "'.$zname.'"';
				$con1 = 'o.cus_zip LIKE "%' . $zname . '%"';
			}
		}

		if ($mname != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'c.contact_no ="'.$mname.'"';
				$con1 = $con1 . " OR " . 'c.contact_no LIKE "%' . $mname . '%"';
			} else {
				//$con1='c.contact_no ="'.$mname.'"';
				$con1 = 'c.contact_no LIKE "%' . $mname . '%"';
			}
		}

		if ($adr1 != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_address1 ="'.$adr1.'"';
				$con1 = $con1 . " OR " . 'o.cus_address1 LIKE "%' . $adr1 . '%"';
			} else {
				//$con1='o.cus_address1 ="'.$adr1.'"';
				$con1 = 'o.cus_address1 LIKE "%' . $adr1 . '%"';
			}
		}

		if ($adr2 != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_address2 ="'.$adr2.'"';
				$con1 = $con1 . " OR " . 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			} else {
				//$con1='o.cus_address2 ="'.$adr2.'"';
				$con1 = 'o.cus_address2 LIKE "%' . $adr2 . '%"';
			}
		}

		if ($cities != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_city ="'.$cities.'"';
				$con1 = $con1 . " OR " . 'o.cus_city LIKE "%' . $cities . '%"';
			} else {
				//$con1='o.cus_city ="'.$cities.'"';
				$con1 = 'o.cus_city LIKE "%' . $cities . '%"';
			}
		}

		if ($states != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_state ="'.$states.'"';
				$con1 = $con1 . " OR " . 'o.cus_state LIKE "%' . $states . '%"';
			} else {
				//$con1='o.cus_state ="'.$states.'"';
				$con1 = 'o.cus_state LIKE "%' . $states . '%"';
			}
		}

		if ($area != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
				$con1 = $con1 . " OR " . 'o.cus_area LIKE "%' . $area . '%"';
			} else {
				//$con1='o.cus_area ="'.$area.'"';
				$con1 = 'o.cus_area LIKE "%' . $area . '%"';
			}
		}

		if ($phone != "") {
			if ($con1 != "") {
				//$con1= $con1 ." OR ".'o.cus_area ="'.$area.'"';
				$con1 = $con1 . " OR " . 'c.contact_no LIKE "%' . $phone . '%"';
				//$con1='c.contact_no LIKE "%'.$phone.'%"';
			} else {
				//$con1='o.cus_area ="'.$area.'"';
				$con1 = 'c.contact_no LIKE "%' . $phone . '%"';
			}
		}


		//echo "SELECT * from user_contact_info AS c,register_customer AS o WHERE ".$con1." AND c.cus_id = o.cus_id  GROUP BY o.cus_id ORDER BY o.cus_lname, o.cus_fname";

		$cust1 = $this->db->query("SELECT * from user_contact_info AS c,register_customer AS o WHERE " . $con1 . " AND c.cus_id = o.cus_id  GROUP BY o.cus_id ORDER BY o.cus_lname, o.cus_fname");
		//echo"num_rows==". $cust1->num_rows();
		if ($cust1->num_rows() > 0) {
			$srno = 1;

			foreach ($cust1->result() as $cust1_dtls) {


				$phonarr = array();
				$notesarr = array();
				$cntinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '" . $cust1_dtls->cus_id . "'");
				foreach ($cntinfosql->result() as $cntinfosql) {
					$phonarr[] .= $cntinfosql->contact_no;
					$notesarr[] .= $cntinfosql->user_contact_note;
				}

				$setnotes = implode(",", $notesarr);

				/* if(count($setnotes)==1){
            $htmlnotes=$setnotes;
         }else{
            $htmlnotes=explode(",",$setnotes);
         }*/

				$setphones = implode(",", $phonarr);

				/* if(count($setphones)==1){
            $htmlphone=$setphones;
         }else{
            $htmlphone=explode(",",$setphones);
         } */

				$cntctinfosql = $this->db->query("SELECT * from user_contact_info WHERE cus_id = '$cust1_dtls->cus_id' AND conatct_type!='Email' AND default_contact=1");
				$cntctinfosql_row = $cntctinfosql->row();
				$htmlphone = $cntctinfosql_row->contact_no;
				$htmlnotes = $cntctinfosql_row->user_contact_note;


				//search_customer_opt
				$act_custsql = $this->db->query("SELECT * FROM search_customer_opt");
				$act_custrow = $act_custsql->row();

				$getfname = $act_custrow->cus_fname;
				$getlname = $act_custrow->cus_lname;
				$getcname = $act_custrow->cus_company_name;
				$getaddr1 = $act_custrow->cus_address1;
				$getaddr2 = $act_custrow->cus_address2;
				$getcity = $act_custrow->cus_city;
				$getstate = $act_custrow->cus_state;
				$getzip = $act_custrow->cus_zip;
				$getarea = $act_custrow->cus_area;
				$getphno = $act_custrow->phone_no;


				if ($getfname == 1) {
					$fnmamechksts = "display: table-cell;";
				} else {
					$fnmamechksts = "display:none;";
				}

				if ($getlname == 1) {
					$lnmamechksts = "display: table-cell;";
				} else {
					$lnmamechksts = "display:none;";
				}


				if ($getcname == 1) {
					$cnmamechksts = "display: table-cell;";
				} else {
					$cnmamechksts = "display:none;";
				}


				if ($getaddr1 == 1) {
					$addr1chksts = "display: table-cell;";
				} else {
					$addr1chksts = "display:none;";
				}

				if ($getaddr2 == 1) {
					$addr2chksts = "display: table-cell;";
				} else {
					$addr2chksts = "display:none;";
				}

				if ($getcity == 1) {
					$citychksts = "display: table-cell;";
				} else {
					$citychksts = "display:none;";
				}

				if ($getstate == 1) {
					$statechksts = "display: table-cell;";
				} else {
					$statechksts = "display:none;";
				}

				if ($getzip == 1) {
					$zipchksts = "display: table-cell;";
				} else {
					$zipchksts = "display:none;";
				}

				if ($getarea == 1) {
					$areachksts = "display: table-cell;";
				} else {
					$areachksts = "display:none;";
				}

				if ($getphno == 1) {
					$phnochksts = "display: table-cell;";
				} else {
					$phnochksts = "display:none;";
				}



			?>

				<tr ondblclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')">
					<td>
						<a onclick="fnviewcustomer('<?= $cust1_dtls->cus_id ?>')" style="cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" style="width: 30px;"></i></a>
					</td>

					<td><?= $srno ?></td>

					<td><?= $cust1_dtls->cus_title ?></td>

					<td style="text-transform:capitalize; <?= $fnmamechksts ?>"><?= $cust1_dtls->cus_fname ?></td>

					<td style="text-transform:capitalize; <?= $lnmamechksts ?>"><?= $cust1_dtls->cus_lname ?></td>

					<td style="<?= $cnmamechksts ?>"><?= $cust1_dtls->cus_company_name ?></td>

					<td style="<?= $addr1chksts ?>"><?= $cust1_dtls->cus_address1 ?></td>
					<td style="<?= $addr2chksts ?>"><?= $cust1_dtls->cus_address2 ?></td>
					<td style="<?= $citychksts ?>"><?= $cust1_dtls->cus_city ?></td>
					<td style="<?= $statechksts ?>"><?= $cust1_dtls->cus_state ?></td>
					<td style="<?= $zipchksts ?>"><?= $cust1_dtls->cus_zip ?></td>
					<td style="<?= $areachksts ?>"><?= $cust1_dtls->cus_area ?></td>
					<td style="<?= $phnochksts ?>"><?= trim($htmlphone, ",") ?></td>
					<td><?= trim($htmlnotes, ",") ?></td>

				</tr>


			<?php $srno++;
			}
		} else {

			echo "No Customers Found..!";
		}
	}

	function fnupdatejobinfo_dtls()
	{
		$feildname = $this->input->post('fieldnm');

		//echo "SELECT * FROM event_jobs WHERE jb_id='".$_POST['jobId']."'";

		$seljobinfo = $this->db->query("SELECT * FROM event_jobs WHERE jb_id='" . $_POST['jobId'] . "'");
		$seljobinforow = $seljobinfo->row();

		$jbnm = $seljobinforow->jb_name;

		if ($jbnm != "") {
			$newjbname = $jbnm;
		} else {
			$newjbname = trim($this->input->post('evnt_name'));
		}

		if ($feildname == "jb_type") {

			$updatejobarr = array(
				$feildname  => $this->input->post('txtinptval'),
				"jb_name"  => $newjbname
			);

			$this->db->where('jb_id', $this->input->post('jobId'));
			if ($this->db->update('event_jobs', $updatejobarr)) {
				//echo "success";
				echo "<input type='hidden' id='success' value='success'>";
				echo "<input type='hidden' id='hdndbjobname' value='" . $newjbname . "'>";
			} else {
				//echo "error";
				echo "<input type='hidden' id='error' value='error'>";
			}
		} else {

			$updatejobarr = array(
				$feildname  => $this->input->post('txtinptval')
			);
			$this->db->where('jb_id', $this->input->post('jobId'));
			if ($this->db->update('event_jobs', $updatejobarr)) {
				echo "success";
			} else {
				echo "error";
			}
		}
	}

	function fncrtevntjobinfo_dtls()
	{
		$insertnwjobarr = array(

			"event_id"  => $this->input->post('eventId')
		);
		if ($this->db->insert('event_jobs', $insertnwjobarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fncrtnewjobdtinfo_dtls()
	{
		$insertnwjobdtarr = array(
			"job_id" => $this->input->post('jobId'),
			"event_id"  => $this->input->post('eventId')
		);
		if ($this->db->insert('event_jobs_dtls', $insertnwjobdtarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}



	function fncheckispackage_dtls()
	{
		$ispckgsql = $this->db->query("SELECT * FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "'");
		$pcknrows = $ispckgsql->num_rows();
		if ($pcknrows > 0) {
			echo "success";
		} else {
			echo "error";
		}
	}


	function fnupdatepckginfo_dtls()
	{

		error_reporting(0);

		$getpostpckg = $this->db->query("SELECT * FROM admin_package WHERE package_id = '" . $_POST['pckId'] . "'");
		$getadmpckrow = $getpostpckg->row();

		$pckarr = array(
			"cus_id" => $_POST['custid'],
			"inv_id" => $_POST['invId'],
			"package_id" => $_POST['pckId'],
			"package_name" => $getadmpckrow->package_name,
			"package_price" => $getadmpckrow->package_price,
			"package_taxable" => $getadmpckrow->package_taxable
		);

		$this->db->where('id', $_POST['assignpckId']);
		$this->db->update('customer_assigned_packages', $pckarr);
		$linsertId = $_POST['assignpckId'];  //$this->db->insert_id();



		$this->db->where('assigned_pckid', $linsertId);
		if ($this->db->delete('customers_package_items')) {

			$getpostpckgitms = $this->db->query("SELECT * FROM admin_package_item WHERE package_id = '" . $_POST['pckId'] . "'");

			foreach ($getpostpckgitms->result() as $getpostpckgitms_dtls) {
				$itemsarr = array(
					"cus_id" => $_POST['custid'],
					"inv_id" => $_POST['invId'],
					"package_id" => $_POST['pckId'],
					"item_name" => $getpostpckgitms_dtls->item_name,
					"item_quantity" => $getpostpckgitms_dtls->item_quantity,
					"item_price" => $getpostpckgitms_dtls->item_price,
					"item_desc" => $getpostpckgitms_dtls->item_desc,
					"assigned_pckid" => $linsertId
				);

				$this->db->insert('customers_package_items', $itemsarr);
			}
		}


		$grndtotpcksql = $this->db->query("SELECT inv_id, SUM(package_price) AS package_price FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "' ORDER BY id ASC");

		$grndtotpcksql_row = $grndtotpcksql->row();

		$pckagesgrandtotal = $grndtotpcksql_row->package_price;

		//echo "pckagesgrandtotal--"+$pckagesgrandtotal;

		$pckitmsql = $this->db->query("SELECT i.id,i.item_name,i.item_quantity,i.item_price,i.item_desc,p.package_price FROM customers_package_items AS i,customer_assigned_packages AS p WHERE i.package_id=p.package_id AND i.package_id='" . $_POST['pckId'] . "' AND p.package_id='" . $_POST['pckId'] . "' ORDER BY id ASC");


		$chkitmsql = $this->db->query("SELECT * FROM customers_package_items WHERE package_id='" . $_POST['pckId'] . "' ORDER BY id DESC LIMIT 1");

		$isitmsrow = $chkitmsql->row();

		if ($pckitmsql->num_rows() > 0) {

			$srno = 1;
			foreach ($pckitmsql->result() as $pckitmsql_dtls) {
				//$pckitemjson['pckitemlist'][]=$pckitmsql_dtls;

				$itmId = $pckitmsql_dtls->id;

				if ($isitmsrow->id == $itmId) {
					$lstinvoiceid = "fa-plus";
					$lstinvoicecls = "btn-success";
					$fninvoce = "fncrpitem('" . $pckitmsql_dtls->id . "')";
				} else {

					$lstinvoiceid = "fa-minus";
					$lstinvoicecls = "btn-danger";
					$fninvoce = "fndelpitem('" . $pckitmsql_dtls->id . "')";
				}
				//fnupdateitmsinfo
			?>

				<tr class="tr_clone auto-index 2">
					<td class="increment"><?= $srno ?></td>
					<td><input type="number" name="item_quantity<?= $itmId ?>" id="i1<?= $itmId ?>" min="1" class="form-control" value="<?= $pckitmsql_dtls->item_quantity ?>" style="width: 40px;" disabled></td>
					<td>
						<select class="form-control 6" name="item_name<?= $itmId ?>" id="i2<?= $itmId ?>" style="width: 80px;" onchange="fnadmpckinfo(this.value,'<?= $itmId ?>')">
							<option value="">Choose</option>

							<?php

							$admitmsql = $this->db->query("SELECT * FROM admin_item ORDER BY item_id ASC");

							foreach ($admitmsql->result() as $admitmsql_dtls) {
								if ($admitmsql_dtls->item_id == $pckitmsql_dtls->item_name) {

									$selectitmtyp = "selected";
								} else {

									$selectitmtyp = "";
								}

							?>
								<option <?= $selectitmtyp ?> value="<?= $admitmsql_dtls->item_id ?>"><?= $admitmsql_dtls->item_name ?></option>

							<?php } ?>

					</td>
					<td><input type="text" onchange="fnupdateitemdescp(this.value,'<?= $itmId ?>')" name="item_desc<?= $itmId ?>" id="i3<?= $itmId ?>" class="form-control 6" value="<?= $pckitmsql_dtls->item_desc ?>" style="width: 400px;">
					</td>
					<td>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-usd"></span></span>
								<input type="text" onchange="fnupdateitemamountp(this.value,'<?= $itmId ?>')" name="item_amount<?= $itmId ?>" id="i4<?= $itmId ?>" class="form-control 5" style="width: 80px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_price) ?>">
							</div>
						</div>
					</td>
					<td>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-usd"></span></span>
								<input type="text" disabled name="item_total<?= $itmId ?>" id="i5<?= $itmId ?>" class="form-control" style="width: 80px;" value="<?= sprintf('%0.2f', $pckitmsql_dtls->item_quantity * $pckitmsql_dtls->item_price) ?>">
							</div>
						</div>
					</td>
					<td>
						<input type="checkbox" disabled value="1" id="iteam_taxable<?= $itmId ?>" name="iteam_taxable<?= $itmId ?>">
					</td>
					<td>
						<button onclick="<?= $fninvoce ?>" class="btn btn-xs <?= $lstinvoicecls ?> tr_clone_add"><i class="fa <?= $lstinvoiceid ?>"></i></button>
					</td>
					<td>
						<input type="hidden" class="4" name="pcktot" id="pcktot" value="<?= sprintf('%0.2f', $pckitmsql_dtls->package_price) ?>">
						<input type="hidden" name="pckgrndtot" id="pckgrndtot" value="<?= sprintf('%0.2f', $pckagesgrandtotal) ?>">
					</td>
				</tr>

			<?php $srno++;
			}
		}
	}


	function fninsertjobinfo_dtls()
	{
		$feildname = $this->input->post('fieldnm');

		$insertjobarr = array(

			"jb_type"  => $this->input->post('lstjid2'),
			"jb_name"  => trim($this->input->post('evnt_name')),
			"event_id"  => trim($this->input->post('hidevntid'))
		);

		if ($this->db->insert('event_jobs', $insertjobarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fninsertjobinfonote_dtls()
	{
		$feildname = $this->input->post('fieldnm');

		$insertjobarr = array(

			"jb_type"  => $this->input->post('lstjid2'),
			"jb_notes"  => trim($this->input->post('evnt_name')),
			"event_id"  => trim($this->input->post('hidevntid'))
		);

		if ($this->db->insert('event_jobs', $insertjobarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fninsertjobtypdtls_dtls()
	{
		$insertjobtypdtlsarr = array(

			"job_id"  => $this->input->post('hdnjobId'),
			"event_id"  => trim($this->input->post('hidevntid')),
			"jobs_type"  => trim($this->input->post('jbdttyp')),
			"jobs_start_time" => $this->input->post('jbstarttime')
		);

		if ($this->db->insert('event_jobs_dtls', $insertjobtypdtlsarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function delselconracttype_dtls()
	{
		$this->db->where('sub_id', $this->input->post('pckId'));
		if ($this->db->delete('sub_categories')) {

			$this->db->where('subcat_id', $this->input->post('pckId'));
			$this->db->delete('adm_terms');

			echo "success";
		} else {
			echo "error";
		}
	}

	function isChkExistContract($pckname)
	{

		$chkpcksql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $pckname . "'");
		$chkpcksql_nrow = $chkpcksql->num_rows();
		if ($chkpcksql_nrow > 0) {
			return "IsExists";
		} else {
			return "Not Exists";
		}
	}

	public function insertterms($item1)
	{
		$query = $this->db->insert('adm_terms', $item1);
		return $this->db->insert_id();
	}



	function crnewpterms_dtls()
	{
		$postitemsarr = array(
			"subcat_id" => $_POST['pckId'],
		);
		if ($this->db->insert('adm_terms', $postitemsarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}


	function delnewpterms_dtls()
	{
		$this->db->where('id', $_POST['itmId']);
		$this->db->where('subcat_id', $_POST['pckId']);
		if ($this->db->delete('adm_terms')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fninseartrmsinfo_dtls()
	{

		$feildname = $this->input->post('fieldnm');
		$updatetrmarr = array(

			$feildname  => $this->input->post('inptxtval'),
			"subcat_id"  => $this->input->post('trmId'),
		);

		if ($feildname == "name") {
			if ($this->input->post('inptxtval') == "Event Date") {
				$updatetrmarr['amount'] = "Remaining Balance";
			} else if ($this->input->post('inptxtval') == "Date") {
				$updatetrmarr['amount'] = "Date";
			} else if ($this->input->post('inptxtval') == "Installment Date Amount") {
				$updatetrmarr['amount'] = "Installment Date Amount";
			}
		}

		if ($this->db->insert('adm_terms', $updatetrmarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}
	function fnupdtrmsinfo_dtls()
	{

		$feildname = $this->input->post('fieldnm');
		$updatetrmarr = array(
			$feildname  => $this->input->post('inptxtval')
		);

		if ($feildname == "name") {
			if ($this->input->post('inptxtval') == "Event Date") {
				$updatetrmarr['amount'] = "Remaining Balance";
			} else if ($this->input->post('inptxtval') == "Date") {
				$updatetrmarr['amount'] = "Date";
			}
		}

		$this->db->where('id', $this->input->post('trmId'));
		if ($this->db->update('adm_terms', $updatetrmarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function geteventinfojson_dtls()
	{

		$chklocsql = $this->db->query("SELECT * FROM event_location WHERE event_id='" . $_POST['hidevntid'] . "'");
		if ($chklocsql->num_rows() > 0) {
			$eventjson = array();
			$eventsql = $this->db->query("SELECT r.cus_id,r.cus_fname,r.cus_lname,r.cus_company_name,r.cus_address1,r.cus_address2,r.cus_city,r.cus_state,r.cus_zip,s.ship_address1,s.ship_address2,s.ship_city,s.ship_state,s.ship_zip,s.ship_cusname,s.ship_user_id,e.event_id,e.event_type,e.event_name,e.event_date,e.event_end_date,e.event_hebrew_date,e.event_referred_by,l.location_type,l.event_id FROM register_customer As r, ship_address AS s, events_register AS e, event_location AS l  WHERE r.cus_id=s.ship_user_id AND r.cus_id='" . $_POST['userId'] . "' AND s.ship_user_id='" . $_POST['userId'] . "' AND e.cus_id='" . $_POST['userId'] . "' AND e.event_id='" . $_POST['hidevntid'] . "' AND l.event_id='" . $_POST['hidevntid'] . "'");
			foreach ($eventsql->result() as $eventsql_dtls) {
				$eventjson["eventinfo"][] = $eventsql_dtls;
			}
			echo json_encode($eventjson);
		} else {
			$eventjson = array();
			$eventsql = $this->db->query("SELECT r.cus_id,r.cus_fname,r.cus_lname,r.cus_company_name,r.cus_address1,r.cus_address2,r.cus_city,r.cus_state,r.cus_zip,s.ship_address1,s.ship_address2,s.ship_city,s.ship_state,s.ship_zip,s.ship_cusname,s.ship_user_id,e.event_id,e.event_type,e.event_name,e.event_date,e.event_end_date,e.event_hebrew_date,e.event_referred_by FROM register_customer As r, ship_address AS s, events_register AS e WHERE r.cus_id=s.ship_user_id AND r.cus_id='" . $_POST['userId'] . "' AND s.ship_user_id='" . $_POST['userId'] . "' AND e.cus_id='" . $_POST['userId'] . "' AND e.event_id='" . $_POST['hidevntid'] . "'");

			foreach ($eventsql->result() as $eventsql_dtls) {
				$eventjson["eventinfo"][] = $eventsql_dtls;
			}
			echo json_encode($eventjson);
		}
	}


	function chkpostdata_dtls()
	{
		echo "Input Date===" . $this->input->post('txtdate') . "</br>";
		$dtarr = array(
			"date" => $this->input->post('txtdate'),
			"ip_address" => $_SERVER['REMOTE_ADDR']
		);
		if ($this->db->insert('tbl_testdate', $dtarr)) {
			$lid = $this->db->insert_id();
			$testdatesql = $this->db->query("SELECT * FROM tbl_testdate WHERE id='" . $lid . "'");
			$testdatesqlrow = $testdatesql->row();

			echo "Database Inserted Date===" . $testdatesqlrow->date . "</br>";
			// echo "Fieldset Date===".$testdatesqlrow->date;


		}
	}



	function updtatsksinfo_dtls()
	{
		$updtskarr = array(

			"name"  => $this->input->post('taskname')
		);
		$this->db->where('id', $this->input->post('hdntaskid'));
		if ($this->db->update('adm_task_type', $updtskarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function deltasksinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_task_type')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updtatskscolorinfo_dtls()
	{
		$chkistaskclr = $this->db->query("SELECT * FROM adm_task_status WHERE color='" . $_POST['taskcolor'] . "'");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_task_type WHERE color='" . $_POST['taskcolor'] . "'");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {

				$updtskarr = array(

					"color"  => $this->input->post('taskcolor')
				);
				$this->db->where('id', $this->input->post('hdntaskid'));
				if ($this->db->update('adm_task_type', $updtskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}

	function fndelsubtasksinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_subtask_type')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function insertsubtsksinfo_dtls()
	{
		$insersubtskarr = array(

			"name"  => $this->input->post('subtaskname'),
			"due_date"  => $this->input->post('subduedt'),
			"task_id"  => $this->input->post('taskId')
		);
		if ($this->db->insert('adm_subtask_type', $insersubtskarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fnupdtesubtasksinfo_dtls()
	{

		$feildname = $this->input->post('fieldnm');
		$updatesubtskarr = array(

			$feildname  => $this->input->post('inptxtval')
		);
		$this->db->where('id', $this->input->post('substkid'));
		if ($this->db->update('adm_subtask_type', $updatesubtskarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function loadsubtaskslist_dtls()
	{
		// $update_query="UPDATE invoice_task SET task_completed="",task_completed_by="" WHERE task_id='".$_POST['hdntskid']."' ";

		$updatetask = array(
			"task_completed"  => "",
			"task_completed_by"  => ""
		);
		$this->db->where('task_id', $_POST['hdntskid']);
		$this->db->update('invoice_task', $updatetask);

		$subtaskarr = array();
		$subtsksql = $this->db->query("SELECT * FROM adm_subtask_type WHERE task_id='" . $_POST['taskId'] . "' ORDER BY id ASC");
		foreach ($subtsksql->result() as $subtsksqldtls) {
			$subtaskarr['subtasklist'][] = $subtsksqldtls;
		}
		echo json_encode($subtaskarr);
	}





	function updtodostatusinfo_dtls()
	{
		$updtskarr = array(

			"name"  => $this->input->post('taskname')
		);
		$this->db->where('id', $this->input->post('hdntaskid'));
		if ($this->db->update('adm_todo_status', $updtskarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function deltaskstatusinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_task_status')) {
			echo "success";
		} else {
			echo "error";
		}
	}
	function deltodostatusinfo_dtls()
	{
		$this->db->where('id', $this->input->post('delId'));
		if ($this->db->delete('adm_todo_status')) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function updtatskstatuscolorinfo_dtls()
	{

		$chkistaskclr = $this->db->query("SELECT * FROM adm_task_type WHERE color='" . $_POST['taskcolor'] . "'");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_task_status WHERE color='" . $_POST['taskcolor'] . "'");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {

				$updtskarr = array(

					"color"  => $this->input->post('taskcolor')
				);
				$this->db->where('id', $this->input->post('hdntaskid'));
				if ($this->db->update('adm_task_status', $updtskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}
	function updtodostatuscolorinfo_dtls()
	{

		$chkistaskclr = $this->db->query("SELECT * FROM adm_todo_status WHERE color='" . $_POST['taskcolor'] . "'");
		$chkntskrows = $chkistaskclr->num_rows();
		if ($chkntskrows > 0) {
			echo "isexists";
		} else {

			$chkistaskstsclr = $this->db->query("SELECT * FROM adm_todo_status WHERE color='" . $_POST['taskcolor'] . "'");
			$chkntskstsrows = $chkistaskstsclr->num_rows();
			if ($chkntskstsrows > 0) {
				echo "isexists";
			} else {

				$updtskarr = array(

					"color"  => $this->input->post('taskcolor')
				);
				$this->db->where('id', $this->input->post('hdntaskid'));
				if ($this->db->update('adm_todo_status', $updtskarr)) {
					echo "success";
				} else {
					echo "error";
				}
			}
		}
	}


	function insrtinvtaskinfo_dtls()
	{
		$getsubtsksql = $this->db->query("SELECT * FROM adm_subtask_type WHERE id='" . $_POST['subtaskId'] . "' ORDER BY id ASC");
		$getsubtsksqlrow = $getsubtsksql->row();
		$subtskduedt = $getsubtsksqlrow->due_date;

		$pduedt = $this->input->post('taskdate');
		if ($pduedt != "") {
			$setduedt = date('Y-m-d', strtotime($pduedt . '+' . $subtskduedt . ' days'));
		} else {
			$setduedt = "";
		}


		$tskarr = array(
			"invoice_id" => $this->input->post('invoiceid'),
			"task_date_started" => date("Y-m-d", strtotime($this->input->post('taskdate'))),
			"task_type" => $this->input->post('taskId'),
			"sub_task_type" => $this->input->post('subtaskId'),
			"task_due_date" => $setduedt,
			"task_entered_by" => $this->session->userdata['fi_session']['id']
		);
		if ($this->db->insert('invoice_task', $tskarr)) {
			$bcktskarr = array(
				"task_id" => $this->db->insert_id(),
				"invoice_id" => $this->input->post('invoiceid'),
				"task_date_started" => date("Y-m-d", strtotime($this->input->post('taskdate'))),
				"task_type" => $this->input->post('taskId'),
				"sub_task_type" => $this->input->post('subtaskId'),
				"task_due_date" => $setduedt,
				"task_entered_by" => $this->session->userdata['fi_session']['id']
			);
			$this->db->insert('invoice_task_bckup', $bcktskarr);

			echo "success";
		} else {
			echo "error";
		}
	}




	function updtinvtaskinfo_dtls()
	{
		$getsubtsksql = $this->db->query("SELECT * FROM adm_subtask_type WHERE id='" . $_POST['subtaskId'] . "' ORDER BY id ASC");
		$getsubtsksqlrow = $getsubtsksql->row();
		$subtskduedt = $getsubtsksqlrow->due_date;

		$pduedt = $this->input->post('taskdate');
		if ($pduedt != "") {
			$setduedt = date('Y-m-d', strtotime($pduedt . '+' . $subtskduedt . ' days'));
		} else {
			$setduedt = "";
		}


		$updttskarr = array(
			"invoice_id" => $this->input->post('invoiceid'),
			"task_date_started" => date("Y-m-d", strtotime($this->input->post('taskdate'))),
			"task_type" => $this->input->post('taskId'),
			"sub_task_type" => $this->input->post('subtaskId'),
			"task_completed" => "",
			"task_completed_by" => "",
			"task_due_date" => ($setduedt != "" && $setduedt != "01/01/1970") ? date("Y-m-d", strtotime($setduedt)) : ""
		);
		$this->db->where('task_id', $_POST['hdntskid']);
		if ($this->db->update('invoice_task', $updttskarr)) {

			$bcktskarr = array(
				"task_id" => $_POST['hdntskid'],
				"invoice_id" => $this->input->post('invoiceid'),
				"task_date_started" => date("Y-m-d", strtotime($this->input->post('taskdate'))),
				"task_type" => $this->input->post('taskId'),
				"sub_task_type" => $this->input->post('subtaskId'),
				"task_due_date" => ($setduedt != "" && $setduedt != "01/01/1970") ? date("Y-m-d", strtotime($setduedt)) : "",
				"task_user" => $this->input->post('user'),
				"task_completed" => $this->input->post('tasksts'),
				"task_completed_by" => $this->input->post('taskcompletdby'),
				"task_completed_date" => date("Y-m-d", strtotime($this->input->post('taskcompletdt'))),
				"task_entered_by" => $this->session->userdata['fi_session']['id']
			);
			$this->db->insert('invoice_task_bckup', $bcktskarr);

			echo "success";
		} else {
			echo "error";
		}
	}


	function updtinvstrtdtaskinfo_dtls()
	{
		$getsubtsksql = $this->db->query("SELECT * FROM adm_subtask_type WHERE id='" . $_POST['subtaskId'] . "' ORDER BY id ASC");
		$getsubtsksqlrow = $getsubtsksql->row();
		$subtskduedt = $getsubtsksqlrow->due_date;

		$pduedt = $this->input->post('taskdate');
		if ($pduedt != "") {
			$setduedt = date('Y-m-d', strtotime($pduedt . '+' . $subtskduedt . ' days'));
		} else {
			$setduedt = "";
		}


		$updttskarr = array(
			"invoice_id" => $this->input->post('invoiceid'),
			"task_date_started" => $this->input->post('taskdate'),
			"task_type" => $this->input->post('taskId'),
			"sub_task_type" => $this->input->post('subtaskId'),
			"task_due_date" => $setduedt
		);
		$this->db->where('task_id', $_POST['hdntskid']);
		if ($this->db->update('invoice_task', $updttskarr)) {


			$bcktskarr = array(
				"task_id" => $_POST['hdntskid'],
				"invoice_id" => $this->input->post('invoiceid'),
				"task_date_started" => $this->input->post('taskdate'),
				"task_type" => $this->input->post('taskId'),
				"sub_task_type" => $this->input->post('subtaskId'),
				"task_due_date" => $setduedt,
				"task_user" => $this->input->post('user'),
				"task_completed" => $this->input->post('tasksts'),
				"task_completed_by" => $this->input->post('taskcompletdby'),
				"task_completed_date" => $this->input->post('taskcompletdt'),
				"task_entered_by" => $this->session->userdata['fi_session']['id']
			);
			$this->db->insert('invoice_task_bckup', $bcktskarr);

			echo "success";
		} else {
			echo "error";
		}
	}




	function fnupdateinvtermsinfo_dtls()
	{
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->delete('tbl_invoice_terms')) {
			$admtrmssql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $_POST['cntrctype'] . "'");
			foreach ($admtrmssql->result() as $admtrmssql_info) {

				$trmarr = array(
					"name" => $admtrmssql_info->name,
					"amount" => ($admtrmssql_info->name == "Date") ? "" : $admtrmssql_info->amount,
					"invoice_id" => $this->input->post('invoiceid'),
					"subcat_id" => $this->input->post('cntrctype')
				);
				$this->db->insert('tbl_invoice_terms', $trmarr);
			}
			//echo "success";

			//echo "SELECT * FROM invoices_create WHERE invoice_id='".$_POST['invoiceid']."'";

			// Fetch event date from invoice
			$event_detail = $this->db->query("SELECT event_date FROM events_register WHERE inv_id='" . $_POST['invoiceid'] . "'")->row_array();



			$terminvsql = $this->db->query("SELECT * FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'");
			$terminvsql_row = $terminvsql->row();
			//$trminvsubtot=$terminvsql_row->invoice_sub_total;
			$trminvsubtot = $terminvsql_row->invoice_amount;

			$terminvstotal_sql = $this->db->query("SELECT SUM(amount) AS amount FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' AND name!='Date' AND name!='Event Date'");
			$terminvstotalsql_row = $terminvstotal_sql->row();
			$trminvtotamount = $terminvstotalsql_row->amount;

			if ($trminvsubtot > $trminvtotamount) {
				$trmsum = $trminvsubtot - $trminvtotamount;
			} else {
				$trmsum = "0";
			}



			?>
			<!--<tr class="tr_clone">-->

			<!--    <td>-->

			<!--       <select class="form-control txtcntrcttype updwn" name="txtcntrcttype" id="txtcntrcttype" disabled>-->
			<!--         <option>EventDate </option>-->
			<!--       </select>-->


			<!--     </td>-->

			<!--    <td>-->
			<!--       <input type="text" class="form-control rminbalamt updwn" name="rminbalamt" id="rminbalamt" value="Remaining Balance" disabled>-->
			<!--     </td>-->

			<!--     <td>-->
			<!--         <input type="text" class="form-control updwn" value="<?= $trmsum ?>" disabled>-->
			<!--    </td>-->
			<!--</tr>-->
			<?php



			$invotermsql = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY id ASC");
			$chkinvtrmsql = $this->db->query("SELECT * FROM tbl_invoice_terms WHERE invoice_id='" . $_POST['invoiceid'] . "' ORDER BY id DESC LIMIT 1");
			$isinvtermsrow = $chkinvtrmsql->row();
			// echo "===".$isinvtermsrow->id."</br>";

			foreach ($invotermsql->result() as $invotermsql_dtls) {

				$invtrmsId = $invotermsql_dtls->id;




				if ($isinvtermsrow->id == $invtrmsId) {
					$lstinvtrmid = "fa-plus";
					$lstinvtrmcls = "btn-success";
					$fninvterms = "fncrterms('" . $invtrmsId . "','" . $_POST['invoiceid'] . "')";
				} else {

					$lstinvtrmid = "fa-minus";
					$lstinvtrmcls = "btn-danger";
					$fninvterms = "fndelterms('" . $invtrmsId . "','" . $_POST['invoiceid'] . "')";
				}


				if ($invotermsql_dtls->totsts == 1) {
					if ($isinvtermsrow->id == $invtrmsId) {
						$setamount = $trmsum;
						$disp = "display:block;";
						$rdonly = "disabled";
					} else {
						$setamount = $trmsum;
						$disp = "display:none;";
						$rdonly = "disabled";
					}
				} else {
					$setamount = $invotermsql_dtls->amount;
					$disp = "display:block;";
					$rdonly = "";
				}



			?>

				<tr class="tr_clone">
					<td>
						<input class="crntrmsid" type="hidden" name="crntrmsid" id="crntrmsid" value="<?= $invtrmsId ?>">
						<input class="trmsubtot" type="hidden" name="trmsubtot" id="trmsubtot" value="<?= $trminvsubtot ?>">
						<input class="trminvid" type="hidden" name="trminvid" id="trminvid" value="<?= $_POST['invoiceid'] ?>">
						<select class="form-control txttermstype 2" id="txttermstype" name="txttermstype">
							<option>Choose </option>
							<?php

							$admtermssql = $this->db->query("SELECT * FROM adm_terms WHERE subcat_id='" . $invotermsql_dtls->subcat_id . "' ORDER BY id ASC");

							foreach ($admtermssql->result() as $admtermssql_dtls) {
								if ($admtermssql_dtls->name == $invotermsql_dtls->name) {

									$selectitmtyp = "selected";
								} else {

									$selectitmtyp = "";
								}

							?>
								<option <?= $selectitmtyp ?> value="<?= $admtermssql_dtls->subcat_id ?>"><?= $admtermssql_dtls->name ?></option>

							<?php } ?>
						</select>
					</td>

					<?php
					if ($invotermsql_dtls->name == "Event Date") {
					?>
						<td></td>
						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>" disabled>
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $trmsum ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else if ($invotermsql_dtls->name == "Date") {
					?>
						<td></td>
						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $setamount ?>">
						</td>

						<td>
							<?php
							if ($event_detail['event_date'] != "" && $event_detail['event_date'] != "1970-01-01") {
								if ($setamount != "") {
									$aks = date('m/d/Y', strtotime($event_detail['event_date'] . ' ' . $setamount . ' days'));
								} else {
									$aks = date("m/d/Y", strtotime($event_detail['event_date']));
								}
							} else {
								$aks = "";
							}
							?>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $aks; ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else if ($invotermsql_dtls->name == "Installment Date Amount") {
						$dt = "";
						if ($invotermsql_dtls->dt != "0000-00-00" && $invotermsql_dtls->dt != "1970-01-01") {
							$dt = date("m/d/Y", strtotime($invotermsql_dtls->dt));
						}

					?>
						<td><input type="text" class="form-control aksdt d<?php echo $invotermsql_dtls->id; ?>" placeholder="mm/dd/yyyy" value="<?php echo $dt; ?>" onblur="update_field('tbl_invoice_terms','dt',this.value,'id',<?php echo $invotermsql_dtls->id; ?>,'date')" /></td>

						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>">
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $setamount ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					} else {
					?>
						<td></td>

						<td>
							<input type="text" class="form-control txttotamount updwn" name="txttotamount" id="txttotamount" value="<?= $invotermsql_dtls->amount ?>">
						</td>

						<td>
							<input type="text" class="form-control txtamount updwn" name="txtamount" id="txtamount" value="<?= $setamount ?>" disabled>
						</td>

						<td colspan="3">

							<button style="<?= $disp ?>" onclick="<?= $fninvterms ?>" class="btn btn-xs <?= $lstinvtrmcls ?> tr_clone_add"><i class="fa <?= $lstinvtrmid ?>"></i></button>

						</td>
					<?php
					}
					?>


				</tr>
<?php }
		}
	}


	function fnupdateitemqtyinfo_dtls()
	{
		$updatepckqtyinfoarr = array(

			"item_quantity"  => $this->input->post('itmqty'),
			// "item_price"  => $this->input->post('item_price')
		);
		$this->db->where('id', $this->input->post('itemId'));
		if ($this->db->update('customers_package_items', $updatepckqtyinfoarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}


	function fnupdateitemtaxinfo_dtls()
	{
		$updatepckqtyinfoarr = array(

			"item_taxble"  => $this->input->post('itmtax'),
		);
		$this->db->where('id', $this->input->post('itemId'));
		if ($this->db->update('customers_package_items', $updatepckqtyinfoarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}



	function fninvdescounttypinfo_dtls()
	{
		$discounted_amt = "";
		if ($_POST['discntyp'] == "1") // $
		{
			// $discounted_amt= $this->input->post('invoicamount') + $this->input->post('inputxtval_sec');

			$discounted_amt = ($this->input->post('inputxtval_sec') / 100) * $this->input->post('invoicamount');
			$discounted_amt = $this->input->post('invoice_balance_due') + $discounted_amt;
		} else  if ($_POST['discntyp'] == "2") // %
		{
			// alert()
			// $discounted_amt= ($this->input->post('inputxtval') / 100) * $this->input->post('inputxtval_sec');
			// $discounted_amt= $this->input->post('invoicamount') +$discounted_amt;
			$discounted_amt = $this->input->post('invoice_balance_due') + $this->input->post('inputxtval_sec');
		}

		$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invoiceid'] . "'";
		// echo $query_dis;die;
		$sumofdescntitemsqll = $this->db->query($query_diss);

		$getsumdescntrows = $sumofdescntitemsqll->row();
		$descountitemstott = $getsumdescntrows->small_dis;


		$updtdiscntamtarr = array(

			"discounted_amt" => $this->input->post('inputxtval'),
			// "invoice_sub_total" => $discounted_amt,
			"discount_amt_new" => 0,
			"invoice_discount" => $_POST['discntyp'],
			"invoice_balance_due" => $discounted_amt,
			// "small_dis" => $descountitemstott-$discounted_amt
		);
		$this->db->where('invoice_id', $this->input->post('invoiceid'));
		if ($this->db->update('invoices_create', $updtdiscntamtarr)) {
			echo "success";
		} else {
			echo "error";
		}
	}

	function fnadditemsinfo_dtls()
	{

		$addsingleitemarr = array(
			"cus_id"        => $this->input->post('custId'),
			"inv_id"        => $this->input->post('invId'),
			"item_name"     => $this->input->post('itemId'),
			"item_quantity" => 1, // $this->input->post('take_my_data'),
			"item_price"    => $this->input->post('itemprice'),
			"item_desc"     => $this->input->post('itemdesc'),
			"item_tot"      => $this->input->post('itemprice')
		);

		if ($this->db->insert('customers_package_items', $addsingleitemarr)) {

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE  inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;

			// // main inv
			// $query_diss="SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='".$_POST['invId']."'";
			// // echo $query_dis;die;
			// $sumofdescntitemsqll=$this->db->query($query_diss);
			//
			// $getsumdescntrows=$sumofdescntitemsqll->row();
			// $descountitemstott=$getsumdescntrows->discount_amt_new;

			$invoicetot = $itemstot + $pckgstot;
			$invoice_balance_due = $invoicetot - ($descountitemstot + $desountpckgstot);

			// main invoice discount
			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invId'] . "'";
			// echo $query_dis;die;
			$sumofdescntitemsqll = $this->db->query($query_diss);
			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;
			//echo "main_dis ".$descountitemstott;echo "<br>";

			if ($getsumdescntrows->invoice_discount == "1") // $
			{
				$disamttotall = $getsumdescntrows->discounted_amt;
				$invoice_balance_due = $invoice_balance_due - $getsumdescntrows->discounted_amt;
				//echo "dis$---A--".$disamttotall."////".$disamttotal;
			}
			if ($getsumdescntrows->invoice_discount == "2") // %
			{
				$disamttotall = ($invoicetot / 100) * $getsumdescntrows->discounted_amt;
				//echo "dis-A--+".$disamttotall;
				$invoice_balance_due = $invoice_balance_due - $disamttotall;
			}

			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $invoice_balance_due,
				"discount_amt_new" => $disamttotall,
			);
			$this->db->where('invoice_id', $_POST['invId']);
			$this->db->where('cust_id', $_POST['custId']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	function fnupdateitemsinfo_dtls()
	{
		$updatesingleitemsarr = array(
			"cus_id" => $this->input->post('custId'),
			"inv_id" => $this->input->post('invId'),
			"item_name" => $this->input->post('itemId'),
			//"item_quantity" =>1,
			"item_price" => $this->input->post('itemprice'),
			"item_desc" => $this->input->post('itemdesc'),
			"item_tot" => $this->input->post('itemprice')

		);
		$this->db->where('id', $this->input->post('rowid'));
		if ($this->db->update('customers_package_items', $updatesingleitemsarr)) {

			/* calculate only discounted items total */
			$sumofdescntitemsql = $this->db->query("SELECT SUM(discounted_amt) AS discounted_amt  FROM customers_package_items WHERE package_id IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");

			$getsumdescntrow = $sumofdescntitemsql->row();
			$descountitemstot = $getsumdescntrow->discounted_amt;

			/* calculate only items total */
			$sumofitmgsql = $this->db->query("SELECT SUM(item_tot) AS item_tot FROM customers_package_items WHERE package_id IS NULL AND  inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumitemsrow = $sumofitmgsql->row();
			$itemstot = $getsumitemsrow->item_tot;


			/* calculate only descounted packages total */
			$sumofdescntpckgsql = $this->db->query("SELECT SUM(pck_discounted_amt) AS pck_discounted_amt FROM customer_assigned_packages WHERE inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumdescntpckrow = $sumofdescntpckgsql->row();
			$desountpckgstot = $getsumdescntpckrow->pck_discounted_amt;

			/* calculate packages total */
			$sumofpckgsql = $this->db->query("SELECT SUM(package_price) AS package_price FROM customer_assigned_packages WHERE pck_discounted_amt IS NULL AND inv_id='" . $_POST['invId'] . "' AND cus_id='" . $_POST['custId'] . "' ORDER BY id ASC ");
			$getsumpckrow = $sumofpckgsql->row();
			$pckgstot = $getsumpckrow->package_price;

			//main discount on invoice
			$query_diss = "SELECT invoice_amount,discount_amt_new,invoice_discount,discounted_amt,invoice_balance_due,small_dis  FROM invoices_create WHERE invoice_id='" . $_POST['invId'] . "'";
			// echo $query_dis;die;
			$sumofdescntitemsqll = $this->db->query($query_diss);

			$getsumdescntrows = $sumofdescntitemsqll->row();
			$descountitemstott = $getsumdescntrows->discount_amt_new;

			$invoicetot = $itemstot + $pckgstot;
			$invoice_balance_due = $invoicetot - ($desountpckgstot + $descountitemstot + $descountitemstott);
			//echo "invoicetot--".$invoicetot;

			$upitemtotal = array(

				"invoice_amount" => $invoicetot,
				"invoice_balance_due" => $invoice_balance_due
			);
			$this->db->where('invoice_id', $_POST['invId']);
			$this->db->where('cust_id', $_POST['custId']);
			if ($this->db->update('invoices_create', $upitemtotal)) {
				echo "success";
			}
		} else {
			echo "error";
		}
	}

	function fnupdateinvcounteyinfo_dtls()
	{

		$chkstate = $this->db->query("SELECT * FROM states WHERE name='" . $this->input->post('countyval') . "'");
		$chkstaterow = $chkstate->row();

		$addinvtxratearr = array(
			"invoice_county" => $this->input->post('cvalue'),
			"invoice_tax_rate" => $chkstaterow->state_rate
		);
		$this->db->where('invoice_id', $this->input->post('hdninvId'));
		if ($this->db->update('invoices_create', $addinvtxratearr)) {
			echo "success";
		} else {
			echo "error";
		}
	}






	public function check_email_exist($email)
	{
		$query = $this->db->select('*')
			->from('users')
			->where(array("email" => $email))
			->get();

		return $query->num_rows();
	}
}
