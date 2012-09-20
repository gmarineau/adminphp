<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('page');
		$this->load->model('section');
		$this->layout_admin->setTitle('AdminPHP - Pages');
	}
	
	function index()
	{
    $data['maps'] = directory_map('./modules/');
		$this->layout_admin->view('admin/modules/index',$data);
	}

  function getFolder()
  {
    $data['maps'] = directory_map('./modules/');
    $this->layout_admin->view('admin/modules/getfolder',$data);
  }

  function news()
  {
    echo 'prout';
  }
}