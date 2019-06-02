<?php

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
use Songfolio\Models\Users;

?>
<div class="col-12 admin-users ">

    <h2 class="col-12">Liste des utilisateurs</h2>

    <?php
        if (isset($alert)) $this->addModal('alert', $alert);
    ?>
    <div class="admin-users__main">

        <div style="margin-top: 0" class="admin-users__main__search-add-user">
            <div class="admin-users__main__search-add-user__search">
                <input  class="input-control input-control-success admin-users__main__search-add-user__search__input input-search" placeholder="Chercher utilisateur" />
            </div>
            <a href="<?= Routing::getSlug('Users', 'createUsers')?>" class="btn btn-success-outline admin-users__main__search-add-user__add-user">Ajouter utilisatuer</a>
        </div>
        <table class="admin-users__main__table table">
            <thead role="rowgroup">
            <tr role="row">
                <th>Nom</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Rejoint</th>
                <th>Modifié</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody class="tbody" role="rowgroup">
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['first_name'] ?? '---' ?> <?= $user['last_name']; ?></td>
                        <td><?= $user['username'];  ?></td>
                        <td><?= $user['email'];  ?></td>
                        <td><?= Helper::searchInArray($roles, $user['role_id'], 'name')  ?></td>
                        <td><?= Helper::getFormatedDate($user['date_inserted']) ?></td>
                        <td><?= Helper::getFormatedDate($user['date_update']) ?></td>

                        <?php if( Users::hasPermission('user_edit') ): ?>
                            <td class="icn"><a href='<?= Routing::getSlug("Users", "update") . "?id=" . $user['id'] ?>'><i class="icon icon-edit"></i></a></td>
                        <?php endif; if( Users::hasPermission('user_del') ): ?>
                            <td class="icn"><a class="cross cross-red" href='<?= Routing::getSlug("Users", "delete") . "?id=" . $user['id'] ?>'></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <td>Aucun utilisateur.</td>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

