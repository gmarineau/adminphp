<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('page');
		$this->load->model('section');
		$this->load->model('content');
		$this->load->model('display');
		$this->load->model('setting');
		$this->load->model('menu');
		$this->load->model('type');
	}
	
	function index($url = null)
	{
		if($url == null)
		{
			$url = 'home';
		}
		
		$settings = $this->setting->getSettings();
		
		foreach($settings as $setting)
		{
			$data[$setting->var] = $setting->value;
		}
		
		$count = $this->page->count('url',$url);
		
		if($count)
		{
			$page = current($this->page->getPage('url',$url));
			$pagesSections = $this->page->getPagesSections('id_pages',$page->id);
			
			foreach($pagesSections as $pageSection)
			{
				$section = current($this->section->getSection('id',$pageSection->id_sections));
				$page = current($this->page->getPage('id',$pageSection->id_pages));
				$displays = $this->display->getDisplays($pageSection->id);
				$data[$section->section] = '';
				$data['namepage'] = $page->title;
				foreach($displays as $display)
				{
				    $infoType = current($this->type->getType('id',$display->id_types));
					$function = 'display';
					$model = $infoType->model;
					$infoContent = $this->$model->$function($display->id_foreigns);
					$data[$section->section] .= $infoContent;
				}
			}
			
			$this->load->view('../../webroot/pages',$data);
		}
		else
		{
			echo '404 - Page Not Found';
		}
	}
}