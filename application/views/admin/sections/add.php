<h1>Sections</h1>
<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Ajouter'
);

echo form_open('admin/sections/add');
echo form_label('Section : ','section').form_input('section');
echo form_submit($data);
echo form_close();

?>

<div class="button">
    <a href="<?php echo site_url('admin/sections'); ?>">retour</a>
</div>