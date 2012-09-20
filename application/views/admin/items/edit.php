<h1>Elements</h1>
<?php

$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Modifier',
);

echo form_open('admin/items/edit/'.$item->id);
echo form_label('Element : ','item').form_input('item',$item->item);
echo form_label('Url : ','url').form_input('url',$item->url);
echo form_submit($data);
echo form_close();

echo validation_errors();

?>

<p class="button">
    <a href="<?php echo site_url('admin/menus/view/'.$item->id_menus); ?>">retour</a>
</p>