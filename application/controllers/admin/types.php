<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Types extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('type');
		$this->layout_admin->setTitle('AdminPHP - Types');
	}
	
	function index()
	{
        
	}
	
}