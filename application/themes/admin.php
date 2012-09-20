<!DOCTYPE html> 
<html lang="fr">
	
	<head>
		
		<title><?php echo $title; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/admin.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" />
        
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tiny_mce/jquery.tinymce.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin.js"></script>

		
    
	</head>

	<body>
		
		<div id="wrapper">
			
			<div id="header">
				<h1 class="header"><a href="<?php echo site_url('admin'); ?>"><span class="admin">Admin</span><span class="php">PHP</span></a></h1>
				<div class="header-top">
					<?php echo date('d/m/Y - H:i'); ?><br />
					<?php echo $_SERVER['HTTP_HOST']; ?>
				</div>	
			</div>
				
			<div id="menu">
				
				<ul class="navigation">
					<?php
						$menu = $this->uri->segment(2);
					?>
					<li class="<?php if($menu == 'pages') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/pages">Pages</a></li>
					<li class="<?php if($menu == 'sections') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/sections">Sections</a></li>
					<li class="<?php if($menu == 'menus') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/menus">Menus</a></li>
					<li class="<?php if($menu == 'displays') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/displays">Affichages</a></li>
					<li class="<?php if($menu == 'contents') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/contents">Contenus</a></li>
					<li class="<?php if($menu == 'users') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/users">Utilisateurs</a></li>
					<li class="<?php if($menu == 'modules') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/modules">Modules</a></li>
					<li class="<?php if($menu == 'settings') echo 'on'; ?>"><a href="<?php echo base_url(); ?>admin/settings">Parametres</a></li>
					<li><a href="<?php echo base_url(); ?>admin/users/logout">Logout</a></li>
				</ul>
			
			</div>
			
			<div id="content">
				
				<div class="content">
				<?php echo $output; ?>
				</div>
			
			</div>
			
			<div id="footer">
				<div class="footer">
					<p><span class="admin">Admin</span><span class="php">PHP</span> - Version Beta - <?php echo 'Execution time : '.$this->benchmark->elapsed_time().' secondes'; ?></p>
				</div>
			</div>
			
			<div id="copyright">
				Powered by <span class="pod">Pod</span>Prod - Licence GNU - <?php echo date('Y'); ?>
			</div>
		
		</div>
		
	</body>

</html>