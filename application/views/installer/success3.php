<h1>Administrateur du site</h1>
<p class="valid">L'utilisateur a été ajouté !</p>
<p class="step"><a href="<?php echo site_url('installer/step/4'); ?>">&Eacute;tape suivante »</a></p>

<?php
/*$database = unserialize($_SESSION['database']);

$handle = fopen("ini/config.php", "r+");
fwrite($handle,"<?php \n");
fwrite($handle,"\$conf['db_host'] = '".$database->getHost()."';\n");
fwrite($handle,"\$conf['db_user'] = '".$database->getUser()."';\n");
fwrite($handle,"\$conf['db_password'] = '".$database->getPassword()."';\n");
fwrite($handle,"\$conf['db_name'] = '".$database->getDatabase()."';\n");
fwrite($handle,"\$conf['pagination'] = 20;\n");
fwrite($handle,"?>\n");
fclose($handle);*/
?>