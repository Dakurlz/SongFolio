<?php
use Songfolio\Core\Routing;
use Songfolio\Core\Helper;

?>

<div class="admin-articles-liste">

    <?php
        if (isset($alert)) $this->addModal('alert', $alert);
    ?>

    <h2 class="col-12">Liste des articles</h2>
    <?php if (empty($articles)): ?>
        <a style="margin-bottom: 20px" class="btn btn-success-outline" role="button"   href="<?= Routing::getSlug('Contents', 'createContents') ?>">Ajouter le contenue</a>
    <?php endif;?>

    <table class="table col-12 ">
        <thead>
        <tr>
            <th>
                Titre
            </th>
            <th>
                Categorie
            </th>
            <th>
                Lien permanent
            </th>
            <th>
                Publié
            </th>
            <th>
                Commentaire
            </th>
            <th>
                Date
            </th>
            <th>
                Modifié
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <td><?php if (empty($articles)) echo 'Aucune page.'; ?></td>
        <?php foreach ($articles as $articl):  ?>
            <tr>
                <td>
                    <?= $articl['title'] ?>
                </td>
                <td>
                    <?= Helper::searchInArray($categories, $articl['category_id'],'name') ?>
                </td>
                <td>
                    <a href="<?= BASE_URL.$articl['slug'] ?>">/<?= $articl['slug'] ?></a>
                </td>
                <td>
                    <?= $articl['published'] === '0' ? 'Non' : 'Oui' ?>
                </td>
                <td>
                    <?= $articl['comment_active'] === '0' ? 'Non' : 'Oui' ?>
                </td>
                <td>
                    <?= Helper::getFormatedDate($articl['date_create']) ?>
                </td>
                <td>
                    <?= Helper::getFormatedDate($articl['date_edit']) ?? ' ' ?>
                </td>
                <td class="icn"><button style="background: transparent; border: transparent" role="button" modal="menu-<?= $articl['id'] ?>-modal"><i class="icon icon-contents"></i></button></td>
                <td class="icn"><a href='<?= Routing::getSlug("Contents", "update") . "?id=" . $articl['id']?>'><i class="icon icon-edit"></i></a></td>
                <td class="icn"><a href='<?= Routing::getSlug("Contents", "delete") . "?id=" . $articl['id']."&type=article"?>'><i class="icon icon-delete"></i></a></td>
            </tr>

            <div id="menu-<?= $articl['id'] ?>-modal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close"></span>
                    <h2>
                        <?= $articl['title'] ?>
                    </h2>
                    <hr>
                    <?php if( isset($articl['img_dir'])) : ?>
                        <h2>Image</h2>
                        <img src="<?= BASE_URL . $articl['img_dir']  ?>"   />
                        <hr>
                    <?php endif; ?>
                    <div class="form-group">
                            <?= $articl['content'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
