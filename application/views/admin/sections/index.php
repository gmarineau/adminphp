<h1>Sections</h1>

<div class="button">
    <a href="<?php echo site_url('admin/sections/add'); ?>">Ajouter une section</a>
</div>

<?php
if(!empty($sections)):
?>
    <table>
        <tr class="header">
            <td>Section</td>
            <td colspan="2"></td>
        </tr>
    <?php
    $i = 0;
    foreach($sections as $section):
        if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
    ?>
            <td><?php echo $section->section; ?></td>
            <td class="img"><a href="<?php echo site_url('admin/sections/edit/'.$section->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/page_white_edit.png" /></a></td>
            <td class="img"><a href="<?php echo site_url('admin/sections/delete/'.$section->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/bin_closed.png" /></a></td>
        </tr>
    <?php
        $i++;
    endforeach;
    ?>
    </table>
<?php
else:
?>
    <p class="empty">Pas de section dans la base de données.</p>
<?php
endif;
?>