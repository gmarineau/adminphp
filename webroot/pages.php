<!DOCTYPE html>
<html lang="fr">

<head>

	<meta http-equiv="content-language" content="fr">	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<title><?php echo $namesite.' - '.$namepage; ?></title>	
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>webroot/css/style.css" />
	
</head>

<body>

<div id="wrapper">
	
	<div id="header">
    
		<?php if(!empty($header)) echo $header; ?>
	
	</div>
	
	<div id="menu">
	
		<?php if(!empty($menu)) echo $menu; ?>
		
	</div>

	<div id="content">
	
		<?php if(!empty($content)) echo $content; ?>
		
	</div>

	<div id="footer">
	
		<?php if(!empty($footer)) echo $footer; ?>
	
	</div>

</div>

</body>

</html>