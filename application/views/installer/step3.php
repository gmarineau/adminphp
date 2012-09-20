<h1>Administrateur du site</h1>
<p>L'administrateur du site est la personne qui pourra gérer l'ensemble du CMS, par exemple ajouter une page de contenu.</p>
<p>Vous aurez la possibilité d'ajouter d'autre utilisateur depuis la console d'administration du CMS.</p>

<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Envoyer',
);

echo form_open();
echo form_label('Administrateur : ','user').form_input('user',set_value('user'));
echo form_label('Mot de passe : ','password').form_password('password');
echo form_submit($data);
echo form_close();

echo validation_errors('<p class="error">','</p>');
?>