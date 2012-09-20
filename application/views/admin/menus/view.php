<h1>Menus</h1>

<div class="button">
    <a href="<?php echo site_url('admin/items/add/'.$menu->id); ?>">Ajouter un élèment</a>
</div>

<div class="drop-bloc-large">
    <h2><?php echo $menu->menu; ?></h2>
    <ul class="drop menu" id="<?php echo $menu->id; ?>">
    <?php
    foreach($items as $item)
    {
        echo '<li id="itm_'.$item->id.'"><a href="'.site_url('admin/items/edit/'.$item->id).'">'.$item->item.'</a><a href="'.site_url('admin/items/delete/'.$item->id).'"><img src="'.base_url().'assets/img/icons/bin_closed.png" /></a></li>';
    }
    ?>
    </ul>
</div>