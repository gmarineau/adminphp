<h1>Utilisateurs</h1>

<div class="button">
    <a href="<?php echo site_url('admin/users/add'); ?>">Ajouter un utilisateur</a>
</div>

<table>
    <tr class="header">
        <td>Login</td>
        <td>E-mail</td>
        <td colspan="3"></td>
    </tr>
    <?php
    $i = 0;
    foreach($users as $user)
    {
        if($i % 2) echo '<tr>'; else echo '<tr class="odd">';
    ?>
            <td><?php echo $user->login; ?></td>
            <td><?php echo $user->email; ?></td>
            <td class="img"><a href="<?php echo site_url('admin/users/editpwd/'.$user->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/key.png" /></a></td>
            <td class="img"><a href="<?php echo site_url('admin/users/edit/'.$user->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/user_edit.png" /></a></td>
            <td class="img"><a href="<?php echo site_url('admin/users/delete/'.$user->id); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/bin_closed.png" /></a></td>
        </tr>
    <?php
        $i++;
    }
    ?>
</table>