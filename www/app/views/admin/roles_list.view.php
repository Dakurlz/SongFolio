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
        <?php foreach($roles as $role):?>
            <tr>
                <td>
                    <?=$role['id']?>
                </td>
                <td>
                    <?=$role['name']?>
                </td>
                <td class="icn">
                    <a href="<?=Routing::getSlug('admin', 'rolesEdit').'?role='.$role['id']?>"><i class="icon icon-edit"></i></a>
                </td>
                <td class="icn">
                    <a class="cross cross-red" onClick="confirm('Voulez-vous vraiment supprimer ?')" href="<?=Routing::getSlug('admin', 'rolesDel').'?role='.$role['id']?>"></a>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
    <a href="<?=Routing::getSlug('admin', 'rolesAdd')?>" class="btn btn-success">+ Ajouter un menu</a>
</div>