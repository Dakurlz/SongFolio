<?php
    debug($comments);
use Songfolio\Core\Helper;
use Songfolio\Core\Routing;

?>

<div class="comments-lists">
    <?php
        if (isset($alert)) $this->addModal('alert', $alert);
    ?>

    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>User</th>
                <th>User</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <td><?php if (empty($comments)) echo 'Aucun commentaire.'; ?></td>
        <?php foreach ($comments as $comment) : ?>

            <tr>
                <td><?= Helper::getLabelFromMapping($comment['type']); ?></td>
                <td><?= $comment['user'] ?></td>

                <td class="icn"><a href='<?= Routing::getSlug("Categories", "update") . "?id=" . $comment['id'] ?>'><i class="icon icon-edit"></i></a></td>
                <td class="icn"><a href='<?= Routing::getSlug("Categories", "delete") . "?id=" . $comment['id'] ?>'><i class="icon icon-delete"></i></a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

