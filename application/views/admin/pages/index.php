<h1>Pages</h1>

<div class="button">
    <a href="<?php echo site_url('admin/pages/add'); ?>">Ajouter une page</a>
</div>

<?php
if(!empty($pages)):
?>
    <table>
        <tr class="header">
            <td>Page</td>
            <td>Url</td>
            <td colspan="2"></td>
        </tr>
        <?php
        $i = 0;
        foreach($pages as $page):
            if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
        ?>
                <td><a href="<?php echo site_url('admin/pages/view/'.$page->id); ?>"><?php echo $page->title; ?></a></td>
                <td><?php echo $page->url; ?></td>
                <td class="img"><a href="<?php echo site_url('admin/pages/edit/'.$page->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/page_white_edit.png" /></a></td>
                <td class="img"><a href="<?php echo site_url('admin/pages/delete/'.$page->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/bin_closed.png" /></a></td>
            </tr>
        <?php
            $i++;
        endforeach;
        ?>
    </table>
<?php
else:
?>
    <p class="empty">Pas de page dans la base de données.</p>
<?php
endif;
?>