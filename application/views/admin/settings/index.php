<h1>Paramètres</h1>

<?php
if(!empty($settings)):
?>
    <table>
        <tr class="header">
            <td>Paramètre</td>
            <td>Valeur</td>
            <td></td>
        </tr>
        <?php
        $i = 0;
        foreach($settings as $setting)
        {
            if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
        ?>
                <td><?php echo $setting->param; ?></td>
                <td><?php echo $setting->value; ?></td>
                <td class="img"><a href="<?php echo site_url('admin/settings/edit/'.$setting->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/cog_edit.png"></a></td>
            </tr>
        <?php
            $i++;
        }
        ?>
        
    </table>
<?php
else:
?>
    <p class="empty">Pas de paramètre dans la base de données</p>
<?php
endif;
?>