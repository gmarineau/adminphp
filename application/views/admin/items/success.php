<h1>Elements</h1>

<p>L'élèment a été ajouté !</p>

<?php
if(isset($item)) {
?>
<div class="button"><a href="<?php echo site_url('admin/menus/view/'.$item->id_menus); ?>">retour</a></div>
<?php
} else {
?>
<div class="button"><a href="<?php echo site_url('admin/menus/view/'.$idItem); ?>">retour</a></div>
<?php
}
?>