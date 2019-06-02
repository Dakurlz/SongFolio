<?php
use Songfolio\Core\Routing;
use Songfolio\Core\Helper;
use Songfolio\Models\Users;

?>

<div class="admin-events-list">
    <?php
        if (isset($alert)) $this->addModal('alert', $alert);
    ?>

    <h2 class="col-12">Liste des événements</h2>
    <?php if (empty($listEvents)): ?>
        <a style="margin-bottom: 20px" class="btn btn-success-outline" role="button"   href="<?= Routing::getSlug('Events', 'createEvents') ?>">Ajouter un événement</a>
    <?php endif;?>

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
                    Date de debut
                </th>
                <th>
                    Date de fin
                </th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
                <td><?php if (empty($listEvents)) echo 'Aucun événement.'; ?></td>
                <?php foreach ($listEvents as $event):  ?>
                    <tr>
                        <td>
                            <?= $event['displayName'] ?>
                        </td>
                        <td>
                            <?= Helper::searchInArray($categories, $event['type'],'name') ?>
                        </td>
                        <td>
                            <?= Helper::getFormatedDateWithTime($event['start_date']) ?>
                        </td>
                        <td>
                            <?= Helper::getFormatedDateWithTime($event['end_date']) ?>
                        </td>
             
                        <td class="icn"><button style="background: transparent; border: transparent" role="button" modal="menu-<?= $event['id'] ?>-modal"><i class="icon icon-contents"></i></button></td>
                        <?php if( Users::hasPermission('event_edit') ): ?>
                            <td class="icn"><a href='<?= Routing::getSlug("Events", "update") . "?id=" . $event['id']?>'><i class="icon icon-edit"></i></a></td>
                        <?php endif; if( Users::hasPermission('event_del') ): ?>
                            <td class="icn"><a class="cross cross-red" href='<?= Routing::getSlug("Events", "delete") . "?id=" . $event['id'] ?>'></a></td>
                        <?php endif; ?>
                    </tr>

                    <div id="menu-<?= $event['id'] ?>-modal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close"></span>
                            <h3>
                                <?= $event['displayName'] ?>
                            </h3>
                            <hr>
                            <?php if( isset($event['img_dir'])) : ?>
                                <img src="<?= BASE_URL . $event['img_dir']  ?>"   />
                                <hr>
                            <?php endif; ?>

                            <div class="form-group">
                                <h2>Prix: <?= $event['rate'] ?> €</h2>
                            </div>
                            <hr>

                            <div class="form-group">
                                <h2><?= $event['nbr_place'] ?> place</h2>
                            </div>
                            
                            <hr>

                            <div class="form-group">
                                <a href="<?= BASE_URL.$event['slug'] ?>">/<?= $event['slug'] ?></a>
                            </div>
                            
                            <hr>


                            <div class="form-group">
                                <address>
                                    <p>	 <?= $event['address'] ?></p>
                                    <p>	 <?= $event['postal_code'] ?></p>
                                    <p>	 <?= $event['city'] ?></p>
                                </address>
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