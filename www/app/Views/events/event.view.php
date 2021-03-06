<?php

use Songfolio\Core\Helper;
?>

<?php if ($event->__get('img_dir')) : ?>
    <section id="content-banner" style="background-image:url(<?= $event->__get('img_dir') ?>);">
    </section>
<?php endif; ?>

<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
                <div class="event-page">

                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-12">
                            <h3>Adresse de l'événement</h3>
                            <address>
                                <p><?= $event->__get('address') ?></p>
                                <?= $event->__get('city') ?>
                                <?= $event->__get('postal_code') ?>
                            </address>

                        </div>

                        <div class="second-block col-lg-7 col-md-7 col-12">
                            <h3><?= $event->__get('type') ?> - <?= $event->__get('displayName') ?></h3>
                            <hr>
                            <div class="row">
                                <p class="col-3">Prix: <b><?= $event->__get('rate') ?>€</b> </p>
                                <p class="col-9">Place: <b><?= $event->__get('nbr_place') ?></b> </p>
                            </div>
                            <p>Date de debut: le <b> <?= Helper::getFormatedDateWithTime($event->__get('start_date')) ?></b></p>
                            <p>Date de fin: le <b> <?= Helper::getFormatedDateWithTime($event->__get('end_date')) ?></b></p>
                            <hr>
                            <p>
                                <a href="<?= $event->__get('ticketing') ?>">Acheter mes billets</a>
                            </p>
                            <hr>
                            <p class="details">
                                <?= $event->__get('details') ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php if (isset($comments)) $this->addModal('comment', [
    'type' => 'events',
    'type_id' => $event->__get('id'),
    'redirect' => $event->__get('slug'),
    'comments' => $comments
]) ?>