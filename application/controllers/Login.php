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

	public function register()
	{
		redirect('Login');
		$this->load->view('login/header');
		$this->load->view('login/register');
		$this->load->view('login/footer');
	}
	public function register_user()
	{

		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
			$insertData = array(
				'name' => validateInput($_POST['name']),
				'password' => validateInput($_POST['password']),
				'email' => validateInput($_POST['email']),
				'status' => 'A',
				'role' => validateInput($_POST['role']),
			);

			$checkExist = $this->MainModel->selectAllFromWhere("users", array("email" => $insertData['email']));

			if (!$checkExist) {
				$insertData['user_id'] =	$this->MainModel->getNewIDorNo("users");

				$result = $this->MainModel->insertInto('users', $insertData);

				if ($result) {
					$final = $this->MainModel->selectAllFromWhere("users", array("user_id" => $insertData['user_id']));
					$this->session->set_userdata(USER_SESSION_KEY, $final[0]);
					echo json_encode(array('success' => true, 'message' => 'Registered successfully'));
				} else {
					echo json_encode(array('success' => false, 'message' => 'Server error.'));
				}
			} else {
				echo json_encode(array('success' => false, 'message' => 'Email already exists'));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Insufficient details sent, Please contact admin.'));
		}
		exit();
	}
}
