<?php
use Songfolio\Core\Routing;
use Songfolio\Core\Helper;
use Songfolio\Models\Users;

?>

<div class="admin-events-list">
    <?php
    if (isset($alert)) $this->addModal('alert', $alert);
    ?>

    <h2 class="col-12">Liste des albums</h2>
    <?php if (empty($listAlbums)) : ?>
        <a style="margin-bottom: 20px" class="btn btn-success-outline" role="button" href="<?= Routing::getSlug('Album', 'createAlbum') ?>">Ajouter un album</a>
    <?php endif; ?>

    <table class="table col-12 ">
        <thead>
            <tr>
                <th>
                    Titre
                </th>
                <th>
                    Type
                </th>

                <th>
                    Lien permanent
                </th>
                <th>
                    Date de publication
                </th>

                <!-- <th></th> -->
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <td><?php if (empty($listAlbums)) echo 'Aucun album.'; ?></td>
            <?php foreach ($listAlbums as $album) :  ?>
                <tr>
                    <td>
                        <?= $album['title'] ?>
                    </td>
                    <td>
                        <?= Helper::searchInArray($categories, $album['category_id'], 'name') ?>
                    </td>
                    <td>
                        <?= Helper::getFormatedDateWithTime($album['date_published']) ?>
                    </td>


                    <td>
                        <a href="<?= BASE_URL . $album['slug'] ?>">/<?= $album['slug'] ?></a>
                    </td>

                    <!-- <td class="icn"><button style="background: transparent; border: transparent" role="button" modal="menu-<?= $event['id'] ?>-modal"><i class="icon icon-contents"></i></button></td> -->
                    <?php if (Users::hasPermission('album_edit')) : ?>
                        <td class="icn"><a href='<?= Routing::getSlug("Albums", "update") . "?id=" . $event['id'] ?>'><i class="icon icon-edit"></i></a></td>
                    <?php endif;
                if (Users::hasPermission('album_del')) : ?>
                        <td class="icn"><a class="cross cross-red" href='<?= Routing::getSlug("Albums", "delete") . "?id=" . $event['id'] ?>'></a></td>
                    <?php endif; ?>
                </tr>

                <div id="menu-<?= $album['id'] ?>-modal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close"></span>
                        <h3>
                            <?= $album['title'] ?>
                        </h3>
                        <hr>
                        <?php if (isset($event['cover_dir'])) : ?>
                            <img src="<?= BASE_URL . $album['cover_dir']  ?>" />
                            <hr>
                        <?php endif; ?>

                        <div class="form-group">
                            <h2>Prix: <?= $album['rate'] ?> €</h2>
                        </div>
                        <hr>

                        <div class="form-group">
                            <h2><?= $album['nbr_place'] ?> place</h2>
                        </div>

                        <hr>

                        <div class="form-group">
                            <a href="<?= BASE_URL . $album['slug'] ?>">/<?= $album['slug'] ?></a>
                        </div>

                        <hr>

                        <div class="form-group">
                            <?= $event['details'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>