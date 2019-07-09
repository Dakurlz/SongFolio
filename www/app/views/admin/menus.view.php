<?php
use Songfolio\Core\Routing;
?>

<div class="container">
    <table>
        <?php foreach($menus as $menu):?>
            <tr>
                <td>
                    <?=$menu['id']?>
                </td>
                <td>
                    <?=$menu['title']?>
                </td>
                <td>
                    <a href="<?=Routing::getSlug('menus', 'menusEdit').'?menu='.$menu['id']?>">Modifier</a>
                </td>
                <td>
                    <a href="<?=Routing::getSlug('menus', 'menusDel').'?menu='.$menu['id']?>">Supprimer</a>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
    <a href="<?=Routing::getSlug('menus', 'menusAdd')?>" class="btn btn-success">+ Ajouter un menu</a>
</div>