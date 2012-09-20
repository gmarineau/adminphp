<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

	<meta name="description" content="WeSearch.ch - Site de petites annonces gratuite en Suisse." />
	<meta http-equiv="content-language" content="fr">	
	<meta name="google-site-verification" content="AXll3RIWzaWkzB5_ZJDQluwfL2q0D9zQgL8XsPtgnHY" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<title><?php echo $title; ?></title>	
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/facebox.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/style.css" />
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon" />
	
		
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tools.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.password.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.imgcenter.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/facebox.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
		
	<script type="text/javascript">
	
		/*var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2865091-17']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();*/
	
	</script>
	
</head>

<body>

<div id="wrapper">

	<div id="header">

		<h1><a href="<?php echo base_url(); ?>"><span class="we">We</span><span class="search">Search</span></a></h1>

		<?php $member = $this->session->userdata('member'); ?>

		<div id="header-top">
	
			<ul class="menu-header-top">
			<?php if(empty($member)): ?>
				<li><a href="<?php echo site_url('members/add'); ?>" rel="facebox">Nouveau membre</a></li>
				<li><span class="search">|</span></li>	
				<li> <a href="<?php echo site_url('members/login'); ?>" rel="facebox">Se connecter</a></li>
				<?php else: ?>
				<li><a href="<?php echo site_url('classifieds/member/'.$this->session->userdata('id_member')); ?>">Voir mon profil</a></li>
				<li>|</li>	
				<li> <a href="<?php echo site_url('members/logout'); ?>">Se déconnecter</a></li>
			<?php endif; ?>
			</ul>
		
		</div>

	</div>

	<div id="content">
	
		<div id="navigation" class="margin-bottom">
			<div class="list-rubric"><a href="<?php echo site_url('rubrics'); ?>" rel="facebox">Liste des rubriques</a></div>
			<div class="info-path"><?php echo $this->session->userdata('pathRubric'); ?></div>
			<?php
			if(!empty($member) && $this->uri->segment(1) == 'classifieds' && $this->uri->segment(2) == 'view' && is_numeric($this->uri->segment(3))):
			?>
				<div class="insert"><a href="<?php echo site_url('categories/index/'.$this->uri->segment(3)); ?>" rel="facebox">Ajouter une annonce</a></div>
			<?php
			else:
			?>
				<div class="insert"><a href="<?php echo site_url('categories/index/'.$this->uri->segment(3)); ?>" rel="facebox">Ajouter une annonce</a></div>
			<?php
			endif;
			?>
		</div>
		
		<?php echo $output; ?>
		
	</div>

	<div id="footer">
		<p><span class="we">We</span><span class="search">Search</span> | <a href="<?php echo site_url('pages/tarifs'); ?>">Tarifs</a> | <a href="<?php echo site_url('pages/conditions'); ?>">Conditions générale</a> | <a href="<?php echo site_url('pages/credits'); ?>">Crédits</a> | <a href="<?php echo site_url('pages/contact'); ?>">Contact</a></p>
		<p>Petites annonces gratuites en Suisse | Service powered by : <a href="http://podprod.com"><span class="pod">pod</span><span class="prod">prod</span></a></p>
	</div>

</div>

</body>

</html>