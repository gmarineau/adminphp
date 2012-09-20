<!DOCTYPE html>
<html lang="fr">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<title><?php echo $title; ?></title>	
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/installer.css" />
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon" />
	
</head>

<body>
    
    <div id="wrapper">
    
        <div id="header">
            
            <h1 class="header"><span class="admin">Admin</span>PHP</h1>
            
        </div>
    
        <div id="content">
            
            <div class="content">
        
                <?php echo $output; ?>
            
            </div>
            
        </div>

    </div>

</body>

</html>