<h1>Base de données</h1>
<p>Dans cette étape vous allez devoir fournir les informations pour vous connecter à une base de données MySQL.</p>
<p>La base de données que vous allez ajouter dans ce formulaire doit être crée dans MySQL, une erreur vous indiquera si cette base de données n'existe pas.</p>

<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Envoyer',
);

echo form_open();
echo form_label('Hôte : ','host').form_input('host',set_value('host'));
echo form_label('Utilisateur SQL : ','usersql').form_input('usersql',set_value('usersql'));
echo form_label('Mot de passe : ','passwordsql').form_password('passwordsql');
echo form_label('Base de données : ','database').form_input('database',set_value('database'));
echo form_submit($data);
echo form_close();

echo validation_errors('<p class="error">','</p>');
if(!empty($message)) echo '<p class="error">'.$message.'</p>';
?>