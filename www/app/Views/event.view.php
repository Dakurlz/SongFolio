<?php

use Songfolio\Core\Helper;
use Songfolio\Core\Routing;
?>

<section id="content-core">
    <div class="container">
        <div class="row center">
            <div class="col-md-8 col-sm-10 col-12">
                <div class="event-page">

                    <div class="row">

                        <div class="col-lg-5 col-md-5 col-12">
                            <img src="<?= BASE_URL . $event->__get('img_dir') ?>" alt="">
                            <h3>Adresse de l'événement</h3>
                            <address>
                                <p><?= $event->__get('address') ?></p>
                                <?= $event->__get('city') ?>
                                <?= $event->__get('postal_code') ?>
                            </address>
                            <a class=" btn btn-success-outline" href="<?= Routing::getSlug('Pages', 'renderEventsPage') ?>">Revenir sur la liste</a>

                        </div>

                        <div class="second-block col-lg-7 col-md-7 col-12">
                            <h3 class="display-name"><?= $event->__get('type') ?> - <?= $event->__get('displayName') ?></h3>
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