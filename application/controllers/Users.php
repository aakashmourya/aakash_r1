<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	var $userDetail;
	var $accessToken;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata"); //Set server date an time to Asia
		$this->load->model('UserModel');

		
		if (!isset($_SESSION[USER_SESSION_KEY]))		   // On first entry re-direct to login screen
		{
			redirect('Login/');
		} else {

			$this->accessToken = $_SESSION[USER_SESSION_KEY]['token'];
			$response = json_post(API_BASE_URL . 'get_user_details', ['user_id' => $_SESSION[USER_SESSION_KEY]['user']['user_id']], get_token_header($this->accessToken));

			if ($this->validate_response($response)) {
				$this->userDetail = $response['result'];
			}
		}
	}
	private function validate_response($response, $doLogout = true)
	{
		$isvalid = false;
		if ($response) {
			if (isset($response['error'])) {
				if ($doLogout)
					$this->logout();
			} else {
				$isvalid = true;
			}
			// if (!empty($response['result'])) {
			// 	$isvalid = true;
			// } else {
			// 	$this->logout();
			// }
		} else {
			if ($doLogout)
				$this->logout();
		}
		return $isvalid;
	}
	private function load_view($views = [], $vars = [], $scripts = [], $js_contants = [])
	{
		$vars['scripts'] = $scripts;
		$vars['js_contants'] = $js_contants;
		$vars['CURRENT_METHOD']=$this->router->fetch_method();
		$this->load->view('users/shared_views/header.php', $vars);
		$this->load->view('users/shared_views/sidenav.php', $vars);
		if (is_array($views)) {
			foreach ($views as $view) {
				$this->load->view('users/' . $view, $vars);
			}
		} else {
			$this->load->view('users/' . $views, $vars);
		}
		$this->load->view('users/shared_views/footer.php', $vars);
	}

	public function index()
	{
		$this->load_view('dashboard/index');
	}

	public function add_agent()
	{

		$response = json_post(API_BASE_URL . 'get_user_types', [], get_token_header($this->accessToken));

		if ($this->validate_response($response)) {

			$data['agent_types'] = $response['result'];

			$js_contants = array(
				"REG_TYPE_COMPANY" => REG_TYPE_COMPANY,
				"REG_TYPE_INDIVIDUAL" => REG_TYPE_INDIVIDUAL,
				"POST_ACTION"=>'save_agent'
			);

			$this->load_view('add_agent', $data, 'assets/js/scripts/user/agents.js', $js_contants);
		}
	}
	public function save_agent()
	{
		if (isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address'])) {

			$data = array(
				'password' => validateInput($_POST['password']),
				'email' => validateInput($_POST['email']),
				'name' => validateInput($_POST['name']),
				'company_name' => validateInput($_POST['company_name']),
				'mobile' => validateInput($_POST['phone']),
				'address' => validateInput($_POST['address']),
				'gst' => validateInput($_POST['gst']),
				'reg_type' => validateInput($_POST['reg_type']),
			);
			if ($data['reg_type'] != REG_TYPE_COMPANY) {
				$data['company_name'] = "n/a";
				$data['gst'] = "n/a";
			}
			$response = json_post(API_BASE_URL . 'add_user', $data, get_token_header($this->accessToken));

			if ($this->validate_response($response, false)) {
				if ($response['success']) {
					echo json_encode(array('success' => true, 'message' => $response['result']['message']));
				} else {
					echo json_encode(array('success' => false, 'message' => $response['result']['message']));
				}
			} else {
				echo json_encode(array('success' => false, 'message' => $response['error']));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Insufficient details sent, Please contact admin.'));
		}
		exit();
	}
	public function edit_agent($user_id = null)
	{
		if ($user_id == null) {
			redirect($this->router->fetch_class() . '/show-agents');
		}
		$user_id=base64_decode($user_id);
		$response = json_post(API_BASE_URL . 'get_user_details', ['user_id' => $user_id], get_token_header($this->accessToken));
		if ($this->validate_response($response) && $response['success'] && empty($response['result'])) {
			redirect($this->router->fetch_class() . '/show-agents');
		}
		
		$data['user_detail'] = $response['result'];
		//my_print($data['user_detail']);
		$response = json_post(API_BASE_URL . 'get_user_types', [], get_token_header($this->accessToken));

		if ($this->validate_response($response)) {

			$data['agent_types'] = $response['result'];

			$js_contants = array(
				"REG_TYPE_COMPANY" => REG_TYPE_COMPANY,
				"REG_TYPE_INDIVIDUAL" => REG_TYPE_INDIVIDUAL,
				"POST_ACTION"=>'update_agent'
			);

			$this->load_view('add_agent', $data, 'assets/js/scripts/user/agents.js', $js_contants);
		}
	}
	public function update_agent()
	{
		if (isset($_POST['user_id'])&&isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address'])) {

			$data = array(
				'user_id' => base64_decode($_POST['user_id']),
				'password' => validateInput($_POST['password']),
				'email' => validateInput($_POST['email']),
				'name' => validateInput($_POST['name']),
				'company_name' => validateInput($_POST['company_name']),
				'mobile' => validateInput($_POST['phone']),
				'address' => validateInput($_POST['address']),
				'gst' => validateInput($_POST['gst']),
				'reg_type' => validateInput($_POST['reg_type']),
			);
			if ($data['reg_type'] != REG_TYPE_COMPANY) {
				$data['company_name'] = "n/a";
				$data['gst'] = "n/a";
			}
			$response = json_post(API_BASE_URL . 'edit_user', $data, get_token_header($this->accessToken));

			if ($this->validate_response($response, false)) {
				if ($response['success']) {
					echo json_encode(array('success' => true, 'message' => $response['result']['message']));
				} else {
					echo json_encode(array('success' => false, 'message' => $response['result']['message']));
				}
			} else {
				echo json_encode(array('success' => false, 'message' => $response['error']));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Insufficient details sent, Please contact admin.'));
		}
		exit();
	}

	public function show_agents()
	{
		$response = json_post(API_BASE_URL . 'get_all_users', ['user_id' => $this->userDetail['user_id']], get_token_header($this->accessToken));
		$data['agents'] = [];
		if ($this->validate_response($response)) {
			if ($response['success']) {
				$data['agents'] = $response['result'];
			}
		}
		$this->load_view('show_all_agents', $data);
	}


	public function logout()
	{
		$this->session->unset_userdata(USER_SESSION_KEY);
		redirect("login");
	}
}
