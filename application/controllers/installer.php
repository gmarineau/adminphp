<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Installer extends CI_Controller {

    var $dsn;

    function __construct()
    {
	parent::__construct();
	$this->layout_installer->setTitle('AdminPHP - Installation du CMS');
    }
	
    function index()
    {
	$this->layout_installer->view('installer/index');
    }
	
    function step($action)
    {
	if($action == 2)            {
		$this->form_validation->set_rules('host','hôte','required');
		$this->form_validation->set_rules('usersql','utilsateur sql','required');
		$this->form_validation->set_rules('passwordsql','mot de passe sql','');
		$this->form_validation->set_rules('database','base de données','required');
		
		if(!$this->form_validation->run())
		    {
			$this->layout_installer->view('installer/step2');
		    }
		else
		    {
			$return = $this->connect($this->input->post('host'),$this->input->post('usersql'),$this->input->post('passwordsql'),$this->input->post('database'));
				
			if(!$return[0])
			    {
				$data['message'] = $return[1];
				$this->layout_installer->view('installer/step2',$data);
			    }
			else
			    {
				$newdata = array(
				    'host' => $this->input->post('host'),
				    'usersql' => $this->input->post('usersql'),
				    'passwordsql' => $this->input->post('passwordsql'),
				    'database' => $this->input->post('database'),
				);
					
				$passwordSql = $this->input->post('passwordsql');
				if(!empty($passwordSql))
				    {
					$dsn = 'mysql://'.$this->input->post('usersql').':'.$this->input->post('passwordsql').'@'.$this->input->post('host').'/'.$this->input->post('database');
				    }
				else
				    {
					$dsn = 'mysql://'.$this->input->post('usersql').'@'.$this->input->post('host').'/'.$this->input->post('database');
				    }
					
				set_cookie('dsn',$dsn,3600);
					
				$this->load->database($dsn);
				require 'application/config/cms.php';
					
				foreach($sql as $row)
				    {
					if(!mysql_query($row)) die(mysql_error());
				    }
					
				$this->load->library('session');
				$this->session->set_userdata($newdata);
				$this->layout_installer->view('installer/success2');	
			    }
		    }
	    }
	elseif($action == 3)
	    {
		$this->form_validation->set_rules('user','section','required');
		$this->form_validation->set_rules('password','section','required');
		
		if(!$this->form_validation->run())
		    {
			$this->layout_installer->view('installer/step3');
		    }
		else
		    {
			$dsn = get_cookie('dsn');
			$this->load->database($dsn);
			$data = array(
			    'login' => $this->input->post('user'),
			    'password' => sha1($this->input->post('password')),
			);
			$this->load->model('user');
			$this->user->save($data);
				
			$this->layout_installer->view('installer/success3');
		    } 
	    }
	elseif($action == 4)
	    {
		$this->form_validation->set_rules('namesite','nom du site','required');
		$this->form_validation->set_rules('webmaster','e-mail','required|valid_email');
		
		if(!$this->form_validation->run())
		    {
			$this->layout_installer->view('installer/step4');
		    }
		else
		    {
			$dsn = get_cookie('dsn');
			$this->load->database($dsn);
			$this->load->model('setting');
			$data = array(
			    'var' => 'namesite',
			    'param' => 'Nom du site',
			    'value' => $this->input->post('namesite'),
			);
			$this->setting->save($data);
			$data = array(
			    'var' => 'webmaster',
			    'param' => 'E-mail du webmaster',
			    'value' => $this->input->post('webmaster'),
			);
			$this->setting->save($data);
				
			$this->load->library('session');
			$host = $this->session->userdata('host');
			$usersql = $this->session->userdata('usersql');
			$passwordSql = $this->session->userdata('passwordsql');
			$database = $this->session->userdata('database');
				
			$data = "
				<?php \n
				\$config['hostname'] = '".$host."';\n
				\$config['username'] = '".$usersql."';\n
				\$config['password'] = '".$passwordSql."';\n
				\$config['database'] = '".$database."';\n
				?>";

									   if (!write_file('application/config/setting.php', $data))
									       {
										   echo 'Unable to write the file';
									       }
				
				$this->layout_installer->view('installer/success4');
		    } 
	    }
    }
	
    function connect($host,$user,$password,$database)
    {
        if($host != "" || $user != "" || $password != "") {               
            if(@mysql_connect($host,$user,$password)) {
                if(mysql_selectdb($database)) {
                    return 'AdminPHP est connecté à la base de données !';
                } else {
                    $return[] = false;
                    $return[] = 'La base de données est introuvable !';  
                }
            } else {
                $return[] = false;
                $return[] = 'Impossible de se connecter à MySQL !';
            }  
        } else {
            $return[] = false;
            $return[] = 'La configuration de la base de données est invalide !';
        }
		
	return $return;
    }
}