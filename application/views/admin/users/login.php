<!DOCTYPE html> 
<html lang="fr">
	
	<head>
		<title>AdminPHP - Connexion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/admin.css" />
		
    </head>
    
    <body>
        
        <div id="login-box">
        
			<h1 class="login"><span class="admin">Admin</span>PHP - The Powerful CMS</h1>
			<?php
				$data = array('name'=>'submit',
					'class'=>'btn-submit',
					'value'=>'Se connecter');
			
				echo form_open('admin/users/login',array('class' => 'form-login'));
					echo form_label('Nom d\'utilisateur : ','login').'<span class="form-login"></span>';
					echo form_input(array('name'=>'login','id'=>'login'),set_value('login'));
					echo form_label('Mot de passe : ','password').'<span class="form-password"></span>';
					echo form_password(array('name'=>'password','id'=>'password'));
					echo form_submit(array('name'=>'submit','value'=>'Se connecter','class'=>'btn-submit'));
				echo form_close();
			?>

			<div class="form-error"><?php echo validation_errors(); if(isset($message)) echo $message; ?></div>
        </div>
    </body>
</html> 