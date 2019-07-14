<?php
use Songfolio\Core\Helper;
use Songfolio\Core\Routing;

?>

<div class="comments-lists">

    <h2 class="col-12">Confirmation des commentaires</h2>

    <div style="margin-bottom: 25px" class="col-12 col-lg-6 col-md-6 col-sm-6">
            <input  class="input-control input-control-success input-search" placeholder="Chercher commentaire" />
    </div>


    <table class="table col-12 ">
        <thead>
            <tr>
                <th>Type</th>
                <th>Utilisateur</th>
                <th>Message</th>
                <th>Crétion</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="tbody">
        <td><?php if (empty($comments)) echo 'Aucun commentaire.'; ?></td>
        <?php foreach ($comments as $comment) : ?>

            <tr>
                <td><?= Helper::getLabelFromMapping($comment['type']); ?></td>
                <td><?= $comment['user_name'] ?></td>
                <td><?= $comment['message'] ?></td>
                <td><?= Helper::getFormatedDateWithTime($comment['date_created']) ?></td>

                <td class="icn"><a class="check check-green" href='<?= Routing::getSlug("Comments", "confirm") . "?id=" . $comment['id'] ?>'></a></td>
                <td  class="icn"><a class="cross cross-red" href='<?= Routing::getSlug("Comments", "refuse") . "?id=" . $comment['id'] ?>'></a></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

