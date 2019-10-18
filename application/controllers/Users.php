<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata"); //Set server date an time to Asia

		if (!isset($_SESSION['userInfo']))		   // On first entry re-direct to logi screen
		{
			redirect('Login/index');
		} else {
		
		}
	}
	private function load_view($views = [], $vars = [])
	{
		$this->load->view('users/dashboard/layouts/header.php', $vars);
		$this->load->view('users/dashboard/layouts/sidenav.php', $vars);
		if (is_array($views)) {
			foreach ($views as $view) {
				$this->load->view('users/dashboard/' . $view, $vars);
			}
		} else {
			$this->load->view('users/dashboard/' . $views, $vars);
		}
		$this->load->view('users/dashboard/layouts/footer.php', $vars);
	}
	public function index()
	{
		$this->load_view('index');
	}


	public function logout()
	{

		$this->session->unset_userdata('userInfo');

		redirect("login");
	}

}
