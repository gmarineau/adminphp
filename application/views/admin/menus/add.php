<h1>Pages</h1>
<?php

$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Ajouter',
);

echo form_open('admin/menus/add');
echo form_label('Menu : ','menu').form_input('menu',set_value('menu'));
echo form_submit($data);
echo form_close();

echo validation_errors();

?>

<p class="button">
    <a href="<?php echo site_url('admin/menus'); ?>">retour</a>
</p>