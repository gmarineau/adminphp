<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contents extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('content');
		$this->load->model('display');
		$this->layout_admin->setTitle('AdminPHP - Contenus');
	}
	
	function index()
	{
		$data['contents'] = $this->content->getContents();
		$this->layout_admin->view('admin/contents/index',$data);
	}
	
	function add()
	{
		$this->form_validation->set_rules('title','titre','required');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/contents/add');
		}
		else
		{
			$data = array(
                'date' => time(),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
			);
			
			$this->content->save($data);
			$this->layout_admin->view('admin/contents/success');
		} 		
	}
	
	function edit($idContent)
	{
		$data['content'] = current($this->content->getContent('id',$idContent));
		$this->form_validation->set_rules('title','titre','required');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/contents/edit',$data);
		}
		else
		{
			$data = array(
                'date' => time(),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
			);
			
			$this->content->update($data,$idContent);
			$this->layout_admin->view('admin/contents/success');
		} 		
	}
	
	function delete($idContent)
	{
		$this->display->removeContent($idContent);
		$this->content->remove($idContent);
		$this->index();
	}
}