<h1>Utilisateurs</h1>
<?php

    $data = array(
        'name'=>'submit',
        'class'=>'btn-submit',
        'value'=>'Ajouter'
    );
    
    echo form_open('admin/users/add');
    echo form_label('Nom d\'utilisateur : ','login').form_input('login');
    echo form_label('Mot de passe : ','password').form_password('password');
    echo form_label('E-mail : ','email').form_input('email');
    echo form_submit($data);
    echo form_close();


?>

<p class="button">
    <a href="<?php echo site_url('admin/users'); ?>">retour</a>
</p>