<?php
use Songfolio\Core\Routing;
?>

<div class="container">
    <table class="admin-users__main__table table">
        <thead>
        <tr>
            <th>ID #</th>
            <th>Nom</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($menus as $menu):?>
            <tr>
                <td>
                    <?=$menu['id']?>
                </td>
                <td>
                    <?=$menu['title']?>
                </td>
                <td class="icn">
                    <a href="<?=Routing::getSlug('menus', 'menusEdit').'?menu='.$menu['id']?>"><i class="icon icon-edit"></i></a>
                </td>
                <td class="icn">
                    <a class="cross cross-red" href="<?=Routing::getSlug('menus', 'menusDel').'?menu='.$menu['id']?>"></a>
                </td>

            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <a href="<?=Routing::getSlug('menus', 'menusAdd')?>" class="btn btn-success">+ Ajouter un menu</a>
</div>