<?php
use Songfolio\Core\Routing;
?>

<div class="admin_articles_liste">
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
                Publié
            </th>
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
                    <?= $articl['published'] === '0' ? 'Non' : 'Oui' ?>
                </td>
                <td class="icn"><a href='<?= Routing::getSlug("Contents", "update") . "?id=" . $articl['id']?>'><i class="icon icon-edit"></i></a></td>
                <td class="icn"><a href='<?= Routing::getSlug("Contents", "delete") . "?id=" . $articl['id']?>'><i class="icon icon-delete"></i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
