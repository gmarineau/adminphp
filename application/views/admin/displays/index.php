<h1>Affichages</h1>

<?php
if(!empty($pages)):
?>
    <table>
        <tr class="header">
            <td>Page</td>
        </tr>
        <?php
        $i = 0;
        foreach($pages as $page):
            if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
        ?>
                <td><a href="<?php echo site_url('admin/displays/view/'.$page->id); ?>"><?php echo $page->title; ?></a></td>
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