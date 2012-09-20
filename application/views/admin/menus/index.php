<h1>Menus</h1>

<div class="button">
    <a href="<?php echo site_url('admin/menus/add'); ?>">Ajouter un menu</a>
</div>

<?php
if(!empty($menus)):
?>
    <table>
        <tr class="header">
            <td>Menu</td>
            <td colspan="2"></td>
        </tr>
        <?php
        $i = 0;
        foreach($menus as $menu):
            if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
        ?>
                <td><a href="<?php echo site_url('admin/menus/view/'.$menu->id); ?>"><?php echo $menu->menu; ?></a></td>
                <td class="img"><a href="<?php echo site_url('admin/menus/edit/'.$menu->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/page_white_edit.png" /></a></td>
                <td class="img"><a href="<?php echo site_url('admin/menus/delete/'.$menu->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/bin_closed.png" /></a></td>
            </tr>
        <?php
            $i++;
        endforeach;
        ?>
    </table>
<?php
else:
?>
    <p class="empty">Pas de menu dans la base de données.</p>
<?php
endif;
?>