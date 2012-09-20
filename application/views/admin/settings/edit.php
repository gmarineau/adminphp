<h1>Paramètres</h1>

<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Modifier'
);

echo form_open('admin/settings/edit/'.$setting->id);
    echo form_label('Paramètre : ','param').form_input('param',$setting->param);
    echo form_label('Valeur : ','value').form_input('value',$setting->value);
    echo form_submit($data);
echo form_close();

?>

<div class="button"><a href="<?php echo site_url('admin/settings'); ?>">retour</a></div>