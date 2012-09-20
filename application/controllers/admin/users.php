<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model('user');
		$this->layout_admin->setTitle('AdminPHP - Utilisateurs');
	}
	
	function index()
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$data['users'] = $this->user->getUsers();
		$this->layout_admin->view('admin/users/index',$data); 
	}
	
	function add()
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->form_validation->set_rules('login','login','callback_checkLogin|alpha_dash|required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password','mot de passe','required');
		$this->form_validation->set_rules('email','e-mail','required|valid_email');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/users/add');
		}
		else
		{
			$data = array(
				'login' => $this->input->post('login'),
				'password' => sha1($this->input->post('password')),
				'email' => $this->input->post('email'),
			);
			
			$this->user->save($data);
			$this->layout_admin->view('admin/users/success');
		}
	}
	
	function edit($idUser)
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->form_validation->set_rules('email','e-mail','required|valid_email');
		$data['user'] = current($this->user->getUser('id',$idUser));
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/users/edit',$data);
		}
		else
		{
			$data = array(
				'email' => $this->input->post('email'),
			);
			
			$this->user->update($data,$idUser);
			$this->layout_admin->view('admin/users/success');
		}
	}
	
	function editPwd($idUser)
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->form_validation->set_rules('password','mot de passe','required');
		$data['userid'] = $idUser;
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/users/editpwd',$data);
		}
		else
		{
			$data = array(
				'password' => sha1($this->input->post('password')),
			);
			
			$this->user->update($data,$idUser);
			$this->layout_admin->view('admin/users/success');
		}
	}
	
	function checkLogin($login)
	{
		$countLogin = $this->user->countUser('login',$login);
		
		if ($countLogin)
		{
			$this->form_validation->set_message('checkLogin', 'Le nom d\'utilisateur existe déjà !');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function delete($idUser)
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->user->remove($idUser);
		$this->index();
	}
	
	function login()
	{
		$this->form_validation->set_rules('login','login','required');
		$this->form_validation->set_rules('password','mot de passe','required');
		
		if(!$this->form_validation->run())
		{
			$this->load->view('admin/users/login');
		}
		else
		{
			$access = $this->accessControl($this->input->post('login'),$this->input->post('password'));
			
			if(!$access)
			{
				$data['message'] = '<p class="error">Login ou mot de passe faux !</p>';
				$this->load->view('admin/users/login');	
			}
			else
			{
				$infoUser = current($this->user->getUser('login',$this->input->post('login')));
				$user = array('user_id'=>$infoUser->id,'user_login'=>$this->input->post('login'));
				$this->session->set_userdata($user);
				header('location:'.site_url('admin/users'));
			}	
		}
	}
	
	function accessControl($login,$password)
	{
		$result = $this->user->countAccess($login,$password);
		
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function logout()
	{
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->session->sess_destroy();
		header('Location:'.base_url());
	}
}