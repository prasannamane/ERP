<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		if (isset($this->session->mr_session)) {
			redirect('mr');
		}
		if (isset($this->session->fi_session)) {
			redirect('fi_home');
		}
		if (isset($this->session->hod_session)) {
			redirect('hod');
		}
		if (isset($this->session->director_session)) {
			redirect('director');
		}
	}

	public function register()
	{
		$data['alert'] = $this->session->flashdata('alert');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$data['page_name'] = "Register";

		$cnt = $this->AdminModel->check_email_exist($this->input->post('email'));
		if ($cnt == 0) {
			$arr = array(
				//"title"     => $this->input->post('title'),
				"name"      => $this->input->post('user_fname'),
				"email"     => $this->input->post('email'),
				"username"  => $this->input->post('user_name'),
				"password"  => base64_encode($this->input->post('user_password')),
				"status"    => 0,
				"type"      => 1,
				"verified"  => 1,
				"created_at" => date("Y-m-d H:i:s"),
				"last_name" => '',
				"admin_role_id" => '1',
				"user" => '1'
			);

			$rid = $this->AdminModel->user_register($arr);

			if ($rid > 0) {
				$userid     = base64_encode($rid);
				$url        = base_url() . "change_password?rid=" . $userid;
				$message    = "";

				$this->email->set_mailtype("html");
				$this->email->from('admin@tech599.com', 'ERP App');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject('Thank You for Registration - ERP App');
				$this->email->message($message);
				$this->email->send();

				$this->session->set_flashdata('success', "New User Register Succfully..!!");
				redirect('authentication');
			} else {
				$this->session->set_flashdata('error', "Something Went wrong..!!");
			}
		} else {
			$this->session->set_flashdata('error', "Email Already Registered..!!");
		}
		$this->load->view('public/register', $data);
	}

	public function index()
	{
		$data['alert'] = $this->session->flashdata('alert');
		$data['error'] = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$data['page_name'] = "Log In";

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'api.openweathermap.org/data/2.5/forecast?q=New York,us&appid=c9ad4ea1b521227ce67dba1409208fdb',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		));
		$resp = curl_exec($curl);
		$result = json_decode($resp, true);
		curl_close($curl);

		if (count($result["list"]) > 0) {
			foreach ($result["list"] as $row) {
				$dt = date("Y-m-d", $row["dt"]);
				$time = date("H:i:s", $row["dt"]);
				$temp = 0;
				$temp = $row["main"]["temp"];
				$humidity = $row["main"]["humidity"];
				$weather  = $row["weather"]["0"]["main"];
				$icon  = $row["weather"]["0"]["icon"];
				$wind  = $row["wind"]["speed"];
				$temp = round(9 / 5 * ($temp - 273.15) + 32);
				$arr = array(
					"dt" => $dt,
					"time" => $time,
					"temp" => $temp,
					"humidity" => $humidity,
					"weather" => $weather,
					"wind" => $wind,
					"icon" => $icon
				);
				// check whether date and time data is uplaoded or not
				$res = $this->db->query("SELECT * FROM daily_forecast WHERE dt = '" . $dt . "' AND time = '" . $time . "'");
				$num = $res->num_rows();
				if ($num > 0) {
					$res = $this->db->query("SELECT * FROM daily_forecast WHERE dt = '" . $dt . "' AND time = '" . $time . "'")->row_array();
					$this->db->set($arr)->where(array("id" => $res['id']))->update("daily_forecast");
				} else {
					$this->db->insert("daily_forecast", $arr);
				}
			}
		}
		$this->session->unset_userdata('id');
		$this->load->view('public/auth', $data);
	}

	public function logincheck()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('error', 'please provide all details');
			redirect('authentication');
		} 
		else 
		{
			$data = array(
				'email' => $this->input->post('email'),
				'password' => base64_encode($this->input->post('password'))
			);
			$verified = $this->AuthenticationModel->login($data);

			if ($verified == 2) {
				$this->session->set_flashdata("error", "Email is not verified");
				redirect('auth');
			}
			if ($verified == 3) {
				$this->session->set_flashdata("error", "Username or Password is Wrong");
				redirect('auth');
			}
			if ($verified == 4) {
				$this->session->set_flashdata("error", "User Dosen't Exists");
				redirect('auth');
			}

			if ($verified == 5) {
				$this->session->set_flashdata("error", "Account is deactivated");
				redirect('auth');
			} else {
				//this is else case, that we dont know what happened, keep it for testing perpose
				$this->session->set_flashdata("error", "Something wrong..!!");
				redirect('auth');
			}
		}
	}
}
