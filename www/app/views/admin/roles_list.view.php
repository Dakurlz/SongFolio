<?php
use Songfolio\Core\Routing;
?>

<div class="container">
    <table>
        <?php foreach($roles as $role):?>
            <tr>
                <td>
                    <?=$role['id']?>
                </td>
                <td>
                    <?=$role['name']?>
                </td>
                <td>
                    <a href="<?=Routing::getSlug('admin', 'rolesEdit').'?role='.$role['id']?>">Modifier</a>
                </td>
                <td>
                    <a href="<?=Routing::getSlug('admin', 'rolesDel').'?role='.$role['id']?>" onClick="confirm('Voulez-vous vraiment supprimer ?')">Supprimer</a>
                </td>

            </tr>
        <?php endforeach;?>
    </table>
    <a href="<?=Routing::getSlug('admin', 'rolesAdd')?>" class="btn btn-success">+ Ajouter un menu</a>
</div>