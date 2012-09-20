<h1>Utilisateurs</h1>
<?php

    $data = array(
        'name'=>'submit',
        'class'=>'btn-submit',
        'value'=>'Modifier'
    );
    
    echo form_open('admin/users/editpwd/'.$userid);
    echo form_label('Mot de passe : ','password').form_password('password');
    echo form_submit($data);
    echo form_close();


?>

<p class="button">
    <a href="<?php echo site_url('admin/users'); ?>">retour</a>
</p>