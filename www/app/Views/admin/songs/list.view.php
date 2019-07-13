<?php

use Songfolio\Core\Routing;
use Songfolio\Core\Helper;
use Songfolio\Models\Users;

?>


<div class="admin-songs-list">
    <h2 class="col-12">Liste des moreaux</h2>
    <?php if (empty($listSongs)) : ?>
        <a style="margin-bottom: 20px" class="btn btn-success-outline" role="button" href="<?= Routing::getSlug('Songs', 'create') ?>">Ajouter un morceau</a>
    <?php endif; ?>

    <div style="margin-bottom: 25px" class="col-12 col-lg-6 col-md-6 col-sm-6">
        <input  class="input-control input-control-success input-search" placeholder="Chercher un morceau" />
    </div>

    <table class="table col-12 ">
        <thead>
            <tr>
                <th>
                    Titre
                </th>
                <th>
                    Album
                </th>

                <th>
                    Lien permanent
                </th>
                <th>
                    Date de publication
                </th>

                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody class="tbody">
            <td><?php if (empty($listSongs)) echo 'Aucun album.'; ?></td>
            <?php foreach ($listSongs as $song) :  ?>
                <tr>
                    <td>
                        <?= $song['name'] ?>
                    </td>
                    <td>
                        <?= Helper::searchInArray($albums, $song['album_id'], 'title') ?>
                    </td>
                    <td>
                        <a href="<?=Helper::host() . $song['slug'] ?>">/<?= $song['slug'] ?></a>
                    </td>
                    <td>
                        <?= Helper::getFormatedDateWithTime($song['date_published']) ?>
                    </td>
                    <td class="icn"><button style="background: transparent; border: transparent" role="button" modal="menu-<?= $song['id'] ?>-modal"><i class="icon icon-contents"></i></button></td>

                    <?php if (Users::hasPermission('album_edit')) : ?>
                        <td class="icn"><a href='<?= Routing::getSlug("Songs", "update") . "?id=" . $song['id'] ?>'><i class="icon icon-edit"></i></a></td>
                    <?php endif;
                    if (Users::hasPermission('album_del')) : ?>
                        <td class="icn"><a class="cross cross-red" href='<?= Routing::getSlug("Songs", "delete") . "?id=" . $song['id'] ?>'></a></td>
                    <?php endif; ?>
                </tr>

                <div id="menu-<?= $song['id'] ?>-modal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close"></span>
                        <h3>
                            Parole
                        </h3>
                        <p>
                            <?= $song['text'] ?>
                        </p>
                    </div>
                </div>


            <?php endforeach; ?>
        </tbody>
    </table>

</div>