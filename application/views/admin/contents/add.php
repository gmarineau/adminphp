<h1>Contenus</h1>
<?php
$data = array(
    'name' => 'submit',
    'class' => 'btn-submit',
    'value' => 'Ajouter'
);

$dataText = array(
    'name' => 'content',
    'id' => 'editor',
);

echo form_open('admin/contents/add');
echo form_label('Titre : ','title').form_input('title');
echo form_label('Contenu : ','content').form_textarea($dataText);
echo form_label('Code PHP : ','phpcode').form_textarea('phpcode');
echo form_submit($data);
echo form_close();

echo validation_errors();
?>

<div class="button">
    <a href="<?php echo site_url('admin/contents'); ?>">retour</a>
</div>

<script type="text/javascript">
    $().ready(function() {

		$('textarea#editor').tinymce({
            // Location of TinyMCE script
            script_url : '<?php echo base_url(); ?>assets/js/tiny_mce/tiny_mce.js',
    
            // General options
            theme : "advanced",
            plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
    
            // Theme options
            theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,link,unlink,anchor,image,code,|,forecolor,backcolor",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "",
            theme_advanced_resizing : false,
    
            // Example content CSS (should be your site CSS)
            content_css : "css/content.css",
        });

	});

</script>