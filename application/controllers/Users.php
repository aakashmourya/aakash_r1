<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	var $userDetail;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata"); //Set server date an time to Asia
		$this->load->model('UserModel');
		if (!isset($_SESSION['userInfo']))		   // On first entry re-direct to login screen
		{
			redirect('Login/index');
		} else {
			$this->userDetail = $this->UserModel->getUserDetail($_SESSION['userInfo']['user_id'])[0];
			// my_print($this->userDetail);
		}
	}

	private function load_view($views = [], $vars = [], $scripts = [], $js_contants = [])
	{
		$vars['scripts'] = $scripts;
		$vars['js_contants'] = $js_contants;
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
		$data['agent_types'] = $this->MainModel->selectAllFromTable('user_types');
		$js_contants = array(
			"REG_TYPE_COMPANY" => REG_TYPE_COMPANY,
			"REG_TYPE_INDIVIDUAL" => REG_TYPE_INDIVIDUAL
		);
		$this->load_view('add_agent', $data, 'assets/js/scripts/agents.js', $js_contants);
	}
	public function save_agent()
	{
		//my_print($_POST);

		if (isset($_POST['reg_type']) && isset($_POST['agent_type']) && isset($_POST['name']) && isset($_POST['company_name']) && isset($_POST['gst']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['address'])) {
			$user = array(
				'parent_id' => $this->userDetail['user_id'],
				'password' => validateInput($_POST['password']),
				'email' => validateInput($_POST['email']),
				'status' => 'A',
			);

			$user_detail = array(
				'name' => validateInput($_POST['name']),
				'company_name' => validateInput($_POST['company_name']),
				'mobile' => validateInput($_POST['phone']),
				'address' => validateInput($_POST['address']),
				'gst' => validateInput($_POST['gst']),
				'reg_type' => validateInput($_POST['reg_type']),

			);

			$checkExist = $this->MainModel->selectAllFromWhere("users", array("email" => $user['email']));
			if ($checkExist) {
				echo json_encode(array('success' => false, 'message' => 'Email id already exists'));
				die;
			}
			if ($user_detail['reg_type'] == REG_TYPE_COMPANY) {
				$checkExist = $this->MainModel->selectAllFromWhere("user_details", array("company_name" => $user_detail['company_name']));
				if ($checkExist) {
					echo json_encode(array('success' => false, 'message' => 'Company name already exists'));
					die;
				}
			}else{
				$user_detail['company_name']="";
				$user_detail['gst']="";
			}

			$user_detail['user_id'] = $user['user_id'] =	$this->MainModel->getNewIDorNo("users");
			$this->db->trans_begin();
			$result = $this->MainModel->insertInto('users', $user);
			$dresult = $this->MainModel->insertInto('user_details', $user_detail);

			if ($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				echo json_encode(array('success' => false, 'message' => 'Agent could not be added'));
			} else {
				$this->db->trans_commit();
				echo json_encode(array('success' => true, 'message' => 'Agent added successfully'));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Insufficient details sent, Please contact admin.'));
		}
		exit();
	}

	public function show_agents()
	{
		$data['agents'] = $this->UserModel->getAllUser($this->userDetail['user_id']);
		$this->load_view('show_all_agents', $data);
	}


	public function logout()
	{

		$this->session->unset_userdata('userInfo');

		redirect("login");
	}
}
