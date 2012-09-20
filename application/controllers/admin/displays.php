<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Displays extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('page');
		$this->load->model('section');
		$this->load->model('content');
		$this->load->model('display');
		$this->load->model('menu');
		$this->load->model('type');
		$this->layout_admin->setTitle('AdminPHP - Affichages');
	}
	
	function index()
	{
		$data['pages'] = $this->page->getPages();
		$this->layout_admin->view('admin/displays/index',$data);
	}
	
	function view($idPage)
	{
		$data['page'] = current($this->page->getPage('id',$idPage));
		$data['pagesSections'] = $this->page->getPagesSections('id_pages',$idPage);
		$data['section'] = $this->section;
		$data['sections'] = $this->section->getSections();
		$data['contents'] = $this->content->getContents();
		$data['menus'] = $this->menu->getMenus();
		$data['types'] = $this->type->getTypes();
		$data['content'] = $this->content;
		$data['display'] = $this->display;
		$this->layout_admin->view('admin/displays/view',$data);
	}
	
	function setContent($action,$idPageSection = null)
	{
		$contents = $this->input->post('ct');
		print_r($contents);
		
		if($action == 'add')
		{
			if(!empty($contents))
			{
				$i = 0;
				foreach($contents as $content)
				{
					$ext = substr($content, -3);
					$id = current(explode($ext,$content));
					$infoType = current($this->type->getType('ext',$ext));
					$count = $this->display->countDisplay($idPageSection,$id,$infoType->id);
					
					if($count)
					{
						$data = array(
							'id_foreigns' => $id,
							'id_types' => $infoType->id,
							'id_pages_sections' => $idPageSection,
							'positions' => $i,
						);
						
						$infoDisplay = current($this->display->getDisplay($idPageSection,$id,$infoType->id));
						$this->display->updateOrder($infoDisplay->id,$data);
					}
					else
					{
						$on = false;
						$pagesSections = $this->page->getAllPagesSections();
						$infoPageSection = current($this->page->getPagesSections('id',$idPageSection));
						
						foreach($pagesSections as $pageSection)
						{
							$count = $this->display->countDisplay($pageSection->id,$id,$infoType->id);
							if($count && $infoPageSection->id_pages == $pageSection->id_pages)
							{
								$oldIdPageSection = $pageSection->id;
								$on = true;
								break;
							}
						}
						
						if($on)
						{
							$infoDisplay = current($this->display->getDisplay($oldIdPageSection,$id,$infoType->id));
							$data = array(
								'id_foreigns' => $id,
								'id_types' => $infoType->id,
								'id_pages_sections' => $idPageSection,
								'positions' => $i,
							);
							$this->display->updateOrder($infoDisplay->id,$data);
						}
						else
						{
							$data = array(
								'id_foreigns' => $id,
								'id_types' => $infoType->id,
								'id_pages_sections' => $idPageSection,
								'positions' => $i,
							);
							
							$this->display->save($data);
						}
					}
					
					$i++;
				}
			}
		}
		else
		{
			if(!empty($contents))
			{
				foreach($contents as $content)
				{
					$pagesSections = $this->page->getPagesSections('id_pages',$idPageSection);
					
					foreach($pagesSections as $pageSection)
					{
						$count = $this->display->countDisplay($pageSection->id,$id,$infoType->id);
						if($count)
						{
							$this->display->delete($pageSection->id,$content);
						}
					}
				}
			}
		}
	}
}