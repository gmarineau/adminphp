<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sections extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('section');
		$this->load->model('page');
		$this->load->model('display');
		$this->layout_admin->setTitle('AdminPHP - Sections');
	}
	
	function index()
	{
		$data['sections'] = $this->section->getSections();
		$this->layout_admin->view('admin/sections/index',$data);
	}
	
	function add()
	{
		$this->form_validation->set_rules('section','section','required');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/sections/add');
		}
		else
		{
			$data = array(
				'section' => $this->input->post('section'),
			);
			
			$this->section->save($data);
			$this->layout_admin->view('admin/sections/success');
		} 		
	}
	
	function delete($idSection)
	{
		$pagesSections = $this->page->getPagesSections('id_sections',$idSection);
		
		foreach($pagesSections as $pageSection)
		{
			$this->display->removePageSection($pageSection->id);
			$this->page->removePageSection($pageSection->id);
		}
		
		$this->section->remove($idSection);
		$this->index();
	}
}