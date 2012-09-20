<h1>Pages</h1>
<?php

$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Ajouter',
);

echo form_open('admin/pages/add');
echo form_label('Titre : ','title').form_input('title');
echo form_label('Url : ','url').form_input('url');
echo form_submit($data);
echo form_close();

echo validation_errors();

?>

<p class="button">
    <a href="<?php echo site_url('admin/pages'); ?>">retour</a>
</p>