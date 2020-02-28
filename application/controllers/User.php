<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	var $userDetail;
	var $refferalDetail;
	var $contractDetail;
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
			//getting user details
			$response = api_post(API_BASE_URL . 'user/get_user_details', ['user_id' => $_SESSION[USER_SESSION_KEY]['user']['user_id']], get_token_header($this->accessToken));

			if ($this->validate_response($response)) {
				if (empty($response['result'])) {
					$this->logout();
				}
				$this->userDetail = $response['result'];
			}

			//getting refferal details
			$response1 = api_post(API_BASE_URL . 'user/get_user_details', ['user_id' => $_SESSION[USER_SESSION_KEY]['user']['user_id']], get_token_header($this->accessToken));

			if ($this->validate_response($response)) {
				$this->refferalDetail = $response1['result'];
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
	private function load_view($views = [], $vars = [], $scripts = [], $js_contants = [], $load_data_ajax = [])
	{
		$view_data = init_view_data($scripts, $js_contants, $load_data_ajax);
		$vars = array_merge($view_data, $vars);

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
		$data['user'] = $this->userDetail;
		$this->load_view('dashboard/index', $data);
	}

	public function add_agent()
	{

		$response = api_post(API_BASE_URL . 'user/get_user_types', [], get_token_header($this->accessToken));

		if ($this->validate_response($response)) {

			$data['agent_types'] = $response['result'];

			$js_contants = array(
				"REG_TYPE_COMPANY" => REG_TYPE_COMPANY,
				"REG_TYPE_INDIVIDUAL" => REG_TYPE_INDIVIDUAL,
				"FORM_ACTION" => 'save_agent'
			);

			$this->load_view('add_agent', $data, 'assets/scripts/users/agents.js', $js_contants);
		}
	}
	public function save_agent()
	{
		//my_print($_POST);
		if (isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['ref_code']) && isset($_POST['percentage'])) {

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
			if (validateInput($_POST['ref_code']) != "" && validateInput($_POST['percentage']) != "") {
				$data['referred_by'] = validateInput($_POST['ref_code']);
				$data['percentage'] = validateInput($_POST['percentage']);
			}
			$response = api_post(API_BASE_URL . 'user/add_user', $data, get_token_header($this->accessToken));

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
		$user_id = base64_decode($user_id);
		$response = api_post(API_BASE_URL . 'user/get_user_details', ['user_id' => $user_id], get_token_header($this->accessToken));
		if ($this->validate_response($response) && $response['success'] && empty($response['result'])) {
			redirect($this->router->fetch_class() . '/show-agents');
		}

		$data['user_detail'] = $response['result'];
		//my_print($data['user_detail']);
		$response = api_post(API_BASE_URL . 'user/get_user_types', [], get_token_header($this->accessToken));

		if ($this->validate_response($response)) {

			$data['agent_types'] = $response['result'];

			$js_contants = array(
				"REG_TYPE_COMPANY" => REG_TYPE_COMPANY,
				"REG_TYPE_INDIVIDUAL" => REG_TYPE_INDIVIDUAL,
				"FORM_ACTION" => 'update_agent'
			);

			$this->load_view('add_agent', $data, 'assets/scripts/users/agents.js', $js_contants);
		}
	}
	public function update_agent()
	{
		if (isset($_POST['user_id']) && isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address'])) {

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
			$response = api_post(API_BASE_URL . 'user/edit_user', $data, get_token_header($this->accessToken));

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
		$response = api_post(API_BASE_URL . 'user/get_all_users', ['user_id' => $this->userDetail['user_id'], 'ref_code' => $this->userDetail['ref_code']], get_token_header($this->accessToken));
		$data['agents'] = [];
		if ($this->validate_response($response)) {
			if ($response['success']) {
				$data['agents'] = $response['result'];
			}
		}
		$this->load_view('show_all_agents', $data);
	}

	public function contract()
	{

		$tests_response = api_post(API_BASE_URL . 'test/get_tests', [], get_token_header($this->accessToken));
		$agents_response = api_post(API_BASE_URL . 'user/get_all_users', ['user_id' => $this->userDetail['user_id']], get_token_header($this->accessToken));

		$data['tests'] = [];
		$data['agents'] = [];
		if ($this->validate_response($tests_response) && $this->validate_response($agents_response)) {
			if ($tests_response['success']) {
				$data['tests'] = $tests_response['result'];
			}
			if ($agents_response['success']) {
				$data['agents'] = $agents_response['result'];
			}
		}
		$load_data_ajax = array(
			array(
				"var_name" => "packages",
				"url" => base_url($this->router->fetch_class() . '/get_packages')
			)
		);
		$this->load_view('contract', $data, 'assets/scripts/users/contract.js', [], $load_data_ajax);
	}
	public function save_contract()
	{
		// print_r($_FILES);
		// exit();
		if (isset($_POST['user_id']) && isset($_POST['ref_code']) && isset($_POST['percentage']) &&  isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_FILES['file']['name']) && isset($_POST['tests'])) {

			$data = array(
				'user_id' => validateInput(base64_decode($_POST['user_id'])),
				'ref_code' => validateInput($_POST['ref_code']),
				'ref_percentage' => validateInput($_POST['percentage']),
				'from_date' => date_format(date_create_from_format('d/m/Y', validateInput($_POST['from_date'])), 'Y-m-d'),
				'to_date' => date_format(date_create_from_format('d/m/Y', validateInput($_POST['to_date'])), 'Y-m-d'),
				'tests' => $_POST['tests'],
				'doc_file' => new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name'])
			);

			$response = api_post_file(API_BASE_URL . 'user/add_contract', $data, get_token_header($this->accessToken));

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
		// if (isset($_POST['user_id']) && isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address'])) {

		// 	$data = array(
		// 		'user_id' => base64_decode($_POST['user_id']),
		// 		'password' => validateInput($_POST['password']),
		// 		'email' => validateInput($_POST['email']),
		// 		'name' => validateInput($_POST['name']),
		// 		'company_name' => validateInput($_POST['company_name']),
		// 		'mobile' => validateInput($_POST['phone']),
		// 		'address' => validateInput($_POST['address']),
		// 		'gst' => validateInput($_POST['gst']),
		// 		'reg_type' => validateInput($_POST['reg_type']),
		// 	);
		// 	if ($data['reg_type'] != REG_TYPE_COMPANY) {
		// 		$data['company_name'] = "n/a";
		// 		$data['gst'] = "n/a";
		// 	}
		// 	$response = api_post(API_BASE_URL . 'user/edit_user', $data, get_token_header($this->accessToken));

		// 	if ($this->validate_response($response, false)) {
		// 		if ($response['success']) {
		// 			echo json_encode(array('success' => true, 'message' => $response['result']['message']));
		// 		} else {
		// 			echo json_encode(array('success' => false, 'message' => $response['result']['message']));
		// 		}
		// 	} else {
		// 		echo json_encode(array('success' => false, 'message' => $response['error']));
		// 	}
		// } else {
		// 	echo json_encode(array('success' => false, 'message' => 'Insufficient details sent, Please contact admin.'));
		// }
		//exit();
	}
	public function get_packages()
	{
		$response = api_post(API_BASE_URL . 'test/get_packages', [], get_token_header($this->accessToken));
		echo json_encode($response);
	}

	public function logout()
	{
		$this->session->unset_userdata(USER_SESSION_KEY);
		$return_url = get_cookie('return_url');
		$return_url_query = isset($return_url) ? "?return_url=" . $return_url : "";
		redirect("login" . $return_url_query);
	}

	public function show_contract()
	{
		$contract_no = $this->userDetail['contract_no'];
		// if (empty($contract_no)) {
		// 	redirect($this->router->fetch_class());
		// }

		$response = api_post(API_BASE_URL . 'user/get_contract_details', ['contract_no' => $contract_no], get_token_header($this->accessToken));
		//my_print($response );

		if ($this->validate_response($response) && $response['success'] && empty($response['result'])) {
			redirect($this->router->fetch_class());
		} else {
		}
		$data['contract_detail'] = $response['result'];
		$this->load_view('view_contract', $data);
	}
}
