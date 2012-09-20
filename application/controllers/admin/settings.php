<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$sessionId = $this->session->userdata('user_id');
        if(isset($sessionId) && empty($sessionId)) echo header('Location:'.site_url('admin/users/login'));
		$this->load->model('setting');
		$this->layout_admin->setTitle('AdminPHP - Paramètres');
	}
	
	function index()
	{
        $data['settings'] = $this->setting->getSettings();
		$this->layout_admin->view('admin/settings/index',$data);
    }
    
    function edit($idSetting)
    {
        $data['setting'] = current($this->setting->getSetting('id',$idSetting));
        $this->form_validation->set_rules('param','paramètre','required');
		$this->form_validation->set_rules('value','valeur','required');
		
		if(!$this->form_validation->run())
		{
			$this->layout_admin->view('admin/settings/edit',$data);
		}
		else
		{
			$data = array(
				'param' => $this->input->post('param'),
				'value' => $this->input->post('value'),
			);
			
			$this->setting->update($idSetting,$data);
			$this->layout_admin->view('admin/settings/success');
		} 
    }
}