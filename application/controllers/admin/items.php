<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Items extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
		if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('item');
		$this->layout_admin->setTitle('AdminPHP - Elements');
	}
	
	function index()
	{
		$data['menus'] = $this->menu->getMenus();
		$this->layout_admin->view('admin/menus/index',$data);
	}
	
	function add($idItem)
	{
		$this->form_validation->set_rules('item','element','required');
		$this->form_validation->set_rules('url','url','required');
		$data['idItem'] = $idItem;
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/items/add',$data);
		}
		else
		{
			$save = array(
				'item' => $this->input->post('item'),
				'url' => $this->input->post('url'),
				'id_menus' => $idItem,
			);
			
			$this->item->save($save);
			$this->layout_admin->view('admin/items/success',$data);
		} 		
	}
	
	function edit($idItem)
	{
		$this->form_validation->set_rules('item','element','required');
		$this->form_validation->set_rules('url','url','required');
		$data['item'] = current($this->item->getItem('id',$idItem));
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/items/edit',$data);
		}
		else
		{
			$edit = array(
				'item' => $this->input->post('item'),
				'url' => $this->input->post('url'),
			);
			
			$this->item->update($idItem,$edit);
			$this->layout_admin->view('admin/items/success',$data);
		} 		
	}
	
	function delete($idItem)
	{
		$item = current($this->item->getItem('id',$idItem));
		$this->item->remove($idItem);
		header('Location:'.site_url('admin/menus/view/'.$item->id_menus));
	}
	
	function position()
	{
		$items = $this->input->post('itm');
		print_r($items);
		
		if(!empty($items))
		{
			$i = 0;
			foreach($items as $item)
			{
				$data = array(
					'positions' => $i,
				);
				
				$this->item->update($item,$data);
				
				$i++;
			}
		}
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
}