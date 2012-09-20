<h1>Contenus</h1>

<div class="button">
    <a href="<?php echo site_url('admin/contents/add'); ?>">Ajouter un contenu</a>
</div>
<?php
if(!empty($contents)):
?>
    <table>
        <tr class="header">
            <td>Date</td>
            <td>Titre</td>
            <td colspan="2"></td>
        </tr>
    <?php
    $i = 0;
    foreach($contents as $content):
        if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
    ?>
            <td><?php echo date('d/m/Y',$content->date); ?></td>
            <td><?php echo $content->title; ?></td>
            <td class="img"><a href="<?php echo site_url('admin/contents/edit/'.$content->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/page_white_edit.png" /></a></td>
            <td class="img"><a href="<?php echo site_url('admin/contents/delete/'.$content->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/bin_closed.png" /></a></td>
        </tr>
        </tr>
    <?php
        $i++;
    endforeach;
    ?>
    </table>
<?php
else:
?>
    <p class="empty">Pas de contenu dans la base de données.</p>
<?php
endif;
?>