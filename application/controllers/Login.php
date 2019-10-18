<?php
class Login extends ci_controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");

		if (isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo'])) {
			redirect('Users');
		}
	}
	public function register()
	{
		$this->load->view('users/login/header');
		$this->load->view('users/login/register');
		$this->load->view('users/login/footer');
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
					$this->session->set_userdata("userInfo", $final[0]);
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

	public function index()
	{

		$this->load->view('users/login/header');
		$this->load->view('users/login/index');
		$this->load->view('users/login/footer');
	}

	public function validate()
	{
		//my_print($_POST);die;
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$email = validateInput($_POST['email']);
			$password = validateInput($_POST['password']);

			$result = $this->MainModel->selectAllFromWhere("users", array("email" => $email, "password" => $password, "status" => 'A'));

			if ($result) {
				$result = $result[0];
				$this->session->set_userdata("userInfo", $result, isset($_POST['rememberme']) ? true : false);
				echo json_encode(array('success' => true, 'message' => 'Login successfully'));
			} else {
				echo json_encode(array('success' => false, 'message' => 'Please enter valid credentials'));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'System error found, Please contact service provider'));
		}
	}

	
}
