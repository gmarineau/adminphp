<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('menu');
		$this->load->model('item');
		$this->layout_admin->setTitle('AdminPHP - Menus');
	}
	
	function index()
	{
		$data['menus'] = $this->menu->getMenus();
		$this->layout_admin->view('admin/menus/index',$data);
	}
	
	function add()
	{
		$this->form_validation->set_rules('menu','menu','required');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/menus/add');
		}
		else
		{
			$data = array(
				'menu' => $this->input->post('menu'),
			);
			
			$this->menu->save($data);
			$this->layout_admin->view('admin/menus/success');
		} 		
	}
	
	function view($idMenu)
	{
		$data['items'] = $this->item->getItem('id_menus',$idMenu);
		$data['menu'] = current($this->menu->getMenu('id',$idMenu));
		$this->layout_admin->view('admin/menus/view',$data);
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