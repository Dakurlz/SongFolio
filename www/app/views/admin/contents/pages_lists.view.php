<?php
    use Songfolio\Core\Routing;
    use Songfolio\Core\Helper;

?>

<div class="admin_pages_liste">
<?php
    if (isset($alert)) $this->addModal('alert', $alert);
?>
    <h2 class="col-12">Liste de pages</h2>
    <?php if (empty($pages)): ?>
        <a style="margin-bottom: 20px" class="btn btn-success-outline" role="button"   href="<?= Routing::getSlug('Contents', 'createContents') ?>">Ajouter le contenue</a>
    <?php endif;?>
    <table class="table col-12 ">
    <thead>
        <tr>
            <th>
                Titre
            </th>
            <th>
                Lien permanent
            </th>
            <th>
                Publié
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
        <td><?php if (empty($pages)) echo 'Aucune page.'; ?></td>
            <?php foreach ($pages as $page):  ?>
                <tr>
                    <td>
                        <?= $page['title'] ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL.$page['slug'] ?>">/<?= $page['slug'] ?></a>
                    </td>
                    <td>
                        <?= $page['published'] === '0' ? 'Non' : 'Oui' ?>
                    </td>
                    <td>
                        <?= Helper::getFormatedDate($page['date_create']) ?>
                    </td>
                    <td>
                        <?= Helper::getFormatedDate($page['date_edit']) ?? ' ' ?>
                    </td>
                    <td class="icn"><button style="background: transparent; border: transparent" role="button" modal="menu-<?= $page['id'] ?>-modal"><i class="icon icon-contents"></i></button></td>
                    <td class="icn"><a href='<?= Routing::getSlug("Contents", "update") . "?id=" . $page['id']?>'><i class="icon icon-edit"></i></a></td>
                    <td class="icn"><a href='<?= Routing::getSlug("Contents", "delete") . "?id=" . $page['id']."&type=page"?>'><i class="icon icon-delete"></i></a></td>
                </tr>

                <div id="menu-<?= $page['id'] ?>-modal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close"></span>
                        <h2>
                            <?= $page['title'] ?>
                        </h2>
                        <hr>
                        <?php if( isset($page['img_dir'])) : ?>
                            <h2>Image</h2>
                            <img src="<?= BASE_URL . $page['img_dir']  ?>"   />
                            <hr>
                        <?php endif; ?>
                        <div class="form-group">
                            <?= $page['content'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
