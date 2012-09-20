<h1>Elements</h1>
<?php

$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Ajouter',
);

echo form_open('admin/items/add/'.$idItem);
echo form_label('Element : ','item').form_input('item',set_value('item'));
echo form_label('Url : ','url').form_input('url',set_value('url'));
echo form_submit($data);
echo form_close();

echo validation_errors();

?>

<p class="button">
    <a href="<?php echo site_url('admin/items/'.$idItem); ?>">retour</a>
</p>