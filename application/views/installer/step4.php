<h1>Informations sur le site</h1>
<p>Les informations du site concernet le titre du site et l'email pour contacter le webmaster du site.</p>
<p>Ces options pourront être modifié dans la console d'administration du CMS.</p>

<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Envoyer',
);

echo form_open();
echo form_label('Nom du site : ','namesite').form_input('namesite',set_value('namesite'));
echo form_label('E-mail du webmaster : ','webmaster').form_input('webmaster',set_value('webmaster'));
echo form_submit($data);
echo form_close();

echo validation_errors('<p class="error">','</p>');
?>