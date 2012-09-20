<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('page');
		$this->load->model('section');
    $this->load->model('display');
		$this->layout_admin->setTitle('AdminPHP - Pages');
	}
	
	function index()
	{
		$data['pages'] = $this->page->getPages();
		$this->layout_admin->view('admin/pages/index',$data);
	}
	
	function add()
	{
		$this->form_validation->set_rules('title','titre','required');
		$this->form_validation->set_rules('url','url','required|callback_url_check');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/pages/add');
		}
		else
		{
			$data = array(
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
			);
			
			$this->page->save($data);
			$this->layout_admin->view('admin/pages/success');
		} 		
	}
	
	function view($idPage)
	{
		$data['page'] = current($this->page->getPage('id',$idPage));
		$data['pagesSections'] = $this->page->getPagesSections('id_pages',$idPage);
		$data['section'] = $this->section;
		$data['sections'] = $this->section->getSections();
		$this->layout_admin->view('admin/pages/view',$data);
	}
	
	function delete($idPage)
	{
		$pagesSections = $this->page->getPagesSections('id_pages',$idPage);
		
		foreach($pagesSections as $pageSection) {
			$this->display->removePageSection($pageSection->id);
			$this->page->removePageSection($pageSection->id);
		}
		
		$this->page->remove($idPage);
		$this->index();
	}
	
	function url_check($url)
	{
		$count = $this->page->count('url',$url);
		
		if($count)
		{
			$this->form_validation->set_message('url_check', 'L\'url existe déjà !');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function set($action,$idPage = null)
	{
		$sections  = $this->input->post('sec');
		
		if($action == 'add')
		{
			foreach($sections as $section)
			{
				$data = array(
					'id_pages' => $idPage,
					'id_sections' => $section
				);
				
				$count = $this->page->countPageSection($idPage,$section);
				
				if(!$count) {
					$this->page->savePageSection($data);
				}
			}
		}
		else
		{
			foreach($sections as $section)
			{
				$count = $this->page->countPageSection($idPage,$section);
				
				if($count) {
					
					$idPageSection = current($this->page->getPageSectionId($idPage,$section));
					$this->page->removePageSection($idPageSection->id);
				}
			}
		}
	}	
}