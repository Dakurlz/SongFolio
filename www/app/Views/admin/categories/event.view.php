<?php
use Songfolio\Core\Routing;
?>

<div class="row categories-page">

    <?php
    if (isset($alert)) $this->addModal('alert', $alert);
    if(isset($configFormCategory)):

    if($configFormCategory['config']['action_type'] === 'create'): ?>
        <div class="col-md-6 col-12 col-sm-6 col-xs-6">
            <table class="table col-12 col-sm-8 col-lg-8 col-md-8">

                <thead>
                <tr>
                    <th>Catégories d'événement</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                <?php if (!empty($eventCategories)):  ?>
                    <?php foreach ($eventCategories as $event) : ?>

                        <tr>
                            <td><?= $event['name']; ?></td>

                            <td class="icn"><a href='<?= Routing::getSlug("Categories", "update") . "?id=" . $event['id'] . '&type=event' ?>'><i class="icon icon-edit"></i></a></td>
                            <td class="icn"><a href='<?= Routing::getSlug("Categories", "delete") . "?id=" . $event['id'] . '&type=event' ?>'><i class="icon icon-delete"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td>Aucune categorie.</td>
                <?php endif; ?>
                </tbody>

            </table>
            </table>

        </div>

    <?php endif; endif; ?>

    <div class="col-12 col-md-4 col-lg-4 col-sm-6 col-xs-6 categories-page__add-categ">
        <?php $this->addModal("form", $configFormCategory) ?>
    </div>
</div>