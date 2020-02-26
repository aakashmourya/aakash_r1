<?php
class Login extends ci_controller
{
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Kolkata");

		if (isset($_SESSION[USER_SESSION_KEY]) && !empty($_SESSION[USER_SESSION_KEY])) {
			redirect('User');
		} else if (isset($_SESSION[ADMIN_SESSION_KEY]) && !empty($_SESSION[ADMIN_SESSION_KEY])) {
			redirect('Admin');
		}
	}

	public function index()
	{		
		$this->load->view('login/header');
		$this->load->view('login/index');
		$this->load->view('login/footer');
	}

	public function validate()
	{
		//my_print($_POST);die;
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$email = validateInput($_POST['email']);
			$password = validateInput($_POST['password']);

			$data = array(
				'email' => $email,
				'password' => $password
			);

			$response = api_post(API_BASE_URL . 'user/login', $data);

			if ($response) {
				if (isset($response['error'])) {
					echo json_encode(array('success' => false, 'message' => $response['error']['message']));
				} else {
					if ($response['success']) {
						$return_url = isset($_GET['return_url']) ? $_GET['return_url'] : "";
						$home_url = ($return_url == "") ? base_url("User") : $return_url;
						$session_key = USER_SESSION_KEY;
						//if user is admin
						if ($response['result']['user']['added_by'] == 'root') {
							$home_url = ($return_url == "") ? base_url("Admin") : $return_url;
							$session_key = ADMIN_SESSION_KEY;
						}
						//
						$this->session->set_userdata($session_key, $response['result'], isset($_POST['rememberme']) ? true : false);
						echo json_encode(array('success' => true, 'message' => 'Login successfully', "home_url" => $home_url));
					} else {
						echo json_encode(array('success' => false, 'message' => $response['result']['message']));
					}
				}
			} else {
				echo json_encode(array('success' => false, 'message' => 'Server not respond. Please try later'));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'System error found, Please contact service provider'));
		}
	}
}
