<h1>Contenus</h1>
<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Modifier'
);

$dataText = array(
    'name' => 'content',
    'id' => 'editor',
);

echo form_open('admin/contents/edit/'.$content->id);
echo form_label('Titre : ','title').form_input('title',$content->title);
echo form_label('Contenu : ','content').form_textarea($dataText,$content->content);
echo form_submit($data);
echo form_close();

echo validation_errors();
?>

<div class="button">
    <a href="<?php echo site_url('admin/contents'); ?>">retour</a>
</div>

<script type="text/javascript">
    bkLib.onDomLoaded(function() {
        new nicEditor({fullPanel : true}).panelInstance('editor');
    });
</script>